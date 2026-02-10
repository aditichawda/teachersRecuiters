<?php
    $orderByParams = JobBoardHelper::getSortByParams();

    $layout = request()->query('layout') ?: $shortcode->style;
?>

<div id="mySidebar" class="sidebar">
    <div class="header-sidebar">
        <a href="javascript:void(0)" class="btn-close-sidebar">
            <i class="feather-x"></i>
        </a>
        <p class="title"><?php echo e(__('Option')); ?></p>
    </div>
    <div class="body-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <span class="option-title"><?php echo e(__('Sort By')); ?></span>
                    <select class="wt-select-bar-2 selectpicker select-sort-by" style="width: 100%" data-live-search="true" data-bv-field="size">
                        <?php $__currentLoopData = $orderByParams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(request()->query('sort_by', Arr::first(array_keys($orderByParams)))): echo 'selected'; endif; ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <span class="option-title"><?php echo e(__('Per page')); ?></span>
                    <select class="wt-select-bar-2 selectpicker select-per-page" style="width: 100%" name="per-page" data-live-search="true" data-bv-field="size">
                        <?php $__currentLoopData = JobBoardHelper::getPerPageParams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(request()->query('per_page') == $page): echo 'selected'; endif; ?> value="<?php echo e($page); ?>"><?php echo e(__('Show :number', ['number' => $page])); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <span class="option-title"><?php echo e(__('Layout')); ?></span>
                    <select class="wt-select-bar-2 selectpicker select-layout" style="width: 100%" name="layout" data-live-search="true" data-bv-field="size">
                        <option <?php if($layout == 'gird'): echo 'selected'; endif; ?> value="gird"><?php echo e(__('Gird')); ?></option>
                        <option <?php if($layout == 'list'): echo 'selected'; endif; ?> value="list"><?php echo e(__('List')); ?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main">
    <button class="btn btn-open-sidebar">
        <?php echo e(__('Option')); ?>

    </button>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/option-company-mobile.blade.php ENDPATH**/ ?>