@php
    Theme::layout('without-navbar');
@endphp

<!-- START SIGN-UP -->
<section class="bg-auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="card auth-box">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-center">
                            <div class="card-body p-4">
                                @if (Theme::getLogo())
                                    <a href="{{ BaseHelper::getHomepageUrl() }}">
                                        {!! Theme::getLogoImage(['class' => 'logo-dark'], 'logo', 70) !!}
                                    </a>
                                @endif
                                <div class="mt-5">
                                    @if (theme_option('sign_up_page_image'))
                                        <img src="{{ RvMedia::getImageUrl(theme_option('sign_up_page_image')) }}" alt="background" class="img-fluid">
                                    @else
                                        <img src="{{ Theme::asset()->url('images/auth/sign-up.png') }}" alt="background" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="auth-content card-body p-5 text-white">
                                <div class="w-100">
                                    <div class="text-center">
                                        <h5>{{ __("Let's Get Started") }}</h5>
                                        <p class="text-white-70">{{ __('Sign Up to get access to all our features') }}</p>
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
                                        $form->renderForm()
                                    !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end auth-box-->
            </div>
        </div>
    </div>
</section>
<!-- END SIGN-UP -->
