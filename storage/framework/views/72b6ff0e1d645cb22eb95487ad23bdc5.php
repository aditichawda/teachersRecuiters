<?php $__env->startSection('content'); ?>
<?php $e = $enquiryModel; ?>
<style>
.adm-detail-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 16px rgba(0,0,0,.06); border: 1px solid #e8ecf1; overflow: hidden; margin-bottom: 24px; }
.adm-detail-header { background: linear-gradient(135deg, #f8fafc 0%, #e8f4fc 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0; }
.adm-detail-header h4 { font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 4px 0; }
.adm-detail-header .adm-detail-meta { font-size: 0.8rem; color: #64748b; }
.adm-detail-body { padding: 20px 24px; }
.adm-detail-row { display: flex; padding: 12px 0; border-bottom: 1px solid #f1f5f9; gap: 16px; }
.adm-detail-row:last-child { border-bottom: none; padding-bottom: 0; }
.adm-detail-label { font-weight: 600; color: #475569; min-width: 160px; font-size: 0.9rem; flex-shrink: 0; }
.adm-detail-value { color: #0f172a; font-size: 0.95rem; }
.adm-detail-message { background: #f8fafc; border-radius: 10px; padding: 14px 18px; margin-top: 8px; color: #334155; line-height: 1.6; border-left: 4px solid #0073d1; }
.adm-back-btn { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff !important; border: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; }
.adm-back-btn:hover { background: linear-gradient(135deg, #005bb5 0%, #004a94 100%); color: #fff !important; }
</style>

<div class="adm-detail-card">
    <div class="adm-detail-header">
        <h4><i class="fa fa-graduation-cap me-2" style="color: #0073d1;"></i> <?php echo e(__('Admission Enquiry')); ?></h4>
        <p class="adm-detail-meta mb-0">
            <?php echo e(__('Submitted on')); ?> <?php echo e($e->created_at->format('M d, Y')); ?>

            <?php if($e->company): ?>
            · <strong><?php echo e($e->company->name); ?></strong>
            <?php endif; ?>
        </p>
    </div>
    <div class="adm-detail-body">
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Student Name')); ?></span><span class="adm-detail-value"><?php echo e($e->student_name); ?></span></div>
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Contact Number')); ?></span><span class="adm-detail-value"><?php echo e($e->contact_number); ?></span></div>
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Email')); ?></span><span class="adm-detail-value"><?php echo e($e->email ?: '–'); ?></span></div>
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Age')); ?></span><span class="adm-detail-value"><?php echo e($e->age ?? '–'); ?></span></div>
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Standard')); ?></span><span class="adm-detail-value"><?php echo e($e->admission_for_standard ?? '–'); ?></span></div>
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Address')); ?></span><span class="adm-detail-value adm-address-value"><?php echo e($e->address ?: '–'); ?></span></div>
        <?php if($e->message): ?>
        <div class="adm-detail-row"><span class="adm-detail-label"><?php echo e(__('Message')); ?></span><div class="adm-detail-message flex-grow-1"><?php echo e($e->message); ?></div></div>
        <?php endif; ?>
    </div>
</div>

<a href="<?php echo e(route('public.account.admission.edit')); ?>" class="btn adm-back-btn"><i class="fa fa-arrow-left me-2"></i> <?php echo e(__('Back to Admission Enquiries')); ?></a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/admission/account/enquiry-show.blade.php ENDPATH**/ ?>