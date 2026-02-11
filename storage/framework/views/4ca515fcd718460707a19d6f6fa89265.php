<?php if($transactions->isNotEmpty()): ?>
    <?php if (isset($component)) { $__componentOriginalf18e72ccb4a95b013f70d2607d45e1cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf18e72ccb4a95b013f70d2607d45e1cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::step.index','data' => ['vertical' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::step'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['vertical' => true]); ?>
        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal517ce0a0f91f0415854ef022e6c0f03e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal517ce0a0f91f0415854ef022e6c0f03e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::step.item','data' => ['class' => \Illuminate\Support\Arr::toCssClasses(['user-action' => $transaction->account_id])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::step.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses(['user-action' => $transaction->account_id]))]); ?>
                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['h4 m-0', 'cursor-pointer' => $transaction->description]); ?>">
                    <?php echo BaseHelper::clean($transaction->getDescription()); ?>

                </div>
                <div class="text-secondary"><?php echo e($transaction->created_at); ?></div>

                <?php if($transaction->description): ?>
                    <?php if (isset($component)) { $__componentOriginal20d878510d8f6b63da7004efc7cea55f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20d878510d8f6b63da7004efc7cea55f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.fieldset','data' => ['class' => 'mt-2 py-2','style' => 'display: none;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.fieldset'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2 py-2','style' => 'display: none;']); ?>
                        <?php echo e($transaction->description); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20d878510d8f6b63da7004efc7cea55f)): ?>
<?php $attributes = $__attributesOriginal20d878510d8f6b63da7004efc7cea55f; ?>
<?php unset($__attributesOriginal20d878510d8f6b63da7004efc7cea55f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20d878510d8f6b63da7004efc7cea55f)): ?>
<?php $component = $__componentOriginal20d878510d8f6b63da7004efc7cea55f; ?>
<?php unset($__componentOriginal20d878510d8f6b63da7004efc7cea55f); ?>
<?php endif; ?>
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
<?php else: ?>
    <p class="mb-0 text-muted text-center"><?php echo e(trans('plugins/job-board::account.no_transactions')); ?></p>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/accounts/credits.blade.php ENDPATH**/ ?>