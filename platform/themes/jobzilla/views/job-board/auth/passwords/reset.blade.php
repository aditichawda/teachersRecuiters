@php
    Theme::layout('without-navbar');
@endphp

<style>
.rp-wrapper { min-height: 100vh; background: #f5f7fa; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
.rp-container { width: 100%; max-width: 500px; background: #fff; border-radius: 14px; box-shadow: 0 15px 35px -10px rgba(0,0,0,.15); overflow: hidden; }
.rp-header { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); padding: 25px 30px; text-align: center; }
.rp-header h2 { color: #fff; font-size: 24px; font-weight: 700; margin-bottom: 5px; }
.rp-header p { color: rgba(255,255,255,.9); font-size: 14px; margin: 0; }
.rp-body { padding: 30px; }
.rp-body .form-group { margin-bottom: 16px; }
.rp-body .form-label { font-weight: 600; color: #222; margin-bottom: 6px; font-size: 14px; }
.rp-body .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 12px 14px; height: 40px; font-size: 14px; color: #000 !important; background: #fff !important; }
.rp-body .form-control::placeholder { color: #666; }
.rp-body .form-control:focus { border-color: #0073d1; box-shadow: 0 0 0 3px rgba(0,115,209,.1); }
.btn-rp { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); border: none; border-radius: 8px; padding: 12px 25px; font-size: 15px; font-weight: 600; width: 100%; color: #fff; cursor: pointer; transition: all .3s; }
.btn-rp:hover { background: linear-gradient(135deg, #005bb5 0%, #004a94 100%); transform: translateY(-1px); }
.rp-footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; font-size: 14px; color: #666; }
.rp-footer a { color: #0073d1; font-weight: 600; text-decoration: none; }
.alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; }
.alert-danger { background: #f8d7da; color: #721c24; }
</style>

<div class="rp-wrapper">
    <div class="rp-container">
        <div class="rp-header">
            <h2><i class="ti ti-lock me-2"></i>{{ __('Reset Password') }}</h2>
            <p>{{ __('Enter new password') }}</p>
        </div>
        <div class="rp-body">
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
                        'label' => __('Reset Password'),
                        'attr' => ['class' => 'btn-rp'],
                    ], true)
                    ->renderForm()
            !!}

            <div class="rp-footer">
                <a href="{{ route('public.account.login') }}"><i class="ti ti-arrow-left me-1"></i> {{ __('Back to Login') }}</a>
            </div>
        </div>
    </div>
</div>
