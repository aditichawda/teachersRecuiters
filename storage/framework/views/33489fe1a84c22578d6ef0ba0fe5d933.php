<?php if($company->latitude && $company->longitude): ?>
    <div>
        <h4 class="twm-s-title"><?php echo e(__('Location')); ?></h4>
        <div class="job-board-street-map-container">
            <div class="job-board-street-map"
                 data-popup-id="#street-map-popup-template"
                 data-center="<?php echo e(json_encode([$company->latitude, $company->longitude])); ?>"
                 data-map-icon="<?php echo e($company->name); ?>"></div>
        </div>
        <div class="d-none" id="street-map-popup-template">
            <div>
                <table width="100%">
                    <tr>
                        <td width="40">
                            <div >
                                <img src="<?php echo e($company->logo_thumb); ?>" width="40" alt="<?php echo e($company->name); ?>">
                            </div>
                        </td>
                        <td>
                            <div class="infomarker">
                                <h5>
                                    <a href="<?php echo e($company->url); ?>" target="_blank"> <?php echo e($company->name); ?></a>
                                </h5>
                                <div class="text-info">
                                    <strong> <?php echo e(__(':number Offices', ['number' => $company->number_of_offices])); ?></strong>
                                </div>
                                <div class="text-info">
                                    <i class="mdi mdi-account"></i>
                                    <span> <?php echo e(__(':number Employees', ['number' => $company->number_of_employees])); ?></span>
                                </div>
                                <?php if($company->full_address): ?>
                                    <div class="text-muted">
                                        <i class="uil uil-map"></i>
                                        <span><?php echo e($company->full_address); ?></span>
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
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/company-map.blade.php ENDPATH**/ ?>