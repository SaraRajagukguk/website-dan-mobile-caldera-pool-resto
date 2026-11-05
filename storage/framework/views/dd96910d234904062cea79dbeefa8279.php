<?php $__env->startSection('title', 'Reservation Details - Caldera'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-2" style="font-family: 'Playfair Display', serif; color: #1c3451;">Reservation Details</h1>
        <div class="section-divider"></div>
        <p class="lead text-muted">Booking Code: <strong style="color: #c1a067;"><?php echo e($reservation->booking_code); ?></strong></p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm caldera-card">
                <div class="card-body p-4 p-md-5">

                    <!-- Status Badges -->
                    <div class="text-center mb-4">
                        <?php
                            $statusClass = match($reservation->status) {
                                'confirmed'  => 'status-confirmed',
                                'pending'    => 'status-pending',
                                'cancelled'  => 'status-cancelled',
                                'completed'  => 'status-completed',
                                default      => 'status-default'
                            };
                            $statusText = match($reservation->status) {
                                'confirmed'  => 'Dikonfirmasi',
                                'pending'    => 'Menunggu Konfirmasi',
                                'cancelled'  => 'Dibatalkan',
                                'completed'  => 'Selesai',
                                default      => ucfirst($reservation->status)
                            };
                            $statusIcon = match($reservation->status) {
                                'confirmed'  => 'fa-check-circle',
                                'pending'    => 'fa-clock',
                                'cancelled'  => 'fa-times-circle',
                                'completed'  => 'fa-check-double',
                                default      => 'fa-info-circle'
                            };
                        ?>
                        <span class="status-badge <?php echo e($statusClass); ?> me-2">
                            <i class="fas <?php echo e($statusIcon); ?> me-1"></i> <?php echo e($statusText); ?>

                        </span>

                        <?php if($reservation->payment_status == 'waiting_payment'): ?>
                            <span class="status-badge status-cancelled">
                                <i class="fas fa-times-circle me-1"></i> Belum Bayar
                            </span>
                        <?php elseif($reservation->payment_status == 'partial'): ?>
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock me-1"></i> DP Dibayar
                            </span>
                        <?php else: ?>
                            <span class="status-badge status-confirmed">
                                <i class="fas fa-check-circle me-1"></i> Lunas
                            </span>
                        <?php endif; ?>
                    </div>  

                    <hr style="border-color: #f0ebe0;">

                    <!-- Info Grid -->
                    <div class="row g-4 mb-4">
                        <!-- Informasi Customer -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h6 class="info-section-title">
                                    <i class="fas fa-user me-2" style="color: #c1a067;"></i> Informasi Customer
                                </h6>
                                <div class="info-item">
                                    <small class="text-muted text-uppercase fw-semibold">Nama</small>
                                    <p class="fw-semibold mb-0" style="color: #1c3451;"><?php echo e($reservation->customer_name); ?></p>
                                </div>
                                <div class="info-item">
                                    <small class="text-muted text-uppercase fw-semibold">Telepon</small>
                                    <p class="fw-semibold mb-0" style="color: #1c3451;"><?php echo e($reservation->customer_phone); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Reservasi -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h6 class="info-section-title">
                                    <i class="fas fa-calendar-alt me-2" style="color: #c1a067;"></i> Informasi Reservasi
                                </h6>
                                <div class="info-item">
                                    <small class="text-muted text-uppercase fw-semibold">Tanggal</small>
                                    <p class="fw-semibold mb-0" style="color: #1c3451;">
                                        <?php echo e(\Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y')); ?>

                                    </p>
                                </div>
                                <div class="info-item">
                                    <small class="text-muted text-uppercase fw-semibold">Jam</small>
                                    <p class="fw-semibold mb-0" style="color: #1c3451;"><?php echo e($reservation->reservation_time); ?></p>
                                </div>
                                <div class="info-item">
                                    <small class="text-muted text-uppercase fw-semibold">Jumlah Tamu</small>
                                    <p class="fw-semibold mb-0" style="color: #1c3451;">
                                        <i class="fas fa-users me-1" style="color: #c1a067;"></i>
                                        <?php echo e($reservation->number_of_guests); ?> orang
                                    </p>
                                </div>
                                <?php if($reservation->special_requests): ?>
                                <div class="info-item">
                                    <small class="text-muted text-uppercase fw-semibold">Special Request</small>
                                    <p class="fw-semibold mb-0" style="color: #1c3451;"><?php echo e($reservation->special_requests); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- DP Info -->
                    <div class="dp-info-box mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <?php if($reservation->payment_status == 'waiting_payment'): ?>
                                <small class="text-muted text-uppercase fw-semibold">DP yang Harus Dibayar</small>
                                <p class="fw-bold mb-0 mt-1" style="color: #c62828; font-size: 1.3rem;">
                                    Rp <?php echo e(number_format($reservation->down_payment, 0, ',', '.')); ?>

                                </p>
                                <small style="color: #c62828;">
                                    <i class="fas fa-times-circle me-1"></i> Belum Dibayar
                                </small>
                                <?php elseif($reservation->payment_status == 'partial'): ?>
                                <small class="text-muted text-uppercase fw-semibold">DP yang Sudah Dibayar</small>
                                <p class="fw-bold mb-0 mt-1" style="color: #e65100; font-size: 1.3rem;">
                                    Rp <?php echo e(number_format($reservation->down_payment, 0, ',', '.')); ?>

                                </p>
                                <small style="color: #e65100;">
                                    <i class="fas fa-hourglass-half me-1"></i> Menunggu Verifikasi
                                </small>
                                <?php else: ?>
                                <small class="text-muted text-uppercase fw-semibold">Total Pembayaran</small>
                                <p class="fw-bold mb-0 mt-1" style="color: #2e7d32; font-size: 1.3rem;">
                                    Rp <?php echo e(number_format($reservation->down_payment, 0, ',', '.')); ?>

                                </p>
                                <small style="color: #2e7d32;">
                                    <i class="fas fa-check-circle me-1"></i> Lunas
                                </small>
                                <?php endif; ?>
                            </div>
                            <i class="fas fa-receipt fa-2x" style="color: #c1a067; opacity: 0.5;"></i>
                        </div>
                    </div>

                    <?php if($reservation->status == 'pending' && $reservation->payment_status == 'waiting_payment'): ?>
                    <div class="caldera-alert caldera-alert-warning mb-4">
                        <i class="fas fa-clock me-2"></i>
                        Reservasi Anda sedang menunggu konfirmasi. Silakan lakukan pembayaran DP untuk mengkonfirmasi reservasi.
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                        <button type="button" class="btn btn-action-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
                            <i class="fas fa-upload me-2"></i> Upload Bukti Pembayaran
                        </button>
                        <button type="button" class="btn btn-action-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                            <i class="fas fa-times me-2"></i> Batalkan Reservasi
                        </button>
                    </div>

                    <?php elseif($reservation->status == 'pending' && $reservation->payment_status == 'partial'): ?>
                    <div class="caldera-alert caldera-alert-warning mb-4">
                        <i class="fas fa-hourglass-half me-2"></i>
                        Bukti pembayaran DP Anda sedang diverifikasi oleh admin. Mohon tunggu konfirmasi.
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                        <button type="button" class="btn btn-action-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                            <i class="fas fa-times me-2"></i> Batalkan Reservasi
                        </button>
                    </div>

                    <?php elseif($reservation->status == 'confirmed' && $reservation->payment_status == 'partial'): ?>
                    <div class="caldera-alert caldera-alert-warning mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        Reservasi dikonfirmasi. Silakan selesaikan sisa pembayaran Anda.
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                        <button type="button" class="btn btn-action-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
                            <i class="fas fa-upload me-2"></i> Upload Sisa Pembayaran
                        </button>
                    </div>

                    <?php elseif($reservation->status == 'confirmed' && $reservation->payment_status != 'waiting_payment' && $reservation->payment_status != 'partial'): ?>
                    <div class="caldera-alert caldera-alert-success mb-4">
                        <i class="fas fa-check-double me-2"></i>
                        Reservasi Anda telah dikonfirmasi dan pembayaran telah lunas. Sampai jumpa di Caldera!
                    </div>

                    <?php elseif($reservation->status == 'completed'): ?>
                    <div class="caldera-alert caldera-alert-info mb-4">
                        <i class="fas fa-check-double me-2"></i>
                        Reservasi ini telah selesai. Terima kasih telah mengunjungi Caldera!
                    </div>

                    <?php elseif($reservation->status == 'cancelled'): ?>
                    <div class="caldera-alert caldera-alert-danger mb-4">
                        <i class="fas fa-times-circle me-2"></i>
                        Reservasi ini telah dibatalkan.
                    </div>
                    <?php endif; ?>

                    <!-- Alert Cancellation -->
                    <?php if($reservation->cancellation_reason): ?>
                    <div class="caldera-alert caldera-alert-danger mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Alasan Pembatalan:</strong> <?php echo e($reservation->cancellation_reason); ?>

                    </div>
                    <?php endif; ?>

                    <hr style="border-color: #f0ebe0;">

                    <!-- Back Button -->
                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('customer.reservations')); ?>" class="btn btn-back">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Reservasi Saya
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content caldera-modal">
            <div class="modal-header caldera-modal-header">
                <h5 class="modal-title fw-bold" style="color: #1c3451;">
                    <i class="fas fa-upload me-2" style="color: #c1a067;"></i> Upload Bukti Pembayaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('reservation.payment.upload')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="booking_code" value="<?php echo e($reservation->booking_code); ?>">
                <input type="hidden" name="amount" value="<?php echo e($reservation->down_payment); ?>">
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: #1c3451;">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control caldera-input" required>
                            <option value="transfer">Transfer Bank</option>
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #1c3451;">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" class="form-control caldera-input" accept="image/*" required>
                        <small class="text-muted mt-1 d-block">
                            <i class="fas fa-info-circle me-1" style="color: #c1a067;"></i>
                            Format: JPG, PNG, PDF. Max 2MB
                        </small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-modal-submit">
                        <i class="fas fa-upload me-2"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Batalkan Reservasi -->
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content caldera-modal">
            <div class="modal-header caldera-modal-header">
                <h5 class="modal-title fw-bold" style="color: #1c3451;">
                    <i class="fas fa-times-circle me-2" style="color: #dc2626;"></i> Batalkan Reservasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('reservation.table.cancel', $reservation->booking_code)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: #1c3451;">Alasan Pembatalan</label>
                        <textarea name="reason" class="form-control caldera-input" rows="3"
                                  placeholder="Tuliskan alasan pembatalan..." required></textarea>
                    </div>
                    <div class="caldera-alert caldera-alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Reservasi yang dibatalkan tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-modal-danger">
                        <i class="fas fa-times me-2"></i> Batalkan Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

    .section-divider {
        width: 50px;
        height: 3px;
        background: #c1a067;
        margin: 12px auto 16px;
        border-radius: 2px;
    }

    .caldera-card {
        border-radius: 20px !important;
        overflow: hidden;
        border-top: 3px solid #c1a067 !important;
        transition: transform 0.25s, box-shadow 0.25s;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-confirmed { background: #e8f5e9; color: #2e7d32; }
    .status-pending   { background: #fff3e0; color: #e65100; }
    .status-cancelled { background: #ffebee; color: #c62828; }
    .status-completed { background: #e3f2fd; color: #1565c0; }
    .status-default   { background: #f0ebe0; color: #1c3451; }

    /* Info Sections */
    .info-section {
        background: #fdfbf7;
        border: 1px solid #f0ebe0;
        border-radius: 14px;
        padding: 20px;
        height: 100%;
    }

    .info-section-title {
        font-weight: 700;
        color: #1c3451;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0ebe0;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-item {
        margin-bottom: 14px;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-item small {
        font-size: 11px;
        letter-spacing: 0.5px;
    }

    .info-item p {
        margin-top: 3px;
        font-size: 15px;
    }

    /* DP Info Box */
    .dp-info-box {
        background: linear-gradient(135deg, #f0ebe0, #fdfbf7);
        border: 1px solid #e8dcc8;
        border-radius: 14px;
        padding: 20px 24px;
    }

    /* Alerts */
    .caldera-alert {
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 14px;
        font-weight: 500;
    }

    .caldera-alert-warning {
        background: #fff8e1;
        color: #e65100;
        border: 1px solid #ffe0b2;
    }

    .caldera-alert-danger {
        background: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    .caldera-alert-success {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .caldera-alert-info {
        background: #e3f2fd;
        color: #1565c0;
        border: 1px solid #bbdefb;
    }

    /* Buttons */
    .btn-back {
        background: white;
        color: #1c3451;
        border: 1.5px solid #1c3451;
        border-radius: 12px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #1c3451;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(28,52,81,0.2);
    }

    .btn-action-primary {
        background: linear-gradient(135deg, #1c3451, #01516e);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-action-primary:hover {
        background: linear-gradient(135deg, #c1a067, #a8894f);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(193,160,103,0.3);
    }

    .btn-action-danger {
        background: white;
        color: #dc2626;
        border: 1.5px solid #dc2626;
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-action-danger:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220,38,38,0.2);
    }

    /* Modal */
    .caldera-modal {
        border-radius: 20px !important;
        overflow: hidden;
        border: none;
    }

    .caldera-modal-header {
        background: #fdfbf7;
        border-bottom: 1px solid #f0ebe0;
        padding: 20px 24px;
    }

    .caldera-input {
        border: 1.5px solid #e8e0d0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .caldera-input:focus {
        border-color: #c1a067;
        box-shadow: 0 0 0 3px rgba(193,160,103,0.15);
        outline: none;
    }

    .btn-modal-cancel {
        background: white;
        color: #6c757d;
        border: 1.5px solid #dee2e6;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-modal-cancel:hover {
        background: #f8f9fa;
        color: #1c3451;
        border-color: #1c3451;
    }

    .btn-modal-submit {
        background: linear-gradient(135deg, #1c3451, #01516e);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-modal-submit:hover {
        background: linear-gradient(135deg, #c1a067, #a8894f);
        color: white;
        transform: translateY(-1px);
    }

    .btn-modal-danger {
        background: #dc2626;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-modal-danger:hover {
        background: #b91c1c;
        color: white;
        transform: translateY(-1px);
    }

    /* Dark Mode */
    body.dark-mode .info-section {
        background: #1e1e2a;
        border-color: #2d2d3a;
    }

    body.dark-mode .info-section-title {
        color: #dce8f0;
        border-color: #2d2d3a;
    }

    body.dark-mode .info-item p {
        color: #dce8f0 !important;
    }

    body.dark-mode .dp-info-box {
        background: #1e1e2a;
        border-color: #2d2d3a;
    }

    body.dark-mode .dp-info-box p {
        color: #dce8f0 !important;
    }

    body.dark-mode .caldera-alert-warning {
        background: #2a1a0a;
        color: #ffb74d;
        border-color: #3a2a0a;
    }

    body.dark-mode .caldera-alert-danger {
        background: #2a0a0a;
        color: #ef9a9a;
        border-color: #3a1a1a;
    }

    body.dark-mode .caldera-alert-success {
        background: #0a2a0a;
        color: #81c784;
        border-color: #1a3a1a;
    }

    body.dark-mode .caldera-alert-info {
        background: #0a1a2a;
        color: #64b5f6;
        border-color: #1a2a3a;
    }

    body.dark-mode .btn-back {
        background: #1e1e2a;
        border-color: #c1a067;
        color: #c1a067;
    }

    body.dark-mode .btn-back:hover {
        background: #c1a067;
        color: #1c3451;
    }

    body.dark-mode .btn-action-danger {
        background: #1e1e2a;
        border-color: #ef9a9a;
        color: #ef9a9a;
    }

    body.dark-mode .btn-action-danger:hover {
        background: #dc2626;
        color: white;
        border-color: #dc2626;
    }

    body.dark-mode .caldera-modal {
        background: #1e1e2a;
    }

    body.dark-mode .caldera-modal-header {
        background: #242436;
        border-color: #2d2d3a;
    }

    body.dark-mode .caldera-modal-header .modal-title {
        color: #dce8f0 !important;
    }

    body.dark-mode .caldera-input {
        background: #242436;
        border-color: #2d2d3a;
        color: #dce8f0;
    }

    body.dark-mode .caldera-input:focus {
        border-color: #c1a067;
        background: #2d2d3a;
    }

    body.dark-mode .btn-modal-cancel {
        background: #242436;
        border-color: #2d2d3a;
        color: #b0b0b0;
    }

    body.dark-mode .btn-modal-cancel:hover {
        background: #2d2d3a;
        color: #dce8f0;
        border-color: #c1a067;
    }

    body.dark-mode .status-pending   { background: #2a1a0a; color: #ffb74d; }
    body.dark-mode .status-confirmed { background: #0a2a0a; color: #81c784; }
    body.dark-mode .status-cancelled { background: #2a0a0a; color: #ef9a9a; }
    body.dark-mode .status-completed { background: #0a1a2a; color: #64b5f6; }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/reservation/table/view.blade.php ENDPATH**/ ?>