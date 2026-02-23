<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-3">
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
                        <?php echo e(trans('plugins/job-board::company.information')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <div class="text-center mb-3">
                        <img src="<?php echo e($company->logo_thumb); ?>" alt="<?php echo e($company->name); ?>" class="rounded" width="100" height="100">
                    </div>
                    
                    <dl class="row">
                        <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.name')); ?></dt>
                        <dd class="col-7"><?php echo e($company->name); ?></dd>
                        
                        <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.email')); ?></dt>
                        <dd class="col-7"><?php echo e($company->email ?: '—'); ?></dd>
                        
                        <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.phone')); ?></dt>
                        <dd class="col-7"><?php echo e($company->phone ?: '—'); ?></dd>
                        
                        <dt class="col-5"><?php echo e(trans('core/base::tables.status')); ?></dt>
                        <dd class="col-7"><?php echo BaseHelper::clean($company->status->toHtml()); ?></dd>
                        
                        <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.is_featured')); ?></dt>
                        <dd class="col-7">
                            <?php if($company->is_featured): ?>
                                <span class="badge bg-success text-success-fg"><?php echo e(trans('core/base::base.yes')); ?></span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?php echo e(trans('core/base::base.no')); ?></span>
                            <?php endif; ?>
                        </dd>
                        
                        <dt class="col-5"><?php echo e(trans('plugins/job-board::company.total_jobs')); ?></dt>
                        <dd class="col-7">
                            <span class="badge bg-blue text-blue-fg"><?php echo e($company->jobs_count); ?></span>
                        </dd>
                        
                        <dt class="col-5"><?php echo e(trans('plugins/job-board::company.total_reviews')); ?></dt>
                        <dd class="col-7">
                            <span class="badge bg-green text-green-fg"><?php echo e($company->reviews_count); ?></span>
                        </dd>
                    </dl>
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
            
            
            <div class="card mt-3">
                <?php if($company->is_verified): ?>
                    <div class="card-status-top bg-success"></div>
                <?php else: ?>
                    <div class="card-status-top bg-warning"></div>
                <?php endif; ?>
                
                <div class="card-header">
                    <h3 class="card-title">
                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-shield-check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        <?php echo e(trans('plugins/job-board::company.verification_section')); ?>

                    </h3>
                </div>
                
                <div class="card-body">
                    <?php if($company->is_verified): ?>
                        <div class="alert alert-success" role="alert">
                            <div class="d-flex">
                                <div class="me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="alert-title"><?php echo e(trans('plugins/job-board::company.verified')); ?></h4>
                                    <div class="text-secondary"><?php echo e(trans('plugins/job-board::company.company_verified_successfully')); ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="datagrid">
                                    <?php if($company->verifiedBy): ?>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title"><?php echo e(trans('plugins/job-board::company.verified_by')); ?></div>
                                            <div class="datagrid-content">
                                                <strong><?php echo e($company->verifiedBy->name); ?></strong>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if($company->verified_at): ?>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title"><?php echo e(trans('plugins/job-board::company.verified_at')); ?></div>
                                            <div class="datagrid-content">
                                                <?php echo e($company->verified_at->format('M d, Y H:i')); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php if($company->verification_note): ?>
                                <div class="col-12">
                                    <div class="card bg-blue-lt">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-notes'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                                <?php echo e(trans('plugins/job-board::company.verification_note')); ?>

                                            </h4>
                                            <p class="text-secondary mb-0"><?php echo e($company->verification_note); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#unverify-company-modal">
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-shield-x'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                <?php echo e(trans('plugins/job-board::company.unverify_company')); ?>

                            </button>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            <div class="d-flex">
                                <div class="me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="alert-title"><?php echo e(trans('plugins/job-board::company.not_verified')); ?></h4>
                                    <div class="text-secondary"><?php echo e(trans('plugins/job-board::company.company_not_verified_yet')); ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg text-muted mb-3" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
                                <circle cx="12" cy="11" r="1"></circle>
                                <line x1="12" y1="12" x2="12" y2="14.5"></line>
                            </svg>
                            <h3><?php echo e(trans('plugins/job-board::company.verification_pending')); ?></h3>
                            <p class="text-muted"><?php echo e(trans('plugins/job-board::company.click_verify_to_approve')); ?></p>
                            
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#verify-company-modal">
                                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-shield-check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                <?php echo e(trans('plugins/job-board::company.verify_company')); ?>

                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
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
                        <?php echo e(trans('plugins/job-board::company.recent_activity')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::card.body.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h4><?php echo e(trans('plugins/job-board::company.recent_jobs')); ?></h4>
                            <?php if($company->jobs()->count() > 0): ?>
                                <div class="list-group">
                                    <?php $__currentLoopData = $company->jobs()->latest()->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('jobs.edit', $job->id)); ?>" class="list-group-item list-group-item-action">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="mb-1"><?php echo e($job->name); ?></h5>
                                                    <small><?php echo e($job->created_at->diffForHumans()); ?></small>
                                                </div>
                                                <?php echo BaseHelper::clean($job->status->toHtml()); ?>

                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted"><?php echo e(trans('plugins/job-board::company.no_jobs_yet')); ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-6">
                            <h4><?php echo e(trans('plugins/job-board::company.company_details')); ?></h4>
                            <dl class="row">
                                <?php if($company->website): ?>
                                    <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.website')); ?></dt>
                                    <dd class="col-7"><a href="<?php echo e($company->website); ?>" target="_blank"><?php echo e($company->website); ?></a></dd>
                                <?php endif; ?>
                                
                                <?php if($company->year_founded): ?>
                                    <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.year_founded')); ?></dt>
                                    <dd class="col-7"><?php echo e($company->year_founded); ?></dd>
                                <?php endif; ?>
                                
                                <?php if($company->number_of_employees): ?>
                                    <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.number_of_employees')); ?></dt>
                                    <dd class="col-7"><?php echo e($company->number_of_employees); ?></dd>
                                <?php endif; ?>
                                
                                <?php if($company->number_of_offices): ?>
                                    <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.number_of_offices')); ?></dt>
                                    <dd class="col-7"><?php echo e($company->number_of_offices); ?></dd>
                                <?php endif; ?>
                                
                                <?php if($company->ceo): ?>
                                    <dt class="col-5"><?php echo e(trans('plugins/job-board::company.form.ceo')); ?></dt>
                                    <dd class="col-7"><?php echo e($company->ceo); ?></dd>
                                <?php endif; ?>
                            </dl>
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
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
    <?php if(!$company->is_verified): ?>
        <?php if (isset($component)) { $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::modal','data' => ['id' => 'verify-company-modal','title' => trans('plugins/job-board::company.verify_company_confirmation'),'buttonId' => 'confirm-verify-button','buttonLabel' => trans('plugins/job-board::company.verify_company'),'buttonClass' => 'btn-success','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'verify-company-modal','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/job-board::company.verify_company_confirmation')),'button-id' => 'confirm-verify-button','button-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/job-board::company.verify_company')),'button-class' => 'btn-success','size' => 'md']); ?>
            <?php if (isset($component)) { $__componentOriginald83dae5750a07af1a413e54a0071b325 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald83dae5750a07af1a413e54a0071b325 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.index','data' => ['url' => route('companies.verify', $company->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('companies.verify', $company->id))]); ?>
                <div class="alert alert-info" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="alert-title"><?php echo e(trans('plugins/job-board::company.verify_company_confirmation')); ?></h4>
                            <div class="text-secondary"><?php echo e(trans('plugins/job-board::company.verify_company_confirmation_desc', ['name' => $company->name])); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">
                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-notes'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        <?php echo e(trans('plugins/job-board::company.verification_note')); ?>

                    </label>
                    <textarea 
                        class="form-control" 
                        name="verification_note" 
                        rows="3" 
                        placeholder="<?php echo e(trans('plugins/job-board::company.verification_note_placeholder')); ?>"
                    ></textarea>
                    <small class="form-hint"><?php echo e(trans('plugins/job-board::company.verification_note_helper')); ?></small>
                </div>
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
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $attributes = $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $component = $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::modal','data' => ['id' => 'unverify-company-modal','title' => trans('plugins/job-board::company.unverify_company_confirmation'),'buttonId' => 'confirm-unverify-button','buttonLabel' => trans('plugins/job-board::company.unverify_company'),'buttonClass' => 'btn-warning','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'unverify-company-modal','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/job-board::company.unverify_company_confirmation')),'button-id' => 'confirm-unverify-button','button-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('plugins/job-board::company.unverify_company')),'button-class' => 'btn-warning','size' => 'md']); ?>
            <?php if (isset($component)) { $__componentOriginald83dae5750a07af1a413e54a0071b325 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald83dae5750a07af1a413e54a0071b325 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.index','data' => ['url' => route('companies.unverify', $company->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('companies.unverify', $company->id))]); ?>
                <div class="alert alert-warning" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"></path>
                                <path d="M12 9v4"></path>
                                <path d="M12 17h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="alert-title"><?php echo e(trans('plugins/job-board::company.unverify_company_confirmation')); ?></h4>
                            <div class="text-secondary"><?php echo e(trans('plugins/job-board::company.unverify_company_confirmation_desc', ['name' => $company->name])); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">
                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-notes'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        <?php echo e(trans('plugins/job-board::company.verification_note')); ?>

                    </label>
                    <textarea 
                        class="form-control" 
                        name="verification_note" 
                        rows="3" 
                        placeholder="<?php echo e(trans('plugins/job-board::company.verification_note_placeholder')); ?>"
                    ></textarea>
                    <small class="form-hint"><?php echo e(trans('plugins/job-board::company.verification_note_helper')); ?></small>
                </div>
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
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $attributes = $__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__attributesOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687)): ?>
<?php $component = $__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687; ?>
<?php unset($__componentOriginaldc8ac54b6bf7eb0d0560fdd5aa630687); ?>
<?php endif; ?>
    <?php endif; ?>
    
    <script>
        $(document).ready(function() {
            $('#confirm-verify-button').on('click', function(e) {
                e.preventDefault();
                var $button = $(this);
                var $form = $('#verify-company-modal form');
                
                $button.addClass('button-loading');
                
                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(response) {
                        if (response.error) {
                            Botble.showNotice('error', response.message);
                        } else {
                            Botble.showNotice('success', response.message);
                            $('#verify-company-modal').modal('hide');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        Botble.handleError(xhr);
                    },
                    complete: function() {
                        $button.removeClass('button-loading');
                    }
                });
            });
            
            $('#confirm-unverify-button').on('click', function(e) {
                e.preventDefault();
                var $button = $(this);
                var $form = $('#unverify-company-modal form');
                
                $button.addClass('button-loading');
                
                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(response) {
                        if (response.error) {
                            Botble.showNotice('error', response.message);
                        } else {
                            Botble.showNotice('success', response.message);
                            $('#unverify-company-modal').modal('hide');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        Botble.handleError(xhr);
                    },
                    complete: function() {
                        $button.removeClass('button-loading');
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/companies/view.blade.php ENDPATH**/ ?>