<?php
    $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
    $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
    $institutionTypeGroups = file_exists($pluginGroupsPath)
        ? include $pluginGroupsPath
        : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
?>

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Institution Type')); ?></h4>
    <ul>
        <?php $__currentLoopData = $institutionTypeGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $group['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="institution_type[]" id="company-institution-type-<?php echo e(md5($value)); ?>" value="<?php echo e($value); ?>" <?php if(in_array($value, (array) request()->query('institution_type', []))): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="company-institution-type-<?php echo e(md5($value)); ?>"><?php echo e($label); ?></label>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/companies/filters/institution-type.blade.php ENDPATH**/ ?>