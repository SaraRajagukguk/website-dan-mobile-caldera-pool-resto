<?php $__env->startSection('title', 'Menu Management'); ?>

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
        background: rgba(193, 160, 103, 0.2);
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

    .btn-add-menu {
        background: #c1a067;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-add-menu:hover {
        background: #d3b583;
        color: #fff;
    }

    .report-main-card {
        border: none;
        border-radius: 16px;
        border-top: 3px solid #c1a067 !important;
        box-shadow: 0 4px 20px rgba(28, 52, 81, 0.08);
    }

    .report-main-card .card-body {
        padding: 24px;
    }

    .filter-section {
        background: #f8fafc;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 24px;
        border: 1px solid #e8edf2;
    }

    .filter-section .form-control,
    .filter-section .form-select {
        border-radius: 10px;
        border: 1px solid #dde2e8;
        font-size: 13px;
        padding: 8px 13px;
        color: #1c3451;
    }

    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: #c1a067;
        box-shadow: 0 0 0 3px rgba(193, 160, 103, 0.15);
    }

    .report-table thead th {
        background: #1c3451;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 12px 14px;
        border: none;
    }

    .report-table thead th:first-child {
        border-radius: 10px 0 0 0;
    }

    .report-table thead th:last-child {
        border-radius: 0 10px 0 0;
    }

    .report-table tbody tr {
        transition: background 0.15s;
    }

    .report-table tbody tr:hover {
        background: #f8fafc;
    }

    .report-table tbody td {
        font-size: 13px;
        color: #374151;
        padding: 12px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    .report-table tbody td.fw-bold {
        color: #1c3451;
    }

    .badge-category {
        background: #eef2ff;
        color: #1c3451;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-recommended-yes {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
    }

    .badge-recommended-no {
        background: #f9fafb;
        color: #6b7280;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
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
        transition: all 0.2s;
        padding: 0;
    }

    .btn-action-view {
        background: #1c3451;
        color: #fff;
    }

    .btn-action-view:hover {
        background: #c1a067;
        color: #fff;
    }

    .btn-action-edit {
        background: #eef2ff;
        color: #1c3451;
    }

    .btn-action-edit:hover {
        background: #1c3451;
        color: #fff;
    }

    .btn-action-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-action-delete:hover {
        background: #dc2626;
        color: #fff;
    }

    .btn-action-warning {
        background: #fff7ed;
        color: #ea580c;
    }

    .btn-action-warning:hover {
        background: #ea580c;
        color: #fff;
    }

    .btn-action-success {
        background: #f0fdf4;
        color: #15803d;
    }

    .btn-action-success:hover {
        background: #15803d;
        color: #fff;
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
            <i class="fas fa-utensils"></i>
        </div>
        <h6>Daftar Menu</h6>
    </div>
    <a href="<?php echo e(route('admin.menus.create')); ?>" class="btn btn-add-menu">
        <i class="fas fa-plus me-1"></i> Tambah Menu
    </a>
</div>

<div class="card report-main-card">
    <div class="card-body">
        <div class="filter-section">
            <form method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($cat)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama menu..."
                            value="<?php echo e(request('search')); ?>"
                            onchange="this.form.submit()"
                        >
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table report-table align-middle">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Rekomendasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php if($menu->image && Storage::disk('public')->exists($menu->image)): ?>
                                <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" 
                                     width="52" height="52"
                                     style="object-fit: cover; border-radius: 10px; border: 2px solid #e8e0d0;"
                                     onerror="this.onerror=null; this.src='https://placehold.co/52x52/e8e0d0/c1a067?text=No+Image';">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center"
                                     style="width: 52px; height: 52px; border-radius: 10px; background: #f0ebe0;">
                                    <i class="fas fa-utensils" style="color: #c1a067;"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="fw-bold" style="color: #1c3451;"><?php echo e($menu->name); ?></td>
                        <td>
                            <span class="badge-category"><?php echo e(ucfirst($menu->category)); ?></span>
                        </td>
                        <td class="fw-semibold" style="color: #c1a067;">
                            Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?>

                        </td>
                        <td><?php echo $menu->status_label; ?></td>
                        <td>
                            <?php if($menu->is_recommended): ?>
                                <span class="badge-recommended-yes">Ya</span>
                            <?php else: ?>
                                <span class="badge-recommended-no">Tidak</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('admin.menus.show', $menu)); ?>" class="btn btn-action btn-action-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.menus.edit', $menu)); ?>" class="btn btn-action btn-action-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.menus.destroy', $menu)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-action btn-action-delete" title="Hapus"
                                            onclick="return confirm('Yakin hapus menu ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <button onclick="toggleAvailability(<?php echo e($menu->id); ?>)"
                                        class="btn btn-action <?php echo e($menu->is_available ? 'btn-action-warning' : 'btn-action-success'); ?>"
                                        title="<?php echo e($menu->is_available ? 'Nonaktifkan' : 'Aktifkan'); ?>">
                                    <i class="fas <?php echo e($menu->is_available ? 'fa-times' : 'fa-check'); ?>"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-utensils fa-3x mb-3 d-block" style="color: #c1a067; opacity: 0.4;"></i>
                            <span class="text-muted">Belum ada data menu</span>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <?php echo e($menus->withQueryString()->links('vendor.pagination.admin')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function toggleAvailability(id) {
        fetch(`/admin/menus/${id}/toggle-availability`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json()).then(data => {
            if(data.success) location.reload();
        }).catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan, silakan refresh halaman dan coba lagi.');
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/admin/menus/index.blade.php ENDPATH**/ ?>