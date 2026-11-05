<?php

namespace App\Http\Controllers\Branding;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $promos = Promo::active()
            ->when($request->filled('promo_type'), fn ($query) => $query->ofType($request->promo_type))
            ->latest()->orderByDesc('id')->paginate(9)->withQueryString();

        return view('pages.promos', compact('promos'));
    }

    public function detail($slug)
    {
        $promo = Promo::active()->where('slug', $slug)->firstOrFail();

        return view('pages.promo-detail', compact('promo'));
    }
}
