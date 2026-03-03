<?php if(!$account->id || !$account->isEmployer()): ?>
    <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <?php if($internalJobApplicationForm): ?>
                        <?php echo $internalJobApplicationForm->renderForm(); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/views/job-board/partials/apply-modal.blade.php ENDPATH**/ ?>