<?php

namespace Tests\Feature;

use App\Models\PoolTicket;
use App\Models\Promo;
use App\Models\User;
use App\Services\LegacyPromoImporter;
use App\Services\PromoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\BuildsPromoDatabase;
use Tests\TestCase;

class PromoMonolithTest extends TestCase
{
    use BuildsPromoDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->travelTo(now()->setDate(2026, 11, 5)->setTime(12, 0));
        $this->buildPromoDatabase();
        Http::fake();
        Notification::fake();
    }

    protected function tearDown(): void
    {
        try {
            Http::assertNothingSent();
        } finally {
            $this->travelBack();
            parent::tearDown();
        }
    }

    private function promo(array $attributes = []): Promo
    {
        static $sequence = 0;
        $sequence++;

        return Promo::create(array_merge([
            'title' => 'Promo Tiket', 'slug' => 'promo-tiket-'.$sequence,
            'description' => 'Diskon tiket kolam', 'banner_image' => 'promos/old.jpg',
            'discount_type' => 'percentage', 'discount_value' => 20,
            'promo_code' => 'POOL'.$sequence, 'promo_type' => 'ticket',
            'start_date' => now()->subDay(), 'end_date' => now()->addDay(),
            'is_active' => true, 'used_count' => 0,
        ], $attributes));
    }

    private function admin(): User
    {
        return User::create(['name' => 'Admin', 'email' => 'admin@example.test', 'password' => bcrypt('password'), 'role' => 'admin']);
    }

    private function payload(array $attributes = []): array
    {
        return array_merge([
            'title' => 'Promo Baru', 'description' => 'Diskon lokal',
            'discount_type' => 'percentage', 'discount_value' => 20,
            'promo_code' => 'BARU20', 'promo_type' => 'ticket',
            'start_date' => '2026-11-05T10:00', 'end_date' => '2026-11-06T10:00',
            'is_active' => '1',
        ], $attributes);
    }

    public function test_admin_can_create_update_and_delete_a_local_promo_without_a_banner(): void
    {
        $this->actingAs($this->admin());
        $this->post('/admin/promos', $this->payload())->assertRedirect(route('admin.promos.index'))->assertSessionHasNoErrors();
        $this->assertDatabaseHas('promos', ['promo_code' => 'BARU20', 'slug' => 'promo-baru', 'banner_image' => null]);
        $promo = Promo::where('promo_code', 'BARU20')->firstOrFail();
        $this->assertSame('2026-11-05 10:00', $promo->start_date->format('Y-m-d H:i'));

        $this->get('/admin/promos/'.$promo->id.'/edit')->assertOk()->assertSee('2026-11-05T10:00', false);
        $this->put('/admin/promos/'.$promo->id, $this->payload(['title' => 'Judul Diubah', 'discount_value' => 30]))->assertRedirect(route('admin.promos.index'));
        $this->assertDatabaseHas('promos', ['id' => $promo->id, 'discount_value' => 30, 'slug' => 'promo-baru']);
        $this->delete('/admin/promos/'.$promo->id)->assertRedirect(route('admin.promos.index'));
        $this->assertDatabaseMissing('promos', ['id' => $promo->id]);
    }

    public function test_admin_sees_all_local_promos_across_pages(): void
    {
        for ($i = 0; $i < 18; $i++) {
            $this->promo();
        }
        $this->actingAs($this->admin())->get('/admin/promos?page=2')->assertOk()
            ->assertViewHas('promos', fn ($promos) => $promos->total() === 18 && $promos->count() === 3);
    }

    public function test_duplicate_codes_return_validation_errors_and_duplicate_titles_get_unique_slugs(): void
    {
        $this->actingAs($this->admin());
        $this->post('/admin/promos', $this->payload());
        $this->post('/admin/promos', $this->payload())->assertSessionHasErrors('promo_code');
        $this->post('/admin/promos', $this->payload(['promo_code' => 'OTHER20']))->assertSessionHasNoErrors();
        $this->assertSame(2, Promo::count());
        $this->assertSame(2, Promo::distinct()->count('slug'));
    }

    public function test_admin_promo_routes_require_authentication(): void
    {
        $this->post('/admin/promos', $this->payload())->assertRedirect();
        $this->assertSame(0, Promo::count());
    }

    public function test_changing_promo_type_in_admin_updates_legacy_applicability(): void
    {
        $promo = $this->promo(['applicable_for' => ['ticket']]);
        $this->actingAs($this->admin())->put('/admin/promos/'.$promo->id, $this->payload([
            'promo_code' => $promo->promo_code, 'promo_type' => 'menu',
        ]))->assertSessionHasNoErrors();

        $service = app(PromoService::class);
        $this->assertFalse($service->validatePromo($promo->promo_code, 100000, 'ticket')['valid']);
        $this->assertTrue($service->validatePromo($promo->promo_code, 100000, 'menu')['valid']);
    }

    public function test_public_pages_paginate_local_promos_and_hide_unavailable_promos(): void
    {
        for ($i = 0; $i < 18; $i++) {
            $this->promo();
        }
        $this->promo(['is_active' => false]);
        $this->promo(['end_date' => now()->subMinute()]);
        $this->promo(['start_date' => now()->addHour()]);

        $this->get('/promos?page=2')->assertOk()
            ->assertViewHas('promos', fn ($promos) => $promos->total() === 18 && $promos->count() === 9);
    }

    public function test_local_promo_detail_and_api_return_one_promo_by_slug(): void
    {
        $promo = $this->promo();
        $this->get('/promos/'.$promo->slug)->assertOk()->assertViewHas('promo', fn ($value) => $value->id === $promo->id);
        $this->getJson('/api/promos/'.$promo->slug)->assertOk()->assertJsonPath('data.id', $promo->id)->assertJsonPath('success', true);
        $this->get('/promos/missing')->assertNotFound();
        $this->getJson('/api/promos/missing')->assertNotFound();
    }

    public function test_api_lists_only_current_local_promos_without_remote_http(): void
    {
        $promo = $this->promo();
        $this->promo(['is_active' => false]);
        $this->promo(['end_date' => now()->subMinute()]);
        $this->getJson('/api/promos')->assertOk()->assertJsonCount(1, 'data')->assertJsonPath('data.0.id', $promo->id);
    }

    public function test_homepage_reads_promos_and_event_promos_locally(): void
    {
        $promo = $this->promo();
        $event = $this->promo(['promo_type' => 'event', 'start_date' => now()->addHour()]);
        $this->get('/')->assertOk()
            ->assertViewHas('activePromos', fn ($values) => $values->pluck('id')->all() === [$promo->id])
            ->assertViewHas('upcomingEvents', fn ($values) => $values->pluck('id')->all() === [$event->id]);
    }

    public function test_ajax_check_uses_local_discount_without_consuming_usage(): void
    {
        $promo = $this->promo(['max_discount' => 10000]);
        $this->postJson('/check-promo', ['promo_code' => $promo->promo_code, 'total_amount' => 100000, 'transaction_type' => 'ticket'])
            ->assertOk()->assertJsonPath('valid', true)->assertJsonPath('discount_amount', 10000)->assertJsonPath('final_amount', 90000);
        $this->assertSame(0, $promo->fresh()->used_count);
    }

    public function test_validation_rejects_expired_inactive_future_exhausted_wrong_type_and_below_minimum_promos(): void
    {
        foreach ([
            ['end_date' => now()->subMinute()], ['is_active' => false],
            ['start_date' => now()->addMinute()], ['max_usage' => 1, 'used_count' => 1],
            ['promo_type' => 'menu'], ['min_purchase' => 100001],
        ] as $attributes) {
            $promo = $this->promo($attributes);
            $result = app(PromoService::class)->validatePromo($promo->promo_code, 100000, 'ticket');
            $this->assertFalse($result['valid'], json_encode($attributes));
        }
    }

    public function test_discount_never_exceeds_purchase_total(): void
    {
        foreach ([['discount_type' => 'nominal', 'discount_value' => 200000], ['discount_value' => 200]] as $attributes) {
            $promo = $this->promo($attributes);
            $result = app(PromoService::class)->validatePromo($promo->promo_code, 100000, 'ticket');
            $this->assertTrue($result['valid']);
            $this->assertEquals(100000, $result['discount_amount']);
            $this->assertEquals(0, $result['final_amount']);
        }
    }

    public function test_legacy_double_encoded_applicability_is_supported(): void
    {
        $promo = $this->promo(['applicable_for' => json_encode(['ticket'])]);
        $this->assertTrue(app(PromoService::class)->validatePromo($promo->promo_code, 100000, 'ticket')['valid']);
        $this->assertFalse(app(PromoService::class)->validatePromo($promo->promo_code, 100000, 'menu')['valid']);
    }

    public function test_zero_discount_cap_is_respected(): void
    {
        $promo = $this->promo(['max_discount' => 0]);
        $this->assertEquals(0, app(PromoService::class)->validatePromo($promo->promo_code, 100000, 'ticket')['discount_amount']);
    }

    public function test_import_preserves_existing_records_converts_utc_dates_and_can_be_repeated(): void
    {
        $existing = $this->promo(['promo_code' => 'EXISTING', 'title' => 'Keep Local']);
        $rows = [
            array_merge($existing->getAttributes(), ['title' => 'Remote Change']),
            array_merge($existing->getAttributes(), [
                'id' => 999, 'promo_code' => 'IMPORT20', 'banner_image' => null,
                'start_date' => '2026-11-05 03:00:00', 'end_date' => '2026-11-05 10:00:00',
                'applicable_for' => json_encode(json_encode(['ticket'])), 'used_count' => 3,
            ]),
        ];
        $importer = app(LegacyPromoImporter::class);
        $this->assertSame(1, $importer->import($rows, 'UTC', true)['imported']);
        $this->assertSame(1, Promo::count());
        $result = $importer->import($rows, 'UTC');
        $this->assertSame(1, $result['imported']);
        $this->assertCount(1, $result['skipped']);
        $this->assertSame('Keep Local', $existing->fresh()->title);
        $imported = Promo::where('promo_code', 'IMPORT20')->firstOrFail();
        $this->assertSame('2026-11-05 10:00', $imported->start_date->format('Y-m-d H:i'));
        $this->assertSame(['ticket'], $imported->applicable_for);
        $this->assertSame(3, $imported->used_count);
        $this->assertNotSame($existing->slug, $imported->slug);
        $this->assertSame(0, $importer->import($rows, 'UTC')['imported']);
        $this->assertSame(2, Promo::count());
    }

    public function test_import_command_reads_the_source_and_backs_up_before_writing(): void
    {
        Storage::fake('local');
        $promo = $this->promo(['start_date' => '2026-11-05 03:00:00', 'end_date' => '2026-11-06 03:00:00']);
        $sourceDatabase = tempnam(sys_get_temp_dir(), 'promo_import_');
        unlink($sourceDatabase);

        try {
            DB::statement('VACUUM INTO '.DB::getPdo()->quote($sourceDatabase));
            $promo->delete();
            $this->artisan('promo:import', ['database' => $sourceDatabase, '--dry-run' => true])->assertSuccessful();
            $this->assertSame(0, Promo::count());
            $this->assertSame([], Storage::disk('local')->allFiles());

            $this->artisan('promo:import', ['database' => $sourceDatabase])->assertSuccessful();
            $this->assertSame(1, Promo::count());
            $backups = Storage::disk('local')->allFiles('promo-imports');
            $this->assertCount(1, $backups);
            $backup = json_decode(Storage::disk('local')->get($backups[0]), true);
            $this->assertSame([], $backup['local_promos']);
            $this->assertSame($promo->promo_code, $backup['source_promos'][0]['promo_code']);
            $this->assertSame('2026-11-05 10:00', Promo::first()->start_date->format('Y-m-d H:i'));
        } finally {
            unlink($sourceDatabase);
        }
    }

    private function ticketPayload(array $attributes = []): array
    {
        return array_merge([
            'customer_name' => 'Customer', 'customer_email' => 'customer@example.test',
            'customer_phone' => '08123456789', 'visit_date' => '2026-11-06',
            'ticket_type' => 'adult', 'number_of_tickets' => 2,
            'final_total_amount' => 1, 'discount_amount' => 69999,
        ], $attributes);
    }

    public function test_ticket_checkout_recalculates_local_promo_and_records_usage_once(): void
    {
        $promo = $this->promo(['max_usage' => 1]);
        $user = User::create(['name' => 'Customer', 'email' => 'customer@example.test', 'password' => bcrypt('password'), 'role' => 'customer']);
        $this->actingAs($user)->post('/reservation/ticket/store', $this->ticketPayload(['promo_code' => $promo->promo_code]))
            ->assertSessionHasNoErrors()->assertSessionHas('success');
        $this->assertDatabaseHas('pool_tickets', ['total_amount' => 56000]);
        $this->assertSame(1, $promo->fresh()->used_count);
        $this->post('/reservation/ticket/store', $this->ticketPayload(['promo_code' => $promo->promo_code]))->assertSessionHas('error');
        $this->assertSame(1, PoolTicket::count());
    }

    public function test_ticket_failure_rolls_back_promo_usage(): void
    {
        $promo = $this->promo();
        $user = User::create(['name' => 'Customer', 'email' => 'customer@example.test', 'password' => bcrypt('password'), 'role' => 'customer']);
        DB::unprepared("CREATE TRIGGER reject_ticket BEFORE INSERT ON pool_tickets BEGIN SELECT RAISE(ABORT, 'simulated storage failure'); END");
        $this->actingAs($user)->post('/reservation/ticket/store', $this->ticketPayload(['promo_code' => $promo->promo_code]))->assertSessionHas('error');
        $this->assertSame(0, $promo->fresh()->used_count);
        $this->assertSame(0, PoolTicket::count());
    }
}
