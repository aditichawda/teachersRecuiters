@php
    Theme::layout('without-navbar');
@endphp

<div class="section-full site-bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-8">
                <div class="twm-log-reg-form-wrap">
                    <div class="twm-log-reg-inner">
                        <div class="twm-log-reg-head text-center mb-4">
                            <div class="twm-log-reg-logo mb-2">
                                @if (Theme::getLogo())
                                    {!! Theme::getLogoImage(['class' => 'logo'], 'logo', 60) !!}
                                @endif
                            </div>
                            <span class="log-reg-form-title d-block mb-1">
                                {{ __('Verify your email') }}
                            </span>
                            <p class="text-muted mb-0">
                                {{ __('We have sent a 6-digit verification code to:') }}
                                <strong id="verification-email-display">{{ $email }}</strong>
                            </p>
                        </div>

                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="verification-code-input" class="form-label">
                                        {{ __('Verification Code') }}
                                    </label>
                                    <input
                                        type="text"
                                        id="verification-code-input"
                                        class="form-control"
                                        maxlength="6"
                                        autocomplete="one-time-code"
                                        inputmode="numeric"
                                        pattern="[0-9]{6}"
                                        placeholder="000000"
                                    />
                                    <div
                                        id="verification-code-error"
                                        class="invalid-feedback d-block"
                                        style="display:none;"
                                    ></div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button
                                        type="button"
                                        class="btn btn-link p-0"
                                        id="resend-code-btn"
                                    >
                                        {{ __('Resend') }}
                                    </button>
                                    <button
                                        type="button"
                                        class="site-button btn-sm"
                                        style="font-size: 14px; padding: 8px 16px;"
                                        id="verify-code-btn"
                                    >
                                        {{ __('Verify & Continue') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted small mb-0">
                            {{ __('If you entered the wrong email, you can go back and change it on the registration page.') }}
                        </p>
                        <a href="{{ route('public.account.register') }}" id="back-to-register-link" class="text-decoration-underline small">
                            &larr; {{ __('Back to registration') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Wait for jQuery to load
        (function() {
            'use strict';

            function initVerification() {
                // Check if jQuery is available
                if (typeof jQuery === 'undefined' && typeof window.$ === 'undefined') {
                    console.error('jQuery not loaded, retrying...');
                    setTimeout(initVerification, 100);
                    return;
                }

                const $ = window.jQuery || window.$;
                
                const email = @json($email);
                const verifyEmailCodeUrl = '{{ route('public.account.register.verifyEmailCode') }}';
                const registerUrl = '{{ route('public.account.register.post') }}';
                const getVerificationDataUrl = '{{ route('public.account.register.getVerificationData') }}';
                const sendVerificationCodeUrl = '{{ route('public.account.register.sendVerificationCode') }}';
                const csrfToken = @json(csrf_token());

                function showVerificationError(message, type) {
                const $error = $('#verification-code-error');
                $error.text(message || 'Something went wrong. Please try again.');
                if (type === 'success') {
                    $error.removeClass('text-danger').addClass('text-success');
                } else {
                    $error.removeClass('text-success').addClass('text-danger');
                }
                    $error.show();
                }

                function hideVerificationError() {
                    $('#verification-code-error').hide();
                }

                function verifyCode() {
                console.log('=== verifyCode() Function Started ===');
                const code = $('#verification-code-input').val().trim();
                console.log('OTP Code to verify:', code);
                console.log('Email:', email);
                
                if (!code || code.length !== 6) {
                    console.warn('Invalid code length:', code.length);
                    showVerificationError('Please enter a valid 6-digit verification code.');
                    return;
                }

                console.log('Code validation passed, proceeding with verification...');
                hideVerificationError();
                $('#verify-code-btn').prop('disabled', true).text('Verifying...');

                // First, call verifyEmailCode API to verify the OTP
                console.log('Making AJAX request to verifyEmailCode API...');
                console.log('Request URL:', verifyEmailCodeUrl);
                console.log('Request Data:', {
                    email: email,
                    code: code,
                    _token: csrfToken ? 'SET' : 'NOT SET'
                });
                
                $.ajax({
                    url: verifyEmailCodeUrl,
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        email: email,
                        code: code,
                    },
                    success: function(response) {
                        console.log('=== Verification API Response (Success) ===');
                        console.log('Full Response:', response);
                        console.log('Response Type:', typeof response);
                        console.log('Has Error:', response.error);
                        
                        if (response.error) {
                            console.error('Verification failed:', response.message);
                            showVerificationError(response.message || 'Invalid verification code. Please try again.');
                            $('#verify-code-btn').prop('disabled', false).text('Verify & Continue');
                            return;
                        }

                        // Verification successful - just redirect to next step
                        // Account is already created in sendVerificationCode, no need to register again
                        console.log('✅ Email verified successfully!');
                        console.log('Account already exists, redirecting to next step...');
                        
                        // Clear storage
                        if (typeof Storage !== 'undefined') {
                            localStorage.removeItem('registrationFormData');
                            sessionStorage.removeItem('regStep');
                            console.log('Local storage cleared');
                        }
                        
                        // Redirect directly to institution type page
                        console.log('Redirecting to institution type page...');
                        window.location.href = '{{ route('public.account.register.institutionTypePage') }}';
                    },
                    error: function(xhr) {
                        console.error('=== Verification API Error ===');
                        console.error('Status:', xhr.status);
                        console.error('Status Text:', xhr.statusText);
                        console.error('Response Text:', xhr.responseText);
                        console.error('Response JSON:', xhr.responseJSON);
                        
                        let errorMessage = 'Invalid verification code. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                            console.log('Error message from server:', errorMessage);
                        }
                        showVerificationError(errorMessage);
                        $('#verify-code-btn').prop('disabled', false).text('Verify & Continue');
                    }
                });
                }

                function proceedWithRegistration(code) {
                console.log('=== proceedWithRegistration() Started ===');
                console.log('Code:', code);
                $('#verify-code-btn').text('Loading...');

                // Get verification data to retrieve form data and temp account ID
                console.log('Fetching verification data from API...');
                console.log('Get Verification Data URL:', getVerificationDataUrl);
                
                $.ajax({
                    url: getVerificationDataUrl,
                    type: 'GET',
                    success: function(response) {
                        console.log('=== Get Verification Data Response ===');
                        console.log('Full Response:', response);
                        
                        if (response.error || !response.data) {
                            console.error('Failed to get verification data:', response);
                            showVerificationError('Failed to retrieve registration data. Please go back to registration.');
                            $('#verify-code-btn').prop('disabled', false).text('Verify & Continue');
                            return;
                        }

                        const verificationData = response.data;
                        console.log('Verification Data:', verificationData);
                        console.log('Temp Account:', verificationData.temp_account);
                        
                        let formData = {};
                        
                        if (verificationData.form_data) {
                            try {
                                formData = typeof verificationData.form_data === 'object' 
                                    ? verificationData.form_data 
                                    : JSON.parse(verificationData.form_data);
                                console.log('Form Data parsed:', formData);
                            } catch (e) {
                                console.error('Error parsing form data:', e);
                                formData = {};
                            }
                        } else {
                            console.warn('No form_data in verification data');
                        }

                        console.log('Preparing registration data...');
                        $('#verify-code-btn').text('Registering...');

                        const registrationData = new FormData();
                        registrationData.append('_token', csrfToken);
                        registrationData.append('verification_code', code);
                        registrationData.append('account_type', formData.account_type || 'job-seeker');
                        registrationData.append('full_name', formData.full_name || '');
                        registrationData.append('email', email);
                        registrationData.append('password', formData.password || '');
                        registrationData.append('password_confirmation', formData.password || '');
                        registrationData.append('agree_terms_and_policy', '1');

                        if (verificationData.temp_account && verificationData.temp_account.id) {
                            registrationData.append('temp_account_id', verificationData.temp_account.id);
                        }

                        console.log('Sending registration request...');
                        console.log('Registration URL:', registerUrl);
                        console.log('Registration Data Keys:', Array.from(registrationData.keys()));
                        
                        $.ajax({
                            url: registerUrl,
                            type: 'POST',
                            data: registrationData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                console.log('=== Registration Success ===');
                                console.log('Response:', response);
                                
                                // Clear storage
                                if (typeof Storage !== 'undefined') {
                                    localStorage.removeItem('registrationFormData');
                                    sessionStorage.removeItem('regStep');
                                    console.log('Local storage cleared');
                                }

                                // Check account type and redirect accordingly
                                const accountType = formData.account_type || 'job-seeker';
                                console.log('Account type:', accountType);
                                
                                if (accountType === 'employer') {
                                    console.log('Redirecting employer to institution type page...');
                                    window.location.href = '{{ route('public.account.register.institutionTypePage') }}';
                                } else {
                                    console.log('Redirecting job seeker to institution type page...');
                                    window.location.href = '{{ route('public.account.register.institutionTypePage') }}';
                                }
                            },
                            error: function(xhr) {
                                console.error('=== Registration Error ===');
                                console.error('Status:', xhr.status);
                                console.error('Status Text:', xhr.statusText);
                                console.error('Response Text:', xhr.responseText);
                                console.error('Response JSON:', xhr.responseJSON);
                                
                                let errorMessage = 'Registration failed. Please try again.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                    console.log('Error message:', errorMessage);
                                }
                                showVerificationError(errorMessage);
                                $('#verify-code-btn').prop('disabled', false).text('Verify & Continue');
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Failed to get verification data:', xhr.responseText);
                        showVerificationError('Failed to retrieve registration data. Please go back to registration.');
                        $('#verify-code-btn').prop('disabled', false).text('Verify & Continue');
                    }
                });
                }

                $(document).ready(function() {
                    console.log('Verification page initialized, jQuery loaded successfully');
                    console.log('Email:', email);
                    console.log('Verify URL:', verifyEmailCodeUrl);
                    
                    $('#verify-code-btn').on('click', function(e) {
                        e.preventDefault();
                        console.log('=== Verify Button Clicked ===');
                        console.log('Button clicked at:', new Date().toISOString());
                        
                        const code = $('#verification-code-input').val().trim();
                        console.log('Entered OTP Code:', code);
                        console.log('Code length:', code.length);
                        
                        try {
                            console.log('Calling verifyCode() function...');
                            verifyCode();
                        } catch (error) {
                            console.error('JavaScript Error:', error);
                            console.error('Error stack:', error.stack);
                            showVerificationError('An error occurred. Please try again.');
                            $('#verify-code-btn').prop('disabled', false).text('Verify & Continue');
                        }
                        
                        return false;
                    });

                    // Allow Enter key to submit
                    $('#verification-code-input').on('keypress', function(e) {
                        if (e.which === 13) {
                            e.preventDefault();
                            $('#verify-code-btn').click();
                        }
                    });

                    // Resend code functionality
                    $('#resend-code-btn').on('click', function(e) {
                        e.preventDefault();
                        console.log('=== Resend Code Button Clicked ===');
                        
                        if ($(this).hasClass('disabled')) {
                            console.log('Resend button is disabled, ignoring click');
                            return;
                        }

                        console.log('Resending verification code...');
                        $(this).addClass('disabled').text('Sending...');
                        hideVerificationError();

                        // Get form data from session/API
                        $.ajax({
                            url: getVerificationDataUrl,
                            type: 'GET',
                            success: function(response) {
                                if (response.error || !response.data) {
                                    showVerificationError('Failed to resend code. Please go back to registration.');
                                    $('#resend-code-btn').removeClass('disabled').text('{{ __('Resend') }}');
                                    return;
                                }

                                const formData = response.data.form_data || {};

                                // Resend verification code
                                $.ajax({
                                    url: sendVerificationCodeUrl,
                                    type: 'POST',
                                    data: {
                                        _token: csrfToken,
                                        email: email,
                                        form_data: formData,
                                    },
                                    success: function(response) {
                                        if (response.error) {
                                            showVerificationError(response.message || 'Failed to resend code. Please try again.');
                                        } else {
                                            showVerificationError('Verification code has been resent to your email.', 'success');
                                            $('#verification-code-input').val('').focus();
                                        }
                                        $('#resend-code-btn').removeClass('disabled').text('{{ __('Resend') }}');
                                    },
                                    error: function(xhr) {
                                        console.error('Resend code error:', xhr.responseText);
                                        let errorMessage = 'Failed to resend code. Please try again.';
                                        if (xhr.responseJSON && xhr.responseJSON.message) {
                                            errorMessage = xhr.responseJSON.message;
                                        }
                                        showVerificationError(errorMessage);
                                        $('#resend-code-btn').removeClass('disabled').text('{{ __('Resend') }}');
                                    }
                                });
                            },
                            error: function(xhr) {
                                console.error('Failed to get verification data for resend:', xhr.responseText);
                                showVerificationError('Failed to resend code. Please go back to registration.');
                                $('#resend-code-btn').removeClass('disabled').text('{{ __('Resend') }}');
                            }
                        });
                    });
                });
            }

            // Start initialization when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initVerification);
            } else {
                // DOM is already ready, but wait a bit for jQuery
                setTimeout(initVerification, 100);
            }
        })();
    </script>
