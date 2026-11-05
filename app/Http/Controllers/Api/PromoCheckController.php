<?php

// app/Http/Controllers/Api/PromoCheckController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PromoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PromoCheckController extends Controller
{
    protected $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    public function check(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:ticket,reservation,menu',
        ]);

        try {
            $result = $this->promoService->validatePromo(
                $request->promo_code,
                $request->total_amount,
                $request->transaction_type
            );

            if ($result && $result['valid']) {
                return response()->json([
                    'valid' => true,
                    'discount_amount' => $result['discount_amount'],
                    'final_amount' => $result['final_amount'],
                ]);
            }

            return response()->json([
                'valid' => false,
                'message' => $result['message'] ?? 'Kode promo tidak valid',
            ]);

        } catch (\Exception $e) {
            Log::error('Promo check error: '.$e->getMessage());

            return response()->json([
                'valid' => false,
                'message' => 'Gagal mengecek promo',
            ]);
        }
    }
}
