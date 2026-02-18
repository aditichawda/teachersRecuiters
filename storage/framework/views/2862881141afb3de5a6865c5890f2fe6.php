<?php $__env->startSection('content'); ?>
<!-- TomSelect CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

<style>
    .profile-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        overflow: visible;
    }
    .profile-section-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        padding: 15px 20px;
        font-size: 16px;
        font-weight: 600;
    }
    .profile-section-header i {
        margin-right: 10px;
    }
    .profile-section-body {
        padding: 20px;
    }
    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
        font-size: 14px;
    }
    .form-label .required {
        color: #dc3545;
    }
    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 14px;
        height: 40px;
        font-size: 14px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .form-check-input:checked {
        background-color: #0073d1;
        border-color: #0073d1;
    }
    .form-text {
        font-size: 12px;
        color: #64748b;
    }
    /* ? Help icon - hover & click both show tooltip */
    .field-help-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #64748b;
        font-size: 11px;
        font-weight: 600;
        cursor: help;
        margin-left: 4px;
        vertical-align: middle;
        transition: background 0.2s, color 0.2s;
    }
    .field-help-icon:hover,
    .field-help-icon:focus {
        background: #0073d1;
        color: #fff;
        outline: none;
    }
    .field-help-icon i {
        font-size: 11px;
    }
    .profile-section-header .field-help-icon {
        background: rgba(255,255,255,0.3);
        color: #fff;
    }
    .profile-section-header .field-help-icon:hover,
    .profile-section-header .field-help-icon:focus {
        background: rgba(255,255,255,0.5);
        color: #fff;
    }
    /* Tooltip - wider & mobile responsive (field-help-icon tooltips) */
    .tooltip .tooltip-inner {
        max-width: 340px;
        min-width: 200px;
        padding: 12px 16px;
        font-size: 13px;
        line-height: 1.5;
        text-align: left;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    @media (max-width: 576px) {
        .tooltip .tooltip-inner {
            max-width: min(320px, calc(100vw - 32px));
            min-width: 240px;
            padding: 14px 18px;
            font-size: 14px;
        }
    }
    .btn-save {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
    }
    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    }
    .add-more-btn {
        background: #f0f7ff;
        color: #0073d1;
        border: 1px dashed #0073d1;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
    }
    .add-more-btn:hover {
        background: #e0efff;
    }
    .removable-item {
        position: relative;
        background: #f8fafc;
        padding: 7px 10px 0px 10px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .remove-item-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #fee2e2;
        color: #dc3545;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        font-size: 12px;
        cursor: pointer;
    }
    .priority-badge {
        background: #0073d1;
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
    }
    .city-suggestion-item:hover { background: #f0f7ff; }

    /* TomSelect Custom Styles */
    .ts-wrapper {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
    }
    .ts-wrapper.focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .ts-wrapper .ts-control {
        border: 1.5px solid #e2e8f0;
        padding: 8px 12px;
        min-height: 44px;
        border-radius: 8px;
        background: #fff;
    }
    .ts-wrapper .ts-control input {
        font-size: 14px;
    }
    .ts-wrapper .ts-control .item {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 500;
        margin: 2px 4px 2px 0;
    }
    .ts-wrapper .ts-control .item .remove {
        color: rgba(255,255,255,0.8);
        border-left: 1px solid rgba(255,255,255,0.3);
        margin-left: 6px;
        padding-left: 6px;
        font-size: 14px;
    }
    .ts-wrapper .ts-control .item .remove:hover {
        color: #fff;
    }
    .ts-dropdown {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        z-index: 9999;
        margin-top: 4px;
    }
    .ts-dropdown .optgroup-header {
        background: #f0f7ff;
        color: #0073d1;
        font-weight: 600;
        font-size: 12px;
        padding: 8px 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .ts-dropdown .option {
        padding: 10px 14px;
        font-size: 14px;
        color: #333;
    }
    .ts-dropdown .option:hover,
    .ts-dropdown .option.active {
        background: #f0f7ff;
        color: #0073d1;
    }
    .ts-dropdown .option.selected {
        background: #e8f4fd;
        color: #005bb5;
    }
    .ts-dropdown .no-results {
        padding: 12px 14px;
        color: #999;
        font-size: 13px;
    }
    .ts-max-info {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
    }
    .ts-max-info .count {
        color: #0073d1;
        font-weight: 600;
    }
    .profile-section-header {
        border-radius: 12px 12px 0 0;
    }
    .profile-section-body {
        overflow: visible;
    }

    /* Mobile Responsive for TomSelect */
    @media (max-width: 768px) {
        .ts-wrapper .ts-control {
            min-height: 42px;
            padding: 6px 10px;
        }
        .ts-wrapper .ts-control .item {
            font-size: 11px;
            padding: 3px 8px;
        }
        .ts-dropdown .option {
            padding: 12px 14px;
            font-size: 14px;
        }
        .ts-dropdown .optgroup-header {
            padding: 8px 14px;
        }
    }

    /* Profile Photo Section */
    .profile-photo-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        padding: 25px;
        overflow: visible;
    }
    .profile-photo-wrapper {
        display: flex;
        align-items: center;
        gap: 25px;
    }
    .profile-photo-img {
        position: relative;
        flex-shrink: 0;
    }
    .profile-photo-img img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e2e8f0;
        transition: all 0.3s;
    }
    .profile-photo-img:hover img {
        border-color: #0073d1;
    }
    .profile-photo-badge {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 30px;
        height: 30px;
        background: #0073d1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 13px;
        border: 2px solid #fff;
        cursor: pointer;
        transition: all 0.2s;
    }
    .profile-photo-badge:hover {
        background: #005bb5;
        transform: scale(1.1);
    }
    .profile-photo-info {
        flex: 1;
    }
    .profile-photo-info h5 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 5px 0;
    }
    .profile-photo-info p {
        font-size: 13px;
        color: #64748b;
        margin: 0 0 12px 0;
    }
    .profile-photo-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-change-photo {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-change-photo:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,115,209,0.3);
        color: #fff;
    }
    .btn-remove-photo {
        background: #fff;
        color: #dc3545;
        border: 1px solid #fecaca;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-remove-photo:hover {
        background: #fef2f2;
        border-color: #dc3545;
    }

    @media (max-width: 480px) {
        .profile-photo-wrapper {
            flex-direction: column;
            text-align: center;
        }
        .profile-photo-info {
            text-align: center;
        }
        .profile-photo-actions {
            justify-content: center;
        }
    }

    /* Speech to Text Button */
    .speech-to-text-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0f7ff;
        color: #0073d1;
        border: 1px solid #0073d1;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 8px;
    }
    .speech-to-text-btn:hover {
        background: #0073d1;
        color: #fff;
    }
    .speech-to-text-btn.recording {
        background: #dc3545;
        color: #fff;
        border-color: #dc3545;
        animation: pulse-recording 1.5s infinite;
    }
    @keyframes pulse-recording {
        0%, 100% { box-shadow: 0 0 0 0 rgba(220,53,69,0.4); }
        50% { box-shadow: 0 0 0 8px rgba(220,53,69,0); }
    }
    .speech-status {
        font-size: 12px;
        color: #64748b;
        margin-left: 8px;
        display: none;
    }
    .speech-status.active {
        display: inline;
        color: #dc3545;
        font-weight: 500;
    }

    /* Autocomplete Styles for Specialization */
    .specialization-autocomplete-wrapper {
        position: relative;
    }
    .specialization-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: none;
    }
    .specialization-suggestions.active {
        display: block;
    }
    .specialization-suggestion-item {
        padding: 8px 14px;
        font-size: 13px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
    }
    .specialization-suggestion-item:hover,
    .specialization-suggestion-item.highlighted {
        background: #f0f7ff;
        color: #0073d1;
    }
    .specialization-suggestion-item:last-child {
        border-bottom: none;
    }
</style>

    <!-- Page Header -->
    <!-- <div class="js-page-header">
        <h2><?php echo e(__('My Profile')); ?></h2>
        <a href="<?php echo e(url('/')); ?>">GO TO HOMEPAGE →</a>
    </div> -->


    <?php echo Form::open(['route' => 'public.account.post.settings', 'method' => 'POST', 'files' => true, 'id' => 'profile-form']); ?>


    <!-- Section 1: Personal Details -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-user"></i> <?php echo e(__('Personal Details')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text"><?php echo e(__('We collect these details to verify your profile, connect you with schools/institutions, and share relevant job opportunities.')); ?></p>
            <div class="row">
                <!-- 1. Full Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Full Name')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Help us to create your verified candidate profile and ensure accurate identification.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo e(old('first_name', $account->first_name)); ?>" placeholder="<?php echo e(__('Enter your full name')); ?>" required>
                </div>

                <!-- 2. Email Address -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Email Address')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Help us to send job alerts, interview updates, application status, and important notifications.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="email" class="form-control" value="<?php echo e($account->email); ?>" disabled>
                </div>

                <!-- 3. Mobile Number -->
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('Phone Number')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('For recruiters and schools to contact you directly regarding interviews and job opportunities and also help us to send you job alerts and updates on WhatsApp.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="tel" class="form-control" name="phone" value="<?php echo e(old('phone', $account->phone)); ?>" placeholder="<?php echo e(__('Enter mobile number with country code')); ?>">
                    <div class="form-check mt-2">
                        <input type="hidden" name="is_whatsapp_available" value="0">
                        <input type="checkbox" class="form-check-input" name="is_whatsapp_available" value="1" id="is_whatsapp_available" <?php if(old('is_whatsapp_available', $account->is_whatsapp_available)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" style="font-size: 12px;" for="is_whatsapp_available"><?php echo e(__('This number is available on WhatsApp')); ?></label>
                    </div>
                </div>

                <!-- 4. Alternate Contact -->
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('Alternate Phone Number')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('To ensure schools can reach you if your primary number is unavailable.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="tel" class="form-control" name="alternate_phone" value="<?php echo e(old('alternate_phone', $account->alternate_phone ?? '')); ?>" placeholder="<?php echo e(__('Alternate phone number')); ?>">
                    <div class="form-check mt-2">
                        <input type="hidden" name="is_alternate_whatsapp_available" value="0">
                        <input type="checkbox" class="form-check-input" name="is_alternate_whatsapp_available" value="1" id="is_alternate_whatsapp_available" <?php if(old('is_alternate_whatsapp_available', $account->is_alternate_whatsapp_available ?? false)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" style="font-size: 12px;" for="is_alternate_whatsapp_available"><?php echo e(__('This number is available on WhatsApp')); ?></label>
                    </div>
                </div>
                <!-- 7. DOB -->
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('Date of Birth')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('To verify eligibility criteria, age requirements, and ensure compliance with school policies.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="date" class="form-control" name="dob" value="<?php echo e(old('dob', $account->dob ? $account->dob->format('Y-m-d') : '')); ?>" max="<?php echo e(now()->subYears(16)->format('Y-m-d')); ?>">
                </div>
                
                <!-- 5. Gender -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Gender')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Some institutions may have role-specific preferences or accommodation arrangements.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <div class="d-flex gap-3 mt-2">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="gender" value="male" id="gender_male" <?php if(old('gender', $account->gender) == 'male'): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="gender_male"><?php echo e(__('Male')); ?></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="gender" value="female" id="gender_female" <?php if(old('gender', $account->gender) == 'female'): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="gender_female"><?php echo e(__('Female')); ?></label>
                        </div>
                    </div>
                </div>

                <!-- 6. Marital Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Marital Status')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Certain schools (especially residential/boarding schools) may consider this for accommodation and relocation purposes.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <div class="d-flex gap-3 flex-wrap mt-2">
                        <?php $__currentLoopData = ['single' => 'Single', 'married' => 'Married', 'separated' => 'Separated', 'others' => 'Others']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="marital_status" value="<?php echo e($value); ?>" id="marital_<?php echo e($value); ?>" <?php if(old('marital_status', $account->marital_status ?? '') == $value): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="marital_<?php echo e($value); ?>"><?php echo e(__($label)); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

               
            </div>
        </div>
    </div>

    <!-- Section 2: Profile Visibility & Work Status -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-eye"></i> <?php echo e(__('Security Tab')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3"><?php echo e(__('Control who can view your profile and update your current job availability and salary to receive relevant opportunities.')); ?></p>
            <div class="row">
                <!-- 9. Profile Visibility -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Profile Visibility')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Choose whether schools/recruiters can view your profile in search results.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <select class="form-select" name="profile_visibility">
                        <option value="1" <?php if(old('profile_visibility', $account->profile_visibility ?? 1) == 1): echo 'selected'; endif; ?>><?php echo e(__('Yes - Schools can view my profile')); ?></option>
                        <option value="0" <?php if(old('profile_visibility', $account->profile_visibility ?? 1) == 0): echo 'selected'; endif; ?>><?php echo e(__('No - Hide my profile')); ?></option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Additional Privacy Options')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('To give you flexibility while exploring opportunities confidentially.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <div class="form-check mb-2">
                        <input type="hidden" name="hide_resume" value="0">
                        <input type="checkbox" class="form-check-input" name="hide_resume" value="1" id="hide_resume" <?php if(old('hide_resume', $account->hide_resume ?? false)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="hide_resume"><?php echo e(__('Hide Resume')); ?></label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="hide_name_for_employer" value="0">
                        <input type="checkbox" class="form-check-input" name="hide_name_for_employer" value="1" id="hide_name_for_employer" <?php if(old('hide_name_for_employer', $account->hide_name_for_employer ?? false)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="hide_name_for_employer"><?php echo e(__('Hide only name for Employer/School')); ?></label>
                    </div>
                </div>   
            </div>
        </div>
    </div>
      <!-- Section 2: Profile Visibility & Work Status -->
      <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-eye"></i> <?php echo e(__('Work Status')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3"><?php echo e(__('Control who can view your profile and update your current job availability and salary to receive relevant opportunities.')); ?></p>
            <div class="row">
              
                <!-- 10. Current Work Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Current Work Status')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Recruiters prioritize candidates based on immediate availability.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <select class="form-select" name="current_work_status" id="current_work_status">
                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                        <option value="not_working" <?php if(old('current_work_status', $account->current_work_status ?? '') == 'not_working'): echo 'selected'; endif; ?>><?php echo e(__('Not Working Now')); ?></option>
                        <option value="working" <?php if(old('current_work_status', $account->current_work_status ?? '') == 'working'): echo 'selected'; endif; ?>><?php echo e(__('Working Now')); ?></option>
                    </select>
                    <div class="form-check mt-1">
                        <input type="hidden" name="available_for_immediate_joining" value="0">
                        <input type="checkbox" class="form-check-input" name="available_for_immediate_joining" value="1" id="available_for_immediate_joining" <?php if(old('available_for_immediate_joining', $account->available_for_immediate_joining ?? false)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="available_for_immediate_joining"><?php echo e(__('Available for Immediate Joining')); ?></label>
                    </div>
                </div>

                <!-- 11. Notice Period (shown if working) -->
                <div class="col-md-6 mb-3" id="notice_period_wrapper" style="display: none;">
                    <label class="form-label"><?php echo e(__('Notice Period')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Schools/recruiters filter candidates based on urgency of hiring.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <select class="form-select" name="notice_period">
                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                        <option value="7_days" <?php if(old('notice_period', $account->notice_period ?? '') == '7_days'): echo 'selected'; endif; ?>><?php echo e(__('7 Days')); ?></option>
                        <option value="15_days" <?php if(old('notice_period', $account->notice_period ?? '') == '15_days'): echo 'selected'; endif; ?>><?php echo e(__('15 Days')); ?></option>
                        <option value="1_month" <?php if(old('notice_period', $account->notice_period ?? '') == '1_month'): echo 'selected'; endif; ?>><?php echo e(__('1 Month')); ?></option>
                        <option value="2_months" <?php if(old('notice_period', $account->notice_period ?? '') == '2_months'): echo 'selected'; endif; ?>><?php echo e(__('2 Months')); ?></option>
                        <option value="3_months" <?php if(old('notice_period', $account->notice_period ?? '') == '3_months'): echo 'selected'; endif; ?>><?php echo e(__('3 Months')); ?></option>
                    </select>
                </div>

                 <!-- Salary (Not required when "Not Working Now") -->
                 <div class="col-md-6 mb-3" id="current_salary_wrapper">
                        <label class="form-label"><?php echo e(__('Current Salary')); ?> <span class="required" id="current_salary_req">*</span><span class="text-muted small ms-1" id="current_salary_optional" style="display:none;">(<?php echo e(__('Not required when not working')); ?>)</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Helps schools/institutions understand your experience level and compensation bracket.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="current_salary" id="current_salary_input" value="<?php echo e(old('current_salary', $account->current_salary ?? '')); ?>" placeholder="0">
                            <select class="form-select" name="current_salary_period" style="max-width: 120px;">
                                <option value="month" <?php if(old('current_salary_period', $account->current_salary_period ?? 'month') == 'month'): echo 'selected'; endif; ?>>Month</option>
                                <option value="hour" <?php if(old('current_salary_period', $account->current_salary_period ?? 'month') == 'hour'): echo 'selected'; endif; ?>>Hour</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3" id="expected_salary_wrapper">
                        <label class="form-label"><?php echo e(__('Expected Salary')); ?> <span class="required" id="expected_salary_req">*</span><span class="text-muted small ms-1" id="expected_salary_optional" style="display:none;">(<?php echo e(__('Not required when not working')); ?>)</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('To ensure salary alignment before interview shortlisting.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="expected_salary" id="expected_salary_input" value="<?php echo e(old('expected_salary', $account->expected_salary ?? '')); ?>" placeholder="0">
                            <select class="form-select" name="expected_salary_period" style="max-width: 120px;">
                                <option value="month" <?php if(old('expected_salary_period', $account->expected_salary_period ?? 'month') == 'month'): echo 'selected'; endif; ?>>Month</option>
                                <option value="hour" <?php if(old('expected_salary_period', $account->expected_salary_period ?? 'month') == 'hour'): echo 'selected'; endif; ?>>Hour</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Section 3: About / Bio -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-info-circle"></i> <?php echo e(__('About Me')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3"><?php echo e(__('Write a short summary about your teaching experience, subject expertise, achievements, and career goals. Keep it clear and professional.')); ?></p>
            <div class="row">
                <!-- 12. Bio -->
                <div class="col-12 mb-3">
                    <label class="form-label"><?php echo e(__('Teaching Philosophy / Career Objective / Key Strengths')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Example: Passionate Mathematics teacher with 5+ years of experience in CBSE schools. Skilled in concept-based teaching, exam preparation strategies, and classroom management. Committed to student-centric learning and academic excellence. Seeking a progressive institution where I can contribute to board results and holistic development of students. This helps schools quickly understand: Your teaching strengths, Classroom approach & methodology, Career aspirations, Suitability for their institution. Recruiters often read this section before downloading resumes.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <?php
                        $bioPlaceholder = __('Passionate Mathematics teacher with 5+ years of experience in CBSE schools. Skilled in concept-based teaching, exam preparation strategies, and classroom management. Committed to student-centric learning and academic excellence. Seeking a progressive institution where I can contribute to board results and holistic development of students.');
                    ?>
                    <?php echo Form::customEditor('bio', old('bio', $account->bio), ['data-placeholder' => $bioPlaceholder]); ?>

                </div>
               
                <small class="form-text text-muted">This helps schools quickly understand: Your teaching strengths, Classroom approach & methodology, Career aspirations, Suitability for their institution.
Recruiters often read this section before downloading resumes.
</small>

            </div>
        </div>
    </div>
    <!-- Section 7: Job Preferences -->
    <div class="profile-section">
            <div class="profile-section-header">
                <i class="fa fa-briefcase"></i> <?php echo e(__('Job Preferences')); ?>

            </div>
            <div class="profile-section-body">
                <p class="form-text mb-3"><?php echo e(__('Tell us what type of opportunities you are looking for so we can match you with relevant schools/institutions.')); ?></p>
                <div class="row">
                    <!-- 23. Institution Type Preferences -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('Preferred Institution Type')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('To match your profile with the right category of schools/institutions.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-institution-types" name="institution_types[]" multiple placeholder="<?php echo e(__('Search & select institution types...')); ?>">
                            <?php
                                $instTypes = old('institution_types', $account->institution_types ?? []);
                                $instTypes = is_array($instTypes) ? $instTypes : (is_string($instTypes) ? (json_decode($instTypes, true) ?? []) : []);
                                if (is_object($instTypes)) {
                                    $instTypes = method_exists($instTypes, 'toArray') ? $instTypes->toArray() : (array)$instTypes;
                                }
                                if (empty($instTypes) && !empty($account->institution_type)) {
                                    $instTypes = [$account->institution_type];
                                }
                                $instTypes = array_values(array_filter((array)$instTypes));
                            ?>
                            <optgroup label="School">
                                <?php $__currentLoopData = ['cbse_school' => 'CBSE School', 'icse_school' => 'ICSE School', 'cambridge_school' => 'Cambridge School', 'ib_school' => 'IB School', 'state_board_school' => 'State Board School', 'play_school' => 'Play School']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, $instTypes)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="College">
                                <?php $__currentLoopData = ['engineering_college' => 'Engineering College', 'medical_college' => 'Medical College', 'nursing_college' => 'Nursing College']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, $instTypes)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="Others">
                                <?php $__currentLoopData = ['edtech_company' => 'EdTech Company', 'coaching_institute' => 'Coaching Institute', 'university' => 'University']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, $instTypes)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        </select>
                        <div class="ts-max-info"><span class="count" id="inst-count">0</span> <?php echo e(__('selected')); ?></div>
                    </div>

                    <!-- 24. Position Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('Role Category')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Choose the type of role you are interested in. It helps schools filter candidates by job role.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <div class="d-flex gap-3 mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input position-type-check" name="position_type[]" value="teaching" id="position_teaching" <?php if(str_contains(old('position_type', $account->position_type ?? ''), 'teaching')): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="position_teaching"><?php echo e(__('Teaching')); ?></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input position-type-check" name="position_type[]" value="non_teaching" id="position_non_teaching" <?php if(str_contains(old('position_type', $account->position_type ?? ''), 'non_teaching')): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="position_non_teaching"><?php echo e(__('Non-Teaching')); ?></label>
                            </div>
                        </div>
                    </div>

                    <!-- 25. Teaching Subjects (shown when Teaching is selected) -->
                    <div class="col-md-6 mb-3" id="teaching_subjects_wrapper">
                        <label class="form-label"><?php echo e(__('Preferred Teaching Subject & Level')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Select subjects you can teach. Schools filter candidates by subject and level.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-teaching-subjects" name="teaching_subjects[]" multiple placeholder="<?php echo e(__('Search & select subjects...')); ?>">
                            <?php $teachingSubjects = old('teaching_subjects', $account->teaching_subjects ?? []); ?>
                            <optgroup label="Primary Level">
                                <?php $__currentLoopData = [
                                    'english_primary' => 'English (Primary)',
                                    'hindi_primary' => 'Hindi (Primary)',
                                    'mathematics_primary' => 'Mathematics (Primary)',
                                    'evs_primary' => 'EVS (Primary)',
                                    'social_studies_primary' => 'Social Studies (Primary)',
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$teachingSubjects)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="Upper Primary Level">
                                <?php $__currentLoopData = [
                                    'english_upper_primary' => 'English (Upper Primary)',
                                    'hindi_upper_primary' => 'Hindi (Upper Primary)',
                                    'mathematics_upper_primary' => 'Mathematics (Upper Primary)',
                                    'science_upper_primary' => 'Science (Upper Primary)',
                                    'social_science_upper_primary' => 'Social Science (Upper Primary)',
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$teachingSubjects)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="Secondary Level">
                                <?php $__currentLoopData = [
                                    'physics_secondary' => 'Physics (Secondary)',
                                    'chemistry_secondary' => 'Chemistry (Secondary)',
                                    'biology_secondary' => 'Biology (Secondary)',
                                    'mathematics_secondary' => 'Mathematics (Secondary)',
                                    'english_secondary' => 'English (Secondary)',
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$teachingSubjects)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="Higher Secondary Level">
                                <?php $__currentLoopData = [
                                    'physics_higher_secondary' => 'Physics (Higher Secondary)',
                                    'chemistry_higher_secondary' => 'Chemistry (Higher Secondary)',
                                    'biology_higher_secondary' => 'Biology (Higher Secondary)',
                                    'mathematics_higher_secondary' => 'Mathematics (Higher Secondary)',
                                    'commerce_higher_secondary' => 'Commerce (Higher Secondary)',
                                    'accountancy_higher_secondary' => 'Accountancy (Higher Secondary)',
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$teachingSubjects)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="College Level">
                                <?php $__currentLoopData = [
                                    'english_degree' => 'English (Degree College)',
                                    'zoology_degree' => 'Zoology (Degree College)',
                                    'botany_degree' => 'Botany (Degree College)',
                                    'physics_degree' => 'Physics (Degree College)',
                                    'chemistry_degree' => 'Chemistry (Degree College)',
                                    'mechanics_engineering' => 'Mechanics (Engineering College)',
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$teachingSubjects)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        </select>
                        <div class="ts-max-info"><span class="count" id="subj-count">0</span> <?php echo e(__('selected')); ?></div>
                    </div>

                    <!-- Non-Teaching Positions (shown when Non-Teaching is selected) -->
                    <div class="col-md-6 mb-3" id="non_teaching_positions_wrapper" style="display: none;">
                        <label class="form-label"><?php echo e(__('Preferred Non-Teaching Role')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Select the non-teaching roles you are interested in. It helps to match you with suitable administrative or support positions.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-non-teaching" name="non_teaching_positions[]" multiple placeholder="<?php echo e(__('Search & select positions...')); ?>">
                            <?php $nonTeachingPositions = old('non_teaching_positions', $account->non_teaching_positions ?? []); ?>
                            <?php $__currentLoopData = [
                                'principal' => 'School Principal',
                                'vice_principal' => 'Vice Principal',
                                'administrator' => 'Administrator',
                                'hr' => 'HR',
                                'hostel_warden' => 'Hostel Warden',
                                'counselor' => 'Counselor',
                                'academic_coordinator' => 'Academic Coordinator',
                                'librarian' => 'Librarian',
                                'lab_assistant' => 'Lab Assistant',
                                'office_staff' => 'Office Staff',
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$nonTeachingPositions)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="ts-max-info"><span class="count" id="nt-count">0</span> <?php echo e(__('selected')); ?></div>
                    </div>

                    <!-- 26. Employment Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><?php echo e(__('Employment Type')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Choose your preferred working arrangement.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-job-type" name="job_type_preferences[]" multiple placeholder="<?php echo e(__('Select employment types...')); ?>">
                            <?php $jobTypes = old('job_type_preferences', $account->job_type_preferences ?? []); ?>
                            <?php $__currentLoopData = ['full_time' => 'Full Time', 'part_time' => 'Part Time', 'contract' => 'Contract', 'temporary' => 'Temporary', 'visiting_faculty' => 'Visiting Faculty', 'ad_hoc' => 'Ad-Hoc']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($val); ?>" <?php if(in_array($val, (array)$jobTypes)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="form-check mt-2">
                            <input type="hidden" name="remote_only" value="0">
                            <input type="checkbox" class="form-check-input" name="remote_only" value="1" id="remote_only" <?php if(old('remote_only', $account->remote_only ?? false)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="remote_only"><?php echo e(__('Available only for Remote jobs')); ?></label>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
   

    <!-- Section 5: Location -->
    <?php
        $countries = [];
        $currentStates = [];
        $currentCities = [];
        $nativeStates = [];
        $nativeCities = [];
        if (is_plugin_active('location')) {
            $countries = \Botble\Location\Models\Country::query()
                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();
            $cid = old('country_id', $account->country_id);
            if ($cid) {
                $currentStates = \Botble\Location\Models\State::query()
                    ->where('country_id', $cid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
            $sid = old('state_id', $account->state_id);
            if ($sid) {
                $currentCities = \Botble\Location\Models\City::query()
                    ->where('state_id', $sid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
            $nCid = old('native_country_id', $account->native_country_id);
            if ($nCid) {
                $nativeStates = \Botble\Location\Models\State::query()
                    ->where('country_id', $nCid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
            $nSid = old('native_state_id', $account->native_state_id);
            if ($nSid) {
                $nativeCities = \Botble\Location\Models\City::query()
                    ->where('state_id', $nSid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
        }
        $workLocationPreferenceType = old('work_location_preference_type', $account->work_location_preference_type ?? '');
        $workLocations = old('work_location_preferences', $account->work_location_preferences ?? []);
        if (!is_array($workLocations)) $workLocations = [];
        $workLocations = array_slice(array_values($workLocations), 0, 3);
        $useLocationDropdowns = is_plugin_active('location');
        $currentCountryName = old('country_name', $account->country_name ?? '');
        $currentStateName = old('state_name', $account->state_name ?? '');
        $currentCityName = old('city_name', $account->city_name ?? '');
        if (!$currentCountryName && is_plugin_active('location') && $account->country_id) {
            try { $currentCountryName = \Botble\Location\Models\Country::find($account->country_id)->name ?? ''; } catch (\Throwable $e) {}
        }
        if (is_plugin_active('location')) {
            if (!$currentCountryName && $account->country_id) { try { $currentCountryName = \Botble\Location\Models\Country::find($account->country_id)->name ?? ''; } catch (\Throwable $e) {} }
            if (!$currentStateName && $account->state_id) { try { $currentStateName = \Botble\Location\Models\State::find($account->state_id)->name ?? ''; } catch (\Throwable $e) {} }
            if (!$currentCityName && $account->city_id) { try { $currentCityName = \Botble\Location\Models\City::find($account->city_id)->name ?? ''; } catch (\Throwable $e) {} }
        }
        $nativeCountryName = old('native_country_name', $account->native_country_name ?? '');
        $nativeStateName = old('native_state_name', $account->native_state_name ?? '');
        $nativeCityName = old('native_city_name', $account->native_city_name ?? '');
        if (!$nativeCountryName && is_plugin_active('location') && $account->native_country_id) {
            try { $nativeCountryName = \Botble\Location\Models\Country::find($account->native_country_id)->name ?? ''; } catch (\Throwable $e) {}
        }
        if (!$nativeStateName && is_plugin_active('location') && $account->native_state_id) {
            try { $nativeStateName = \Botble\Location\Models\State::find($account->native_state_id)->name ?? ''; } catch (\Throwable $e) {}
        }
        if (!$nativeCityName && is_plugin_active('location') && $account->native_city_id) {
            try { $nativeCityName = \Botble\Location\Models\City::find($account->native_city_id)->name ?? ''; } catch (\Throwable $e) {}
        }
    ?>
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-map-marker-alt"></i> <?php echo e(__('Location Details')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Help schools/institutions understand your current location and preferred work areas for better job matching.')); ?>"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="profile-section-body">
            
            <h6 class="mb-2 text-dark"><?php echo e(__('Current Location')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Select the city, state, and locality where you are currently residing.')); ?>"><i class="fa fa-question-circle"></i></span></h6>
            <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('City')); ?></label>
                    <div class="city-search-wrapper" style="position:relative;">
                        <input type="text" id="js-current-city-search" class="form-control" value="<?php echo e($currentCityName); ?>" placeholder="<?php echo e(__('Type or select city...')); ?>" autocomplete="off">
                        <div id="js-current-city-suggestions" class="city-suggestions-dropdown" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:100; background:#fff; border:1px solid #dee2e6; border-radius:8px; max-height:220px; overflow-y:auto; box-shadow:0 4px 12px rgba(0,0,0,0.15);"></div>
                    </div>
                    <small class="text-muted"><?php echo e(__('Type and select city; State and Country auto-fill')); ?></small>
                    <input type="hidden" name="city_id" id="js-current-city-id" value="<?php echo e(old('city_id', $account->city_id)); ?>">
                    <input type="hidden" name="state_id" id="js-current-state-id" value="<?php echo e(old('state_id', $account->state_id)); ?>">
                    <input type="hidden" name="country_id" id="js-current-country-id" value="<?php echo e(old('country_id', $account->country_id)); ?>">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('State')); ?></label>
                    <input type="text" id="js-current-state-display" class="form-control" readonly placeholder="<?php echo e(__('Select city first')); ?>" value="<?php echo e($currentStateName); ?>" style="background:#f8f9fa;">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('Country')); ?></label>
                    <input type="text" id="js-current-country-display" class="form-control" readonly placeholder="<?php echo e(__('Select city first')); ?>" value="<?php echo e($currentCountryName); ?>" style="background:#f8f9fa;">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label"><?php echo e(__('Address')); ?></label>
                    <input type="text" class="form-control" name="address" value="<?php echo e(old('address', $account->address)); ?>" placeholder="<?php echo e(__('Enter your address')); ?>">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label"><?php echo e(__('Pin Code')); ?></label>
                    <input type="text" class="form-control" name="pin_code" value="<?php echo e(old('pin_code', $account->pin_code ?? '')); ?>" placeholder="<?php echo e(__('e.g. 110001')); ?>" maxlength="20">
                </div>
            </div>

            
            <h6 class="mb-2 text-dark"><?php echo e(__('Permanent / Native Location')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Enter your hometown or permanent residence location.')); ?>"><i class="fa fa-question-circle"></i></span></h6>
            <div class="row mb-1">
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input type="hidden" name="native_same_as_current" value="0">
                        <input type="checkbox" class="form-check-input" name="native_same_as_current" value="1" id="native_same_as_current" <?php if(old('native_same_as_current', $account->native_same_as_current ?? false)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="native_same_as_current"><?php echo e(__('My Native Location is same as Current Location')); ?></label>
                    </div>
                </div>
            </div>
            <div id="native_location_fields" class="row mb-4" style="<?php echo e(old('native_same_as_current', $account->native_same_as_current ?? false) ? 'display:none;' : ''); ?>">
                <input type="hidden" name="native_city_id" value="<?php echo e(old('native_city_id', $account->native_city_id)); ?>">
                <input type="hidden" name="native_state_id" value="<?php echo e(old('native_state_id', $account->native_state_id)); ?>">
                <input type="hidden" name="native_country_id" value="<?php echo e(old('native_country_id', $account->native_country_id)); ?>">
                <input type="hidden" name="native_locality" value="<?php echo e(old('native_locality', $account->native_locality ?? '')); ?>">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Address')); ?></label>
                    <input type="text" class="form-control" name="native_address" value="<?php echo e(old('native_address', $account->native_address ?? '')); ?>" placeholder="<?php echo e(__('Address')); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Pin Code')); ?></label>
                    <input type="text" class="form-control" name="native_pin_code" value="<?php echo e(old('native_pin_code', $account->native_pin_code ?? '')); ?>" placeholder="<?php echo e(__('e.g. 110001')); ?>" maxlength="20">
                </div>
            </div>

            
            <h6 class="mb-2 text-dark"><?php echo e(__('Preferred Work Locations')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Choose the locations where you are willing to work. To show you relevant job opportunities based on your relocation preference.')); ?>"><i class="fa fa-question-circle"></i></span></h6>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input type="radio" class="form-check-input" name="work_location_preference_type" value="current_only" id="wl_current_only" <?php if($workLocationPreferenceType == 'current_only' || $workLocationPreferenceType === ''): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="wl_current_only"><?php echo e(__('Open to work only at Current Location')); ?></label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="radio" class="form-check-input" name="work_location_preference_type" value="relocation_india" id="wl_relocation_india" <?php if($workLocationPreferenceType == 'relocation_india'): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="wl_relocation_india"><?php echo e(__('Open for relocation across India')); ?> (<?php echo e(__('as per current location country')); ?>)</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="radio" class="form-check-input" name="work_location_preference_type" value="other" id="wl_other" <?php if($workLocationPreferenceType == 'other'): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="wl_other"><?php echo e(__('Other work location preferences')); ?></label>
                    </div>
                </div>
            </div>
            <input type="hidden" id="js-default-country-id" value="<?php echo e($account->country_id ?? ''); ?>">
            <input type="hidden" id="js-use-location-dropdowns" value="<?php echo e($useLocationDropdowns ? '1' : '0'); ?>">
            <div id="work_location_preferences_wrapper" class="mb-3" style="display: <?php echo e($workLocationPreferenceType == 'other' ? 'block' : 'none'); ?>;">
                <label class="form-label"><?php echo e(__('Add preferred locations (set priority)')); ?></label>
                <p class="form-text"><?php echo e($useLocationDropdowns ? __('Default country is same as current location; you can select other countries.') : __('Enter Country, State, City and Locality for each preferred location.')); ?></p>
                <div id="work-locations-container">
                    <?php $__currentLoopData = $workLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="removable-item work-location-item" data-state-id="<?php echo e($loc['state_id'] ?? ''); ?>" data-city-id="<?php echo e($loc['city_id'] ?? ''); ?>">
                        <?php if($index > 0): ?><button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button><?php endif; ?>
                        <div class="row align-items-end">
                            <!-- <div class="col-md-1 d-flex align-items-center mb-2">
                                <span class="priority-badge"><?php echo e($index + 1); ?></span>
                            </div> -->
                            <?php if($useLocationDropdowns): ?>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('Country')); ?></label>
                                <select class="form-select form-select-sm work-pref-country" name="work_location_preferences[<?php echo e($index); ?>][country_id]" data-index="<?php echo e($index); ?>">
                                    <option value=""><?php echo e(__('Select')); ?></option>
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>" <?php if(($loc['country_id'] ?? '') == $id): echo 'selected'; endif; ?>><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('State')); ?></label>
                                <select class="form-select form-select-sm work-pref-state" name="work_location_preferences[<?php echo e($index); ?>][state_id]" data-index="<?php echo e($index); ?>">
                                    <option value=""><?php echo e(__('Select')); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('City')); ?></label>
                                <select class="form-select form-select-sm work-pref-city" name="work_location_preferences[<?php echo e($index); ?>][city_id]" data-index="<?php echo e($index); ?>">
                                    <option value=""><?php echo e(__('Select')); ?></option>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('Country')); ?></label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[<?php echo e($index); ?>][country_name]" value="<?php echo e($loc['country_name'] ?? ''); ?>" placeholder="<?php echo e(__('Country')); ?>">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('State')); ?></label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[<?php echo e($index); ?>][state_name]" value="<?php echo e($loc['state_name'] ?? ''); ?>" placeholder="<?php echo e(__('State')); ?>">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('City')); ?></label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[<?php echo e($index); ?>][city_name]" value="<?php echo e($loc['city_name'] ?? ''); ?>" placeholder="<?php echo e(__('City')); ?>">
                            </div>
                            <?php endif; ?>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small"><?php echo e(__('Locality')); ?></label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[<?php echo e($index); ?>][locality]" value="<?php echo e($loc['locality'] ?? ''); ?>" placeholder="<?php echo e(__('Locality')); ?>">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button type="button" class="add-more-btn" onclick="addWorkLocation()" id="add-work-location-btn">+ <?php echo e(__('Add Location Preference')); ?></button>
            </div>
        </div>
    </div>
                <!-- Section 4: Qualifications & Experience -->
                <div class="profile-section">
                        <div class="profile-section-header">
                            <i class="fa fa-graduation-cap"></i> <?php echo e(__('Qualifications, Certifications & Experience')); ?>

                        </div>
                        <div class="profile-section-body">
                            <p class="form-text mb-3"><?php echo e(__('Provide your academic background and professional experience to help schools / institutions evaluate your eligibility.')); ?></p>
                            <div class="row">
                                <!-- 14. Qualifications (JSON array) -->
                                <div class="col-12 mb-4">
                                    <label class="form-label"><?php echo e(__('Academic Qualifications')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Schools/Institutions verify subject eligibility and minimum qualification requirements before shortlisting candidates. Include degree level, specialization, and institution name.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                                    <div id="qualifications-container">
                                        <?php $qualifications = old('qualifications', $account->qualifications ?? [['level' => '', 'specialization' => '']]); ?>
                                        <?php $__currentLoopData = $qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $qual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="removable-item qualification-item">
                                            <?php if($index > 0): ?><button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button><?php endif; ?>
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <select class="form-select" name="qualifications[<?php echo e($index); ?>][level]">
                                                        <option value=""><?php echo e(__('Select Level')); ?></option>
                                                        <?php $__currentLoopData = ['diploma' => 'Diploma', 'bachelors' => 'Bachelors', 'masters' => 'Masters', 'doctorate' => 'Doctorate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val); ?>" <?php if(($qual['level'] ?? '') == $val): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <select class="form-select" name="qualifications[<?php echo e($index); ?>][specialization]">
                                                        <option value=""><?php echo e(__('-- Select Specialization --')); ?></option>
                                                        <?php $__currentLoopData = $specializationsList ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e(is_object($spec) ? $spec->name : $spec['name'] ?? ''); ?>" <?php if(($qual['specialization'] ?? '') == (is_object($spec) ? $spec->name : $spec['name'] ?? '')): echo 'selected'; endif; ?>><?php echo e(is_object($spec) ? $spec->name : $spec['name'] ?? ''); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <input type="text" class="form-control" name="qualifications[<?php echo e($index); ?>][institution]" value="<?php echo e($qual['institution'] ?? ''); ?>" placeholder="<?php echo e(__('Institution Name')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <button type="button" class="add-more-btn mt-2" onclick="addQualification()">+ <?php echo e(__('Add More Qualification')); ?></button>
                                </div>

                                <!-- 15. Teaching Certifications -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><?php echo e(__('Professional Teaching Certification')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Select all professional certifications you have completed. Many schools require mandatory certifications (e.g., B.Ed, CTET) for eligibility.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                                    <select id="ts-teaching-certifications" name="teaching_certifications[]" multiple placeholder="<?php echo e(__('Search & select certifications...')); ?>">
                                        <?php
                                        $certs = old('teaching_certifications', $account->teaching_certifications ?? []);
                                        $certs = is_array($certs) ? $certs : (is_string($certs) ? (json_decode($certs, true) ?? (array)$certs) : (array)$certs);
                                    ?>
                                        <?php $__currentLoopData = ['b_ed' => 'B.Ed', 'm_ed' => 'M.Ed', 'ctet' => 'CTET', 'tet' => 'TET', 'ntt' => 'NTT', 'montessori' => 'Montessori', 'teacher_training' => 'Teacher Training Course', 'net' => 'NET', 'set' => 'SET', 'gate' => 'GATE']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($val); ?>" <?php if(in_array($val, $certs)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- 17. Total Experience -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><?php echo e(__('Total Teaching / Professional Experience')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Select your total relevant experience in teaching or education sector. Recruiters filter candidates based on experience requirements.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                                    <select class="form-select" name="total_experience" id="total_experience_select">
                                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                                        <option value="fresher" <?php if(old('total_experience', $account->total_experience ?? '') == 'fresher'): echo 'selected'; endif; ?>><?php echo e(__('Fresher')); ?></option>
                                        <option value="intern" <?php if(old('total_experience', $account->total_experience ?? '') == 'intern'): echo 'selected'; endif; ?>><?php echo e(__('Intern')); ?></option>
                                        <?php for($i = 1; $i <= 15; $i++): ?>
                                            <option value="<?php echo e($i); ?>_years" <?php if(old('total_experience', $account->total_experience ?? '') == "{$i}_years"): echo 'selected'; endif; ?>><?php echo e($i); ?> <?php echo e(__('Year(s)')); ?></option>
                                        <?php endfor; ?>
                                        <option value="15+_years" <?php if(old('total_experience', $account->total_experience ?? '') == '15+_years'): echo 'selected'; endif; ?>><?php echo e(__('15+ Years')); ?></option>
                                    </select>
                                </div>
                            </div>

                            
                            <div id="experience_section_wrapper" class="mt-4" style="display: none;">
                                <h6 class="mb-3 text-dark"><?php echo e(__('Experience Details')); ?></h6>
                                <p class="form-text mb-3"><?php echo e(__('Add your work experience below. These details will appear in your resume and help schools evaluate your profile.')); ?></p>
                                <div id="inline-experiences-list">
                                    <?php $expList = $experiences ?? collect(); ?>
                                    <?php if($expList->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $expList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="removable-item mb-3" style="background:#f8fafc; padding:14px; border-radius:8px; border:1px solid #e2e8f0;">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong><?php echo BaseHelper::clean($exp->company); ?></strong>
                                                <?php if($exp->position): ?><span class="text-muted ms-2">— <?php echo BaseHelper::clean($exp->position); ?></span><?php endif; ?>
                                                <div class="small text-muted mt-1">
                                                    <?php echo e($exp->started_at->format('M Y')); ?> - <?php if($exp->is_current): ?><?php echo e(__('Present')); ?><?php else: ?><?php echo e($exp->ended_at ? $exp->ended_at->format('M Y') : ''); ?><?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <a href="<?php echo e(route('public.account.experiences.edit', $exp->id)); ?>" class="btn btn-sm btn-outline-primary" target="_blank"><?php echo e(__('Edit')); ?></a>
                                                <form method="post" action="<?php echo e(route('public.account.experiences.destroy', $exp->id)); ?>" style="margin:0;" onsubmit="return confirm('<?php echo e(__('Are you sure?')); ?>');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><?php echo e(__('Delete')); ?></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <p class="text-muted small mb-2"><?php echo e(__('No experience added yet.')); ?></p>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo e(route('public.account.experiences.create')); ?>" class="add-more-btn" target="_blank">
                                    <i class="fa fa-plus me-1"></i> <?php echo e(__('Add Experience')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
    <!-- Section 6: Skills & Languages -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-language"></i> <?php echo e(__('Languages & Skills')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3"><?php echo e(__('This section helps schools/institutions understand communication ability and practical competencies.')); ?></p>
            <div class="row">
                <!-- 21. Languages -->
                <div class="col-12 mb-4">
                    <label class="form-label"><?php echo e(__('Languages Known')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Add languages you can confidently use for communication and teaching. Schools often filter candidates based on communication skills.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <div id="languages-container">
                        <?php $languages = old('languages', $account->languages ?? [['language' => '', 'proficiency' => '']]); ?>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="removable-item language-item">
                            <?php if($index > 0): ?><button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button><?php endif; ?>
                            <div class="row">
                                <div class="col-md-1 d-flex align-items-center">
                                    <span class="priority-badge"><?php echo e($index + 1); ?></span>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <?php if(isset($languagesList)): ?>
                                    <select class="form-select" name="languages[<?php echo e($index); ?>][language]">
                                        <option value=""><?php echo e(__('-- Select language --')); ?></option>
                                        <?php $__currentLoopData = $languagesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($opt->name); ?>" <?php if(($lang['language'] ?? '') == $opt->name): echo 'selected'; endif; ?>><?php echo e($opt->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php else: ?>
                                    <input type="text" class="form-control" name="languages[<?php echo e($index); ?>][language]" value="<?php echo e($lang['language'] ?? ''); ?>" placeholder="<?php echo e(__('Language (e.g., English)')); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <select class="form-select" name="languages[<?php echo e($index); ?>][proficiency]">
                                        <option value=""><?php echo e(__('Proficiency')); ?></option>
                                        <?php $__currentLoopData = ['basic' => 'Basic', 'intermediate' => 'Intermediate', 'fluent' => 'Fluent', 'native' => 'Native']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($val); ?>" <?php if(($lang['proficiency'] ?? '') == $val): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" class="add-more-btn mt-2" onclick="addLanguage()" id="add-language-btn">+ <?php echo e(__('Add Language')); ?></button>
                </div>

                <!-- 22. Skills -->
                <?php if($account->isJobSeeker() && (count($jobSkills ?? []) || count($selectedJobSkills ?? []))): ?>
                <div class="col-12 mb-3">
                    <label class="form-label"><?php echo e(__('Key Skills & Competencies')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Add your core teaching or professional skills relevant to your role.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="text" class="tags form-control list-tagify" style="padding:0px;" id="favorite_skills" name="favorite_skills" value="<?php echo e(implode(',', $selectedJobSkills ?? [])); ?>" data-keep-invalid-tags="false" data-list="<?php echo e($jobSkills ?? ''); ?>" data-user-input="false" placeholder="<?php echo e(__('Select from the list')); ?>"/>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Section 8: Resume & Documents -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-file-alt"></i> <?php echo e(__('Resume & Supporting Documents')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3"><?php echo e(__('Upload your professional documents to strengthen your profile and improve shortlisting chances.')); ?></p>
            <div class="row">
                <!-- 27. Resume -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Resume / CV Upload')); ?> <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Upload your latest updated resume with complete academic and experience details. Schools review resumes before shortlisting candidates for interviews. PDF/Word files only. Max 2MB')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="file" class="form-control" name="resume" accept=".pdf,.doc,.docx">
                    <?php if($account->resume): ?>
                        <small class="form-text mt-1">
                            <i class="fa fa-file me-1"></i>
                            <a href="<?php echo e(RvMedia::url($account->resume)); ?>" target="_blank"><?php echo e(__('View Current Resume')); ?></a>
                        </small>
                    <?php endif; ?>
                    <div class="form-check mt-2">
                        <input type="hidden" name="resume_parsing_allowed" value="0">
                        <input type="checkbox" class="form-check-input" name="resume_parsing_allowed" value="1" id="resume_parsing_allowed" <?php if(old('resume_parsing_allowed', $account->resume_parsing_allowed ?? false)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="resume_parsing_allowed"><?php echo e(__('Allow resume parsing to auto-fill profile')); ?></label>
                    </div>
                </div>

                <!-- 28. Cover Letter -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Cover Letter')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Upload a personalized cover letter explaining your teaching approach and career goals.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="file" class="form-control" name="cover_letter" accept=".pdf,.doc,.docx">
                    <?php if($account->cover_letter): ?>
                        <small class="form-text mt-1">
                            <i class="fa fa-file me-1"></i>
                            <a href="<?php echo e(RvMedia::url($account->cover_letter)); ?>" target="_blank"><?php echo e(__('View Current Cover Letter')); ?></a>
                        </small>
                    <?php endif; ?>
                </div>

                <!-- Self Introduction Audio -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Self Introduction Audio')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Record a short introduction about yourself, your teaching experience, and subject expertise. Helps schools evaluate communication skills, fluency, and confidence before scheduling interviews. Max 1.5 MB. You can record using the button above or upload a file.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <div class="d-flex gap-2 mb-2">
                        <!-- <button type="button" class="btn btn-outline-primary btn-sm" id="record-audio-btn">
                            <i class="fa fa-microphone me-1"></i> <?php echo e(__('Record')); ?>

                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm d-none" id="stop-record-btn">
                            <i class="fa fa-stop me-1"></i> <?php echo e(__('Stop')); ?>

                        </button> -->
                        <span class="text-muted small align-self-center" id="record-status"></span>
                    </div>
                    <input type="file" class="form-control" name="introductory_audio" id="introductory_audio_file" accept="audio/*,.mp4,video/mp4,.webm">
                </div>

                <!-- Teaching Demo YouTube -->
                <!-- <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Teaching Demo / Introduction Video Link (YouTube)')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Paste the link to your YouTube teaching demo or self-introduction video (3–10 minutes recommended).')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="url" class="form-control" name="introductory_video_url" value="<?php echo e(old('introductory_video_url', $account->introductory_video_url ?? '')); ?>" placeholder="https://www.youtube.com/watch?v=...">
                </div> -->
            </div>
            <p class="form-text text-muted mt-3 mb-0 p-3 rounded" style="background:#f8f9fa;"><i class="fa fa-lock me-2"></i><?php echo e(__('Your documents are securely stored and shared only with schools/institutions based on your profile visibility settings.')); ?></p>
        </div>
    </div>

    <!-- Section 9: Social Links -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-link"></i> <?php echo e(__('Social & Professional Link')); ?>

        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3"><?php echo e(__('Add your professional social profiles to strengthen credibility and help schools know you better.')); ?></p>
            <div class="row">
                <?php $social = old('social_links', $account->social_links ?? []); ?>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin text-primary me-2"></i><?php echo e(__('LinkedIn')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Schools may review your professional network, recommendations, and career history.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="url" class="form-control" name="social_links[linkedin]" value="<?php echo e($social['linkedin'] ?? ''); ?>" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-facebook text-primary me-2"></i><?php echo e(__('Facebook')); ?><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="<?php echo e(__('Some institutions review online presence for background understanding.')); ?>"><i class="fa fa-question-circle"></i></span></label>
                    <input type="url" class="form-control" name="social_links[facebook]" value="<?php echo e($social['facebook'] ?? ''); ?>" placeholder="https://facebook.com/...">
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="text-center mb-4">
        <button type="submit" class="btn btn-primary btn-save">
            <i class="fa fa-save me-2"></i><?php echo e(__('Save Profile')); ?>

        </button>
    </div>

    <?php echo Form::close(); ?>


<!-- TomSelect JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Bootstrap tooltips (hover + click for mobile)
    const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    if (typeof bootstrap !== 'undefined' && tooltipEls.length) {
        tooltipEls.forEach(el => new bootstrap.Tooltip(el, { trigger: 'hover focus click' }));
    }

    // ==========================================
    // TomSelect Dropdowns Initialization
    // ==========================================

    // Teaching Certifications (unlimited)
    if (document.getElementById('ts-teaching-certifications')) {
        new TomSelect('#ts-teaching-certifications', {
            plugins: ['remove_button'],
            maxItems: null,
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No certifications found</div>'; }
            }
        });
    }

    // Institution Types
    if (document.getElementById('ts-institution-types')) {
        var tsInst = new TomSelect('#ts-institution-types', {
            plugins: ['remove_button', 'optgroup_columns'],
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No institution type found</div>'; }
            },
            onChange: function() {
                var c = document.getElementById('inst-count');
                if (c) c.textContent = this.items.length;
            }
        });
        var ic = document.getElementById('inst-count');
        if (ic) ic.textContent = tsInst.items.length;
    }

    // Teaching Subjects
    var tsSubjectsInstance = null;
    if (document.getElementById('ts-teaching-subjects')) {
        tsSubjectsInstance = new TomSelect('#ts-teaching-subjects', {
            plugins: ['remove_button', 'optgroup_columns'],
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No subject found</div>'; }
            },
            onChange: function() {
                var c = document.getElementById('subj-count');
                if (c) c.textContent = this.items.length;
            }
        });
        var sc = document.getElementById('subj-count');
        if (sc) sc.textContent = tsSubjectsInstance.items.length;
    }

    // Non-Teaching Positions
    var tsNonTeachingInstance = null;
    if (document.getElementById('ts-non-teaching')) {
        tsNonTeachingInstance = new TomSelect('#ts-non-teaching', {
            plugins: ['remove_button'],
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No position found</div>'; }
            },
            onChange: function() {
                var c = document.getElementById('nt-count');
                if (c) c.textContent = this.items.length;
            }
        });
        var nc = document.getElementById('nt-count');
        if (nc) nc.textContent = tsNonTeachingInstance.items.length;
    }

    // Job Type
    if (document.getElementById('ts-job-type')) {
        new TomSelect('#ts-job-type', {
            plugins: ['remove_button'],
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No job type found</div>'; }
            }
        });
    }

    // ==========================================
    // Introductory Audio - 1.5 MB validation
    // ==========================================
    const introAudioInput = document.getElementById('introductory_audio_file');
    const introAudioHint = document.getElementById('intro_audio_hint');
    const maxAudioSize = 1.5 * 1024 * 1024; // 1.5 MB
    const hintText = '<?php echo e(__("Upload an audio file (max 1.5 MB). Include: qualifications, experience, teaching style.")); ?>';
    const errorText = '<?php echo e(__("Audio file must be 1.5 MB or less.")); ?>';

    if (introAudioInput && introAudioHint) {
        introAudioInput.addEventListener('change', function() {
            introAudioHint.textContent = hintText;
            introAudioHint.classList.remove('text-danger');
            var file = this.files[0];
            if (file && file.size > maxAudioSize) {
                introAudioHint.textContent = errorText;
                introAudioHint.classList.add('text-danger');
                this.value = '';
            }
        });
    }

    var profileForm = document.getElementById('profile-form');
    if (profileForm && introAudioHint) {
        profileForm.addEventListener('submit', function(e) {
            var audioInput = document.getElementById('introductory_audio_file');
            if (audioInput && audioInput.files.length > 0 && audioInput.files[0].size > maxAudioSize) {
                e.preventDefault();
                introAudioHint.textContent = errorText;
                introAudioHint.classList.add('text-danger');
                return false;
            }
        });
    }

    // ==========================================
    // Toggle Logic
    // ==========================================

    // Work status toggle for notice period and salary required
    const workStatus = document.getElementById('current_work_status');
    const noticePeriod = document.getElementById('notice_period_wrapper');
    
    function toggleNoticePeriod() {
        noticePeriod.style.display = workStatus.value === 'working' ? 'block' : 'none';
    }
    
    // Salary: not required when "Not Working Now"
    function toggleSalaryRequired() {
        const isNotWorking = workStatus.value === 'not_working';
        const currReq = document.getElementById('current_salary_req');
        const currOpt = document.getElementById('current_salary_optional');
        const currInput = document.getElementById('current_salary_input');
        const expReq = document.getElementById('expected_salary_req');
        const expOpt = document.getElementById('expected_salary_optional');
        const expInput = document.getElementById('expected_salary_input');
        if (currReq) currReq.style.display = isNotWorking ? 'none' : 'inline';
        if (currOpt) currOpt.style.display = isNotWorking ? 'inline' : 'none';
        if (currInput) currInput.required = !isNotWorking;
        if (expReq) expReq.style.display = isNotWorking ? 'none' : 'inline';
        if (expOpt) expOpt.style.display = isNotWorking ? 'inline' : 'none';
        if (expInput) expInput.required = !isNotWorking;
    }
    
    workStatus.addEventListener('change', function() {
        toggleNoticePeriod();
        toggleSalaryRequired();
    });
    toggleNoticePeriod();
    toggleSalaryRequired();

    // Experience section: show when 1+ years selected
    const totalExpSelect = document.getElementById('total_experience_select');
    const expSectionWrapper = document.getElementById('experience_section_wrapper');
    function toggleExperienceSection() {
        if (!totalExpSelect || !expSectionWrapper) return;
        var v = totalExpSelect.value;
        var show = v && v !== 'fresher' && v !== 'intern';
        expSectionWrapper.style.display = show ? 'block' : 'none';
    }
    if (totalExpSelect) totalExpSelect.addEventListener('change', toggleExperienceSection);
    toggleExperienceSection();

    // Position type toggle for teaching subjects / non-teaching positions
    const teachingCheck = document.getElementById('position_teaching');
    const nonTeachingCheck = document.getElementById('position_non_teaching');
    const teachingSubjectsWrapper = document.getElementById('teaching_subjects_wrapper');
    const nonTeachingPositionsWrapper = document.getElementById('non_teaching_positions_wrapper');

    function togglePositionFields() {
        if (teachingSubjectsWrapper) {
            teachingSubjectsWrapper.style.display = teachingCheck.checked ? 'block' : 'none';
        }
        if (nonTeachingPositionsWrapper) {
            nonTeachingPositionsWrapper.style.display = nonTeachingCheck.checked ? 'block' : 'none';
        }
    }

    if (teachingCheck) teachingCheck.addEventListener('change', togglePositionFields);
    if (nonTeachingCheck) nonTeachingCheck.addEventListener('change', togglePositionFields);
    togglePositionFields();

    // Native same as current toggle
    const nativeSameCheck = document.getElementById('native_same_as_current');
    const nativeFields = document.getElementById('native_location_fields');
    if (nativeSameCheck && nativeFields) {
        function toggleNativeFields() {
            nativeFields.style.display = nativeSameCheck.checked ? 'none' : 'block';
        }
        nativeSameCheck.addEventListener('change', toggleNativeFields);
    }

    // Work location preference type: show "Other" locations only when "other" is selected
    const wlOther = document.getElementById('wl_other');
    const workLocationWrapper = document.getElementById('work_location_preferences_wrapper');
    function toggleWorkPrefWrapper() {
        if (workLocationWrapper) {
            workLocationWrapper.style.display = wlOther && wlOther.checked ? 'block' : 'none';
        }
    }
    document.querySelectorAll('input[name="work_location_preference_type"]').forEach(function(radio) {
        radio.addEventListener('change', toggleWorkPrefWrapper);
    });

    // City search: Current location - default 12 cities on focus, search on type
    (function() {
        var searchEl = document.getElementById('js-current-city-search');
        var suggestionsEl = document.getElementById('js-current-city-suggestions');
        var cityIdEl = document.getElementById('js-current-city-id');
        var stateIdEl = document.getElementById('js-current-state-id');
        var countryIdEl = document.getElementById('js-current-country-id');
        var stateDisplay = document.getElementById('js-current-state-display');
        var countryDisplay = document.getElementById('js-current-country-display');
        if (!searchEl || !suggestionsEl) return;
        function renderCities(cities) {
            if (!cities || cities.length === 0) { suggestionsEl.innerHTML = '<div class="p-2 text-muted">No cities found</div>'; return; }
            var html = '';
            cities.forEach(function(c) {
                var parts = []; if (c.state_name) parts.push(c.state_name); if (c.country_name) parts.push(c.country_name);
                html += '<div class="city-suggestion-item p-2 border-bottom" style="cursor:pointer;" data-id="' + (c.id||'') + '" data-name="' + (c.name||'') + '" data-state-id="' + (c.state_id||'') + '" data-state-name="' + (c.state_name||'') + '" data-country-id="' + (c.country_id||'') + '" data-country-name="' + (c.country_name||'') + '"><strong>' + (c.name||'') + '</strong>' + (parts.length ? ' <span class="text-muted">' + parts.join(', ') + '</span>' : '') + '</div>';
            });
            suggestionsEl.innerHTML = html;
            suggestionsEl.querySelectorAll('.city-suggestion-item').forEach(function(el) {
                el.addEventListener('click', function() {
                    searchEl.value = this.getAttribute('data-name') || '';
                    if (cityIdEl) cityIdEl.value = this.getAttribute('data-id') || '';
                    if (stateIdEl) stateIdEl.value = this.getAttribute('data-state-id') || '';
                    if (countryIdEl) countryIdEl.value = this.getAttribute('data-country-id') || '';
                    if (stateDisplay) stateDisplay.value = this.getAttribute('data-state-name') || '';
                    if (countryDisplay) countryDisplay.value = this.getAttribute('data-country-name') || '';
                    suggestionsEl.style.display = 'none';
                });
            });
        }
        function loadCities(k) {
            suggestionsEl.innerHTML = '<div class="p-2 text-muted">Loading...</div>';
            suggestionsEl.style.display = 'block';
            var url = '<?php echo e(route("ajax.search-cities")); ?>' + (k && k.length >= 2 ? '?k=' + encodeURIComponent(k) : '');
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r) {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    var ct = r.headers.get('Content-Type') || '';
                    if (!ct.includes('application/json')) throw new Error('Invalid response');
                    return r.json();
                })
                .then(function(res) {
                    var cities = Array.isArray(res.data) ? res.data : (res.data && res.data.data) ? res.data.data : [];
                    if (!Array.isArray(cities) && res.data && !Array.isArray(res.data)) cities = [];
                    renderCities(cities);
                })
                .catch(function(err) {
                    suggestionsEl.innerHTML = '<div class="p-2 text-danger">Could not load cities. Please try again.</div>' +
                        '<div class="p-2"><button type="button" class="btn btn-sm btn-outline-primary retry-city-load">Retry</button></div>';
                    suggestionsEl.querySelector('.retry-city-load')?.addEventListener('click', function() {
                        var k = searchEl.value.trim();
                        loadCities(k);
                    });
                });
        }
        var searchTimeout = null;
        searchEl.addEventListener('focus', function() {
            if (suggestionsEl.style.display === 'block') return;
            loadCities(this.value.trim());
        });
        searchEl.addEventListener('input', function() {
            var k = this.value.trim();
            if (searchTimeout) clearTimeout(searchTimeout);
            if (!cityIdEl) return;
            cityIdEl.value = ''; if (stateIdEl) stateIdEl.value = ''; if (countryIdEl) countryIdEl.value = '';
            if (stateDisplay) stateDisplay.value = ''; if (countryDisplay) countryDisplay.value = '';
            suggestionsEl.style.display = 'none'; suggestionsEl.innerHTML = '';
            searchTimeout = setTimeout(function() { loadCities(k); }, 300);
        });
        document.addEventListener('click', function(e) {
            if (!searchEl.contains(e.target) && !suggestionsEl.contains(e.target)) suggestionsEl.style.display = 'none';
        });
    })();

    // City-first: Native location - search city then auto-fill State & Country
    (function() {
        var searchEl = document.getElementById('js-native-city-search');
        var suggestionsEl = document.getElementById('js-native-city-suggestions');
        var cityIdEl = document.getElementById('js-native-city-id');
        var stateIdEl = document.getElementById('js-native-state-id');
        var countryIdEl = document.getElementById('js-native-country-id');
        var stateDisplay = document.getElementById('js-native-state-display');
        var countryDisplay = document.getElementById('js-native-country-display');
        if (!searchEl || !suggestionsEl) return;
        var searchTimeout = null;
        searchEl.addEventListener('input', function() {
            var k = this.value.trim();
            if (searchTimeout) clearTimeout(searchTimeout);
            cityIdEl.value = ''; stateIdEl.value = ''; countryIdEl.value = '';
            if (stateDisplay) stateDisplay.value = ''; if (countryDisplay) countryDisplay.value = '';
            suggestionsEl.style.display = 'none'; suggestionsEl.innerHTML = '';
            if (k.length < 2) return;
            searchTimeout = setTimeout(function() {
                suggestionsEl.innerHTML = '<div class="p-2 text-muted">Searching...</div>';
                suggestionsEl.style.display = 'block';
                fetch('<?php echo e(route("ajax.search-cities")); ?>?k=' + encodeURIComponent(k))
                    .then(function(r) { return r.json(); })
                    .then(function(res) {
                        var cities = res.data || [];
                        if (cities.length === 0) { suggestionsEl.innerHTML = '<div class="p-2 text-muted">No cities found</div>'; return; }
                        var html = '';
                        cities.forEach(function(c) {
                            var parts = []; if (c.state_name) parts.push(c.state_name); if (c.country_name) parts.push(c.country_name);
                            html += '<div class="city-suggestion-item p-2 border-bottom" style="cursor:pointer;" data-id="' + c.id + '" data-name="' + (c.name || '') + '" data-state-id="' + (c.state_id || '') + '" data-state-name="' + (c.state_name || '') + '" data-country-id="' + (c.country_id || '') + '" data-country-name="' + (c.country_name || '') + '"><strong>' + (c.name || '') + '</strong>' + (parts.length ? ' <span class="text-muted">' + parts.join(', ') + '</span>' : '') + '</div>';
                        });
                        suggestionsEl.innerHTML = html;
                        suggestionsEl.querySelectorAll('.city-suggestion-item').forEach(function(el) {
                            el.addEventListener('click', function() {
                                searchEl.value = this.getAttribute('data-name');
                                cityIdEl.value = this.getAttribute('data-id');
                                stateIdEl.value = this.getAttribute('data-state-id');
                                countryIdEl.value = this.getAttribute('data-country-id');
                                if (stateDisplay) stateDisplay.value = this.getAttribute('data-state-name') || '';
                                if (countryDisplay) countryDisplay.value = this.getAttribute('data-country-name') || '';
                                suggestionsEl.style.display = 'none';
                            });
                        });
                    })
                    .catch(function() { suggestionsEl.innerHTML = '<div class="p-2 text-muted">Error</div>'; });
            }, 300);
        });
        document.addEventListener('click', function(e) {
            if (!searchEl.contains(e.target) && !suggestionsEl.contains(e.target)) suggestionsEl.style.display = 'none';
        });
    })();

    // Work preference rows: load states/cities for existing rows on page load
    document.querySelectorAll('.work-location-item').forEach(function(row) {
        var countrySel = row.querySelector('.work-pref-country');
        var stateSel = row.querySelector('.work-pref-state');
        var citySel = row.querySelector('.work-pref-city');
        var stateId = row.getAttribute('data-state-id');
        var cityId = row.getAttribute('data-city-id');
        if (countrySel && countrySel.value) {
            fetch('<?php echo e(route("ajax.states-by-country")); ?>?country_id=' + countrySel.value)
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var html = '<option value=""><?php echo e(__("Select")); ?></option>';
                    if (data.data) data.data.forEach(function(s) { html += '<option value="' + s.id + '"' + (s.id == stateId ? ' selected' : '') + '>' + s.name + '</option>'; });
                    stateSel.innerHTML = html;
                    if (stateId && stateSel.value) {
                        fetch('<?php echo e(route("ajax.cities-by-state")); ?>?state_id=' + stateSel.value)
                            .then(function(r2) { return r2.json(); })
                            .then(function(data2) {
                                var html2 = '<option value=""><?php echo e(__("Select")); ?></option>';
                                if (data2.data) data2.data.forEach(function(c) { html2 += '<option value="' + c.id + '"' + (c.id == cityId ? ' selected' : '') + '>' + c.name + '</option>'; });
                                citySel.innerHTML = html2;
                            });
                    }
                });
        }
    });

    // Work preference: country/state change for dynamic rows
    document.getElementById('work-locations-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('work-pref-country')) {
            var stateSel = e.target.closest('.work-location-item').querySelector('.work-pref-state');
            var citySel = e.target.closest('.work-location-item').querySelector('.work-pref-city');
            stateSel.innerHTML = '<option value=""><?php echo e(__("Select")); ?></option>';
            citySel.innerHTML = '<option value=""><?php echo e(__("Select")); ?></option>';
            if (e.target.value) {
                fetch('<?php echo e(route("ajax.states-by-country")); ?>?country_id=' + e.target.value)
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        var html = '<option value=""><?php echo e(__("Select")); ?></option>';
                        if (data.data) data.data.forEach(function(s) { html += '<option value="' + s.id + '">' + s.name + '</option>'; });
                        stateSel.innerHTML = html;
                    });
            }
        } else if (e.target.classList.contains('work-pref-state')) {
            var citySel = e.target.closest('.work-location-item').querySelector('.work-pref-city');
            citySel.innerHTML = '<option value=""><?php echo e(__("Select")); ?></option>';
            if (e.target.value) {
                fetch('<?php echo e(route("ajax.cities-by-state")); ?>?state_id=' + e.target.value)
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        var html = '<option value=""><?php echo e(__("Select")); ?></option>';
                        if (data.data) data.data.forEach(function(c) { html += '<option value="' + c.id + '">' + c.name + '</option>'; });
                        citySel.innerHTML = html;
                    });
            }
        }
    });
});

// Add qualification (specialization always as dropdown from jb_specializations)
var specializationsListForSelect = <?php echo json_encode(isset($specializationsList) ? $specializationsList->map(function($o) { return ['name' => $o->name]; })->values()->all() : [], 15, 512) ?>;
let qualificationIndex = <?php echo e(count($qualifications ?? [1])); ?>;
function addQualification() {
    const container = document.getElementById('qualifications-container');
    var opts = (specializationsListForSelect || []).map(function(o) { return '<option value="' + (o.name || '') + '">' + (o.name || '') + '</option>'; }).join('');
    var specializationSelectHtml = '<select class="form-select" name="qualifications[' + qualificationIndex + '][specialization]"><option value=""><?php echo e(__("-- Select Specialization --")); ?></option>' + opts + '</select>';
    const html = `
        <div class="removable-item qualification-item">
            <button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <select class="form-select" name="qualifications[${qualificationIndex}][level]">
                        <option value="">Select Level</option>
                        <option value="diploma">Diploma</option>
                        <option value="bachelors">Bachelors</option>
                        <option value="masters">Masters</option>
                        <option value="doctorate">Doctorate</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    ${specializationSelectHtml}
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="qualifications[${qualificationIndex}][institution]" placeholder="Institution Name">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    qualificationIndex++;
}

// Add language (uses dropdown from DB when languagesListOptions is set)
var languagesListOptions = <?php echo json_encode(isset($languagesList) && $languagesList->isNotEmpty() ? $languagesList->map(fn($o) => ['value' => $o->name, 'label' => $o->name])->values() : [], 512) ?>;
let languageIndex = <?php echo e(count($languages ?? [1])); ?>;
function addLanguage() {
    const container = document.getElementById('languages-container');
    var languageFieldHtml;
    if (languagesListOptions && languagesListOptions.length > 0) {
        var opts = languagesListOptions.map(function(o) { return '<option value="' + (o.value || o.label || '') + '">' + (o.label || o.value || '') + '</option>'; }).join('');
        languageFieldHtml = '<select class="form-select" name="languages[' + languageIndex + '][language]"><option value=""><?php echo e(__("-- Select language --")); ?></option>' + opts + '</select>';
    } else {
        languageFieldHtml = '<input type="text" class="form-control" name="languages[' + languageIndex + '][language]" placeholder="<?php echo e(__("Language (e.g., English)")); ?>">';
    }
    const html = `
        <div class="removable-item language-item">
            <button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>
            <div class="row">
                <div class="col-md-1 d-flex align-items-center">
                    <span class="priority-badge">${languageIndex + 1}</span>
                </div>
                <div class="col-md-5 mb-2">` + languageFieldHtml + `</div>
                <div class="col-md-5 mb-2">
                    <select class="form-select" name="languages[${languageIndex}][proficiency]">
                        <option value=""><?php echo e(__("Proficiency")); ?></option>
                        <option value="basic">Basic</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="fluent">Fluent</option>
                        <option value="native">Native</option>
                    </select>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    languageIndex++;
}

// Add work location preference
let workLocationIndex = <?php echo e(count($workLocations)); ?>;
var defaultCountryId = document.getElementById('js-default-country-id') ? document.getElementById('js-default-country-id').value : '';
var useLocationDropdowns = document.getElementById('js-use-location-dropdowns') && document.getElementById('js-use-location-dropdowns').value === '1';
var countriesData = <?php echo json_encode($countries ?? [], 15, 512) ?>;
function addWorkLocation() {
    var idx = document.querySelectorAll('.work-location-item').length;
    var html;
    if (useLocationDropdowns) {
        var countryOptionsHtml = '<option value=""><?php echo e(__("Select")); ?></option>';
        for (var id in countriesData) {
            if (countriesData.hasOwnProperty(id)) {
                countryOptionsHtml += '<option value="' + id + '"' + (id == defaultCountryId ? ' selected' : '') + '>' + countriesData[id] + '</option>';
            }
        }
        html = '<div class="removable-item work-location-item">' +
            '<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>' +
            '<div class="row align-items-end">' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("Country")); ?></label>' +
            '<select class="form-select form-select-sm work-pref-country" name="work_location_preferences[' + idx + '][country_id]" data-index="' + idx + '">' + countryOptionsHtml + '</select></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("State")); ?></label>' +
            '<select class="form-select form-select-sm work-pref-state" name="work_location_preferences[' + idx + '][state_id]" data-index="' + idx + '"><option value=""><?php echo e(__("Select")); ?></option></select></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("City")); ?></label>' +
            '<select class="form-select form-select-sm work-pref-city" name="work_location_preferences[' + idx + '][city_id]" data-index="' + idx + '"><option value=""><?php echo e(__("Select")); ?></option></select></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("Locality")); ?></label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][locality]" placeholder="<?php echo e(__("Locality")); ?>"></div>' +
            '</div></div>';
        document.getElementById('work-locations-container').insertAdjacentHTML('beforeend', html);
        if (defaultCountryId) {
            var newRow = document.getElementById('work-locations-container').lastElementChild;
            var stateSel = newRow.querySelector('.work-pref-state');
            if (stateSel) {
                fetch('<?php echo e(route("ajax.states-by-country")); ?>?country_id=' + defaultCountryId)
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        var h = '<option value=""><?php echo e(__("Select")); ?></option>';
                        if (data.data) data.data.forEach(function(s) { h += '<option value="' + s.id + '">' + s.name + '</option>'; });
                        stateSel.innerHTML = h;
                    });
            }
        }
    } else {
        html = '<div class="removable-item work-location-item">' +
            '<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>' +
            '<div class="row align-items-end">' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("Country")); ?></label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][country_name]" placeholder="<?php echo e(__("Country")); ?>"></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("State")); ?></label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][state_name]" placeholder="<?php echo e(__("State")); ?>"></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("City")); ?></label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][city_name]" placeholder="<?php echo e(__("City")); ?>"></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small"><?php echo e(__("Locality")); ?></label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][locality]" placeholder="<?php echo e(__("Locality")); ?>"></div>' +
            '</div></div>';
        document.getElementById('work-locations-container').insertAdjacentHTML('beforeend', html);
    }
}

// Remove Avatar
document.addEventListener('DOMContentLoaded', function() {
    var removeBtn = document.getElementById('remove-avatar-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            if (!confirm('<?php echo e(__("Are you sure you want to remove your profile photo?")); ?>')) return;

            fetch('<?php echo e(route("public.account.avatar.destroy")); ?>', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (!data.error) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to remove photo');
                }
            })
            .catch(function() {
                alert('Something went wrong. Please try again.');
            });
        });
    }

    // Sync sidebar avatar when avatar modal saves
    var avatarModal = document.getElementById('avatar-modal');
    if (avatarModal) {
        avatarModal.addEventListener('hidden.bs.modal', function() {
            var profileImg = document.getElementById('profile-photo-display');
            if (profileImg) {
                var sidebarAvatar = document.querySelector('.js-profile-avatar');
                if (sidebarAvatar) {
                    sidebarAvatar.src = profileImg.src;
                }
            }
        });
    }

    // Initialize specialization autocomplete for existing fields
    initSpecializationAutocomplete();

    // Record audio for Self Introduction
    (function() {
        var recordBtn = document.getElementById('record-audio-btn');
        var stopBtn = document.getElementById('stop-record-btn');
        var statusEl = document.getElementById('record-status');
        var audioInput = document.getElementById('introductory_audio_file');
        if (!recordBtn || !stopBtn || !audioInput) return;
        var mediaRecorder = null;
        var chunks = [];
        recordBtn.addEventListener('click', function() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('<?php echo e(__("Recording is not supported in your browser. Please use Chrome or Edge and allow microphone access.")); ?>');
                return;
            }
            navigator.mediaDevices.getUserMedia({ audio: true }).then(function(stream) {
                mediaRecorder = new MediaRecorder(stream);
                chunks = [];
                mediaRecorder.ondataavailable = function(e) { if (e.data.size) chunks.push(e.data); };
                mediaRecorder.onstop = function() {
                    stream.getTracks().forEach(function(t) { t.stop(); });
                    if (chunks.length) {
                        var blob = new Blob(chunks, { type: mediaRecorder.mimeType || 'audio/webm' });
                        if (blob.size > 1.5 * 1024 * 1024) {
                            alert('<?php echo e(__("Recording too large (max 1.5 MB). Please record a shorter clip.")); ?>');
                            return;
                        }
                        var file = new File([blob], 'intro_recording.webm', { type: blob.type });
                        var dt = new DataTransfer();
                        dt.items.add(file);
                        audioInput.files = dt.files;
                        statusEl.textContent = '<?php echo e(__("Recording saved. You can save the form to upload.")); ?>';
                    }
                };
                mediaRecorder.start();
                recordBtn.classList.add('d-none');
                stopBtn.classList.remove('d-none');
                statusEl.textContent = '<?php echo e(__("Recording...")); ?>';
            }).catch(function() {
                alert('<?php echo e(__("Microphone access denied. Please allow microphone access to record.")); ?>');
            });
        });
        stopBtn.addEventListener('click', function() {
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
            }
            recordBtn.classList.remove('d-none');
            stopBtn.classList.add('d-none');
        });
    })();
});

// ==========================================
// Speech-to-Text for Bio Editor
// ==========================================
var speechRecognition = null;
var isSpeechActive = false;

function toggleSpeechToText() {
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        alert('<?php echo e(__("Speech-to-Text is not supported in your browser. Please use Chrome or Edge.")); ?>');
        return;
    }

    if (isSpeechActive) {
        stopSpeechToText();
    } else {
        startSpeechToText();
    }
}

function startSpeechToText() {
    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    speechRecognition = new SpeechRecognition();
    speechRecognition.continuous = true;
    speechRecognition.interimResults = true;
    speechRecognition.lang = 'en-IN'; // English (India) - supports Hindi too

    var btn = document.getElementById('bio-speech-btn');
    var btnText = document.getElementById('speech-btn-text');
    var status = document.getElementById('speech-status');

    speechRecognition.onstart = function() {
        isSpeechActive = true;
        btn.classList.add('recording');
        btn.querySelector('i').className = 'fa fa-stop';
        btnText.textContent = '<?php echo e(__("Stop Listening")); ?>';
        status.classList.add('active');
    };

    speechRecognition.onresult = function(event) {
        var finalTranscript = '';
        for (var i = event.resultIndex; i < event.results.length; i++) {
            if (event.results[i].isFinal) {
                finalTranscript += event.results[i][0].transcript;
            }
        }
        if (finalTranscript) {
            insertTextIntoEditor(finalTranscript);
        }
    };

    speechRecognition.onerror = function(event) {
        console.error('Speech recognition error:', event.error);
        if (event.error === 'not-allowed') {
            alert('<?php echo e(__("Microphone access was denied. Please allow microphone access in your browser settings.")); ?>');
        }
        stopSpeechToText();
    };

    speechRecognition.onend = function() {
        if (isSpeechActive) {
            // Restart if still active (auto-stop protection)
            try { speechRecognition.start(); } catch(e) { stopSpeechToText(); }
        }
    };

    try {
        speechRecognition.start();
    } catch(e) {
        alert('<?php echo e(__("Could not start speech recognition. Please try again.")); ?>');
    }
}

function stopSpeechToText() {
    isSpeechActive = false;
    if (speechRecognition) {
        speechRecognition.stop();
        speechRecognition = null;
    }
    var btn = document.getElementById('bio-speech-btn');
    var btnText = document.getElementById('speech-btn-text');
    var status = document.getElementById('speech-status');
    btn.classList.remove('recording');
    btn.querySelector('i').className = 'fa fa-microphone';
    btnText.textContent = '<?php echo e(__("Speech to Text")); ?>';
    status.classList.remove('active');
}

function insertTextIntoEditor(text) {
    // Try CKEditor first
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances && CKEDITOR.instances.bio) {
        CKEDITOR.instances.bio.model.change(function(writer) {
            var root = CKEDITOR.instances.bio.model.document.getRoot();
            writer.insertText(text, root, 'end');
        });
        return;
    }

    // Try window.editor (CKEditor 5)
    if (typeof window.editorManagement !== 'undefined' && window.editorManagement.CKEDITOR && window.editorManagement.CKEDITOR.bio) {
        var editor = window.editorManagement.CKEDITOR.bio;
        editor.model.change(function(writer) {
            var insertPosition = editor.model.document.selection.getLastPosition();
            writer.insertText(' ' + text, insertPosition);
        });
        return;
    }

    // Fallback: append to textarea
    var textarea = document.getElementById('bio');
    if (textarea) {
        textarea.value += ' ' + text;
        // Trigger change event
        textarea.dispatchEvent(new Event('change'));
    }
}

// ==========================================
// Specialization/Subject Autocomplete (from DB: jb_specializations)
// ==========================================
var specializationsList = <?php echo json_encode(isset($specializationsList) ? $specializationsList->pluck('name')->values() : [], 15, 512) ?>;

function initSpecializationAutocomplete() {
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('specialization-input')) {
            handleSpecializationInput(e.target);
        }
    });

    document.addEventListener('click', function(e) {
        // Close all dropdowns when clicking outside
        if (!e.target.classList.contains('specialization-input') && !e.target.classList.contains('specialization-suggestion-item')) {
            document.querySelectorAll('.specialization-suggestions').forEach(function(el) {
                el.classList.remove('active');
            });
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.target.classList.contains('specialization-input')) {
            handleSpecializationKeydown(e);
        }
    });
}

function handleSpecializationInput(input) {
    var query = input.value.trim().toLowerCase();
    var suggestionsDiv = input.parentElement.querySelector('.specialization-suggestions');

    if (query.length < 1) {
        suggestionsDiv.classList.remove('active');
        return;
    }

    var matches = specializationsList.filter(function(item) {
        return item.toLowerCase().indexOf(query) !== -1;
    }).slice(0, 8);

    if (matches.length === 0) {
        suggestionsDiv.classList.remove('active');
        return;
    }

    var html = '';
    matches.forEach(function(item, idx) {
        var highlighted = item.replace(new RegExp('(' + query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi'), '<strong>$1</strong>');
        html += '<div class="specialization-suggestion-item' + (idx === 0 ? ' highlighted' : '') + '" data-value="' + item + '">' + highlighted + '</div>';
    });

    suggestionsDiv.innerHTML = html;
    suggestionsDiv.classList.add('active');

    // Add click handlers
    suggestionsDiv.querySelectorAll('.specialization-suggestion-item').forEach(function(item) {
        item.addEventListener('click', function() {
            input.value = this.getAttribute('data-value');
            suggestionsDiv.classList.remove('active');
            input.focus();
        });
    });
}

function handleSpecializationKeydown(e) {
    var suggestionsDiv = e.target.parentElement.querySelector('.specialization-suggestions');
    if (!suggestionsDiv.classList.contains('active')) return;

    var items = suggestionsDiv.querySelectorAll('.specialization-suggestion-item');
    var current = suggestionsDiv.querySelector('.highlighted');
    var currentIdx = -1;
    items.forEach(function(item, idx) { if (item === current) currentIdx = idx; });

    if (e.key === 'ArrowDown') {
        e.preventDefault();
        if (current) current.classList.remove('highlighted');
        var next = (currentIdx + 1) % items.length;
        items[next].classList.add('highlighted');
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        if (current) current.classList.remove('highlighted');
        var prev = (currentIdx - 1 + items.length) % items.length;
        items[prev].classList.add('highlighted');
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (current) {
            e.target.value = current.getAttribute('data-value');
            suggestionsDiv.classList.remove('active');
        }
    } else if (e.key === 'Escape') {
        suggestionsDiv.classList.remove('active');
    }
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/settings/index.blade.php ENDPATH**/ ?>