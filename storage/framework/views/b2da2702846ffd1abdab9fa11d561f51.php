<?php $__env->startSection('title', 'Promo Management'); ?>

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

    .btn-add {
        background: #c1a067;
        color: #fff;
        border: none;
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

    .btn-add:hover {
        background: #a98750;
        color: #fff;
        transform: translateY(-1px);
    }

    .report-main-card {
        border: none;
        border-radius: 16px;
        border-top: 3px solid #c1a067 !important;
        box-shadow: 0 4px 20px rgba(28,52,81,0.08);
    }

    .report-main-card .card-body {
        padding: 24px;
    }

    .report-main-card .table thead th {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        border-bottom: 2px solid #f0f0f0;
        padding: 12px 16px;
        white-space: nowrap;
    }

    .report-main-card .table tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f8f9fa;
    }

    .report-main-card .table tbody tr:hover {
        background: #f8fafc;
    }

    .badge-promo-code {
        background: rgba(193,160,103,0.15);
        color: #a98750;
        font-weight: 700;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 6px;
        letter-spacing: 0.5px;
    }

    .badge-active {
        background: rgba(21,128,61,0.12);
        color: #15803d;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .badge-inactive {
        background: rgba(107,114,128,0.12);
        color: #6b7280;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .badge-expired {
        background: rgba(220,38,38,0.1);
        color: #dc2626;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .badge-upcoming {
        background: rgba(37,99,235,0.1);
        color: #2563eb;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .btn-action-edit {
        background: #1c3451;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 12px;
        transition: all 0.2s;
    }

    .btn-action-edit:hover { background: #c1a067; color: #fff; }

    .btn-action-delete {
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 12px;
        transition: all 0.2s;
    }

    .btn-action-delete:hover { background: #b91c1c; color: #fff; }

    .period-text {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.6;
    }

    .discount-value {
        font-weight: 700;
        color: #1c3451;
        font-size: 14px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }

    .empty-state i { color: #dde2e8; margin-bottom: 16px; display: block; }
    .empty-state p { font-size: 14px; margin-bottom: 16px; }

    /* Custom Pagination untuk Admin */
    .caldera-pagination {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
        margin: 30px 0 0;
        padding: 0;
        list-style: none;
    }

    .caldera-pagination li {
        display: inline-block;
        margin: 0;
    }

    .caldera-pagination li a,
    .caldera-pagination li span {
        display: inline-block;
        padding: 6px 14px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #1c3451;
        text-decoration: none;
        transition: all 0.2s ease;
        line-height: 1.4;
    }

    .caldera-pagination li a:hover {
        background: #f8fafc;
        border-color: #c1a067;
        color: #c1a067;
        transform: translateY(-1px);
    }

    .caldera-pagination li.active span {
        background: #1c3451;
        border-color: #1c3451;
        color: #fff;
    }

    .caldera-pagination li.disabled span {
        background: #f1f5f9;
        color: #94a3b8;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    @media (max-width: 576px) {
        .caldera-pagination li a,
        .caldera-pagination li span {
            padding: 4px 10px;
            font-size: 11px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="report-page-header">
    <div class="d-flex align-items-center">
        <div class="header-icon">
            <i class="fas fa-tags"></i>
        </div>
        <h6>Daftar Promo</h6>
    </div>
    <a href="<?php echo e(route('admin.promos.create')); ?>" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Promo
    </a>
</div>

<div class="card report-main-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kode Promo</th>
                        <th>Diskon</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
<?php $__empty_1 = true; $__currentLoopData = $promos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        if (is_int($promo)) {
            continue;
        }
        if (is_array($promo)) {
            $promo = (object) $promo;
        }
        if (!isset($promo->title) && !isset($promo->id)) {
            continue;
        }
    ?>
    <tr>
        <td class="fw-bold" style="color:#1c3451;"><?php echo e($promo->title ?? 'N/A'); ?></td>
        <td><span class="badge-promo-code"><?php echo e($promo->promo_code ?? '-'); ?></span></td>
        <td>
            <span class="discount-value">
                <?php if(isset($promo->discount_type) && $promo->discount_type == 'percentage'): ?>
                    <?php echo e($promo->discount_value ?? 0); ?>%
                <?php else: ?>
                    Rp <?php echo e(number_format($promo->discount_value ?? 0, 0, ',', '.')); ?>

                <?php endif; ?>
            </span>
        </td>
        <td>
            <div class="period-text">
                <?php if(isset($promo->start_date)): ?>
                    <?php echo e(\Carbon\Carbon::parse($promo->start_date)->setTimezone('Asia/Jakarta')->format('d M Y H:i')); ?><br>
                    s/d <?php echo e(\Carbon\Carbon::parse($promo->end_date)->setTimezone('Asia/Jakarta')->format('d M Y H:i')); ?>

                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </td>
        <td>
            <?php
                $startDate = \Carbon\Carbon::parse($promo->start_date)->setTimezone('Asia/Jakarta');
                $endDate = \Carbon\Carbon::parse($promo->end_date)->setTimezone('Asia/Jakarta');
                $now = \Carbon\Carbon::now('Asia/Jakarta');
                $isActive = $promo->is_active ?? false;
                
                $statusClass = 'badge-inactive';
                $statusText = 'Tidak Aktif';
                $showIcon = false;
                
                if ($isActive) {
                    if ($now->between($startDate, $endDate)) {
                        $statusClass = 'badge-active';
                        $statusText = 'Aktif';
                        $showIcon = true;
                    } elseif ($now->lt($startDate)) {
                        $statusClass = 'badge-upcoming';
                        $statusText = 'Akan Datang';
                    } elseif ($now->gt($endDate)) {
                        $statusClass = 'badge-expired';
                        $statusText = 'Berakhir';
                    }
                } else {
                    $statusClass = 'badge-inactive';
                    $statusText = 'Nonaktif';
                }
            ?>
            <span class="<?php echo e($statusClass); ?>">
                <?php if($showIcon): ?>
                    <i class="fas fa-circle me-1" style="font-size:7px;"></i>
                <?php endif; ?>
                <?php echo e($statusText); ?>

            </span>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="<?php echo e(route('admin.promos.edit', $promo->id ?? 0)); ?>" class="btn btn-action-edit" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="<?php echo e(route('admin.promos.destroy', $promo->id ?? 0)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-action-delete" title="Hapus"
                            onclick="return confirm('Yakin hapus promo ini?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="6">
            <div class="empty-state">
                <i class="fas fa-tags fa-4x"></i>
                <p>Belum ada data promo</p>
                <a href="<?php echo e(route('admin.promos.create')); ?>" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Promo
                </a>
            </div>
        </td>
    </tr>
<?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(is_object($promos) && method_exists($promos, 'links')): ?>
            <div class="mt-4">
            <?php echo e($promos->withQueryString()->links('vendor.pagination.admin')); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/admin/promos/index.blade.php ENDPATH**/ ?>