<div class="image-box attachment-wrapper">
    <input
        class="attachment-url"
        name="<?php echo e($name); ?>"
        type="hidden"
        value="<?php echo e($value); ?>"
    >
    <?php if(!is_in_admin(true) || !auth()->check()): ?>
        <input
            class="media-file-input"
            type="file"
            style="display: none;"
            <?php if($name): ?> name="<?php echo e($name); ?>_input" <?php endif; ?>
        >
    <?php endif; ?>
    <div class="position-relative">
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'd-flex align-items-center gap-1 attachment-details form-control mb-2 pe-5',
            'hidden' => !$value,
        ]); ?>">
            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-file'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-1','style' => '--bb-icon-size: 1.5rem']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
            <div class="attachment-info text-truncate">
                <a
                    href="<?php echo e($url ?? $value ? RvMedia::url($url ?? $value) : null); ?>"
                    target="_blank"
                    data-bs-toggle="tooltip"
                    title="<?php echo e($value); ?>"
                >
                    <?php echo e($value); ?>

                </a>
                <small class="d-block"><?php echo e(RvMedia::getFileSize($value)); ?></small>
            </div>
        </div>

        <a
            href="javascript:void(0);"
            class="text-body text-decoration-none position-absolute end-0 me-2"
            data-bb-toggle="media-file-remove"
            style="<?php echo \Illuminate\Support\Arr::toCssStyles(['top: 0.5rem', 'display: none' => !$value]) ?>"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="<?php echo e(trans('core/base::forms.remove_file')); ?>"
        >
            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-x'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => '--bb-icon-size: 1rem']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
        </a>
    </div>
    <div class="image-box-actions">
        <a
            href="javascript:void(0);"
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'btn_gallery' => is_in_admin(true) && auth()->check(),
                'media-select-file' => !is_in_admin(true) || !auth()->check(),
            ]); ?>"
            data-result="<?php echo e($name); ?>"
            data-action="<?php echo e($attributes['action'] ?? 'attachment'); ?>"
            size="sm"
            icon="ti ti-paperclip"
        >
            <?php echo e(trans('core/base::forms.choose_file')); ?>

        </a>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/forms/partials/file.blade.php ENDPATH**/ ?>