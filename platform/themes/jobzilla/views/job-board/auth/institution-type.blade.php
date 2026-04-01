@php
    Theme::layout('without-navbar');
@endphp

<style>
    .institution-wrapper {
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

    .institution-container {
        width: 100%;
        max-width: 520px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: visible;
    }

    .institution-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 24px 30px;
        text-align: center;
        border-radius: 16px 16px 0 0;
    }

    .institution-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .institution-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin: 0;
    }

    .institution-body {
        padding: 30px;
    }

    /* Step Indicator */
    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #999;
        font-size: 12px;
        white-space: nowrap;
    }

    .step.active { color: #0073d1; font-weight: 600; }
    .step.completed { color: #10b981; }

    .step-number {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: #666;
    }

    .step.active .step-number { background: #0073d1; color: #fff; }
    .step.completed .step-number { background: #10b981; color: #fff; }

    /* Selection Info */
    .selection-info {
        text-align: center;
        margin-bottom: 18px;
        padding: 10px 16px;
        background: #f0f7ff;
        border-radius: 8px;
        border: 1px solid #d0e6ff;
    }

    .selection-info p {
        margin: 0;
        font-size: 13px;
        color: #0073d1;
        font-weight: 500;
    }

    .selection-info .count { font-weight: 700; font-size: 15px; }

    /* Selected Tags */
    .selected-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        min-height: 30px;
    }

    .selected-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: #0073d1;
        color: #fff;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        animation: fadeIn 0.2s ease;
    }

    .selected-tag .remove-tag {
        cursor: pointer;
        font-size: 14px;
        font-weight: 700;
        opacity: 0.8;
        line-height: 1;
    }

    .selected-tag .remove-tag:hover { opacity: 1; }

    .no-selection {
        font-size: 12px;
        color: #999;
        margin-bottom: 8px;
        font-style: italic;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Dropdown Label */
    .dropdown-label {
        display: block;
        font-weight: 600;
        color: #374151;
        /* margin-bottom: 8px; */
        font-size: 14px;
    }

    /* Custom Multi-Select Dropdown */
    .multi-select-wrapper {
        position: relative;
        margin-bottom: 20px;
    }

    .multi-select-trigger {
        width: 100%;
        padding: 12px 40px 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        background: #fff;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: space-between;
        user-select: none;
        min-height: 48px;
    }

    .multi-select-trigger:hover { border-color: #b0c4de; }
    .multi-select-trigger.open {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .multi-select-trigger .trigger-text { color: #999; }
    .multi-select-trigger .trigger-text.has-selection { color: #374151; font-weight: 500; }

    .multi-select-trigger .arrow {
        position: absolute;
        right: 14px;
        bottom: 10%;
        transform: translateY(-50%);
        font-size: 10px;
        color: #888;
        transition: transform 0.2s;
    }

    .multi-select-trigger.open .arrow { transform: translateY(-50%) rotate(180deg); }

    .multi-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid #0073d1;
        border-top: none;
        border-radius: 0 0 8px 8px;
        max-height: 350px;
        overflow-y: auto;
        z-index: 9999;
        display: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .multi-select-dropdown.show { display: block; }

    /* Search inside dropdown */
    .dropdown-search {
        padding: 8px 12px;
        border-bottom: 1px solid #f0f0f0;
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 1;
    }

    .dropdown-search input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 13px;
        outline: none;
    }

    .dropdown-search input:focus { border-color: #0073d1; }

    /* Group Label */
    .dropdown-group-label {
        padding: 8px 14px 4px;
        font-size: 11px;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f9fafb;
        border-bottom: 1px solid #f0f0f0;
        position: sticky;
    }

    /* Option */
    .dropdown-option {
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: background 0.15s;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f8f8f8;
    }

    .dropdown-option:hover { background: #f0f7ff; }

    .dropdown-option.selected {
        background: #eef5ff;
        color: #0073d1;
        font-weight: 600;
    }

    .dropdown-option.disabled-option {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }

    .dropdown-option .opt-check {
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
        background: #fff;
    }

    .dropdown-option.selected .opt-check {
        background: #0073d1;
        border-color: #0073d1;
    }

    .dropdown-option.selected .opt-check::after {
        content: '✓';
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        line-height: 1;
    }

    .dropdown-option:last-child { border-bottom: none; }

    .no-results {
        padding: 16px;
        text-align: center;
        color: #999;
        font-size: 13px;
    }

    /* Continue Button */
    .continue-btn {
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 15px;
    }

    .continue-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
    }

    .continue-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Back Link */
    .back-link { text-align: center; }
    .back-link a {
        color: #0073d1;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }
    .back-link a:hover { text-decoration: underline; }

    /* Responsive */
    @media (max-width: 576px) {
        .institution-wrapper { padding: 20px 15px; }
        .institution-container { border-radius: 12px; }
        .institution-header { padding: 20px; }
        .institution-header h2 { font-size: 20px; }
        .institution-body { padding: 24px 20px; }
        .step-indicator { gap: 6px; }
        .step { font-size: 10px; gap: 3px; }
        .step-number { width: 20px; height: 20px; font-size: 9px; }
    }

    @media (max-width: 360px) {
        .step span:last-child { display: none; }
    }

    /* Custom file input - show filename + " selected" */
    .resume-file-wrap {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        background: #fff;
        min-height: 46px;
        position: relative;
    }
    .resume-file-wrap input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }
    .resume-file-wrap .resume-file-label {
        color: #6b7280;
        margin-right: 8px;
        flex-shrink: 0;
    }
    .resume-file-wrap .resume-file-name {
        color: #374151;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .resume-file-wrap .resume-file-name.has-file {
        color: #0073d1;
        font-weight: 500;
    }

    .dropdown-type-title {
        padding: 10px 12px;
        background: #e8f4fc;
        font-weight: 700;
        font-size: 13px;
        color: #0c4a6e;
        border-bottom: 1px solid #bae6fd;
    }
</style>

@php
    $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
    $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
    $institutionTypeGroups = file_exists($pluginGroupsPath)
        ? include $pluginGroupsPath
        : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
    $institutionTypeNamesFlat = [];
    foreach ($institutionTypeGroups as $g) {
        $institutionTypeNamesFlat = array_merge($institutionTypeNamesFlat, $g['options']);
    }
    $institutionTypeNamesFlat['icse-school'] = $institutionTypeNamesFlat['cicse-school'] ?? 'CICSE School';
    $institutionTypeNamesFlat['pre-primary-school'] = 'Pre School';
@endphp

<div class="institution-wrapper">
    <div class="institution-container">
        <div class="institution-header">
            <h2>School/Institution</h2>
            <p>Step 3 of 4 - Select your preferred institution types</p>
        </div>
        
        <div class="institution-body">
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
                    <span>Add Preferences & Resume</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span>Location </span>
                </div>
            </div>

            <!-- Selection Info -->
            <div class="selection-info">
                <p>Select up to <span class="count">3</span> institution types (<span id="selected-count">0</span>/3 selected)</p>
            </div>

            <!-- Selected Tags -->
            <div class="selected-tags" id="selected-tags">
                <span class="no-selection"></span>
            </div>
            <form id="institution-type-form" onsubmit="return false;">
                @csrf
                <input type="hidden" name="email" id="institution_email" value="" />

                <!-- Multi-Select Dropdown -->
                <div class="multi-select-wrapper" id="multi-select-wrapper">
                    <label class="dropdown-label">Institution Type <span style="color:#dc3545;">*</span></label>
                    <span class="no-selection">(Are you looking job in which type of school/institution)</span>
                    <div class="multi-select-trigger" id="multi-select-trigger">
                        <span class="trigger-text" id="trigger-text">Select institution types...</span>
                        <span class="arrow">▼</span>
                    </div>
                    <div class="multi-select-dropdown" id="multi-select-dropdown">
                        <!-- Search -->
                        <div class="dropdown-search">
                            <input type="text" id="dropdown-search-input" placeholder="Search institution type..." autocomplete="off">
                        </div>

                        <div class="dropdown-type-title">{{ __('Type of Institutions') }}</div>
                        @foreach($institutionTypeGroups as $groupKey => $group)
                            <div class="dropdown-group-label" data-group="{{ $groupKey }}">{{ $group['label'] }}</div>
                            @foreach($group['options'] as $val => $text)
                                <div class="dropdown-option" data-value="{{ $val }}" data-group="{{ $groupKey }}"><span class="opt-check"></span> {{ $text }}</div>
                            @endforeach
                        @endforeach

                        <div class="no-results" style="display:none;" id="no-results">No results found</div>
                    </div>
                </div>

                <!-- Upload Resume -->
                <div class="form-group" style="margin-bottom: 16px; margin-top: 10px;">
                    <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 6px; font-size: 14px;">Upload Resume <span style="color: #dc3545;">*</span></label>
                    <div class="resume-file-wrap" id="resume-file-wrap">
                        <span class="resume-file-label">Choose file</span>
                        <span class="resume-file-name" id="resume-file-name">No file chosen</span>
                        <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                    </div>
                    <div id="resume-error" style="font-size: 12px; color: #dc3545; margin-top: 5px; display: none;"></div>
                    <div style="font-size: 11px; color: #888; margin-top: 4px;">Only PDF and Word files accepted. Max size: 2 MB</div>
                </div>

                <!-- Continue Button -->
                <button type="button" class="continue-btn" id="continue-btn" disabled>Continue</button>
                
                <!-- Back Link -->
                <div class="back-link">
                    <a href="{{ route('public.account.register.verifyEmailPage') }}">← Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    var MAX = 3;
    var selected = [];

    var names = @json($institutionTypeNamesFlat);

    var trigger = document.getElementById('multi-select-trigger');
    var dropdown = document.getElementById('multi-select-dropdown');
    var searchInput = document.getElementById('dropdown-search-input');
    var triggerText = document.getElementById('trigger-text');

    function updateUI() {
        // Count
        var countEl = document.getElementById('selected-count');
        if (countEl) countEl.textContent = selected.length;

        // Tags — show selected items as blue pills with remove button
        var tagsEl = document.getElementById('selected-tags');
        if (tagsEl) {
            tagsEl.innerHTML = '';
            if (selected.length === 0) {
                tagsEl.innerHTML = '<span class="no-selection">No institution selected yet</span>';
            } else {
                selected.forEach(function(val) {
                    var tag = document.createElement('span');
                    tag.className = 'selected-tag';
                    tag.innerHTML = (names[val] || val) + ' <span class="remove-tag" data-value="' + val + '">✕</span>';
                    tagsEl.appendChild(tag);
                });
            }
        }

        // Trigger text — show selected names
        if (triggerText) {
            if (selected.length === 0) {
                triggerText.textContent = 'Select institution types...';
                triggerText.classList.remove('has-selection');
            } else {
                var selectedNames = selected.map(function(val) { return names[val] || val; });
                if (selected.length === MAX) {
                    triggerText.textContent = selectedNames.join(', ') + ' (max reached)';
                } else {
                    triggerText.textContent = selectedNames.join(', ');
                }
                triggerText.classList.add('has-selection');
            }
        }

        // Options state — toggle checked/unchecked look
        document.querySelectorAll('.dropdown-option').forEach(function(opt) {
            var val = opt.getAttribute('data-value');
            if (selected.indexOf(val) !== -1) {
                opt.classList.add('selected');
                opt.classList.remove('disabled-option');
            } else if (selected.length >= MAX) {
                opt.classList.remove('selected');
                opt.classList.add('disabled-option');
            } else {
                opt.classList.remove('selected');
                opt.classList.remove('disabled-option');
            }
        });

        // Button
        var btn = document.getElementById('continue-btn');
        if (btn) btn.disabled = selected.length === 0;
    }

    function toggleDropdown() {
        var isOpen = dropdown.classList.contains('show');
        if (isOpen) {
            dropdown.classList.remove('show');
            trigger.classList.remove('open');
        } else {
            dropdown.classList.add('show');
            trigger.classList.add('open');
            searchInput.value = '';
            filterOptions('');
            setTimeout(function(){ searchInput.focus(); }, 100);
        }
    }

    function filterOptions(query) {
        query = query.toLowerCase().trim();
        var options = document.querySelectorAll('.dropdown-option');
        var groupLabels = document.querySelectorAll('.dropdown-group-label');
        var groupHasVisible = {};
        var anyVisible = false;

        options.forEach(function(opt) {
            var text = opt.textContent.toLowerCase();
            var group = opt.getAttribute('data-group');
            if (!query || text.indexOf(query) !== -1) {
                opt.style.display = '';
                groupHasVisible[group] = true;
                anyVisible = true;
            } else {
                opt.style.display = 'none';
            }
        });

        groupLabels.forEach(function(label) {
            var group = label.getAttribute('data-group');
            label.style.display = groupHasVisible[group] ? '' : 'none';
        });

        document.getElementById('no-results').style.display = anyVisible ? 'none' : 'block';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Load email
        fetch('{{ route("public.account.register.getVerificationData") }}', {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.data && data.data.email) {
                document.getElementById('institution_email').value = data.data.email;
            }
        });

        // Toggle dropdown
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown();
        });

        // Search
        searchInput.addEventListener('input', function() {
            filterOptions(this.value);
        });

        searchInput.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Option click
        document.querySelectorAll('.dropdown-option').forEach(function(opt) {
            opt.addEventListener('click', function(e) {
                e.stopPropagation();
                var val = this.getAttribute('data-value');

                if (selected.indexOf(val) !== -1) {
                    // Deselect
                    selected = selected.filter(function(v) { return v !== val; });
                } else if (selected.length < MAX) {
                    // Select
                    selected.push(val);
                }
                updateUI();
            });
        });

        // Remove tag
        document.getElementById('selected-tags').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-tag')) {
                var val = e.target.getAttribute('data-value');
                selected = selected.filter(function(v) { return v !== val; });
                updateUI();
            }
        });

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            if (!document.getElementById('multi-select-wrapper').contains(e.target)) {
                dropdown.classList.remove('show');
                trigger.classList.remove('open');
            }
        });

        // Show filename + " selected" and clear resume error when file is selected
        document.getElementById('resume').addEventListener('change', function() {
            var resumeError = document.getElementById('resume-error');
            var nameEl = document.getElementById('resume-file-name');
            var wrap = document.getElementById('resume-file-wrap');
            resumeError.style.display = 'none';
            resumeError.textContent = '';
            wrap.style.borderColor = '#e2e8f0';
            if (this.files && this.files.length) {
                nameEl.textContent = this.files[0].name + ' selected';
                nameEl.classList.add('has-file');
            } else {
                nameEl.textContent = 'No file chosen';
                nameEl.classList.remove('has-file');
            }
        });

        // Continue
        document.getElementById('continue-btn').addEventListener('click', function() {
            if (selected.length === 0) {
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('error', 'Please select at least 1 institution type', 'Validation Error');
                } else {
                    alert('Please select at least 1 institution type');
                }
                return;
            }

            // Validate resume
            // Resume validation — inline error below input
            var resumeInput = document.getElementById('resume');
            var resumeWrap = document.getElementById('resume-file-wrap');
            var resumeError = document.getElementById('resume-error');
            resumeError.style.display = 'none';
            resumeError.textContent = '';
            resumeWrap.style.borderColor = '#e2e8f0';

            if (!resumeInput || !resumeInput.files.length) {
                resumeError.textContent = 'Please upload your resume.';
                resumeError.style.display = 'block';
                resumeWrap.style.borderColor = '#dc3545';
                resumeWrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            var resumeFile = resumeInput.files[0];
            var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            var fileName = resumeFile.name.toLowerCase();
            if (allowedTypes.indexOf(resumeFile.type) === -1 && !fileName.endsWith('.pdf') && !fileName.endsWith('.doc') && !fileName.endsWith('.docx')) {
                resumeError.textContent = 'Invalid file type. Only PDF and Word (.doc, .docx) files are allowed.';
                resumeError.style.display = 'block';
                resumeWrap.style.borderColor = '#dc3545';
                resumeWrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            var maxSize = 2 * 1024 * 1024; // 2MB
            if (resumeFile.size > maxSize) {
                resumeError.textContent = 'File size is too large. Maximum allowed size is 2 MB.';
                resumeError.style.display = 'block';
                resumeWrap.style.borderColor = '#dc3545';
                resumeWrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            var btn = this;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;

            var email = document.getElementById('institution_email').value;
            var csrfToken = document.querySelector('input[name="_token"]').value;

            // Use FormData for file upload
            var formData = new FormData();
            formData.append('email', email);
            formData.append('institution_type', selected[0]);
            formData.append('resume', resumeFile);
            selected.forEach(function(val) {
                formData.append('institution_types[]', val);
            });

            fetch('{{ route("public.account.register.saveInstitutionType") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.error === false) {
                    localStorage.setItem('selected_institution_types', JSON.stringify(selected));
                    window.location.href = '{{ route("public.account.register.locationPage") }}';
                } else {
                    if (typeof window.showDialogAlert === 'function') {
                        window.showDialogAlert('error', data.message || 'Failed to save', 'Error');
                    } else {
                        alert(data.message || 'Failed to save');
                    }
                    btn.innerHTML = 'Continue';
                    btn.disabled = false;
                }
            })
            .catch(function() {
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('error', 'Failed to save. Please try again.', 'Error');
                } else {
                    alert('Failed to save. Please try again.');
                }
                btn.innerHTML = 'Continue';
                btn.disabled = false;
            });
        });

        updateUI();
    });
})();
</script>
