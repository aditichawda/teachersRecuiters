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
<div class="modal fade" id="candidateLockModal" tabindex="-1" aria-labelledby="candidateLockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="candidateLockModalLabel"><?php echo e(__('Access Candidate Profiles')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="text-muted mb-4"><?php echo e(trans('plugins/job-board::messages.candidate_profile_locked')); ?></p>
                <p class="small text-muted"><?php echo e(trans('plugins/job-board::messages.candidate_profile_view_limit_reached')); ?></p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                <a href="<?php echo e(route('public.account.wallet')); ?>" class="btn btn-primary"><?php echo e(trans('plugins/job-board::dashboard.wallet_buy_credits')); ?></a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/candidates/index.blade.php ENDPATH**/ ?>