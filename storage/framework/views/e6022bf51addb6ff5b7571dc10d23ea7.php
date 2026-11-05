<?php $__env->startSection('title', 'Promos - Caldera Resto & Pool'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-2" style="font-family: 'Playfair Display', serif; color: #1c3451;">Special Promos</h1>
        <div class="section-divider"></div>
        <p class="lead text-muted">Get exciting discounts and offers</p>
    </div>

    <?php if(session('error')): ?>
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $promos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            // Pastikan $promo bisa diakses sebagai object
            if (is_array($promo)) {
                $promo = (object) $promo;
            }
            
            $endDate = isset($promo->end_date) ? \Carbon\Carbon::parse($promo->end_date)->setTimezone('Asia/Jakarta') : null;
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 promo-card">
                <!-- HAPUS BAGIAN GAMBAR, LANGSUNG TAMPILKAN CONTENT -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge-promo">
                            <?php if(isset($promo->promo_type) && $promo->promo_type == 'ticket'): ?>
                                <i class="fas fa-ticket-alt me-1"></i> Tiket
                            <?php elseif(isset($promo->promo_type) && $promo->promo_type == 'menu'): ?>
                                <i class="fas fa-utensils me-1"></i> Menu
                            <?php elseif(isset($promo->promo_type) && $promo->promo_type == 'event'): ?>
                                <i class="fas fa-calendar-alt me-1"></i> Event
                            <?php elseif(isset($promo->promo_type) && $promo->promo_type == 'reservation'): ?>
                                <i class="fas fa-calendar-check me-1"></i> Reservasi
                            <?php else: ?>
                                Promo
                            <?php endif; ?>
                        </span>
                        <?php if($endDate): ?>
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i>
                            Berakhir: <?php echo e($endDate->format('d M Y')); ?>

                        </small>
                        <?php endif; ?>
                    </div>
                    
                    <h5 class="fw-bold mb-2" style="color: #1c3451;"><?php echo e($promo->title ?? 'N/A'); ?></h5>
                    <p class="text-muted small"><?php echo e(Str::limit($promo->description ?? '', 100)); ?></p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="discount-badge">
                            <?php if(isset($promo->discount_type) && $promo->discount_type == 'percentage'): ?>
                                <span class="discount-percent"><?php echo e($promo->discount_value ?? 0); ?>% OFF</span>
                            <?php else: ?>
                                <span class="discount-amount">Rp <?php echo e(number_format($promo->discount_value ?? 0, 0, ',', '.')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="promo-code">
                            <code class="px-2 py-1 rounded" style="background: #f0ebe0; color: #c1a067;">
                                <?php echo e($promo->promo_code ?? '-'); ?>

                            </code>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 pb-3 pt-0">
                    <a href="<?php echo e(route('branding.promos.detail', $promo->slug ?? '#')); ?>" class="btn btn-promo w-100">
                        View Details <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <div class="empty-state">
                <i class="fas fa-tags fa-4x mb-3" style="color: #c1a067; opacity: 0.4;"></i>
                <h5 style="color: #1c3451;">No Active Promos</h5>
                <p class="text-muted">Check back later for exciting discounts!</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php if($promos->hasPages()): ?>
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="text-muted small">
                Showing <?php echo e($promos->firstItem() ?? 0); ?> to <?php echo e($promos->lastItem() ?? 0); ?>

                of <?php echo e($promos->total()); ?> promos
            </div>
            <div class="pagination-wrapper">
                <?php echo e($promos->appends(request()->query())->links('pagination::bootstrap-5')); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .section-divider {
        width: 60px;
        height: 3px;
        background: #c1a067;
        margin: 12px auto;
        border-radius: 2px;
    }
    
    .promo-card {
        border-radius: 20px !important;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        border-top: 3px solid #c1a067 !important;
    }
    
    .promo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(28,52,81,0.12) !important;
    }
    
    .badge-promo {
        background: rgba(193,160,103,0.15);
        color: #c1a067;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .discount-badge {
        background: linear-gradient(135deg, #1c3451, #01516e);
        padding: 6px 12px;
        border-radius: 25px;
    }
    
    .discount-percent, .discount-amount {
        color: white;
        font-weight: bold;
        font-size: 14px;
    }
    
    .btn-promo {
        background: white;
        color: #1c3451;
        border: 1.5px solid #1c3451;
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .btn-promo:hover {
        background: #1c3451;
        color: white;
        transform: translateY(-2px);
    }
    
    code {
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Dark Mode */
    body.dark-mode .promo-card {
        background: #1e1e2a;
    }
    
    body.dark-mode .btn-promo {
        background: #1e1e2a;
        border-color: #c1a067;
        color: #c1a067;
    }
    
    body.dark-mode .btn-promo:hover {
        background: #c1a067;
        color: #1c3451;
    }
    /* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: flex-end;
}

.pagination-wrapper .pagination {
    margin-bottom: 0;
    gap: 4px;
}

.pagination-wrapper .page-link {
    border: 1.5px solid #e8e0d0;
    border-radius: 10px !important;
    padding: 8px 16px;
    color: #1c3451;
    background: white;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s;
    margin: 0 2px;
}

.pagination-wrapper .page-link:hover {
    background: #1c3451;
    color: white;
    border-color: #1c3451;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(28,52,81,0.2);
    z-index: 2;
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #1c3451, #01516e);
    color: white;
    border-color: #1c3451;
    box-shadow: 0 4px 12px rgba(28,52,81,0.25);
}

.pagination-wrapper .page-item.disabled .page-link {
    background: #f8f6f2;
    color: #b0a890;
    border-color: #f0ebe0;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

.pagination-wrapper .page-item:first-child .page-link,
.pagination-wrapper .page-item:last-child .page-link {
    border-radius: 10px !important;
}

@media (max-width: 768px) {
    .pagination-wrapper {
        justify-content: center !important;
        width: 100%;
    }

    .pagination-wrapper .page-link {
        padding: 6px 12px;
        font-size: 13px;
    }

    .mt-5 .d-flex {
        flex-direction: column;
        align-items: center !important;
        gap: 12px;
    }

    .mt-5 .text-muted {
        text-align: center;
    }
    }

    /* Dark Mode - Pagination */
    body.dark-mode .pagination-wrapper .page-link {
        background: #1e1e2a;
        border-color: #2d2d3a;
        color: #dce8f0;
    }

    body.dark-mode .pagination-wrapper .page-link:hover {
        background: #c1a067;
        color: #1c3451;
        border-color: #c1a067;
    }

    body.dark-mode .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #c1a067, #a8894f);
        color: #1c3451;
        border-color: #c1a067;
    }

    body.dark-mode .pagination-wrapper .page-item.disabled .page-link {
        background: #2d2d3a;
        color: #5a5a6a;
        border-color: #2d2d3a;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/pages/promos.blade.php ENDPATH**/ ?>