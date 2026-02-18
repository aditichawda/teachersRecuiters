<?php if(request()->query('layout') === 'grid'): ?>
    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.candidates.grid'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php else: ?>
    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.candidates.list'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<?php echo e($candidates->links(Theme::getThemeNamespace('partials.pagination'))); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/partials/candidate-list.blade.php ENDPATH**/ ?>