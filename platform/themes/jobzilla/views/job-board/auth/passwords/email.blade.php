@php
    Theme::layout('without-navbar');
@endphp

<style>
.fp-wrapper { min-height: 100vh; background: #f5f7fa; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
.fp-container { width: 100%; max-width: 500px; background: #fff; border-radius: 14px; box-shadow: 0 15px 35px -10px rgba(0,0,0,.15); overflow: hidden; }
.fp-header { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); padding: 25px 30px; text-align: center; }
.fp-header h2 { color: #fff; font-size: 24px; font-weight: 700; margin-bottom: 5px; }
.fp-header p { color: rgba(255,255,255,.9); font-size: 14px; margin: 0; }
.fp-body { padding: 30px; }
.fp-body .form-group { margin-bottom: 16px; }
.fp-body .form-label { font-weight: 600; color: #434343; margin-bottom: 6px; font-size: 14px; }
.fp-body .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 12px 14px; height: 40px; font-size: 14px; color: #000 !important; background: #fff !important; }
.fp-body .form-control::placeholder { color: #666; }
.fp-body .form-control:focus { border-color: #0073d1; box-shadow: 0 0 0 3px rgba(0,115,209,.1); }
.btn-fp { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); border: none; border-radius: 8px; padding: 12px 25px; font-size: 15px; font-weight: 600; width: 100%; color: #fff; cursor: pointer; transition: all .3s; }
.btn-fp:hover { background: linear-gradient(135deg, #005bb5 0%, #004a94 100%); transform: translateY(-1px); }
.fp-footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; font-size: 14px; color: #666; }
.fp-footer a { color: #0073d1; font-weight: 600; text-decoration: none; }
.fp-footer a:hover { text-decoration: underline; }
.alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
</style>

<div class="fp-wrapper">
    <div class="fp-container">
        <div class="fp-header">
            <h2><i class="ti ti-key me-2"></i>{{ __('Forgot Password') }}</h2>
            <p>{{ __('Enter your email to receive reset link') }}</p>
        </div>
        <div class="fp-body">
            @if (session()->has('status'))
                <div role="alert" class="alert alert-success">{{ session('status') }}</div>
            @elseif (session()->has('auth_error_message'))
                <div role="alert" class="alert alert-danger">{{ session('auth_error_message') }}</div>
            @elseif (session()->has('auth_success_message'))
                <div role="alert" class="alert alert-success">{{ session('auth_success_message') }}</div>
            @elseif (session()->has('auth_warning_message'))
                <div role="alert" class="alert alert-warning">{{ session('auth_warning_message') }}</div>
            @endif

            @if ($errors->any())
                <div role="alert" class="alert alert-danger">
                    @foreach ($errors->all() as $err) {{ $err }}@if(!$loop->last)<br>@endif @endforeach
                </div>
            @endif

            {!!
                $form
                    ->modify('submit', 'submit', [
                        'label' => __('Send Password Reset Link'),
                        'attr' => ['class' => 'btn-fp'],
                    ], true)
                    ->renderForm()
            !!}

            <div class="fp-footer">
                <a href="{{ route('public.account.login') }}"><i class="ti ti-arrow-left me-1"></i> {{ __('Back to Login') }}</a>
            </div>
        </div>
    </div>
</div>
