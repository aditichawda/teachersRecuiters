@php
    Theme::set('pageTitle', __('Interests & Achievements'));
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
<style>
    .ia-form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .ia-form-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        padding: 20px 24px;
    }
    .ia-form-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
        color: #fff;
    }
    .ia-form-header p {
        font-size: 13px;
        opacity: 0.9;
        margin: 6px 0 0 0;
    }
    .ia-form-body {
        padding: 24px;
    }
    .ia-form-body .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .ia-form-body .form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 14px;
        font-size: 14px;
        min-height: 50px;
        resize: vertical;
    }
    .ia-form-body .form-control:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .ia-form-body .form-text {
        font-size: 12px;
        color: #64748b;
        margin-top: 6px;
    }
    .ia-form-footer {
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
    }
    .btn-save-ia {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        border: none;
        padding: 12px 28px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-save-ia:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    }
</style>

<div class="ia-form-card">
    <div class="ia-form-header">
        <h3><i class="fa fa-star me-2"></i>{{ __('Interests & Achievements') }}</h3>
        <p>{{ __('Add your interests, activities and achievements. These will be shown on your resume.') }}</p>
    </div>
    <form action="{{ route('public.account.post.interests-achievements') }}" method="POST">
        @csrf
        <div class="ia-form-body">
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label class="form-label">{{ __('Interests') }}</label>
                <textarea name="interests" class="form-control" rows="4" placeholder="{{ __('e.g. Reading, Educational workshops, Student mentoring, Curriculum design') }}">{{ old('interests', $account->interests ?? '') }}</textarea>
                <small class="form-text">{{ __('Hobbies or interests relevant to teaching. Shown on your resume.') }}</small>
            </div>

            <div class="mb-4">
                <label class="form-label">{{ __('Activities') }}</label>
                <textarea name="activities" class="form-control" rows="4" placeholder="{{ __('e.g. School club coordinator, Annual day organizer, Parent-teacher meetings') }}">{{ old('activities', $account->activities ?? '') }}</textarea>
                <small class="form-text">{{ __('Extracurricular or professional activities. Shown on your resume.') }}</small>
            </div>

            <div class="mb-4">
                <label class="form-label">{{ __('Achievements') }}</label>
                <textarea name="achievements" class="form-control" rows="4" placeholder="{{ __('e.g. Best Teacher Award 2023, 95% board result in Mathematics, Workshop presenter') }}">{{ old('achievements', $account->achievements ?? '') }}</textarea>
                <small class="form-text">{{ __('Awards, certifications, or notable achievements. Shown on your resume.') }}</small>
            </div>
        </div>
        <div class="ia-form-footer">
            <button type="submit" class="btn btn-save-ia">
                <i class="fa fa-check me-2"></i>{{ __('Save') }}
            </button>
        </div>
    </form>
</div>
@endsection
