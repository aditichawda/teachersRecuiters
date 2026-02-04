@php
    Theme::layout('without-navbar');
@endphp

<!-- CRITICAL: Define handleNextStepClick IMMEDIATELY in body so it's available when button renders -->
<script>
    // Auto-select employer if account_type=employer is in URL
    (function() {
        const urlParams = new URLSearchParams(window.location.search);
        const accountType = urlParams.get('account_type');
        
        if (accountType === 'employer') {
            // Wait for DOM to be ready
            function autoSelectEmployer() {
                const employerRadio = document.querySelector('input[name="account_type"][value="employer"]');
                const jobSeekerRadio = document.querySelector('input[name="account_type"][value="job-seeker"]');
                
                if (employerRadio && !employerRadio.checked) {
                    employerRadio.checked = true;
                    if (jobSeekerRadio) {
                        jobSeekerRadio.checked = false;
                    }
                    
                    // Trigger change event to update UI
                    if (employerRadio) {
                        employerRadio.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    
                    // Update card visual state
                    const employerCard = employerRadio.closest('.account-type-card');
                    const jobSeekerCard = jobSeekerRadio?.closest('.account-type-card');
                    
                    if (employerCard) {
                        employerCard.classList.add('selected');
                        employerCard.closest('.account-type-option')?.classList.add('selected');
                    }
                    if (jobSeekerCard) {
                        jobSeekerCard.classList.remove('selected');
                        jobSeekerCard.closest('.account-type-option')?.classList.remove('selected');
                    }
                    
                    console.log('✅ Employer auto-selected from URL parameter');
                }
            }
            
            // Run immediately and after DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    autoSelectEmployer();
                    setTimeout(autoSelectEmployer, 100);
                    setTimeout(autoSelectEmployer, 500);
                });
            } else {
                autoSelectEmployer();
                setTimeout(autoSelectEmployer, 100);
                setTimeout(autoSelectEmployer, 500);
            }
        }
    })();

    // IMMEDIATE: Hide resume field if employer is selected
    (function() {
        function hideResumeForEmployer() {
            const accountTypeRadio = document.querySelector('input[name="account_type"][value="employer"]');
            const isEmployer = accountTypeRadio && accountTypeRadio.checked;
            
            console.log('=== CHECKING RESUME FIELD ===');
            console.log('Is employer selected?', isEmployer);
            
            // Find all labels and check for "Upload Resume"
            const allLabels = document.querySelectorAll('label');
            console.log('Total labels found:', allLabels.length);
            
            allLabels.forEach((label, index) => {
                const labelText = label.textContent || label.innerText || '';
                const lowerText = labelText.toLowerCase();
                
                // Check if this label is for resume
                if (lowerText.includes('upload resume') || 
                    (lowerText.includes('resume') && lowerText.includes('pdf'))) {
                    console.log('Found resume label:', labelText, 'at index:', index);
                    
                    // Find the container - try multiple methods
                    let container = label.closest('.col-md-6');
                    if (!container) {
                        // Try to find the parent that contains both label and input
                        container = label.parentElement;
                        while (container && !container.querySelector('input[type="file"]')) {
                            container = container.parentElement;
                        }
                    }
                    if (!container) container = label.closest('.form-group');
                    if (!container) container = label.closest('.mb-3');
                    if (!container) container = label.parentElement;
                    
                    if (container) {
                        console.log('Container found, hiding for employer:', isEmployer);
                        
                        if (isEmployer) {
                            // Hide everything
                            container.style.cssText = 'display: none !important;';
                            container.setAttribute('style', 'display: none !important;');
                            
                            // Also hide the input
                            const fileInput = container.querySelector('input[type="file"]');
                            if (fileInput) {
                                fileInput.removeAttribute('required');
                                fileInput.style.cssText = 'display: none !important;';
                            }
                            
                            console.log('✅ Resume field container hidden');
                        } else {
                            // Show for job-seeker
                            container.style.cssText = '';
                            container.removeAttribute('style');
                            const fileInput = container.querySelector('input[type="file"]');
                            if (fileInput) {
                                fileInput.setAttribute('required', 'required');
                                fileInput.style.cssText = '';
                            }
                            console.log('✅ Resume field container shown');
                        }
                    } else {
                        console.warn('Container not found for resume label');
                    }
                }
            });
            
            // Also try finding by input name
            const resumeInput = document.querySelector('input[name="resume"]');
            if (resumeInput) {
                console.log('Found resume input by name');
                let container = resumeInput.closest('.col-md-6');
                if (!container) container = resumeInput.closest('.form-group');
                if (!container) container = resumeInput.closest('.mb-3');
                if (!container) container = resumeInput.parentElement;
                
                if (container) {
                    if (isEmployer) {
                        container.style.cssText = 'display: none !important;';
                        resumeInput.removeAttribute('required');
                        console.log('✅ Resume input hidden');
                    } else {
                        container.style.cssText = '';
                        resumeInput.setAttribute('required', 'required');
                        console.log('✅ Resume input shown');
                    }
                }
            }
        }
        
        // Run immediately
        hideResumeForEmployer();
        
        // Run after DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                hideResumeForEmployer();
                setTimeout(hideResumeForEmployer, 100);
                setTimeout(hideResumeForEmployer, 500);
            });
        } else {
            hideResumeForEmployer();
            setTimeout(hideResumeForEmployer, 100);
            setTimeout(hideResumeForEmployer, 500);
        }
        
        // Watch for account type changes
        document.addEventListener('change', function(e) {
            if (e.target && e.target.name === 'account_type') {
                console.log('Account type changed, hiding/showing resume');
                setTimeout(hideResumeForEmployer, 50);
                setTimeout(hideResumeForEmployer, 200);
            }
        });
        
        // Run after longer delays for dynamic content
        setTimeout(hideResumeForEmployer, 1000);
        setTimeout(hideResumeForEmployer, 2000);
    })();

    (function() {
        'use strict';

        // Initialize global variables IMMEDIATELY
        if (typeof window.registrationCurrentStep === 'undefined') {
            window.registrationCurrentStep = 1;
        }
        if (typeof window.registrationTotalSteps === 'undefined') {
            window.registrationTotalSteps = 3;
        }
        if (typeof window.registrationEmailVerified === 'undefined') {
            window.registrationEmailVerified = false;
        }

        // Load from sessionStorage if available
        if (typeof Storage !== 'undefined') {
            const savedStep = sessionStorage.getItem('regStep');
            if (savedStep) {
                const stepNum = parseInt(savedStep);
                if (stepNum >= 1 && stepNum <= 3) {
                    window.registrationCurrentStep = stepNum;
                }
            }
        }

        // Helper function to get field-specific error message
        const getFieldErrorMessage = function(field) {
            const fieldName = field.name || field.getAttribute('name') || '';
            const fieldId = field.id || field.getAttribute('id') || '';
            const fieldType = field.type || field.getAttribute('type') || '';
            const label = field.closest('.form-group')?.querySelector('label')?.textContent?.trim() ||
                field.closest('.mb-3')?.querySelector('label')?.textContent?.trim() ||
                field.closest('.form-item')?.querySelector('label')?.textContent?.trim() || '';

            // Field-specific messages based on name/ID
            const messages = {
                'full_name': 'The full name field is required.',
                'first_name': 'The first name field is required.',
                'last_name': 'The last name field is required.',
                'email': 'The email field is required.',
                'phone': 'The mobile number field is required.',
                'password': 'The password field is required.',
                'password_confirmation': 'The password confirmation field is required.',
                'resume': 'The upload resume field is required.',
                'institution_type': 'The institution type field is required.',
                'location_type': 'The location type field is required.',
            };

            // Try to get message by field name
            if (fieldName && messages[fieldName]) {
                return messages[fieldName];
            }

            // Try to get message by field ID
            if (fieldId && messages[fieldId]) {
                return messages[fieldId];
            }

            // Try to get message from label
            if (label) {
                return 'The ' + label.toLowerCase() + ' field is required.';
            }

            // Default message
            return 'This field is required.';
        };

        // Define handleNextStepClick function - MUST be on window object
        window.handleNextStepClick = function(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
            console.log('=== NEXT STEP BUTTON CLICKED (Global Handler) ===');

            // Get account type
            const getAccountType = function() {
                if (typeof jQuery !== 'undefined' && jQuery('input[name="account_type"]:checked').length) {
                    return jQuery('input[name="account_type"]:checked').val() || 'job-seeker';
                }
                const radio = document.querySelector('input[name="account_type"]:checked');
                return radio ? radio.value : 'job-seeker';
            };

            // Validate all required fields
            const validateAllRequiredFields = function() {
                let isValid = true;
                const currentStep = window.registrationCurrentStep || 1;

                // Clear previous errors
                if (typeof jQuery !== 'undefined') {
                    jQuery('.is-invalid').removeClass('is-invalid');
                    jQuery('.invalid-feedback').remove();
                } else {
                    document.querySelectorAll('.is-invalid').forEach(function(el) {
                        el.classList.remove('is-invalid');
                    });
                    document.querySelectorAll('.invalid-feedback').forEach(function(el) {
                        el.remove();
                    });
                }

                // Get account type for validation
                const accountType = getAccountType();
                
                // Find current step content
                let stepContent;
                if (typeof jQuery !== 'undefined') {
                    stepContent = jQuery('.step-content[data-step="' + currentStep + '"]');
                } else {
                    stepContent = document.querySelector('.step-content[data-step="' + currentStep + '"]');
                }
                
                // Skip resume validation for employer
                if (accountType === 'employer' && typeof jQuery !== 'undefined') {
                    jQuery('input[name="resume"]').removeAttr('required');
                    jQuery('input[name="resume"]').closest('.form-group, .mb-3').find('.invalid-feedback').remove();
                    jQuery('input[name="resume"]').removeClass('is-invalid');
                }

                if (!stepContent || (typeof jQuery !== 'undefined' && stepContent.length === 0)) {
                    console.log('Step content not found, trying alternative selector');
                    // Try alternative: find all step-content and use first visible one
                    if (typeof jQuery !== 'undefined') {
                        stepContent = jQuery('.step-content').first();
                    } else {
                        stepContent = document.querySelector('.step-content');
                    }
                }

                if (!stepContent || (typeof jQuery !== 'undefined' && stepContent.length === 0)) {
                    console.log('No step content found at all');
                    return true; // Skip validation if no step content
                }

                // Get all required fields
                let requiredFields;
                if (typeof jQuery !== 'undefined') {
                    requiredFields = stepContent.find(
                        'input[required], select[required], textarea[required], input[type="file"][required]'
                    );
                } else {
                    requiredFields = stepContent.querySelectorAll(
                        'input[required], select[required], textarea[required], input[type="file"][required]'
                    );
                }

                if (typeof jQuery !== 'undefined') {
                    requiredFields.each(function() {
                        const $field = jQuery(this);
                        const fieldName = $field.attr('name');
                        const fieldType = $field.attr('type');
                        let value = $field.val();
                        const fieldElement = $field[0];
                        
                        // Skip resume validation for employer
                        if (fieldName === 'resume' && accountType === 'employer') {
                            console.log('Skipping resume validation for employer');
                            return; // Skip this field
                        }

                        if (fieldType === 'file') {
                            const files = $field[0].files;
                            if (!files || files.length === 0) {
                                isValid = false;
                                $field.addClass('is-invalid');
                                $field.next('.invalid-feedback').remove();
                                const errorMsg = getFieldErrorMessage(fieldElement);
                                $field.after(
                                    '<div class="invalid-feedback d-block" style="display: block !important;">' +
                                    errorMsg + '</div>');
                            }
                        } else if (!value || (typeof value === 'string' && value.trim() === '')) {
                            isValid = false;
                            $field.addClass('is-invalid');
                            $field.next('.invalid-feedback').remove();
                            const errorMsg = getFieldErrorMessage(fieldElement);
                            $field.after(
                                '<div class="invalid-feedback d-block" style="display: block !important;">' +
                                errorMsg + '</div>');
                        }
                    });
                } else {
                    requiredFields.forEach(function(field) {
                        const fieldName = field.name;
                        const fieldType = field.type;
                        let value = field.value;
                        
                        // Skip resume validation for employer
                        if (fieldName === 'resume' && accountType === 'employer') {
                            console.log('Skipping resume validation for employer');
                            return; // Skip this field
                        }

                        if (fieldType === 'file') {
                            const files = field.files;
                            if (!files || files.length === 0) {
                                isValid = false;
                                field.classList.add('is-invalid');
                                let errorDiv = field.nextElementSibling;
                                if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                                    errorDiv = document.createElement('div');
                                    errorDiv.className = 'invalid-feedback d-block';
                                    errorDiv.style.display = 'block !important';
                                    errorDiv.textContent = getFieldErrorMessage(field);
                                    field.parentNode.insertBefore(errorDiv, field.nextSibling);
                                }
                            }
                        } else if (!value || value.trim() === '') {
                            isValid = false;
                            field.classList.add('is-invalid');
                            let errorDiv = field.nextElementSibling;
                            if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'invalid-feedback d-block';
                                errorDiv.style.display = 'block !important';
                                errorDiv.textContent = getFieldErrorMessage(field);
                                field.parentNode.insertBefore(errorDiv, field.nextSibling);
                            }
                        }
                    });
                }

                return isValid;
            };

            const accountType = getAccountType();
            const currentStep = window.registrationCurrentStep || 1;

            console.log('Account type:', accountType, 'Step:', currentStep);

            // FIRST: Validate all required fields
            const isValid = validateAllRequiredFields();
            console.log('All required fields validation result:', isValid);

            if (!isValid) {
                console.log('Validation failed, showing errors');
                // Scroll to first error
                if (typeof jQuery !== 'undefined') {
                    const $firstError = jQuery('.is-invalid').first();
                    if ($firstError.length && $firstError.offset()) {
                        jQuery('html, body').animate({
                            scrollTop: $firstError.offset().top - 100
                        }, 300);
                    }
                } else {
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
                return false;
            }

            // Step 1: For both Job Seeker and Employer - redirect to OTP page after email verification
            if (currentStep === 1 && (accountType === 'job-seeker' || accountType === 'employer')) {
                const email = typeof jQuery !== 'undefined' ? jQuery('input[name="email"]').val() : (document
                    .querySelector('input[name="email"]')?.value || '');

                if (!email || email.trim() === '') {
                    console.log('Email empty, showing error');
                    if (typeof jQuery !== 'undefined') {
                        const $emailField = jQuery('input[name="email"]');
                        $emailField.addClass('is-invalid');
                        $emailField.next('.invalid-feedback').remove();
                        $emailField.after(
                            '<div class="invalid-feedback d-block" style="display: block !important;">This field is required.</div>'
                        );
                    } else {
                        const emailInput = document.querySelector('input[name="email"]');
                        if (emailInput) {
                            emailInput.classList.add('is-invalid');
                            let errorDiv = emailInput.nextElementSibling;
                            if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'invalid-feedback d-block';
                                errorDiv.style.display = 'block !important';
                                errorDiv.textContent = 'This field is required.';
                                emailInput.parentNode.insertBefore(errorDiv, emailInput.nextSibling);
                            }
                        }
                    }
                    return false;
                }

                // CRITICAL: Force save ALL form data to localStorage before redirecting
                console.log('=== SAVING FORM DATA BEFORE OTP REDIRECT ===');

                // Declare formData at function scope level so it's accessible in AJAX success callback
                let formData = {};

                if (typeof Storage !== 'undefined') {
                    // Call the saveFormData function if it exists
                    if (typeof saveFormData === 'function') {
                        saveFormData();
                        console.log('Called saveFormData() function');
                    }

                    // Also do manual save as backup
                    formData = {};
                    if (typeof jQuery !== 'undefined') {
                        jQuery('input, select, textarea').each(function() {
                            const $field = jQuery(this);
                            const fieldName = $field.attr('name');
                            const fieldType = $field.attr('type') || '';
                            const fieldId = $field.attr('id') || '';

                            if (!fieldName || fieldType === 'hidden' || fieldName === '_token') {
                                return;
                            }

                            // Check if this is a phone field
                            const isPhoneField = (fieldName === 'phone' || fieldName === 'mobile' ||
                                fieldName === 'phone_country_code' ||
                                fieldId === 'phone' || fieldId === 'mobile' || fieldType === 'tel');

                            // Handle file inputs - store filename
                            if (fieldType === 'file') {
                                const files = $field[0].files;
                                if (files && files.length > 0) {
                                    formData[fieldName + '_filename'] = files[0].name;
                                    formData[fieldName + '_size'] = files[0].size;
                                    formData[fieldName + '_type'] = files[0].type;
                                    console.log('Saved file:', fieldName, files[0].name);
                                }
                            } else if (fieldType === 'checkbox' || fieldType === 'radio') {
                                if ($field.is(':checked')) {
                                    formData[fieldName] = $field.val();
                                    console.log('Saved checkbox/radio:', fieldName, $field.val());
                                }
                            } else {
                                const value = $field.val();

                                // Special handling for phone field - save even if it has spaces or formatting
                                if (isPhoneField) {
                                    if (value !== null && value !== undefined) {
                                        formData[fieldName] = value;
                                        console.log('Saved phone field (manual):', fieldName, value);
                                    }
                                } else {
                                    // For other fields, only save if not empty
                                    if (value !== null && value !== undefined && value !== '') {
                                        formData[fieldName] = value;
                                        console.log('Saved field:', fieldName, value);
                                    }
                                }
                            }
                        });
                    }

                    localStorage.setItem('registrationFormData', JSON.stringify(formData));
                    console.log('=== FORM DATA SAVED TO LOCALSTORAGE ===', formData);
                } else {
                    console.error('localStorage not available!');
                }

                console.log('All validations passed, sending verification code via email');

                // Send verification code via email before redirecting
                const sendCodeUrl = '{{ route('public.account.register.sendVerificationCode') }}';
                const csrfToken = $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}';

                console.log('Sending verification code to:', email);
                console.log('Send code URL:', sendCodeUrl);

                $.ajax({
                    url: sendCodeUrl,
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        email: email,
                        form_data: formData, // Send form data to server
                    },
                    success: function(response) {
                        console.log('✅ VERIFICATION CODE SENT SUCCESSFULLY:', response);
                        
                        // Check if response has error
                        if (response.error === true) {
                            console.error('❌ Error from server:', response.message);
                            
                            // If email is already registered, check if verified before redirecting
                            if (response.next_url && response.message && response.message.includes('login')) {
                                // Only redirect if explicitly told to login (verified email)
                                const loginUrl = response.next_url;
                                console.log('Email is verified - redirecting to login:', loginUrl);
                                window.location.href = loginUrl;
                                return;
                            } else if (response.message && (response.message.includes('already registered') || 
                                response.message.includes('already been taken') || 
                                response.message.includes('not verified'))) {
                                // Email exists but not verified - show error message above Next button and redirect to OTP
                                console.log('Email exists but not verified - showing error and redirecting to OTP');
                                
                                // Show error message above Next button
                                const $errorDiv = $('#email-exists-error');
                                const $errorText = $('#email-exists-error-text');
                                if ($errorDiv.length) {
                                    $errorText.text(response.message || 'Email exists but not verified. Please verify your email first.');
                                    $errorDiv.show();
                                    
                                    // Scroll to error message
                                    $('html, body').animate({
                                        scrollTop: $errorDiv.offset().top - 100
                                    }, 300);
                                }
                                
                                // Redirect to OTP page after a short delay
                                setTimeout(function() {
                                    const verifyUrl = '{{ route('public.account.register.verifyEmailPage') }}';
                                    window.location.href = verifyUrl;
                                }, 1500);
                                return;
                            }
                            
                            // For other errors, show alert
                            alert(response.message || 'An error occurred. Please try again.');
                            return;
                        }
                        
                        // Don't show alert, just continue with OTP flow
                        console.log('Verification code sent to your email: ' + email);

                        // Store email in session for verify-email page
                        $.ajax({
                            url: '{{ route('public.account.register.storeEmailSession') }}',
                            type: 'POST',
                            data: {
                                _token: csrfToken,
                                email: email,
                            },
                            success: function() {
                                console.log('Email stored in session');
                            },
                            error: function() {
                                console.warn(
                                    'Failed to store email in session, but continuing...'
                                );
                            }
                        });

                        // Now save form data and redirect
                        if (typeof Storage !== 'undefined') {
                            localStorage.setItem('registrationFormData', JSON.stringify(formData));
                            console.log('=== FORM DATA SAVED TO LOCALSTORAGE ===', formData);
                        } else {
                            console.error('localStorage not available!');
                        }

                        console.log('Redirecting to verify-email page');
                        // Email is already stored in session by sendVerificationCode API
                        // Redirect to clean URL without email parameter
                        const verifyUrl = '{{ route('public.account.register.verifyEmailPage') }}';
                        window.location.href = verifyUrl;
                    },
                    error: function(xhr) {
                        console.error('❌ FAILED TO SEND VERIFICATION CODE:', xhr);
                        console.error('Status:', xhr.status);
                        console.error('Response:', xhr.responseText);

                        let errorMessage = 'Failed to send verification code. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                            
                            // If email is already registered, show login link
                            if (errorMessage.includes('already registered') || errorMessage.includes('already been taken')) {
                                const loginUrl = '{{ route('public.account.login') }}';
                                const loginMessage = errorMessage + '\n\nClick OK to go to login page.';
                                if (confirm(loginMessage)) {
                                    window.location.href = loginUrl;
                                } else {
                                    alert(errorMessage);
                                }
                            } else {
                                alert('Failed to send verification code: ' + errorMessage);
                            }
                        } else {
                            alert(errorMessage);
                        }

                        // Still save data and redirect even if email fails
                        if (typeof Storage !== 'undefined') {
                            localStorage.setItem('registrationFormData', JSON.stringify(formData));
                            console.log(
                                '=== FORM DATA SAVED TO LOCALSTORAGE (despite email failure) ===',
                                formData);
                        }

                        // Email is already stored in session by sendVerificationCode API
                        // Redirect to clean URL without email parameter
                        const verifyUrl = '{{ route('public.account.register.verifyEmailPage') }}';
                        window.location.href = verifyUrl;
                    }
                });

                return false;
            }

            // Other cases: use goToNextStep if available
            if (typeof window.goToNextStep === 'function') {
                console.log('Calling goToNextStep');
                window.goToNextStep();
            } else {
                console.error('goToNextStep not available');
            }
            return false;
        };

        console.log('handleNextStepClick function defined in body');
    })();

    // Vanilla JS fallback for real-time error removal (works even if jQuery not loaded)
    (function() {
        'use strict';

        function removeFieldErrorVanilla(field) {
            const fieldType = field.type || '';
            const tagName = field.tagName ? field.tagName.toLowerCase() : '';
            const value = field.value;
            let shouldRemove = false;

            // Check if THIS SPECIFIC field is valid based on type
            if (fieldType === 'file') {
                const files = field.files;
                shouldRemove = files && files.length > 0;
            } else if (fieldType === 'email') {
                shouldRemove = value && value.length > 0;
            } else if (tagName === 'select') {
                shouldRemove = value && value !== '';
            } else {
                shouldRemove = value && value.length > 0;
            }

            if (shouldRemove) {
                // Remove is-invalid class ONLY from this field
                field.classList.remove('is-invalid');

                // Remove error message ONLY for this specific field
                // Check next sibling first
                if (field.nextElementSibling && field.nextElementSibling.classList.contains('invalid-feedback')) {
                    field.nextElementSibling.remove();
                }

                // Check parent - but only remove errors that are directly after this field
                const parent = field.parentElement;
                if (parent) {
                    const children = Array.from(parent.children);
                    const fieldIndex = children.indexOf(field);

                    // Only remove the error that comes right after this field
                    if (fieldIndex >= 0 && fieldIndex < children.length - 1) {
                        const nextSibling = children[fieldIndex + 1];
                        if (nextSibling && nextSibling.classList.contains('invalid-feedback')) {
                            nextSibling.remove();
                        }
                    }
                }
            }
        }

        // Attach event listeners when DOM is ready
        function attachErrorRemovalListeners() {
            // Get all form fields
            const fields = document.querySelectorAll('input, select, textarea');

            fields.forEach(function(field) {
                // Remove existing listeners to avoid duplicates
                field.removeEventListener('input', handleFieldInput);
                field.removeEventListener('keyup', handleFieldInput);
                field.removeEventListener('change', handleFieldChange);

                // Add new listeners
                field.addEventListener('input', handleFieldInput, true);
                field.addEventListener('keyup', handleFieldInput, true);
                field.addEventListener('change', handleFieldChange, true);
            });
        }

        function handleFieldInput(e) {
            const field = e.target;
            // Only remove error for THIS specific field if it has is-invalid class
            if (field.classList.contains('is-invalid')) {
                removeFieldErrorVanilla(field);
            }
        }

        function handleFieldChange(e) {
            const field = e.target;
            // Only remove error for THIS specific field if it has is-invalid class
            if (field.classList.contains('is-invalid')) {
                removeFieldErrorVanilla(field);
            }
        }

        // Attach listeners when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', attachErrorRemovalListeners);
        } else {
            attachErrorRemovalListeners();
        }

        // Also attach after a delay to catch dynamically added fields
        setTimeout(attachErrorRemovalListeners, 500);
        setTimeout(attachErrorRemovalListeners, 1000);
    })();
</script>

<!-- Register Section Start -->
<div class="section-full site-bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                <div class="twm-log-reg-logo-head">
                    @if (Theme::getLogo())
                        <div class="twm-register-left-logo">
                            <a href="{{ BaseHelper::getHomepageUrl() }}" class="twm-register-page-logo-link">
                                {!! Theme::getLogoImage(['class' => 'logo'], 'logo', 100) !!}
                            </a>
                        </div>
                    @endif
                </div>
                <div class="twm-log-reg-media">
                    <div class="twm-l-media">
                        @if (theme_option('sign_up_page_image'))
                            <img src="{{ RvMedia::getImageUrl(theme_option('sign_up_page_image')) }}" alt="background">
                        @else
                            <img src="{{ Theme::asset()->url('images/reg-bg.png') }}" alt="background">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-7">
                <div class="twm-log-reg-form-wrap">
                    <div class="twm-log-reg-logo-head twm-register-page-topbar">
                        <div class="twm-register-page-brand">

                            <div class="twm-log-reg-head">
                                <div class="twm-log-reg-logo">
                                    <span class="log-reg-form-title">{{ SeoHelper::getTitle() }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="twm-log-reg-inner">


                        {{-- Email verification modal (Step 1) --}}
                        <div id="email-verification-modal" class="modal fade" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Verify your email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-2">
                                            We have sent a 6-digit verification code to:
                                            <strong id="verification-email-display"></strong>
                                        </p>
                                        <p class="text-muted mb-3">
                                            Please enter the code below to continue registration.
                                        </p>
                                        <div class="mb-3">
                                            <label for="verification-code-input" class="form-label">Verification
                                                Code</label>
                                            <input type="text" id="verification-code-input" class="form-control"
                                                maxlength="6" autocomplete="one-time-code" />
                                            <div id="verification-code-error" class="invalid-feedback d-block"
                                                style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" id="resend-code-btn">Resend
                                            code</button>
                                        <button type="button" class="btn btn-primary" id="verify-code-btn">Verify &amp;
                                            Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (session()->has('status'))
                            <div role="alert" class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @elseif (session()->has('auth_error_message'))
                            <div role="alert" class="alert alert-danger">
                                {{ session('auth_error_message') }}
                            </div>
                        @elseif (session()->has('auth_success_message'))
                            <div role="alert" class="alert alert-success">
                                {{ session('auth_success_message') }}
                            </div>
                        @elseif (session()->has('auth_warning_message'))
                            <div role="alert" class="alert alert-warning">
                                {{ session('auth_warning_message') }}
                            </div>
                        @endif

                        <!-- Email Error Message (shown above Next Step button) -->
                        <div id="email-exists-error" class="alert alert-warning mb-3" style="display:none;">
                            <i class="ti ti-alert-circle me-2"></i>
                            <span id="email-exists-error-text">Email exists but not verified. Please verify your email first.</span>
                        </div>
                        
                        {!! $form->modify(
                                'submit',
                                'button',
                                [
                                    'label' => __('Next Step'),
                                    'attr' => [
                                        'class' => 'site-button',
                                        'id' => 'register-submit-btn',
                                        'type' => 'button',
                                        'onclick' => 'handleNextStepClick(event); return true;',
                                    ],
                                ],
                                true,
                            )->renderForm() !!}
                        <!-- Multi-step navigation buttons -->
                        <div class="registration-navigation mt-4" style="display:none;">
                            <button type="button" id="prev-step-btn" class="site-button-outline me-3">
                                <i class="ti ti-arrow-left me-1"></i> Previous
                            </button>
                            <button type="button" id="next-step-btn" class="site-button">
                                Next Step <i class="ti ti-arrow-right ms-1"></i>
                            </button>
                        </div>

                        <!-- Final submit button (hidden initially) -->
                        <button type="submit" id="final-submit-btn" class="site-button mt-3"
                            style="display:none;">Registration</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('header')
    <style>
        .registration-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .registration-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 0;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            color: #999;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .step.active .step-number {
            background: #1967d2;
            color: #fff;
        }

        .step.completed .step-number {
            background: #34a853;
            color: #fff;
        }

        .step-label {
            display: block;
            font-size: 12px;
            color: #666;
        }

        .step.active .step-label {
            color: #1967d2;
            font-weight: 600;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .invalid-feedback {
            display: block !important;
            width: 100%;
            margin-top: 0.5rem;
            font-size: 0.875em;
            color: #dc3545;
            padding-left: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        /* Hide resume field for employer */
        .employer-selected input[name="resume"],
        .employer-selected input[type="file"][name="resume"] {
            display: none !important;
        }
        
        .employer-selected input[name="resume"].closest('.col-md-6'),
        .employer-selected input[type="file"][name="resume"].closest('.col-md-6'),
        .employer-selected input[name="resume"].closest('.form-group'),
        .employer-selected input[type="file"][name="resume"].closest('.form-group'),
        .employer-selected input[name="resume"].closest('.mb-3'),
        .employer-selected input[type="file"][name="resume"].closest('.mb-3') {
            display: none !important;
        }
        
        .employer-selected label[for="resume"] {
            display: none !important;
        }

        .form-group .invalid-feedback,
        .mb-3 .invalid-feedback,
        .form-item .invalid-feedback {
            display: block !important;
        }

        .prev-step-btn,
        #prev-step-btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .prev-step-btn:hover,
        #prev-step-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* --- Register page spacing tweaks (match screenshot) --- */
        .twm-log-reg-media {
            padding: 60px 0px !important;
        }

        .twm-log-reg-form-wrap {
            padding: 20px 0px 40px 0px !important;
        }

        .twm-log-reg-form-wrap .twm-log-reg-inner {
            padding: 16px 40px !important;
        }

        .twm-log-reg-head .log-reg-form-title {
            font-size: 28px;
            margin-bottom: 8px;
        }

        /* Account type cards: smaller + tighter */
        .account-type-selection .account-type-option {
            margin-bottom: 8px;
        }

        .account-type-selection .account-type-card {
            min-height: 120px;
            padding: 16px 14px;
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            background: #fff;
        }

        .account-type-selection .account-type-card:hover {
            border-color: #007bff;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
            transform: translateY(-2px);
        }

        .account-type-selection .account-type-card.selected,
        .account-type-selection input[type="radio"]:checked + label .account-type-card {
            border-color: #007bff;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: #fff;
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        }

        .account-type-selection .account-type-card.selected .account-type-content h6,
        .account-type-selection input[type="radio"]:checked + label .account-type-card .account-type-content h6 {
            color: #fff;
        }

        .account-type-selection .account-type-card.selected .account-type-content p,
        .account-type-selection input[type="radio"]:checked + label .account-type-card .account-type-content p {
            color: rgba(255, 255, 255, 0.9);
        }

        .account-type-selection .account-type-icon {
            margin-bottom: 10px;
        }

        .account-type-selection .account-type-icon svg {
            width: 34px;
            height: 34px;
            transition: all 0.3s ease;
        }

        .account-type-selection .account-type-card.selected .account-type-icon svg,
        .account-type-selection input[type="radio"]:checked + label .account-type-card .account-type-icon svg {
            color: #fff;
            transform: scale(1.1);
        }

        /* Reduce extra bottom spacing between form items (let gutter handle spacing) */
        .step-content[data-step="1"] .form-group,
        .step-content[data-step="1"] .mb-3,
        .step-content[data-step="1"] .form-item {
            margin-bottom: 0 !important;
        }

        /* Modern form styling for job seeker */
        .step-content .form-control,
        .step-content .form-select {
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .step-content .form-control:focus,
        .step-content .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
            outline: none;
        }

        .step-content .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .step-content .form-control::placeholder {
            color: #999;
        }

        /* Button styling improvements */
        #next-step-btn,
        #prev-step-btn,
        button[type="submit"] {
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        #next-step-btn:hover,
        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Form container improvements */
        .twm-log-reg-form-wrap .twm-log-reg-inner {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* Step indicator improvements */
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            gap: 10px;
        }

        .step-indicator .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            background: #e0e0e0;
            color: #666;
            transition: all 0.3s ease;
        }

        .step-indicator .step.active {
            background: #007bff;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .step-indicator .step.completed {
            background: #28a745;
            color: #fff;
        }

        @media (max-width: 767px) {
            .twm-log-reg-media {
                padding: 30px 0px !important;
            }

            .twm-log-reg-form-wrap {
                padding: 20px 0px 20px 0px !important;
            }

            .twm-log-reg-form-wrap .twm-log-reg-inner {
                padding: 12px 16px !important;
            }
        }
    </style>
@endpush

@push('footer')
    <script>
        (function($) {
            'use strict';

            // Check if jQuery is available
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded!');
                // Fallback to vanilla JS
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('Using vanilla JS fallback');
                    initRegistrationForm();
                });
                return;
            }

            // Global variables - Define BEFORE jQuery ready
            window.registrationCurrentStep = 1;
            window.registrationTotalSteps = 3;
            window.registrationEmailVerified = false;
            let currentStep = window.registrationCurrentStep;
            const totalSteps = window.registrationTotalSteps;

            // Initialize from sessionStorage if exists
            if (typeof Storage !== 'undefined') {
                const savedStep = sessionStorage.getItem('regStep');
                if (savedStep) {
                    const stepNum = parseInt(savedStep);
                    if (stepNum >= 1 && stepNum <= 3) {
                        currentStep = stepNum;
                        window.registrationCurrentStep = stepNum;
                    }
                }
            }

            // Define global functions BEFORE jQuery ready
            window.goToNextStep = function() {
                console.log('=== window.goToNextStep called ===');
                console.log('Current step:', currentStep);
                console.log('Total steps:', totalSteps);

                const skipValidation = false;

                let isValid = true;
                if (!skipValidation && typeof validateStep === 'function') {
                    isValid = validateStep(currentStep);
                    console.log('Validation result:', isValid);
                } else {
                    console.log('Validation skipped');
                }

                if (!isValid) {
                    console.log('Validation failed');
                    return;
                }

                // CRITICAL: Save form data BEFORE moving to next step
                if (typeof saveFormData === 'function') {
                    saveFormData();
                    console.log('Form data saved before moving to next step');
                }

                // Step 1: Check email existence and require email verification for job seekers before going to step 2
                if (currentStep === 1) {
                    const accountType = $('input[name="account_type"]:checked').val() || 'job-seeker';
                    const $emailField = $('input[name="email"]');
                    const email = $emailField.val();

                    if (!email) {
                        $emailField.addClass('is-invalid');
                        if (!$emailField.next('.invalid-feedback').length) {
                            $emailField.after(
                                '<div class="invalid-feedback d-block" style="display: block !important;">This field is required.</div>'
                            );
                        }
                        if ($emailField.offset()) {
                            $('html, body').animate({
                                scrollTop: $emailField.offset().top - 100
                            }, 300);
                        }
                        return;
                    }

                    // Check if email already exists in database (for both employer and job-seeker)
                    console.log('=== CHECKING EMAIL EXISTENCE ===');
                    console.log('Email:', email);
                    console.log('Account Type:', accountType);
                    
                    const checkEmailUrl = '{{ route('public.account.register.checkEmail') }}';
                    const csrfToken = $('input[name="_token"]').val();
                    
                    // Show loading
                    const $nextBtn = $('#next-step-btn, button[onclick*="handleNextStepClick"]');
                    const originalBtnText = $nextBtn.html();
                    $nextBtn.prop('disabled', true).html('Checking email...');
                    
                    fetch(checkEmailUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ email: email })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Email check response:', data);
                        
                        if (data.data && data.data.exists) {
                            // Check if email is verified (email_verified_at is NOT NULL)
                            const emailVerifiedAt = data.data.email_verified_at;
                            const emailVerifiedAtIsNull = data.data.email_verified_at_is_null;
                            const isVerified = data.data.is_verified;
                            
                            console.log('========================================');
                            console.log('=== EMAIL EXISTS CHECK ===');
                            console.log('========================================');
                            console.log('Email exists:', true);
                            console.log('Email verified at (raw):', emailVerifiedAt);
                            console.log('Email verified at type:', typeof emailVerifiedAt);
                            console.log('Email verified at is NULL (from backend):', emailVerifiedAtIsNull);
                            console.log('Is verified (from backend):', isVerified);
                            console.log('========================================');
                            
                            // Check if email_verified_at is NULL or empty
                            const isEmailVerified = emailVerifiedAt !== null && 
                                                    emailVerifiedAt !== '' && 
                                                    emailVerifiedAt !== undefined &&
                                                    emailVerifiedAtIsNull !== true;
                            
                            console.log('Final check - isEmailVerified:', isEmailVerified);
                            console.log('emailVerifiedAt !== null:', emailVerifiedAt !== null);
                            console.log('emailVerifiedAt !== "":', emailVerifiedAt !== '');
                            console.log('emailVerifiedAtIsNull !== true:', emailVerifiedAtIsNull !== true);
                            console.log('========================================');
                            
                            // Check email_verified_at field from database
                            // If NULL → OTP page, If NOT NULL → Login page
                            if (isEmailVerified) {
                                // Email is VERIFIED (email_verified_at is NOT NULL) - redirect to login immediately
                                console.log('✅✅✅ Email is VERIFIED (email_verified_at is NOT NULL) - redirecting to login page ✅✅✅');
                                const loginUrl = '{{ route('public.account.login') }}';
                                
                                // Redirect immediately - use both methods to ensure redirect
                                window.location.href = loginUrl;
                                window.location.replace(loginUrl);
                                
                                // Force redirect if above doesn't work
                                setTimeout(function() {
                                    window.location.href = loginUrl;
                                }, 50);
                                
                                return false; // Prevent any further execution
                            } else {
                                // Email exists but NOT verified (email_verified_at is NULL) - redirect to OTP immediately
                                console.log('⚠️⚠️⚠️ Email exists but NOT verified (email_verified_at is NULL) ⚠️⚠️⚠️');
                                console.log('⚠️ Redirecting to OTP page for verification');
                                
                                // Show error message above Next button
                                const $errorDiv = $('#email-exists-error');
                                const $errorText = $('#email-exists-error-text');
                                if ($errorDiv.length) {
                                    $errorText.text('Email exists but not verified. Please verify your email first.');
                                    $errorDiv.show();
                                }
                                
                                // Redirect to OTP page IMMEDIATELY - use both methods to ensure redirect
                                const verifyUrl = '{{ route('public.account.register.verifyEmailPage') }}';
                                
                                // CRITICAL: Redirect immediately without any delay
                                // Use location.href for immediate redirect
                                window.location.href = verifyUrl;
                                
                                // Also use replace as backup
                                setTimeout(function() {
                                    window.location.replace(verifyUrl);
                                }, 10);
                                
                                // Force redirect if above doesn't work
                                setTimeout(function() {
                                    window.location.href = verifyUrl;
                                }, 100);
                                
                                return false; // Prevent any further execution
                            }
                        }
                        
                        // Email doesn't exist - restore button and continue with normal flow
                        $nextBtn.prop('disabled', false).html(originalBtnText);
                        
                        // Email doesn't exist - continue with normal flow
                        console.log('Email is available - continuing with registration');
                        
                        // For job-seeker, require email verification before going to step 2
                        if (accountType === 'job-seeker' && !window.registrationEmailVerified) {
                            // Store email in session before redirect (hide from URL)
                            // Email is already stored in session by sendVerificationCode API
                            // Redirect to clean URL without email parameter
                            const verifyUrl = '{{ route('public.account.register.verifyEmailPage') }}';
                            window.location.href = verifyUrl;
                            return;
                        }
                        
                        // For employer or if email already verified, continue to next step
                        if (currentStep < totalSteps) {
                            currentStep++;
                            window.registrationCurrentStep = currentStep;
                            sessionStorage.setItem('regStep', currentStep.toString());
                            showStep(currentStep);
                        }
                    })
                    .catch(error => {
                        console.error('Error checking email:', error);
                        $nextBtn.prop('disabled', false).html(originalBtnText);
                        // Continue with normal flow on error (no alert)
                        console.log('Error checking email, continuing with registration');
                        
                        // For job-seeker, require email verification before going to step 2
                        if (accountType === 'job-seeker' && !window.registrationEmailVerified) {
                            const verifyUrl = '{{ route('public.account.register.verifyEmailPage') }}';
                            window.location.href = verifyUrl;
                            return;
                        }
                        
                        // For employer or if email already verified, continue to next step
                        if (currentStep < totalSteps) {
                            currentStep++;
                            window.registrationCurrentStep = currentStep;
                            sessionStorage.setItem('regStep', currentStep.toString());
                            showStep(currentStep);
                        }
                    });
                    
                    return; // Stop execution here, will continue in fetch callback
                }

                if (currentStep < totalSteps) {
                    currentStep++;
                    window.registrationCurrentStep = currentStep;

                    // Save to sessionStorage
                    if (typeof Storage !== 'undefined') {
                        sessionStorage.setItem('regStep', currentStep.toString());
                    }

                    console.log('Moving to step:', currentStep);

                    // Call showStep if available
                    if (typeof showStep === 'function') {
                        showStep(currentStep);
                    } else {
                        // Fallback vanilla JS
                        document.querySelectorAll('.step-content').forEach(function(step, idx) {
                            const stepNum = idx + 1;
                            if (stepNum === currentStep) {
                                step.style.display = 'block';
                                step.classList.add('active');
                            } else {
                                step.style.display = 'none';
                                step.classList.remove('active');
                            }
                        });
                    }

                    // Call updateNavigation if available
                    if (typeof updateNavigation === 'function') {
                        updateNavigation();
                    }

                    // Restore form data for the new step (in case there was data from before)
                    setTimeout(function() {
                        if (typeof restoreFormData === 'function') {
                            restoreFormData();
                            console.log('Form data restored after moving to step:', currentStep);
                        }
                    }, 100);

                    console.log('Step changed successfully to', currentStep);
                } else {
                    console.log('Already on last step');
                }
            };

            window.goToPreviousStep = function() {
                console.log('=== window.goToPreviousStep called ===');
                console.log('Current step:', currentStep);

                // CRITICAL: Save current step's form data BEFORE going back
                if (typeof saveFormData === 'function') {
                    saveFormData();
                    console.log('Form data saved before going to previous step');
                }

                if (currentStep > 1) {
                    currentStep--;
                    window.registrationCurrentStep = currentStep;

                    // Save to sessionStorage
                    if (typeof Storage !== 'undefined') {
                        sessionStorage.setItem('regStep', currentStep.toString());
                    }

                    console.log('Moving to step:', currentStep);

                    // Call showStep if available
                    if (typeof showStep === 'function') {
                        showStep(currentStep);
                    } else {
                        // Fallback vanilla JS
                        document.querySelectorAll('.step-content').forEach(function(step, idx) {
                            const stepNum = idx + 1;
                            if (stepNum === currentStep) {
                                step.style.display = 'block';
                                step.classList.add('active');
                            } else {
                                step.style.display = 'none';
                                step.classList.remove('active');
                            }
                        });
                    }

                    // Call updateNavigation if available
                    if (typeof updateNavigation === 'function') {
                        updateNavigation();
                    }

                    // CRITICAL: Restore form data for the previous step
                    setTimeout(function() {
                        if (typeof restoreFormData === 'function') {
                            restoreFormData();
                            console.log('Form data restored after going back to step:', currentStep);
                        }
                    }, 150);
                }
            };

            // Institution subtypes mapping
            const institutionSubtypes = {
                'school': {
                    '': 'Select Board/Type',
                    'cbse': 'CBSE',
                    'icse': 'ICSE',
                    'ib': 'IB',
                    'cambridge': 'Cambridge',
                    'state-board': 'State Board',
                    'primary': 'Primary',
                    'preschool': 'Preschool'
                },
                'college': {
                    '': 'Select Type of College',
                    'medical-college': 'Medical College',
                    'nursing-college': 'Nursing College',
                    'engineering-college': 'Engineering College',
                    'management-college': 'Management College'
                },
                'coaching-institute': {
                    '': 'Select Type of Institution',
                    'jee-neet': 'JEE & NEET',
                    'banking-coaching': 'Banking Coaching',
                    'it-training-institute': 'IT Training Institute'
                },
                'edtech-company': {},
                'online-education-platform': {},
                'book-publishing-company': {},
                'non-profit-organization': {}
            };

            // Initialize
            $(document).ready(function() {
                // ---- Email verification helpers ----
                function showVerificationError(message) {
                    const $error = $('#verification-code-error');
                    $error.text(message || 'Something went wrong. Please try again.');
                    $error.show();
                }

                window.openEmailVerificationModal = function(email) {
                    console.log('Opening email verification modal for:', email);
                    $('#verification-email-display').text(email);
                    $('#verification-code-input').val('');
                    $('#verification-code-error').hide();

                    const csrfToken = $('input[name="_token"]').val();

                    // Send verification code
                    $('#verify-code-btn').prop('disabled', true).text('Sending code...');
                    $('#resend-code-btn').prop('disabled', true);

                    $.ajax({
                        url: '{{ route('public.account.register.sendVerificationCode') }}',
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            email: email,
                        },
                        success: function(response) {
                            console.log('Verification code sent:', response);
                            $('#verify-code-btn').prop('disabled', false).text(
                                'Verify & Continue');
                            $('#resend-code-btn').prop('disabled', false);
                            $('#email-verification-modal').modal('show');
                        },
                        error: function(xhr) {
                            console.error('Error sending verification code:', xhr);
                            $('#verify-code-btn').prop('disabled', false).text(
                                'Verify & Continue');
                            $('#resend-code-btn').prop('disabled', false);

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                alert(xhr.responseJSON.message);
                            } else {
                                alert(
                                    'Unable to send verification code. Please check your email and try again.'
                                );
                            }
                        },
                    });
                };

                $('#resend-code-btn').on('click', function(e) {
                    e.preventDefault();
                    const email = $('input[name="email"]').val();
                    if (!email) {
                        showVerificationError('Please enter your email address first.');
                        return;
                    }

                    window.openEmailVerificationModal(email);
                });

                $('#verify-code-btn').on('click', function(e) {
                    e.preventDefault();
                    const email = $('input[name="email"]').val();
                    const code = $('#verification-code-input').val();

                    $('#verification-code-error').hide();

                    if (!code || code.length !== 6) {
                        showVerificationError('Please enter the 6-digit verification code.');
                        return;
                    }

                    const csrfToken = $('input[name="_token"]').val();

                    $(this).prop('disabled', true).text('Verifying...');

                    $.ajax({
                        url: '{{ route('public.account.register.verifyEmailCode') }}',
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            email: email,
                            code: code,
                        },
                        success: function(response) {
                            console.log('Email verified:', response);
                            window.registrationEmailVerified = true;
                            $('#email-verification-modal').modal('hide');
                            $('#verify-code-btn').prop('disabled', false).text(
                                'Verify & Continue');

                            // Move to next step now that verification is done
                            if (typeof window.goToNextStep === 'function') {
                                window.goToNextStep();
                            }
                        },
                        error: function(xhr) {
                            console.error('Verification failed:', xhr);
                            $('#verify-code-btn').prop('disabled', false).text(
                                'Verify & Continue');

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                showVerificationError(xhr.responseJSON.message);
                            } else {
                                showVerificationError(
                                    'Verification failed. Please check the code and try again.'
                                );
                            }
                        },
                    });
                });

                console.log('Registration form script initialized');
                console.log('jQuery version:', $.fn.jquery);

                // Sync currentStep with sessionStorage
                if (typeof Storage !== 'undefined') {
                    const savedStep = sessionStorage.getItem('regStep');
                    if (savedStep) {
                        const stepNum = parseInt(savedStep);
                        if (stepNum >= 1 && stepNum <= 3) {
                            currentStep = stepNum;
                            window.registrationCurrentStep = stepNum;
                        }
                    } else {
                        // If no saved step, default to step 1 (especially when coming back from verify-email)
                        currentStep = 1;
                        window.registrationCurrentStep = 1;
                        sessionStorage.setItem('regStep', '1');
                    }
                }

                console.log('Initializing with step:', currentStep);

                // Check if we have saved form data and log it
                if (typeof Storage !== 'undefined') {
                    const savedData = localStorage.getItem('registrationFormData');
                    if (savedData) {
                        try {
                            const formData = JSON.parse(savedData);
                            console.log('Found saved form data on page load:', formData);
                            console.log('Email in saved data:', formData['email'] || 'NOT FOUND');
                            console.log('Phone in saved data:', formData['phone'] || formData['mobile'] ||
                                'NOT FOUND');
                        } catch (e) {
                            console.error('Error parsing saved form data on page load:', e);
                        }
                    } else {
                        console.log('No saved form data found on page load');
                    }
                }

                // Restore form data from localStorage
                function restoreFormData() {
                    console.log('=== RESTORING FORM DATA ===');
                    console.log('Current URL:', window.location.href);
                    console.log('Document ready state:', document.readyState);

                    if (typeof Storage !== 'undefined') {
                        const savedData = localStorage.getItem('registrationFormData');
                        if (savedData) {
                            try {
                                const formData = JSON.parse(savedData);
                                console.log('Found saved form data:', formData);
                                console.log('Number of fields to restore:', Object.keys(formData).length);
                                console.log('All keys in formData:', Object.keys(formData));

                                let restoredCount = 0;

                                // Restore all form fields
                                $.each(formData, function(key, value) {
                                    // Special handling for phone field - don't skip even if it seems empty
                                    const isPhoneField = (key === 'phone' || key === 'mobile' || key ===
                                        'phone_country_code');

                                    // Skip null/undefined, but allow empty strings for phone fields (they might have formatting)
                                    if (value === null || value === undefined) {
                                        return;
                                    }

                                    // For non-phone fields, skip empty strings
                                    if (!isPhoneField && value === '') {
                                        return;
                                    }

                                    // Handle file input filename display
                                    if (key.endsWith('_filename')) {
                                        const fieldName = key.replace('_filename', '');
                                        const $fileField = $('[name="' + fieldName + '"]');
                                        if ($fileField.length && $fileField.attr('type') === 'file') {
                                            // Create a visual indicator for the file
                                            const filename = value;
                                            const $parent = $fileField.closest(
                                                '.form-group, .mb-3, .form-item').first();
                                            if ($parent.length) {
                                                // Remove existing file indicator if any
                                                $parent.find('.file-selected-indicator').remove();

                                                // Add visual indicator
                                                const $indicator = $(
                                                    '<div class="file-selected-indicator mt-2 p-2 bg-light border rounded">' +
                                                    '<i class="ti ti-file me-2"></i>' +
                                                    '<span class="file-name">' + filename +
                                                    '</span>' +
                                                    '<small class="text-muted d-block mt-1">File selected (re-select to change)</small>' +
                                                    '</div>');
                                                $fileField.after($indicator);
                                                console.log('File indicator added for:', filename);
                                            }
                                        }
                                        return;
                                    }

                                    // Skip metadata fields
                                    if (key.endsWith('_size') || key.endsWith('_type')) {
                                        return;
                                    }

                                    // Try to find field by name first
                                    let $field = $('[name="' + key + '"]');

                                    // If not found by name, try by ID (for phone field)
                                    if ($field.length === 0 && (key === 'phone' || key === 'mobile')) {
                                        $field = $('#phone, #mobile, input[type="tel"]');
                                        console.log('Trying to find phone field by ID/type, found:',
                                            $field.length);
                                    }

                                    // If still not found, try to find by partial name match
                                    if ($field.length === 0) {
                                        $field = $('input[name*="' + key + '"], select[name*="' + key +
                                            '"], textarea[name*="' + key + '"]');
                                    }

                                    if ($field.length) {
                                        console.log('Found field for key:', key, 'field count:', $field
                                            .length);
                                        const fieldType = $field.attr('type') || '';

                                        // Skip file inputs (can't restore actual file, but filename is handled above)
                                        if (fieldType === 'file') {
                                            return;
                                        }

                                        // Handle different field types
                                        if ($field.is('select')) {
                                            $field.val(value);
                                            // Trigger change event to update dependent fields (like institution_name)
                                            $field.trigger('change');
                                            restoredCount++;
                                            console.log('Restored select:', key, value);
                                        } else if (fieldType === 'checkbox' || fieldType === 'radio') {
                                            // For radio/checkbox, find the exact field with matching value
                                            const $matchingField = $field.filter('[value="' + value +
                                                '"]');
                                            if ($matchingField.length) {
                                                $matchingField.prop('checked', true).trigger('change');
                                                restoredCount++;
                                                console.log('Restored checkbox/radio:', key, value);
                                            } else {
                                                // If no exact match, try to set by value attribute
                                                $('[name="' + key + '"][value="' + value + '"]').prop(
                                                    'checked', true).trigger('change');
                                                restoredCount++;
                                                console.log('Restored checkbox/radio (alternative):',
                                                    key, value);
                                            }
                                        } else {
                                            // For text inputs, email, password, tel (phone), etc.
                                            $field.val(value);
                                            // Trigger input event to remove any validation errors
                                            $field.trigger('input').trigger('change');
                                            restoredCount++;
                                            if (isPhoneField) {
                                                console.log('Restored phone field:', key, value);
                                            } else {
                                                console.log('Restored field:', key, value);
                                            }
                                        }
                                    } else {
                                        console.warn('Field not found for key:', key, 'value:', value);
                                        // Special debug for phone field
                                        if (isPhoneField) {
                                            console.warn('Phone field not found! Searching for:', key);
                                            console.warn('Available phone fields:', $(
                                                'input[name*="phone"], input[name*="mobile"], input[type="tel"]'
                                            ).map(function() {
                                                return $(this).attr('name') || $(this).attr(
                                                    'id');
                                            }).get());
                                        }
                                    }
                                });

                                console.log('=== FORM DATA RESTORED SUCCESSFULLY ===');
                                console.log('Total fields restored:', restoredCount);

                                // If we restored data, trigger a re-check after a short delay
                                if (restoredCount > 0) {
                                    setTimeout(function() {
                                        console.log('Re-checking restored fields...');
                                        // Verify that fields were actually restored
                                        $.each(formData, function(key, value) {
                                            if (key.endsWith('_filename') || key.endsWith(
                                                    '_size') || key.endsWith('_type')) {
                                                return;
                                            }
                                            const $field = $('[name="' + key + '"]');
                                            if ($field.length) {
                                                const currentValue = $field.val();
                                                if (currentValue !== value && value !== null &&
                                                    value !== undefined && value !== '') {
                                                    console.warn('Field', key,
                                                        'not properly restored. Expected:',
                                                        value, 'Got:', currentValue);
                                                    // Try to restore again
                                                    $field.val(value).trigger('input').trigger(
                                                        'change');
                                                }
                                            }
                                        });
                                    }, 500);
                                }
                            } catch (e) {
                                console.error('Error restoring form data:', e);
                            }
                        } else {
                            console.log('No saved form data found in localStorage');
                        }
                    } else {
                        console.error('localStorage not available');
                    }
                }

                // Save form data to localStorage
                function saveFormData() {
                    if (typeof Storage !== 'undefined') {
                        const formData = {};

                        // Get all form fields
                        $('input, select, textarea').each(function() {
                            const $field = $(this);
                            const fieldName = $field.attr('name');
                            const fieldType = $field.attr('type') || '';
                            const fieldId = $field.attr('id') || '';

                            if (!fieldName) return;

                            // Skip hidden fields and token
                            if (fieldType === 'hidden' || fieldName === '_token') {
                                return;
                            }

                            // Handle file inputs - save filename
                            if (fieldType === 'file') {
                                const files = $field[0].files;
                                if (files && files.length > 0) {
                                    formData[fieldName + '_filename'] = files[0].name;
                                    formData[fieldName + '_size'] = files[0].size;
                                    formData[fieldName + '_type'] = files[0].type;
                                    console.log('Saved file:', fieldName, files[0].name);
                                }
                            } else if (fieldType === 'checkbox' || fieldType === 'radio') {
                                if ($field.is(':checked')) {
                                    formData[fieldName] = $field.val();
                                    console.log('Saved checkbox/radio:', fieldName, $field.val());
                                }
                            } else {
                                // Handle all text inputs including tel, email, password, text, number, etc.
                                let value = $field.val();

                                // Special handling for phone field - save even if it has spaces or formatting
                                if (fieldName === 'phone' || fieldName === 'mobile' || fieldId ===
                                    'phone' || fieldId === 'mobile') {
                                    // Save phone number even if it has spaces, dashes, or parentheses
                                    if (value !== null && value !== undefined) {
                                        formData[fieldName] = value;
                                        console.log('Saved phone field:', fieldName, value);
                                    }
                                } else {
                                    // For other fields, trim and save if not empty
                                    if (value !== null && value !== undefined && value.trim() !== '') {
                                        formData[fieldName] = value;
                                        console.log('Saved field:', fieldName, value);
                                    }
                                }
                            }
                        });

                        // Also save phone_country_code if it exists
                        const $phoneCountryCode = $(
                            'input[name="phone_country_code"], select[name="phone_country_code"]');
                        if ($phoneCountryCode.length) {
                            const countryCode = $phoneCountryCode.val();
                            if (countryCode) {
                                formData['phone_country_code'] = countryCode;
                                console.log('Saved phone_country_code:', countryCode);
                            }
                        }

                        localStorage.setItem('registrationFormData', JSON.stringify(formData));
                        console.log('Form data saved to localStorage:', formData);
                        console.log('Phone field in saved data:', formData['phone'] || formData['mobile'] ||
                            'NOT FOUND');
                    }
                }

                // Auto-save form data on input/change (debounced) - INCLUDING file inputs
                let saveFormDataTimeout;
                $(document).on('input change', 'input, select, textarea', function() {
                    const $field = $(this);
                    const fieldName = $field.attr('name');
                    const fieldType = $field.attr('type');

                    // Skip only hidden fields and token
                    if (!fieldName || fieldType === 'hidden' || fieldName === '_token') {
                        return;
                    }

                    // Debounce save to avoid too many writes
                    clearTimeout(saveFormDataTimeout);
                    saveFormDataTimeout = setTimeout(function() {
                        saveFormData(); // This will save file info too
                    }, 300);
                });

                // Also save on file input change
                $(document).on('change', 'input[type="file"]', function() {
                    clearTimeout(saveFormDataTimeout);
                    saveFormDataTimeout = setTimeout(function() {
                        saveFormData();
                    }, 300);
                });

                // Check if email verification is pending - redirect to OTP page if not verified
                $(document).ready(function() {
                    // Check session for email verification status
                    const checkEmailVerification = function() {
                        const email = sessionStorage.getItem('registrationEmail') || localStorage.getItem('registrationEmail');
                        const emailVerified = sessionStorage.getItem('emailVerified') === 'true';
                        
                        // If there's an email but it's not verified, check with server
                        if (email && !emailVerified) {
                            console.log('Email found but not verified, checking with server...');
                            
                            // Check with server if email verification is pending
                            $.ajax({
                                url: '{{ route('public.account.register.getVerificationData') }}',
                                type: 'GET',
                                success: function(response) {
                                    if (response.data && response.data.email) {
                                        // Email exists in session but might not be verified
                                        // Check if we should redirect to OTP page
                                        const hasVerificationCode = response.data.verification_code !== null;
                                        
                                        if (hasVerificationCode) {
                                            console.log('Email verification pending, redirecting to OTP page...');
                                            window.location.href = '{{ route('public.account.register.verifyEmailPage') }}';
                                        }
                                    }
                                },
                                error: function(xhr) {
                                    // If error, might mean no verification session exists, continue normally
                                    console.log('No verification session found, continuing with registration');
                                }
                            });
                        }
                    };
                    
                    // Run check after a short delay to ensure session is ready
                    setTimeout(checkEmailVerification, 500);
                });

                // CRITICAL: Restore data on page load (after DOM is ready)
                console.log('=== INITIALIZING FORM RESTORE ===');

                // Function to restore data with proper timing
                function initializeFormRestore() {
                    console.log('Calling restoreFormData()...');
                    restoreFormData();
                    showStep(currentStep);
                    updateNavigation();
                }

                // Restore immediately when DOM is ready
                setTimeout(initializeFormRestore, 500);

                // Also restore after a longer delay to catch dynamically loaded fields
                setTimeout(initializeFormRestore, 1000);
                setTimeout(initializeFormRestore, 2000);

                // Also restore when page becomes visible (when coming back from another page)
                $(document).on('visibilitychange', function() {
                    if (!document.hidden) {
                        console.log('Page visible, restoring form data...');
                        setTimeout(function() {
                            restoreFormData();
                            showStep(currentStep);
                            updateNavigation();
                        }, 200);
                    }
                });

                // Also restore on focus (when tab becomes active)
                $(window).on('focus', function() {
                    console.log('Window focused, restoring form data...');
                    setTimeout(function() {
                        restoreFormData();
                        showStep(currentStep);
                        updateNavigation();
                    }, 200);
                });

                // Also restore when coming back via browser back button or navigation
                $(window).on('pageshow', function(event) {
                    console.log('Page shown event, restoring form data...');
                    setTimeout(function() {
                        restoreFormData();
                        showStep(currentStep);
                        updateNavigation();
                    }, 300);
                });

                // Also restore when page is loaded (including from back navigation)
                window.addEventListener('load', function() {
                    console.log('Window load event, restoring form data...');
                    setTimeout(function() {
                        restoreFormData();
                        showStep(currentStep);
                        updateNavigation();
                    }, 400);
                });

                // Also restore when DOM content is loaded
                if (document.readyState === 'complete') {
                    setTimeout(initializeFormRestore, 100);
                }

                // Real-time validation removal: Remove error ONLY for the specific field being typed
                function removeFieldError($field) {
                    const fieldType = $field.attr('type') || '';
                    const tagName = $field.prop('tagName') ? $field.prop('tagName').toLowerCase() : '';
                    const value = $field.val();
                    let shouldRemove = false;

                    // Check if THIS SPECIFIC field is valid based on type
                    if (fieldType === 'file') {
                        const files = $field[0].files;
                        shouldRemove = files && files.length > 0;
                    } else if (fieldType === 'email') {
                        // For email, remove error as soon as user types
                        shouldRemove = value && value.length > 0;
                    } else if (tagName === 'select') {
                        // For select dropdowns
                        shouldRemove = value && value !== '';
                    } else {
                        // For text inputs, password, phone, etc. - remove as soon as ANY character is typed
                        shouldRemove = value && value.length > 0;
                    }

                    if (shouldRemove) {
                        // Remove is-invalid class ONLY from this field
                        $field.removeClass('is-invalid');

                        // Remove error message ONLY for this specific field - be precise
                        // First, try next sibling
                        $field.next('.invalid-feedback').remove();

                        // Then check parent container - but only remove errors that are related to THIS field
                        const $parent = $field.parent();
                        if ($parent.length) {
                            // Find invalid-feedback that comes after this field in the same parent
                            $parent.children().each(function() {
                                const $sibling = $(this);
                                if ($sibling.hasClass('invalid-feedback') && $sibling.index() > $field
                                    .index()) {
                                    // Check if this error is for our field (it's the next element after our field)
                                    if ($sibling.prev().is($field)) {
                                        $sibling.remove();
                                    }
                                }
                            });
                        }

                        // Check form-group, mb-3, form-item containers - but only for this field's error
                        const $formGroup = $field.closest('.form-group');
                        if ($formGroup.length) {
                            // Only remove if the error is directly after our field
                            $formGroup.find('.invalid-feedback').each(function() {
                                const $error = $(this);
                                // Check if this error is right after our field
                                if ($error.prev().is($field) || $error.prev().find($field).length) {
                                    $error.remove();
                                }
                            });
                        }

                        const $mb3 = $field.closest('.mb-3');
                        if ($mb3.length && !$formGroup.length) {
                            $mb3.find('.invalid-feedback').each(function() {
                                const $error = $(this);
                                if ($error.prev().is($field)) {
                                    $error.remove();
                                }
                            });
                        }

                        const $formItem = $field.closest('.form-item');
                        if ($formItem.length && !$formGroup.length && !$mb3.length) {
                            $formItem.find('.invalid-feedback').each(function() {
                                const $error = $(this);
                                if ($error.prev().is($field)) {
                                    $error.remove();
                                }
                            });
                        }
                    }
                }

                // Handle ALL input types - IMMEDIATE removal on first keystroke
                // Use multiple events to ensure it works
                $(document).on('input keyup paste', 'input, select, textarea', function(e) {
                    const $field = $(this);
                    // Only remove error for THIS specific field if it has is-invalid class
                    if ($field.hasClass('is-invalid')) {
                        removeFieldError($field);
                    }
                });

                // Handle change events for select and file inputs
                $(document).on('change', 'select, input[type="file"]', function() {
                    const $field = $(this);
                    if ($field.hasClass('is-invalid')) {
                        removeFieldError($field);
                    }

                    // Handle file input - save filename to localStorage and show indicator
                    if ($field.attr('type') === 'file') {
                        const files = $field[0].files;
                        if (files && files.length > 0) {
                            const filename = files[0].name;
                            const fieldName = $field.attr('name');

                            // Save to localStorage
                            if (typeof Storage !== 'undefined') {
                                const savedData = localStorage.getItem('registrationFormData') || '{}';
                                try {
                                    const formData = JSON.parse(savedData);
                                    formData[fieldName + '_filename'] = filename;
                                    formData[fieldName + '_size'] = files[0].size;
                                    formData[fieldName + '_type'] = files[0].type;
                                    localStorage.setItem('registrationFormData', JSON.stringify(
                                        formData));
                                    console.log('File info saved to localStorage:', filename);
                                } catch (e) {
                                    console.error('Error saving file info:', e);
                                }
                            }

                            // Show visual indicator
                            const $parent = $field.closest('.form-group, .mb-3, .form-item').first();
                            if ($parent.length) {
                                $parent.find('.file-selected-indicator').remove();
                                const $indicator = $(
                                    '<div class="file-selected-indicator mt-2 p-2 bg-light border rounded">' +
                                    '<i class="ti ti-file me-2"></i>' +
                                    '<span class="file-name">' + filename + '</span>' +
                                    '<small class="text-muted d-block mt-1">File selected</small>' +
                                    '</div>');
                                $field.after($indicator);
                            }
                        }
                    }
                });

                // Special handling for password confirmation - only remove if passwords match
                $(document).on('input keyup', 'input[name="password"], input[name="password_confirmation"]',
                    function() {
                        const $field = $(this);
                        const $passwordField = $('input[name="password"]');
                        const $passwordConfirmationField = $('input[name="password_confirmation"]');
                        const password = $passwordField.val();
                        const passwordConfirmation = $passwordConfirmationField.val();

                        // Remove error from the field being typed if it has value
                        if ($field.hasClass('is-invalid') && $field.val() && $field.val().length > 0) {
                            // But only remove password_confirmation error if passwords match
                            if ($field.attr('name') === 'password_confirmation') {
                                if (password && passwordConfirmation && password === passwordConfirmation) {
                                    $passwordConfirmationField.removeClass('is-invalid');
                                    $passwordConfirmationField.next('.invalid-feedback').remove();
                                }
                            } else {
                                // For password field, just remove if it has value
                                removeFieldError($passwordField);
                            }
                        }
                    });

                // Ensure button exists and is clickable
                setTimeout(function() {
                    const btn = document.getElementById('register-submit-btn');
                    if (btn) {
                        console.log('Button found:', btn);
                        btn.setAttribute('type', 'button');
                        // Keep onclick attribute - it calls window.handleNextStepClick
                        // Also add backup event listener
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            console.log('Button clicked via addEventListener backup');
                            if (typeof window.handleNextStepClick === 'function') {
                                window.handleNextStepClick(e);
                            } else {
                                console.error('window.handleNextStepClick is not defined!');
                            }
                            return false;
                        }, true);
                    } else {
                        console.error('Button #register-submit-btn not found!');
                    }
                }, 500);

                // Function to toggle resume field visibility
                function toggleResumeField(accountType) {
                    console.log('=== TOGGLE RESUME FIELD ===');
                    console.log('Account type:', accountType);
                    
                    // Method 1: Find by input name
                    let $resumeInput = $('input[name="resume"]');
                    console.log('Resume input by name found:', $resumeInput.length);
                    
                    // Method 2: Find by label text
                    if ($resumeInput.length === 0) {
                        $resumeInput = $('label:contains("Upload Resume"), label:contains("Resume")').find('input[type="file"]');
                        console.log('Resume input by label found:', $resumeInput.length);
                    }
                    
                    // Method 3: Find by file input type
                    if ($resumeInput.length === 0) {
                        $('input[type="file"]').each(function() {
                            const $label = $(this).closest('.form-group, .mb-3, .col-md-6').find('label');
                            if ($label.text().toLowerCase().includes('resume')) {
                                $resumeInput = $(this);
                                return false; // break
                            }
                        });
                        console.log('Resume input by label text found:', $resumeInput.length);
                    }
                    
                    if ($resumeInput.length > 0) {
                        // Find all possible parent containers
                        const $allContainers = $resumeInput.parentsUntil('.step-content').add($resumeInput.closest('.col-md-6, .form-group, .mb-3'));
                        
                        // Also find by label
                        const $label = $('label:contains("Upload Resume"), label:contains("Resume")').first();
                        const $labelContainer = $label.closest('.col-md-6, .form-group, .mb-3');
                        
                        console.log('All containers found:', $allContainers.length);
                        console.log('Label container found:', $labelContainer.length);
                        
                        if (accountType === 'employer') {
                            // Hide ALL possible containers
                            $allContainers.hide();
                            $labelContainer.hide();
                            $resumeInput.hide();
                            $label.hide();
                            
                            // Use CSS to force hide
                            $allContainers.css('display', 'none');
                            $labelContainer.css('display', 'none');
                            $resumeInput.css('display', 'none');
                            $label.css('display', 'none');
                            
                            // Add inline style
                            $allContainers.attr('style', 'display: none !important;');
                            $labelContainer.attr('style', 'display: none !important;');
                            
                            $resumeInput.removeAttr('required');
                            
                            // Add class to body
                            $('body').addClass('employer-selected').removeClass('job-seeker-selected');
                            
                            console.log('✅ Resume field hidden for employer');
                            console.log('Hidden containers:', $allContainers.length);
                        } else {
                            // Show resume field for job-seeker
                            $allContainers.show();
                            $labelContainer.show();
                            $resumeInput.show();
                            $label.show();
                            
                            // Remove inline styles
                            $allContainers.removeAttr('style');
                            $labelContainer.removeAttr('style');
                            $resumeInput.removeAttr('style');
                            $label.removeAttr('style');
                            
                            $resumeInput.attr('required', 'required');
                            
                            // Remove class from body
                            $('body').addClass('job-seeker-selected').removeClass('employer-selected');
                            
                            console.log('✅ Resume field shown for job-seeker');
                        }
                    } else {
                        console.warn('⚠️ Resume input field not found - trying alternative method');
                        
                        // Alternative: Find by searching all file inputs and their labels
                        $('input[type="file"]').each(function() {
                            const $this = $(this);
                            const $parent = $this.closest('.col-md-6, .form-group, .mb-3');
                            const labelText = $parent.find('label').text().toLowerCase();
                            
                            if (labelText.includes('resume') || labelText.includes('upload')) {
                                console.log('Found resume field by text search:', labelText);
                                if (accountType === 'employer') {
                                    $parent.hide().css('display', 'none !important').attr('style', 'display: none !important;');
                                    $this.removeAttr('required');
                                    $parent.find('label').hide();
                                    console.log('✅ Resume field hidden via alternative method');
                                } else {
                                    $parent.show().removeAttr('style').css('display', '');
                                    $this.attr('required', 'required');
                                    $parent.find('label').show();
                                    console.log('✅ Resume field shown via alternative method');
                                }
                            }
                        });
                    }
                    
                    // Final check: Find by label text "Upload Resume"
                    $('label').each(function() {
                        const $label = $(this);
                        const labelText = $label.text().toLowerCase();
                        if (labelText.includes('upload resume') || (labelText.includes('resume') && labelText.includes('pdf'))) {
                            const $container = $label.closest('.col-md-6, .form-group, .mb-3');
                            const $fileInput = $container.find('input[type="file"]');
                            
                            if (accountType === 'employer') {
                                $container.hide().css('display', 'none !important').attr('style', 'display: none !important;');
                                $fileInput.removeAttr('required');
                                console.log('✅ Resume field hidden via label text search');
                            } else {
                                $container.show().removeAttr('style');
                                $fileInput.attr('required', 'required');
                                console.log('✅ Resume field shown via label text search');
                            }
                        }
                    });
                }

                // Handle account type change (Job Seeker vs Employer)
                $(document).on('change', 'input[name="account_type"]', function() {
                    const accountType = $(this).val();
                    console.log('=== ACCOUNT TYPE CHANGED ===');
                    console.log('Account type:', accountType);
                    
                    // Hide/show resume field immediately
                    toggleResumeField(accountType);
                    
                    // Also use direct method
                    if (accountType === 'employer') {
                        // Find by label text "Upload Resume"
                        $('label').each(function() {
                            const $label = $(this);
                            const labelText = $label.text().toLowerCase();
                            if (labelText.includes('upload resume') || 
                                (labelText.includes('resume') && labelText.includes('pdf'))) {
                                const $container = $label.closest('.col-md-6');
                                if ($container.length === 0) {
                                    $container = $label.closest('.form-group, .mb-3');
                                }
                                if ($container.length > 0) {
                                    $container.hide().css('display', 'none !important');
                                    $container.find('input[type="file"]').removeAttr('required');
                                    console.log('✅ Resume field hidden via jQuery');
                                }
                            }
                        });
                        
                        // Also find by input name
                        const $resumeInput = $('input[name="resume"]');
                        if ($resumeInput.length > 0) {
                            const $container = $resumeInput.closest('.col-md-6');
                            if ($container.length > 0) {
                                $container.hide().css('display', 'none !important');
                                $resumeInput.removeAttr('required');
                                console.log('✅ Resume input hidden via jQuery');
                            }
                        }
                    } else {
                        // Show for job-seeker
                        $('label').each(function() {
                            const $label = $(this);
                            const labelText = $label.text().toLowerCase();
                            if (labelText.includes('upload resume') || 
                                (labelText.includes('resume') && labelText.includes('pdf'))) {
                                const $container = $label.closest('.col-md-6');
                                if ($container.length === 0) {
                                    $container = $label.closest('.form-group, .mb-3');
                                }
                                if ($container.length > 0) {
                                    $container.show().removeAttr('style');
                                    $container.find('input[type="file"]').attr('required', 'required');
                                    console.log('✅ Resume field shown via jQuery');
                                }
                            }
                        });
                    }

                    // If on Step 3, refresh the step display
                    if (currentStep === 3) {
                        showStep(3);
                    }
                });
                
                // Initial check on page load
                $(document).ready(function() {
                    setTimeout(function() {
                        const accountType = $('input[name="account_type"]:checked').val() || 'job-seeker';
                        console.log('Initial account type on page load:', accountType);
                        toggleResumeField(accountType);
                    }, 500);
                });
                
                // Also check when DOM is fully loaded
                $(window).on('load', function() {
                    setTimeout(function() {
                        const accountType = $('input[name="account_type"]:checked').val() || 'job-seeker';
                        console.log('Account type on window load:', accountType);
                        toggleResumeField(accountType);
                    }, 300);
                });

                // Handle institution type change
                $(document).on('change', '#institution_type', function() {
                    const selectedType = $(this).val();
                    const $subtypeField = $('#institution_name').closest('.form-group');

                    console.log('Institution type changed to:', selectedType);

                    if (selectedType && institutionSubtypes[selectedType] && Object.keys(
                            institutionSubtypes[selectedType]).length > 1) {
                        // Populate subtypes
                        let options = '';
                        $.each(institutionSubtypes[selectedType], function(key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });
                        $('#institution_name').html(options);
                        $subtypeField.show();
                        $('#institution_name').prop('required', true);
                        console.log('Subtype field shown');
                    } else {
                        $subtypeField.hide();
                        $('#institution_name').prop('required', false);
                        $('#institution_name').val('');
                        console.log('Subtype field hidden');
                    }
                });

                // Backup event listeners for register-submit-btn (using global window.handleNextStepClick)
                $(document).on('click', '#register-submit-btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Button clicked via jQuery delegate (backup)');
                    if (typeof window.handleNextStepClick === 'function') {
                        window.handleNextStepClick(e);
                    } else {
                        console.error('window.handleNextStepClick is not defined!');
                    }
                    return false;
                });

                // Also attach directly when DOM is ready
                setTimeout(function() {
                    const $btn = $('#register-submit-btn');
                    if ($btn.length) {
                        console.log('Button found, attaching backup handler');
                        $btn.attr('type', 'button');
                        $btn.off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            console.log('Button clicked via direct jQuery handler (backup)');
                            if (typeof window.handleNextStepClick === 'function') {
                                window.handleNextStepClick(e);
                            } else {
                                console.error('window.handleNextStepClick is not defined!');
                            }
                            return false;
                        });
                    } else {
                        console.error('Button #register-submit-btn not found in DOM!');
                    }
                }, 100);

                // Also listen for custom event from inline handler
                $(document).on('registration-next-step', function(e) {
                    console.log('=== Custom event registration-next-step received ===');
                    if (typeof window.goToNextStep === 'function') {
                        console.log('Calling window.goToNextStep() from event');
                        try {
                            window.goToNextStep();
                        } catch (err) {
                            console.error('Error in window.goToNextStep:', err);
                        }
                    } else {
                        console.error('window.goToNextStep function not found!');
                        // Fallback: direct step navigation
                        console.log('Using fallback navigation');
                        const stepContents = document.querySelectorAll('.step-content');
                        const currentStepNum = parseInt(sessionStorage.getItem('regStep') || '1');
                        const nextStep = currentStepNum + 1;

                        if (nextStep <= 3) {
                            stepContents.forEach(function(step, idx) {
                                const stepNum = idx + 1;
                                if (stepNum === nextStep) {
                                    step.style.display = 'block';
                                    step.classList.add('active');
                                } else {
                                    step.style.display = 'none';
                                    step.classList.remove('active');
                                }
                            });
                            sessionStorage.setItem('regStep', nextStep.toString());
                        }
                    }
                });

                // Direct binding after DOM is ready - Multiple attempts
                function attachButtonHandlers() {
                    const $btn = $('#register-submit-btn');
                    if ($btn.length) {
                        console.log('Attaching handlers to button');
                        $btn.attr('type', 'button');
                        // Ensure handler
                        $btn.off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            console.log('Submit button clicked via direct binding');
                            if (typeof window.goToNextStep === 'function') {
                                window.goToNextStep();
                            } else {
                                console.error('window.goToNextStep is not defined');
                            }
                            return false;
                        });

                        // Also add vanilla JS handler as backup
                        const btnElement = document.getElementById('register-submit-btn');
                        if (btnElement) {
                            btnElement.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                console.log('Submit button clicked via vanilla JS');
                                if (typeof window.goToNextStep === 'function') {
                                    window.goToNextStep();
                                }
                                return false;
                            }, true);
                        }
                    } else {
                        console.log('Button not found, retrying...');
                        setTimeout(attachButtonHandlers, 200);
                    }
                }

                // Try multiple times
                setTimeout(attachButtonHandlers, 300);
                setTimeout(attachButtonHandlers, 800);
                setTimeout(attachButtonHandlers, 1500);

                // Next step button (Step 2) - Multiple handlers
                $(document).on('click', '#next-step-btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    console.log('Next button clicked via delegate, currentStep:', currentStep);

                    // Validate current step before proceeding
                    if (typeof validateStep === 'function') {
                        const isValid = validateStep(currentStep);
                        console.log('Step', currentStep, 'validation result:', isValid);
                        if (!isValid) {
                            console.log('Validation failed, showing errors');
                            // Scroll to first error
                            const $firstError = $('.is-invalid').first();
                            if ($firstError.length && $firstError.offset()) {
                                $('html, body').animate({
                                    scrollTop: $firstError.offset().top - 100
                                }, 300);
                            }
                            return false;
                        }
                    }

                    if (typeof window.goToNextStep === 'function') {
                        window.goToNextStep();
                    } else {
                        console.error('window.goToNextStep is not defined');
                    }
                    return false;
                });

                // Direct binding for next button - Multiple attempts
                function attachNextButtonHandler() {
                    const $nextBtn = $('#next-step-btn');
                    if ($nextBtn.length) {
                        console.log('Attaching handler to next button');
                        $nextBtn.off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            console.log('Next button clicked via direct binding, currentStep:',
                                currentStep);

                            // Validate current step before proceeding
                            if (typeof validateStep === 'function') {
                                const isValid = validateStep(currentStep);
                                console.log('Step', currentStep, 'validation result:', isValid);
                                if (!isValid) {
                                    console.log('Validation failed, showing errors');
                                    // Scroll to first error
                                    const $firstError = $('.is-invalid').first();
                                    if ($firstError.length && $firstError.offset()) {
                                        $('html, body').animate({
                                            scrollTop: $firstError.offset().top - 100
                                        }, 300);
                                    }
                                    return false;
                                }
                            }

                            if (typeof window.goToNextStep === 'function') {
                                window.goToNextStep();
                            }
                            return false;
                        });

                        // Also add vanilla JS handler
                        const nextBtnElement = document.getElementById('next-step-btn');
                        if (nextBtnElement) {
                            nextBtnElement.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                console.log('Next button clicked via vanilla JS');

                                // Validate current step before proceeding
                                if (typeof validateStep === 'function') {
                                    const isValid = validateStep(currentStep);
                                    console.log('Step', currentStep, 'validation result:', isValid);
                                    if (!isValid) {
                                        console.log('Validation failed, showing errors');
                                        // Scroll to first error
                                        const firstError = document.querySelector('.is-invalid');
                                        if (firstError) {
                                            firstError.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'center'
                                            });
                                        }
                                        return false;
                                    }
                                }

                                if (typeof window.goToNextStep === 'function') {
                                    window.goToNextStep();
                                }
                                return false;
                            }, true);
                        }
                    } else {
                        console.log('Next button not found, retrying...');
                        setTimeout(attachNextButtonHandler, 200);
                    }
                }

                setTimeout(attachNextButtonHandler, 300);
                setTimeout(attachNextButtonHandler, 800);
                setTimeout(attachNextButtonHandler, 1500);

                // Update the global previous function to use jQuery if available
                if (typeof window.goToPreviousStep === 'function') {
                    const originalGoToPreviousStep = window.goToPreviousStep;
                    window.goToPreviousStep = function() {
                        console.log('=== jQuery-enhanced goToPreviousStep called ===');

                        // Save current step's form data before going back
                        if (typeof saveFormData === 'function') {
                            saveFormData();
                            console.log('Form data saved before going back (jQuery-enhanced)');
                        }

                        if (typeof showStep === 'function' && typeof updateNavigation === 'function') {
                            if (currentStep > 1) {
                                currentStep--;
                                window.registrationCurrentStep = currentStep;
                                sessionStorage.setItem('regStep', currentStep.toString());
                                showStep(currentStep);
                                updateNavigation();

                                // Restore form data after showing previous step
                                setTimeout(function() {
                                    if (typeof restoreFormData === 'function') {
                                        restoreFormData();
                                        console.log(
                                            'Form data restored after going back (jQuery-enhanced)'
                                        );
                                    }
                                }, 150);
                            }
                        } else {
                            originalGoToPreviousStep();
                        }
                    };
                }

                $(document).on('click', '#prev-step-btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    console.log('Previous button clicked, currentStep:', currentStep);
                    if (typeof window.goToPreviousStep === 'function') {
                        window.goToPreviousStep();
                    } else {
                        if (currentStep > 1) {
                            currentStep--;
                            showStep(currentStep);
                            updateNavigation();
                        }
                    }
                    return false;
                });

                // Direct binding for previous button
                setTimeout(function() {
                    $('#prev-step-btn').off('click').on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Previous button clicked via direct binding');
                        if (typeof window.goToPreviousStep === 'function') {
                            window.goToPreviousStep();
                        }
                        return false;
                    });
                }, 300);

                // Final submit button (Step 3)
                $(document).on('click', '#final-submit-btn', function(e) {
                    if (!validateStep(currentStep)) {
                        e.preventDefault();
                        return false;
                    }
                    // Allow form submission
                });

                // Form submit handling - prevent if not last step, use AJAX for final submit
                $('form').on('submit', function(e) {
                    console.log('Form submit event, currentStep:', currentStep);
                    if (currentStep < totalSteps) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Preventing form submit, going to next step');
                        if (typeof window.goToNextStep === 'function') {
                            window.goToNextStep();
                        } else {
                            console.error('window.goToNextStep is not defined');
                        }
                        return false;
                    } else {
                        // Final step - validate before allowing submission
                        console.log('Final step, validating...');
                        if (!validateStep(currentStep)) {
                            e.preventDefault();
                            return false;
                        }

                        // Use AJAX to submit form
                        e.preventDefault();
                        console.log('Submitting form via AJAX...');

                        const form = $(this);
                        const formData = new FormData(this);
                        const submitBtn = $('#final-submit-btn');

                        // Disable submit button
                        submitBtn.prop('disabled', true).text('Registering...');

                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                console.log('Registration successful:', response);

                                // Clear localStorage on successful registration
                                if (typeof Storage !== 'undefined') {
                                    // localStorage.removeItem('registrationFormData');
                                    // sessionStorage.removeItem('regStep');
                                    // sessionStorage.removeItem('registrationEmailVerified');
                                    console.log('Cleared registration data from storage');
                                }

                                if (response.data && response.data.redirect) {
                                    window.location.href = response.data.redirect;
                                } else if (response.redirect) {
                                    window.location.href = response.redirect;
                                } else {
                                    window.location.href = '/account/dashboard';
                                }
                            },
                            error: function(xhr) {
                                console.error('Registration error:', xhr);
                                submitBtn.prop('disabled', false).text('Registration');

                                // Show validation errors
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    const errors = xhr.responseJSON.errors;
                                    $.each(errors, function(field, messages) {
                                        const $field = $('[name="' + field + '"]');
                                        $field.addClass('is-invalid');
                                        if (!$field.next('.invalid-feedback')
                                            .length) {
                                            $field.after(
                                                '<div class="invalid-feedback d-block" style="display: block !important;">' +
                                                messages[0] + '</div>');
                                        }
                                    });
                                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                    alert(xhr.responseJSON.message);
                                } else {
                                    alert('Registration failed. Please try again.');
                                }
                            }
                        });

                        return false;
                    }
                });
            });

            function showStep(step) {
                console.log('showStep called with step:', step);

                // Get account type (job-seeker or employer)
                const accountType = $('input[name="account_type"]:checked').val() || 'job-seeker';
                console.log('Account type:', accountType);

                // Hide all steps
                $('.step-content').removeClass('active').hide();
                console.log('All steps hidden');

                // Show current step based on account type
                let $currentStep;
                if (step === 3) {
                    // Step 3: Show different content for job-seeker vs employer
                    if (accountType === 'employer') {
                        $currentStep = $('#step-3-employer');
                        console.log('Showing Step 3 for employer');
                    } else {
                        $currentStep = $('#step-3-job-seeker');
                        console.log('Showing Step 3 for job-seeker');
                    }
                } else {
                    // Step 1 and 2: Same for both
                    $currentStep = $('.step-content[data-step="' + step + '"]').first();
                }

                console.log('Current step element found:', $currentStep.length);

                if ($currentStep.length > 0) {
                    $currentStep.addClass('active').show();
                    console.log('Step', step, 'shown');
                } else {
                    console.error('Step content not found for step:', step);
                    // Try alternative selector
                    $('.step-content').each(function(index) {
                        if (index + 1 === step) {
                            $(this).addClass('active').show();
                            console.log('Step shown using index:', index + 1);
                        }
                    });
                }

                // Update step indicators
                $('.step').removeClass('active completed');
                for (let i = 1; i <= totalSteps; i++) {
                    if (i < step) {
                        $('.step[data-step="' + i + '"]').addClass('completed');
                    } else if (i === step) {
                        $('.step[data-step="' + i + '"]').addClass('active');
                    }
                }

                // CRITICAL: Restore form data when step is shown
                setTimeout(function() {
                    if (typeof restoreFormData === 'function') {
                        restoreFormData();
                        console.log('Form data restored in showStep for step:', step);
                    }
                }, 100);

                // Scroll to top
                const $stepsIndicator = $('.registration-steps');
                if ($stepsIndicator.length) {
                    $('html, body').animate({
                        scrollTop: $stepsIndicator.offset().top - 100
                    }, 300);
                }
            }

            function updateNavigation() {
                console.log('updateNavigation called, currentStep:', currentStep);
                const $nav = $('.registration-navigation');
                const $prevBtn = $('#prev-step-btn');
                const $nextBtn = $('#next-step-btn');
                const $submitBtn = $('#register-submit-btn');
                const $finalSubmitBtn = $('#final-submit-btn');

                console.log('Navigation elements found:', {
                    nav: $nav.length,
                    prevBtn: $prevBtn.length,
                    nextBtn: $nextBtn.length,
                    submitBtn: $submitBtn.length,
                    finalSubmitBtn: $finalSubmitBtn.length
                });

                if (currentStep === 1) {
                    console.log('Step 1: Showing submit button only');
                    $nav.hide();
                    $prevBtn.hide();
                    $submitBtn.show().text('Next Step').attr('type', 'button');
                    $finalSubmitBtn.hide();
                } else if (currentStep < totalSteps) {
                    // Step 2: Show Previous and Next buttons
                    console.log('Step', currentStep, ': Showing Previous and Next buttons');
                    $nav.show();
                    $prevBtn.show().css({
                        'display': 'inline-block',
                        'visibility': 'visible'
                    });
                    $nextBtn.show().css({
                        'display': 'inline-block',
                        'visibility': 'visible'
                    });
                    $submitBtn.hide();
                    $finalSubmitBtn.hide();
                } else {
                    // Last step - Step 3: Show Previous and Registration button
                    console.log('Step 3: Showing Previous and Registration button');
                    $nav.show();
                    $prevBtn.show().css({
                        'display': 'inline-block',
                        'visibility': 'visible'
                    });
                    $nextBtn.hide();
                    $submitBtn.hide();
                    $finalSubmitBtn.show().text('Registration').css({
                        'display': 'inline-block',
                        'visibility': 'visible'
                    });
                }
            }

            // Helper function to get field-specific error message (accessible in validateStep)
            function getFieldErrorMessage($field) {
                const fieldName = $field.attr('name') || '';
                const fieldId = $field.attr('id') || '';
                const $label = $field.closest('.form-group').find('label').first() ||
                    $field.closest('.mb-3').find('label').first() ||
                    $field.closest('.form-item').find('label').first();
                const labelText = $label.length ? $label.text().trim() : '';

                // Field-specific messages based on name/ID
                const messages = {
                    'full_name': 'The full name field is required.',
                    'first_name': 'The first name field is required.',
                    'last_name': 'The last name field is required.',
                    'email': 'The email field is required.',
                    'phone': 'The mobile number field is required.',
                    'password': 'The password field is required.',
                    'password_confirmation': 'The password confirmation field is required.',
                    'resume': 'The upload resume field is required.',
                    'institution_type': 'The institution type field is required.',
                    'location_type': 'The location type field is required.',
                };

                // Try to get message by field name
                if (fieldName && messages[fieldName]) {
                    return messages[fieldName];
                }

                // Try to get message by field ID
                if (fieldId && messages[fieldId]) {
                    return messages[fieldId];
                }

                // Try to get message from label
                if (labelText) {
                    return 'The ' + labelText.toLowerCase() + ' field is required.';
                }

                // Default message
                return 'This field is required.';
            }

            function validateStep(step) {
                let isValid = true;
                const $stepContent = $('.step-content[data-step="' + step + '"]');

                // Clear previous validation errors
                $stepContent.find('.is-invalid').removeClass('is-invalid');
                $stepContent.find('.invalid-feedback').remove();

                // Find all required fields in current step
                $stepContent.find('input[required], select[required], textarea[required], input[type="file"][required]')
                    .each(function() {
                        const $field = $(this);
                        const fieldType = $field.attr('type');
                        const fieldName = $field.attr('name') || $field.attr('id') || '';
                        let value = $field.val();

                        // Handle file inputs
                        if (fieldType === 'file') {
                            const files = $field[0].files;
                            if (!files || files.length === 0) {
                                isValid = false;
                                $field.addClass('is-invalid');
                                // Find parent container (form-group, mb-3, or form-item)
                                let $container = $field.closest('.form-group');
                                if ($container.length === 0) {
                                    $container = $field.closest('.mb-3');
                                }
                                if ($container.length === 0) {
                                    $container = $field.closest('.form-item');
                                }
                                if ($container.length === 0) {
                                    $container = $field.parent();
                                }

                                // Add error message after the field or in container
                                if (!$container.find('.invalid-feedback').length) {
                                    const errorMsg = getFieldErrorMessage($field);
                                    $field.after(
                                        '<div class="invalid-feedback d-block" style="display: block !important;">' +
                                        errorMsg + '</div>');
                                }
                            }
                        } else if (!value || value === '' || value === null) {
                            isValid = false;
                            $field.addClass('is-invalid');

                            // Find parent container
                            let $container = $field.closest('.form-group');
                            if ($container.length === 0) {
                                $container = $field.closest('.mb-3');
                            }
                            if ($container.length === 0) {
                                $container = $field.closest('.form-item');
                            }
                            if ($container.length === 0) {
                                $container = $field.parent();
                            }

                            // Add error message right after the input field
                            if (!$field.next('.invalid-feedback').length && !$container.find('.invalid-feedback')
                                .length) {
                                const errorMsg = getFieldErrorMessage($field);
                                $field.after(
                                    '<div class="invalid-feedback d-block" style="display: block !important;">' +
                                    errorMsg + '</div>');
                            }
                        }
                    });

                // Special validation for email
                if (step === 1) {
                    const $emailField = $stepContent.find('input[type="email"]');
                    const email = $emailField.val();
                    if (email) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(email)) {
                            isValid = false;
                            $emailField.addClass('is-invalid');
                            if (!$emailField.next('.invalid-feedback').length) {
                                $emailField.after(
                                    '<div class="invalid-feedback d-block" style="display: block !important;">Please enter a valid email address.</div>'
                                );
                            }
                        }
                    }
                }

                // Special validation for password confirmation
                if (step === 1) {
                    const password = $stepContent.find('input[name="password"]').val();
                    const passwordConfirmation = $stepContent.find('input[name="password_confirmation"]').val();
                    if (password && passwordConfirmation && password !== passwordConfirmation) {
                        isValid = false;
                        const $confirmField = $stepContent.find('input[name="password_confirmation"]');
                        $confirmField.addClass('is-invalid');
                        if (!$confirmField.next('.invalid-feedback').length) {
                            $confirmField.after(
                                '<div class="invalid-feedback d-block" style="display: block !important;">Passwords do not match.</div>'
                            );
                        }
                    }
                }

                // Special validation for password length
                if (step === 1) {
                    const password = $stepContent.find('input[name="password"]').val();
                    if (password && password.length < 6) {
                        isValid = false;
                        const $passwordField = $stepContent.find('input[name="password"]');
                        $passwordField.addClass('is-invalid');
                        if (!$passwordField.next('.invalid-feedback').length) {
                            $passwordField.after(
                                '<div class="invalid-feedback d-block" style="display: block !important;">Password must be at least 6 characters.</div>'
                            );
                        }
                    }
                }

                // Step 2 validation - Institution Type
                if (step === 2) {
                    const $institutionType = $stepContent.find('#institution_type');
                    const institutionType = $institutionType.val();
                    if (!institutionType || institutionType === '') {
                        isValid = false;
                        $institutionType.addClass('is-invalid');
                        if (!$institutionType.next('.invalid-feedback').length) {
                            $institutionType.after(
                                '<div class="invalid-feedback d-block" style="display: block !important;">Please select an institution type.</div>'
                            );
                        }
                    }
                }

                // Step 3 validation - Location Type
                if (step === 3) {
                    const $locationType = $stepContent.find('select[name="location_type"]');
                    const locationType = $locationType.val();
                    if (!locationType || locationType === '') {
                        isValid = false;
                        $locationType.addClass('is-invalid');
                        if (!$locationType.next('.invalid-feedback').length) {
                            $locationType.after(
                                '<div class="invalid-feedback d-block" style="display: block !important;">Please select location type.</div>'
                            );
                        }
                    }
                }

                return isValid;
            }

            // Vanilla JS fallback if jQuery fails
            window.registrationFormFallback = function() {
                console.log('Using vanilla JS fallback');
                const btn = document.getElementById('register-submit-btn');
                if (btn) {
                    btn.setAttribute('type', 'button');
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Button clicked (vanilla JS fallback)');
                        alert('Please refresh the page. JavaScript is loading...');
                    });
                }
            };

        })(jQuery || window.jQuery || window.$ || (function() {
            console.warn('jQuery not found, using fallback');
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', window.registrationFormFallback);
            } else {
                window.registrationFormFallback();
            }
            return {};
        }()));
    </script>
@endpush
