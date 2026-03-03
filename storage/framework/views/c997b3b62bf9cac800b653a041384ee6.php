<?php
    $field['options'] = BaseHelper::getFonts();
?>

<?php echo Form::customSelect(
    $name,
    ['' => trans('core/base::forms.select')] + array_combine($field['options'], $field['options']),
    $selected,
    ['data-bb-toggle' => 'google-font-selector'],
); ?>


<?php if (! $__env->hasRenderedOnce('8038e223-5d57-4854-9728-0012e621c221')): $__env->markAsRenderedOnce('8038e223-5d57-4854-9728-0012e621c221'); ?>
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
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/partials/google-fonts.blade.php ENDPATH**/ ?>