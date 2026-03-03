<?php if($showPayerInfo): ?>
    <?php if($payerName): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> <?php echo e(trans('plugins/payment::payment.payer_name')); ?> <?php $__env->endSlot(); ?>
            <?php echo e($payerName); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if($payerEmail): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> <?php echo e(trans('plugins/payment::payment.email')); ?> <?php $__env->endSlot(); ?>
            <?php echo e($payerEmail); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if($payerPhone): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> <?php echo e(trans('plugins/payment::payment.phone')); ?> <?php $__env->endSlot(); ?>
            <?php echo e($payerPhone); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php if($accountType || $institutionName || $packageName): ?>
    <?php if($accountType): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> <?php echo e(__('Account Type')); ?> <?php $__env->endSlot(); ?>
            <?php echo e($accountType); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if($institutionName): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> <?php echo e(__('Institution / Company')); ?> <?php $__env->endSlot(); ?>
            <?php echo e($institutionName); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if($packageName): ?>
        <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('title', null, []); ?> <?php echo e(__('Package')); ?> <?php $__env->endSlot(); ?>
            <?php echo e($packageName); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php if(!empty($couponCode)): ?>
    <?php if (isset($component)) { $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::datagrid.item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::datagrid.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
         <?php $__env->slot('title', null, []); ?> <?php echo e(trans('plugins/job-board::coupon.coupon_code')); ?> <?php $__env->endSlot(); ?>
        <?php echo e($couponCode); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $attributes = $__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__attributesOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac)): ?>
<?php $component = $__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac; ?>
<?php unset($__componentOriginal9d1723e55a4fe6f8bd7b5292f882d2ac); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/partials/payment-detail-extra.blade.php ENDPATH**/ ?>