<div class="twm-bnr-search-bar">
    <?php echo Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET']); ?>

        <div class="row">
            <div class="form-group col-xl-4 col-lg-5 col-md-6">
                <label><?php echo e(__('Keyword')); ?></label>
                <select class="wt-search-bar-select selectpicker-keyword" name="job_categories[]">
                    <option value=""><?php echo e(__('Type to search...')); ?></option>
                    <?php $__currentLoopData = app(\Botble\JobBoard\Repositories\Interfaces\CategoryInterface::class)->allBy(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <?php if(is_plugin_active('location')): ?>
                <div class="form-group col-xl-4 col-lg-5 col-md-6">
                    <label><?php echo e(__('Location')); ?></label>
                    <select name="city_id" class="wt-search-bar-select selectpicker-location">
                        <option value=""><?php echo e(__('Select Your Location')); ?></option>
                    </select>
                </div>
            <?php endif; ?>

            <div class="form-group col-xl-4 col-lg-2 col-md-12">
                <button type="submit" class="site-button"><?php echo e(__('Find Job')); ?></button>
            </div>
        </div>
    <?php echo Form::close(); ?>

</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/search-bar/form.blade.php ENDPATH**/ ?>