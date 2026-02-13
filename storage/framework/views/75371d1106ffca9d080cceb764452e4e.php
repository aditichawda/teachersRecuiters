<li>
    <a
        class="<?php echo e($social); ?>"
        data-bs-toggle="tooltip"
        data-bs-title="<?php echo e($label = trans('plugins/social-login::social-login.sign_in_with', ['provider' => trans('plugins/social-login::social-login.socials.' . $social)])); ?>"
        title="<?php echo e($label); ?>"
        href="<?php echo e($url); ?>"
    >
        <?php
            $iconName = $social;
            if ($social === 'linkedin-openid') {
                $iconName = 'linkedin';
            } elseif ($social === 'x') {
                $iconName = 'x';
            }
        ?>

        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-brand-'.e($iconName).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
        <span><?php echo e($label); ?></span>
    </a>
</li>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\social-login\/resources/views/social-login-item.blade.php ENDPATH**/ ?>