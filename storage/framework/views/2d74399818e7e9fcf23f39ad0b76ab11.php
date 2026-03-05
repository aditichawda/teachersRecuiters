<!DOCTYPE html>
<html lang="<?php echo e(Str::replace('_', '-', App::getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title><?php echo $__env->yieldContent('pageTitle', trans('packages/installer::installer.title')); ?></title>

    <meta
        name="description"
        content="Installation Botble CMS v<?php echo e(get_cms_version()); ?>"
    >

    <link
        href="<?php echo e(asset('vendor/core/core/base/images/favicon.png')); ?>"
        rel="icon"
        type="image/png"
    >

    <?php echo $__env->make('core/base::components.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <link
        href="<?php echo e(asset('vendor/core/packages/installer/css/style.css')); ?>?v=<?php echo e(get_cms_version()); ?>"
        rel="stylesheet"
    />

    <style>
        [v-cloak],
        [x-cloak] {
            display: none;
        }
    </style>

    <?php
        Assets::getFacadeRoot()
            ->removeStyles(['fontawesome', 'select2', 'custom-scrollbar', 'datepicker', 'spectrum', 'fancybox'])
            ->removeScripts([
                'excanvas',
                'ie8-fix',
                'modernizr',
                'select2',
                'datepicker',
                'cookie',
                'toastr',
                'custom-scrollbar',
                'stickytableheaders',
                'jquery-waypoints',
                'spectrum',
                'fancybox',
                'fslightbox',
            ]);
    ?>
    <?php echo Assets::renderHeader(['core']); ?>


    <link
        href="<?php echo e(BaseHelper::getGoogleFontsURL()); ?>"
        rel="preconnect"
    >
    <link
        href="<?php echo e(BaseHelper::getGoogleFontsURL('css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap')); ?>"
        rel="stylesheet"
    >

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
<?php
    use Botble\Installer\InstallerStep\InstallerStep;

    $currentStep = InstallerStep::currentStep();
?>

<div class="page-wrapper justify-content-center min-h-full">
    <div class="page-body page-content mt-8 mb-8">
        <div class="container-xl installer-container">
            <div class="row mb-6">
                <div class="col">
                    <h3 class="h1 page-title justify-content-center text-white">
                        <?php echo e(trans('packages/installer::installer.title')); ?>

                    </h3>
                </div>
            </div>

            <div class="row installer-wrapper">
                <div class="col-md-3 p-4">
                    <div class="steps-backdrop"></div>
                    <?php if (isset($component)) { $__componentOriginalf18e72ccb4a95b013f70d2607d45e1cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf18e72ccb4a95b013f70d2607d45e1cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::step.index','data' => ['counter' => true,'vertical' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::step'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['counter' => true,'vertical' => true]); ?>
                        <?php $__currentLoopData = InstallerStep::getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal517ce0a0f91f0415854ef022e6c0f03e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal517ce0a0f91f0415854ef022e6c0f03e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::step.item','data' => ['isActive' => $currentStep === $loop->iteration]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::step.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['is-active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($currentStep === $loop->iteration)]); ?>
                                <?php if($step->getRoute() && $currentStep > $loop->iteration): ?>
                                    <a href="<?php echo e(route($step->getRoute())); ?>"><?php echo e($step->getLabel()); ?></a>
                                <?php else: ?>
                                    <?php echo e($step->getLabel()); ?>

                                <?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal517ce0a0f91f0415854ef022e6c0f03e)): ?>
<?php $attributes = $__attributesOriginal517ce0a0f91f0415854ef022e6c0f03e; ?>
<?php unset($__attributesOriginal517ce0a0f91f0415854ef022e6c0f03e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal517ce0a0f91f0415854ef022e6c0f03e)): ?>
<?php $component = $__componentOriginal517ce0a0f91f0415854ef022e6c0f03e; ?>
<?php unset($__componentOriginal517ce0a0f91f0415854ef022e6c0f03e); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf18e72ccb4a95b013f70d2607d45e1cc)): ?>
<?php $attributes = $__attributesOriginalf18e72ccb4a95b013f70d2607d45e1cc; ?>
<?php unset($__attributesOriginalf18e72ccb4a95b013f70d2607d45e1cc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf18e72ccb4a95b013f70d2607d45e1cc)): ?>
<?php $component = $__componentOriginalf18e72ccb4a95b013f70d2607d45e1cc; ?>
<?php unset($__componentOriginalf18e72ccb4a95b013f70d2607d45e1cc); ?>
<?php endif; ?>
                </div>
                <div class="col-md-9 p-0">
                    <?php if (isset($component)) { $__componentOriginalc107e2f90dff5eb05519f33918d2c807 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc107e2f90dff5eb05519f33918d2c807 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.index','data' => ['class' => 'h-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-100']); ?>
                        <?php if (! empty(trim($__env->yieldContent('header')))): ?>
                            <?php if (isset($component)) { $__componentOriginalf7ec4b8ef3fc6db54b9665bd653222c4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf7ec4b8ef3fc6db54b9665bd653222c4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.header.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <?php echo $__env->yieldContent('header'); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf7ec4b8ef3fc6db54b9665bd653222c4)): ?>
<?php $attributes = $__attributesOriginalf7ec4b8ef3fc6db54b9665bd653222c4; ?>
<?php unset($__attributesOriginalf7ec4b8ef3fc6db54b9665bd653222c4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf7ec4b8ef3fc6db54b9665bd653222c4)): ?>
<?php $component = $__componentOriginalf7ec4b8ef3fc6db54b9665bd653222c4; ?>
<?php unset($__componentOriginalf7ec4b8ef3fc6db54b9665bd653222c4); ?>
<?php endif; ?>
                        <?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal4fdb92edf089f19cd17d37829580c9a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fdb92edf089f19cd17d37829580c9a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo $__env->make('packages/installer::partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                            <?php echo $__env->yieldContent('content'); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4fdb92edf089f19cd17d37829580c9a6)): ?>
<?php $attributes = $__attributesOriginal4fdb92edf089f19cd17d37829580c9a6; ?>
<?php unset($__attributesOriginal4fdb92edf089f19cd17d37829580c9a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4fdb92edf089f19cd17d37829580c9a6)): ?>
<?php $component = $__componentOriginal4fdb92edf089f19cd17d37829580c9a6; ?>
<?php unset($__componentOriginal4fdb92edf089f19cd17d37829580c9a6); ?>
<?php endif; ?>

                        <?php if (! empty(trim($__env->yieldContent('footer')))): ?>
                            <?php if (isset($component)) { $__componentOriginal00609f0158ec6107e317b89bf18d2d23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00609f0158ec6107e317b89bf18d2d23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.footer.index','data' => ['class' => 'd-flex justify-content-end']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'd-flex justify-content-end']); ?>
                                <?php echo $__env->yieldContent('footer'); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00609f0158ec6107e317b89bf18d2d23)): ?>
<?php $attributes = $__attributesOriginal00609f0158ec6107e317b89bf18d2d23; ?>
<?php unset($__attributesOriginal00609f0158ec6107e317b89bf18d2d23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00609f0158ec6107e317b89bf18d2d23)): ?>
<?php $component = $__componentOriginal00609f0158ec6107e317b89bf18d2d23; ?>
<?php unset($__componentOriginal00609f0158ec6107e317b89bf18d2d23); ?>
<?php endif; ?>
                        <?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc107e2f90dff5eb05519f33918d2c807)): ?>
<?php $attributes = $__attributesOriginalc107e2f90dff5eb05519f33918d2c807; ?>
<?php unset($__attributesOriginalc107e2f90dff5eb05519f33918d2c807); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc107e2f90dff5eb05519f33918d2c807)): ?>
<?php $component = $__componentOriginalc107e2f90dff5eb05519f33918d2c807; ?>
<?php unset($__componentOriginalc107e2f90dff5eb05519f33918d2c807); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo Assets::renderFooter(); ?>


<script type="text/javascript">
    var BotbleVariables = BotbleVariables || {
        languages: {
            notices_msg: <?php echo e(Js::from(trans('core/base::notices'))); ?>,
        },
    }
</script>

<?php $__env->startPush('footer'); ?>
    <?php if(Session::has('success_msg') || Session::has('error_msg') || (isset($errors) && $errors->any()) || isset($error_msg)): ?>
        <script type="text/javascript">
            $(function() {
                <?php if(Session::has('success_msg')): ?>
                Botble.showSuccess('<?php echo e(session('success_msg')); ?>')
                <?php endif; ?>
                <?php if(Session::has('error_msg')): ?>
                Botble.showError('<?php echo e(session('error_msg')); ?>')
                <?php endif; ?>
                <?php if(isset($error_msg)): ?>
                Botble.showError('<?php echo e($error_msg); ?>')
                <?php endif; ?>
                <?php if(isset($errors)): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                Botble.showError('<?php echo e($error); ?>')
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            })
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/packages/installer/resources/views/layouts/master.blade.php ENDPATH**/ ?>