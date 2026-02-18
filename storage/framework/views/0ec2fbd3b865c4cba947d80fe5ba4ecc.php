<?php
    Theme::layout('without-navbar');
?>

<style>
    .employer-institution-wrapper {
        min-height: 100vh;
        background: #f5f7fa;
        background-image: 
            radial-gradient(at 20% 30%, rgba(0, 115, 209, 0.08) 0%, transparent 50%),
            radial-gradient(at 80% 70%, rgba(67, 67, 67, 0.06) 0%, transparent 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .employer-institution-container {
        width: 100%;
        max-width: 480px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .employer-institution-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 20px 30px;
        text-align: center;
    }

    .employer-institution-header h2 {
        color: #ffffff;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .employer-institution-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
        margin: 0;
    }

    .employer-institution-body {
        padding: 25px 30px;
    }

    .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .form-control, .form-select {
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 12px;
        height: 40px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #434343;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 2px rgba(0, 115, 209, 0.1);
    }

    .submit-btn {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-size: 14px;
        font-weight: 600;
        width: 100%;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
    }

    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
    }

    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #999;
        font-size: 11px;
        white-space: nowrap;
    }

    .step.active {
        color: #0073d1;
        font-weight: 600;
    }

    .step.completed {
        color: #28a745;
    }

    .step-number {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .step.active .step-number {
        background: #0073d1;
        color: #fff;
    }

    .step.completed .step-number {
        background: #28a745;
        color: #fff;
    }

    @media (max-width: 480px) {
        .step-indicator { gap: 6px; }
        .step { font-size: 10px; gap: 3px; }
        .step-number { width: 20px; height: 20px; font-size: 9px; }
    }

    @media (max-width: 360px) {
        .step span:last-child { display: none; }
    }

    .back-link {
        color: #0073d1;
        text-decoration: none;
        font-size: 13px;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    /* Registration Type Radio Styles */
    .reg-type-group {
        display: flex;
        gap: 16px;
        margin-top: 6px;
    }

    .reg-type-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 10px 18px;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        transition: all 0.25s ease;
        flex: 1;
    }

    .reg-type-option:hover {
        border-color: #0073d1;
        background: #f0f7ff;
    }

    .reg-type-option.selected {
        border-color: #0073d1;
        background: #f0f7ff;
        box-shadow: 0 0 0 2px rgba(0, 115, 209, 0.12);
    }

    .reg-type-option input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: #0073d1;
        cursor: pointer;
        margin: 0;
    }

    .reg-type-option label {
        cursor: pointer;
        font-size: 14px;
        color: #434343;
        font-weight: 500;
        margin: 0;
    }

    .reg-type-option.selected label {
        color: #0073d1;
        font-weight: 600;
    }
</style>

<div class="employer-institution-wrapper">
    <div class="employer-institution-container">
        <div class="employer-institution-header">
            <h2><i class="ti ti-building me-2"></i><span id="header-title">Institution Details</span></h2>
            <p><span id="header-subtitle">Step 3 of 4 - Tell us about your institution</span></p>
        </div>
        
        <div class="employer-institution-body">
            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step completed">
                    <span class="step-number">✓</span>
                    <span>Basic Details</span>
                </div>
                <div class="step completed">
                    <span class="step-number">✓</span>
                    <span>Verification</span>
                </div>
                <div class="step active">
                    <span class="step-number">3</span>
                    <span id="step3-label">Add school/institution</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <form id="institution-form">
                <?php echo csrf_field(); ?>
                
                <!-- Are you registering as? -->
                <div class="mb-3">
                    <label class="form-label">Are you registering as? <span class="text-danger">*</span></label>
                    <div class="reg-type-group">
                        <div class="reg-type-option selected" id="opt-school" onclick="selectRegType('school_institution')">
                            <input type="radio" name="registration_type" id="reg_type_school" value="school_institution" checked>
                            <label for="reg_type_school">School/Institution</label>
                        </div>
                        <div class="reg-type-option" id="opt-consultancy" onclick="selectRegType('consultancy')">
                            <input type="radio" name="registration_type" id="reg_type_consultancy" value="consultancy">
                            <label for="reg_type_consultancy">Consultancy</label>
                        </div>
                    </div>
                </div>

                <!-- Institution Type (visible only for School/Institution) -->
                <div class="mb-3" id="institution-type-group">
                    <label class="form-label">Institution Type <span class="text-danger">*</span></label>
                    <select name="institution_type" id="institution_type" class="form-select">
                        <option value="">Select Institution Type</option>
                        <optgroup label="🏫 School">
                            <option value="cbse-school">CBSE School</option>
                            <option value="icse-school">ICSE School</option>
                            <option value="cambridge-school">Cambridge School</option>
                            <option value="ib-school">IB School</option>
                            <option value="igcse-school">IGCSE School</option>
                            <option value="primary-school">Primary School</option>
                            <option value="play-school">Play School</option>
                            <option value="state-board-school">State Board School</option>
                        </optgroup>
                        <optgroup label="🎓 College">
                            <option value="engineering-college">Engineering College</option>
                            <option value="medical-college">Medical College</option>
                            <option value="nursing-college">Nursing College</option>
                            <option value="pharmacy-college">Pharmacy College</option>
                            <option value="science-college">Science College</option>
                            <option value="management-college">Management College</option>
                            <option value="degree-college">Degree College</option>
                        </optgroup>
                        <optgroup label="📚 Coaching Institute">
                            <option value="jee-neet-institute">JEE & NEET Institute</option>
                            <option value="banking-institute">Banking Institute</option>
                            <option value="civil-services-institute">Civil Services Institute</option>
                            <option value="it-training-institute">IT Training Institute</option>
                        </optgroup>
                        <optgroup label="💻 EdTech & Online">
                            <option value="edtech-company">EdTech Company</option>
                            <option value="online-education-platform">Online Education Platform</option>
                        </optgroup>
                        <optgroup label="🏛️ University & Academy">
                            <option value="university">University</option>
                            <option value="sport-academy">Sport Academy</option>
                            <option value="music-academy">Music Academy</option>
                        </optgroup>
                        <optgroup label="📋 Other">
                            <option value="non-profit-organization">Non-Profit Organization</option>
                            <option value="book-publishing-company">Book Publishing Company</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Name field (label changes dynamically) -->
                <div class="mb-3">
                    <label class="form-label" id="name-label">School/Institution Name (Whenregisterasschool/institution)
                    <span class="text-danger">*</span></label>
                    <input type="text" name="institution_name" id="institution_name" class="form-control" 
                           placeholder="Enter your school/institution name" required>
                </div>

                <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                <button type="submit" class="submit-btn" id="submit-btn">
                    Continue <i class="ti ti-arrow-right ms-2"></i>
                </button>
            </form>

            <p class="mt-4 text-center">
                <a href="<?php echo e(route('public.account.register.employer.verifyEmailPage')); ?>" class="back-link">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
            </p>
        </div>
    </div>
</div>

<script>
// Registration type toggle - dynamic show/hide
function selectRegType(type) {
    var isConsultancy = (type === 'consultancy');

    // Update radio buttons
    document.getElementById('reg_type_school').checked = !isConsultancy;
    document.getElementById('reg_type_consultancy').checked = isConsultancy;

    // Update card styles
    document.getElementById('opt-school').classList.toggle('selected', !isConsultancy);
    document.getElementById('opt-consultancy').classList.toggle('selected', isConsultancy);

    // Toggle institution type dropdown
    var instTypeGroup = document.getElementById('institution-type-group');
    instTypeGroup.style.display = isConsultancy ? 'none' : 'block';
    if (isConsultancy) {
        document.getElementById('institution_type').value = '';
    }

    // Update name label and placeholder
    var nameLabel = document.getElementById('name-label');
    var nameInput = document.getElementById('institution_name');
    if (isConsultancy) {
        nameLabel.innerHTML = 'Organization Name (When register as consultancy) <span class="text-danger">*</span>';
        nameInput.placeholder = 'Enter your organization name';
    } else {
        nameLabel.innerHTML = 'School/Institution Name(When register as school/institution) <span class="text-danger">*</span>';
        nameInput.placeholder = 'Enter your school/institution name';
    }

    // Update header
    document.getElementById('header-title').textContent = isConsultancy ? 'Add school/institution' : 'Institution Details';
    document.getElementById('header-subtitle').textContent = isConsultancy 
        ? 'Step 3 of 4 - Tell us about your organization' 
        : 'Step 3 of 4 - Tell us about your institution';

    // Update step 3 label
    document.getElementById('step3-label').textContent = isConsultancy ? 'Add school/institution' : 'Institution Details';
}

document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('institution-form');
    var submitBtn = document.getElementById('submit-btn');
    var errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var regType = document.querySelector('input[name="registration_type"]:checked').value;
        var isConsultancy = (regType === 'consultancy');
        var institutionType = document.getElementById('institution_type').value;
        var institutionName = document.getElementById('institution_name').value;

        if (!isConsultancy && !institutionType) {
            showError('Please select institution type');
            return;
        }

        if (!institutionName.trim()) {
            showError(isConsultancy ? 'Please enter organization name' : 'Please enter school/institution name');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Saving...';
        errorMessage.style.display = 'none';

        var postData = {
            registration_type: regType,
            institution_name: institutionName
        };
        if (!isConsultancy) {
            postData.institution_type = institutionType;
        }

        fetch('<?php echo e(route("public.account.register.employer.saveInstitutionType")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify(postData)
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.error) {
                showError(data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Continue <i class="ti ti-arrow-right ms-2"></i>';
            } else {
                window.location.href = data.next_url || '<?php echo e(route("public.account.register.employer.locationPage")); ?>';
            }
        })
        .catch(function(error) {
            showError('An error occurred. Please try again.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Continue <i class="ti ti-arrow-right ms-2"></i>';
        });
    });

    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
    }
});
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/auth/employer-institution-type.blade.php ENDPATH**/ ?>