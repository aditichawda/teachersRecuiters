<?php $__env->startPush('header'); ?>
<style>
/* Employer wallet – 2nd image: simple card UI */
.wallet-em-page .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 0.60rem 1.25rem !important; min-height: 220px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
.wallet-em-page .wallet-js-card-blue .card-body { padding: 0 !important; border: none !important; background: transparent !important; flex: 1 1 auto; min-height: 0; }
.wallet-em-page .wallet-js-card-blue .card-footer { border: none !important; padding: 0.75rem 0 0 !important; background: transparent !important; flex-shrink: 0; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.95; margin-bottom: 0.35rem; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-row { font-size: 0.8rem; opacity: 0.95; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem; }
.wallet-em-page .wallet-js-card-blue .btn-warning { background: #f59e0b !important; color: #1a1a2e !important; border: none !important; border-radius: 8px !important; font-weight: 600 !important; }
.wallet-em-page .wallet-js-card-orange { background: linear-gradient(135deg, #f59e0b, #fbbf24) !important; border: none !important; border-radius: 12px !important; min-height: 200px !important; display: flex !important; align-items: center !important; justify-content: center !important; padding: 1.5rem !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
.wallet-em-page .wallet-js-card-orange .card-body { padding: 0 !important; border: none !important; background: transparent !important; display: flex !important; align-items: center !important; justify-content: center !important; }
.wallet-em-page .wallet-js-card-orange .wallet-js-graphic { font-size: 4rem; color: rgba(0,0,0,0.3); }
.wallet-em-page .wallet-js-two-cols { display: flex !important; flex-wrap: wrap !important; gap: 0.75rem !important; width: 100% !important; }
.wallet-em-page .wallet-js-two-cols .wallet-js-col-blue,
.wallet-em-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; min-width: 140px; max-width: none; }
.wallet-em-page .wallet-js-packages-row { display: flex !important; flex-wrap: wrap !important; align-items: stretch !important; }
.wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { flex: 1 1 0 !important; min-width: 200px; display: flex !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card { display: flex !important; flex-direction: column !important; flex: 1 1 100% !important; min-height: 200px !important; background: #fff !important; border-radius: 12px !important; box-shadow: 0 1px 4px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body { flex: 1 1 auto !important; display: flex !important; flex-direction: column !important; padding: 1rem 1.25rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-package-card-actions { margin-top: auto !important; padding-top: 0.75rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body h6 { font-size: 0.75rem !important; font-weight: 500 !important; color: #212529 !important; margin-bottom: 0.35rem !important; text-transform: uppercase !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-em-credits-validity { font-size: 0.775rem !important; color: #495057 !important; margin-bottom: 0.5rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-price { font-size: 0.75rem !important; font-weight: 500 !important; color: #1a1a2e !important; margin-bottom: 0.5rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-main-desc { font-size: 0.77rem !important; color: #6c757d !important; line-height: 1.5 !important; margin-bottom: 0 !important; }
.wallet-em-page .wallet-js-packages-row .btn { border-radius: 8px !important; font-weight: 600 !important; }
@media (max-width: 991px) {
    .wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 calc(50% - 1rem) !important; min-width: 180px; }
}
@media (max-width: 575px) {
    .wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 100% !important; min-width: 0; }
    .wallet-em-page .wallet-js-packages-row .wallet-package-card { min-height: 180px !important; }
}
.wallet-em-page .wallet-package-card-current { border: 2px solid #198754 !important; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2); position: relative; }
.wallet-em-page .wallet-package-card-current .wallet-current-badge { position: absolute; top: 0.5rem; right: 0.5rem; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; background: #198754; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="wallet-em-page">
    <div class="row mb-4">
        <div class="col-lg-3 col-xl-3 mb-4 mb-lg-0">
            <div class="wallet-js-two-cols">
                <div class="wallet-js-col-blue">
                    <?php if (isset($component)) { $__componentOriginalc107e2f90dff5eb05519f33918d2c807 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc107e2f90dff5eb05519f33918d2c807 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.index','data' => ['class' => 'border-0 wallet-js-card-blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-0 wallet-js-card-blue']); ?>
                        <?php if (isset($component)) { $__componentOriginal4fdb92edf089f19cd17d37829580c9a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fdb92edf089f19cd17d37829580c9a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => ['class' => 'p-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'p-0']); ?>
                            <h6 class="wallet-js-coins-title mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_available_coins')); ?></h6>
                            <div class="wallet-js-coins-value">
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-coin'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'd-block','style' => 'font-size:1.25rem;']); ?>
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
                                <?php echo e(format_credits_short($account->credits ?? 0)); ?>

                            </div>
                            <div class="wallet-js-coins-row">
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-coin'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                <?php echo e(trans('plugins/job-board::dashboard.wallet_bonus')); ?> <?php echo e(format_credits_short($bonusCredits ?? 0)); ?>

                            </div>
                            <div class="wallet-js-coins-row">
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-coin'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                <?php echo e(trans('plugins/job-board::dashboard.wallet_purchased')); ?> <?php echo e(format_credits_short($purchasedCredits ?? 0)); ?>

                            </div>
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
                        <?php if (isset($component)) { $__componentOriginal00609f0158ec6107e317b89bf18d2d23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00609f0158ec6107e317b89bf18d2d23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.footer.index','data' => ['class' => 'py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'py-2']); ?>
                            <?php if(isset($packageExpiryAt) && $packageExpiryAt): ?>
                                <p class="small text-white mb-2 opacity-90"><?php echo e(trans('plugins/job-board::dashboard.wallet_package_expires')); ?>: <strong><?php echo e($packageExpiryAt->format('M d, Y')); ?></strong></p>
                            <?php endif; ?>
                            <?php if(isset($jobPostsAllowed) && $jobPostsAllowed > 0): ?>
                                <p class="small text-white mb-1 opacity-90"><?php echo e(trans('plugins/job-board::dashboard.wallet_job_posts_used_allowed', ['used' => $jobPostsUsed ?? 0, 'allowed' => $jobPostsAllowed])); ?></p>
                            <?php endif; ?>
                            <?php if(isset($profileViewsAllowed) && $profileViewsAllowed > 0): ?>
                                <p class="small text-white mb-2 opacity-90"><?php echo e(trans('plugins/job-board::dashboard.wallet_profile_views_used_allowed', ['used' => $profileViewsUsed ?? 0, 'allowed' => $profileViewsAllowed])); ?></p>
                            <?php endif; ?>
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
        <div class="col-lg-9 col-xl-9">
            <div class="d-flex justify-content-between align-items-center mb-2" id="choose-plan">
                <h5 class="mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_choose_plan')); ?></h5>
                <small class="text-muted"><?php echo e(trans('plugins/job-board::dashboard.wallet_all_prices_gst')); ?></small>
            </div>
            <div class="row wallet-js-packages-row g-3">
                <?php $__currentLoopData = $packages ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isCurrentPackage = in_array($package->id, $currentPackageIds ?? []); ?>
                    <div class="col wallet-js-package-col">
                        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['card wallet-package-card', 'border-warning' => $package->is_default, 'wallet-package-card-current' => $isCurrentPackage]); ?>">
                            <?php if($isCurrentPackage): ?>
                                <span class="wallet-current-badge"><?php echo e(__('Current')); ?></span>
                            <?php endif; ?>
                            <?php if($package->percent_save): ?>
                                <div class="card-header py-1 bg-success text-white small text-center">
                                    <?php echo e($package->percent_save_text); ?>

                                </div>
                            <?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal4fdb92edf089f19cd17d37829580c9a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fdb92edf089f19cd17d37829580c9a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => ['class' => 'pb-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'pb-2']); ?>
                                <h6 class="text-uppercase"><?php echo e($package->name); ?></h6>
                                <p class="wallet-em-credits-validity"><?php echo e(format_credits_short($package->credits_included ?? $package->number_of_listings)); ?> <?php echo e(trans('plugins/job-board::dashboard.credits')); ?><?php if($package->validity_days): ?> · <?php echo e(trans('plugins/job-board::dashboard.package_validity_days', ['days' => $package->validity_days])); ?><?php endif; ?></p>
                                <p class="wallet-package-price"><?php echo e($package->price_text); ?></p>
                                <?php if(trim((string) $package->description) !== ''): ?>
                                    <p class="wallet-package-main-desc"><?php echo e($package->description); ?></p>
                                <?php elseif($packageFeatures = $package->formatted_features): ?>
                                    <p class="wallet-package-main-desc"><?php echo e(is_array($packageFeatures) ? implode(' ', $packageFeatures) : $packageFeatures); ?></p>
                                <?php endif; ?>
                                <div class="wallet-package-card-actions">
                                <?php if (isset($component)) { $__componentOriginald83dae5750a07af1a413e54a0071b325 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald83dae5750a07af1a413e54a0071b325 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.index','data' => ['url' => route('public.account.package.subscribe.put'),'method' => 'put']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('public.account.package.subscribe.put')),'method' => 'put']); ?>
                                    <input type="hidden" name="id" value="<?php echo e($package->id); ?>">
                                    <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['type' => 'submit','class' => 'w-100 btn-sm','color' => ''.e($package->is_default ? 'warning' : 'primary').'','disabled' => $package->isPurchased()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'w-100 btn-sm','color' => ''.e($package->is_default ? 'warning' : 'primary').'','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($package->isPurchased())]); ?>
                                        <?php echo e($package->isPurchased() ? trans('plugins/job-board::dashboard.purchased_label') : trans('plugins/job-board::dashboard.wallet_buy_now')); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald83dae5750a07af1a413e54a0071b325)): ?>
<?php $attributes = $__attributesOriginald83dae5750a07af1a413e54a0071b325; ?>
<?php unset($__attributesOriginald83dae5750a07af1a413e54a0071b325); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald83dae5750a07af1a413e54a0071b325)): ?>
<?php $component = $__componentOriginald83dae5750a07af1a413e54a0071b325; ?>
<?php unset($__componentOriginald83dae5750a07af1a413e54a0071b325); ?>
<?php endif; ?>
                                </div>
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
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-4 mb-lg-0 mb-4" > 
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
                    <?php if (isset($component)) { $__componentOriginal61297c2b6766060b621d6f9a17b28154 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61297c2b6766060b621d6f9a17b28154 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.title','data' => ['class' => 'mb-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-0']); ?><?php echo e(trans('plugins/job-board::dashboard.wallet_billing_details')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $attributes = $__attributesOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__attributesOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $component = $__componentOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__componentOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#walletBillingModal"><?php echo e(__('Add Remaining Details')); ?></button>
                    <div class="mt-2 small" id="wallet-em-remaining-details">
                        <div class="border rounded p-2 bg-light mt-2">
                            <p class="mb-1"><strong>Name:</strong> <?php echo e($account->name ?? trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) ?: '—'); ?></p>
                            <p class="mb-1"><strong>Address:</strong> <?php echo e($account->address ?? '—'); ?></p>
                            <p class="mb-1"><strong>Mobile:</strong> <?php echo e($account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : '—'); ?></p>
                            <p class="mb-1"><strong>State:</strong> <?php echo e($account->state_name ?? '—'); ?></p>
                            <p class="mb-0"><strong>GST No:</strong> <?php echo e($account->billing_gst_number ?? '—'); ?></p>
                        </div>
                    </div>
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
        <div class="col-lg-12 col-md-12">
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
                    <?php if (isset($component)) { $__componentOriginal61297c2b6766060b621d6f9a17b28154 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61297c2b6766060b621d6f9a17b28154 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.title','data' => ['class' => 'mb-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-0']); ?><?php echo e(trans('plugins/job-board::dashboard.wallet_coins_consumption')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $attributes = $__attributesOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__attributesOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $component = $__componentOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__componentOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
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
                    <?php
                        $siteName = $siteName ?? \Botble\Theme\Facades\Theme::getSiteTitle();
                        if (!empty($creditConsumption)) {
                            $consumptionList = $creditConsumption;
                        } else {
                            $consumption = $account->isEmployer()
                                ? trans('plugins/job-board::dashboard.wallet_consumption_employer')
                                : trans('plugins/job-board::dashboard.wallet_consumption_jobseeker');
                            $consumptionList = is_array($consumption) ? $consumption : [];
                        }
                    ?>
                    <ul class="list-unstyled mb-0">
                        <?php if(!empty($creditConsumption)): ?>
                            <?php $__currentLoopData = $consumptionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span><?php echo e(is_array($item) ? ($item['label'] ?? $key) : $key); ?></span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted small"><?php echo e(is_array($item) ? ($item['credits'] ?? 0) . ' ' . trans('plugins/job-board::credit-consumption.credits') : $item); ?></span>
                                        <?php if($account->isEmployer() && is_array($item) && !empty($item['credits'])): ?>
                                            <?php $featureActiveWithPackage = in_array($key, $activePackageFeatureKeys ?? []); ?>
                                            <?php if($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0): ?>
                                                <button type="button" class="btn btn-xs btn-outline-warning" data-bs-toggle="modal" data-bs-target="#walletJobPostSlotModal" title="<?php echo e(trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post')); ?>">
                                                    <?php echo e(__('Use credits')); ?>

                                                </button>
                                            <?php elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW && isset($profileViewCreditsRequired) && $profileViewCreditsRequired > 0): ?>
                                                <?php if(isset($profileViewCreditsBalance)): ?>
                                                    <span class="text-muted small me-1"><?php echo e(trans('plugins/job-board::dashboard.wallet_profile_view_slot_balance', ['count' => $profileViewCreditsBalance])); ?></span>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-xs btn-outline-info" data-bs-toggle="modal" data-bs-target="#walletProfileViewSlotModal" title="<?php echo e(trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view')); ?>">
                                                    <?php echo e(trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view')); ?>

                                                </button>
                                            <?php elseif($key !== \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING): ?>
                                                <?php if($featureActiveWithPackage && isset($packageExpiryAt) && $packageExpiryAt): ?>
                                                    <span class="badge bg-success" title="<?php echo e(trans('plugins/job-board::dashboard.wallet_valid_till_package', ['date' => $packageExpiryAt->format('M d, Y')])); ?>"><?php echo e(__('Valid till')); ?> <?php echo e($packageExpiryAt->format('M d, Y')); ?></span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary wallet-feature-use-credits-btn" disabled title="<?php echo e(__('Valid with package until expiry')); ?>">
                                                        <?php echo e(__('Use credits')); ?>

                                                    </button>
                                                <?php else: ?>
                                                    <button
                                                        type="button"
                                                        class="btn btn-xs btn-outline-primary wallet-feature-use-credits-btn"
                                                        data-feature-key="<?php echo e($key); ?>"
                                                        data-feature-label="<?php echo e($item['label'] ?? $key); ?>"
                                                        data-credits="<?php echo e((int) ($item['credits'] ?? 0)); ?>"
                                                    >
                                                        <?php echo e(__('Use credits')); ?>

                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <?php $__currentLoopData = $consumptionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span><?php echo e(str_replace(':site', $siteName, $label)); ?></span>
                                    <span class="text-muted small"><?php echo e($rate); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                    <!-- <?php if($account->isEmployer() && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0): ?>
                        <div class="mt-3 pt-3 border-top">
                            <?php if(isset($jobPostCreditsBalance)): ?>
                                <p class="small text-muted mb-2"><?php echo e(trans('plugins/job-board::dashboard.wallet_job_post_slot_balance', ['count' => $jobPostCreditsBalance])); ?></p>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#walletJobPostSlotModal">
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-plus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                <?php echo e(trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post')); ?>

                            </button>
                        </div>
                    <?php endif; ?> -->
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

    
    <?php if($account->isEmployer()): ?>
        <div class="modal fade" id="walletFeaturePurchaseModal" tabindex="-1" aria-labelledby="walletFeaturePurchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="walletFeaturePurchaseModalLabel"><?php echo e(__('Use credits')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0" id="walletFeaturePurchaseModalMsg"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        <button type="button" class="btn btn-primary" id="walletFeaturePurchaseConfirmBtn"><?php echo e(__('OK')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if($account->isEmployer() && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0): ?>
    <div class="modal fade" id="walletJobPostSlotModal" tabindex="-1" aria-labelledby="walletJobPostSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletJobPostSlotModalLabel"><?php echo e(trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_job_post_confirm_message', ['credits' => $jobPostCreditsRequired])); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="button" class="btn btn-primary" id="walletJobPostSlotConfirmBtn"><?php echo e(__('OK')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($account->isEmployer() && isset($profileViewCreditsRequired) && $profileViewCreditsRequired > 0): ?>
    <div class="modal fade" id="walletProfileViewSlotModal" tabindex="-1" aria-labelledby="walletProfileViewSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletProfileViewSlotModalLabel"><?php echo e(trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_profile_view_confirm_message', ['credits' => $profileViewCreditsRequired])); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="button" class="btn btn-primary" id="walletProfileViewSlotConfirmBtn"><?php echo e(__('OK')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php $__env->startPush('footer'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generic feature purchase modal
        var featureModalEl = document.getElementById('walletFeaturePurchaseModal');
        var featureConfirmBtn = document.getElementById('walletFeaturePurchaseConfirmBtn');
        var featureMsg = document.getElementById('walletFeaturePurchaseModalMsg');
        var activeFeatureKey = null;
        var activeCredits = 0;
        var activeLabel = '';

        document.querySelectorAll('.wallet-feature-use-credits-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                activeFeatureKey = btn.getAttribute('data-feature-key') || '';
                activeLabel = btn.getAttribute('data-feature-label') || activeFeatureKey;
                activeCredits = parseInt(btn.getAttribute('data-credits') || '0', 10) || 0;
                if (featureMsg) {
                    featureMsg.textContent = 'Use ' + activeCredits + ' credits for "' + activeLabel + '"?';
                }
                if (featureModalEl && window.bootstrap) {
                    (new bootstrap.Modal(featureModalEl)).show();
                }
            });
        });

        if (featureConfirmBtn) {
            featureConfirmBtn.addEventListener('click', function() {
                if (!activeFeatureKey) return;
                featureConfirmBtn.disabled = true;
                fetch('<?php echo e(route('public.account.wallet.purchase_feature')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ feature_key: activeFeatureKey })
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        if (featureModalEl && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(featureModalEl);
                            if (m) m.hide();
                        }
                        window.location.reload();
                    } else {
                        alert(data.message || '<?php echo e(trans('plugins/job-board::messages.insufficient_credits')); ?>');
                    }
                })
                .catch(function() {
                    alert('<?php echo e(__('Something went wrong.')); ?>');
                })
                .finally(function() { featureConfirmBtn.disabled = false; });
            });
        }

        var btn = document.getElementById('walletJobPostSlotConfirmBtn');
        if (!btn) return;
        btn.addEventListener('click', function() {
            btn.disabled = true;
            fetch('<?php echo e(route('public.account.wallet.purchase_job_post_slot')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    var modal = document.getElementById('walletJobPostSlotModal');
                    if (modal && window.bootstrap) {
                        var m = bootstrap.Modal.getInstance(modal);
                        if (m) m.hide();
                    }
                    if (typeof window.location !== 'undefined') window.location.reload();
                } else {
                    alert(data.message || '<?php echo e(trans('plugins/job-board::messages.insufficient_credits')); ?>');
                }
            })
            .catch(function() {
                alert('<?php echo e(__('Something went wrong.')); ?>');
            })
            .finally(function() { btn.disabled = false; });
        });

        var profileViewBtn = document.getElementById('walletProfileViewSlotConfirmBtn');
        if (profileViewBtn) {
            profileViewBtn.addEventListener('click', function() {
                profileViewBtn.disabled = true;
                fetch('<?php echo e(route('public.account.wallet.purchase_profile_view_slot')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        var modal = document.getElementById('walletProfileViewSlotModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || '<?php echo e(trans('plugins/job-board::messages.insufficient_credits')); ?>');
                    }
                })
                .catch(function() {
                    alert('<?php echo e(__('Something went wrong.')); ?>');
                })
                .finally(function() { profileViewBtn.disabled = false; });
            });
        }
    });
    </script>
    <?php $__env->stopPush(); ?>

    <div class="wallet-consumption-invoice-section">
    
    <?php if (isset($component)) { $__componentOriginalc107e2f90dff5eb05519f33918d2c807 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc107e2f90dff5eb05519f33918d2c807 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.index','data' => ['class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
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
            <?php if (isset($component)) { $__componentOriginal61297c2b6766060b621d6f9a17b28154 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61297c2b6766060b621d6f9a17b28154 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-report-money'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-2']); ?>
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
                <?php echo e(trans('plugins/job-board::dashboard.wallet_consumption_report')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $attributes = $__attributesOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__attributesOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $component = $__componentOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__componentOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
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
        <?php if (isset($component)) { $__componentOriginal4fdb92edf089f19cd17d37829580c9a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fdb92edf089f19cd17d37829580c9a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => ['class' => 'p-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'p-0']); ?>
            <?php if($transactions->isNotEmpty()): ?>
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0 wallet-consumption-table" style="table-layout: fixed; width: 100%;">
                        
                        <thead>
                            <tr>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_sl_no')); ?></th>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_date_of_transaction')); ?></th>
                                <th class="wallet-th-type"><?php echo e(trans('plugins/job-board::dashboard.wallet_type_of_transaction')); ?></th>
                                <th><?php echo e(__('Package')); ?></th>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_valid_till')); ?></th>
                                <th class="text-end"><?php echo e(trans('plugins/job-board::dashboard.wallet_amount_coins')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $runningBalance = $account->credits;
                                $sn = 0;
                                $packageValidFeatures = [\Botble\JobBoard\Models\CreditConsumption::FEATURE_FEATURED_JOB, \Botble\JobBoard\Models\CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER, \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY, \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE];
                            ?>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $sn++;
                                    $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits;
                                    $showValidTill = !$txn->isCredit() && isset($packageExpiryAt) && $packageExpiryAt && in_array($txn->feature_key ?? '', $packageValidFeatures);
                                ?>
                                <tr>
                                    <td><?php echo e($sn); ?></td>
                                    <td class="text-nowrap"><?php echo e($txn->created_at->format('M d, Y H:i')); ?></td>
                                    <td class="wallet-txn-description"><?php echo BaseHelper::clean($txn->getDescription()); ?></td>
                                    <td><?php echo e($txn->package_name ?? '—'); ?></td>
                                    <td class="text-nowrap small">
                                        <?php if($showValidTill): ?>
                                            <span class="text-success"><?php echo e($packageExpiryAt->format('M d, Y')); ?></span>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if($txn->isCredit()): ?>
                                            <span class="text-success fw-medium">+<?php echo e(format_credits_short($txn->credits)); ?></span>
                                        <?php else: ?>
                                            <span class="text-danger fw-medium">-<?php echo e(format_credits_short($txn->credits)); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($transactions->hasPages()): ?>
                    <div class="card-footer d-flex align-items-center">
                        <?php echo e($transactions->links()); ?>

                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="empty p-5 text-center">
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-receipt-off'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'display-4 text-muted']); ?>
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
                    <p class="empty-title mt-2"><?php echo e(trans('plugins/job-board::dashboard.wallet_no_consumption_yet')); ?></p>
                    <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['tag' => 'a','href' => route('public.account.packages'),'color' => 'primary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('public.account.packages')),'color' => 'primary','size' => 'sm']); ?>
                        <?php echo e(trans('plugins/job-board::dashboard.wallet_buy_credits')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>
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

    
    <?php if (isset($component)) { $__componentOriginalc107e2f90dff5eb05519f33918d2c807 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc107e2f90dff5eb05519f33918d2c807 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
            <?php if (isset($component)) { $__componentOriginal61297c2b6766060b621d6f9a17b28154 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61297c2b6766060b621d6f9a17b28154 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-file-invoice'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-2']); ?>
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
                <?php echo e(trans('plugins/job-board::dashboard.wallet_invoice_details')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $attributes = $__attributesOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__attributesOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61297c2b6766060b621d6f9a17b28154)): ?>
<?php $component = $__componentOriginal61297c2b6766060b621d6f9a17b28154; ?>
<?php unset($__componentOriginal61297c2b6766060b621d6f9a17b28154); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc35bfc4b98be5180558495d6fb99dd82 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc35bfc4b98be5180558495d6fb99dd82 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.actions','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['tag' => 'a','href' => route('public.account.invoices.index'),'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('public.account.invoices.index')),'size' => 'sm']); ?>
                    <?php echo e(trans('plugins/job-board::messages.view')); ?> <?php echo e(trans('plugins/job-board::messages.invoices')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc35bfc4b98be5180558495d6fb99dd82)): ?>
<?php $attributes = $__attributesOriginalc35bfc4b98be5180558495d6fb99dd82; ?>
<?php unset($__attributesOriginalc35bfc4b98be5180558495d6fb99dd82); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc35bfc4b98be5180558495d6fb99dd82)): ?>
<?php $component = $__componentOriginalc35bfc4b98be5180558495d6fb99dd82; ?>
<?php unset($__componentOriginalc35bfc4b98be5180558495d6fb99dd82); ?>
<?php endif; ?>
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
        <?php if (isset($component)) { $__componentOriginal4fdb92edf089f19cd17d37829580c9a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4fdb92edf089f19cd17d37829580c9a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => ['class' => 'p-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'p-0']); ?>
            <?php if($invoices->isNotEmpty()): ?>
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0">
                        <thead>
                            <tr>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_invoice_code')); ?></th>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_invoice_amount')); ?></th>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_invoice_status')); ?></th>
                                <th><?php echo e(trans('plugins/job-board::dashboard.wallet_invoice_date')); ?></th>
                                <th class="text-end"><?php echo e(trans('plugins/job-board::dashboard.wallet_actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $invoice->loadMissing('payment');
                                    $payment = $invoice->payment;
                                    $currency = $payment ? \Botble\JobBoard\Models\Currency::query()->where('title', strtoupper($payment->currency))->first() : null;
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('public.account.invoices.show', $invoice)); ?>" class="text-primary text-decoration-none fw-medium">#<?php echo e($invoice->code); ?></a>
                                    </td>
                                    <td><?php echo e(format_price($invoice->amount, $currency)); ?></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal86e87e37d100cbb441f5e9e293185347 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal86e87e37d100cbb441f5e9e293185347 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::badge','data' => ['color' => $invoice->status->getValue() === 'completed' ? 'success' : 'warning']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($invoice->status->getValue() === 'completed' ? 'success' : 'warning')]); ?>
                                            <?php echo e($invoice->status->label()); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal86e87e37d100cbb441f5e9e293185347)): ?>
<?php $attributes = $__attributesOriginal86e87e37d100cbb441f5e9e293185347; ?>
<?php unset($__attributesOriginal86e87e37d100cbb441f5e9e293185347); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal86e87e37d100cbb441f5e9e293185347)): ?>
<?php $component = $__componentOriginal86e87e37d100cbb441f5e9e293185347; ?>
<?php unset($__componentOriginal86e87e37d100cbb441f5e9e293185347); ?>
<?php endif; ?>
                                    </td>
                                    <td><?php echo e($invoice->created_at->format('M d, Y')); ?></td>
                                    <td class="text-end">
                                        <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['tag' => 'a','href' => route('public.account.invoices.show', $invoice),'size' => 'sm','color' => 'default','icon' => 'ti ti-eye']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('public.account.invoices.show', $invoice)),'size' => 'sm','color' => 'default','icon' => 'ti ti-eye']); ?>
                                            <?php echo e(trans('plugins/job-board::dashboard.wallet_view_invoice')); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['tag' => 'a','href' => route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download']),'size' => 'sm','color' => 'primary','icon' => 'ti ti-download','target' => '_blank','rel' => 'noopener','download' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])),'size' => 'sm','color' => 'primary','icon' => 'ti ti-download','target' => '_blank','rel' => 'noopener','download' => true]); ?>
                                            <?php echo e(trans('plugins/job-board::dashboard.wallet_download_invoice')); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($invoices->hasPages()): ?>
                    <div class="card-footer d-flex align-items-center">
                        <?php echo e($invoices->withQueryString()->links()); ?>

                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="empty p-5 text-center">
                    <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-file-off'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'display-4 text-muted']); ?>
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
                    <p class="empty-title mt-2"><?php echo e(trans('plugins/job-board::dashboard.wallet_no_invoices')); ?></p>
                </div>
            <?php endif; ?>
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

    
    <div class="modal fade" id="walletBillingModal" tabindex="-1" aria-labelledby="walletBillingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletBillingModalLabel"><?php echo e(__('Billing Details')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletBillingForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="billing_name"><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form-control" id="billing_name" name="name" placeholder="<?php echo e(__('Name')); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_address"><?php echo e(__('Address')); ?></label>
                            <textarea class="form-control" id="billing_address" name="address" rows="2" placeholder="<?php echo e(__('Address with City, State, Pin Code')); ?>"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_mobile"><?php echo e(__('Mobile No')); ?></label>
                            <input type="text" class="form-control" id="billing_mobile" name="mobile" placeholder="<?php echo e(__('Mobile No')); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_state"><?php echo e(__('State')); ?></label>
                            <input type="text" class="form-control" id="billing_state" name="state" placeholder="<?php echo e(__('State')); ?>">
                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="billing_gst"><?php echo e(__('GST No')); ?></label>
                            <input type="text" class="form-control" id="billing_gst" name="gst_number" placeholder="<?php echo e(__('GST No (if available)')); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        <button type="submit" class="btn btn-primary" id="walletBillingSubmit"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php if(isset($packageExpiryAt) && $packageExpiryAt && isset($packageExpiryName)): ?>
        <?php
            $now = \Carbon\Carbon::now();
            $isExpired = $packageExpiryAt->isPast();
            $daysUntilExpiry = (int) $now->diffInDays($packageExpiryAt, true);
            $expiringSoon = !$isExpired && $daysUntilExpiry <= 7;
        ?>
        <?php if($isExpired || $expiringSoon): ?>
            <div class="modal fade" id="walletPackageExpiryModal" tabindex="-1" aria-labelledby="walletPackageExpiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header <?php echo e($isExpired ? 'bg-danger text-white' : 'bg-warning'); ?>">
                            <h5 class="modal-title" id="walletPackageExpiryModalLabel"><?php echo e($isExpired ? __('Package Expired') : __('Package Expiring Soon')); ?></h5>
                            <button type="button" class="btn-close <?php echo e($isExpired ? 'btn-close-white' : ''); ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if($isExpired): ?>
                                <p class="mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_package_expired', ['name' => $packageExpiryName])); ?></p>
                            <?php else: ?>
                                <p class="mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_package_expiring_soon', ['name' => $packageExpiryName, 'date' => $packageExpiryAt->format('M d, Y')])); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <a href="#choose-plan" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(trans('plugins/job-board::dashboard.wallet_buy_credits')); ?></a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var expiryModal = document.getElementById('walletPackageExpiryModal');
    if (expiryModal && typeof bootstrap !== 'undefined') {
        var m = new bootstrap.Modal(expiryModal);
        m.show();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('walletBillingModal');
    var form = document.getElementById('walletBillingForm');
    var submitBtn = document.getElementById('walletBillingSubmit');
    if (!modal || !form) return;
    var billingDetailsUrl = '<?php echo e(route("public.account.billing-details")); ?>';
    var billingUpdateUrl = '<?php echo e(route("public.account.billing-details.update")); ?>';

    modal.addEventListener('show.bs.modal', function() {
        fetch(billingDetailsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.data) {
                    document.getElementById('billing_name').value = data.data.name || '';
                    document.getElementById('billing_address').value = data.data.address || '';
                    document.getElementById('billing_mobile').value = data.data.mobile || '';
                    document.getElementById('billing_state').value = data.data.state || '';
                    document.getElementById('billing_gst').value = data.data.gst_number || '';
                }
            })
            .catch(function() {});
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        var fd = new FormData(form);
        fetch(billingUpdateUrl, {
            method: 'POST',
            body: fd,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || fd.get('_token') }
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.error === false) {
                window.location.reload();
            } else {
                submitBtn.disabled = false;
                alert(res.message || 'Something went wrong.');
            }
        })
        .catch(function() { submitBtn.disabled = false; });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/wallet.blade.php ENDPATH**/ ?>