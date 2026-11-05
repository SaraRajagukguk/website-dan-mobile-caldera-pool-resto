<?php

namespace Tests\Concerns;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait BuildsPromoDatabase
{
    protected function buildPromoDatabase(): void
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');

        foreach ([
            '0001_01_01_000000_create_users_table.php',
            '2026_03_11_062811_create_menus_table.php',
            '2026_03_11_062955_create_galleries_table.php',
            '2026_03_11_063017_create_promos_table.php',
            '2026_03_11_063059_create_testimonials_table.php',
            '2026_03_11_063608_create_pool_tickets_table.php',
            '2026_05_04_125126_create_notifications_table.php',
        ] as $filename) {
            (require database_path('migrations/'.$filename))->up();
        }

        // The deployed PostgreSQL schema also allows pending tickets.
        Schema::table('pool_tickets', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });

        $migration = database_path('migrations/2026_11_05_000001_make_promo_banner_image_nullable.php');
        if (file_exists($migration)) {
            (require $migration)->up();
        }
    }
}
