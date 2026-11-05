<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavePromoRequest;
use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoManagementController extends Controller
{
    public function index(Request $request)
    {
        $promos = Promo::query()
            ->when($request->filled('promo_type'), fn ($query) => $query->ofType($request->promo_type))
            ->when($request->filled('is_active'), fn ($query) => $query->where('is_active', $request->boolean('is_active')))
            ->latest()->orderByDesc('id')->paginate(15)->withQueryString();

        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(SavePromoRequest $request)
    {
        $data = $this->promoData($request);
        $baseSlug = Str::slug(Str::limit($data['title'], 220, '')) ?: 'promo';
        $slug = $baseSlug;
        $suffix = 2;
        while (Promo::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        Promo::create($data + ['slug' => $slug, 'used_count' => 0]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);

        return view('admin.promos.edit', compact('promo'));
    }

    public function update(SavePromoRequest $request, $id)
    {
        Promo::findOrFail($id)->update($this->promoData($request));

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil diupdate');
    }

    public function destroy($id)
    {
        Promo::findOrFail($id)->delete();

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dihapus');
    }

    private function promoData(SavePromoRequest $request): array
    {
        $data = $request->validated();
        foreach (['start_date', 'end_date'] as $field) {
            $data[$field] = Carbon::parse($data[$field], 'Asia/Jakarta')->setTimezone(config('app.timezone'));
        }
        $data['is_active'] = $request->boolean('is_active');
        $data['applicable_for'] = [$data['promo_type']];

        return $data;
    }
}
