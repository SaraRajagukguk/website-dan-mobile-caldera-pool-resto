<?php

namespace App\Services;

use App\Models\Promo;

class PromoService
{
    /** Validate without consuming usage. Checkout locks inside its transaction. */
    public function validatePromo(string $promoCode, float $totalAmount, ?string $transactionType = null, bool $lockForUpdate = false): array
    {
        $query = Promo::where('promo_code', $promoCode)->active();

        if ($lockForUpdate) {
            $query->lockForUpdate();
        }

        $promo = $query->first();

        if (! $promo) {
            return ['valid' => false, 'message' => 'Kode promo tidak valid atau sudah berakhir'];
        }

        if ($promo->max_usage !== null && $promo->used_count >= $promo->max_usage) {
            return ['valid' => false, 'message' => 'Kuota penggunaan promo sudah habis'];
        }

        $applicableFor = $promo->applicable_for;
        // Some legacy rows contain a JSON string inside the JSON column.
        if (is_string($applicableFor)) {
            $applicableFor = json_decode($applicableFor, true);
        }
        $applicableFor = is_array($applicableFor) && $applicableFor ? $applicableFor : [$promo->promo_type];
        if ($transactionType !== null && ! in_array($transactionType, $applicableFor, true)) {
            return ['valid' => false, 'message' => 'Promo tidak berlaku untuk jenis transaksi ini'];
        }

        if ($totalAmount < (float) $promo->min_purchase) {
            return ['valid' => false, 'message' => 'Total pembelian belum memenuhi minimal pembelian promo'];
        }

        $discount = $promo->calculateDiscount($totalAmount);

        return [
            'valid' => true,
            'promo' => $promo,
            'discount_amount' => $discount,
            'final_amount' => round(max(0, $totalAmount - $discount), 2),
        ];
    }
}
