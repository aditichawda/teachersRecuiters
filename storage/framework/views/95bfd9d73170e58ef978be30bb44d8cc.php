<?php if($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
    <input type="hidden" name="page" data-value="<?php echo e($candidates->currentPage()); ?>">
    <input type="hidden" name="keyword" value="<?php echo e(request()->input('keyword')); ?>">
<?php endif; ?>

<?php
    $layout = request()->input('layout', $layout ?? 'grid');
    $layout = in_array($layout, ['grid', 'list', 'list-2', 'list-7']) ? $layout : 'grid';
?>

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

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/partials/candidates/index.blade.php ENDPATH**/ ?>