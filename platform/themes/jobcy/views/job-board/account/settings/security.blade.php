@php
    Theme::set('pageTitle', __('Security'));
@endphp
<!-- START PROFILE -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include(Theme::getThemeNamespace('views.job-board.account.sidebar'))
            </div>

            <div class="col-lg-8">
                <div class="card profile-content-page mt-4 mt-lg-0">
                    <ul class="profile-content-nav nav nav-pills border-bottom mb-4" id="pills-tab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="change-password-tab" data-bs-toggle="pill"
                                    data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password"
                                    aria-selected="true">
                                    {{ __('Change Password') }}
                                </button>
                            </li>
                    </ul>
                        <!--end profile-content-nav-->
                    <div class="card-body p-4">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                {!! Form::open(['route' => 'public.account.post.security', 'method' => 'PUT']) !!}
                                    <!--end social-media-->
                                    <div class="mt-4">
                                        <h5 class="fs-17 fw-semibold mb-3 mb-3">
                                            {{ __('Change Password') }}
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="current-password-input" class="form-label">{{ __('Current password') }}</label>
                                                    <input type="password" class="form-control @if ($errors->has('old_password')) is-invalid @endif"
                                                        placeholder="{{ __('Enter Current password') }}" name="old_password"
                                                        id="current-password-input" />
                                                    @if ($errors->has('old_password'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('old_password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="new-password-input" class="form-label">{{ __('New password') }}</label>
                                                    <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                        placeholder="{{ __('Enter new password') }}" name="password"
                                                        id="new-password-input" />
                                                    @if ($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="confirm-password-input" class="form-label">{{ __('Confirm Password') }}</label>
                                                    <input type="password" class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                                        placeholder="{{ __('Enter confirm Password') }}" name="password_confirmation"
                                                        id="confirm-password-input" />
                                                    @if ($errors->has('password_confirmation'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('password_confirmation') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!--end Change-password-->
                                    <div class="mt-4 text-end">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                {!! Form::close() !!}
                                <!--end form-->
                            </div>
                            <!--end tab-pane-->
                        </div>
                        <!--end tab-content-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end profile-content-page-->
            </div>

        </div>

    </div>

</section>
<!-- END PROFILE -->
