@php
    Theme::layout('without-navbar');
@endphp

<style>
.institution-type-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f4f8 0%, #e8f4fc 50%, #f5f7fa 100%);
    margin: 0 !important;
    padding: 0 !important;
}

.tr-auth-left-panel {
    background: #0073d1 !important;
    position: relative;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    /* align-items: center; */
    padding: 20px !important;
    overflow: hidden;
    min-height: 100vh;
}

.tr-auth-curve {
    position: absolute;
    right: -1px;
    top: 0;
    height: 100%;
    width: 210px;
    /* z-index: 10; */
}

.tr-auth-left-content {
    position: relative;
    z-index: 5;
    color: #fff;
    /* text-align: center; */
    width: 100%;
    max-width: 350px;
    padding: 0 30px;
}

.tr-auth-logo img {
    max-width: 150px;
    filter: brightness(0) invert(1);
}

.tr-auth-step-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    margin-bottom: 12px;
    color: #fff;
}

.tr-auth-step-info h3 {
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 10px 0;
    color: #fff;
    line-height: 1.3;
}

.tr-auth-step-info p {
    font-size: 16px;
    opacity: 0.9;
    color: #fff;
    line-height: 1.4;
    margin: 0;
}

.tr-auth-right-panel {
    display: flex;
    align-items: center;
    /* justify-content: center; */
    padding: 10px 20px !important;
    background: #fff !important;
    min-height: 100vh;
}

.tr-auth-form-container {
    width: 100%;
    max-width: 550px;
}

.tr-auth-form-header {
    text-align: center;
    margin-bottom: 10px;
}

.tr-auth-form-header h1 {
    color: #0073d1;
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 3px 0;
}

.tr-auth-form-header p {
    color: #666;
    font-size: 13px;
    margin: 0;
}

/* Selected Tags */
.tr-selected-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 8px;
    min-height: 26px;
}

.tr-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #0073d1;
    color: #fff;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 500;
}

.tr-tag-num {
    background: rgba(255,255,255,0.25);
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
}

.tr-tag-remove {
    cursor: pointer;
    margin-left: 2px;
    opacity: 0.8;
}

.tr-tag-remove:hover {
    opacity: 1;
}

/* Multi-Select Dropdown */
.tr-multiselect {
    position: relative;
    margin-bottom: 10px;
}

.tr-multiselect-label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}

.tr-multiselect-btn {
    width: 100%;
    padding: 10px 30px 10px 12px;
    border: 2px solid #e0e8f0;
    border-radius: 6px;
    font-size: 14px;
    background: #fff;
    text-align: left;
    cursor: pointer;
    position: relative;
    color: #666;
}

.tr-multiselect-btn::after {
    content: '▼';
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 10px;
    color: #999;
}

.tr-multiselect-btn.open::after {
    content: '▲';
}

.tr-multiselect-btn.has-selection {
    color: #333;
    border-color: #0073d1;
}

.tr-multiselect-dropdown {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 2px solid #0073d1;
    border-top: none;
    border-radius: 0 0 6px 6px;
    max-height: 280px;
    overflow-y: auto;
    z-index: 100;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.tr-multiselect-dropdown.show {
    display: block;
}

.tr-multiselect-group {
    border-bottom: 1px solid #eee;
}

.tr-multiselect-group:last-child {
    border-bottom: none;
}

.tr-multiselect-group-title {
    padding: 6px 12px;
    font-size: 11px;
    font-weight: 700;
    color: #0073d1;
    background: #f8fbfd;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tr-multiselect-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    cursor: pointer;
    transition: background 0.15s;
    font-size: 14px;
    color: #444;
}

.tr-multiselect-option:hover {
    background: #f0f7ff;
}

.tr-multiselect-option.selected {
    background: #e8f4fc;
    color: #0073d1;
    font-weight: 500;
}

.tr-multiselect-option.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    background: #f5f5f5;
}

.tr-multiselect-checkbox {
    width: 16px;
    height: 16px;
    border: 2px solid #ccc;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.tr-multiselect-option.selected .tr-multiselect-checkbox {
    background: #0073d1;
    border-color: #0073d1;
}

.tr-multiselect-option.selected .tr-multiselect-checkbox::after {
    content: '✓';
    color: #fff;
    font-size: 10px;
}

/* Form */
.tr-form-group {
    margin-bottom: 8px;
}

.tr-form-label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin-bottom: 4px;
    display: block;
}

.tr-form-control {
    width: 100%;
    padding: 10px 12px;
    border: 2px solid #e0e8f0;
    border-radius: 6px;
    font-size: 14px;
}

.tr-form-control:focus {
    border-color: #0073d1;
    outline: none;
}

/* Buttons */
.tr-form-buttons {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 12px;
}

.tr-btn-outline {
    padding: 10px 18px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    color: #666;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    background: #fff;
}

.tr-btn-outline:hover {
    border-color: #0073d1;
    color: #0073d1;
}

.tr-btn-primary {
    padding: 10px 22px;
    background: #0073d1;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
}

.tr-btn-primary:hover {
    background: #005ba8;
}

.tr-btn-primary:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.tr-form-footer {
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
    color: #666;
}

.tr-form-footer a {
    color: #0073d1;
    font-weight: 600;
    text-decoration: none;
}
</style>

<div class="institution-type-page" style="margin:0 !important;padding:0 !important;">
    <div class="container-fluid p-0 m-0">
        <div class="row g-0 m-0" style="min-height:100vh;">
            <!-- Left Panel -->
            <div class="col-xl-6 col-lg-4 col-md-4 d-none d-md-flex tr-auth-left-panel">
                <svg class="tr-auth-curve" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M100,0 L100,100 L30,100 Q-30,50 30,0 Z" fill="#ffffff"/>
                </svg>
                <div class="tr-auth-left-content">
                    @if (Theme::getLogo())
                        <div class="tr-auth-logo" style="margin-bottom:20px;">
                            {!! Theme::getLogoImage(['class' => 'logo-light'], 'logo', 140) !!}
                        </div>
                    @endif
                    <div class="tr-auth-step-info">
                        <span class="tr-auth-step-badge">Step 2 of 3</span>
                        <h3>Institution Type</h3>
                        <p>Choose your preferred institution types</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Panel -->
            <div class="col-xl-6 col-lg-8 col-md-8 tr-auth-right-panel">
                <div class="tr-auth-form-container">
                    <div class="tr-auth-form-header">
                        <h1>Institution Type</h1>
                        <p>Select up to 3 institution types (in order of preference)</p>
                    </div>
                    
                    <form id="institution-type-form" onsubmit="return false;">
                        @csrf
                        <input type="hidden" name="email" id="institution_email" value="" />
                        <input type="hidden" name="account_type" id="account_type_hidden" value="job-seeker" />
                        
                        <!-- Institution Name - For Employer -->
                        <div id="institution_name_field_wrapper" class="tr-form-group" style="display:none;">
                            <label class="tr-form-label">Institution Name <span class="text-danger">*</span></label>
                            <input type="text" name="institution_name" id="institution_name" 
                                class="tr-form-control" placeholder="Enter your institution name" />
                        </div>
                        
                        <!-- Selected Tags -->
                        <div id="selected-tags" class="tr-selected-tags"></div>
                        
                        <!-- Multi-Select Dropdown -->
                        <div class="tr-multiselect">
                            <label class="tr-multiselect-label">Select Institution Types (Max 3)</label>
                            <button type="button" class="tr-multiselect-btn" id="multiselect-btn">
                                Click to select institutions...
                            </button>
                            <div class="tr-multiselect-dropdown" id="multiselect-dropdown">
                                <div class="tr-multiselect-group">
                                    <div class="tr-multiselect-group-title">🏫 School</div>
                                    <div class="tr-multiselect-option" data-value="cbse-school"><div class="tr-multiselect-checkbox"></div>CBSE School</div>
                                    <div class="tr-multiselect-option" data-value="icse-school"><div class="tr-multiselect-checkbox"></div>ICSE School</div>
                                    <div class="tr-multiselect-option" data-value="cambridge-school"><div class="tr-multiselect-checkbox"></div>Cambridge School</div>
                                    <div class="tr-multiselect-option" data-value="ib-school"><div class="tr-multiselect-checkbox"></div>IB School</div>
                                    <div class="tr-multiselect-option" data-value="igcse-school"><div class="tr-multiselect-checkbox"></div>IGCSE School</div>
                                    <div class="tr-multiselect-option" data-value="primary-school"><div class="tr-multiselect-checkbox"></div>Primary School</div>
                                    <div class="tr-multiselect-option" data-value="play-school"><div class="tr-multiselect-checkbox"></div>Play School</div>
                                    <div class="tr-multiselect-option" data-value="state-board-school"><div class="tr-multiselect-checkbox"></div>State Board School</div>
                                </div>
                                <div class="tr-multiselect-group">
                                    <div class="tr-multiselect-group-title">🎓 College</div>
                                    <div class="tr-multiselect-option" data-value="engineering-college"><div class="tr-multiselect-checkbox"></div>Engineering College</div>
                                    <div class="tr-multiselect-option" data-value="medical-college"><div class="tr-multiselect-checkbox"></div>Medical College</div>
                                    <div class="tr-multiselect-option" data-value="nursing-college"><div class="tr-multiselect-checkbox"></div>Nursing College</div>
                                    <div class="tr-multiselect-option" data-value="pharmacy-college"><div class="tr-multiselect-checkbox"></div>Pharmacy College</div>
                                    <div class="tr-multiselect-option" data-value="science-college"><div class="tr-multiselect-checkbox"></div>Science College</div>
                                    <div class="tr-multiselect-option" data-value="management-college"><div class="tr-multiselect-checkbox"></div>Management College</div>
                                    <div class="tr-multiselect-option" data-value="degree-college"><div class="tr-multiselect-checkbox"></div>Degree College</div>
                                </div>
                                <div class="tr-multiselect-group">
                                    <div class="tr-multiselect-group-title">📚 Coaching Institute</div>
                                    <div class="tr-multiselect-option" data-value="jee-neet-institute"><div class="tr-multiselect-checkbox"></div>JEE & NEET Institute</div>
                                    <div class="tr-multiselect-option" data-value="banking-institute"><div class="tr-multiselect-checkbox"></div>Banking Institute</div>
                                    <div class="tr-multiselect-option" data-value="civil-services-institute"><div class="tr-multiselect-checkbox"></div>Civil Services Institute</div>
                                    <div class="tr-multiselect-option" data-value="it-training-institute"><div class="tr-multiselect-checkbox"></div>IT Training Institute</div>
                                </div>
                                <div class="tr-multiselect-group">
                                    <div class="tr-multiselect-group-title">💻 EdTech & Online</div>
                                    <div class="tr-multiselect-option" data-value="edtech-company"><div class="tr-multiselect-checkbox"></div>EdTech Company</div>
                                    <div class="tr-multiselect-option" data-value="online-education-platform"><div class="tr-multiselect-checkbox"></div>Online Education Platform</div>
                                </div>
                                <div class="tr-multiselect-group">
                                    <div class="tr-multiselect-group-title">🏛️ University & Academy</div>
                                    <div class="tr-multiselect-option" data-value="university"><div class="tr-multiselect-checkbox"></div>University</div>
                                    <div class="tr-multiselect-option" data-value="sport-academy"><div class="tr-multiselect-checkbox"></div>Sport Academy</div>
                                    <div class="tr-multiselect-option" data-value="music-academy"><div class="tr-multiselect-checkbox"></div>Music Academy</div>
                                </div>
                                <div class="tr-multiselect-group">
                                    <div class="tr-multiselect-group-title">📋 Other</div>
                                    <div class="tr-multiselect-option" data-value="non-profit-organization"><div class="tr-multiselect-checkbox"></div>Non-Profit Organization</div>
                                    <div class="tr-multiselect-option" data-value="book-publishing-company"><div class="tr-multiselect-checkbox"></div>Book Publishing Company</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Buttons -->
                        <div class="tr-form-buttons">
                            <a href="{{ route('public.account.register.verifyEmailPage') }}" class="tr-btn-outline">← Back</a>
                            <button type="button" class="tr-btn-primary" id="continue-btn">Continue →</button>
                        </div>
                        
                        <div class="tr-form-footer">
                            Already have an account? <a href="{{ route('public.account.login') }}">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    let selected = []; // Array of { value, label }
    const MAX = 3;
    
    const btn = document.getElementById('multiselect-btn');
    const dropdown = document.getElementById('multiselect-dropdown');
    const tagsContainer = document.getElementById('selected-tags');
    
    // Toggle dropdown
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
        btn.classList.toggle('open');
    });
    
    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.tr-multiselect')) {
            dropdown.classList.remove('show');
            btn.classList.remove('open');
        }
    });
    
    // Option click
    document.querySelectorAll('.tr-multiselect-option').forEach(opt => {
        opt.addEventListener('click', function() {
            if (this.classList.contains('disabled')) return;
            
            const value = this.dataset.value;
            const label = this.textContent.trim();
            
            const idx = selected.findIndex(s => s.value === value);
            
            if (idx > -1) {
                // Deselect
                selected.splice(idx, 1);
                this.classList.remove('selected');
            } else if (selected.length < MAX) {
                // Select
                selected.push({ value, label });
                this.classList.add('selected');
            }
            
            updateUI();
        });
    });
    
    // Remove tag
    window.removeTag = function(value) {
        selected = selected.filter(s => s.value !== value);
        document.querySelector(`.tr-multiselect-option[data-value="${value}"]`)?.classList.remove('selected');
        updateUI();
    };
    
    // Update UI
    function updateUI() {
        // Update tags
        if (selected.length === 0) {
            tagsContainer.innerHTML = '';
        } else {
            tagsContainer.innerHTML = selected.map((s, i) => `
                <div class="tr-tag">
                    <span class="tr-tag-num">${i + 1}</span>
                    ${s.label}
                    <span class="tr-tag-remove" onclick="removeTag('${s.value}')">&times;</span>
                </div>
            `).join('');
        }
        
        // Update button text
        if (selected.length === 0) {
            btn.textContent = 'Click to select institutions...';
            btn.classList.remove('has-selection');
        } else {
            btn.textContent = `${selected.length} selected (Max ${MAX})`;
            btn.classList.add('has-selection');
        }
        
        // Disable unselected options if max reached
        document.querySelectorAll('.tr-multiselect-option').forEach(opt => {
            const isSelected = selected.some(s => s.value === opt.dataset.value);
            if (selected.length >= MAX && !isSelected) {
                opt.classList.add('disabled');
            } else {
                opt.classList.remove('disabled');
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Load email
        fetch('{{ route("public.account.register.getVerificationData") }}', {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.data?.email) {
                document.getElementById('institution_email').value = data.data.email;
                
                let accountType = data.data.temp_account?.type || data.data.form_data?.account_type;
                if (!accountType) {
                    const saved = localStorage.getItem('registrationFormData');
                    if (saved) try { accountType = JSON.parse(saved).account_type; } catch(e) {}
                }
                
                document.getElementById('account_type_hidden').value = accountType || 'job-seeker';
                
                if (accountType === 'employer') {
                    document.getElementById('institution_name_field_wrapper').style.display = 'block';
                }
            }
        });
        
        // Continue button
        document.getElementById('continue-btn').addEventListener('click', function() {
            const email = document.getElementById('institution_email').value;
            const accountType = document.getElementById('account_type_hidden').value;
            
            if (accountType === 'employer') {
                const institutionName = document.getElementById('institution_name').value.trim();
                if (!institutionName) {
                    alert('Please enter institution name');
                    return;
                }
            }
            
            if (selected.length === 0) {
                alert('Please select at least one institution type');
                return;
            }
            
            const btn = this;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;
            
            const institutionTypes = selected.map(s => s.value);
            const csrfToken = document.querySelector('input[name="_token"]').value;
            
            fetch('{{ route("public.account.register.saveInstitutionType") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    institution_type: institutionTypes[0],
                    institution_types: institutionTypes,
                    institution_name: document.getElementById('institution_name')?.value || ''
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.error === false) {
                    localStorage.setItem('selected_institution_types', JSON.stringify(institutionTypes));
                    window.location.href = '{{ route("public.account.register.locationPage") }}';
                } else {
                    alert(data.message || 'Failed to save');
                    btn.innerHTML = 'Continue →';
                    btn.disabled = false;
                }
            })
            .catch(err => {
                alert('Failed to save');
                btn.innerHTML = 'Continue →';
                btn.disabled = false;
            });
        });
    });
})();
</script>
