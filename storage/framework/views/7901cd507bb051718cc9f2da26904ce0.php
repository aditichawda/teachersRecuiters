<?php if(is_plugin_active('job-board') && $popular_searches && $keywords = array_map('trim', array_filter(explode(';', $popular_searches)))): ?>
    <div class="twm-bnr-popular-search">
        <div class="twm-popular-title" style="color: #000000;"><?php echo e(__('Popular Searches')); ?>:</div>
        <div class="twm-popular-tags" style="padding: 0rem; gap: 0px">
            <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>?keyword=<?php echo e($item); ?>" class="twm-popular-tag"><?php echo e($item); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/search-bar/popular-search.blade.php ENDPATH**/ ?>