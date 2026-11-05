<?php $__env->startSection('title', $menu->name . ' - Caldera'); ?>

<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/menu.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 menu-detail-page">
    <a href="<?php echo e(route('branding.menu')); ?>" class="menu-detail-back mb-4">
        <i class="fas fa-arrow-left" aria-hidden="true"></i> Kembali ke Menu
    </a>

    <div class="menu-detail-card">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="menu-detail-media">
                    <?php if($menu->image): ?>
                        <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>">
                    <?php else: ?>
                        <i class="fas fa-utensils menu-detail-placeholder" aria-hidden="true"></i>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="menu-detail-body">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="menu-detail-badge">
                            <i class="fas fa-utensils" aria-hidden="true"></i> <?php echo e(ucfirst($menu->category)); ?>

                        </span>
                        <?php if($menu->is_recommended): ?>
                            <span class="menu-detail-badge">
                                <i class="fas fa-star" aria-hidden="true"></i> Recommended
                            </span>
                        <?php endif; ?>
                        <span class="menu-detail-badge <?php echo e($menu->is_available ? 'is-available' : 'is-unavailable'); ?>">
                            <i class="fas <?php echo e($menu->is_available ? 'fa-check-circle' : 'fa-minus-circle'); ?>" aria-hidden="true"></i>
                            <?php echo e($menu->is_available ? 'Tersedia' : 'Habis'); ?>

                        </span>
                    </div>

                    <h1 class="menu-detail-title"><?php echo e($menu->name); ?></h1>
                    <div class="menu-detail-divider"></div>
                    <p class="menu-detail-description mb-0"><?php echo e($menu->description); ?></p>

                    <div class="menu-detail-price-box">
                        <span class="text-muted small">Harga Menu</span>
                        <strong class="menu-detail-price">Rp. <?php echo e(number_format($menu->price, 0, ',', '.')); ?></strong>
                    </div>

                    <a href="<?php echo e(route('branding.menu.category', $menu->category)); ?>" class="btn btn-menu-detail w-100 mt-4">
                        Lihat Menu <?php echo e(ucfirst($menu->category)); ?> Lainnya
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/pages/menu-detail.blade.php ENDPATH**/ ?>