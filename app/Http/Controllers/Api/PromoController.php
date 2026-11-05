<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Promo::active()->latest()->orderByDesc('id')->get(),
        ]);
    }

    public function show($slug)
    {
        return response()->json([
            'success' => true,
            'data' => Promo::active()->where('slug', $slug)->firstOrFail(),
        ]);
    }
}
