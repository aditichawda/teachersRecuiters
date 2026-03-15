<?php if($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
    <input type="hidden" name="page" data-value="<?php echo e($candidates->currentPage()); ?>">
    <input type="hidden" name="keyword" value="<?php echo e(request()->input('keyword')); ?>">
<?php endif; ?>

<?php
    $layout = request()->input('layout', $layout ?? 'grid');
    $layout = in_array($layout, ['grid', 'list', 'list-2', 'list-7']) ? $layout : 'grid';
    $canViewCandidates = $canViewCandidates ?? true;
?>

<?php if(!$canViewCandidates): ?>
<style>
.candidate-card-blur-wrap { position: relative; user-select: none; -webkit-user-select: none; }
.candidate-card-blur-wrap .candidate-card-blur-content { filter: blur(5px); pointer-events: none; }
.candidate-card-blur-wrap .candidate-card-blur-overlay {
    position: absolute; inset: 0; background: rgba(255,255,255,0.75); display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 12px;
    border-radius: 8px; cursor: pointer; z-index: 1;
}
.candidate-card-blur-wrap .candidate-card-blur-overlay .overlay-text { font-size: 14px; font-weight: 600; color: #64748b; margin: 0; }
.candidate-card-blur-wrap .cl-right { position: relative; z-index: 2; }
.candidate-card-blur-wrap .cl-right .cl-view-btn-locked { pointer-events: auto; }
</style>
<?php endif; ?>

<div class="twm-candidates-list-wrap">
    <div id="page-loading" style="display: none">
        <div class="page-backdrop"></div>
        <div class="page-loading"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="candidates-content">
        <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.candidates.'. $layout), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php if($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <?php echo $candidates->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if(!$canViewCandidates): ?>

<div id="candidateLockModal" class="candidate-lock-popup" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:12px; padding:24px; max-width:400px; margin:20px; box-shadow:0 4px 20px rgba(0,0,0,0.2);" onclick="event.stopPropagation();">
        <h5 class="mb-3" style="font-size:18px; font-weight:600; color:#333;"><?php echo e(__('Access Candidate Profiles')); ?></h5>
        <p id="candidate-lock-popup-msg" class="mb-4" style="font-size:15px; color:#333;"><?php echo e(trans('plugins/job-board::messages.candidate_profile_view_limit_reached')); ?></p>
        <div class="d-flex gap-2 justify-content-end">
            <button type="button" class="btn btn-secondary" id="candidate-lock-popup-close"><?php echo e(__('Cancel')); ?></button>
            <a href="<?php echo e(route('public.account.wallet')); ?>" class="btn btn-primary" id="candidate-lock-popup-wallet"><?php echo e(trans('plugins/job-board::dashboard.wallet_buy_credits')); ?></a>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var popup = document.getElementById('candidateLockModal');
    var closeBtn = document.getElementById('candidate-lock-popup-close');
    if (popup) {
        function showCandidateLockPopup() { popup.style.display = 'flex'; }
        function hideCandidateLockPopup() { popup.style.display = 'none'; }
        document.querySelectorAll('[data-bs-target="#candidateLockModal"]').forEach(function(el) {
            el.addEventListener('click', function(e) {
                if (el.getAttribute('href') === '#' || el.classList.contains('cl-view-btn-locked') || el.classList.contains('cl-name-locked')) {
                    e.preventDefault();
                    e.stopPropagation();
                    showCandidateLockPopup();
                }
            });
        });
        if (closeBtn) closeBtn.addEventListener('click', hideCandidateLockPopup);
        popup.addEventListener('click', function(e) { if (e.target === popup) hideCandidateLockPopup(); });
    }
});
</script>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/candidates/index.blade.php ENDPATH**/ ?>