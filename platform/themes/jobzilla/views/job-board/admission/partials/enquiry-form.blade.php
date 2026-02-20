<form action="{{ route('public.admission.enquiry') }}" method="POST" class="admission-enquiry-form">
    @csrf
    <input type="hidden" name="company_id" value="{{ $company->id }}">
    <div class="mb-3">
        <label class="form-label">{{ __('Student Name') }} <span class="text-danger">*</span></label>
        <input type="text" name="student_name" class="form-control" required maxlength="255" value="{{ old('student_name') }}" placeholder="{{ __('Student Name') }}">
        @error('student_name')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Contact Number') }} <span class="text-danger">*</span></label>
        <input type="text" name="contact_number" class="form-control" required maxlength="50" value="{{ old('contact_number') }}" placeholder="{{ __('Contact Number') }}">
        @error('contact_number')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="{{ __('Email Address') }}">
        @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Admission for which standard') }}</label>
        <input type="text" name="admission_for_standard" class="form-control" maxlength="100" value="{{ old('admission_for_standard') }}" placeholder="{{ __('e.g. Class 1, Grade 6') }}">
        @error('admission_for_standard')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Address') }}</label>
        <textarea name="address" class="form-control" rows="2" maxlength="500" placeholder="{{ __('Address') }}">{{ old('address') }}</textarea>
        @error('address')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Message') }}</label>
        <textarea name="message" class="form-control" rows="3" maxlength="2000" placeholder="{{ __('Message') }}">{{ old('message') }}</textarea>
        @error('message')<span class="text-danger small">{{ $message }}</span>@enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ __('Submit Enquiry') }}</button>
</form>
