@php
    $countries = [];
    if (is_plugin_active('location')) {
        $countries = \Botble\Location\Models\Country::query()
            ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
@endphp

<style>
    .employer-location-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f4fc 50%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .employer-location-container {
        width: 100%;
        max-width: 600px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .employer-location-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 30px;
        text-align: center;
    }

    .employer-location-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .employer-location-body {
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

<div class="employer-location-wrapper">
    <div class="employer-location-container">
        <div class="employer-location-header">
            <h2>Location</h2>
            <p style="color: rgba(255,255,255,0.9); margin: 0;">Step 4 of 4</p>
        </div>
        
        <div class="employer-location-body">
            <form method="POST" action="{{ route('public.account.register.employer.saveLocation') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label">Country *</label>
                    <select name="country_id" class="form-select" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">State (Optional)</label>
                    <select name="state_id" class="form-select">
                        <option value="">Select State</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">City (Optional)</label>
                    <select name="city_id" class="form-select">
                        <option value="">Select City</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Complete Registration</button>
            </form>
        </div>
    </div>
</div>
