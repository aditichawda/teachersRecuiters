@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
<style>
.adm-edit-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); border: 1px solid #f0f0f0; padding: 24px; margin-bottom: 24px; }
.adm-edit-card h4 { font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px; }
.adm-edit-card .form-label { font-weight: 600; color: #333; margin-bottom: 6px; }
.adm-edit-card .form-control, .adm-edit-card .form-select { border-radius: 8px; border: 1px solid #e0e0e0; padding: 10px 14px; }
.adm-edit-card .btn-primary { background: #0073d1; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 600; }
.adm-edit-card .btn-primary:hover { background: #005bb5; }
</style>

@if(session('success_msg'))
    <div class="alert alert-success">{{ session('success_msg') }}</div>
@endif
@if(session('error_msg'))
    <div class="alert alert-danger">{{ session('error_msg') }}</div>
@endif

<div class="adm-edit-card">
    <h4><i class="fa fa-graduation-cap"></i> {{ __('Admission Details') }}</h4>
    <p class="text-muted small">{{ __('This content will be shown on the public Admission page for your institution.') }}</p>

    <form action="{{ route('public.account.admission.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('Admission content / details') }}</label>
            <textarea name="content" class="form-control" rows="8" placeholder="{{ __('Enter admission information, eligibility, process, documents required, etc.') }}">{{ old('content', $admission->content) }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('Admission deadline (optional)') }}</label>
                <input type="date" name="admission_deadline" class="form-control" value="{{ old('admission_deadline', $admission->admission_deadline?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('Status') }}</label>
                <select name="status" class="form-select">
                    <option value="published" {{ old('status', $admission->status) === 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                    <option value="draft" {{ old('status', $admission->status) === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                </select>
                <small class="text-muted">{{ __('Published admission will appear on the Admission page.') }}</small>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Save Admission Details') }}</button>
        <a href="{{ route('public.admission') }}" class="btn btn-outline-secondary ms-2" target="_blank">{{ __('View Admission Page') }}</a>
    </form>
</div>
@endsection
