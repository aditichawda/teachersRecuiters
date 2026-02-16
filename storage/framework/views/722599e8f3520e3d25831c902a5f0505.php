<?php if($showLabel && $showField): ?>
    <?php if($options['wrapper'] !== false): ?>
        <div <?php echo $options['wrapperAttrs']; ?>>
            <?php endif; ?>
            <?php endif; ?>

            <?php if($showLabel && $options['label'] !== false && $options['label_show']): ?>
                <?php echo Form::label($name, $options['label'], $options['label_attr']); ?>

            <?php endif; ?>

            <?php if($showField): ?>
                <?php echo Form::themeIcon($name, $options['value'], $options['attr']); ?>

                <?php echo $__env->make('core/base::forms.partials.help-block', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>

            <?php echo $__env->make('core/base::forms.partials.errors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php if($showLabel && $showField): ?>
                <?php if($options['wrapper'] !== false): ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/fields/icons-field.blade.php ENDPATH**/ ?>