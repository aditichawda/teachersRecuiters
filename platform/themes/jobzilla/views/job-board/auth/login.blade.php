@php
    Theme::layout('without-navbar');
@endphp

<style>
.tr-login-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f4f8 0%, #e8f4fc 50%, #f5f7fa 100%);
    margin: 0 !important;
    padding: 0 !important;
}

.tr-login-left-panel {
    background: #0073d1 !important;
    position: relative;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    padding: 30px !important;
    overflow: hidden;
    min-height: 100vh;
}

.tr-login-curve {
    position: absolute;
    right: -1px;
    top: 0;
    height: 100%;
    width: 150px;
    z-index: 10;
}

.tr-login-left-content {
    position: relative;
    z-index: 5;
    color: #fff;
    width: 100%;
    max-width: 350px;
    padding: 0 20px;
}

.tr-login-logo img {
    max-width: 160px;
    filter: brightness(0) invert(1);
}

.tr-login-title {
    font-size: 28px;
    font-weight: 700;
    margin: 20px 0 10px 0;
    color: #fff;
    line-height: 1.3;
}

.tr-login-subtitle {
    font-size: 16px;
    opacity: 0.9;
    color: #fff;
    line-height: 1.5;
    margin: 0;
}

.tr-login-right-panel {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px !important;
    background: #fff !important;
    min-height: 100vh;
}

.tr-login-form-container {
    width: 100%;
    max-width: 420px;
}

.tr-login-form-header {
    text-align: center;
    margin-bottom: 25px;
}

.tr-login-form-header h1 {
    color: #0073d1;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 8px 0;
}

.tr-login-form-header p {
    color: #666;
    font-size: 14px;
    margin: 0;
}

/* Form Styles */
.tr-login-form-container .form-group {
    margin-bottom: 18px;
}

.tr-login-form-container .form-group label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin-bottom: 6px;
    display: block;
}

.tr-login-form-container .form-control {
    width: 100%;
    padding: 12px 14px;
    border: 2px solid #e0e8f0;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.tr-login-form-container .form-control:focus {
    border-color: #0073d1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
}

.tr-login-form-container .site-button {
    width: 100%;
    padding: 12px 20px;
    background: #0073d1;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.2s;
}

.tr-login-form-container .site-button:hover {
    background: #005ba8;
}

.tr-login-form-container .form-check {
    display: flex;
    align-items: center;
    gap: 8px;
}

.tr-login-form-container .form-check-input {
    width: 18px;
    height: 18px;
    margin: 0;
}

.tr-login-form-container .form-check-label {
    font-size: 14px;
    color: #555;
}

.tr-login-form-container a {
    color: #0073d1;
    text-decoration: none;
    font-weight: 500;
}

.tr-login-form-container a:hover {
    text-decoration: underline;
}

.tr-login-footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.tr-login-footer p {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.tr-login-footer a {
    color: #0073d1;
    font-weight: 600;
}

/* Hide default form header */
.tr-login-form-container .twm-log-reg-head {
    display: none !important;
}

/* Social Login Buttons */
.tr-login-form-container .social-login-wrap {
    margin-top: 20px;
}

.tr-login-form-container .social-login-wrap .social-login-title {
    text-align: center;
    font-size: 13px;
    color: #888;
    margin-bottom: 15px;
    position: relative;
}

.tr-login-form-container .social-login-wrap .social-login-title::before,
.tr-login-form-container .social-login-wrap .social-login-title::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 30%;
    height: 1px;
    background: #ddd;
}

.tr-login-form-container .social-login-wrap .social-login-title::before {
    left: 0;
}

.tr-login-form-container .social-login-wrap .social-login-title::after {
    right: 0;
}

/* Alert Styles */
.tr-login-form-container .alert {
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.tr-login-form-container .alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.tr-login-form-container .alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.tr-login-form-container .alert-warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

/* Responsive */
@media (max-width: 768px) {
    .tr-login-left-panel {
        display: none !important;
    }
    .tr-login-right-panel {
        padding: 20px !important;
    }
}
</style>

<div class="tr-login-page">
    <div class="container-fluid p-0 m-0">
        <div class="row g-0 m-0" style="min-height:100vh;">
            <!-- Left Panel -->
            <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-flex tr-login-left-panel">
                <svg class="tr-login-curve" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M100,0 L100,100 L30,100 Q-30,50 30,0 Z" fill="#ffffff"/>
                </svg>
                
                <div class="tr-login-left-content">
                    @if (Theme::getLogo())
                        <div class="tr-login-logo">
                            <a href="{{ BaseHelper::getHomepageUrl() }}">
                                {!! Theme::getLogoImage(['class' => 'logo-light'], 'logo', 150) !!}
                            </a>
                        </div>
                    @endif
                    
                    <h2 class="tr-login-title">Welcome Back!</h2>
                    <p class="tr-login-subtitle">Sign in to access your account and explore thousands of teaching opportunities across India.</p>
                </div>
            </div>
            
            <!-- Right Panel -->
            <div class="col-xl-7 col-lg-7 col-md-7 tr-login-right-panel">
                <div class="tr-login-form-container">
                    <div class="tr-login-form-header">
                        <h1>Sign In</h1>
                        <p>Enter your credentials to continue</p>
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

                    {!!
                        $form
                           ->modify('submit', 'submit', [
                                'label' => __('Sign In'),
                                'attr' => [
                                    'class' => 'site-button',
                                ],
                            ], true)
                           ->renderForm()
                     !!}

                    <div class="tr-login-footer">
                        <p>Don't have an account? <a href="{{ route('public.account.register') }}">Register Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
