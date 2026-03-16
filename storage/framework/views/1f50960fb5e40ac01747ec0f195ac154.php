<div class="twm-sidebar-ele-filter job-filter-accordion">
    <!-- Desktop heading -->
    <h4 class="section-head-small mb-4 d-none d-md-block"><?php echo e(__('Date Posted')); ?></h4>

    <!-- Mobile accordion header -->
    <button type="button" class="job-filter-accordion-toggle d-block d-md-none">
        <span><?php echo e(__('Date Posted')); ?></span>
        <i class="feather-chevron-down"></i>
    </button>

    <div class="job-filter-accordion-body">
        <ul>
            <li>
                <div class="form-check">
                    <input type="radio" name="date_posted" class="form-check-input" id="date-posted-all" <?php if(! request()->input('date_posted')): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="date-posted-all"><?php echo e(__('All')); ?></label>
                </div>
            </li>
            <?php $__currentLoopData = JobBoardHelper::postedDateRanges(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="form-check">
                        <input type="radio" name="date_posted" value="<?php echo e($key); ?>" class="form-check-input" id="date-posted-<?php echo e($key); ?>" <?php if($key == request()->input('date_posted')): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="date-posted-<?php echo e($key); ?>"><?php echo e($item['name']); ?></label>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/filters/date_posted.blade.php ENDPATH**/ ?>