<style>
    .employer-register-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f4fc 50%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .employer-register-container {
        width: 100%;
        max-width: 700px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .employer-register-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 30px 40px;
        text-align: center;
    }

    .employer-register-header h2 {
        color: #ffffff;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .employer-register-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
        margin: 0;
    }

    .employer-register-body {
        padding: 40px;
    }

    .employer-register-body .form-group {
        margin-bottom: 20px;
    }

    .employer-register-body .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 8px;
    }

    .employer-register-body .form-control,
    .employer-register-body .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 15px;
        transition: all 0.3s ease;
        color: #434343;
    }

    .employer-register-body .form-control:focus,
    .employer-register-body .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .employer-register-body .btn-primary,
    .employer-register-body button[type="submit"] {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 15px 30px !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        width: 100% !important;
        margin-top: 20px !important;
        color: #fff !important;
    }

    .employer-register-body .btn-primary:hover,
    .employer-register-body button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 115, 209, 0.3);
        background: linear-gradient(135deg, #005bb5 0%, #004a94 100%) !important;
    }

    .employer-logo {
        text-align: center;
        margin-bottom: 25px;
    }

    .employer-logo a {
        font-size: 26px;
        font-weight: 700;
        color: #434343;
        text-decoration: none;
    }

    .employer-logo a span {
        color: #0073d1;
    }

    .employer-register-body .text-center a {
        color: #0073d1;
        font-weight: 600;
    }

    .employer-register-body .text-center a:hover {
        color: #005bb5;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .employer-register-container {
            margin: 20px;
        }

        .employer-register-header {
            padding: 25px 20px;
        }

        .employer-register-body {
            padding: 25px 20px;
        }
    }
</style>

<div class="employer-register-wrapper">
    <div class="employer-register-container">
        <div class="employer-register-header">
            <h2><i class="ti ti-briefcase me-2"></i>Employer Registration</h2>
            <p>Hire the best teachers for your institution</p>
        </div>
        
        <div class="employer-register-body">
            <div class="employer-logo">
                <a href="{{ route('public.index') }}">
                    <span>Teachers</span>Recruiter
                </a>
            </div>

            @if (session()->has('status'))
                <div role="alert" class="alert alert-success">
                    {{ session('status') }}
                </div>
            @elseif (session()->has('error'))
                <div role="alert" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @elseif (session()->has('success'))
                <div role="alert" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {!! $form->renderForm() !!}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Registering...';
            }
        });
    }
});
</script>
