<?php
    Theme::set('pageTitle', __('Admission'));
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
    Theme::layout('default');
?>

<style>
.adm-hero {
    background: linear-gradient(165deg, #e8f4fc 0%, #d4ebf7 40%, #b8dff0 100%);
    padding: 90px 0 50px;
    position: relative;
}
.adm-hero h1 { font-size: 32px; font-weight: 800; color: #0c1e3c; margin-bottom: 8px; }
.adm-hero p { color: #475569; font-size: 16px; margin: 0; }
.adm-section { padding: 50px 0; }
.adm-school-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 24px;
    transition: all 0.2s;
}
.adm-school-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.1); border-color: #0073d1; }
.adm-school-header {
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.adm-school-logo {
    width: 64px; height: 64px;
    border-radius: 12px;
    background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.adm-school-logo img { width: 100%; height: 100%; object-fit: contain; }
.adm-school-name { font-size: 18px; font-weight: 700; color: #0c1e3c; margin: 0; }
.adm-school-body { padding: 24px; }
.adm-school-body .content { color: #334155; line-height: 1.7; }
.adm-form-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: 1px solid #e2e8f0;
    padding: 28px;
    margin-top: 30px;
}
.adm-form-card h3 { font-size: 20px; font-weight: 700; color: #0c1e3c; margin-bottom: 20px; }
.adm-form-card .form-label { font-weight: 600; color: #334155; margin-bottom: 6px; }
.adm-form-card .form-control { border-radius: 8px; border: 1px solid #e2e8f0; padding: 10px 14px; }
.adm-form-card .btn-primary { background: #0073d1; border: none; border-radius: 8px; padding: 12px 24px; font-weight: 600; }
.adm-form-card .btn-primary:hover { background: #005bb5; }
.badge-featured { background: #0073d1; color: #fff; font-size: 11px; padding: 4px 8px; border-radius: 6px; }
</style>

<div class="adm-hero">
    <div class="container">
        <h1><?php echo e(__('Admission')); ?></h1>
        <p><?php echo e(__('Explore schools and submit your admission enquiry.')); ?></p>
    </div>
</div>

<div class="container adm-section">
    <div class="row">
        <div class="col-lg-8">
            <?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $admission = $company->admission; ?>
                <div class="adm-school-card">
                    <div class="adm-school-header">
                        <div class="adm-school-logo">
                            <?php if($company->logo): ?>
                                <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="<?php echo e($company->name); ?>">
                            <?php else: ?>
                                <span style="font-size:24px;color:#94a3b8;"><?php echo e(substr($company->name ?? '', 0, 1)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="adm-school-name">
                                <?php echo e($company->name); ?>

                                <?php if($company->is_featured): ?>
                                    <span class="badge-featured ms-2"><?php echo e(__('Featured')); ?></span>
                                <?php endif; ?>
                            </h2>
                            <?php if($admission->admission_deadline): ?>
                                <small class="text-muted"><?php echo e(__('Admission deadline')); ?>: <?php echo e($admission->admission_deadline->format('M d, Y')); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($admission->content): ?>
                        <div class="adm-school-body">
                            <div class="content"><?php echo BaseHelper::clean($admission->content); ?></div>
                        </div>
                    <?php endif; ?>
                    <div class="adm-school-body pt-0">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#enquiry-form-<?php echo e($company->id); ?>" aria-expanded="false">
                            <?php echo e(__('Submit Admission Enquiry')); ?>

                        </button>
                        <div class="collapse mt-3" id="enquiry-form-<?php echo e($company->id); ?>">
                            <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.admission.partials.enquiry-form'), ['company' => $company], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert alert-info"><?php echo e(__('No schools have published admission information yet.')); ?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4">
            <div class="adm-form-card">
                <h3><?php echo e(__('Admission Enquiry')); ?></h3>
                <p class="text-muted small"><?php echo e(__('Select a school above and use "Submit Admission Enquiry" to send your details.')); ?></p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/admission/index.blade.php ENDPATH**/ ?>