<style>
    .employer-institution-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f4fc 50%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .employer-institution-container {
        width: 100%;
        max-width: 600px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .employer-institution-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 30px;
        text-align: center;
    }

    .employer-institution-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .employer-institution-body {
        padding: 40px;
    }

    .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 15px;
    }

    .submit-btn {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        border-radius: 10px;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 600;
        width: 100%;
        color: #fff;
        cursor: pointer;
        margin-top: 20px;
    }
</style>

<div class="employer-institution-wrapper">
    <div class="employer-institution-container">
        <div class="employer-institution-header">
            <h2>Institution Details</h2>
            <p style="color: rgba(255,255,255,0.9); margin: 0;">Step 3 of 4</p>
        </div>
        
        <div class="employer-institution-body">
            <form method="POST" action="{{ route('public.account.register.employer.saveInstitutionType') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label">Institution Type *</label>
                    <select name="institution_type" class="form-select" required>
                        <option value="">Select Institution Type</option>
                        @foreach($institutionTypes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Institution Name *</label>
                    <input type="text" name="institution_name" class="form-control" required>
                </div>

                <button type="submit" class="submit-btn">Continue</button>
            </form>
        </div>
    </div>
</div>
