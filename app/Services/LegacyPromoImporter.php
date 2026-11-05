<?php

namespace App\Services;

use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LegacyPromoImporter
{
    /** Import without replacing existing codes or reusing remote primary keys. */
    public function import(iterable $rows, string $sourceTimezone = 'UTC', bool $dryRun = false): array
    {
        return DB::transaction(function () use ($rows, $sourceTimezone, $dryRun) {
            $imported = 0;
            $skipped = [];

            foreach ($rows as $row) {
                $data = Arr::only((array) $row, (new Promo)->getFillable());
                $code = $data['promo_code'] ?? null;
                $existing = $code
                    ? Promo::where('promo_code', $code)->exists()
                    : Promo::where('slug', $data['slug'] ?? '')->exists();

                if ($existing) {
                    $skipped[] = $code ?: ($data['slug'] ?? '(tanpa kode)');

                    continue;
                }

                $baseSlug = Str::limit($data['slug'] ?? Str::slug($data['title']), 220, '') ?: 'promo';
                $data['slug'] = $baseSlug;
                $suffix = 2;
                while (Promo::where('slug', $data['slug'])->exists()) {
                    $data['slug'] = $baseSlug.'-'.$suffix++;
                }

                foreach (['start_date', 'end_date'] as $field) {
                    $data[$field] = Carbon::parse($data[$field], $sourceTimezone)->setTimezone(config('app.timezone'));
                }

                $applicableFor = $data['applicable_for'] ?? null;
                for ($depth = 0; is_string($applicableFor) && $depth < 2; $depth++) {
                    $applicableFor = json_decode($applicableFor, true, 512, JSON_THROW_ON_ERROR);
                }
                $data['applicable_for'] = $applicableFor;

                if (! $dryRun) {
                    $promo = new Promo($data);
                    foreach (['created_at', 'updated_at'] as $field) {
                        $value = ((array) $row)[$field] ?? null;
                        if ($value) {
                            $promo->{$field} = Carbon::parse($value, $sourceTimezone)->setTimezone(config('app.timezone'));
                        }
                    }
                    $promo->save();
                }

                $imported++;
            }

            return compact('imported', 'skipped');
        });
    }
}
