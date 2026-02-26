@php
    Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
    $orderByParams = JobBoardHelper::getSortByParams();
    $layout = request()->query('layout') ?: $shortcode->layout;
@endphp

{!! Theme::partial('candidate-card-styles') !!}

<style>
.cand-heading {
    text-align: center;
    padding: 30px 0 10px;
}
.cand-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
    display: inline-block;
}
.cand-heading h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    border-radius: 4px;
    margin: 10px auto 0;
}
.cand-heading p {
    font-size: 15px;
    color: #64748b;
}
.candidates-toolbar {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 20px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.candidates-toolbar .woocommerce-result-count-left {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}

/* Sidebar Styles */
.candidates-sidebar-modern {
    position: relative;
}
.candidates-sidebar-modern .side-bar-filter {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0, 115, 209, 0.1);
    position: sticky;
    top: 100px;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
}
.candidates-sidebar-modern .sidebar-elements {
    padding: 0;
    background: #ffffff;
}
.candidates-sidebar-modern .sidebar-header {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    margin: 0;
    padding: 18px 20px;
    /* border-radius: 16px 16px 0 0; */
    box-shadow: 0 2px 8px rgba(0, 115, 209, 0.2);
}
.candidates-sidebar-modern .sidebar-header h4 {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.candidates-sidebar-modern .sidebar-header h4 i {
    color: #fff;
    font-size: 18px;
}
.candidates-sidebar-modern .btn-clear-filters {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    cursor: pointer;
}
.candidates-sidebar-modern .btn-clear-filters:hover {
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
    border-color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
}
.candidates-sidebar-modern .btn-clear-filters i {
    font-size: 14px;
}
.candidates-sidebar-modern .form-group {
    margin: 0;
    padding: 18px 20px;
    border-bottom: 1px solid #f1f5f9;
    background: #fff;
    transition: background 0.2s;
}
.candidates-sidebar-modern .form-group:hover {
    background: #f8faff;
}
.candidates-sidebar-modern .form-group:last-of-type {
    border-bottom: none;
}
.candidates-sidebar-modern .section-head-small {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 10px !important;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter {
    position: relative;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 100px;
    overflow-y: auto;
    padding-right: 10px;
    margin-top: 4px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar {
    width: 4px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 10px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb:hover {
    background: #005bb5;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul li {
    margin-bottom: 8px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul li:last-child {
    margin-bottom: 0;
}
.candidates-sidebar-modern .form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 0;
    transition: all 0.2s;
    border-radius: 6px;
    padding-left: 8px;
    margin-left: -8px;
}
.candidates-sidebar-modern .form-check:hover {
    background: #f8faff;
}
.candidates-sidebar-modern .form-check-input {
    margin-top: 0;
    border-color: #cbd5e1;
    cursor: pointer;
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}
.candidates-sidebar-modern .form-check-input:checked {
    background-color: #0073d1;
    border-color: #0073d1;
}
.candidates-sidebar-modern .form-check-input:focus {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
}
.candidates-sidebar-modern .form-check-label {
    font-size: 13px;
    color: #475569;
    cursor: pointer;
    transition: color 0.2s;
    margin: 0;
    line-height: 1.4;
}
.candidates-sidebar-modern .form-check:hover .form-check-label {
    color: #0073d1;
}
.candidates-sidebar-modern .form-control {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #475569;
    background: #f8fafc;
    transition: all 0.2s;
    width: 100%;
}
.candidates-sidebar-modern .form-control:focus {
    border-color: #0073d1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    background: #fff;
}
.candidates-sidebar-modern .form-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 8px;
    display: block;
}
.candidates-sidebar-modern .tagcloud {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    max-height: 100px;
    overflow-y: auto;
    padding-right: 10px;
    margin-top: 4px;
}
.candidates-sidebar-modern .tagcloud::-webkit-scrollbar {
    width: 4px;
}
.candidates-sidebar-modern .tagcloud::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.candidates-sidebar-modern .tagcloud::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 10px;
}
.candidates-sidebar-modern .tagcloud::-webkit-scrollbar-thumb:hover {
    background: #005bb5;
}
.candidates-sidebar-modern .tag-cloud {
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    display: inline-block;
    margin-bottom: 4px;
}
.candidates-sidebar-modern .tag-cloud:hover {
    background: #e2e8f0;
    border-color: #0073d1;
    color: #0073d1;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 115, 209, 0.15);
}
.candidates-sidebar-modern .btn-check:checked + .tag-cloud {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-color: #0073d1;
    color: #fff;
    box-shadow: 0 2px 8px rgba(0, 115, 209, 0.3);
}

/* Sidebar Scrollbar Styling */
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar {
    width: 6px;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 10px;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #005bb5 0%, #004a94 100%);
}

/* Apply Filters Button */
.candidates-sidebar-modern .form-group.mt-4 {
    margin: 0;
    padding: 18px 20px;
    background: #f8faff;
    border-top: 1px solid #e2e8f0;
}
.candidates-sidebar-modern .btn-primary {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    color: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.3);
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.candidates-sidebar-modern .btn-primary:hover {
    background: linear-gradient(135deg, #005bb5 0%, #004a94 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 115, 209, 0.4);
    color: #fff;
}
.candidates-sidebar-modern .btn-primary:active {
    transform: translateY(0);
}

/* Mobile Styles */
@media(max-width: 991px) {
    .candidates-sidebar-modern .side-bar-filter {
        position: relative;
        top: 0;
        max-height: none;
    }
    .candidates-sidebar-modern .side-bar-filter {
        display: none;
    }
    .candidates-sidebar-modern .side-bar-filter.active {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        max-height: 100vh;
        border-radius: 0;
    }
    .candidates-sidebar-modern .backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
    }
}
@media(max-width: 767px) {
    .cand-heading h2 { font-size: 24px; }
    .candidates-toolbar { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">
        <div class="cand-heading">
            @if ($shortcode->title || $shortcode->subtitle)
                @if ($shortcode->subtitle)
                    <h2>{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                @endif
                @if ($shortcode->title)
                    <p>{!! BaseHelper::clean($shortcode->title) !!}</p>
                @endif
            @else
                <h2>{{ __('Candidates') }}</h2>
                <p>{{ __('Find talented teachers ready to make a difference') }}</p>
            @endif
        </div>

        <div class="section-content">
            <div class="candidates candidates-container">
                <div class="row">
                    {{-- Sidebar Filters --}}
                    <div class="col-lg-3 col-md-12 candidates-sidebar-modern">
                        <div class="side-bar-filter">
                            <div class="backdrop"></div>
                            <div class="side-bar p-0">
                                <div class="sidebar-elements search-bx">
                                    <button class="d-md-none position-absolute btn btn-link btn-close-filter" style="top: 10px; right: 10px; z-index: 10;">
                                        <i class="feather-x"></i>
                                    </button>
                                    
                                    {{-- Sidebar Header --}}
                                    <div class="sidebar-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
                                        <h4 style="font-size: 16px; font-weight: 700; color: #ffffff; margin: 0; display: flex; align-items: center; gap: 8px;">
                                            <i class="feather-filter" style="color:rgb(255, 255, 255);"></i>
                                            {{ __('Filters') }}
                                        </h4>
                                        <button type="button" class="btn-clear-filters" id="clear-all-candidate-filters" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 14px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; cursor: pointer;">
                                            <i class="feather-x-circle" style="font-size: 14px;"></i>
                                            {{ __('Clear All') }}
                                        </button>
                                    </div>
                                    
                                    <form action="{{ route('public.ajax.candidates') }}" method="get" id="candidate-filter-form" data-ajax-url="{{ route('public.ajax.candidates') }}" class="p-2">
                                        {{-- Filter by City --}}
                                        {!! Theme::partial('candidates.filters.city') !!}
                                        
                                        {{-- Filter by Experience --}}
                                        {!! Theme::partial('candidates.filters.experiences') !!}
                                        
                                        {{-- Filter by Salary --}}
                                        {!! Theme::partial('candidates.filters.salary') !!}
                                        
                                        {{-- Filter by Skills --}}
                                        {!! Theme::partial('candidates.filters.skills') !!}
                                        
                                        <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page', 12)) }}">
                                        <input type="hidden" name="page" value="1">
                                        <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->layout ?: 'grid') }}">
                                        <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
                                        
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="feather-filter" style="margin-right: 6px;"></i>
                                                {{ __('Apply Filters') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Candidates Listings --}}
                    <div class="col-lg-9 col-md-12 position-relative candidates-listing-modern">
                        <div class="candidates-toolbar product-filter-wrap" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 20px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,.04);">
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="d-block d-md-none btn btn-open-filter" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px;">
                                    <i class="feather-filter"></i>
                                </button>
                                <span class="woocommerce-result-count-left" style="font-size: 14px; color: #64748b; font-weight: 500;">
                                @if ($candidates->total())
                                    {{ __('Showing :from – :to of :total results', [
                                        'from'  => $candidates->firstItem(),
                                        'to'    => $candidates->lastItem(),
                                        'total' => $candidates->total(),
                                    ]) }}
                                @endif
                            </span>
                            </div>
                        </div>

                        <div class="twm-candidates-list-wrap candidates-listing">
                            @include(Theme::getThemeNamespace('views.job-board.partials.candidates.index'), ['layout' => $layout])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Clear All Filters Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const clearFiltersBtn = document.getElementById('clear-all-candidate-filters');
    const filterForm = document.getElementById('candidate-filter-form');
    
    if (clearFiltersBtn && filterForm) {
        clearFiltersBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Reset all form fields
            const formInputs = filterForm.querySelectorAll('input, select, textarea');
            formInputs.forEach(function(input) {
                if (input.type === 'checkbox') {
                    input.checked = false;
                } else if (input.type === 'radio') {
                    input.checked = false;
                } else if (input.type === 'text' || input.type === 'number' || input.type === 'search') {
                    input.value = '';
                } else if (input.tagName === 'SELECT') {
                    if (input.options.length > 0) {
                        input.selectedIndex = 0;
                    }
                }
            });
            
            // Refresh selectpicker if it exists
            if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                $('.selectpicker').selectpicker('refresh');
            }
            
            // Submit the form to reload with cleared filters
            filterForm.submit();
        });
    }
    
    // Sidebar toggle for mobile
    const openFilterBtn = document.querySelector('.btn-open-filter');
    const closeFilterBtn = document.querySelector('.btn-close-filter');
    const sidebarFilter = document.querySelector('.candidates-sidebar-modern .side-bar-filter');
    const backdrop = document.querySelector('.candidates-sidebar-modern .backdrop');
    
    if (openFilterBtn && sidebarFilter) {
        openFilterBtn.addEventListener('click', function() {
            sidebarFilter.classList.add('active');
            if (backdrop) backdrop.style.display = 'block';
        });
    }
    
    if (closeFilterBtn && sidebarFilter) {
        closeFilterBtn.addEventListener('click', function() {
            sidebarFilter.classList.remove('active');
            if (backdrop) backdrop.style.display = 'none';
        });
    }
    
    if (backdrop && sidebarFilter) {
        backdrop.addEventListener('click', function() {
            sidebarFilter.classList.remove('active');
            backdrop.style.display = 'none';
        });
    }
});
</script>
