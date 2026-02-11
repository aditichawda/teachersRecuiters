<?php if(! $account->id || ! $account->isEmployer()): ?>
    <div class="modal fade" id="applyExternalJob" tabindex="-1" aria-labelledby="applyExternalJob" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <?php if($externalJobApplicationForm): ?>
                        <?php echo $externalJobApplicationForm->renderForm(); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="applyNow" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="sign_up_popupLabel"><?php echo e(__('Apply For This Job')); ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="apl-job-inpopup">
                        <?php if($internalJobApplicationForm): ?>
                            <?php echo $internalJobApplicationForm->renderForm(); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/apply-modal.blade.php ENDPATH**/ ?>