<?php if($job->latitude && $job->longitude): ?>
    <div>
        <h4 class="twm-s-title"><?php echo e(__('Location')); ?></h4>
        <div class="job-board-street-map-container">
            <div class="job-board-street-map"
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
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/street-map.blade.php ENDPATH**/ ?>