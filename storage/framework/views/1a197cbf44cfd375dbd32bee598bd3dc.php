<?php
    Arr::set($attributes, 'class', Arr::get($attributes, 'class') . ' icon-select');
    Arr::set($attributes, 'data-empty-value', trans('packages/theme::theme.common.none'));
    Arr::set($attributes, 'data-check-initialized', true);
?>

<?php echo Form::customSelect($name, [$value => $value], $value, $attributes); ?>


<?php if (! $__env->hasRenderedOnce('cfcc1961-92b5-4587-8965-d3c6de6a0c71')): $__env->markAsRenderedOnce('cfcc1961-92b5-4587-8965-d3c6de6a0c71'); ?>
    <?php if(request()->ajax()): ?>
        <?php echo $__env->make('packages/theme::forms.fields.includes.icon-fields-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <script src="<?php echo e(asset('vendor/core/packages/theme/js/icons-field.js')); ?>?v=1.1.0"></script>
    <?php else: ?>
        <?php echo $__env->make('packages/theme::forms.fields.includes.icon-fields-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php $__env->startPush('footer'); ?>
            <script src="<?php echo e(asset('vendor/core/packages/theme/js/icons-field.js')); ?>?v=1.1.0"></script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/forms/fields/icons-field.blade.php ENDPATH**/ ?>