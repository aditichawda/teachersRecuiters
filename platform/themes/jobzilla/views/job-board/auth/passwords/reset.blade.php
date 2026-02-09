@php
    Theme::layout('without-navbar');
@endphp

<!-- Login Section Start -->
<div class="section-full site-bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                <div class="twm-log-reg-media">
                    <div class="twm-l-media">
                        @if (theme_option('reset_password_page_image'))
                            <img src="{{ RvMedia::getImageUrl(theme_option('reset_password_page_image')) }}" alt="background">
                        @else
                            <img src="{{ Theme::asset()->url('images/login-bg.png') }}" alt="background">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7">
                <div class="twm-log-reg-form-wrap">
                    <div class="twm-log-reg-inner">
                        <div class="twm-log-reg-head">
                            <div class="twm-log-reg-logo">
                                <span class="log-reg-form-title">{{ SeoHelper::getTitle() }}</span>
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


                        {!!
                            $form
                               ->modify('submit', 'submit', [
                                    'label' => __('Reset Password'),
                                    'attr' => [
                                        'class' => 'site-button',
                                    ],
                                ], true)
                               ->renderForm()
                         !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->
