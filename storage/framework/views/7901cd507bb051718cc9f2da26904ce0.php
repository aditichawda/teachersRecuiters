<?php if(is_plugin_active('job-board') && $popular_searches && $keywords = array_map('trim', array_filter(explode(';', $popular_searches)))): ?>
    <div class="twm-bnr-popular-search">
        <span class="twm-title"><?php echo e(__('Popular Searches')); ?>:</span>
        <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>?keyword=<?php echo e($item); ?>"><?php echo e($item); ?></a> <?php echo e(! $loop->last ? ',' : '...'); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/search-bar/popular-search.blade.php ENDPATH**/ ?>