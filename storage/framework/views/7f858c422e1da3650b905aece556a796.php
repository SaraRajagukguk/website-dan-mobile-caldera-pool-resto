<?php $__env->startSection('title', 'Write a Review - Caldera Resto & Pool'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-2" style="font-family: 'Playfair Display', serif; color: #1c3451;">Write a Review</h1>
        <div class="section-divider"></div>
        <p class="lead text-muted">Share your experience at Caldera Resto & Pool</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm caldera-card">
                <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                    <div class="text-center">
                        <i class="fas fa-star fa-2x mb-2" style="color: #c1a067;"></i>
                        <h4 class="fw-bold mb-1" style="color: #1c3451; font-family: 'Playfair Display', serif;">Your Feedback Matters</h4>
                        <p class="text-muted small">Help us improve by sharing your honest opinion</p>
                    </div>
                </div>
                
                <div class="card-body p-4 p-lg-5">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> Please fix the following errors:
                            <ul class="mb-0 mt-2">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo e(route('branding.testimonials.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #1c3451;">
                                    <i class="fas fa-user me-1" style="color: #c1a067;"></i> Your Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="customer_name" class="form-control caldera-input <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('customer_name', Auth::user()->name ?? '')); ?>" required>
                                <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #1c3451;">
                                    <i class="fas fa-tag me-1" style="color: #c1a067;"></i> Service Type
                                </label>
                                <select name="service_type" class="form-control caldera-input">
                                    <option value="">Select Service</option>
                                    <option value="restaurant" <?php echo e(old('service_type') == 'restaurant' ? 'selected' : ''); ?>>🍽️ Restaurant</option>
                                    <option value="pool" <?php echo e(old('service_type') == 'pool' ? 'selected' : ''); ?>>🏊 Pool</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #1c3451;">
                                    <i class="fas fa-calendar-day me-1" style="color: #c1a067;"></i> Visit Date
                                </label>
                                <input type="date" name="visit_date" class="form-control caldera-input" 
                                       value="<?php echo e(old('visit_date', date('Y-m-d'))); ?>" max="<?php echo e(date('Y-m-d')); ?>">
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="color: #1c3451;">
                                    <i class="fas fa-star me-1" style="color: #c1a067;"></i> Rating <span class="text-danger">*</span>
                                </label>
                                <div class="rating-input">
                                    <i class="far fa-star fa-2x" data-value="1"></i>
                                    <i class="far fa-star fa-2x" data-value="2"></i>
                                    <i class="far fa-star fa-2x" data-value="3"></i>
                                    <i class="far fa-star fa-2x" data-value="4"></i>
                                    <i class="far fa-star fa-2x" data-value="5"></i>
                                    <input type="hidden" name="rating" id="rating" value="<?php echo e(old('rating')); ?>" required>
                                </div>
                                <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="color: #1c3451;">
                                    <i class="fas fa-comment me-1" style="color: #c1a067;"></i> Your Review <span class="text-danger">*</span>
                                </label>
                                <textarea name="comment" class="form-control caldera-input <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          rows="5" placeholder="Tell us about your experience..." required><?php echo e(old('comment')); ?></textarea>
                                <small class="text-muted">Minimum 10 characters</small>
                                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3 justify-content-center mt-5">
                            <a href="<?php echo e(route('branding.testimonials')); ?>" class="btn btn-outline-custom px-4">
                                <i class="fas fa-arrow-left me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-submit px-5">
                                <i class="fas fa-paper-plane me-2"></i> Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mt-4 caldera-card">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-quote-left fa-2x mb-2" style="color: #c1a067; opacity: 0.5;"></i>
                    <p class="mb-0 text-muted">Your feedback helps us serve you better. Thank you for being part of the Caldera family!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap');

.display-4 {
    font-family: 'Playfair Display', serif;
    color: #1c3451;
}

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
    transition: transform 0.25s, box-shadow 0.25s;
}

.caldera-card:hover {
    box-shadow: 0 12px 28px rgba(28,52,81,0.12) !important;
}

.caldera-input {
    border: 1.5px solid #e8e0d0;
    border-radius: 12px;
    padding: 10px 16px;
    font-size: 14px;
    transition: all 0.2s;
    background: #fff;
}

.caldera-input:focus {
    border-color: #c1a067;
    box-shadow: 0 0 0 3px rgba(193,160,103,0.1);
    outline: none;
}

.caldera-input:hover:not(:focus) {
    border-color: #c1a067;
}

.rating-input i {
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 5px;
    color: #ddd;
}

.rating-input i:hover,
.rating-input i.active {
    color: #ffc107;
}

.rating-input i.fas {
    color: #ffc107;
}

.btn-outline-custom {
    background: white;
    color: #1c3451;
    border: 1.5px solid #1c3451;
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
}

.btn-outline-custom:hover {
    background: #1c3451;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(28,52,81,0.2);
}

.btn-submit {
    background: linear-gradient(135deg, #1c3451, #01516e);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 32px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #c1a067, #a8894f);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(193,160,103,0.3);
}

.alert-success {
    background: #e8f5e9;
    border: none;
    border-left: 4px solid #4caf50;
    color: #2e7d32;
    border-radius: 12px;
}

.alert-danger {
    background: #ffebee;
    border: none;
    border-left: 4px solid #f44336;
    color: #c62828;
    border-radius: 12px;
}

body.dark-mode .caldera-input {
    background: #1e1e2a;
    border-color: #2d2d3a;
    color: #dce8f0;
}

body.dark-mode .caldera-input:focus {
    border-color: #c1a067;
}

body.dark-mode .btn-outline-custom {
    background: #1e1e2a;
    border-color: #c1a067;
    color: #c1a067;
}

body.dark-mode .btn-outline-custom:hover {
    background: #c1a067;
    color: #1c3451;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-input i');
    const ratingInput = document.getElementById('rating');
    
    function highlightStars(value) {
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.remove('far');
                star.classList.add('fas');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    }
    
    if (ratingInput.value) {
        highlightStars(parseInt(ratingInput.value));
    }
    
    stars.forEach(star => {
        star.addEventListener('mouseenter', function() {
            highlightStars(parseInt(this.dataset.value));
        });
        
        star.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            ratingInput.value = value;
            highlightStars(value);
        });
    });
    
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        highlightStars(parseInt(ratingInput.value) || 0);
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\CYBORG 15\Downloads\- DATA D -\laragon\www\PA2\resources\views/pages/testimonials-create.blade.php ENDPATH**/ ?>