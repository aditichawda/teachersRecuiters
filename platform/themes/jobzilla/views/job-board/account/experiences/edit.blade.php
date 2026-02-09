@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
<style>
    .exp-form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .exp-form-header {
        background: linear-gradient(135deg, #64b5f6, #1967d2, #0d47a1);
        color: #fff;
        padding: 20px 24px;
    }
    .exp-form-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    .exp-form-header p {
        font-size: 13px;
        opacity: 0.85;
        margin: 4px 0 0 0;
    }
    .exp-form-body {
        padding: 24px;
    }
    .exp-form-body .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }
    .exp-form-body .form-label .required {
        color: #dc3545;
    }
    .exp-form-body .form-control,
    .exp-form-body .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .exp-form-body .form-control:focus,
    .exp-form-body .form-select:focus {
        border-color: #e65100;
        box-shadow: 0 0 0 3px rgba(230,81,0,0.1);
    }
    .exp-form-body .form-check-input:checked {
        background-color: #e65100;
        border-color: #e65100;
    }
    .exp-form-footer {
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-save-exp {
        background: #1967d2;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-save-exp:hover {
        background: #1967d2;
    }
    .btn-back-exp {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-back-exp:hover {
        color: #e65100;
    }
</style>

<div class="exp-form-card">
    <div class="exp-form-header">
        <h3><i class="fa fa-briefcase me-2"></i>{{ __('Edit Experience') }}</h3>
        <p>{{ __('Update your work experience details') }}</p>
    </div>
    <form action="{{ route('public.account.experiences.update', $experience->id) }}" method="POST">
        @csrf
        <div class="exp-form-body">
            <div class="row">
                <!-- Company -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="company">{{ __('School / Institution / Company Name') }} <span class="required">*</span></label>
                    <input type="text" class="form-control @error('company') is-invalid @enderror" id="company"
                           name="company" value="{{ old('company', $experience->company) }}" placeholder="{{ __('e.g. DPS School, ABC College') }}"/>
                    @error('company')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Position -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="position">{{ __('Position / Designation') }}</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                           name="position" value="{{ old('position', $experience->position) }}" placeholder="{{ __('e.g. Mathematics Teacher, Principal') }}"/>
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Employment Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Employment Type') }}</label>
                    <select class="form-select @error('employment_type') is-invalid @enderror" name="employment_type">
                        <option value="">{{ __('Select Type') }}</option>
                        @foreach(['full_time' => 'Full Time', 'part_time' => 'Part Time', 'contract' => 'Contract', 'internship' => 'Internship', 'freelance' => 'Freelance'] as $val => $lbl)
                            <option value="{{ $val }}" @selected(old('employment_type', $experience->employment_type) == $val)>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    @error('employment_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Location -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="location">{{ __('Location') }}</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                           name="location" value="{{ old('location', $experience->location) }}" placeholder="{{ __('e.g. New Delhi, Mumbai') }}"/>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Currently Working -->
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_current" name="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }} onchange="toggleEndDate(this)">
                        <label class="form-check-label" for="is_current">{{ __('I am currently working here') }}</label>
                    </div>
                </div>

                <!-- Start Date -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="started_at">{{ __('Start Date') }} <span class="required">*</span></label>
                    <input type="date" class="form-control @error('started_at') is-invalid @enderror" id="started_at"
                           name="started_at" value="{{ old('started_at', $experience->started_at->format('Y-m-d')) }}" />
                    @error('started_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="col-md-6 mb-3" id="end-date-wrapper">
                    <label class="form-label" for="ended_at">{{ __('End Date') }}</label>
                    <input type="date" class="form-control @error('ended_at') is-invalid @enderror" id="ended_at"
                           name="ended_at" value="{{ old('ended_at', $experience->ended_at ? $experience->ended_at->format('Y-m-d') : '') }}" />
                    @error('ended_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="{{ __('Describe your role, responsibilities, and achievements') }}">{{ old('description', $experience->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="exp-form-footer">
            <a href="{{ route('public.account.experiences.index') }}" class="btn-back-exp">
                <i class="fa fa-arrow-left"></i> {{ __('Back to List') }}
            </a>
            <button type="submit" class="btn-save-exp">
                <i class="fa fa-save me-1"></i> {{ __('Update Experience') }}
            </button>
        </div>
    </form>
</div>

<script>
function toggleEndDate(checkbox) {
    const wrapper = document.getElementById('end-date-wrapper');
    if (checkbox.checked) {
        wrapper.style.opacity = '0.5';
        wrapper.querySelector('input').disabled = true;
        wrapper.querySelector('input').value = '';
    } else {
        wrapper.style.opacity = '1';
        wrapper.querySelector('input').disabled = false;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const cb = document.getElementById('is_current');
    if (cb && cb.checked) toggleEndDate(cb);
});
</script>
@endsection
