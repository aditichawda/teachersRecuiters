@php
    $standardOptions = [
        'Play Group',
        'Nursery',
        'LKG(PP-1)',
        'UKG(PP-2)',
        '1st Grade',
        '2nd Grade',
        '3rd Grade',
        '4th Grade',
        '5th Grade',
        '6th Grade',
        '7th Grade',
        '8th Grade',
        '9th Grade',
        '10th Grade',
        '11th Grade',
        'Bachelors',
        'Masters',
        'Diploma',
        'Doctorate',
    ];
@endphp
<form action="{{ route('public.admission.enquiry') }}" method="POST" class="admission-enquiry-form">
    @csrf
    <input type="hidden" name="company_id" value="{{ $company->id }}">
    <div class="row g-2 mb-2">
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('Student Name') }} <span class="text-danger">*</span></label>
            <input type="text" name="student_name" class="form-control" required maxlength="255" value="{{ old('student_name') }}" placeholder="{{ __('Student Name') }}"
                   title="{{ __('Enter student name here') }}">
            @error('student_name')<span class="text-danger small">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('Contact Number') }} <span class="text-danger">*</span></label>
            <input type="tel" name="contact_number" class="form-control" required maxlength="50" value="{{ old('contact_number') }}" placeholder="{{ __('Enter Parent\'s contact number') }}"
                   title="{{ __('Enter Parent\'s contact number') }}">
            @error('contact_number')<span class="text-danger small">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('Email Address') }}</label>
            <input type="email" name="email" class="form-control" maxlength="255" value="{{ old('email') }}" placeholder="{{ __('Enter Parent\'s email address') }}"
                   title="{{ __('Enter Parent\'s email address') }}">
            @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('Age') }} <span class="text-danger">*</span></label>
            <input type="text" name="age" class="form-control" required maxlength="50" value="{{ old('age') }}" placeholder="{{ __('Enter student age as of today\'s date') }}"
                   title="{{ __('Enter student age as of today\'s date') }}">
            @error('age')<span class="text-danger small">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Looking admission for which standard') }} <span class="text-danger">*</span></label>
        <select name="admission_for_standard" class="form-select" required title="{{ __('Are you looking admission for which grade') }}">
            <option value="">{{ __('Select standard') }}</option>
            @foreach($standardOptions as $opt)
                <option value="{{ $opt }}" {{ old('admission_for_standard') === $opt ? 'selected' : '' }}>{{ __($opt) }}</option>
            @endforeach
        </select>
        @error('admission_for_standard')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Address') }} <span class="text-danger">*</span></label>
        <textarea name="address" class="form-control" rows="2" required maxlength="500" placeholder="{{ __('Enter your current State, City, and Locality') }}" title="{{ __('Enter your current State, City, and Locality') }}">{{ old('address') }}</textarea>
        @error('address')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Message') }}</label>
        <textarea name="message" class="form-control" rows="3" maxlength="2000" placeholder="{{ __('Message (optional)') }}">{{ old('message') }}</textarea>
        @error('message')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ __('Submit Enquiry') }}</button>
</form>
