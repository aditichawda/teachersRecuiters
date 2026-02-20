<?php if(! auth('account')->check()): ?>
<?php
    $loginUrl = route('public.account.login');
    $registerJobSeekerUrl = route('public.account.register');
    $registerEmployerUrl = route('public.account.register.employer');
    $signupModalImage = theme_option('signup_login_modal_image') ? RvMedia::getImageUrl(theme_option('signup_login_modal_image')) : '';
?>
<style>
#signupLoginModal .signup-login-modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.04);
    overflow: hidden;
}
#signupLoginModal .signup-login-card-row {
    display: flex;
    flex-wrap: nowrap;
    min-height: 400px;
}
#signupLoginModal .signup-login-left {
    flex: 0 0 50%;
    max-width: 50%;
    min-height: 400px;
    background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #3b82f6 100%);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
    padding: 0;
}
#signupLoginModal .signup-login-left img {
    width: 100%;
    height: 100%;
    min-height: 400px;
    object-fit: cover;
    display: block;
}
#signupLoginModal .signup-login-right {
    flex: 0 0 50%;
    max-width: 50%;
    display: flex;
    flex-direction: column;
    position: relative;
    background: #fff;
    padding: 0;
}
#signupLoginModal .signup-login-accent {
    height: 4px;
   
}
#signupLoginModal .signup-login-modal-content .modal-header {
    padding: 1.5rem 1.5rem 0.5rem;
}
#signupLoginModal .signup-login-welcome {
    font-size: 0.8rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #64748b !important;
    font-weight: 600;
}
#signupLoginModal .signup-login-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #0f172a;
    letter-spacing: -0.02em;
}
#signupLoginModal .signup-login-desc {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.5;
}
#signupLoginModal .signup-login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
            font-size: 1rem;
    border-radius: 10px;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
    text-decoration: none;
    border: 2px solid transparent;
}
#signupLoginModal .signup-login-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.2);
}
#signupLoginModal .signup-login-btn-primary {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: #fff !important;
}
#signupLoginModal .signup-login-btn-primary:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    color: #fff !important;
}
#signupLoginModal .signup-login-btn-outline {
    background: #fff;
    color: #2563eb;
    border-color: #2563eb;
}
#signupLoginModal .signup-login-btn-outline:hover {
    background: #eff6ff;
    color: #1d4ed8;
    border-color: #1d4ed8;
}
#signupLoginModal .signup-login-divider {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 1.25rem 0 1rem;
}
#signupLoginModal .signup-login-divider::before,
#signupLoginModal .signup-login-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e2e8f0;
}
#signupLoginModal .signup-login-login-link {
    color: #2563eb;
    font-weight: 500;
    font-size: 1rem;
    text-decoration: none;
    transition: color 0.15s ease;
}
#signupLoginModal .signup-login-login-link:hover {
    color: #1d4ed8;
}
#signupLoginModal .signup-login-dont-show {
    font-size: 0.85rem;
    color: #64748b;
}
#signupLoginModal .signup-login-dont-show .form-check-input {
    margin-top: 0.2em;
}
#signupLoginModal .btn-close {
    opacity: 0.6;
    padding: 0.5rem;
}
#signupLoginModal .btn-close:hover {
    opacity: 1;
}
#signupLoginModal .modal-dialog {
    max-width: 800px;
}
#signupLoginModal .signup-login-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    padding: 0.1rem;
    font-size: 1.25rem;
}
#signupLoginModal .signup-login-right .modal-body {
    padding: 1rem 1.5rem 1.5rem;
}
#signupLoginModal .signup-login-right .modal-header {
    padding: 1.5rem 1.5rem 0.25rem;
}
@media (max-width: 768px) {
    #signupLoginModal .signup-login-card-row { flex-direction: column; min-height: auto; }
    #signupLoginModal .signup-login-left { flex: 0 0 auto; max-width: 100%; min-height: 200px; }
    #signupLoginModal .signup-login-right { flex: 0 0 auto; max-width: 100%; }
    #signupLoginModal .modal-dialog { max-width: 100%; margin: 0.5rem; }
}
</style>
<div class="modal fade" id="signupLoginModal" tabindex="-1" aria-labelledby="signupLoginModalLabel" aria-hidden="true" data-dismiss-storage-key="signupLoginPopupDismissed">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content signup-login-modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="signup-login-card-row">
                <div class="signup-login-left">
                    <?php if($signupModalImage): ?>
                        <img src="<?php echo e($signupModalImage); ?>" alt="">
                    <?php endif; ?>
                </div>
                <div class="signup-login-right">
                <div class="signup-login-accent"></div>
                <div class="modal-header border-0 pb-0 pt-4 px-4 position-relative">
                    <h5 class="modal-title w-100 text-center" id="signupLoginModalLabel">
                        <span class="d-block signup-login-welcome mb-1"><?php echo e(__('Welcome')); ?></span>
                        <span class="d-block signup-login-title"><?php echo e(__('Sign up or Login')); ?></span>
                    </h5>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4 pt-2">
                    <p class="signup-login-desc text-center mb-4"><?php echo e(__('Create an account or sign in to apply for jobs and get hired.')); ?></p>
                    <div class="row g-2 mb-0">
                        <div class="col-6">
                            <a href="<?php echo e($registerJobSeekerUrl); ?>" class="btn signup-login-btn signup-login-btn-primary w-100">
                                <i class="fas fa-user-graduate me-1"></i>
                                <?php echo e(__('Job Seeker')); ?>

                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?php echo e($registerEmployerUrl); ?>" class="btn signup-login-btn signup-login-btn-outline w-100">
                                <i class="fas fa-building me-1"></i>
                                <?php echo e(__('Employer')); ?>

                            </a>
                        </div>
                    </div>
                    <div class="signup-login-divider">
                        <span class="small text-muted"><?php echo e(__('Already have an account?')); ?></span>
                    </div>
                    <p class="text-center small mb-0">
                        <a href="<?php echo e($loginUrl); ?>" class="signup-login-login-link"><?php echo e(__('Login')); ?> <i class="fas fa-arrow-right ms-1 small"></i></a>
                    </p>
                    <div class="form-check d-flex justify-content-center align-items-center mt-3 pt-2">
                        <input class="form-check-input me-2" type="checkbox" id="signupLoginDontShowAgain" value="1">
                        <label class="form-check-label signup-login-dont-show" for="signupLoginDontShowAgain"><?php echo e(__("Don't show this popup again")); ?></label>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modalEl = document.getElementById('signupLoginModal');
    if (!modalEl) return;
    var storageKey = modalEl.getAttribute('data-dismiss-storage-key') || 'signupLoginPopupDismissed';
    var checkbox = document.getElementById('signupLoginDontShowAgain');
    function dismissForGood() {
        try { localStorage.setItem(storageKey, '1'); } catch (e) {}
    }
    modalEl.addEventListener('hidden.bs.modal', function() {
        if (checkbox && checkbox.checked) dismissForGood();
    });
    var showOnHomeOnly = <?php echo e(request()->is('/') ? 'true' : 'false'); ?>;
    setTimeout(function() {
        try {
            if (localStorage.getItem(storageKey) === '1') return;
        } catch (e) {}
        if (!showOnHomeOnly) return;
        var modal = typeof bootstrap !== 'undefined' && bootstrap.Modal ? bootstrap.Modal.getOrCreateInstance(modalEl) : null;
        if (modal) modal.show();
    }, 1500);
});
</script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/signup-login-modal.blade.php ENDPATH**/ ?>