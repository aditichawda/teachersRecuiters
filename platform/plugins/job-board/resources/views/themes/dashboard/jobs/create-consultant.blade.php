@php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
@endphp

@extends($layout)

@section('content')
<style>
    .jp-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        padding: 28px;
        margin-bottom: 24px;
    }
    .jp-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f0f0;
    }
    .jp-card-title i { color: #E32526; margin-right: 8px; }
    .jp-label { font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 14px; }
    .jp-label .required { color: #E32526; }
    .jp-input, .jp-select, .jp-textarea {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: border-color 0.2s;
        background: #fff;
    }
    .jp-input:focus, .jp-select:focus, .jp-textarea:focus {
        border-color: #E32526;
        outline: none;
        box-shadow: 0 0 0 3px rgba(227,37,38,0.08);
    }
    .jp-textarea { min-height: 120px; resize: vertical; }
    .jp-group { margin-bottom: 20px; }
    .jp-row { display: flex; gap: 20px; flex-wrap: wrap; }
    .jp-col-6 { flex: 0 0 calc(50% - 10px); max-width: calc(50% - 10px); }
    .jp-col-4 { flex: 0 0 calc(33.33% - 14px); max-width: calc(33.33% - 14px); }
    .jp-col-12 { flex: 0 0 100%; max-width: 100%; }
    @media (max-width: 768px) {
        .jp-col-6, .jp-col-4 { flex: 0 0 100%; max-width: 100%; }
    }
    .jp-submit-btn {
        background: #E32526; color: #fff; border: none; padding: 14px 40px;
        border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
        transition: all 0.2s;
    }
    .jp-submit-btn:hover { background: #c41e1f; transform: translateY(-1px); }
    .jp-submit-btn:disabled { background: #ccc; cursor: not-allowed; transform: none; }
</style>

<form id="jobPostForm" method="POST" action="{{ route('public.account.jobs.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- SECTION 1: Basic Job Details (no credits / featured) --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-briefcase"></i> {{ __('Job Details') }}</div>

        <div class="jp-group">
            <label class="jp-label">{{ __('Job Title') }} <span class="required">*</span></label>
            <input type="text" name="name" class="jp-input" value="{{ old('name', $job->name ?? '') }}" required>
        </div>

        <div class="jp-group">
            <label class="jp-label">{{ __('Job Description') }} <span class="required">*</span></label>
            <textarea name="content" class="jp-textarea" rows="6" required>{{ old('content', $job->content ?? '') }}</textarea>
        </div>

        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">{{ __('Location') }} <span class="required">*</span></label>
                    <input type="text" name="address" class="jp-input" value="{{ old('address', $job->address ?? '') }}" required>
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">{{ __('Number of positions') }}</label>
                    <input type="number" name="number_of_positions" min="1" class="jp-input" value="{{ old('number_of_positions', $job->number_of_positions ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: Salary (simple) --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-currency-rupee"></i> {{ __('Salary Details') }}</div>
        <div class="jp-row">
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">{{ __('Minimum salary') }}</label>
                    <input type="number" name="salary_from" class="jp-input" value="{{ old('salary_from', $job->salary_from ?? '') }}" min="0">
                </div>
            </div>
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">{{ __('Maximum salary') }}</label>
                    <input type="number" name="salary_to" class="jp-input" value="{{ old('salary_to', $job->salary_to ?? '') }}" min="0">
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 3: Apply details (only basic email / URL – no WhatsApp credits) --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-mail"></i> {{ __('How should candidates apply?') }}</div>

        <div class="jp-group">
            <label class="jp-label">{{ __('Application email') }} <span class="required">*</span></label>
            <input type="email" name="apply_other_email" class="jp-input" value="{{ old('apply_other_email', $job->apply_other_email ?? $account->email) }}" required>
        </div>

        <div class="jp-group">
            <label class="jp-label">{{ __('Or external apply URL (optional)') }}</label>
            <input type="url" name="apply_url" class="jp-input" value="{{ old('apply_url', $job->apply_url ?? '') }}" placeholder="https://...">
        </div>
    </div>

    {{-- SECTION 4: Submit --}}
    <div class="jp-card" style="text-align: center;">
        <button type="submit" class="jp-submit-btn">
            <i class="ti ti-check"></i> {{ __('Post Job') }}
        </button>
        <a href="{{ route('public.account.jobs.index') }}" class="btn btn-outline-secondary ms-3" style="border-radius:8px; padding:12px 30px;">
            {{ __('Cancel') }}
        </a>
    </div>
</form>
@endsection

