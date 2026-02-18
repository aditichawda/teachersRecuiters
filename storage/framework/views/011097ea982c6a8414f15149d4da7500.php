<?php
    Theme::set('pageTitle', __('Resume Builder'));
?>



<?php $__env->startSection('content'); ?>
<style>
    .rb-page-header {
        margin-bottom: 25px;
    }
    .rb-page-header h3 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0 0 6px 0;
    }
    .rb-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .rb-page-header p {
        font-size: 14px;
        color: #888;
        margin: 0;
    }

    /* Profile completeness warning */
    .rb-warning {
        background: #fff3e0;
        border: 1px solid #ffe0b2;
        border-radius: 10px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .rb-warning i {
        color: #e65100;
        font-size: 20px;
    }
    .rb-warning span {
        font-size: 13px;
        color: #555;
    }
    .rb-warning a {
        color: #0073d1;
        font-weight: 500;
    }

    /* Template Grid */
    .rb-templates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .rb-template-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 2px solid #f0f0f0;
        overflow: hidden;
        transition: all 0.3s;
        cursor: pointer;
        position: relative;
    }
    .rb-template-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transform: translateY(-4px);
        border-color: #0073d1;
    }
    .rb-template-card.selected {
        border-color: #0073d1;
        box-shadow: 0 4px 16px rgba(0,115,209,0.2);
    }
    .rb-template-card.selected::after {
        content: '✓';
        position: absolute;
        top: 12px;
        right: 12px;
        width: 28px;
        height: 28px;
        background: #0073d1;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        z-index: 5;
    }

    .rb-template-preview {
        height: 360px;
        overflow: hidden;
        position: relative;
        background: #f8f9fa;
        border-bottom: 1px solid #f0f0f0;
    }
    .rb-template-preview .preview-inner {
        transform: scale(0.45);
        transform-origin: top left;
        width: 222%;
        pointer-events: none;
    }
    .rb-template-preview .preview-fade {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(transparent, #fff);
    }

    .rb-template-info {
        padding: 16px 18px;
    }
    .rb-template-info h5 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 4px 0;
    }
    .rb-template-info p {
        font-size: 12px;
        color: #999;
        margin: 0 0 12px 0;
    }
    .rb-template-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .rb-template-tag {
        background: #f0f4ff;
        color: #0073d1;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
    }
    .rb-template-tag.tag-free {
        background: #e6f9ee;
        color: #1a9c4a;
    }

    /* Actions */
    .rb-actions {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        position: sticky;
        bottom: 20px;
        z-index: 10;
    }
    .rb-actions-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .rb-actions-left span {
        font-size: 14px;
        color: #555;
    }
    .rb-selected-name {
        font-weight: 600;
        color: #0073d1;
    }
    .rb-actions-right {
        display: flex;
        gap: 10px;
    }
    .btn-rb-preview {
        background: #fff;
        color: #0073d1;
        border: 1px solid #0073d1;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-rb-preview:hover {
        background: #f0f8ff;
        color: #0073d1;
        text-decoration: none;
    }
    .btn-rb-download {
        background: #0073d1;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-rb-download:hover {
        background: #005bb5;
    }

    /* Preview Modal */
    .rb-preview-modal .modal-dialog {
        max-width: 900px;
    }
    .rb-preview-modal .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }
    .rb-preview-modal .modal-header {
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 16px 20px;
    }
    .rb-preview-modal .modal-body {
        padding: 0;
        max-height: 80vh;
        overflow-y: auto;
    }
    .rb-preview-content {
        padding: 0;
    }

    @media (max-width: 768px) {
        .rb-templates-grid {
            grid-template-columns: 1fr;
        }
        .rb-actions {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        .rb-actions-right {
            justify-content: center;
        }
    }
    @media (max-width: 576px) {
        .rb-template-preview {
            height: 280px;
        }
    }
</style>

<div class="rb-page-header">
    <h3><i class="fa fa-file-pdf"></i> <?php echo e(__('Resume Builder')); ?></h3>
    <p><?php echo e(__('Choose Classic or Modern template. Resume uses your profile details (name, email, experience, education, skills). Empty fields show sample text so the resume always looks complete.')); ?></p>
</div>

<?php
    $missingFields = [];
    if (!$account->first_name) $missingFields[] = 'Name';
    if (!$account->email) $missingFields[] = 'Email';
    if (!$account->phone) $missingFields[] = 'Phone';
    if ($educations->isEmpty()) $missingFields[] = 'Education';
    if ($experiences->isEmpty()) $missingFields[] = 'Experience';
?>

<?php if(count($missingFields) > 0): ?>
<div class="rb-warning">
    <i class="fa fa-exclamation-triangle"></i>
    <span>
        <?php echo e(__('Complete your profile for a better resume.')); ?>

        <?php echo e(__('Missing:')); ?> <strong><?php echo e(implode(', ', $missingFields)); ?></strong>.
        <a href="<?php echo e(route('public.account.settings')); ?>"><?php echo e(__('Update Profile')); ?></a>
    </span>
</div>
<?php endif; ?>

<div class="rb-templates-grid">
    <!-- Template 1: Classic (Recommended) -->
    <div class="rb-template-card selected" data-template="classic" onclick="selectTemplate(this)">
        <div class="rb-template-preview">
            <div class="preview-inner">
                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.resume-templates.classic'), ['account' => $account, 'educations' => $educations, 'experiences' => $experiences, 'skills' => $skills], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="preview-fade"></div>
        </div>
        <div class="rb-template-info">
            <h5><?php echo e(__('Classic')); ?> <span class="badge bg-success ms-1" style="font-size: 10px;"><?php echo e(__('Recommended')); ?></span></h5>
            <p><?php echo e(__('Clean, professional layout. Uses your profile details; shows placeholder text when data is missing.')); ?></p>
            <div class="rb-template-tags">
                <span class="rb-template-tag tag-free">Free</span>
                <span class="rb-template-tag">Professional</span>
                <span class="rb-template-tag">ATS Friendly</span>
            </div>
        </div>
    </div>

    <!-- Template 2: Modern -->
    <div class="rb-template-card" data-template="modern" onclick="selectTemplate(this)">
        <div class="rb-template-preview">
            <div class="preview-inner">
                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.resume-templates.modern'), ['account' => $account, 'educations' => $educations, 'experiences' => $experiences, 'skills' => $skills], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="preview-fade"></div>
        </div>
        <div class="rb-template-info">
            <h5><?php echo e(__('Modern')); ?></h5>
            <p><?php echo e(__('Two-column design with sidebar. Profile details and dummy text when fields are empty.')); ?></p>
            <div class="rb-template-tags">
                <span class="rb-template-tag tag-free">Free</span>
                <span class="rb-template-tag">Creative</span>
                <span class="rb-template-tag">Two Column</span>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Action Bar -->
<div class="rb-actions">
    <div class="rb-actions-left">
        <i class="fa fa-check-circle" style="color: #0073d1; font-size: 18px;"></i>
        <span><?php echo e(__('Selected:')); ?> <span class="rb-selected-name" id="selected-template-name">Classic</span></span>
    </div>
    <div class="rb-actions-right">
        <button class="btn-rb-preview" onclick="previewResume()">
            <i class="fa fa-eye"></i> <?php echo e(__('Preview')); ?>

        </button>
        <button class="btn-rb-download" onclick="downloadResume()">
            <i class="fa fa-download"></i> <?php echo e(__('Download PDF')); ?>

        </button>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade rb-preview-modal" id="resumePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-file-pdf me-2"></i><?php echo e(__('Resume Preview')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="rb-preview-content" id="resume-preview-content">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                <button type="button" class="btn-rb-download" onclick="downloadResume()">
                    <i class="fa fa-download"></i> <?php echo e(__('Download PDF')); ?>

                </button>
            </div>
        </div>
    </div>
</div>

<script>
let selectedTemplate = 'classic';

function selectTemplate(card) {
    document.querySelectorAll('.rb-template-card').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
    selectedTemplate = card.dataset.template;
    document.getElementById('selected-template-name').textContent = selectedTemplate.charAt(0).toUpperCase() + selectedTemplate.slice(1);
}

function previewResume() {
    const url = '<?php echo e(route("public.account.resume-builder.download")); ?>?template=' + selectedTemplate;
    
    fetch(url)
        .then(res => res.text())
        .then(html => {
            document.getElementById('resume-preview-content').innerHTML = html;
            const modal = new bootstrap.Modal(document.getElementById('resumePreviewModal'));
            modal.show();
        })
        .catch(err => {
            console.error(err);
            alert('Failed to load preview');
        });
}

function downloadResume() {
    const url = '<?php echo e(route("public.account.resume-builder.download")); ?>?template=' + selectedTemplate;
    
    fetch(url)
        .then(res => res.text())
        .then(html => {
            // Open in new window for printing
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title><?php echo e($account->name); ?> - Resume</title>
                    <style>
                        @media print {
                            body { margin: 0; }
                            @page { margin: 0.5cm; size: A4; }
                        }
                    </style>
                </head>
                <body>
                    ${html}
                    <script>
                        window.onload = function() {
                            window.print();
                        };
                    <\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
        })
        .catch(err => {
            console.error(err);
            alert('Failed to generate resume');
        });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/resume-builder.blade.php ENDPATH**/ ?>