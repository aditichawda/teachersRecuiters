@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
<style>
    .edu-form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .edu-form-header {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        padding: 20px 24px;
    }
    .edu-form-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    .edu-form-header p {
        font-size: 13px;
        opacity: 0.85;
        margin: 4px 0 0 0;
    }
    .edu-form-body {
        padding: 24px;
    }
    .edu-form-body .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }
    .edu-form-body .form-label .required {
        color: #dc3545;
    }
    .edu-form-body .form-control,
    .edu-form-body .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 14px;
        height: 40px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .edu-form-body .form-control:focus,
    .edu-form-body .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .edu-form-body .form-check-input:checked {
        background-color: #0073d1;
        border-color: #0073d1;
    }
    .edu-form-footer {
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-save-edu {
        background: #0073d1;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-save-edu:hover {
        background: #005bb5;
    }
    .btn-back-edu {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-back-edu:hover {
        color: #0073d1;
    }
</style>

<div class="edu-form-card">
    <div class="edu-form-header">
        <h3><i class="fa fa-graduation-cap me-2"></i>{{ __('Add Education') }}</h3>
        <p>{{ __('Add your educational qualification details') }}</p>
    </div>
    <form action="{{ route('public.account.educations.store') }}" method="POST">
        @csrf
        <div class="edu-form-body">
            <div class="row">
                <!-- Level -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Degree Level') }} <span class="required">*</span></label>
                    <select class="form-select @error('level') is-invalid @enderror" name="level">
                        <option value="">{{ __('Select Level') }}</option>
                        @foreach(['diploma' => 'Diploma', 'bachelors' => 'Bachelors', 'masters' => 'Masters', 'doctorate' => 'Doctorate'] as $val => $lbl)
                            <option value="{{ $val }}" @selected(old('level') == $val)>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Institution -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="school">{{ __('Institution/School Name') }} <span class="required">*</span></label>
                    <input type="text" class="form-control @error('school') is-invalid @enderror" id="school"
                           name="school" value="{{ old('school') }}" placeholder="{{ __('e.g. Delhi University') }}"/>
                    @error('school')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Specialization -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="specialized">{{ __('Specialization / Subject') }}</label>
                    <input type="text" class="form-control @error('specialized') is-invalid @enderror" id="specialized"
                           name="specialized" value="{{ old('specialized') }}" placeholder="{{ __('e.g. Mathematics, English, Education') }}"/>
                    @error('specialized')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Currently Studying -->
                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_current" name="is_current" value="1" {{ old('is_current') ? 'checked' : '' }} onchange="toggleEndDate(this)">
                        <label class="form-check-label" for="is_current">{{ __('I am currently studying here') }}</label>
                    </div>
                </div>

                <!-- Start Date -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="started_at">{{ __('Start Date') }} <span class="required">*</span></label>
                    <input type="date" class="form-control @error('started_at') is-invalid @enderror" id="started_at"
                           name="started_at" value="{{ old('started_at') }}" />
                    @error('started_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="col-md-6 mb-3" id="end-date-wrapper">
                    <label class="form-label" for="ended_at">{{ __('End Date') }}</label>
                    <input type="date" class="form-control @error('ended_at') is-invalid @enderror" id="ended_at"
                           name="ended_at" value="{{ old('ended_at') }}" />
                    @error('ended_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="{{ __('Describe your studies, achievements, etc.') }}">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="edu-form-footer">
            <a href="{{ route('public.account.educations.index') }}" class="btn-back-edu">
                <i class="fa fa-arrow-left"></i> {{ __('Back to List') }}
            </a>
            <button type="submit" class="btn-save-edu">
                <i class="fa fa-save me-1"></i> {{ __('Save Education') }}
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
