@php
    Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
    $orderByParams = JobBoardHelper::getSortByParams();

    $layout = request()->query('layout') ?: $shortcode->layout;
@endphp

<style>
/* ===== Candidates Sidebar - Matching Jobs Page Style Exactly ===== */
.candidates-sidebar-modern {
    position: relative;
}
.candidates-sidebar-modern .side-bar-filter {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    position: sticky;
    top: 100px;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}
.candidates-sidebar-modern .sidebar-elements {
    padding: 16px;
    padding-right: 12px;
    padding-bottom: 20px;
}
.candidates-sidebar-modern .sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding: 14px 16px;
    margin-left: -16px;
    margin-right: -12px;
    margin-top: -16px;
    border-bottom: 1px solid rgba(0, 61, 130, 0.1);
    background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #7dd3fc 100%);
    box-shadow: 0 2px 8px rgba(0, 61, 130, 0.1);
}
.candidates-sidebar-modern .sidebar-header h4 {
    font-size: 15px;
    font-weight: 700;
    color: #0c4a6e;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.candidates-sidebar-modern .sidebar-header h4 i {
    color: #0284c7;
}
.candidates-sidebar-modern .btn-clear-filters {
    background: rgba(255, 255, 255, 0.9);
    color: #0c4a6e;
    border: 1px solid rgba(2, 132, 199, 0.3);
    border-radius: 6px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s;
    cursor: pointer;
    box-shadow: 0 1px 3px rgba(0, 61, 130, 0.1);
}
.candidates-sidebar-modern .btn-clear-filters:hover {
    background: rgba(255, 255, 255, 1);
    color: #075985;
    border-color: rgba(2, 132, 199, 0.5);
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 61, 130, 0.15);
}
.candidates-sidebar-modern .btn-clear-filters i {
    font-size: 14px;
}
.candidates-sidebar-modern .form-group {
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.candidates-sidebar-modern .form-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter {
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
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
.candidates-sidebar-modern .input-group {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    transition: all .2s;
}
.candidates-sidebar-modern .input-group:focus-within {
    border-color: #003d82;
    box-shadow: 0 0 0 3px rgba(0,61,130,.1);
}
.candidates-sidebar-modern .input-group .form-control {
    border: none;
    padding: 6px 12px;
    height: 36px;
    font-size: 13px;
    background: #fff;
}
.candidates-sidebar-modern .input-group .form-control:focus {
    box-shadow: none;
}
.candidates-sidebar-modern .input-group .btn {
    background: transparent;
    border: none;
    color: #64748b;
    padding: 0 12px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter li {
    margin-bottom: 6px;
}

/* Scroll for filter sections with many options */
.candidates-sidebar-modern .twm-sidebar-ele-filter,
.candidates-sidebar-modern .form-group {
    position: relative;
}

/* Apply scroll only to lists/options containers that have many items */
.candidates-sidebar-modern .twm-sidebar-ele-filter ul,
.candidates-sidebar-modern .form-group ul[style*="height"],
.candidates-sidebar-modern .twm-sidebar-ele-filter > div:has(> ul),
.candidates-sidebar-modern .form-group > div:has(> ul),
.candidates-sidebar-modern .twm-sidebar-ele-filter .form-check,
.candidates-sidebar-modern .form-group .form-check {
    max-height: 180px;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 6px;
}

/* For select elements with multiple options */
.candidates-sidebar-modern select[multiple] {
    max-height: 150px;
    overflow-y: auto;
}

/* Custom scrollbar for filter sections */
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar,
.candidates-sidebar-modern .form-group ul::-webkit-scrollbar,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar,
.candidates-sidebar-modern .form-group > div::-webkit-scrollbar {
    width: 6px;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-track,
.candidates-sidebar-modern .form-group ul::-webkit-scrollbar-track,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-track,
.candidates-sidebar-modern .form-group > div::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb,
.candidates-sidebar-modern .form-group ul::-webkit-scrollbar-thumb,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-thumb,
.candidates-sidebar-modern .form-group > div::-webkit-scrollbar-thumb {
    background: #003d82;
    border-radius: 10px;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb:hover,
.candidates-sidebar-modern .form-group ul::-webkit-scrollbar-thumb:hover,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-thumb:hover,
.candidates-sidebar-modern .form-group > div::-webkit-scrollbar-thumb:hover {
    background: #002d5f;
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
    margin-bottom: 4px;
}
.candidates-sidebar-modern .form-check:hover {
    background: #f8faff;
}
.candidates-sidebar-modern .form-check-input {
    margin-top: 0 !important;
    border-radius: 4px;
    border-color: #cbd5e1;
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    cursor: pointer;
    position: relative;
}
.candidates-sidebar-modern .form-check-input:checked {
    background-color: #003d82;
    border-color: #003d82;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
    background-size: 100% 100%;
    background-position: center;
    background-repeat: no-repeat;
}
.candidates-sidebar-modern .form-check-input:focus {
    border-color: #003d82;
    box-shadow: 0 0 0 3px rgba(0, 61, 130, 0.1);
    outline: none;
}
.candidates-sidebar-modern .form-check-label {
    font-size: 13px;
    color: #475569;
    margin: 0;
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1.4;
    flex: 1;
}
.candidates-sidebar-modern .form-check:hover .form-check-label {
    color: #003d82;
}
.candidates-sidebar-modern .form-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 6px;
}
.candidates-sidebar-modern .wt-select-bar-large {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 6px 12px;
    height: 36px;
    font-size: 13px;
    color: #1e293b;
}
.candidates-sidebar-modern .wt-select-bar-large:focus {
    border-color: #003d82;
    box-shadow: 0 0 0 3px rgba(0,61,130,.1);
    outline: none;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar {
    width: 6px;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar-thumb {
    background: #003d82;
    border-radius: 10px;
}
.candidates-sidebar-modern .side-bar-filter::-webkit-scrollbar-thumb:hover {
    background: #002d5f;
}

/* Apply Filter Button */
.candidates-sidebar-modern .apply-filter-wrapper {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
    margin-left: -16px;
    margin-right: -12px;
    padding-left: 16px;
    padding-right: 12px;
    padding-bottom: 16px;
    display: block !important;
    visibility: visible !important;
    position: relative;
    z-index: 10;
}
.candidates-sidebar-modern .apply-filter-btn {
    width: 100%;
    background: linear-gradient(135deg, #7dd3fc 0%, #bae6fd 50%, #e0f2fe 100%) !important;
    color: #0c4a6e !important;
    border: 1px solid rgba(2, 132, 199, 0.3) !important;
    border-radius: 10px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex !important;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(2, 132, 199, 0.2);
    visibility: visible !important;
    opacity: 1 !important;
}
.candidates-sidebar-modern .apply-filter-btn:hover {
    background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 50%, #38bdf8 100%) !important;
    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
    transform: translateY(-1px);
    color: #075985 !important;
}
.candidates-sidebar-modern .apply-filter-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(2, 132, 199, 0.2);
}
.candidates-sidebar-modern .apply-filter-btn i {
    font-size: 16px;
}

.candidates-sidebar-modern .sidebar-elements {
    margin-right: 0;
}
.candidates-sidebar-modern .form-group,
.candidates-sidebar-modern .twm-sidebar-ele-filter {
    padding-right: 0;
    margin-right: 0;
}
.candidates-sidebar-modern .form-check,
.candidates-sidebar-modern .form-control,
.candidates-sidebar-modern .wt-select-bar-large,
.candidates-sidebar-modern select {
    margin-right: 0;
}

@media(max-width: 991px) {
    .candidates-sidebar-modern .side-bar-filter {
        position: relative;
        top: 0;
        max-height: none;
    }
    .candidates-sidebar-modern .sidebar-header {
        flex-wrap: wrap;
        gap: 12px;
    }
    .candidates-sidebar-modern .sidebar-header h4 {
        font-size: 15px;
    }
    .candidates-sidebar-modern .btn-clear-filters {
        font-size: 12px;
        padding: 5px 12px;
    }
}
</style>

{{-- Main Content --}}
<div class="candidates-main-section candidates-container">
    <div class="container">
        <div class="row">
            {{-- Sidebar Filters --}}
            <div class="col-lg-4 col-md-12 candidates-sidebar-modern">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar">
                        <div class="sidebar-elements search-bx">
                            <button class="d-md-none position-absolute btn btn-link btn-close-filter" style="top: 10px; right: 10px; z-index: 10;">
                                <i class="feather-x"></i>
                            </button>
                            
                            {{-- Sidebar Header with Clear Filters --}}
                            <div class="sidebar-header">
                                <h4>
                                    <i class="feather-filter"></i>
                                    {{ __('Filters') }}
                                </h4>
                                <button type="button" class="btn-clear-filters" id="clear-all-candidate-filters">
                                    <i class="feather-x-circle"></i>
                                    {{ __('Clear All') }}
                                </button>
                            </div>
                            
                            <form action="{{ route('public.ajax.candidates') }}" method="get" id="candidate-filter-form" data-ajax-url="{{ route('public.ajax.candidates') }}" style="display: flex; flex-direction: column; min-height: 100%;">
                                {!! Theme::partial('candidates.filters.keyword') !!}
                                {!! Theme::partial('candidates.filters.city') !!}
                                {!! Theme::partial('candidates.filters.salary') !!}
                                {!! Theme::partial('candidates.filters.experiences') !!}
                                {!! Theme::partial('candidates.filters.skills') !!}
                                
                                <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page', 12)) }}">
                                <input type="hidden" name="page" value="1">
                                <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->layout ?: 'grid') }}">
                                <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
                                
                                <!-- Apply Filter Button -->
                                <div class="apply-filter-wrapper" style="margin-top: auto; padding-bottom: 0;">
                                    <button type="submit" class="apply-filter-btn">
                                        <i class="feather-check-circle"></i>
                                        <span>{{ __('Apply Filter') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Candidates Listings --}}
            <div class="col-lg-8 col-md-12 position-relative candidates-listing-modern">
                <div class="candidates-toolbar product-filter-wrap">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <button type="button" class="d-block d-md-none btn btn-open-filter">
                            <i class="feather-filter"></i>
                        </button>
                        <span class="woocommerce-result-count-left">
                            @if ($candidates->total())
                                {{ __('Showing :from – :to of :total results', [
                                    'from' => $candidates->firstItem(),
                                    'to' => $candidates->lastItem(),
                                    'total' => $candidates->total(),
                                ]) }}
                            @endif
                        </span>
                    </div>

                    <div class="woocommerce-ordering twm-filter-select gap-1">
                        <select class="wt-select-bar-2 selectpicker select-sort-by" name="sort_by">
                            @foreach($orderByParams as $key => $value)
                                <option value="{{ $key }}" @selected(request()->query('sort_by') == $key)>{{ $value }}</option>
                            @endforeach
                        </select>
                        <select class="wt-select-bar-2 selectpicker select-per-page" name="per_page">
                            @foreach(JobBoardHelper::getPerPageParams() as $item)
                                <option value="{{ $item }}" @selected(request()->query('per_page', 12) == $item)>{{ __('Show :number', ['number' => $item]) }}</option>
                            @endforeach
                        </select>
                        <select class="wt-select-bar-2 selectpicker select-layout" name="layout">
                            <option value="grid" @selected($layout == 'grid')>{{ __('Grid') }}</option>
                            <option value="list" @selected($layout == 'list')>{{ __('List') }}</option>
                        </select>
                    </div>
                </div>

                <div class="twm-candidates-list-wrap candidates-listing">
                    @include(Theme::getThemeNamespace('views.job-board.partials.candidates.index'), ['layout' => $layout])
                </div>

                @if ($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="row">
                        <div class="col-lg-12 mt-4 pt-2">
                            {!! $candidates->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
