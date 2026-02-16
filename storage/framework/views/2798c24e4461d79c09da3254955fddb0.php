<?php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
    $isEdit = isset($job) && $job && $job->exists;
    $formAction = $isEdit ? route('public.account.jobs.update', $job->id) : route('public.account.jobs.store');
    $submitLabel = $isEdit ? __('Update Job') : __('Post Job');
    $pageTitle = $isEdit ? __('Edit Job') : __('Post a New Job');
    Theme::set('pageTitle', $pageTitle);
?>



<?php $__env->startSection('content'); ?>
<style>
    .jp-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        padding: 28px;
        margin-bottom: 24px;
    }
    .jp-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f0f0;
    }
    .jp-card-title i { color: #0073d1; margin-right: 8px; }
    .jp-label { font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 14px; }
    .jp-label .required { color: #dc3545; }
    .jp-label .hint { font-weight: 400; color: #888; font-size: 12px; margin-left: 4px; }
    .jp-input, .jp-select, .jp-textarea {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: border-color 0.2s;
        background: #fff;
    }
    .jp-input:focus, .jp-select:focus, .jp-textarea:focus {
        border-color: #0073d1;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .jp-textarea { min-height: 120px; resize: vertical; }
    .jp-error { color: #dc3545; font-size: 12px; margin-top: 4px; display: none; }
    .jp-error.show { display: block; }
    .jp-group { margin-bottom: 20px; }
    .jp-row { display: flex; gap: 20px; flex-wrap: wrap; }
    .jp-col-6 { flex: 0 0 calc(50% - 10px); max-width: calc(50% - 10px); }
    .jp-col-4 { flex: 0 0 calc(33.33% - 14px); max-width: calc(33.33% - 14px); }
    .jp-col-3 { flex: 0 0 calc(25% - 15px); max-width: calc(25% - 15px); }
    .jp-col-12 { flex: 0 0 100%; max-width: 100%; }
    @media (max-width: 768px) {
        .jp-col-6, .jp-col-4, .jp-col-3 { flex: 0 0 100%; max-width: 100%; }
        .jp-card { padding: 18px; }
        .jp-salary-type-tabs { flex-wrap: wrap; }
        .jp-salary-tab { flex: 1 1 auto; min-width: 80px; border-radius: 8px !important; margin: 2px; }
        .jp-option-cards { flex-direction: column; }
        .jp-option-card { width: 100%; }
        .jp-page-header { flex-direction: column; gap: 12px; align-items: flex-start; text-align: left; }
        .jp-page-header h2 { font-size: 18px; }
        .jp-row { gap: 12px; }
        .jp-group { margin-bottom: 16px; }
    }

    /* Down arrow for suggest/search dropdown inputs (Skills, Certifications, Language) */
    .jp-suggest-wrap .jp-input {
        padding-right: 2.25rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    /* Auto-suggest dropdown */
    .jp-suggest-wrap { position: relative; }
    .jp-suggest-list {
        position: absolute; top: 100%; left: 0; right: 0;
        background: #fff; border: 1px solid #e0e0e0; border-radius: 8px;
        max-height: 220px; overflow-y: auto; z-index: 100;
        display: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .jp-suggest-list.show { display: block; }
    .jp-suggest-item {
        padding: 10px 14px; cursor: pointer; font-size: 14px;
        border-bottom: 1px solid #f5f5f5;
    }
    .jp-suggest-item:hover, .jp-suggest-item.active { background: #e8f4fc; color: #0073d1; }

    /* Tag chips */
    .jp-tags-wrap { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
    .jp-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: #e8f4fc; color: #0073d1; border: 1px solid #0073d1;
        border-radius: 20px; padding: 4px 12px; font-size: 13px;
    }
    .jp-tag .remove { cursor: pointer; font-weight: 700; font-size: 16px; line-height: 1; }

    /* Checkbox/Radio cards */
    .jp-option-cards { display: flex; flex-wrap: wrap; gap: 10px; }
    .jp-option-card {
        border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px 20px;
        cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 8px;
        font-size: 14px; background: #fff;
    }
    .jp-option-card:hover { border-color: #0073d1; background: #f0f7ff; }
    .jp-option-card.selected { border-color: #0073d1; background: #e8f4fc; color: #0073d1; font-weight: 600; }
    .jp-option-card input { display: none; }

    /* Salary section */
    .jp-salary-type-tabs { display: flex; gap: 0; margin-bottom: 16px; }
    .jp-salary-tab {
        padding: 8px 20px; border: 1.5px solid #e0e0e0; cursor: pointer;
        font-size: 13px; background: #fff; transition: all 0.2s;
    }
    .jp-salary-tab:first-child { border-radius: 8px 0 0 8px; }
    .jp-salary-tab:last-child { border-radius: 0 8px 8px 0; }
    .jp-salary-tab.active { background: #0073d1; color: #fff; border-color: #0073d1; }

    /* Screening questions */
    .sq-list { display: flex; flex-direction: column; gap: 12px; }
    .sq-item {
        display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        padding: 16px 18px; transition: border-color 0.2s, box-shadow 0.2s;
    }
    .sq-item:hover { border-color: #d1d5db; }
    .sq-item-main { display: flex; align-items: flex-start; gap: 12px; flex: 1; min-width: 0; }
    .sq-select-cb { margin-top: 4px; width: 18px; height: 18px; accent-color: #0073d1; flex-shrink: 0; }
    .sq-item-content { flex: 1; min-width: 0; }
    .sq-question-text { display: block; cursor: pointer; margin: 0; font-size: 15px; font-weight: 500; color: #1f2937; line-height: 1.4; }
    .sq-type-badge { display: inline-block; margin-top: 6px; padding: 2px 10px; background: #f3f4f6; color: #6b7280; border-radius: 6px; font-size: 12px; text-transform: capitalize; }
    .sq-item-required { display: flex; align-items: center; gap: 8px; flex-shrink: 0; padding-left: 12px; border-left: 1px solid #e5e7eb; }
    .sq-item-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: 8px; width: 100%; }
    .sq-required-wrap { display: flex; align-items: center; gap: 6px; margin-left: auto; }
    .sq-required-cb { width: 16px; height: 16px; accent-color: #0073d1; }
    .sq-required-label { margin: 0; cursor: pointer; font-size: 13px; color: #6b7280; white-space: nowrap; }
    .sq-item-required:has(.sq-required-cb:not([disabled])) .sq-required-label { color: #374151; }
    .sq-empty-msg { margin: 0; padding: 20px; background: #f9fafb; border-radius: 10px; color: #6b7280; font-size: 14px; }

    /* Submit button */
    .jp-submit-btn {
        background: linear-gradient(135deg, #0073d1, #005bb5); color: #fff; border: none; padding: 14px 40px;
        border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
        transition: all 0.2s;
    }
    .jp-submit-btn:hover { background: linear-gradient(135deg, #005bb5, #003f8a); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,115,209,0.3); }
    .jp-submit-btn:disabled { background: #ccc; cursor: not-allowed; transform: none; }

    /* Hide salary checkbox */
    .jp-check-wrap { display: flex; align-items: center; gap: 8px; margin-top: 8px; }
    .jp-check-wrap input[type="checkbox"] { width: 18px; height: 18px; accent-color: #0073d1; }

    /* AI button */
    .jp-ai-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff; border: none; padding: 6px 14px; border-radius: 6px;
        font-size: 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;
    }
    .jp-ai-btn:hover { opacity: 0.9; }

    /* Link to create company */
    .jp-create-link { color: #0073d1; font-size: 13px; text-decoration: underline; cursor: pointer; }
    .jp-create-link:hover { color: #005bb5; }

    .jp-institution-type-badge {
        display: inline-block; background: #f0f4ff; color: #4a6cf7;
        padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;
    }

    /* Page header */
    .jp-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }
    .jp-page-header h2 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .jp-page-header a {
        color: #0073d1;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
    }

    /* Section headers - all sections visible by default */
    .jp-card-collapsible .jp-card-header {
        margin-bottom: 0;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f0f0;
    }
    .jp-card-collapsible .jp-card-header .jp-card-title { margin-bottom: 0; padding-bottom: 0; border: none; }
    .jp-card-collapsible .jp-card-body { overflow: visible; }
</style>

<!-- Page Header -->
<div class="jp-page-header">
    <h2><i class="fa <?php echo e($isEdit ? 'fa-edit' : 'fa-plus-circle'); ?>" style="color: #0073d1; margin-right: 8px;"></i><?php echo e($pageTitle); ?></h2>
    <a href="<?php echo e(route('public.account.jobs.index')); ?>"><i class="fa fa-list me-1"></i><?php echo e(__('View All Jobs')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-4" style="border-radius: 10px;">
        <strong><i class="fa fa-exclamation-triangle me-2"></i><?php echo e(__('Please fix the following errors:')); ?></strong>
        <ul class="mb-0 mt-2">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form id="jobPostForm" method="POST" action="<?php echo e($formAction); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($isEdit): ?><?php echo method_field('PUT'); ?><?php endif; ?>

    
    <div class="jp-card jp-card-collapsible" data-section="1">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-building"></i> Company & Job Details</div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        
        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Are you hiring for which school / institution? <span class="required">*</span></label>
                    <select name="company_id" id="company_id" class="jp-select" required>
                        <option value="">-- Select Company --</option>
                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" data-institution-type="<?php echo e($companyInstitutionTypes[$id] ?? ''); ?>" <?php echo e(old('company_id', optional($job)->company_id ?? '') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <small class="text-muted">Select company if already created.</small>
                    <a href="<?php echo e(route('public.account.companies.create')); ?>" class="jp-create-link d-block mt-1">
                        <i class="fa fa-plus"></i> Click here to create company / school
                    </a>
                    <div class="jp-error" id="err-company">Please select a company.</div>
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Institution Type <span class="hint">(Auto-filled from company)</span></label>
                    <div id="institution_type_display">
                        <span class="jp-institution-type-badge" id="inst-type-badge">Select a company first</span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Job Title <span class="required">*</span> <span class="hint">(Start typing to search)</span></label>
                    <div class="jp-suggest-wrap">
                        <input type="text" name="name" id="job_title" class="jp-input" placeholder="e.g. Primary English Teacher" value="<?php echo e(old('name', optional($job)->name ?? '')); ?>" required autocomplete="off">
                        <div class="jp-suggest-list" id="job-title-suggestions"></div>
                    </div>
                    <div class="jp-error" id="err-title">Job title is required.</div>
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Required Skills <span class="hint">(Select multiple)</span></label>
                    <div class="jp-suggest-wrap">
                        <input type="text" id="skills_search" class="jp-input" placeholder="Search & add skills..." autocomplete="off">
                        <div class="jp-suggest-list" id="skills-suggestions"></div>
                    </div>
                    <div class="jp-tags-wrap" id="selected-skills"></div>
                    <div id="skills-hidden-inputs"></div>
                </div>
            </div>
        </div>

        
        <div class="jp-group">
            <label class="jp-label">
                Detailed Job Description <span class="required">*</span>
                <button type="button" class="jp-ai-btn ms-2" id="aiGenerateBtn" title="Generate description based on job title">
                    <i class="fa fa-magic"></i> Generate with AI
                </button>
            </label>
            <textarea name="content" id="job_description" class="jp-textarea" rows="6" placeholder="Enter detailed job description or use AI to generate..." required><?php echo e(old('content', optional($job)->content ?? '')); ?></textarea>
            <div class="jp-error" id="err-description">Job description is required.</div>
        </div>

        
        <div class="jp-group">
            <label class="jp-label">Job Type <span class="required">*</span></label>
            <div class="jp-option-cards">
                <?php $jtCat = old('job_type_category', optional($job)->job_type_category ?? 'teaching'); ?>
                <label class="jp-option-card <?php echo e($jtCat === 'teaching' ? 'selected' : ''); ?>" onclick="selectOption(this, 'job_type_category')">
                    <input type="radio" name="job_type_category" value="teaching" <?php echo e($jtCat === 'teaching' ? 'checked' : ''); ?> required>
                    <i class="fa fa-chalkboard-teacher"></i> Teaching
                </label>
                <label class="jp-option-card <?php echo e($jtCat === 'non-teaching' ? 'selected' : ''); ?>" onclick="selectOption(this, 'job_type_category')">
                    <input type="radio" name="job_type_category" value="non-teaching" <?php echo e($jtCat === 'non-teaching' ? 'checked' : ''); ?>>
                    <i class="fa fa-briefcase"></i> Non-Teaching
                </label>
            </div>
            <div class="jp-error" id="err-job-type">Please select job type.</div>
        </div>
        </div>
    </div>

    
    <div class="jp-card jp-card-collapsible" data-section="2">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-rupee-sign"></i> Salary Details</div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        <?php
            $srVal = optional($job)->salary_range;
            $sr = old('salary_range', $srVal && is_object($srVal) ? $srVal->getValue() : ($srVal ?: 'monthly'));
            $salaryMode = (optional($job)->salary_to ?? 0) ? 'range' : 'fixed';
        ?>
        
        <div class="jp-row">
            <div class="jp-col-9">
                <div class="jp-group">
                    <label class="jp-label">Salary Period <span class="required">*</span></label>
                    <div class="jp-salary-type-tabs" id="salary-period-tabs">
                        <?php $__currentLoopData = $salaryRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="jp-salary-tab <?php echo e($key === ($sr ?? 'monthly') ? 'active' : ''); ?>" data-value="<?php echo e($key); ?>" onclick="selectSalaryPeriod(this)"><?php echo e($label); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="jp-salary-tab <?php echo e(($sr ?? '') === 'negotiable' ? 'active' : ''); ?>" data-value="negotiable" onclick="selectSalaryPeriod(this)">Negotiable</div>
                    </div>
                    <input type="hidden" name="salary_range" id="salary_range" value="<?php echo e($sr ?? 'monthly'); ?>">
                </div>
            </div>
            <div class="jp-col-3">
                <div class="jp-group">
                    <label class="jp-label">Salary Type</label>
                    <div class="jp-option-cards">
                        <label class="jp-option-card <?php echo e($salaryMode === 'range' ? 'selected' : ''); ?>" onclick="selectSalaryMode(this, 'range')">
                            <input type="radio" name="salary_mode" value="range" <?php echo e($salaryMode === 'range' ? 'checked' : ''); ?>> Range
                        </label>
                        <label class="jp-option-card <?php echo e($salaryMode === 'fixed' ? 'selected' : ''); ?>" onclick="selectSalaryMode(this, 'fixed')">
                            <input type="radio" name="salary_mode" value="fixed" <?php echo e($salaryMode === 'fixed' ? 'checked' : ''); ?>> Fixed
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div id="salary-amount-section" style="display: <?php echo e(($sr ?? '') === 'negotiable' ? 'none' : 'block'); ?>;">
            <div class="jp-row">
                <div class="jp-col-6">
                    <div class="jp-group">
                        <label class="jp-label">Salary From ₹</label>
                        <input type="number" name="salary_from" id="salary_from" class="jp-input" placeholder="e.g. 25000" value="<?php echo e(old('salary_from', optional($job)->salary_from ?? '')); ?>">
                    </div>
                </div>
                <div class="jp-col-6" id="salary-to-wrap" style="display: <?php echo e($salaryMode === 'fixed' ? 'none' : 'block'); ?>;">
                    <div class="jp-group">
                        <label class="jp-label">Salary To ₹</label>
                        <input type="number" name="salary_to" id="salary_to" class="jp-input" placeholder="e.g. 50000" value="<?php echo e(old('salary_to', optional($job)->salary_to ?? '')); ?>">
                    </div>
                </div>
            </div>
            <?php
                $inrCurrencyId = collect($currencies)->search(fn($t) => stripos($t, 'INR') !== false || stripos($t, '₹') !== false || stripos($t, 'Rupee') !== false);
                if ($inrCurrencyId === false) { $inrCurrencyId = get_application_currency_id() ?? array_key_first($currencies); }
            ?>
            <input type="hidden" name="currency_id" value="<?php echo e($inrCurrencyId); ?>">
            <div class="jp-group">
                <div class="jp-check-wrap">
                    <input type="checkbox" name="hide_salary" id="hide_salary" value="1" <?php echo e(old('hide_salary', optional($job)->hide_salary ?? 0) ? 'checked' : ''); ?>>
                    <label for="hide_salary" style="cursor:pointer; font-size:14px;">Hide Salary on Job Posting</label>
                </div>
            </div>
        </div>
        <input type="hidden" name="salary_type" id="salary_type" value="fixed">
        </div>
    </div>

    
    <div class="jp-card jp-card-collapsible" data-section="3">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-certificate"></i> Requirements</div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Required Qualification Level <span class="required">*</span></label>
                    <select name="degree_level_id" id="degree_level_id" class="jp-select" required>
                        <option value="">-- Select --</option>
                        <?php $__currentLoopData = $degreeLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" <?php echo e(old('degree_level_id', optional($job)->degree_level_id ?? '') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Experience Required <span class="required">*</span></label>
                    <select name="job_experience_id" id="job_experience_id" class="jp-select" required>
                        <option value="">-- Select --</option>
                        <?php $__currentLoopData = $jobExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" <?php echo e(old('job_experience_id', optional($job)->job_experience_id ?? '') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Required Teaching / Other Certifications <span class="hint">(Select multiple)</span></label>
                    <div class="jp-suggest-wrap">
                        <input type="text" id="cert_search" class="jp-input" placeholder="Search certifications..." autocomplete="off">
                        <div class="jp-suggest-list" id="cert-suggestions"></div>
                    </div>
                    <div class="jp-tags-wrap" id="selected-certs"></div>
                    <?php $reqCerts = old('required_certifications', optional($job)->required_certifications ?? '[]'); $reqCertsStr = is_array($reqCerts) ? json_encode($reqCerts) : ($reqCerts ?: '[]'); ?>
                    <input type="hidden" name="required_certifications" id="required_certifications" value="<?php echo e($reqCertsStr); ?>">
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Language Proficiency Required <span class="hint">(Select multiple)</span></label>
                    <div class="jp-suggest-wrap">
                        <input type="text" id="lang_search" class="jp-input" placeholder="Search languages..." autocomplete="off">
                        <div class="jp-suggest-list" id="lang-suggestions"></div>
                    </div>
                    <div class="jp-tags-wrap" id="selected-langs"></div>
                    <?php $langProf = old('language_proficiency', optional($job)->language_proficiency ?? '[]'); $langProfStr = is_array($langProf) ? json_encode($langProf) : ($langProf ?: '[]'); ?>
                    <input type="hidden" name="language_proficiency" id="language_proficiency" value="<?php echo e($langProfStr); ?>">
                </div>
            </div>
        </div>
        </div>
    </div>

    
    <div class="jp-card jp-card-collapsible" data-section="4">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-sliders-h"></i> Job Preferences</div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        <div class="jp-row">
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Number of Positions <span class="hint">(max. 10)</span></label>
                    <input type="number" name="number_of_positions" class="jp-input" value="<?php echo e(old('number_of_positions', optional($job)->number_of_positions ?? 1)); ?>" min="1" max="10">
                </div>
            </div>
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Gender Preference</label>
                    <select name="gender_preference" class="jp-select">
                        <option value="" <?php echo e(old('gender_preference', optional($job)->gender_preference ?? '') == '' ? 'selected' : ''); ?>>Any</option>
                        <option value="male" <?php echo e(old('gender_preference', optional($job)->gender_preference ?? '') == 'male' ? 'selected' : ''); ?>>Male</option>
                        <option value="female" <?php echo e(old('gender_preference', optional($job)->gender_preference ?? '') == 'female' ? 'selected' : ''); ?>>Female</option>
                    </select>
                </div>
            </div>
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Marital Status Preference</label>
                    <select name="marital_status_preference" class="jp-select">
                        <option value="" <?php echo e(old('marital_status_preference', optional($job)->marital_status_preference ?? '') == '' ? 'selected' : ''); ?>>Any</option>
                        <option value="married" <?php echo e(old('marital_status_preference', optional($job)->marital_status_preference ?? '') == 'married' ? 'selected' : ''); ?>>Married</option>
                        <option value="single" <?php echo e(old('marital_status_preference', optional($job)->marital_status_preference ?? '') == 'single' ? 'selected' : ''); ?>>Single</option>
                        <option value="other" <?php echo e(old('marital_status_preference', optional($job)->marital_status_preference ?? '') == 'other' ? 'selected' : ''); ?>>Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="jp-row">
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Job Shift</label>
                    <select name="job_shift_id" class="jp-select">
                        <option value="">-- Select --</option>
                        <?php $__currentLoopData = $jobShifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" <?php echo e(old('job_shift_id', optional($job)->job_shift_id ?? '') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Employment Type</label>
                    <?php $firstJobType = (isset($job) && $job && $job->jobTypes->isNotEmpty()) ? $job->jobTypes->first()->id : null; ?>
                    <select name="jobTypes[]" id="employment_type" class="jp-select">
                        <option value="">-- Select --</option>
                        <?php $__currentLoopData = $jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" <?php echo e(old('jobTypes.0', $firstJobType ?? '') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="jp-col-4">
                <div class="jp-group" style="padding-top: 28px;">
                    <div class="jp-check-wrap">
                        <input type="checkbox" name="is_remote" id="is_remote" value="1" <?php echo e(old('is_remote', optional($job)->is_remote ?? 0) ? 'checked' : ''); ?>>
                        <label for="is_remote" style="cursor:pointer; font-size:14px;">This is a Remote / WFH / Online job</label>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    
    <div class="jp-card jp-card-collapsible" data-section="5">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-map-marker-alt"></i> Application & Location</div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        <div class="jp-group">
            <label class="jp-label">Application accepted from which location <span class="required">*</span></label>
            <?php $appLocType = old('application_location_type', optional($job)->application_location_type ?? 'nearby'); ?>
            <div class="jp-option-cards">
                <label class="jp-option-card <?php echo e($appLocType === 'nearby' ? 'selected' : ''); ?>" onclick="selectOption(this, 'application_location_type')">
                    <input type="radio" name="application_location_type" value="nearby" <?php echo e($appLocType === 'nearby' ? 'checked' : ''); ?>>
                    <i class="fa fa-map-pin"></i> Nearby areas only
                </label>
                <label class="jp-option-card <?php echo e($appLocType === 'specific' ? 'selected' : ''); ?>" onclick="selectOption(this, 'application_location_type')">
                    <input type="radio" name="application_location_type" value="specific" <?php echo e($appLocType === 'specific' ? 'checked' : ''); ?>>
                    <i class="fa fa-list"></i> Specific Locations (up to 3)
                </label>
            </div>
        </div>

        
        <div class="jp-group" id="specific-locations-wrap" style="display: <?php echo e($appLocType === 'specific' ? 'block' : 'none'); ?>;">
            <label class="jp-label">Choose Locations <span class="hint">(up to 3)</span></label>
            <div class="jp-row">
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" class="jp-input app-location-input" placeholder="Search city..." data-index="1" autocomplete="off">
                        <div class="jp-suggest-list app-loc-suggest"></div>
                    </div>
                </div>
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" class="jp-input app-location-input" placeholder="Search city..." data-index="2" autocomplete="off">
                        <div class="jp-suggest-list app-loc-suggest"></div>
                    </div>
                </div>
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" class="jp-input app-location-input" placeholder="Search city..." data-index="3" autocomplete="off">
                        <div class="jp-suggest-list app-loc-suggest"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="application_locations" id="application_locations" value="">
        </div>

        
        <div class="jp-group">
            <label class="jp-label">Job Location / Address <span class="hint">(Auto-defined from company, editable)</span></label>
            <div class="jp-row">
                <div class="jp-col-6">
                    <input type="text" name="address" id="job_address" class="jp-input" placeholder="Address" value="<?php echo e(old('address', optional($job)->address ?? '')); ?>">
                </div>
                <div class="jp-col-6">
                    <input type="text" name="zip_code" id="job_zip_code" class="jp-input" placeholder="Pin Code" value="<?php echo e(old('zip_code', optional($job)->zip_code ?? '')); ?>">
                </div>
            </div>
            <div class="jp-row mt-2">
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" id="job_city_search" class="jp-input" placeholder="Search city..." autocomplete="off">
                        <div class="jp-suggest-list" id="job-city-suggestions"></div>
                    </div>
                    <input type="hidden" name="city_id" id="job_city_id" value="<?php echo e(old('city_id', optional($job)->city_id ?? '')); ?>">
                </div>
                <div class="jp-col-4">
                    <input type="text" id="job_state" class="jp-input" placeholder="State" readonly style="background:#f5f5f5;">
                    <input type="hidden" name="state_id" id="job_state_id" value="<?php echo e(old('state_id', optional($job)->state_id ?? '')); ?>">
                </div>
                <div class="jp-col-4">
                    <input type="text" id="job_country" class="jp-input" placeholder="Country" readonly style="background:#f5f5f5;">
                    <input type="hidden" name="country_id" id="job_country_id" value="<?php echo e(old('country_id', optional($job)->country_id ?? '')); ?>">
                </div>
            </div>
        </div>
        </div>
    </div>

    
    <div class="jp-card jp-card-collapsible" data-section="6">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-paper-plane"></i> Application Settings</div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        <div class="jp-group">
            <label class="jp-label">Application received by <span class="required">*</span></label>
            <?php $applyType = old('apply_type', optional($job)->apply_type ?? 'internal'); ?>
            <div class="jp-option-cards">
                <label class="jp-option-card <?php echo e($applyType === 'internal' ? 'selected' : ''); ?>" onclick="selectOption(this, 'apply_type')">
                    <input type="radio" name="apply_type" value="internal" <?php echo e($applyType === 'internal' ? 'checked' : ''); ?>>
                    <i class="fa fa-inbox"></i> Internal & Registered Email (Default)
                </label>
                <label class="jp-option-card <?php echo e($applyType === 'external' ? 'selected' : ''); ?>" onclick="selectOption(this, 'apply_type')">
                    <input type="radio" name="apply_type" value="external" <?php echo e($applyType === 'external' ? 'checked' : ''); ?>>
                    <i class="fa fa-external-link-alt"></i> External Link
                </label>
            </div>
        </div>

        <div class="jp-group" id="external-url-wrap" style="display: <?php echo e($applyType === 'external' ? 'block' : 'none'); ?>;">
            <label class="jp-label">External Apply URL</label>
            <input type="url" name="apply_url" id="apply_url" class="jp-input" placeholder="https://example.com/apply" value="<?php echo e(old('apply_url', optional($job)->apply_url ?? '')); ?>">
        </div>

        <div class="jp-group" id="internal-emails-wrap" style="display: <?php echo e($applyType === 'internal' ? 'block' : 'none'); ?>;">
            <label class="jp-label">Additional internal/registered emails <span class="hint">(optional, up to 3)</span></label>
            <div id="internal-emails-list">
                <?php
                    $internalEmails = old('apply_internal_emails', optional($job)->apply_internal_emails ?? []);
                    if (!is_array($internalEmails)) $internalEmails = $internalEmails ? [$internalEmails] : [];
                    $internalEmails = array_slice($internalEmails, 0, 3);
                ?>
                <?php $__currentLoopData = array_slice($internalEmails, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="jp-internal-email-row" style="display:flex; gap:8px; margin-bottom:8px; align-items:center;">
                    <input type="email" name="apply_internal_emails[]" class="jp-input" placeholder="hiring@example.com" value="<?php echo e(is_string($email) ? $email : ''); ?>" style="flex:1;">
                    <button type="button" class="btn btn-outline-danger btn-sm jp-remove-internal-email" style="flex-shrink:0;" title="Remove"><i class="fa fa-times"></i></button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-internal-email-btn" style="border-radius:8px;">
                <i class="fa fa-plus"></i> Add email
            </button>
        </div>

        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Application Deadline</label>
                    <?php $closingDate = optional($job)->application_closing_date; $closingStr = $closingDate ? (is_object($closingDate) ? $closingDate->format('Y-m-d') : $closingDate) : ''; ?>
                    <input type="date" name="application_closing_date" class="jp-input" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('application_closing_date', $closingStr)); ?>">
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Job Status</label>
                    <?php $st = optional($job)->status; $jobStatus = old('status', $st && is_object($st) ? $st->getValue() : ($st ?: 'published')); ?>
                    <select name="status" class="jp-select">
                        <option value="published" <?php echo e($jobStatus === 'published' ? 'selected' : ''); ?>>Published</option>
                        <option value="draft" <?php echo e($jobStatus === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="pending" <?php echo e($jobStatus === 'pending' ? 'selected' : ''); ?>>Pending</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="jp-group">
            <div class="jp-check-wrap">
                <input type="checkbox" name="hide_company" id="hide_company" value="1" <?php echo e(old('hide_company', optional($job)->hide_company ?? 0) ? 'checked' : ''); ?>>
                <label for="hide_company" style="cursor:pointer; font-size:14px;"><i class="fa fa-eye-slash" style="margin-right:4px;"></i> Hide my company details (Post as anonymously)</label>
            </div>
        </div>
        </div>
    </div>

    
    <div class="jp-card jp-card-collapsible" data-section="7">
        <div class="jp-card-header">
            <div class="jp-card-title"><i class="fa fa-clipboard-list"></i> <?php echo e(__('Job Screening Questions')); ?> <span class="hint" style="font-weight:400;font-size:13px;">(<?php echo e(__('Select, edit Q&A, and mark correct answer. Wrong answer restricts candidate from applying.')); ?>)</span></div>
        </div>
        <div class="jp-card-body" style="padding-top: 20px;">
        <div id="screening-questions-container" class="sq-list">
            <?php
                $jobSqs = optional($job)->screeningQuestions ?? collect();
                $selectedSqIds = old('screening_question_ids', $jobSqs->pluck('id')->all());
                $requiredSqIds = old('screening_question_required', $jobSqs->filter(fn($q) => $q->pivot->is_required ?? false)->pluck('id')->all());
                $sqOverrides = [];
                foreach ($screeningQuestions ?? [] as $q) {
                    $pivot = $jobSqs->firstWhere('id', $q->id)?->pivot;
                    $sqOverrides[$q->id] = [
                        'question' => old('screening_question_question.'.$q->id, $pivot->question_override ?? ''),
                        'options' => old('screening_question_options.'.$q->id, $pivot->options_override ?? ''),
                        'correct_answer' => old('screening_question_correct.'.$q->id, $pivot->correct_answer ?? ''),
                    ];
                }
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $screeningQuestions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $override = $sqOverrides[$sq->id] ?? ['question'=>'','options'=>'','correct_answer'=>''];
                    $opts = $sq->options_array;
                    $optsStr = is_array($opts) ? implode("\n", $opts) : (string)($opts ?? '');
                    $optsForCorrect = !empty($override['options']) ? array_filter(array_map('trim', preg_split('/[\r\n]+/', (string)$override['options']))) : (is_array($opts) ? $opts : []);
                ?>
                <div class="sq-item" data-id="<?php echo e($sq->id); ?>" data-template-question="<?php echo e(e($sq->question)); ?>" data-template-options="<?php echo e(e($optsStr)); ?>" data-type="<?php echo e($sq->question_type); ?>">
                    <div class="sq-item-main">
                        <input type="checkbox" name="screening_question_ids[]" value="<?php echo e($sq->id); ?>" id="sq_cb_<?php echo e($sq->id); ?>" class="form-check-input sq-select-cb" <?php echo e(in_array($sq->id, $selectedSqIds) ? 'checked' : ''); ?>>
                        <div class="sq-item-content">
                            <label for="sq_cb_<?php echo e($sq->id); ?>" class="sq-question-text"><?php echo e($override['question'] ?: $sq->question); ?></label>
                            <span class="sq-type-badge"><?php echo e($sq->question_type); ?></span>
                        </div>
                    </div>
                    <div class="sq-item-actions">
                        <button type="button" class="btn btn-sm btn-outline-secondary sq-toggle-edit" title="<?php echo e(__('Edit Q&A')); ?>"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-primary sq-auto-fill" title="<?php echo e(__('1-Click: Fill from job form')); ?>"><i class="fa fa-magic"></i> 1-Click</button>
                        <span class="sq-required-wrap">
                            <input type="checkbox" name="screening_question_required[]" value="<?php echo e($sq->id); ?>" id="sq_req_<?php echo e($sq->id); ?>" class="form-check-input sq-required-cb" <?php echo e(in_array($sq->id, $requiredSqIds) ? 'checked' : ''); ?> <?php echo e(in_array($sq->id, $selectedSqIds) ? '' : 'disabled'); ?>>
                            <label for="sq_req_<?php echo e($sq->id); ?>" class="sq-required-label"><?php echo e(__('Required')); ?></label>
                        </span>
                    </div>
                    <div class="sq-item-expand" style="display:none; margin-top:12px; padding:16px; background:#f9f9f9; border-radius:8px; border:1px solid #eee;">
                        <div class="mb-2">
                            <label class="form-label small"><?php echo e(__('Question (editable)')); ?></label>
                            <textarea name="screening_question_question[<?php echo e($sq->id); ?>]" class="form-control sq-edit-question" rows="2" placeholder="<?php echo e($sq->question); ?>"><?php echo e($override['question']); ?></textarea>
                        </div>
                        <?php if(in_array($sq->question_type, ['dropdown','checkbox'])): ?>
                        <div class="mb-2">
                            <label class="form-label small"><?php echo e(__('Options (one per line)')); ?></label>
                            <textarea name="screening_question_options[<?php echo e($sq->id); ?>]" class="form-control sq-edit-options" rows="3" placeholder="<?php echo e($optsStr); ?>"><?php echo e(is_array($override['options']) ? implode("\n", $override['options']) : $override['options']); ?></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small"><?php echo e(__('Correct answer (restricts wrong)')); ?> <span class="text-muted">(<?php echo e(__('Candidate must select this to apply')); ?>)</span></label>
                            <select name="screening_question_correct[<?php echo e($sq->id); ?>]" class="form-select sq-edit-correct">
                                <option value=""><?php echo e(__('No restriction')); ?></option>
                                <?php $__currentLoopData = $optsForCorrect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($opt); ?>" <?php echo e(($override['correct_answer'] ?? '') === $opt ? 'selected' : ''); ?>><?php echo e($opt); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="sq-empty-msg"><?php echo e(__('No screening questions available. Admin can add them in Job Board → Job Attributes → Screening Questions.')); ?></p>
            <?php endif; ?>
        </div>
        </div>
    </div>

    
    <div class="jp-card" style="text-align: center;">
        <button type="submit" class="jp-submit-btn" id="submitJobBtn">
            <i class="fa fa-check"></i> <?php echo e($submitLabel); ?>

        </button>
        <a href="<?php echo e(route('public.account.jobs.index')); ?>" class="btn btn-outline-secondary ms-3" style="border-radius:8px; padding:12px 30px;">
            Cancel
        </a>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== JOB TITLES DATABASE =====
    const jobTitles = [
        'Primary English Teacher', 'Secondary Mathematics Teacher', 'School Principal',
        'Academic Coordinator', 'Higher Secondary Commerce Teacher', 'Primary Hindi Teacher',
        'Secondary Science Teacher', 'Secondary Social Studies Teacher', 'Physical Education Teacher',
        'Music Teacher', 'Art Teacher', 'Computer Science Teacher', 'Special Education Teacher',
        'Nursery Teacher', 'KG Teacher', 'Montessori Teacher', 'Librarian', 'Lab Assistant',
        'Administrative Officer', 'Accountant', 'Front Desk Executive', 'Counselor',
        'Vice Principal', 'Head of Department', 'Subject Matter Expert', 'Curriculum Designer',
        'Online Tutor', 'Academic Writer', 'Examination Controller', 'Hostel Warden',
        'Sports Coach', 'Dance Teacher', 'Sanskrit Teacher', 'French Teacher',
        'German Teacher', 'Biology Teacher', 'Chemistry Teacher', 'Physics Teacher',
        'Economics Teacher', 'Psychology Teacher', 'Sociology Teacher', 'Political Science Teacher',
        'History Teacher', 'Geography Teacher', 'Environmental Science Teacher',
        'Early Childhood Educator', 'Activity Teacher', 'Yoga Teacher',
        'IT Administrator', 'Transport Manager', 'Security Supervisor'
    ];

    // ===== CERTIFICATIONS DATABASE =====
    const certifications = [
        'B.Ed', 'M.Ed', 'NTT', 'Montessori Trained', 'ECCED', 'TET', 'CTET',
        'IB Teacher Certification', 'Cambridge Teacher Certification', 'D.El.Ed',
        'PGDM', 'PhD in Education', 'NET', 'SET', 'JRF', 'NCTE Approved',
        'CBSE Affiliation Training', 'ICSE Training Certification',
        'Special Education Certification', 'Counseling Certification',
        'Computer Teacher Certification', 'Yoga Teacher Certification'
    ];

    // ===== LANGUAGES DATABASE =====
    const languages = [
        'Hindi', 'English', 'Bengali', 'Telugu', 'Marathi', 'Tamil', 'Urdu',
        'Gujarati', 'Kannada', 'Malayalam', 'Odia', 'Punjabi', 'Assamese',
        'Sanskrit', 'French', 'German', 'Spanish', 'Japanese', 'Chinese',
        'Korean', 'Arabic', 'Portuguese', 'Russian'
    ];

    // ===== SKILLS (from DB) =====
    const allSkills = <?php echo json_encode($skills, 15, 512) ?>;

    // ===== COMPANY DATA =====
    const companyData = <?php echo json_encode($companyDetails, 15, 512) ?>;
    const companies = <?php echo json_encode($companies ?? [], 15, 512) ?>;
    const degreeLevels = <?php echo json_encode($degreeLevels ?? [], 15, 512) ?>;
    const jobExperiences = <?php echo json_encode($jobExperiences ?? [], 15, 512) ?>;

    // ===== EDIT MODE: pre-fill from job =====
    var isEditMode = <?php echo e($isEdit ? 'true' : 'false'); ?>;
    var editJobData = <?php echo json_encode($editJobData ?? null, 15, 512) ?>;

    // ===== AUTO-SUGGEST HELPER =====
    function setupAutoSuggest(inputEl, listEl, items, onSelect, isObject, clearInputOnSelect) {
        isObject = isObject || false;
        clearInputOnSelect = clearInputOnSelect !== false; // default true for skills/certs/langs
        inputEl.addEventListener('input', function() {
            var val = this.value.toLowerCase().trim();
            listEl.innerHTML = '';
            if (val.length < 1) { listEl.classList.remove('show'); return; }

            var filtered;
            if (isObject) {
                filtered = Object.entries(items).filter(function(entry) {
                    return entry[1].toLowerCase().includes(val);
                }).slice(0, 15);
            } else {
                filtered = items.filter(function(i) { return i.toLowerCase().includes(val); }).slice(0, 15);
            }

            if (filtered.length === 0) { listEl.classList.remove('show'); return; }

            filtered.forEach(function(item) {
                var div = document.createElement('div');
                div.className = 'jp-suggest-item';
                var itemText = isObject ? item[1] : item;
                var itemId = isObject ? item[0] : null;
                div.textContent = itemText;
                if (isObject) div.dataset.id = itemId;
                div.addEventListener('mousedown', function(e) {
                    e.preventDefault();
                    onSelect(isObject ? { id: this.dataset.id, name: itemText } : itemText);
                    if (clearInputOnSelect) inputEl.value = '';
                    listEl.classList.remove('show');
                });
                listEl.appendChild(div);
            });
            listEl.classList.add('show');
        });

        inputEl.addEventListener('blur', function() {
            setTimeout(function() { listEl.classList.remove('show'); }, 200);
        });
    }

    // ===== JOB TITLE AUTO-SUGGEST =====
    var titleInput = document.getElementById('job_title');
    var titleList = document.getElementById('job-title-suggestions');
    setupAutoSuggest(titleInput, titleList, jobTitles, function(title) {
        titleInput.value = title;
        autoSetJobType(title);
    }, false, false); // isObject=false, clearInputOnSelect=false so selected title stays visible

    function autoSetJobType(title) {
        var nonTeachingKeywords = ['librarian', 'lab assistant', 'administrative', 'accountant',
            'front desk', 'counselor', 'it administrator', 'transport', 'security', 'hostel warden'];
        var lowerTitle = title.toLowerCase();
        var isNonTeaching = nonTeachingKeywords.some(function(k) { return lowerTitle.includes(k); });

        document.querySelectorAll('input[name="job_type_category"]').forEach(function(radio) {
            var card = radio.closest('.jp-option-card');
            if (radio.value === (isNonTeaching ? 'non-teaching' : 'teaching')) {
                radio.checked = true;
                card.classList.add('selected');
            } else {
                radio.checked = false;
                card.classList.remove('selected');
            }
        });
    }

    // ===== SKILLS =====
    var selectedSkills = {};
    var skillsSearch = document.getElementById('skills_search');
    var skillsList = document.getElementById('skills-suggestions');

    setupAutoSuggest(skillsSearch, skillsList, allSkills, function(skill) {
        if (!selectedSkills[skill.id]) {
            selectedSkills[skill.id] = skill.name;
            renderSkillTags();
        }
    }, true);

    function renderSkillTags() {
        var container = document.getElementById('selected-skills');
        var hiddenContainer = document.getElementById('skills-hidden-inputs');
        container.innerHTML = '';
        hiddenContainer.innerHTML = '';
        Object.entries(selectedSkills).forEach(function(entry) {
            container.innerHTML += '<span class="jp-tag">' + entry[1] + ' <span class="remove" onclick="removeSkill(\'' + entry[0] + '\')">&times;</span></span>';
            hiddenContainer.innerHTML += '<input type="hidden" name="skills[]" value="' + entry[0] + '">';
        });
    }
    window.removeSkill = function(id) {
        delete selectedSkills[id];
        renderSkillTags();
    };

    if (isEditMode && editJobData) {
        editJobData.skills.forEach(function(s) { selectedSkills[s.id] = s.name; });
        renderSkillTags();
    }

    // ===== CERTIFICATIONS =====
    var selectedCerts = [];
    var certSearch = document.getElementById('cert_search');
    var certList = document.getElementById('cert-suggestions');

    setupAutoSuggest(certSearch, certList, certifications, function(cert) {
        if (selectedCerts.indexOf(cert) === -1) {
            selectedCerts.push(cert);
            renderCertTags();
        }
    });

    function renderCertTags() {
        var container = document.getElementById('selected-certs');
        container.innerHTML = '';
        selectedCerts.forEach(function(cert, idx) {
            container.innerHTML += '<span class="jp-tag">' + cert + ' <span class="remove" onclick="removeCert(' + idx + ')">&times;</span></span>';
        });
        document.getElementById('required_certifications').value = JSON.stringify(selectedCerts);
    }
    window.removeCert = function(idx) {
        selectedCerts.splice(idx, 1);
        renderCertTags();
    };

    if (isEditMode && editJobData && editJobData.required_certifications && editJobData.required_certifications.length) {
        selectedCerts = editJobData.required_certifications.slice();
        renderCertTags();
    }

    // ===== LANGUAGES =====
    var selectedLangs = [];
    var langSearch = document.getElementById('lang_search');
    var langList = document.getElementById('lang-suggestions');

    setupAutoSuggest(langSearch, langList, languages, function(lang) {
        if (selectedLangs.indexOf(lang) === -1) {
            selectedLangs.push(lang);
            renderLangTags();
        }
    });

    function renderLangTags() {
        var container = document.getElementById('selected-langs');
        container.innerHTML = '';
        selectedLangs.forEach(function(lang, idx) {
            container.innerHTML += '<span class="jp-tag">' + lang + ' <span class="remove" onclick="removeLang(' + idx + ')">&times;</span></span>';
        });
        document.getElementById('language_proficiency').value = JSON.stringify(selectedLangs);
    }
    window.removeLang = function(idx) {
        selectedLangs.splice(idx, 1);
        renderLangTags();
    };

    if (isEditMode && editJobData && editJobData.language_proficiency && editJobData.language_proficiency.length) {
        selectedLangs = editJobData.language_proficiency.slice();
        renderLangTags();
    }

    // ===== COMPANY SELECTION =====
    function syncCompanyLocationFromJob() {
        if (!isEditMode || !editJobData) return;
        var cityInp = document.getElementById('job_city_search');
        var stateInp = document.getElementById('job_state');
        var countryInp = document.getElementById('job_country');
        if (editJobData.city_name && cityInp) cityInp.value = editJobData.city_name;
        if (editJobData.state_name && stateInp) stateInp.value = editJobData.state_name;
        if (editJobData.country_name && countryInp) countryInp.value = editJobData.country_name;
    }
    document.getElementById('company_id').addEventListener('change', function() {
        var companyId = this.value;
        var badge = document.getElementById('inst-type-badge');

        if (companyId && companyData[companyId]) {
            var data = companyData[companyId];
            badge.textContent = data.institution_type || 'Not specified';
            badge.style.background = data.institution_type ? '#e8f5e9' : '#fff3e0';
            badge.style.color = data.institution_type ? '#2e7d32' : '#e65100';

            if (data.address) document.getElementById('job_address').value = data.address;
            if (data.city_name) {
                document.getElementById('job_city_search').value = data.city_name;
                document.getElementById('job_city_id').value = data.city_id || '';
            }
            if (data.state_name) {
                document.getElementById('job_state').value = data.state_name;
                document.getElementById('job_state_id').value = data.state_id || '';
            }
            if (data.country_name) {
                document.getElementById('job_country').value = data.country_name;
                document.getElementById('job_country_id').value = data.country_id || '';
            }
            if (data.postal_code) document.getElementById('job_zip_code').value = data.postal_code;
        } else {
            badge.textContent = 'Select a company first';
            badge.style.background = '#f0f4ff';
            badge.style.color = '#4a6cf7';
        }
    });
    if (isEditMode) setTimeout(syncCompanyLocationFromJob, 100);

    // ===== SALARY PERIOD =====
    window.selectSalaryPeriod = function(el) {
        document.querySelectorAll('.jp-salary-tab').forEach(function(t) { t.classList.remove('active'); });
        el.classList.add('active');
        var val = el.dataset.value;

        if (val === 'negotiable') {
            document.getElementById('salary-amount-section').style.display = 'none';
            document.getElementById('salary_type').value = 'negotiable';
            document.getElementById('salary_range').value = 'monthly';
        } else {
            document.getElementById('salary-amount-section').style.display = 'block';
            document.getElementById('salary_type').value = 'fixed';
            document.getElementById('salary_range').value = val;
        }
    };

    // ===== SALARY MODE (Range/Fixed) =====
    window.selectSalaryMode = function(el, mode) {
        el.closest('.jp-option-cards').querySelectorAll('.jp-option-card').forEach(function(c) { c.classList.remove('selected'); });
        el.classList.add('selected');
        document.getElementById('salary-to-wrap').style.display = mode === 'fixed' ? 'none' : 'block';
    };

    // ===== RADIO/CHECKBOX OPTION CARDS =====
    window.selectOption = function(el, name) {
        var cards = el.closest('.jp-option-cards').querySelectorAll('.jp-option-card');
        cards.forEach(function(c) { c.classList.remove('selected'); });
        el.classList.add('selected');
        el.querySelector('input').checked = true;

        if (name === 'application_location_type') {
            var val = el.querySelector('input').value;
            document.getElementById('specific-locations-wrap').style.display = val === 'specific' ? 'block' : 'none';
        }
        if (name === 'apply_type') {
            var val2 = el.querySelector('input').value;
            document.getElementById('external-url-wrap').style.display = val2 === 'external' ? 'block' : 'none';
            document.getElementById('internal-emails-wrap').style.display = val2 === 'internal' ? 'block' : 'none';
        }
    };

    // ===== SCREENING QUESTIONS: Toggle edit, 1-Click auto-fill =====
    document.querySelectorAll('.sq-toggle-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var expand = this.closest('.sq-item').querySelector('.sq-item-expand');
            expand.style.display = expand.style.display === 'none' ? 'block' : 'none';
        });
    });
    document.querySelectorAll('.sq-auto-fill').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var item = this.closest('.sq-item');
            var templateQ = item.dataset.templateQuestion || '';
            var templateO = item.dataset.templateOptions || '';
            var repl = {
                degree_level: degreeLevels[document.getElementById('degree_level_id')?.value] || '',
                job_title: document.getElementById('job_title')?.value || '',
                experience_years: jobExperiences[document.getElementById('job_experience_id')?.value] || '',
                certification: (selectedCerts && selectedCerts[0]) || '',
                language: (selectedLangs && selectedLangs[0]) || '',
                job_location: (document.getElementById('job_address')?.value || '') + ' ' + (document.getElementById('job_city_search')?.value || ''),
                application_locations: (function(){ var v = document.getElementById('application_locations')?.value; if (!v) return ''; try { var a = JSON.parse(v); return Array.isArray(a) ? a.join(', ') : v; } catch(e){ return v.replace(/[\[\]"]/g,'').split(',').map(function(s){return s.trim();}).filter(Boolean).join(', '); } })(),
                company_name: companies[document.getElementById('company_id')?.value] || '',
                institution_type: companyData[document.getElementById('company_id')?.value]?.institution_type || ''
            };
            for (var k in repl) {
                templateQ = templateQ.replace(new RegExp('\\{' + k + '\\}', 'g'), repl[k]);
                templateO = templateO.replace(new RegExp('\\{' + k + '\\}', 'g'), repl[k]);
            }
            var qInp = item.querySelector('.sq-edit-question');
            var oInp = item.querySelector('.sq-edit-options');
            if (qInp) qInp.value = templateQ;
            if (oInp) oInp.value = templateO;
            item.querySelector('.sq-question-text').textContent = templateQ || item.dataset.templateQuestion;
            item.querySelector('.sq-item-expand').style.display = 'block';
        });
    });
    document.querySelectorAll('.sq-select-cb').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var req = document.getElementById('sq_req_' + this.value);
            if (req) req.disabled = !this.checked;
        });
    });
    document.querySelectorAll('.sq-edit-question').forEach(function(ta) {
        ta.addEventListener('input', function() {
            var item = this.closest('.sq-item');
            var label = item.querySelector('.sq-question-text');
            if (label) label.textContent = this.value || item.dataset.templateQuestion;
        });
    });

    // ===== INTERNAL EMAILS (up to 3) - Add email button =====
    var addEmailBtn = document.getElementById('add-internal-email-btn');
    var internalEmailsList = document.getElementById('internal-emails-list');
    if (addEmailBtn && internalEmailsList) {
        addEmailBtn.addEventListener('click', function() {
            var rows = internalEmailsList.querySelectorAll('.jp-internal-email-row');
            if (rows.length >= 3) return;
            var row = document.createElement('div');
            row.className = 'jp-internal-email-row';
            row.setAttribute('style', 'display:flex; gap:8px; margin-bottom:8px; align-items:center;');
            row.innerHTML = '<input type="email" name="apply_internal_emails[]" class="jp-input" placeholder="hiring@example.com" style="flex:1;">' +
                '<button type="button" class="btn btn-outline-danger btn-sm jp-remove-internal-email" style="flex-shrink:0;" title="Remove"><i class="fa fa-times"></i></button>';
            internalEmailsList.appendChild(row);
            row.querySelector('.jp-remove-internal-email').addEventListener('click', function() { row.remove(); });
        });
        internalEmailsList.addEventListener('click', function(e) {
            var removeBtn = e.target.closest('.jp-remove-internal-email');
            if (removeBtn) removeBtn.closest('.jp-internal-email-row').remove();
        });
    }

    // ===== CITY SEARCH FOR JOB LOCATION =====
    var cityInput = document.getElementById('job_city_search');
    var cityList2 = document.getElementById('job-city-suggestions');
    var cityTimeout = null;

    cityInput.addEventListener('input', function() {
        clearTimeout(cityTimeout);
        var val = this.value.trim();
        if (val.length < 2) { cityList2.classList.remove('show'); return; }

        cityTimeout = setTimeout(function() {
            fetch('<?php echo e(route("ajax.search-cities")); ?>?keyword=' + encodeURIComponent(val))
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    cityList2.innerHTML = '';
                    if (!data.length) { cityList2.classList.remove('show'); return; }
                    data.forEach(function(city) {
                        var div = document.createElement('div');
                        div.className = 'jp-suggest-item';
                        div.textContent = city.full_name || city.name;
                        div.addEventListener('click', function() {
                            cityInput.value = city.name;
                            document.getElementById('job_city_id').value = city.id;
                            document.getElementById('job_state').value = city.state_name || '';
                            document.getElementById('job_state_id').value = city.state_id || '';
                            document.getElementById('job_country').value = city.country_name || '';
                            document.getElementById('job_country_id').value = city.country_id || '';
                            cityList2.classList.remove('show');
                        });
                        cityList2.appendChild(div);
                    });
                    cityList2.classList.add('show');
                });
        }, 300);
    });

    cityInput.addEventListener('blur', function() {
        setTimeout(function() { cityList2.classList.remove('show'); }, 200);
    });

    // ===== APPLICATION LOCATION CITY SEARCH =====
    document.querySelectorAll('.app-location-input').forEach(function(input) {
        var suggest = input.closest('.jp-suggest-wrap').querySelector('.app-loc-suggest');
        var timer = null;

        input.addEventListener('input', function() {
            clearTimeout(timer);
            var val = this.value.trim();
            if (val.length < 2) { suggest.classList.remove('show'); return; }

            timer = setTimeout(function() {
                fetch('<?php echo e(route("ajax.search-cities")); ?>?keyword=' + encodeURIComponent(val))
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        suggest.innerHTML = '';
                        if (!data.length) { suggest.classList.remove('show'); return; }
                        data.forEach(function(city) {
                            var div = document.createElement('div');
                            div.className = 'jp-suggest-item';
                            div.textContent = city.full_name || city.name;
                            div.addEventListener('click', function() {
                                input.value = city.name;
                                input.dataset.cityId = city.id;
                                suggest.classList.remove('show');
                                updateAppLocations();
                            });
                            suggest.appendChild(div);
                        });
                        suggest.classList.add('show');
                    });
            }, 300);
        });

        input.addEventListener('blur', function() {
            setTimeout(function() { suggest.classList.remove('show'); }, 200);
        });
    });

    function updateAppLocations() {
        var locs = [];
        document.querySelectorAll('.app-location-input').forEach(function(input) {
            if (input.dataset.cityId) {
                locs.push({ city_id: input.dataset.cityId, name: input.value });
            }
        });
        document.getElementById('application_locations').value = JSON.stringify(locs);
    }

    // ===== SCREENING QUESTIONS: enable/disable "Required" when question is selected =====
    document.querySelectorAll('.sq-select-cb').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var item = this.closest('.sq-item');
            var reqCb = item ? item.querySelector('.sq-required-cb') : null;
            if (reqCb) {
                reqCb.disabled = !this.checked;
                if (!this.checked) reqCb.checked = false;
            }
        });
    });

    // ===== AI GENERATE DESCRIPTION =====
    document.getElementById('aiGenerateBtn').addEventListener('click', function() {
        var title = document.getElementById('job_title').value;
        if (!title) { alert('Please enter a job title first.'); return; }

        this.disabled = true;
        this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Generating...';

        var desc = generateJobDescription(title);
        document.getElementById('job_description').value = desc;

        this.disabled = false;
        this.innerHTML = '<i class="fa fa-magic"></i> Generate with AI';
    });

    function generateJobDescription(title) {
        return 'We are looking for a dedicated and passionate ' + title + ' to join our educational institution.\n\nKey Responsibilities:\n• Plan, prepare, and deliver high-quality lessons in accordance with the curriculum\n• Create a positive and engaging learning environment for students\n• Assess and evaluate student progress and provide constructive feedback\n• Collaborate with fellow teachers and staff to enhance the educational experience\n• Participate in professional development activities and staff meetings\n• Maintain accurate records of student attendance, grades, and performance\n• Communicate effectively with parents/guardians regarding student progress\n\nWhat We Offer:\n• Competitive salary package\n• Professional development opportunities\n• Supportive and collaborative work environment\n• Modern teaching facilities and resources\n\nIf you are passionate about education and want to make a meaningful impact on students\' lives, we encourage you to apply.';
    }

    // ===== FORM VALIDATION =====
    document.getElementById('jobPostForm').addEventListener('submit', function(e) {
        var empSel = document.getElementById('employment_type');
        if (empSel) {
            if (!empSel.value) {
                empSel.removeAttribute('name');
            } else {
                empSel.setAttribute('name', 'jobTypes[]');
            }
        }
        var valid = true;

        if (!document.getElementById('company_id').value) {
            document.getElementById('err-company').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-company').classList.remove('show');
        }

        if (!document.getElementById('job_title').value.trim()) {
            document.getElementById('err-title').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-title').classList.remove('show');
        }

        if (!document.getElementById('job_description').value.trim()) {
            document.getElementById('err-description').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-description').classList.remove('show');
        }

        var jobTypeChecked = document.querySelector('input[name="job_type_category"]:checked');
        if (!jobTypeChecked) {
            document.getElementById('err-job-type').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-job-type').classList.remove('show');
        }

        if (!valid) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            var btn = document.getElementById('submitJobBtn');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<?php echo e($isEdit ? __("Updating...") : __("Posting...")); ?>';
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/dashboard/jobs/create.blade.php ENDPATH**/ ?>