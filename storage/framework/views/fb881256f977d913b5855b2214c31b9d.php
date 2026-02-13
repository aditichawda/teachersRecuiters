<?php $__env->startSection('content'); ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .emp-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        overflow: visible;
    }
    .emp-section-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        padding: 15px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
    }
    .emp-section-header i {
        margin-right: 10px;
    }
    .emp-section-body {
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
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s;
        background-color: #fff !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    /* All dropdowns - white background */
    .emp-section-body select.form-select,
    .emp-section-body select,
    .emp-section-body .form-select {
        background-color: #fff !important;
    }
    .emp-section-body select option {
        background-color: #fff !important;
    }
    .btn-save-profile {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s;
    }
    .btn-save-profile:hover {
        background: linear-gradient(135deg, #005bb5, #003f8a);
        color: #fff;
        transform: translateY(-1px);
    }
    
    /* Logo upload */
    .logo-upload-area {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .logo-preview {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8f9fa;
    }
    .logo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Dynamic entries (awards, affiliations, team) */
    .dynamic-entry {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 12px;
        position: relative;
    }
    .dynamic-entry .btn-remove-entry {
        position: absolute;
        top: 8px;
        right: 8px;
        background: none;
        border: none;
        color: #dc3545;
        font-size: 16px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .dynamic-entry .btn-remove-entry:hover {
        background: #fee;
    }
    .btn-add-entry {
        background: #f0f7ff;
        color: #0073d1;
        border: 1px dashed #0073d1;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-add-entry:hover {
        background: #e0efff;
    }
    
    /* TomSelect overrides - white background for dropdown */
    .ts-wrapper { margin-bottom: 0 !important; }
    .ts-control { border: 1.5px solid #e2e8f0 !important; border-radius: 8px !important; padding: 6px 10px !important; min-height: 42px !important; background-color: #fff !important; padding-right: 2.5rem !important; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important; background-repeat: no-repeat !important; background-position: right 0.75rem center !important; background-size: 16px 12px !important; }
    .ts-control:focus, .ts-wrapper.focus .ts-control { border-color: #0073d1 !important; box-shadow: 0 0 0 3px rgba(0,115,209,0.1) !important; }
    .ts-dropdown { background-color: #fff !important; }
    .ts-dropdown .option { background-color: #fff !important; }
    .ts-dropdown .option:hover { background-color: #f0f7ff !important; }
    
    @media (max-width: 768px) {
        .emp-section-body { padding: 15px; }
        .logo-upload-area { flex-direction: column; align-items: flex-start; }
    }
</style>


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


<?php if(session('success')): ?>
    <div class="alert alert-success mb-4" style="border-radius: 10px;">
        <i class="fa fa-check-circle me-2"></i><?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<form id="employer-profile-form" action="<?php echo e(route('public.account.employer.settings.update')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-image"></i> <?php echo e(__('Institution Logo')); ?>

        </div>
        <div class="emp-section-body">
            <div class="logo-upload-area">
                <div class="logo-preview" id="logo-preview">
                    <?php if($company && $company->logo): ?>
                        <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="Logo" id="logo-img">
                    <?php else: ?>
                        <i class="fa fa-camera" style="font-size: 24px; color: #ccc;"></i>
                    <?php endif; ?>
                </div>
                <div>
                    <input type="file" name="logo" id="logo-input" class="form-control" accept="image/*">
                    <small class="form-text text-muted"><?php echo e(__('Institution/School logo. Recommended: 200x200px. JPG, PNG. Max 2MB.')); ?></small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-user"></i> <?php echo e(__('Your Details')); ?>

        </div>
        <div class="emp-section-body">
            <div class="row">
                <!-- Full Name -->
                <div class="col-md-6 mb-lg-0 mb-sm-3">
                    <label class="form-label"><?php echo e(__('Full Name')); ?> <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="<?php echo e(old('full_name', $account->full_name ?? ($account->first_name . ' ' . $account->last_name))); ?>" required placeholder="<?php echo e(__('Enter your full name')); ?>">
                </div>
                
                <!-- Account Email (read-only) -->
                <div class="col-md-6 mb-lg-0 mb-sm-3">
                    <label class="form-label"><?php echo e(__('Login Email')); ?></label>
                    <input type="email" class="form-control" value="<?php echo e($account->email); ?>" readonly disabled style="background: #f1f5f9;">
                    <small class="form-text text-muted"><?php echo e(__('This is your login email and cannot be changed here')); ?></small>
                </div>
                
                <!-- Personal Mobile -->
                <div class="col-md-6 mb-lg-0 mb-sm-3">
                    <label class="form-label"><?php echo e(__('Mobile Number')); ?> <span class="required">*</span></label>
                    <input type="tel" name="account_phone" class="form-control" value="<?php echo e(old('account_phone', $account->phone ?? '')); ?>" required placeholder="<?php echo e(__('Enter your mobile number')); ?>">
                </div>
            </div>
        </div>
    </div>

    
    <?php
        $instType = old('institution_type', $company->institution_type ?? $account->institution_type ?? '');
    ?>
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-building"></i> <?php echo e(__('Institution Information')); ?>

        </div>
        <div class="emp-section-body">
            <div class="row">
                <!-- School/Institution Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('School/Institution Name')); ?> <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $company->name ?? $account->institution_name ?? '')); ?>" required placeholder="<?php echo e(__('Enter institution name')); ?>">
                </div>
                
                <!-- Institution Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Type of Institution')); ?> <span class="required">*</span></label>
                    <select name="institution_type" id="institution_type" class="form-select" required>
                        <option value=""><?php echo e(__('Select type')); ?></option>
                        <optgroup label="School">
                            <option value="cbse-school" <?php if($instType == 'cbse-school'): echo 'selected'; endif; ?>>CBSE School</option>
                            <option value="icse-school" <?php if($instType == 'icse-school'): echo 'selected'; endif; ?>>ICSE School</option>
                            <option value="cambridge-school" <?php if($instType == 'cambridge-school'): echo 'selected'; endif; ?>>Cambridge School</option>
                            <option value="ib-school" <?php if($instType == 'ib-school'): echo 'selected'; endif; ?>>IB School</option>
                            <option value="igcse-school" <?php if($instType == 'igcse-school'): echo 'selected'; endif; ?>>IGCSE School</option>
                            <option value="primary-school" <?php if($instType == 'primary-school'): echo 'selected'; endif; ?>>Primary School</option>
                            <option value="play-school" <?php if($instType == 'play-school'): echo 'selected'; endif; ?>>Play School</option>
                            <option value="state-board-school" <?php if($instType == 'state-board-school'): echo 'selected'; endif; ?>>State Board School</option>
                        </optgroup>
                        <optgroup label="College">
                            <option value="engineering-college" <?php if($instType == 'engineering-college'): echo 'selected'; endif; ?>>Engineering College</option>
                            <option value="medical-college" <?php if($instType == 'medical-college'): echo 'selected'; endif; ?>>Medical College</option>
                            <option value="nursing-college" <?php if($instType == 'nursing-college'): echo 'selected'; endif; ?>>Nursing College</option>
                            <option value="pharmacy-college" <?php if($instType == 'pharmacy-college'): echo 'selected'; endif; ?>>Pharmacy College</option>
                            <option value="science-college" <?php if($instType == 'science-college'): echo 'selected'; endif; ?>>Science College</option>
                            <option value="management-college" <?php if($instType == 'management-college'): echo 'selected'; endif; ?>>Management College</option>
                            <option value="degree-college" <?php if($instType == 'degree-college'): echo 'selected'; endif; ?>>Degree College</option>
                        </optgroup>
                        <optgroup label="Coaching Institute">
                            <option value="jee-neet-institute" <?php if($instType == 'jee-neet-institute'): echo 'selected'; endif; ?>>JEE & NEET Institute</option>
                            <option value="banking-institute" <?php if($instType == 'banking-institute'): echo 'selected'; endif; ?>>Banking Institute</option>
                            <option value="civil-services-institute" <?php if($instType == 'civil-services-institute'): echo 'selected'; endif; ?>>Civil Services Institute</option>
                            <option value="it-training-institute" <?php if($instType == 'it-training-institute'): echo 'selected'; endif; ?>>IT Training Institute</option>
                        </optgroup>
                        <optgroup label="EdTech & Online">
                            <option value="edtech-company" <?php if($instType == 'edtech-company'): echo 'selected'; endif; ?>>EdTech Company</option>
                            <option value="online-education-platform" <?php if($instType == 'online-education-platform'): echo 'selected'; endif; ?>>Online Education Platform</option>
                        </optgroup>
                        <optgroup label="University & Academy">
                            <option value="university" <?php if($instType == 'university'): echo 'selected'; endif; ?>>University</option>
                            <option value="sport-academy" <?php if($instType == 'sport-academy'): echo 'selected'; endif; ?>>Sport Academy</option>
                            <option value="music-academy" <?php if($instType == 'music-academy'): echo 'selected'; endif; ?>>Music Academy</option>
                        </optgroup>
                        <optgroup label="Other">
                            <option value="non-profit-organization" <?php if($instType == 'non-profit-organization'): echo 'selected'; endif; ?>>Non-Profit Organization</option>
                            <option value="book-publishing-company" <?php if($instType == 'book-publishing-company'): echo 'selected'; endif; ?>>Book Publishing Company</option>
                        </optgroup>
                    </select>
                </div>
                
                <!-- About Us -->
                <div class="col-12 mb-3">
                    <label class="form-label"><?php echo e(__('About Us')); ?> <span class="required">*</span></label>
                    <textarea name="description" class="form-control" rows="4" required placeholder="<?php echo e(__('Tell about your institution...')); ?>"><?php echo e(old('description', $company->description ?? '')); ?></textarea>
                </div>
                
                <!-- Institution Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Institution Email')); ?> <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $company->email ?? $account->email)); ?>" required placeholder="<?php echo e(__('contact@school.com')); ?>">
                    <small class="form-text text-muted"><?php echo e(__('This email will be used for job posting communications')); ?></small>
                </div>
                
                <!-- Institution Phone -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Institution Phone')); ?> <span class="required">*</span></label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo e(old('phone', $company->phone ?? $account->phone ?? '')); ?>" required placeholder="<?php echo e(__('Enter institution phone number')); ?>">
                </div>
                
                <!-- Website -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Website')); ?></label>
                    <input type="url" name="website" class="form-control" value="<?php echo e(old('website', $company->website ?? '')); ?>" placeholder="<?php echo e(__('https://www.yourschool.com')); ?>">
                </div>
                
                <!-- Established Year -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Established Year')); ?> <span class="required">*</span></label>
                    <input type="number" name="year_founded" class="form-control" value="<?php echo e(old('year_founded', $company->year_founded ?? '')); ?>" required min="1800" max="<?php echo e(date('Y')); ?>" placeholder="<?php echo e(__('e.g. 1995')); ?>">
                </div>
                
                <!-- Principal Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Principal Name')); ?></label>
                    <input type="text" name="principal_name" class="form-control" value="<?php echo e(old('principal_name', $company->principal_name ?? '')); ?>" placeholder="<?php echo e(__('Enter principal/director name')); ?>">
                </div>
                
                <!-- Total Staff -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Total Number of Staff')); ?></label>
                    <input type="number" name="total_staff" class="form-control" value="<?php echo e(old('total_staff', $company->total_staff ?? '')); ?>" min="0" max="999" placeholder="<?php echo e(__('e.g. 50')); ?>">
                    <small class="form-text text-muted"><?php echo e(__('Max 3 digits')); ?></small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-school"></i> <?php echo e(__('Campus & Facilities')); ?>

        </div>
        <div class="emp-section-body">
            <div class="row">
                <!-- Campus Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Campus Type')); ?> <span class="required">*</span></label>
                    <select name="campus_type" class="form-select" required>
                        <option value=""><?php echo e(__('Select campus type')); ?></option>
                        <option value="boarding" <?php if(old('campus_type', $company->campus_type ?? '') == 'boarding'): echo 'selected'; endif; ?>><?php echo e(__('Boarding / Residential Campus')); ?></option>
                        <option value="day" <?php if(old('campus_type', $company->campus_type ?? '') == 'day'): echo 'selected'; endif; ?>><?php echo e(__('Non-Boarding / Day Campus')); ?></option>
                        <option value="both" <?php if(old('campus_type', $company->campus_type ?? '') == 'both'): echo 'selected'; endif; ?>><?php echo e(__('Both Boarding & Day Campus')); ?></option>
                    </select>
                </div>
                
                <!-- Standard Level -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('School/Institution Standard Level')); ?> <span class="required">*</span></label>
                    <?php $selectedLevels = old('standard_level', $company->standard_level ?? []); ?>
                    <select id="ts-standard-level" name="standard_level[]" multiple placeholder="<?php echo e(__('Select levels...')); ?>">
                        <?php $__currentLoopData = ['pre_primary' => 'Pre-Primary', 'primary' => 'Primary', 'upper_primary' => 'Upper Primary', 'secondary' => 'Secondary', 'higher_secondary' => 'Higher Secondary', 'degree' => 'Degree College', 'post_graduate' => 'Post Graduate', 'research' => 'Research']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(is_array($selectedLevels) && in_array($val, $selectedLevels)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <!-- Staff Facilities -->
                <div class="col-12 mb-3">
                    <label class="form-label"><?php echo e(__('Facilities Available for Staff/Teacher')); ?> <span class="required">*</span></label>
                    <?php $selectedFacilities = old('staff_facilities', $company->staff_facilities ?? []); ?>
                    <select id="ts-staff-facilities" name="staff_facilities[]" multiple placeholder="<?php echo e(__('Select facilities...')); ?>">
                        <?php $__currentLoopData = ['residence' => 'Residence / Accommodation', 'food' => 'Food / Meals', 'electricity' => 'Electricity', 'pf' => 'Provident Fund (PF)', 'medical' => 'Medical / Health Insurance', 'transport' => 'Transport', 'child_education' => 'Children Education', 'gratuity' => 'Gratuity', 'bonus' => 'Annual Bonus', 'leave_encash' => 'Leave Encashment', 'wifi' => 'WiFi / Internet', 'library' => 'Library Access', 'gym' => 'Gym / Sports', 'professional_dev' => 'Professional Development']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(is_array($selectedFacilities) && in_array($val, $selectedFacilities)): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-map-marker-alt"></i> <?php echo e(__('Location')); ?>

        </div>
        <div class="emp-section-body">
            <div class="row">
                <?php
                    $empCityName = old('city_search_display', $locationCityName ?? '');
                    $empStateName = old('state_display', $locationStateName ?? '');
                    $empCountryName = old('country_display', $locationCountryName ?? '');
                    if (is_plugin_active('location')) {
                        if (empty($empCityName) && $company && $company->city_id) {
                            try { $empCityName = \Botble\Location\Models\City::find($company->city_id)->name ?? ''; } catch (\Throwable $e) {}
                        }
                        if (empty($empStateName) && $company && $company->state_id) {
                            try { $empStateName = \Botble\Location\Models\State::find($company->state_id)->name ?? ''; } catch (\Throwable $e) {}
                        }
                        if (empty($empCountryName) && $company && $company->country_id) {
                            try { $empCountryName = \Botble\Location\Models\Country::find($company->country_id)->name ?? ''; } catch (\Throwable $e) {}
                        }
                    }
                ?>
                <?php if(is_plugin_active('location')): ?>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('City')); ?></label>
                    <div style="position:relative;">
                        <input type="text" id="emp-city-search" class="form-control" value="<?php echo e($empCityName); ?>" placeholder="<?php echo e(__('Type city name to search...')); ?>" autocomplete="off">
                        <div id="emp-city-suggestions" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:100; background:#fff; border:1px solid #dee2e6; border-radius:8px; max-height:220px; overflow-y:auto; box-shadow:0 4px 12px rgba(0,0,0,0.15);"></div>
                    </div>
                    <small class="text-muted"><?php echo e(__('Type city first; State and Country will auto-fill.')); ?></small>
                    <input type="hidden" name="city_id" id="emp-city-id" value="<?php echo e(old('city_id', $company->city_id ?? '')); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('State')); ?></label>
                    <input type="text" id="emp-state-display" class="form-control" readonly value="<?php echo e($empStateName); ?>" style="background:#f8f9fa;" placeholder="<?php echo e(__('Select city first')); ?>">
                    <input type="hidden" name="state_id" id="emp-state-id" value="<?php echo e(old('state_id', $company->state_id ?? '')); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('Country')); ?></label>
                    <input type="text" id="emp-country-display" class="form-control" readonly value="<?php echo e($empCountryName); ?>" style="background:#f8f9fa;" placeholder="<?php echo e(__('Select city first')); ?>">
                    <input type="hidden" name="country_id" id="emp-country-id" value="<?php echo e(old('country_id', $company->country_id ?? '')); ?>">
                </div>
                <?php else: ?>
                <input type="hidden" name="country_id" value="">
                <input type="hidden" name="state_id" value="">
                <input type="hidden" name="city_id" value="">
                <div class="col-12 mb-3">
                    <p class="text-muted small"><?php echo e(__('Enable Location plugin for City / State / Country.')); ?></p>
                </div>
                <?php endif; ?>
                <div class="col-md-8 mb-3">
                    <label class="form-label"><?php echo e(__('Address')); ?> <span class="required">*</span></label>
                    <input type="text" name="address" class="form-control" value="<?php echo e(old('address', $company->address ?? '')); ?>" required placeholder="<?php echo e(__('Full address')); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?php echo e(__('Postal Code')); ?> <span class="required">*</span></label>
                    <input type="text" name="postal_code" class="form-control" value="<?php echo e(old('postal_code', $company->postal_code ?? '')); ?>" required placeholder="<?php echo e(__('e.g. 110001')); ?>" maxlength="10">
                </div>
            </div>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-share-alt"></i> <?php echo e(__('Social Links & Video')); ?>

        </div>
        <div class="emp-section-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-facebook text-primary"></i> <?php echo e(__('Facebook')); ?></label>
                    <input type="url" name="facebook" class="form-control" value="<?php echo e(old('facebook', $company->facebook ?? '')); ?>" placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin text-info"></i> <?php echo e(__('LinkedIn')); ?></label>
                    <input type="url" name="linkedin" class="form-control" value="<?php echo e(old('linkedin', $company->linkedin ?? '')); ?>" placeholder="https://linkedin.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-youtube text-danger"></i> <?php echo e(__('YouTube')); ?></label>
                    <input type="url" name="youtube_video" class="form-control" value="<?php echo e(old('youtube_video', $company->youtube_video ?? '')); ?>" placeholder="https://youtube.com/...">
                    <small class="form-text text-muted"><?php echo e(__('Add a YouTube video preview link for your institution')); ?></small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-trophy"></i> <?php echo e(__('Awards')); ?>

        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;"><?php echo e(__('Add awards received by your institution (max 5)')); ?></p>
            <div id="awards-container">
                <?php $awards = old('awards', $company->awards ?? []); ?>
                <?php if(is_array($awards) && count($awards) > 0): ?>
                    <?php $__currentLoopData = $awards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dynamic-entry award-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.award-entry').remove(); updateAwardCount();">✕</button>
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <label class="form-label"><?php echo e(__('Award Title')); ?></label>
                                <input type="text" name="awards[<?php echo e($i); ?>][title]" class="form-control" value="<?php echo e($award['title'] ?? ''); ?>" placeholder="<?php echo e(__('e.g. Best School Award')); ?>">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label"><?php echo e(__('Year')); ?></label>
                                <input type="number" name="awards[<?php echo e($i); ?>][year]" class="form-control" value="<?php echo e($award['year'] ?? ''); ?>" min="1900" max="<?php echo e(date('Y')); ?>" placeholder="<?php echo e(date('Y')); ?>">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label"><?php echo e(__('Photo')); ?></label>
                                <input type="file" name="awards_photos[<?php echo e($i); ?>]" class="form-control" accept="image/*">
                                <?php if(!empty($award['photo'])): ?>
                                    <small class="text-success"><?php echo e(__('Photo uploaded')); ?></small>
                                    <input type="hidden" name="awards[<?php echo e($i); ?>][photo]" value="<?php echo e($award['photo']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <button type="button" class="btn-add-entry mt-2" id="btn-add-award" onclick="addAward()">
                <i class="fa fa-plus me-1"></i> <?php echo e(__('Add Award')); ?>

            </button>
            <small class="form-text text-muted ms-2" id="award-count"><?php echo e(is_array($awards) ? count($awards) : 0); ?>/5</small>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-handshake"></i> <?php echo e(__('Affiliations')); ?>

        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;"><?php echo e(__('Add affiliations and accreditations')); ?></p>
            <div id="affiliations-container">
                <?php $affiliations = old('affiliations', $company->affiliations ?? []); ?>
                <?php if(is_array($affiliations) && count($affiliations) > 0): ?>
                    <?php $__currentLoopData = $affiliations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $aff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dynamic-entry affiliation-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.affiliation-entry').remove();">✕</button>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><?php echo e(__('Affiliation Title')); ?></label>
                                <input type="text" name="affiliations[<?php echo e($i); ?>][title]" class="form-control" value="<?php echo e($aff['title'] ?? ''); ?>" placeholder="<?php echo e(__('e.g. CBSE Affiliated')); ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><?php echo e(__('Certificate/Photo')); ?></label>
                                <input type="file" name="affiliations_photos[<?php echo e($i); ?>]" class="form-control" accept="image/*">
                                <?php if(!empty($aff['photo'])): ?>
                                    <small class="text-success"><?php echo e(__('Photo uploaded')); ?></small>
                                    <input type="hidden" name="affiliations[<?php echo e($i); ?>][photo]" value="<?php echo e($aff['photo']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <button type="button" class="btn-add-entry mt-2" onclick="addAffiliation()">
                <i class="fa fa-plus me-1"></i> <?php echo e(__('Add Affiliation')); ?>

            </button>
        </div>
    </div>

    
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-users"></i> <?php echo e(__('Team Members')); ?>

        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;"><?php echo e(__('Add key team members with their details')); ?></p>
            <div id="team-container">
                <?php $teamMembers = old('team_members', $company->team_members ?? []); ?>
                <?php if(is_array($teamMembers) && count($teamMembers) > 0): ?>
                    <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dynamic-entry team-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.team-entry').remove();">✕</button>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label"><?php echo e(__('Name')); ?></label>
                                <input type="text" name="team_members[<?php echo e($i); ?>][name]" class="form-control" value="<?php echo e($member['name'] ?? ''); ?>" placeholder="<?php echo e(__('Full Name')); ?>">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label"><?php echo e(__('Designation')); ?></label>
                                <input type="text" name="team_members[<?php echo e($i); ?>][designation]" class="form-control" value="<?php echo e($member['designation'] ?? ''); ?>" placeholder="<?php echo e(__('e.g. Vice Principal')); ?>">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label"><?php echo e(__('LinkedIn')); ?></label>
                                <input type="url" name="team_members[<?php echo e($i); ?>][linkedin]" class="form-control" value="<?php echo e($member['linkedin'] ?? ''); ?>" placeholder="https://linkedin.com/in/...">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <button type="button" class="btn-add-entry mt-2" onclick="addTeamMember()">
                <i class="fa fa-plus me-1"></i> <?php echo e(__('Add Team Member')); ?>

            </button>
        </div>
    </div>

    
    <div class="text-end mb-4">
        <button type="submit" class="btn-save-profile">
            <i class="fa fa-check me-2"></i><?php echo e(__('Save Profile')); ?>

        </button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // TomSelect: Institution Type
    if (document.getElementById('institution_type')) {
        new TomSelect('#institution_type', {
            allowEmptyOption: true,
            maxItems: 1,
        });
    }

    // TomSelect: Standard Level
    if (document.getElementById('ts-standard-level')) {
        new TomSelect('#ts-standard-level', {
            plugins: ['remove_button'],
            maxItems: null,
        });
    }

    // TomSelect: Staff Facilities
    if (document.getElementById('ts-staff-facilities')) {
        new TomSelect('#ts-staff-facilities', {
            plugins: ['remove_button'],
            maxItems: null,
        });
    }

    // Logo preview
    const logoInput = document.getElementById('logo-input');
    if (logoInput) {
        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const preview = document.getElementById('logo-preview');
                    preview.innerHTML = '<img src="' + ev.target.result + '" alt="Logo" id="logo-img">';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // City first: type to search city, then State and Country auto-fill
    const empCitySearch = document.getElementById('emp-city-search');
    const empCitySuggestions = document.getElementById('emp-city-suggestions');
    const empCityId = document.getElementById('emp-city-id');
    const empStateId = document.getElementById('emp-state-id');
    const empCountryId = document.getElementById('emp-country-id');
    const empStateDisplay = document.getElementById('emp-state-display');
    const empCountryDisplay = document.getElementById('emp-country-display');

    if (empCitySearch && empCitySuggestions) {
        let empSearchTimeout = null;
        empCitySearch.addEventListener('input', function() {
            const k = this.value.trim();
            if (empSearchTimeout) clearTimeout(empSearchTimeout);
            if (empCityId) empCityId.value = '';
            if (empStateId) empStateId.value = '';
            if (empCountryId) empCountryId.value = '';
            if (empStateDisplay) empStateDisplay.value = '';
            if (empCountryDisplay) empCountryDisplay.value = '';
            empCitySuggestions.style.display = 'none';
            empCitySuggestions.innerHTML = '';
            if (k.length < 2) return;
            empSearchTimeout = setTimeout(function() {
                empCitySuggestions.innerHTML = '<div class="p-2 text-muted">Searching...</div>';
                empCitySuggestions.style.display = 'block';
                fetch('<?php echo e(route("ajax.search-cities")); ?>?k=' + encodeURIComponent(k))
                    .then(function(r) {
                        if (!r.ok) return { data: [] };
                        return r.json().catch(function() { return { data: [] }; });
                    })
                    .then(function(res) {
                        const cities = (res && res.data) ? res.data : [];
                        if (cities.length === 0) {
                            empCitySuggestions.innerHTML = '<div class="p-2 text-muted">No cities found. Add cities in Admin → Location → Cities.</div>';
                            return;
                        }
                        let html = '';
                        cities.forEach(function(c) {
                            const parts = [];
                            if (c.state_name) parts.push(c.state_name);
                            if (c.country_name) parts.push(c.country_name);
                            html += '<div class="p-2 border-bottom" style="cursor:pointer;" data-id="' + (c.id || '') + '" data-name="' + (c.name || '') + '" data-state-id="' + (c.state_id || '') + '" data-state-name="' + (c.state_name || '') + '" data-country-id="' + (c.country_id || '') + '" data-country-name="' + (c.country_name || '') + '"><strong>' + (c.name || '') + '</strong>' + (parts.length ? ' <span class="text-muted">' + parts.join(', ') + '</span>' : '') + '</div>';
                        });
                        empCitySuggestions.innerHTML = html;
                        empCitySuggestions.querySelectorAll('[data-id]').forEach(function(el) {
                            el.addEventListener('click', function() {
                                empCitySearch.value = this.getAttribute('data-name');
                                if (empCityId) empCityId.value = this.getAttribute('data-id');
                                if (empStateId) empStateId.value = this.getAttribute('data-state-id');
                                if (empCountryId) empCountryId.value = this.getAttribute('data-country-id');
                                if (empStateDisplay) empStateDisplay.value = this.getAttribute('data-state-name') || '';
                                if (empCountryDisplay) empCountryDisplay.value = this.getAttribute('data-country-name') || '';
                                empCitySuggestions.style.display = 'none';
                            });
                        });
                    })
                    .catch(function() { empCitySuggestions.innerHTML = '<div class="p-2 text-muted">Search unavailable. Please try again.</div>'; });
            }, 300);
        });
        document.addEventListener('click', function(e) {
            if (!empCitySearch.contains(e.target) && !empCitySuggestions.contains(e.target)) {
                empCitySuggestions.style.display = 'none';
            }
        });
    }
});

// Dynamic Awards
let awardIndex = <?php echo e(is_array($awards ?? []) ? count($awards ?? []) : 0); ?>;
function addAward() {
    const container = document.getElementById('awards-container');
    if (container.querySelectorAll('.award-entry').length >= 5) {
        alert('Maximum 5 awards allowed');
        return;
    }
    const html = `
        <div class="dynamic-entry award-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.award-entry').remove(); updateAwardCount();">✕</button>
            <div class="row">
                <div class="col-md-5 mb-2">
                    <label class="form-label"><?php echo e(__('Award Title')); ?></label>
                    <input type="text" name="awards[${awardIndex}][title]" class="form-control" placeholder="<?php echo e(__('e.g. Best School Award')); ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label"><?php echo e(__('Year')); ?></label>
                    <input type="number" name="awards[${awardIndex}][year]" class="form-control" min="1900" max="<?php echo e(date('Y')); ?>" placeholder="<?php echo e(date('Y')); ?>">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('Photo')); ?></label>
                    <input type="file" name="awards_photos[${awardIndex}]" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    awardIndex++;
    updateAwardCount();
}
function updateAwardCount() {
    const count = document.querySelectorAll('.award-entry').length;
    document.getElementById('award-count').textContent = count + '/5';
    if (count >= 5) document.getElementById('btn-add-award').style.display = 'none';
    else document.getElementById('btn-add-award').style.display = '';
}

// Dynamic Affiliations
let affIndex = <?php echo e(is_array($affiliations ?? []) ? count($affiliations ?? []) : 0); ?>;
function addAffiliation() {
    const container = document.getElementById('affiliations-container');
    const html = `
        <div class="dynamic-entry affiliation-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.affiliation-entry').remove();">✕</button>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label"><?php echo e(__('Affiliation Title')); ?></label>
                    <input type="text" name="affiliations[${affIndex}][title]" class="form-control" placeholder="<?php echo e(__('e.g. CBSE Affiliated')); ?>">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label"><?php echo e(__('Certificate/Photo')); ?></label>
                    <input type="file" name="affiliations_photos[${affIndex}]" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    affIndex++;
}

// Dynamic Team Members
let teamIndex = <?php echo e(is_array($teamMembers ?? []) ? count($teamMembers ?? []) : 0); ?>;
function addTeamMember() {
    const container = document.getElementById('team-container');
    const html = `
        <div class="dynamic-entry team-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.team-entry').remove();">✕</button>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('Name')); ?></label>
                    <input type="text" name="team_members[${teamIndex}][name]" class="form-control" placeholder="<?php echo e(__('Full Name')); ?>">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('Designation')); ?></label>
                    <input type="text" name="team_members[${teamIndex}][designation]" class="form-control" placeholder="<?php echo e(__('e.g. Vice Principal')); ?>">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label"><?php echo e(__('LinkedIn')); ?></label>
                    <input type="url" name="team_members[${teamIndex}][linkedin]" class="form-control" placeholder="https://linkedin.com/in/...">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    teamIndex++;
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/employer-settings.blade.php ENDPATH**/ ?>