@php
    Theme::set('pageTitle', __('Experience'));
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
<style>
    .exp-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .exp-page-header h3 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .exp-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .btn-add-exp {
        background: #0073d1;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-add-exp:hover {
        background: #005bb5;
        color: #fff;
        text-decoration: none;
    }
    .exp-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 16px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
        overflow: hidden;
    }
    .exp-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-color: #0073d1;
    }
    .exp-card-body {
        padding: 20px 24px;
        display: flex;
        gap: 16px;
    }
    .exp-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: linear-gradient(135deg, #fbfcff, #b1c0ff);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0073d1;
        font-size: 20px;
    }
    .exp-content {
        flex: 1;
    }
    .exp-content h5 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 4px 0;
    }
    .exp-position {
        color: #0073d1;
        font-size: 14px;
        font-weight: 500;
        margin: 0 0 4px 0;
    }
    .exp-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 4px;
    }
    .exp-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #666;
    }
    .exp-meta-item i {
        font-size: 12px;
        color: #999;
    }
    .exp-type-badge {
        display: inline-block;
        background: #f0f0f0;
        color: #555;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .exp-current-badge {
        display: inline-block;
        background: #e6f9ee;
        color: #1a9c4a;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        margin-left: 8px;
    }
    .exp-dates {
        color: #888;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .exp-description {
        color: #666;
        font-size: 13px;
        margin-top: 8px;
        line-height: 1.5;
    }
    .exp-actions {
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }
    .exp-actions .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e0e0e0;
        background: #fff;
        color: #666;
        text-decoration: none;
        transition: all 0.2s;
        font-size: 14px;
    }
    .exp-actions .btn-action:hover {
        border-color: #0073d1;
        color: #0073d1;
        background: #f0f8ff;
    }
    .exp-actions .btn-action.btn-delete:hover {
        border-color: #dc3545;
        color: #dc3545;
        background: #fff5f5;
    }
    .exp-empty {
        text-align: center;
        /* padding: 60px 20px; */
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .exp-empty i {
        font-size: 28px;
        color: #fff;
        /* margin-bottom: 16px; */
    }
    .exp-empty h5 {
        color: #666;
        margin-bottom: 8px;
    }
    .exp-empty p {
        color: #999;
        font-size: 14px;
        margin-bottom: 20px;
    }
    @media (max-width: 576px) {
        .exp-page-header {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }
        .exp-card-body {
            flex-direction: column;
            padding: 16px;
        }
        .exp-actions {
            justify-content: flex-end;
        }
        .exp-meta {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>

<div class="exp-page-header">
    <h3><i class="fa fa-briefcase"></i>{{ __('Experience') }}</h3>
    <a href="{{ route('public.account.experiences.create') }}" class="btn-add-exp">
        <i class="fa fa-plus"></i> {{ __('Add Experience') }}
    </a>
</div>

@forelse($experiences as $experience)
    <div class="exp-card">
        <div class="exp-card-body">
            <div class="exp-icon">
                <i class="fa fa-briefcase"></i>
            </div>
            <div class="exp-content">
                <h5>{!! BaseHelper::clean($experience->company) !!}</h5>
                @if ($position = $experience->position)
                    <p class="exp-position">{!! BaseHelper::clean($position) !!}</p>
                @endif
                <div class="exp-meta">
                    @if($experience->employment_type)
                        <span class="exp-type-badge">{{ str_replace('_', ' ', ucfirst($experience->employment_type)) }}</span>
                    @endif
                    @if($experience->location)
                        <span class="exp-meta-item"><i class="fa fa-map-marker-alt"></i> {{ $experience->location }}</span>
                    @endif
                </div>
                <div class="exp-dates">
                    <i class="fa fa-calendar-alt"></i>
                    {{ $experience->started_at->format('M Y') }} -
                    @if($experience->is_current)
                        <span>{{ __('Present') }}</span>
                        <span class="exp-current-badge">{{ __('Currently Working') }}</span>
                    @else
                        {{ $experience->ended_at ? $experience->ended_at->format('M Y') : __('Present') }}
                    @endif
                    @php
                        $endDate = $experience->is_current ? now() : ($experience->ended_at ?? now());
                        $diff = $experience->started_at->diff($endDate);
                        $duration = '';
                        if($diff->y > 0) $duration .= $diff->y . ' yr' . ($diff->y > 1 ? 's' : '');
                        if($diff->m > 0) $duration .= ($duration ? ' ' : '') . $diff->m . ' mo' . ($diff->m > 1 ? 's' : '');
                        if(!$duration) $duration = '< 1 month';
                    @endphp
                    <span class="exp-meta-item" style="margin-left: 8px;">({{ $duration }})</span>
                </div>
                @if ($description = $experience->description)
                    <div class="exp-description">
                        {!! Str::limit(strip_tags($description), 200) !!}
                    </div>
                @endif
            </div>
            <div class="exp-actions">
                <a href="{{ route('public.account.experiences.edit', $experience->id) }}" class="btn-action" title="{{ __('Edit') }}">
                    <i class="fa fa-pen"></i>
                </a>
                <form method="post" action="{{ route('public.account.experiences.destroy', $experience->id) }}" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('{{ __('Are you sure you want to delete this experience?') }}');" type="submit" class="btn-action btn-delete" title="{{ __('Delete') }}">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="exp-empty">
        <i class="fa fa-briefcase"></i>
        <h5>{{ __('No Experience Added Yet') }}</h5>
        <p>{{ __('Add your work experience to strengthen your profile') }}</p>
        <a href="{{ route('public.account.experiences.create') }}" class="btn-add-exp">
            <i class="fa fa-plus"></i> {{ __('Add Your First Experience') }}
        </a>
    </div>
@endforelse
@endsection
