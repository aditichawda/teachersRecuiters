<style>
    .employer-verify-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f4fc 50%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .employer-verify-container {
        width: 100%;
        max-width: 500px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .employer-verify-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 30px;
        text-align: center;
    }

    .employer-verify-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .employer-verify-body {
        padding: 40px;
        text-align: center;
    }

    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 30px 0;
    }

    .otp-inputs input {
        width: 50px;
        height: 55px;
        text-align: center;
        font-size: 24px;
        font-weight: 600;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
    }

    .verify-btn {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        border-radius: 10px;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 600;
        width: 100%;
        color: #fff;
        cursor: pointer;
    }
</style>

<div class="employer-verify-wrapper">
    <div class="employer-verify-container">
        <div class="employer-verify-header">
            <h2>Verify Your Email</h2>
            <p style="color: rgba(255,255,255,0.9); margin: 0;">Step 2 of 4</p>
        </div>
        
        <div class="employer-verify-body">
            <p>Verification code sent to: <strong>{{ $email }}</strong></p>
            <p class="text-muted">Enter the 6-digit code</p>

            <form id="otp-form" method="POST" action="{{ route('public.account.register.employer.verifyEmailCode') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div class="otp-inputs">
                    <input type="text" maxlength="1" class="otp-digit" name="otp[]">
                    <input type="text" maxlength="1" class="otp-digit" name="otp[]">
                    <input type="text" maxlength="1" class="otp-digit" name="otp[]">
                    <input type="text" maxlength="1" class="otp-digit" name="otp[]">
                    <input type="text" maxlength="1" class="otp-digit" name="otp[]">
                    <input type="text" maxlength="1" class="otp-digit" name="otp[]">
                </div>
                <input type="hidden" name="code" id="full-code">

                <button type="submit" class="verify-btn">Verify & Continue</button>
            </form>
        </div>
    </div>
</div>
