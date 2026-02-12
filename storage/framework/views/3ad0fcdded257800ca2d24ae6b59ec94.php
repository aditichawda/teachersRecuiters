<style>
    .bb-social-sharing {
        display: inline-flex;
        gap: 0.25rem;
        margin-bottom: 0;
    }

    .bb-social-sharing .bb-social-sharing__item {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 38px;
        height: 38px;
        line-height: 36px;
        text-align: center;
        border: 1px solid #e6e7e8;
        border-radius: 50%;
    }

    .bb-social-sharing .bb-social-sharing__item a {
        line-height: 16px;
        color: var(--primary-color);
    }

    .bb-social-sharing .bb-social-sharing__item:last-child {
        margin-inline-end: 0;
    }

    .bb-social-sharing .bb-social-sharing__item:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .bb-social-sharing .bb-social-sharing__item:hover a,
    .bb-social-sharing .bb-social-sharing__item:hover button {
        color: #fff;
    }

    .bb-social-sharing .bb-social-sharing__item button {
        border: none;
        outline: none;
        background: transparent;
        color: var(--primary-color);
    }

    .bb-social-sharing .bb-social-sharing__item button:hover {
        cursor: pointer;
    }

    .bb-social-sharing .bb-social-sharing__item svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-bottom: 0;
    }

    .bb-social-sharing .bb-social-sharing__item img {
        width: 1.25rem;
        height: 1.25rem;
        margin-bottom: 0;
    }

    .bb-social-sharing .bb-social-sharing-text {
        display: none;
    }
</style>

<ul class="bb-social-sharing">
    <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="bb-social-sharing__item">
            <a
                href="<?php echo e($social['url']); ?>"
                target="_blank"
                title="<?php echo e(trans('packages/theme::theme.common.share_on_social', ['social' => $social['name']])); ?>"
                style="<?php echo \Illuminate\Support\Arr::toCssStyles(["background-color: {$social['background_color']}" => $social['background_color'], "color: {$social['color']}" => $social['color']]) ?>"
            >
                <?php echo $social['icon']; ?>


                <span class="bb-social-sharing-text"><?php echo e($social['name']); ?></span>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <li class="bb-social-sharing__item">
        <button
            title="<?php echo e(trans('packages/theme::theme.common.copy_link')); ?>"
            data-bb-toggle="social-sharing-clipboard"
            data-clipboard-text="<?php echo e($url); ?>"
        >
            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-copy'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-clipboard-icon' => 'copy']); ?>
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
            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-clipboard-icon' => 'copied','style' => 'display: none;']); ?>
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
            <span class="bb-social-sharing-text"><?php echo e(trans('packages/theme::theme.common.copy_link')); ?></span>
        </button>
    </li>
</ul>

<?php if (! $__env->hasRenderedOnce('0a0e311a-1780-4e64-bee1-4a5deb5906ba')): $__env->markAsRenderedOnce('0a0e311a-1780-4e64-bee1-4a5deb5906ba'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleClipboardActionIcon(element) {
                const copiedState = element.querySelector('[data-clipboard-icon="copy"]');
                const copyState = element.querySelector('[data-clipboard-icon="copied"]');

                copiedState.style.display = 'none';
                copyState.style.display = 'inline-block';

                setTimeout(function() {
                    copiedState.style.display = 'inline-block';
                    copyState.style.display = 'none';
                }, 3000);
            }

            document.querySelectorAll('[data-bb-toggle="social-sharing-clipboard"]').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();

                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(element.dataset.clipboardText).then(
                            function() {
                                toggleClipboardActionIcon(element);
                            });
                    } else {
                        const input = document.createElement('input');
                        input.value = element.dataset.clipboardText;
                        document.body.appendChild(input);
                        input.select();
                        document.execCommand('copy');
                        document.body.removeChild(input);

                        toggleClipboardActionIcon(element);
                    }
                });
            });
        });
    </script>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/packages/theme/resources/views/fronts/social-sharing.blade.php ENDPATH**/ ?>