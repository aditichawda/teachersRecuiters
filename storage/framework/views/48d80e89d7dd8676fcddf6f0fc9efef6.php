<?php
    $field['options'] = BaseHelper::getFonts();
?>

<?php echo Form::customSelect(
    $name,
    ['' => trans('core/base::forms.select')] + array_combine($field['options'], $field['options']),
    $selected,
    ['data-bb-toggle' => 'google-font-selector'],
); ?>


<?php if (! $__env->hasRenderedOnce('adc53a6c-df57-4483-bf19-c1e40fe406e3')): $__env->markAsRenderedOnce('adc53a6c-df57-4483-bf19-c1e40fe406e3'); ?>
    <?php $__env->startPush('footer'); ?>
        <?php $__currentLoopData = array_chunk($field['options'], 200); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fonts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo Html::style(
                BaseHelper::getGoogleFontsURL() .
                    '/css?family=' .
                    implode('|', array_map('urlencode', array_filter($fonts))) .
                    '&display=swap',
            ); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/forms/partials/google-fonts.blade.php ENDPATH**/ ?>