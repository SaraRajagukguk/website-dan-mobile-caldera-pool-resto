<!-- HEADER UTAMA -->
<header>
    <!-- BARIS 1: BRANDING (Navy) -->
    <div style="background-color: #1c3451; padding: 20px 0;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo/Judul -->
                <div class="col-6 col-md-5">
                    <a href="<?php echo e(route('branding.home')); ?>" style="text-decoration: none;">
                        <div style="font-family: 'Playfair Display', serif; color: #c1a067; line-height: 1.2; font-weight: 700; font-size: 1.6rem;">
                            Caldera Resto<br>& Pool
                        </div>
                    </a>
                </div>
                
                <!-- Search + Auth + Notifikasi -->
                <div class="col-6 col-md-7 d-flex align-items-center justify-content-end gap-2">

                    <?php if(auth()->guard()->check()): ?>
                        <!-- 🔥 NOTIFIKASI BELL ICON 🔥 -->
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle position-relative" 
                               style="background: rgba(255,255,255,0.15); color: #c1a067; border: 1px solid rgba(193,160,103,0.5); font-size: 13px; border-radius: 20px; padding: 6px 12px;"
                               data-bs-toggle="dropdown" id="notificationBell">
                                <i class="fas fa-bell"></i>
                                <span id="notificationBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                                      style="font-size: 9px; padding: 2px 5px; margin-top: -2px; display: none;">
                                    0
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow border-0 notification-dropdown" 
                                 style="border-radius: 12px; min-width: 350px; padding: 0; margin-top: 8px;">
                                <div class="dropdown-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom" style="background: #fff;">
                                    <span class="fw-bold" style="font-size: 14px; color: #1c3451;">
                                        <i class="fas fa-bell me-2" style="color: #c1a067;"></i>Notifikasi
                                    </span>
                                    <button type="button" id="markAllReadBtn" class="btn btn-sm btn-link p-0" style="font-size: 11px; color: #c1a067; text-decoration: none;">
                                        Tandai semua dibaca
                                    </button>
                                </div>
                                <div id="notificationList" style="max-height: 400px; overflow-y: auto;">
                                    <div class="text-center py-3">
                                        <div class="spinner-border spinner-border-sm text-muted" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top text-center py-2" id="notificationFooter" style="display: none;">
                                    <a href="<?php echo e(route('notifications.index')); ?>" class="small" style="color: #c1a067; text-decoration: none;">
                                        Lihat semua notifikasi <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle"
                               style="background: rgba(255,255,255,0.15); color: #c1a067; border: 1px solid rgba(193,160,103,0.5); font-size: 13px; border-radius: 20px; padding: 6px 14px;"
                               data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i><?php echo e(Auth::user()->name); ?>

                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" 
                                style="border-radius: 12px; min-width: 200px; padding: 8px; margin-top: 8px;">
                                <li>
                                    <a class="dropdown-item caldera-dropdown-item" href="<?php echo e(route('customer.profile')); ?>">
                                        <i class="fas fa-user me-2" style="color: #c1a067; width: 16px;"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item caldera-dropdown-item" href="<?php echo e(route('customer.reservations')); ?>">
                                        <i class="fas fa-calendar me-2" style="color: #c1a067; width: 16px;"></i>Reservasi Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item caldera-dropdown-item" href="<?php echo e(route('customer.tickets')); ?>">
                                        <i class="fas fa-ticket-alt me-2" style="color: #c1a067; width: 16px;"></i>Tiket Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" style="border-color: #f0ebe0; margin: 6px 0;"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item caldera-dropdown-item-danger">
                                            <i class="fas fa-sign-out-alt me-2" style="width: 16px;"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-sm"
                           style="background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.3); font-size: 13px; border-radius: 20px; padding: 6px 14px;">
                            Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-sm"
                           style="background: #c1a067; color: white; border: none; font-size: 13px; border-radius: 20px; padding: 6px 14px;">
                            Daftar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS 2: NAVIGASI (Putih) -->
    <div style="background: #ffffff; border-bottom: 1px solid #e5e7eb; box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
        <div class="container">
            <!-- Desktop Nav -->
            <div class="d-none d-lg-flex align-items-center">
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.home') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.home')); ?>">
                    <i class="fas fa-home me-1"></i>Home
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.about') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.about')); ?>">
                    <i class="fas fa-mug-hot me-1"></i>About Us
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.pool*') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.pool')); ?>">
                    <i class="fas fa-swimmer me-1"></i>Pool
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('reservation.table*') ? 'active' : ''); ?>"
                   href="<?php echo e(route('reservation.table')); ?>">
                    <i class="fas fa-chair me-1"></i>Book a Table
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.promos*') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.promos')); ?>">
                    <i class="fas fa-bullhorn me-1"></i>Promo
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.gallery*') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.gallery')); ?>">
                    <i class="fas fa-image me-1"></i>Gallery
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.menu*') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.menu')); ?>">
                    <i class="fas fa-utensils me-1"></i>Menu
                </a>
                <a class="nav-custom-link <?php echo e(request()->routeIs('branding.testimonials*') ? 'active' : ''); ?>"
                   href="<?php echo e(route('branding.testimonials')); ?>">
                    <i class="fas fa-comments me-1"></i>Testimony
                </a>
            </div>

            <!-- Mobile Nav Toggle -->
            <div class="d-flex d-lg-none align-items-center py-2">
                <button class="btn border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                    <i class="fas fa-bars text-dark"></i>
                </button>
            </div>

            <!-- Mobile Nav Dropdown -->
            <div class="collapse d-lg-none" id="mobileNav">
                <div class="py-2 d-flex flex-column">
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.home') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.home')); ?>"><i class="fas fa-home me-2"></i>Home</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.about') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.about')); ?>"><i class="fas fa-mug-hot me-2"></i>About Us</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.pool*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.pool')); ?>"><i class="fas fa-swimmer me-2"></i>Pool</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.promos*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.promos')); ?>"><i class="fas fa-bullhorn me-2"></i>Promo</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.gallery*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.gallery')); ?>"><i class="fas fa-image me-2"></i>Gallery</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.menu*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.menu')); ?>"><i class="fas fa-utensils me-2"></i>Menu</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('reservation.table*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('reservation.table')); ?>"><i class="fas fa-chair me-2"></i>Reservasi Meja</a>
                    <a class="nav-custom-link-mobile <?php echo e(request()->routeIs('branding.testimonials*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('branding.testimonials')); ?>"><i class="fas fa-comments me-2"></i>Testimoni</a>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

header {
    position: sticky;
    top: 0;
    z-index: 1030;
    width: 100%;
    background: #fff;
}

.nav-custom-link {
    color: #4a5568;
    font-weight: 500;
    font-size: 0.88rem;
    padding: 1rem 1.1rem;
    border-bottom: 3px solid transparent;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
    transition: all 0.2s;
}

.nav-custom-link:hover,
.nav-custom-link.active {
    color: #1c3451;
    border-bottom: 3px solid #c1a067;
}

.nav-custom-link-mobile {
    color: #4a5568;
    font-weight: 500;
    font-size: 0.9rem;
    padding: 10px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    border-radius: 6px;
    transition: background 0.2s;
}

.nav-custom-link-mobile:hover,
.nav-custom-link-mobile.active {
    background: #f3f4f6;
    color: #1c3451;
}

.caldera-dropdown-item {
    color: #1c3451;
    font-size: 14px;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 14px;
    transition: all 0.15s;
}

.caldera-dropdown-item:hover {
    background: #f0ebe0;
    color: #1c3451;
}

.caldera-dropdown-item-danger {
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    color: #dc2626;
    font-size: 14px;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 14px;
    transition: all 0.15s;
}

.caldera-dropdown-item-danger:hover {
    background: #fef2f2;
    color: #dc2626;
}

/* Dropdown Notifikasi */
.notification-dropdown {
    width: 380px;
    max-height: 500px;
    border-radius: 12px;
    padding: 0;
}

.notification-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0ebe0;
    transition: background 0.2s;
    text-decoration: none;
    display: block;
}

.notification-item:hover {
    background: #f9f7f3;
    cursor: pointer;
}

.notification-item.unread {
    background: #f0ebe0;
}

.notification-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.notification-icon.primary {
    background: #e6f0ff;
    color: #1c3451;
}

.notification-icon.success {
    background: #e6f7e6;
    color: #2e7d32;
}

.notification-icon.danger {
    background: #ffe6e6;
    color: #dc2626;
}

.notification-icon.warning {
    background: #fff3e6;
    color: #ed6c02;
}

.notification-icon.info {
    background: #e6f7ff;
    color: #0288d1;
}

.notification-title {
    font-weight: 600;
    font-size: 13px;
    color: #1c3451;
    margin-bottom: 4px;
}

.notification-body {
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 4px;
    line-height: 1.4;
}

.notification-time {
    font-size: 10px;
    color: #9ca3af;
}

.btn-outline-caldera {
    border: 1px solid #c1a067;
    color: #c1a067;
    background: transparent;
    border-radius: 6px;
    font-size: 11px;
    padding: 3px 8px;
    transition: all 0.2s;
    text-decoration: none;
}

.btn-outline-caldera:hover {
    background: #c1a067;
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .notification-dropdown {
        width: 95vw;
        right: -50px;
    }
}

/* Dark Mode */
body.dark-mode .notification-item:hover {
    background: #2d2d3a;
}

body.dark-mode .notification-item.unread {
    background: #2a2a3a;
}

body.dark-mode .btn-outline-caldera {
    border-color: #c1a067;
    color: #c1a067;
}

body.dark-mode .btn-outline-caldera:hover {
    background: #c1a067;
    color: #1c3451;
}

body.dark-mode .caldera-dropdown-item:hover {
    background: #2d2d3a;
}
</style>

<script>
const csrfToken = '<?php echo e(csrf_token()); ?>';

function getTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffMinutes = Math.floor((now - date) / 60000);
    
    if (diffMinutes < 1) return 'Baru saja';
    if (diffMinutes < 60) return `${diffMinutes} menit lalu`;
    if (diffMinutes < 1440) return `${Math.floor(diffMinutes / 60)} jam lalu`;
    return `${Math.floor(diffMinutes / 1440)} hari lalu`;
}

function buildNotificationHtml(notif) {
    const unreadClass = notif.read_at ? '' : 'unread';
    let detailUrl = '#';
    
    if (notif.booking_code) {
        detailUrl = `/reservation/table/view/${notif.booking_code}`;
    } else if (notif.ticket_code) {
        detailUrl = `/reservation/ticket/view/${notif.ticket_code}`;
    } else if (notif.url) {
        detailUrl = notif.url;
    }
    
    const colorClass = notif.color || 'primary';
    const icon = notif.icon || 'fa-bell';
    const title = notif.title || 'Notifikasi';
    const body = notif.body || '';
    const timeAgo = notif.created_at || 'Baru saja';
    
    return `
        <div class="notification-item ${unreadClass}" data-id="${notif.id}">
            <div class="d-flex">
                <div class="me-3">
                    <div class="notification-icon ${colorClass}">
                        <i class="fas ${icon}"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="notification-title">${escapeHtml(title)}</div>
                    <div class="notification-body">${escapeHtml(body)}</div>
                    <div class="notification-time">${escapeHtml(timeAgo)}</div>
                    <div class="mt-2 d-flex flex-wrap gap-2 align-items-center">
                        <a href="${detailUrl}" class="btn-outline-caldera">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                        </a>
                        ${!notif.read_at ? `
                            <button onclick="markAsRead('${notif.id}')" class="btn btn-sm btn-link p-0" style="color: #c1a067; font-size: 11px;">
                                <i class="fas fa-check-circle"></i> Tandai Dibaca
                            </button>
                        ` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function loadNotifications() {
    fetch('<?php echo e(route("notifications.latest")); ?>')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notificationBadge');
            const list = document.getElementById('notificationList');
            const footer = document.getElementById('notificationFooter');
            
            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count > 99 ? '99+' : data.count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            }
            
            if (list && data.notifications && data.notifications.length > 0) {
                let html = '';
                data.notifications.forEach((notif, index) => {
                    html += buildNotificationHtml(notif);
                    if (index < data.notifications.length - 1) {
                        html += '<div class="dropdown-divider m-0"></div>';
                    }
                });
                list.innerHTML = html;
                if (footer) footer.style.display = 'block';
            } else if (list) {
                list.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-bell-slash text-muted mb-2" style="font-size: 32px;"></i>
                        <p class="text-muted mb-0" style="font-size: 13px;">Belum ada notifikasi</p>
                    </div>
                `;
                if (footer) footer.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error loading notifications:', error);
            const list = document.getElementById('notificationList');
            if (list) {
                list.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-danger mb-2" style="font-size: 32px;"></i>
                        <p class="text-muted mb-0" style="font-size: 13px;">Gagal memuat notifikasi</p>
                    </div>
                `;
            }
        });
}

function markAsRead(id) {
    fetch(`/notifications/${id}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadNotifications();
        }
    })
    .catch(error => console.error('Error:', error));
}

function markAllAsRead() {
    fetch('<?php echo e(route("notifications.mark-all-read")); ?>', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadNotifications();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Load notifikasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();
    
    // Refresh setiap 30 detik
    setInterval(loadNotifications, 30000);
    
    // Event listener untuk tombol "Tandai semua dibaca"
    const markAllBtn = document.getElementById('markAllReadBtn');
    if (markAllBtn) {
        markAllBtn.addEventListener('click', markAllAsRead);
    }
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                window.location.href = '<?php echo e(route("branding.menu")); ?>?search=' + encodeURIComponent(this.value);
            }
        });
    }
});
</script><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/components/navbar.blade.php ENDPATH**/ ?>