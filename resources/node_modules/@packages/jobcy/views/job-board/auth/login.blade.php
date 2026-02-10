@php
    Theme::layout('without-navbar');
@endphp

<!-- START SIGN-IN -->
<section class="bg-auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="card auth-box">
                    <div class="row g-0">
                        <div class="col-lg-6 text-center">
                            <div class="card-body p-4">
                                @if (Theme::getLogo())
                                    <a href="{{ BaseHelper::getHomepageUrl() }}">
                                        {!! Theme::getLogoImage(['class' => 'logo-dark'], 'logo', 70) !!}
                                    </a>
                                @endif
                                <div class="mt-5">
                                    @if (theme_option('sign_in_page_image'))
                                        <img src="{{ RvMedia::getImageUrl(theme_option('sign_in_page_image')) }}" alt="background" class="img-fluid">
                                    @else
                                        <img src="{{ Theme::asset()->url('images/auth/sign-in.png') }}" alt="background" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="auth-content card-body p-5 h-100 text-white">
                                <div class="w-100">
                                    <div class="text-center mb-4">
                                        <h5>{{ __('Welcome Back !') }}</h5>
                                        <p class="text-white-70">{{ __('Sign in to continue.') }}</p>
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
<!-- END SIGN-IN -->
