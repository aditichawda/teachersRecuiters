<?php $__env->startSection('content'); ?>
<style>
.adm-edit-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); border: 1px solid #f0f0f0; padding: 24px; margin-bottom: 24px; }
.adm-edit-card h4 { font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px; }
.adm-edit-card .form-label { font-weight: 600; color: #333; margin-bottom: 6px; }
.adm-edit-card .form-control, .adm-edit-card .form-select { border-radius: 8px; border: 1px solid #e0e0e0; padding: 10px 14px; }
.adm-edit-card .btn-primary { background: #0073d1; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 600; }
.adm-edit-card .btn-primary:hover { background: #005bb5; }
</style>

<?php if(session('success_msg')): ?>
    <div class="alert alert-success"><?php echo e(session('success_msg')); ?></div>
<?php endif; ?>
<?php if(session('error_msg')): ?>
    <div class="alert alert-danger"><?php echo e(session('error_msg')); ?></div>
<?php endif; ?>

<div class="adm-edit-card">
    <h4><i class="fa fa-graduation-cap"></i> <?php echo e(__('Admission Details')); ?></h4>
    <p class="text-muted small"><?php echo e(__('This content will be shown on the public Admission page for your institution.')); ?></p>

    <form action="<?php echo e(route('public.account.admission.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label class="form-label"><?php echo e(__('Admission content / details')); ?></label>
            <textarea name="content" class="form-control" rows="8" placeholder="<?php echo e(__('Enter admission information, eligibility, process, documents required, etc.')); ?>"><?php echo e(old('content', $admission->content)); ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label"><?php echo e(__('Admission deadline (optional)')); ?></label>
                <input type="date" name="admission_deadline" class="form-control" value="<?php echo e(old('admission_deadline', $admission->admission_deadline?->format('Y-m-d'))); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label"><?php echo e(__('Status')); ?></label>
                <select name="status" class="form-select">
                    <option value="published" <?php echo e(old('status', $admission->status) === 'published' ? 'selected' : ''); ?>><?php echo e(__('Published')); ?></option>
                    <option value="draft" <?php echo e(old('status', $admission->status) === 'draft' ? 'selected' : ''); ?>><?php echo e(__('Draft')); ?></option>
                </select>
                <small class="text-muted"><?php echo e(__('Published admission will appear on the Admission page.')); ?></small>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo e(__('Save Admission Details')); ?></button>
        <a href="<?php echo e(route('public.admission')); ?>" class="btn btn-outline-secondary ms-2" target="_blank"><?php echo e(__('View Admission Page')); ?></a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/admission/account/edit.blade.php ENDPATH**/ ?>