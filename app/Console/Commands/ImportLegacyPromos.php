<?php

namespace App\Console\Commands;

use App\Models\Promo;
use App\Services\LegacyPromoImporter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ImportLegacyPromos extends Command
{
    protected $signature = 'promo:import {database : Database microservice pada server database yang sama}
                            {--source-timezone=UTC : Zona waktu penyimpanan microservice}
                            {--dry-run : Tampilkan hasil tanpa menyimpan atau membuat cadangan}';

    protected $description = 'Gabungkan promo lama ke PA2 tanpa menimpa kode promo yang sudah ada';

    public function handle(LegacyPromoImporter $importer): int
    {
        $connection = config('database.connections.'.config('database.default'));
        if ($connection['database'] === $this->argument('database')) {
            $this->error('Database sumber harus berbeda dari database PA2.');

            return self::FAILURE;
        }

        config(['database.connections.legacy_promos_import' => array_replace($connection, [
            'database' => $this->argument('database'),
            'url' => null,
        ])]);
        DB::purge('legacy_promos_import');

        try {
            $rows = DB::connection('legacy_promos_import')->table('promos')->orderBy('id')->get();
            $dryRun = (bool) $this->option('dry-run');
            $timezone = $this->option('source-timezone');

            if (! $dryRun) {
                $backup = 'promo-imports/'.now()->format('Ymd-His').'-'.Str::uuid().'.json';
                $saved = Storage::disk('local')->put($backup, json_encode([
                    'source_database' => $this->argument('database'),
                    'source_timezone' => $timezone,
                    'local_promos' => Promo::query()->toBase()->get()->all(),
                    'source_promos' => $rows->all(),
                ], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));

                if (! $saved) {
                    throw new RuntimeException('Cadangan gagal dibuat; impor dibatalkan.');
                }
                $this->info('Cadangan: '.Storage::disk('local')->path($backup));
            }

            $result = $importer->import($rows, $timezone, $dryRun);
            $this->info(($dryRun ? 'Simulasi: ' : '').$result['imported'].' promo diimpor; '.count($result['skipped']).' kode yang sudah ada dipertahankan.');
            foreach ($result['skipped'] as $code) {
                $this->line('Dipertahankan: '.$code);
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Impor dibatalkan: '.$e->getMessage());

            return self::FAILURE;
        } finally {
            DB::purge('legacy_promos_import');
        }
    }
}
