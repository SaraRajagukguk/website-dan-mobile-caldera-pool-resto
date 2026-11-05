@extends('layouts.app')

@section('title', $menu->name . ' - Caldera')

@push('styles')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container py-5 menu-detail-page">
    <a href="{{ route('branding.menu') }}" class="menu-detail-back mb-4">
        <i class="fas fa-arrow-left" aria-hidden="true"></i> Kembali ke Menu
    </a>

    <div class="menu-detail-card">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="menu-detail-media">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                    @else
                        <i class="fas fa-utensils menu-detail-placeholder" aria-hidden="true"></i>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="menu-detail-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="menu-detail-badge">
                            <i class="fas fa-utensils" aria-hidden="true"></i> {{ ucfirst($menu->category) }}
                        </span>
                        @if($menu->is_recommended)
                            <span class="menu-detail-badge">
                                <i class="fas fa-star" aria-hidden="true"></i> Recommended
                            </span>
                        @endif
                        <span class="menu-detail-badge {{ $menu->is_available ? 'is-available' : 'is-unavailable' }}">
                            <i class="fas {{ $menu->is_available ? 'fa-check-circle' : 'fa-minus-circle' }}" aria-hidden="true"></i>
                            {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>

                    <h1 class="menu-detail-title">{{ $menu->name }}</h1>
                    <div class="menu-detail-divider"></div>
                    <p class="menu-detail-description mb-0">{{ $menu->description }}</p>

                    <div class="menu-detail-price-box">
                        <span class="text-muted small">Harga Menu</span>
                        <strong class="menu-detail-price">Rp. {{ number_format($menu->price, 0, ',', '.') }}</strong>
                    </div>

                    <a href="{{ route('branding.menu.category', $menu->category) }}" class="btn btn-menu-detail w-100 mt-4">
                        Lihat Menu {{ ucfirst($menu->category) }} Lainnya
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
