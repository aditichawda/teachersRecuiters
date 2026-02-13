<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.review-item'), ['review' => $review], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="review-pagination d-flex justify-content-center mt-3">
    <?php echo e($reviews->onEachSide(1)->links()); ?>

</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/partials/review-load.blade.php ENDPATH**/ ?>