@extends('layouts.admin')

@section('title', 'Edit Promo')

@push('styles')
<style>
    .report-page-header {
        background: linear-gradient(135deg, #1c3451 0%, #2a4a6b 100%);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .report-page-header h6 {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .report-page-header .header-subtitle {
        color: rgba(255,255,255,0.6);
        font-size: 13px;
        font-weight: 400;
        margin-top: 2px;
    }

    .report-page-header .header-icon {
        width: 44px;
        height: 44px;
        background: rgba(193,160,103,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 14px;
    }

    .report-page-header .header-icon i {
        color: #c1a067;
        font-size: 18px;
    }

    .btn-back {
        background: rgba(255,255,255,0.15);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 18px;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.25);
        color: #fff;
    }

    .report-main-card {
        border: none;
        border-radius: 16px;
        border-top: 3px solid #c1a067 !important;
        box-shadow: 0 4px 20px rgba(28,52,81,0.08);
    }

    .report-main-card .card-body {
        padding: 28px 32px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        font-size: 13px;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        color: #374151;
        padding: 9px 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #c1a067;
        box-shadow: 0 0 0 3px rgba(193,160,103,0.15);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc2626;
    }

    .form-control[readonly] {
        background: #f8fafc;
        color: #9ca3af;
        cursor: not-allowed;
    }

    .input-group-text {
        font-size: 13px;
        font-weight: 600;
        background: #f8fafc;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px 0 0 10px;
        color: #6b7280;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .form-text {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
    }

    .form-check-input:checked {
        background-color: #c1a067;
        border-color: #c1a067;
    }

    .form-check-label {
        font-size: 13px;
        color: #374151;
    }

    .form-section {
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .form-section-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #c1a067;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #f0f0f0;
    }

    .promo-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 8px;
    }

    .status-active   { background: rgba(21,128,61,0.12);  color: #15803d; }
    .status-inactive { background: rgba(107,114,128,0.12); color: #6b7280; }
    .status-expired  { background: rgba(220,38,38,0.1);   color: #dc2626; }
    .status-upcoming { background: rgba(37,99,235,0.1);   color: #2563eb; }

    .btn-submit {
        background: #c1a067;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        padding: 10px 24px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-submit:hover {
        background: #a98750;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        padding: 10px 24px;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
</style>
@endpush

@section('content')

<div class="report-page-header">
    <div class="d-flex align-items-center">
        <div class="header-icon">
            <i class="fas fa-edit"></i>
        </div>
        <div>
            <h6>Edit Promo</h6>
            <div class="header-subtitle">{{ $promo->title }}</div>
        </div>
    </div>
    <a href="{{ route('admin.promos.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card report-main-card">
    <div class="card-body">
        <form action="{{ route('admin.promos.update', $promo->id ?? $promo['id'] ?? 0) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="form-section-title">Informasi Dasar</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $promo->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Promo <span class="text-danger">*</span></label>
                        <input type="text" name="promo_code" class="form-control @error('promo_code') is-invalid @enderror" value="{{ old('promo_code', $promo->promo_code) }}" required>
                        <div class="form-text">Contoh: SUMMER20, WELCOME10</div>
                        @error('promo_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-0">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $promo->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Pengaturan Diskon</div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tipe Diskon <span class="text-danger">*</span></label>
                        <select name="discount_type" class="form-select @error('discount_type') is-invalid @enderror" id="discountType" required>
                            <option value="percentage" {{ old('discount_type', $promo->discount_type) == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                            <option value="nominal"    {{ old('discount_type', $promo->discount_type) == 'nominal'    ? 'selected' : '' }}>Nominal (Rp)</option>
                        </select>
                        @error('discount_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" id="discountValueLabel">Nilai Diskon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="discountSymbol">
                                {{ old('discount_type', $promo->discount_type) == 'nominal' ? 'Rp' : '%' }}
                            </span>
                            <input type="number" name="discount_value" class="form-control @error('discount_value') is-invalid @enderror" value="{{ old('discount_value', $promo->discount_value) }}" required>
                        </div>
                        @error('discount_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tipe Promo <span class="text-danger">*</span></label>
                        <select name="promo_type" class="form-select @error('promo_type') is-invalid @enderror" required>
                            <option value="menu"        {{ old('promo_type', $promo->promo_type) == 'menu'        ? 'selected' : '' }}>Menu</option>
                            <option value="ticket"      {{ old('promo_type', $promo->promo_type) == 'ticket'      ? 'selected' : '' }}>Tiket Kolam</option>
                            <option value="reservation" {{ old('promo_type', $promo->promo_type) == 'reservation' ? 'selected' : '' }}>Reservasi</option>
                        </select>
                        @error('promo_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Minimal Pembelian</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="min_purchase" class="form-control @error('min_purchase') is-invalid @enderror" value="{{ old('min_purchase', $promo->min_purchase) }}">
                        </div>
                        <div class="form-text">Kosongkan jika tidak ada minimal</div>
                        @error('min_purchase')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Maksimal Diskon</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="max_discount" class="form-control @error('max_discount') is-invalid @enderror" value="{{ old('max_discount', $promo->max_discount) }}">
                        </div>
                        <div class="form-text">Kosongkan jika tidak ada batas</div>
                        @error('max_discount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Maksimal Penggunaan</label>
                        <input type="number" name="max_usage" class="form-control @error('max_usage') is-invalid @enderror" value="{{ old('max_usage', $promo->max_usage) }}" placeholder="Kosongkan jika unlimited">
                        @error('max_usage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sudah Digunakan</label>
                        <input type="number" name="used_count" class="form-control" value="{{ old('used_count', $promo->used_count) }}" readonly>
                        <div class="form-text">Otomatis terupdate</div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Periode Promo</div>
                <div class="row">
                    <div class="col-md-6 mb-0">
                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                               value="{{ old('start_date', $promo->start_date->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i')) }}" required>
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                               value="{{ old('end_date', $promo->end_date->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i')) }}" required>
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-section" style="border-bottom:none; margin-bottom:0; padding-bottom:0;">
                <div class="form-section-title">Status Promo</div>
                <div class="row">
                    <div class="col-md-6 mb-0">
                        <div class="mb-3">
                            @if($promo->is_active && now()->between($promo->start_date, $promo->end_date))
                                <span class="promo-status-badge status-active"><i class="fas fa-circle" style="font-size:8px;"></i> Sedang Berlangsung</span>
                            @elseif(!$promo->is_active)
                                <span class="promo-status-badge status-inactive"><i class="fas fa-ban"></i> Nonaktif</span>
                            @elseif(now()->gt($promo->end_date))
                                <span class="promo-status-badge status-expired"><i class="fas fa-clock"></i> Telah Berakhir</span>
                            @elseif(now()->lt($promo->start_date))
                                <span class="promo-status-badge status-upcoming"><i class="fas fa-hourglass-start"></i> Akan Datang</span>
                            @endif
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1" id="isActive"
                                   {{ old('is_active', $promo->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Aktifkan Promo</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-4" style="border-top: 1px solid #f0f0f0;">
                <a href="{{ route('admin.promos.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Promo
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('discountType')?.addEventListener('change', function () {
        const symbol = document.getElementById('discountSymbol');
        const label  = document.getElementById('discountValueLabel');
        if (this.value === 'percentage') {
            symbol.textContent = '%';
            label.innerHTML = 'Nilai Diskon <span class="text-danger">*</span>';
        } else {
            symbol.textContent = 'Rp';
            label.innerHTML = 'Nilai Diskon (Rp) <span class="text-danger">*</span>';
        }
    });
</script>
@endpush

@endsection
