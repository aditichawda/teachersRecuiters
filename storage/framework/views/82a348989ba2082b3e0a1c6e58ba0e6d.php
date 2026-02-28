<?php $__env->startSection('content'); ?>
    <?php echo $form->renderForm(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
    <?php if (isset($component)) { $__componentOriginal0e6b0152aee5342533433c1a5b9b4cb1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0e6b0152aee5342533433c1a5b9b4cb1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::custom-template','data' => ['id' => 'currency_template']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::custom-template'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'currency_template']); ?>
        <li data-id="__id__" class="clearfix currency-item">
            <div class="currency-row">
                <div class="swatch-item" data-type="title" data-label="<?php echo e(trans('plugins/job-board::settings.currency.code')); ?>">
                    <input type="text" class="form-control" value="__title__">
                </div>
                <div class="swatch-item" data-type="symbol" data-label="<?php echo e(trans('plugins/job-board::settings.currency.symbol')); ?>">
                    <input type="text" class="form-control" value="__symbol__">
                </div>
                <div class="swatch-item swatch-exchange-rate" data-type="exchange_rate" data-label="<?php echo e(trans('plugins/job-board::settings.currency.exchange_rate')); ?>">
                    <input type="number" class="form-control input-exchange-rate" value="__exchangeRate__" step="0.00000001">
                </div>
                <div class="swatch-is-default" data-type="is_default" data-label="<?php echo e(trans('plugins/job-board::settings.currency.is_default')); ?>">
                    <input class="form-check-input" type="radio" name="currencies_is_default" value="__position__" __isDefaultChecked__>
                </div>
                <div class="swatch-advanced">
                    <button type="button" class="btn btn-sm btn-secondary toggle-advanced" title="<?php echo e(trans('plugins/job-board::settings.currency.advanced_settings')); ?>">
                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-settings'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    </button>
                </div>
                <div class="remove-item" data-label="<?php echo e(trans('plugins/job-board::settings.currency.remove')); ?>">
                    <a href="#" class="text-danger text-decoration-none">
                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-trash'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <div class="currency-advanced-settings" style="display: none;">
                <div class="advanced-settings-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label"><?php echo e(trans('plugins/job-board::settings.currency.number_of_decimals')); ?></label>
                                <input type="number" class="form-control" data-type="decimals" value="__decimals__">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label"><?php echo e(trans('plugins/job-board::settings.currency.number_format_style')); ?></label>
                                <select class="form-select" data-type="number_format_style">
                                    <option value="western" __westernFormatChecked__><?php echo e(trans('plugins/job-board::settings.currency.western_format')); ?></option>
                                    <option value="indian" __indianFormatChecked__><?php echo e(trans('plugins/job-board::settings.currency.indian_format')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label"><?php echo e(trans('plugins/job-board::settings.currency.is_prefix_symbol')); ?></label>
                                <select class="form-select" data-type="is_prefix_symbol">
                                    <option value="1" __isPrefixSymbolChecked__><?php echo e(trans('plugins/job-board::settings.currency.before_number')); ?></option>
                                    <option value="0" __notIsPrefixSymbolChecked__><?php echo e(trans('plugins/job-board::settings.currency.after_number')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" data-type="space_between_price_and_currency" value="1" __spaceBetweenPriceAndCurrencyChecked__>
                                    <label class="form-check-label"><?php echo e(trans('plugins/job-board::settings.currency.space_between_price_and_currency')); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0e6b0152aee5342533433c1a5b9b4cb1)): ?>
<?php $attributes = $__attributesOriginal0e6b0152aee5342533433c1a5b9b4cb1; ?>
<?php unset($__attributesOriginal0e6b0152aee5342533433c1a5b9b4cb1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0e6b0152aee5342533433c1a5b9b4cb1)): ?>
<?php $component = $__componentOriginal0e6b0152aee5342533433c1a5b9b4cb1; ?>
<?php unset($__componentOriginal0e6b0152aee5342533433c1a5b9b4cb1); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/settings/currency.blade.php ENDPATH**/ ?>