<?php
    $docsUrl = url('/docs');
    $docsExists = is_dir(public_path('docs'));
?>

<div>
    <h6 class="mb-3"><?php echo e(trans('packages/api::api.api_documentation')); ?></h6>

    <?php if($docsExists): ?>
        <p class="mb-2 text-muted"><?php echo e(trans('packages/api::api.api_documentation_description')); ?></p>
        <a href="<?php echo e($docsUrl); ?>" target="_blank" class="btn btn-sm btn-primary">
            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-1']); ?>
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
            <?php echo e(trans('packages/api::api.view_documentation')); ?>

        </a>
    <?php else: ?>
        <div class="alert alert-info mb-0 d-block">
            <h6 class="alert-heading mb-3">
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-info-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-1']); ?>
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
                <?php echo e(trans('packages/api::api.generate_docs_title')); ?>

            </h6>
            <p class="mb-3"><?php echo e(trans('packages/api::api.generate_docs_description')); ?></p>

            <div class="mb-3">
                <strong><?php echo e(trans('packages/api::api.generate_docs_step_1')); ?></strong>
                <pre class="mt-2 p-2 bg-dark text-white rounded"><code>composer require knuckleswtf/scribe</code></pre>
            </div>

            <div class="mb-3">
                <strong><?php echo e(trans('packages/api::api.generate_docs_step_2')); ?></strong>
                <pre class="mt-2 p-2 bg-dark text-white rounded"><code>php artisan scribe:generate</code></pre>
            </div>

            <div class="mb-0">
                <strong><?php echo e(trans('packages/api::api.generate_docs_step_3')); ?></strong>
                <p class="mt-2 mb-0">
                    <a href="<?php echo e($docsUrl); ?>" target="_blank" class="text-decoration-none">
                        <?php echo e($docsUrl); ?>

                    </a>
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\vendor\botble\api\src\Providers/../../resources/views/settings/partials/documentation-section.blade.php ENDPATH**/ ?>