<div class="ps-sidebar__top">
    <div class="ps-block--user-wellcome">
        <div class="ps-block__left">
            <img
                src="<?php echo e(auth('account')->user()->avatar_url); ?>"
                alt="<?php echo e(auth('account')->user()->name); ?>"
                class="avatar avatar-lg"
            />
        </div>
        <div class="ps-block__right">
            <p><?php echo e(trans('plugins/job-board::dashboard.hello')); ?>, <?php echo e(auth('account')->user()->name); ?></p>
            <small><?php echo e(trans('plugins/job-board::dashboard.joined_on', ['date' => auth('account')->user()->created_at->translatedFormat('M d, Y')])); ?></small>
            <?php if($uniqueId = auth('account')->user()->unique_id): ?>
                <small class="d-block mt-1">
                    <?php echo trans('plugins/job-board::dashboard.id_label', ['id' => Html::tag('strong', $uniqueId)]); ?>

                </small>
            <?php endif; ?>
        </div>
        <div class="ps-block__action">
            <a
                href="<?php echo e(route('public.account.logout')); ?>"
                title="<?php echo e(trans('plugins/job-board::dashboard.header_logout_link')); ?>"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-logout'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            </a>
        </div>
    </div>

    <?php if(JobBoardHelper::isEnabledCreditsSystem()): ?>
        <div class="ps-block--earning-count">
            <small><?php echo e(trans('plugins/job-board::dashboard.credits')); ?></small>
            <h3 class="my-2"><?php echo e(number_format(auth('account')->user()->credits)); ?></h3>
            <a href="<?php echo e(route('public.account.packages')); ?>" target="_blank">
                <?php echo e(trans('plugins/job-board::dashboard.buy_credits')); ?>

            </a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/themes/dashboard/layouts/menu-top.blade.php ENDPATH**/ ?>