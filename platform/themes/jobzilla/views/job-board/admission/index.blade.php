@php
    Theme::set('pageTitle', __('Admission'));
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
    Theme::layout('default');
@endphp

<style>
.adm-hero {
    background: linear-gradient(165deg, #e8f4fc 0%, #d4ebf7 40%, #b8dff0 100%);
    padding: 90px 0 50px;
    position: relative;
}
.adm-hero h1 { font-size: 32px; font-weight: 800; color: #0c1e3c; margin-bottom: 8px; }
.adm-hero p { color: #475569; font-size: 16px; margin: 0; }
.adm-section { padding: 50px 0; }
.adm-school-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 24px;
    transition: all 0.2s;
}
.adm-school-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.1); border-color: #0073d1; }
.adm-school-header {
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.adm-school-logo {
    width: 64px; height: 64px;
    border-radius: 12px;
    background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.adm-school-logo img { width: 100%; height: 100%; object-fit: contain; }
.adm-school-name { font-size: 18px; font-weight: 700; color: #0c1e3c; margin: 0; }
.adm-school-body { padding: 24px; }
.adm-school-body .content { color: #334155; line-height: 1.7; }
.adm-form-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: 1px solid #e2e8f0;
    padding: 28px;
    margin-top: 30px;
}
.adm-form-card h3 { font-size: 20px; font-weight: 700; color: #0c1e3c; margin-bottom: 20px; }
.adm-form-card .form-label { font-weight: 600; color: #334155; margin-bottom: 6px; }
.adm-form-card .form-control { border-radius: 8px; border: 1px solid #e2e8f0; padding: 10px 14px; }
.adm-form-card .btn-primary { background: #0073d1; border: none; border-radius: 8px; padding: 12px 24px; font-weight: 600; }
.adm-form-card .btn-primary:hover { background: #005bb5; }
.badge-featured { background: #0073d1; color: #fff; font-size: 11px; padding: 4px 8px; border-radius: 6px; }
</style>

<div class="adm-hero">
    <div class="container">
        <h1>{{ __('Admission') }}</h1>
        <p>{{ __('Explore schools and submit your admission enquiry.') }}</p>
    </div>
</div>

@if(session('success_msg'))
    <div class="container mt-3"><div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success_msg') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>
@endif

<div class="container adm-section">
    <div class="row">
        <div class="col-lg-8">
            @forelse($companies as $company)
                @php $admission = $company->admission; @endphp
                <div class="adm-school-card">
                    <div class="adm-school-header">
                        <div class="adm-school-logo">
                            @if($company->logo)
                                <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
                            @else
                                <span style="font-size:24px;color:#94a3b8;">{{ substr($company->name ?? '', 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="adm-school-name">
                                {{ $company->name }}
                                @if($company->is_featured)
                                    <span class="badge-featured ms-2">{{ __('Featured') }}</span>
                                @endif
                            </h2>
                            @if($admission->admission_deadline)
                                <small class="text-muted">{{ __('Admission deadline') }}: {{ $admission->admission_deadline->format('M d, Y') }}</small>
                            @endif
                        </div>
                    </div>
                    @if($admission->content)
                        <div class="adm-school-body">
                            <div class="content">{!! BaseHelper::clean($admission->content) !!}</div>
                        </div>
                    @endif
                    <div class="adm-school-body pt-0">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#enquiry-form-{{ $company->id }}" aria-expanded="false">
                            {{ __('Submit Admission Enquiry') }}
                        </button>
                        <div class="collapse mt-3" id="enquiry-form-{{ $company->id }}">
                            @include(Theme::getThemeNamespace('views.job-board.admission.partials.enquiry-form'), ['company' => $company])
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">{{ __('No schools have published admission information yet.') }}</div>
            @endforelse
        </div>
        <div class="col-lg-4">
            <div class="adm-form-card">
                <h3>{{ __('Admission Enquiry Form') }}</h3>
                <p class="text-muted small mb-3">{{ __('Fill the form below to submit your admission enquiry to a school.') }}</p>
                @if($companies->isNotEmpty())
                <form action="{{ route('public.admission.enquiry') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('Select School') }} <span class="text-danger">*</span></label>
                        <select name="company_id" class="form-control" required>
                            <option value="">{{ __('-- Select School --') }}</option>
                            @foreach($companies as $c)
                                <option value="{{ $c->id }}" {{ old('company_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')<span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
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
                    <button type="submit" class="btn btn-primary w-100">{{ __('Submit Enquiry') }}</button>
                </form>
                @else
                <p class="text-muted small mb-0">{{ __('No schools have published admission information yet.') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
