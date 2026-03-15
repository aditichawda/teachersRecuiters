<?php
    Theme::set('pageTitle', trans('plugins/job-board::dashboard.menu.wallet'));
?>


<?php $__env->startSection('content'); ?>
    <style>
    /* Same blue card & package layout as employer wallet (wallet-em-page) */
    .wallet-js-page .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 0.60rem 1.25rem !important; min-height: 265px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
    .wallet-js-page .wallet-js-card-blue .card-body { padding: 0 !important; border: none !important; background: transparent !important; flex: 1 1 auto; min-height: 0; }
    .wallet-js-page .wallet-js-card-blue .card-footer { border: none !important; padding: 0.75rem 0 0 !important; background: transparent !important; flex-shrink: 0; }
    .wallet-js-page .wallet-js-card-blue .wallet-js-coins-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.95; margin-bottom: 0.35rem; }
    .wallet-js-page .wallet-js-card-blue .wallet-js-coins-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem; }
    .wallet-js-page .wallet-js-card-blue .wallet-js-coins-row { font-size: 0.8rem; opacity: 0.95; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem; }
    .wallet-js-page .wallet-js-two-cols { display: flex !important; flex-wrap: wrap !important; gap: 0.75rem !important; width: 100% !important; }
    .wallet-js-page .wallet-js-two-cols .wallet-js-col-blue,
    .wallet-js-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; min-width: 140px; max-width: none; }
    .wallet-js-page .row.mb-4:first-of-type .col-lg-3 { display: flex !important; }
    .wallet-js-page .row.mb-4:first-of-type .wallet-js-two-cols { flex: 1 1 100%; display: flex !important; min-height: 0; }
    .wallet-js-page .row.mb-4:first-of-type .wallet-js-col-blue { display: flex !important; }
    .wallet-js-page .row.mb-4:first-of-type .wallet-js-col-blue .card { flex: 1 1 auto !important; display: flex !important; }
    /* Package cards: same as employer (wallet-em-page) */
    .wallet-js-page .wallet-js-packages-row { display: flex !important; flex-wrap: wrap !important; align-items: stretch !important; }
    .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 1 1 0 !important; min-width: 200px; display: flex !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card { display: flex !important; flex-direction: column !important; flex: 1 1 100% !important; min-height: 200px !important; background: #fff !important; border-radius: 12px !important; box-shadow: 0 1px 4px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body { flex: 1 1 auto !important; display: flex !important; flex-direction: column !important; padding: 1rem 1.25rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-package-card-actions { margin-top: auto !important; padding-top: 0.75rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body h6 { font-size: 0.75rem !important; font-weight: 500 !important; color: #212529 !important; margin-bottom: 0.35rem !important; text-transform: uppercase !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-em-credits-validity { font-size: 0.775rem !important; color: #495057 !important; margin-bottom: 0.5rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-price { font-size: 0.75rem !important; font-weight: 500 !important; color: #1a1a2e !important; margin-bottom: 0.5rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-main-desc { font-size: 0.77rem !important; color: #6c757d !important; line-height: 1.5 !important; margin-bottom: 0 !important; }
    .wallet-js-page .wallet-js-packages-row .btn { border-radius: 8px !important; font-weight: 600 !important; }
    .wallet-js-page .wallet-package-card-current { border: 2px solid #198754 !important; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2); position: relative; }
    .wallet-js-page .wallet-package-card-current .wallet-current-badge { position: absolute; top: 0.5rem; right: 0.5rem; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; background: #198754; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; }
    @media (max-width: 991px) {
        .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 calc(50% - 1rem) !important; min-width: 180px; }
    }
    @media (max-width: 575px) {
        .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 100% !important; min-width: 0; }
        .wallet-js-page .wallet-js-packages-row .wallet-package-card { min-height: 180px !important; }
    }
    /* Consumption Report & Invoice Details - same UI as employer (shared section) */
    .wallet-consumption-invoice-section .card { background: #fff !important; border-radius: 10px !important; box-shadow: 0 1px 3px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; overflow: hidden; }
    .wallet-consumption-invoice-section .card .card-header {display: flex !important;
        justify-content: space-between !important;  background: #fff !important; border-bottom: 1px solid rgba(0,0,0,0.08) !important; padding: 1rem 1.25rem !important; }
    .wallet-consumption-invoice-section .card .card-title { font-size: 1rem !important; font-weight: 600 !important; color: #1a1a2e !important; margin: 0 !important; display: flex !important; align-items: center !important; }
    .wallet-consumption-invoice-section .table { font-size: 0.9rem; }
    /* Remove all table borders (override .table > :not(:first-child) { border-top: 2px solid currentColor } etc) */
    .wallet-consumption-invoice-section .table > :not(:first-child) { border-top: none !important; }
    .wallet-consumption-invoice-section .table > :not(caption) > * > * { border: none !important; border-top: none !important; }
    .wallet-consumption-invoice-section .table thead th { font-weight: 600 !important; color: #495057 !important; text-transform: uppercase !important; font-size: 0.7rem !important; letter-spacing: 0.03em !important; padding: 0.75rem 1rem !important; background: #f8f9fa !important; border: none !important; border-bottom: 1px solid #dee2e6 !important; text-align: left !important; }
    .wallet-consumption-invoice-section .table tbody tr { border-bottom: none !important; border-top: none !important; background: #fff !important; }
    .wallet-consumption-invoice-section .table tbody td { padding: 0.75rem 1rem !important; vertical-align: middle !important; color: #212529 !important; border: none !important; text-align: left !important; }
    .wallet-consumption-invoice-section .table tbody td.text-end { text-align: right !important; }
    .wallet-consumption-invoice-section .table a.text-primary { color: #0d6efd !important; text-decoration: none !important; font-weight: 500 !important; }
    .wallet-consumption-invoice-section .table a.text-primary:hover { text-decoration: underline !important; }
    .wallet-consumption-invoice-section .card-actions .btn { background: #6c757d !important; border-color: #6c757d !important; color: #fff !important; font-size: 0.875rem !important; border-radius: 6px !important; }
    .wallet-consumption-invoice-section .card-actions .btn:hover { background: #5a6268 !important; border-color: #545b62 !important; color: #fff !important; }
    /* View = outline grey, Download = blue - same as screenshot */
    .wallet-consumption-invoice-section .card-body .text-end .btn { font-size: 0.875rem !important; font-weight: 400 !important; display: inline-flex !important; align-items: center !important; border-radius: 6px !important; padding: 0.35rem 0.65rem !important; }
    .wallet-consumption-invoice-section .card-body .btn-default { background: #fff !important; border: 1px solid #6c757d !important; color: #495057 !important; }
    .wallet-consumption-invoice-section .card-body .btn-primary { background: #007bff !important; border: none !important; color: #fff !important; }
    .wallet-consumption-invoice-section .card-body .text-end .btn + .btn { margin-left: 0.4rem !important; }
    /* Consumption Report: 6 cols - S.No, Date, Type, Package, Coins, Current Balance - clear UI */
    .wallet-consumption-invoice-section .table-responsive { overflow-x: visible !important; }
    .wallet-consumption-invoice-section .wallet-consumption-table { table-layout: fixed !important; width: 100% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th { background: #f1f5f9 !important; color: #334155 !important; font-weight: 600 !important; font-size: 0.75rem !important; text-transform: uppercase !important; letter-spacing: 0.02em !important; padding: 0.65rem 0.5rem !important; border-bottom: 2px solid #e2e8f0 !important; word-break: break-word !important; overflow-wrap: break-word !important; line-height: 1.25 !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th.wallet-th-type { white-space: normal !important; }
.wallet-consumption-invoice-section .wallet-consumption-table tbody td { padding: 0.85rem 0.5rem !important; vertical-align: top !important; border-bottom: 1px solid #f1f5f9 !important; font-size: 0.9rem !important; }
.wallet-consumption-invoice-section .wallet-consumption-table .wallet-txn-description { display: block !important; line-height: 1.5 !important; word-break: break-word !important; white-space: normal !important; }
   </style>
    <div class="wallet-js-page">
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
                                <h6 class="wallet-js-coins-title mb-0 text-uppercase"><?php echo e(trans('plugins/job-board::dashboard.wallet_available_coins')); ?></h6>
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
                                    <p class="small text-white mb-0 opacity-90"><?php echo e(trans('plugins/job-board::dashboard.wallet_package_expires')); ?>: <strong><?php echo e($packageExpiryAt->format('M d, Y')); ?></strong></p>
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
                    
                    <?php if(isset($jobSeekerCtx) && $jobSeekerCtx && $jobSeekerCtx->hasPackage()): ?>
                    <div class="wallet-js-col-blue">
                        <div class="card border-0 h-100 shadow-sm rounded-3 overflow-hidden" style="background: #fff; border: 1px solid #e9ecef !important; min-height: 265px;">
                            <div class="card-body p-3 d-flex flex-column">
                                <h6 class="mb-2 small text-uppercase text-muted fw-bold"><?php echo e(__('Your Plan')); ?></h6>
                                <div class="small flex-grow-1">
                                    <?php
                                        $used = $jobSeekerCtx->jobApplicationsUsed;
                                        $limit = $jobSeekerCtx->jobApplyLimit;
                                    ?>
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <span><i class="fa fa-briefcase me-1"></i> <?php echo e(__('Job applications')); ?></span>
                                        <?php if($limit === null): ?>
                                            <span class="text-success"><?php echo e(__('Unlimited')); ?></span>
                                        <?php else: ?>
                                            <span><?php echo e($used); ?>/<?php echo e($limit); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <span><i class="fa fa-star me-1"></i> <?php echo e(__('Featured Profile')); ?></span>
                                        <?php if($jobSeekerCtx->hasFeaturedProfile()): ?>
                                            <span class="text-success"><i class="fa fa-check"></i></span>
                                        <?php else: ?>
                                            <a href="<?php echo e($jobSeekerCtx->packagesUrl()); ?>" class="btn btn-sm btn-outline-primary py-0 px-2"><?php echo e(__('Upgrade')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <span><i class="fa fa-address-card me-1"></i> <?php echo e(__('View contact info')); ?></span>
                                        <?php if($jobSeekerCtx->hasViewContactInfo()): ?>
                                            <span class="text-success"><i class="fa fa-check"></i></span>
                                        <?php else: ?>
                                            <a href="<?php echo e($jobSeekerCtx->packagesUrl()); ?>" class="btn btn-sm btn-outline-primary py-0 px-2"><?php echo e(__('Upgrade')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <span><i class="fa fa-whatsapp me-1"></i> <?php echo e(__('Job alerts on WhatsApp')); ?></span>
                                        <?php if($jobSeekerCtx->hasJobAlertsWhatsapp()): ?>
                                            <span class="text-success"><i class="fa fa-check"></i></span>
                                        <?php else: ?>
                                            <a href="<?php echo e($jobSeekerCtx->packagesUrl()); ?>" class="btn btn-sm btn-outline-primary py-0 px-2"><?php echo e(__('Upgrade')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <span><i class="fa fa-file-alt me-1"></i> <?php echo e(__('Basic CV')); ?></span>
                                        <?php if($jobSeekerCtx->hasBasicCv()): ?>
                                            <span class="text-success"><i class="fa fa-check"></i></span>
                                        <?php else: ?>
                                            <a href="<?php echo e($jobSeekerCtx->packagesUrl()); ?>" class="btn btn-sm btn-outline-primary py-0 px-2"><?php echo e(__('Upgrade')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <span><i class="fa fa-file-pdf me-1"></i> <?php echo e(__('Advance CV')); ?></span>
                                        <?php if($jobSeekerCtx->hasAdvanceCv()): ?>
                                            <span class="text-success"><i class="fa fa-check"></i></span>
                                        <?php else: ?>
                                            <a href="<?php echo e($jobSeekerCtx->packagesUrl()); ?>" class="btn btn-sm btn-outline-primary py-0 px-2"><?php echo e(__('Upgrade')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <a href="<?php echo e($jobSeekerCtx->packagesUrl()); ?>" class="btn btn-sm btn-primary w-100 mt-2"><?php echo e(__('View plans & Upgrade')); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-9 col-xl-9">
                <div class="d-flex justify-content-between align-items-center mb-2" id="choose-plan">
                    <h5 class="mb-0"><?php echo e(trans('plugins/job-board::dashboard.wallet_choose_plan_jobseeker')); ?></h5>
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
                                    <p class="wallet-em-credits-validity"><?php echo e(format_credits_short($package->credits_included ?? $package->number_of_listings)); ?> <?php echo e(trans('plugins/job-board::dashboard.credits')); ?><?php if($package->validity_days): ?> · <?php echo e(trans('plugins/job-board::dashboard.package_validity_days', ['days' => $package->validity_days])); ?><?php else: ?> · <?php echo e(__('Unlimited validity')); ?><?php endif; ?></p>
                                    <p class="wallet-package-price"><?php if((float)($package->price ?? 0) == 0): ?><?php echo e(__('Free')); ?><?php else: ?><?php echo e($package->price_text); ?><?php endif; ?></p>
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
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-3 mb-3">
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
                        <div class="mt-2 small" id="wallet-remaining-details">
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
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
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
                                $consumption = trans('plugins/job-board::dashboard.wallet_consumption_jobseeker');
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
                                            <?php if(is_array($item) && isset($item['credits'])): ?>
                                            <button type="button" class="btn btn-xs btn-outline-primary js-wallet-feature-btn" data-feature-key="<?php echo e($key); ?>" data-feature-label="<?php echo e($item['label'] ?? $key); ?>" data-credits="<?php echo e((int)($item['credits'] ?? 0)); ?>"><?php echo e(__('Use credits')); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $consumptionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                        <span><?php echo e(str_replace(':site', $siteName ?? '', $label)); ?></span>
                                        <span class="text-muted small"><?php echo e($rate); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
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

        
        <div class="modal fade" id="walletJsFeatureModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Features & Coins Consumption')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1 fw-medium" id="walletJsFeatureModalName"></p>
                        <p class="mb-1 text-danger fw-medium" id="walletJsFeatureModalInsufficient" style="display: none;"></p>
                        <p class="mb-0 text-muted small" id="walletJsFeatureModalMsg"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        
                        <button type="button" class="btn btn-primary" id="walletJsFeatureModalConfirmBtn"><?php echo e(__('Buy credits')); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentBalance = <?php echo e((int)($account->credits ?? 0)); ?>;
            var msgInsufficient = <?php echo json_encode(trans('plugins/job-board::dashboard.wallet_insufficient_coins'), 15, 512) ?>;
            var msgInsufficientDetail = <?php echo json_encode(trans('plugins/job-board::dashboard.wallet_insufficient_coins_message'), 15, 512) ?>;
            var creditsLabel = <?php echo json_encode(trans('plugins/job-board::credit-consumption.credits'), 15, 512) ?>;
            var msgRequiredBuy = <?php echo json_encode(__('required for this feature. Buy credits from Packages to use it.'), 15, 512) ?>;
            var purchaseUrl = <?php echo json_encode(route('public.account.jobseeker.wallet.purchase_feature'), 15, 512) ?>;
            var packagesUrl = <?php echo json_encode(route('public.account.jobseeker.packages') . '#choose-plan', 15, 512) ?>;
            var msgSuccess = <?php echo json_encode(__('Credits used successfully. Feature applied.'), 15, 512) ?>;
            var msgError = <?php echo json_encode(__('Something went wrong. Please try again.'), 15, 512) ?>;
            var lblUseCredits = <?php echo json_encode(__('Use credits'), 15, 512) ?>;
            var lblBuyCredits = <?php echo json_encode(__('Buy credits'), 15, 512) ?>;

            var modalFeatureKey = '';
            var modalCredits = 0;
            var modalHasEnoughBalance = false;
            var modalInstance = null;

            document.querySelectorAll('.js-wallet-feature-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    modalFeatureKey = btn.getAttribute('data-feature-key') || '';
                    var label = btn.getAttribute('data-feature-label') || '';
                    modalCredits = parseInt(btn.getAttribute('data-credits') || '0', 10) || 0;
                    modalHasEnoughBalance = currentBalance >= modalCredits;
                    var nameEl = document.getElementById('walletJsFeatureModalName');
                    var insufficientEl = document.getElementById('walletJsFeatureModalInsufficient');
                    var msgEl = document.getElementById('walletJsFeatureModalMsg');
                    var confirmBtn = document.getElementById('walletJsFeatureModalConfirmBtn');
                    if (nameEl) nameEl.textContent = label;
                    if (insufficientEl) {
                        insufficientEl.style.display = 'none';
                        insufficientEl.textContent = '';
                    }
                    if (!modalHasEnoughBalance) {
                        if (insufficientEl) {
                            insufficientEl.textContent = msgInsufficient;
                            insufficientEl.style.display = 'block';
                        }
                        if (msgEl) {
                            msgEl.textContent = msgInsufficientDetail
                                .replace(':balance', currentBalance)
                                .replace(':required', modalCredits);
                        }
                        if (confirmBtn) { confirmBtn.textContent = lblBuyCredits; confirmBtn.disabled = false; }
                    } else {
                        if (msgEl) msgEl.textContent = modalCredits + ' ' + creditsLabel + ' ' + msgRequiredBuy;
                        if (confirmBtn) { confirmBtn.textContent = lblUseCredits; confirmBtn.disabled = false; }
                    }
                    var modalEl = document.getElementById('walletJsFeatureModal');
                    if (modalEl && typeof bootstrap !== 'undefined') {
                        modalInstance = new bootstrap.Modal(modalEl);
                        modalInstance.show();
                    }
                });
            });

            var confirmBtn = document.getElementById('walletJsFeatureModalConfirmBtn');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    if (modalHasEnoughBalance && modalFeatureKey) {
                        confirmBtn.disabled = true;
                        var formData = new URLSearchParams();
                        formData.append('feature_key', modalFeatureKey);
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
                        fetch(purchaseUrl, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: formData.toString()
                        }).then(function(r) { return r.json(); }).then(function(data) {
                            if (data.success) {
                                if (modalInstance) modalInstance.hide();
                                alert(data.message || msgSuccess);
                                window.location.reload();
                            } else {
                                alert(data.message || msgError);
                                confirmBtn.disabled = false;
                            }
                        }).catch(function() {
                            alert(msgError);
                            confirmBtn.disabled = false;
                        });
                    } else {
                        window.location.href = packagesUrl;
                    }
                });
            }
        });
        </script>

        
        <div class="row mb-4">
            <div class="col-12">
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
                                    <th class="text-end"><?php echo e(trans('plugins/job-board::dashboard.wallet_amount_coins')); ?></th>
                                    <th class="text-end"><?php echo e(trans('plugins/job-board::dashboard.wallet_current_balance')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $runningBalance = $account->credits; $sn = 0; ?>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $sn++;
                                        $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits;
                                    ?>
                                    <tr>
                                        <td><?php echo e($sn); ?></td>
                                        <td class="text-nowrap"><?php echo e($txn->created_at->format('M d, Y H:i')); ?></td>
                                        <td class="wallet-txn-description"><?php echo BaseHelper::clean($txn->getDescription()); ?></td>
                                        <td><?php echo e($txn->package_name ?? '—'); ?></td>
                                        <td class="text-end">
                                            <?php if($txn->isCredit()): ?>
                                                <span class="text-success fw-medium">+<?php echo e(format_credits_short($txn->credits)); ?></span>
                                            <?php else: ?>
                                                <span class="text-danger fw-medium">-<?php echo e(format_credits_short($txn->credits)); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end"><?php echo e(format_credits_short($runningBalance)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($transactions->hasPages()): ?>
                        <div class="card-footer d-flex align-items-center"><?php echo e($transactions->links()); ?></div>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['tag' => 'a','href' => '#choose-plan','color' => 'primary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => '#choose-plan','color' => 'primary','size' => 'sm']); ?><?php echo e(trans('plugins/job-board::dashboard.wallet_buy_credits')); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['tag' => 'a','href' => route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download']),'size' => 'sm','color' => 'primary','icon' => 'ti ti-download','target' => '_blank','rel' => 'noopener','download' => 'invoice-'.e($invoice->code).'.pdf']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])),'size' => 'sm','color' => 'primary','icon' => 'ti ti-download','target' => '_blank','rel' => 'noopener','download' => 'invoice-'.e($invoice->code).'.pdf']); ?>
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
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : fd.get('_token') }
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/dashboard/wallet-jobseeker.blade.php ENDPATH**/ ?>