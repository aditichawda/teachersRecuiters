@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <div class="twm-right-section-panel site-bg-gray">
        {!! Form::open(['route' => 'public.account.post.security', 'method' => 'PUT']) !!}
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ __('Change Password') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 ">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Old Password') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control @if ($errors->has('old_password')) is-invalid @endif" type="password" placeholder="{{ __('Enter Current password') }}" name="old_password"
                                           id="current-password-input" value="{{ old('old_password') }}">
                                    <i class="fs-input-icon fa fa-asterisk "></i>
                                    @error('old_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ __('New Password') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control @if ($errors->has('password')) is-invalid @endif" type="password" placeholder="{{ __('Enter new password') }}" name="password"
                                           id="new-password-input" value="{{ old('password') }}">
                                    <i class="fs-input-icon fa fa-asterisk"></i>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ __('Confirm Password') }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control @if ($errors->has('password_confirmation')) is-invalid @endif" type="password" placeholder="{{ __('Enter confirm Password') }}" name="password_confirmation"
                                           id="confirm-password-input" value="{{ old('password_confirmation') }}">
                                    <i class="fs-input-icon fa fa-asterisk"></i>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" class="site-button">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
