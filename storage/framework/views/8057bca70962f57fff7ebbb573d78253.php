<?php $__env->startSection('title', 'Gallery'); ?>

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

    .report-page-header .header-icon i { color: #c1a067; font-size: 18px; }

    .btn-add {
        background: linear-gradient(135deg, #c1a067, #a98750);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 18px;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(193,160,103,0.35);
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #d4b47a, #c1a067);
        color: #fff;
        transform: translateY(-1px);
    }

    .filter-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(28,52,81,0.06);
        margin-bottom: 20px;
    }

    .filter-card .card-body { padding: 16px 20px; }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dde2e8;
        font-size: 13px;
        padding: 8px 12px;
        color: #1c3451;
    }

    .form-control:focus, .form-select:focus {
        border-color: #c1a067;
        box-shadow: 0 0 0 3px rgba(193,160,103,0.15);
    }

    .btn-filter {
        background: #1c3451;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 18px;
    }

    .btn-filter:hover { background: #2a4a6b; color: #fff; }

    .btn-reset {
        background: #f1f5f9;
        color: #1c3451;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 14px;
        text-decoration: none;
    }

    .btn-reset:hover { background: #e2e8f0; color: #1c3451; }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }

    .gallery-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(28,52,81,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
    }

    .gallery-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(28,52,81,0.14);
    }

    .gallery-thumb {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
    }

    .gallery-thumb-video {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
        background: #1c3451;
    }

    .gallery-video-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -70%);
        width: 44px;
        height: 44px;
        background: rgba(255,255,255,0.85);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .gallery-video-icon i { color: #1c3451; font-size: 16px; }

    .gallery-card-body { padding: 12px 14px; }

    .gallery-title {
        font-size: 13px;
        font-weight: 700;
        color: #1c3451;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .gallery-meta {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 8px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge-type {
        font-size: 10px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 6px;
        background: #e0e7ef;
        color: #1c3451;
    }

    .badge-featured {
        font-size: 10px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 6px;
        background: #fef3c7;
        color: #92400e;
    }

    .gallery-actions {
        display: flex;
        gap: 6px;
    }

    .btn-action {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.15s;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-action.edit   { background: #e0e7ef; color: #1c3451; }
    .btn-action.delete { background: #fee2e2; color: #dc2626; }
    .btn-action.star   { background: #fef3c7; color: #d97706; }

    .btn-action:hover { opacity: 0.85; transform: scale(1.05); }

    .btn-action.star.active { background: #f59e0b; color: #fff; }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }

    .empty-state i { font-size: 48px; margin-bottom: 12px; opacity: 0.4; }
    .empty-state p { font-size: 14px; margin: 0; }

    .alert-success {
        border-radius: 12px;
        font-size: 13px;
        border: none;
        background: #d1fae5;
        color: #065f46;
        padding: 12px 16px;
        margin-bottom: 16px;
    }

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
            <i class="fas fa-images"></i>
        </div>
        <h6>Gallery</h6>
    </div>
    <a href="<?php echo e(route('admin.galleries.create')); ?>" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Gallery
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<div class="card filter-card">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('admin.galleries.index')); ?>" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari judul…" value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">Semua Tipe</option>
                    <option value="image" <?php echo e(request('type') === 'image' ? 'selected' : ''); ?>>Gambar</option>
                    <option value="video" <?php echo e(request('type') === 'video' ? 'selected' : ''); ?>>Video</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat); ?>" <?php echo e(request('category') === $cat ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst($cat)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="is_featured" class="form-select">
                    <option value="">Semua</option>
                    <option value="1" <?php echo e(request('is_featured') === '1' ? 'selected' : ''); ?>>Featured</option>
                    <option value="0" <?php echo e(request('is_featured') === '0' ? 'selected' : ''); ?>>Non-Featured</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn-filter w-100">
                    <i class="fas fa-search"></i>
                </button>
                <a href="<?php echo e(route('admin.galleries.index')); ?>" class="btn-reset">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>


<?php if($galleries->isEmpty()): ?>
    <div class="empty-state">
        <i class="fas fa-images d-block"></i>
        <p>Belum ada item gallery.</p>
    </div>
<?php else: ?>
    <div class="gallery-grid">
        <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card gallery-card">
            
            <?php if($item->type === 'image'): ?>
                <img src="<?php echo e(asset('storage/' . $item->file_path)); ?>" alt="<?php echo e($item->title); ?>" class="gallery-thumb">
            <?php else: ?>
                <div class="position-relative">
                    <video class="gallery-thumb-video" muted>
                        <source src="<?php echo e(asset('storage/' . $item->file_path)); ?>">
                    </video>
                    <div class="gallery-video-icon">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
            <?php endif; ?>

            <div class="gallery-card-body">
                <div class="gallery-title" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></div>
                <div class="gallery-meta">
                    <span class="badge-type"><?php echo e($item->type_label); ?></span>
                    <?php if($item->is_featured): ?>
                        <span class="badge-featured"><i class="fas fa-star" style="font-size:9px"></i> Featured</span>
                    <?php endif; ?>
                    <?php if($item->category): ?>
                        <span><?php echo e(ucfirst($item->category)); ?></span>
                    <?php endif; ?>
                </div>
                <div class="gallery-actions">
                    
                    <button class="btn-action star <?php echo e($item->is_featured ? 'active' : ''); ?>"
                            data-id="<?php echo e($item->id); ?>"
                            title="<?php echo e($item->is_featured ? 'Hapus featured' : 'Jadikan featured'); ?>"
                            onclick="toggleFeatured(this)">
                        <i class="fas fa-star"></i>
                    </button>

                    
                    <a href="<?php echo e(route('admin.galleries.edit', $item)); ?>" class="btn-action edit" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>

                    
                    <form action="<?php echo e(route('admin.galleries.destroy', $item)); ?>" method="POST"
                          onsubmit="return confirm('Hapus item ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-action delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mt-4">
    <?php echo e($galleries->withQueryString()->links('vendor.pagination.admin')); ?>

    </div>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleFeatured(btn) {
    const id = btn.dataset.id;

    fetch(`/admin/galleries/${id}/toggle-featured`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.classList.toggle('active', data.is_featured);
            btn.title = data.is_featured ? 'Hapus featured' : 'Jadikan featured';

            // Refresh badge di card yang sama
            const card   = btn.closest('.gallery-card-body');
            const oldBadge = card.querySelector('.badge-featured');

            if (data.is_featured && !oldBadge) {
                const meta  = card.querySelector('.gallery-meta');
                const badge = document.createElement('span');
                badge.className   = 'badge-featured';
                badge.innerHTML   = '<i class="fas fa-star" style="font-size:9px"></i> Featured';
                meta.appendChild(badge);
            } else if (!data.is_featured && oldBadge) {
                oldBadge.remove();
            }
        }
    })
    .catch(err => console.error(err));
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/admin/galleries/index.blade.php ENDPATH**/ ?>