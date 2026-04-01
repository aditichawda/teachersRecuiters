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
    height: 100%;
    display: flex;
    flex-direction: column;
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
    flex-shrink: 0;
}
.adm-school-logo img { width: 100%; height: 100%; object-fit: contain; }
.adm-school-name { font-size: 18px; font-weight: 700; color: #0c1e3c; margin: 0; }
.adm-school-body { padding: 24px; flex: 1; }
.adm-school-body .content { color: #334155; line-height: 1.7; font-size: 0.95rem; }
.adm-school-footer { padding: 16px 24px; border-top: 1px solid #f1f5f9; }
.adm-school-footer .btn { border-radius: 8px; padding: 10px 20px; font-weight: 600; }
.badge-featured { background: #0073d1; color: #fff; font-size: 11px; padding: 4px 8px; border-radius: 6px; }
</style>

<div class="adm-hero">
    <div class="container">
        <h1>{{ __('Admission') }}</h1>
        <p>{{ __('Explore schools and institutions. Click on a school to view details and submit your admission enquiry.') }}</p>
    </div>
</div>

@if(session('success_msg'))
    <div class="container mt-3"><div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success_msg') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>
@endif

<div class="container adm-section">
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
                    <h6 class="mb-2" style="font-size: 0.9rem; font-weight: 600; color: #0c1e3c;">{{ __('About School / Institution') }}</h6>
                    <div class="content">{!! BaseHelper::clean($admission->content) !!}</div>
                </div>
            @else
                <div class="adm-school-body">
                    <p class="text-muted small mb-0">{{ __('View institution profile for admission details.') }}</p>
                </div>
            @endif
            <div class="adm-school-footer">
                <a href="{{ $company->url }}" class="btn btn-primary">
                    {{ __('View Details & Submit Enquiry') }} <i class="fas fa-arrow-right ms-1 small"></i>
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">{{ __('No schools have published admission information yet.') }}</div>
    @endforelse
</div>
