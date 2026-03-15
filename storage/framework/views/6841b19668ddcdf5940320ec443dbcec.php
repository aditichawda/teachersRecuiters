<div class="jd-content-card" style="margin-top: 24px;">
    <h4 class="jd-section-title"><?php echo e(__('Location')); ?></h4>
    <?php if($job->latitude && $job->longitude): ?>
        <div class="job-board-street-map-container" style="margin-top: 16px; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
            <div class="job-board-street-map" style="width: 100%; height: 400px; min-height: 400px;"
                data-popup-id="#street-map-popup-template"
                data-center="<?php echo e(json_encode([$job->latitude, $job->longitude])); ?>"
                data-map-icon="<?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?>"></div>
        </div>
        <div class="d-none" id="street-map-popup-template">
            <div>
                <table width="100%">
                    <tr>
                        <td width="40">
                            <div >
                                <img src="<?php echo e($job->company_logo_thumb); ?>" width="40" alt="<?php echo e($job->company_name ?: $job->name); ?>">
                            </div>
                        </td>
                        <td>
                            <div class="infomarker">
                                <?php if($job->has_company): ?>
                                    <h5>
                                        <a href="<?php echo e($company->url); ?>" target="_blank"><?php echo e($company->name); ?> <?php echo $company->badge; ?></a>
                                    </h5>
                                <?php endif; ?>
                                <div class="text-info">
                                    <strong><?php echo e($job->name); ?></strong>
                                </div>
                                <div class="text-info">
                                    <i class="mdi mdi-account"></i>
                                    <span><?php echo e(__(':number Vacancy', ['number' => $job->number_of_positions])); ?></span>
                                    <?php if($job->jobTypes->count()): ?>
                                        <span>-</span>
                                        <?php $__currentLoopData = $job->jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e($jobType->name); ?><?php if(!$loop->last): ?>, <?php endif; ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if($job->full_address): ?>
                                    <div class="text-muted">
                                        <i class="uil uil-map"></i>
                                        <span><?php echo e($job->full_address); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div style="margin-top: 16px; padding: 20px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
            <?php if($job->full_address): ?>
                <p style="margin: 0; color: #475569; font-size: 15px;">
                    <i class="fas fa-map-marker-alt" style="color: #0ea5e9; margin-right: 8px;"></i>
                    <?php echo e($job->full_address); ?>

                </p>
            <?php elseif($job->location): ?>
                <p style="margin: 0; color: #475569; font-size: 15px;">
                    <i class="fas fa-map-marker-alt" style="color: #0ea5e9; margin-right: 8px;"></i>
                    <?php echo e($job->location); ?>

                </p>
            <?php else: ?>
                <p style="margin: 0; color: #94a3b8; font-size: 14px;">
                    <?php echo e(__('Location information not available')); ?>

                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/street-map.blade.php ENDPATH**/ ?>