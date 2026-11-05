<?php $__env->startSection('title', 'Edit Promo'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="report-page-header">
    <div class="d-flex align-items-center">
        <div class="header-icon">
            <i class="fas fa-edit"></i>
        </div>
        <div>
            <h6>Edit Promo</h6>
            <div class="header-subtitle"><?php echo e($promo->title); ?></div>
        </div>
    </div>
    <a href="<?php echo e(route('admin.promos.index')); ?>" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card report-main-card">
    <div class="card-body">
        <form action="<?php echo e(route('admin.promos.update', $promo->id ?? $promo['id'] ?? 0)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-section">
                <div class="form-section-title">Informasi Dasar</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('title', $promo->title)); ?>" required>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Promo <span class="text-danger">*</span></label>
                        <input type="text" name="promo_code" class="form-control <?php $__errorArgs = ['promo_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('promo_code', $promo->promo_code)); ?>" required>
                        <div class="form-text">Contoh: SUMMER20, WELCOME10</div>
                        <?php $__errorArgs = ['promo_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-12 mb-0">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" required><?php echo e(old('description', $promo->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Pengaturan Diskon</div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tipe Diskon <span class="text-danger">*</span></label>
                        <select name="discount_type" class="form-select <?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="discountType" required>
                            <option value="percentage" <?php echo e(old('discount_type', $promo->discount_type) == 'percentage' ? 'selected' : ''); ?>>Persentase (%)</option>
                            <option value="nominal"    <?php echo e(old('discount_type', $promo->discount_type) == 'nominal'    ? 'selected' : ''); ?>>Nominal (Rp)</option>
                        </select>
                        <?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" id="discountValueLabel">Nilai Diskon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="discountSymbol">
                                <?php echo e(old('discount_type', $promo->discount_type) == 'nominal' ? 'Rp' : '%'); ?>

                            </span>
                            <input type="number" name="discount_value" class="form-control <?php $__errorArgs = ['discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('discount_value', $promo->discount_value)); ?>" required>
                        </div>
                        <?php $__errorArgs = ['discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tipe Promo <span class="text-danger">*</span></label>
                        <select name="promo_type" class="form-select <?php $__errorArgs = ['promo_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="menu"        <?php echo e(old('promo_type', $promo->promo_type) == 'menu'        ? 'selected' : ''); ?>>Menu</option>
                            <option value="ticket"      <?php echo e(old('promo_type', $promo->promo_type) == 'ticket'      ? 'selected' : ''); ?>>Tiket Kolam</option>
                            <option value="reservation" <?php echo e(old('promo_type', $promo->promo_type) == 'reservation' ? 'selected' : ''); ?>>Reservasi</option>
                        </select>
                        <?php $__errorArgs = ['promo_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Minimal Pembelian</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="min_purchase" class="form-control <?php $__errorArgs = ['min_purchase'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('min_purchase', $promo->min_purchase)); ?>">
                        </div>
                        <div class="form-text">Kosongkan jika tidak ada minimal</div>
                        <?php $__errorArgs = ['min_purchase'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Maksimal Diskon</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="max_discount" class="form-control <?php $__errorArgs = ['max_discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('max_discount', $promo->max_discount)); ?>">
                        </div>
                        <div class="form-text">Kosongkan jika tidak ada batas</div>
                        <?php $__errorArgs = ['max_discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Maksimal Penggunaan</label>
                        <input type="number" name="max_usage" class="form-control <?php $__errorArgs = ['max_usage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('max_usage', $promo->max_usage)); ?>" placeholder="Kosongkan jika unlimited">
                        <?php $__errorArgs = ['max_usage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sudah Digunakan</label>
                        <input type="number" name="used_count" class="form-control" value="<?php echo e(old('used_count', $promo->used_count)); ?>" readonly>
                        <div class="form-text">Otomatis terupdate</div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Periode Promo</div>
                <div class="row">
                    <div class="col-md-6 mb-0">
                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start_date" class="form-control <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('start_date', $promo->start_date->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i'))); ?>" required>
                        <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-0">
                        <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end_date" class="form-control <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('end_date', $promo->end_date->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i'))); ?>" required>
                        <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="form-section" style="border-bottom:none; margin-bottom:0; padding-bottom:0;">
                <div class="form-section-title">Status Promo</div>
                <div class="row">
                    <div class="col-md-6 mb-0">
                        <div class="mb-3">
                            <?php if($promo->is_active && now()->between($promo->start_date, $promo->end_date)): ?>
                                <span class="promo-status-badge status-active"><i class="fas fa-circle" style="font-size:8px;"></i> Sedang Berlangsung</span>
                            <?php elseif(!$promo->is_active): ?>
                                <span class="promo-status-badge status-inactive"><i class="fas fa-ban"></i> Nonaktif</span>
                            <?php elseif(now()->gt($promo->end_date)): ?>
                                <span class="promo-status-badge status-expired"><i class="fas fa-clock"></i> Telah Berakhir</span>
                            <?php elseif(now()->lt($promo->start_date)): ?>
                                <span class="promo-status-badge status-upcoming"><i class="fas fa-hourglass-start"></i> Akan Datang</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1" id="isActive"
                                   <?php echo e(old('is_active', $promo->is_active) ? 'checked' : ''); ?>>
                            <label class="form-check-label fw-semibold" for="isActive">Aktifkan Promo</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-4" style="border-top: 1px solid #f0f0f0;">
                <a href="<?php echo e(route('admin.promos.index')); ?>" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Promo
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/admin/promos/edit.blade.php ENDPATH**/ ?>