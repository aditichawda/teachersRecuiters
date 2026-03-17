@php
    Theme::asset()->container('footer')->usePath()->add('company-js', 'js/company.js');
    $orderByParams = JobBoardHelper::getSortByParams();
    $layout = request()->query('layout') ?: $shortcode->style;
@endphp

{!! Theme::partial('company-card-styles') !!}

<style>
/* ===== Main Content ===== */
.companies-main-section {
    padding: 40px 0 80px;
    background: #f8fafc;
}

.companies-heading {
    text-align: center;
    padding: 30px 0 10px;
}
.companies-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
    display: inline-block;
}
.companies-heading h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    border-radius: 4px;
    margin: 10px auto 0;
}
.companies-heading p {
    font-size: 15px;
    color: #64748b;
}

/* ===== Sidebar ===== */
.jobs-sidebar-modern .side-bar-filter {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    position: sticky;
    top: 20px;
    height: calc(100vh - 40px);
    max-height: calc(100vh - 40px);
    display: flex;
    flex-direction: column;
}
.jobs-sidebar-modern .side-bar {
    height: 100%;
    display: flex;
    flex-direction: column;
}
.jobs-sidebar-modern .filter-header {
    background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #bae6fd;
    flex-shrink: 0;
}
.jobs-sidebar-modern .filter-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #0c4a6e;
    display: flex;
    align-items: center;
    gap: 8px;
}
.jobs-sidebar-modern .filter-header h3 i {
    font-size: 18px;
}
.jobs-sidebar-modern .filter-header .btn-clear-all {
    background: #fff;
    border: 1px solid #0ea5e9;
    color: #0ea5e9;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 4px;
    text-decoration: none;
}
.jobs-sidebar-modern .filter-header .btn-clear-all:hover {
    background: #0ea5e9;
    color: #fff;
}
.jobs-sidebar-modern .sidebar-elements {
    padding: 20px;
    overflow-y: auto;
    overflow-x: hidden;
    flex: 1;
    min-height: 0;
    height: 0;
}
.jobs-sidebar-modern .form-group {
    margin-bottom: 0;
    padding: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.jobs-sidebar-modern .form-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter {
    padding: 0;
    margin-bottom: 24px;
    max-height: 100px;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 4px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter:last-child {
    margin-bottom: 0;
}
/* Scrollbar for filter sections */
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar {
    width: 4px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 2px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 2px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-thumb:hover {
    background: #005ba3;
}
.jobs-sidebar-modern .section-head-small {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 14px !important;
}
.jobs-sidebar-modern .input-group {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    transition: all .2s;
}
.jobs-sidebar-modern .input-group:focus-within {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1);
}
.jobs-sidebar-modern .input-group .form-control {
    border: none;
    padding: 8px 14px;
    height: 40px;
    font-size: 14px;
    background: #fff;
}
.jobs-sidebar-modern .input-group .form-control:focus {
    box-shadow: none;
}
.jobs-sidebar-modern .input-group .btn {
    background: transparent;
    border: none;
    color: #64748b;
    padding: 0 12px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter li {
    margin-bottom: 8px;
}
.jobs-sidebar-modern .form-check-input {
    border-radius: 4px;
    border-color: #cbd5e1;
    width: 18px;
    height: 18px;
}
.jobs-sidebar-modern .form-check-input:checked {
    background-color: #0073d1;
    border-color: #0073d1;
}
.jobs-sidebar-modern .form-check-label {
    font-size: 14px;
    color: #475569;
    padding-left: 4px;
}

/* ===== Attractive Dropdown Styling ===== */
.jobs-sidebar-modern .selectpicker,
.jobs-sidebar-modern .wt-select-bar-large {
    width: 100% !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #fff !important;
    transition: all 0.2s ease !important;
    height: 44px !important;
    line-height: 24px !important;
}
.jobs-sidebar-modern .selectpicker:focus,
.jobs-sidebar-modern .wt-select-bar-large:focus {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
    outline: none !important;
}
.jobs-sidebar-modern .bootstrap-select .dropdown-toggle {
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #fff !important;
    height: 44px !important;
    line-height: 24px !important;
    box-shadow: none !important;
}
.jobs-sidebar-modern .bootstrap-select .dropdown-toggle:focus,
.jobs-sidebar-modern .bootstrap-select .dropdown-toggle:hover {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
    outline: none !important;
}
.jobs-sidebar-modern .bootstrap-select .dropdown-menu {
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    margin-top: 4px !important;
    padding: 8px 0 !important;
    max-height: 300px !important;
    overflow-y: auto !important;
}
.jobs-sidebar-modern .bootstrap-select .dropdown-menu .dropdown-item {
    padding: 10px 16px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    transition: all 0.15s ease !important;
}
.jobs-sidebar-modern .bootstrap-select .dropdown-menu .dropdown-item:hover,
.jobs-sidebar-modern .bootstrap-select .dropdown-menu .dropdown-item.active {
    background: #f0f7ff !important;
    color: #0073d1 !important;
}

/* ===== City Search Autocomplete Styling ===== */
.company-city-search-wrapper {
    position: relative;
}
.company-city-search-input {
    width: 100% !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #fff !important;
    transition: all 0.2s ease !important;
    height: 44px !important;
    line-height: 24px !important;
}
.company-city-search-input:focus {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
    outline: none !important;
}
.company-city-search-input::placeholder {
    color: #94a3b8 !important;
}
.company-city-suggestions {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-top: none !important;
    border-radius: 0 0 10px 10px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    z-index: 9999 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    margin-top: 0 !important;
}
.company-city-search-wrapper {
    position: relative !important;
    z-index: 10000 !important;
}
.company-city-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #1e293b !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}
.company-city-suggestion-item:last-child {
    border-bottom: none !important;
}
.company-city-suggestion-item:hover,
.company-city-suggestion-item.active {
    background: #f0f7ff !important;
    color: #0073d1 !important;
}
.company-city-suggestion-item .city-name {
    font-weight: 500 !important;
    color: #1e293b !important;
    margin-bottom: 2px !important;
}
.company-city-suggestion-item:hover .city-name,
.company-city-suggestion-item.active .city-name {
    color: #0073d1 !important;
}
.company-city-suggestion-item .city-location {
    font-size: 12px !important;
    color: #64748b !important;
    margin-top: 2px !important;
}
.company-city-loading,
.company-city-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}

/* ===== Apply Filter Button Styling (Screenshot 2 Style) ===== */
.btn-apply-filter {
    background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%) !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 10px !important;
    padding: 12px 20px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3) !important;
    width: 100% !important;
}
.btn-apply-filter:hover {
    background: linear-gradient(135deg, #4f9ff8 0%, #2563eb 100%) !important;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4) !important;
    transform: translateY(-1px);
}
.btn-apply-filter:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3) !important;
}
.btn-apply-filter i {
    font-size: 16px;
    font-weight: 600;
}

/* ===== Clear Filter Button Styling ===== */
.btn-clear-filter {
    background: transparent !important;
    color: #64748b !important;
    border: none !important;
    padding: 10px 20px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    text-align: center !important;
    text-decoration: none !important;
    display: block !important;
    width: 100% !important;
    border-radius: 8px !important;
}
.btn-clear-filter:hover {
    color: #1e293b !important;
    background: #f1f5f9 !important;
    text-decoration: none !important;
}

/* ===== Toolbar ===== */
.companies-toolbar {
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
.companies-toolbar .woocommerce-result-count-left {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}
.companies-toolbar .woocommerce-ordering {
    display: flex;
    gap: 8px;
    align-items: center;
}
.companies-toolbar .wt-select-bar-2,
.companies-toolbar .selectpicker,
.companies-toolbar select {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 7px 12px;
    font-size: 13px;
    color: #475569;
    background: #f8fafc;
    cursor: pointer;
    transition: all .2s;
    -webkit-appearance: auto;
}
.companies-toolbar select:focus {
    border-color: #0073d1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1);
}
.btn-open-filter {
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 14px;
    border: none;
    transition: all .2s;
}
.btn-open-filter:hover {
    background: #0284c7;
    color: #fff;
}

.companies-listing-modern {
    position: relative;
}

.jobs-sidebar-modern .backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1040;
}
.jobs-sidebar-modern .side-bar-filter.active .backdrop {
    display: block;
}
.jobs-sidebar-modern .side-bar {
    position: relative;
    z-index: 1041;
}

/* Custom scrollbar for sidebar - Blue Theme */
.jobs-sidebar-modern .sidebar-elements::-webkit-scrollbar {
    width: 6px;
}
.jobs-sidebar-modern .sidebar-elements::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}
.jobs-sidebar-modern .sidebar-elements::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 3px;
}
.jobs-sidebar-modern .sidebar-elements::-webkit-scrollbar-thumb:hover {
    background: #005ba3;
}

/* Scroll for filter sections exceeding 100px */
.jobs-sidebar-modern .twm-sidebar-ele-filter {
    max-height: 100px;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 4px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar {
    width: 4px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 2px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 2px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-thumb:hover {
    background: #005ba3;
}

@media(max-width: 991px) {
    .jobs-sidebar-modern .side-bar-filter {
        position: relative;
        top: 0;
        max-height: none;
    }
    .jobs-sidebar-modern .side-bar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 320px;
        height: 100vh;
        background: #fff;
        z-index: 996;
        overflow-y: auto;
        transition: left 0.3s ease;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .jobs-sidebar-modern .side-bar-filter.active .side-bar {
        left: 0;
    }
    .companies-toolbar { padding: 12px 16px; }
}
body.filter-open {
    overflow: hidden;
}
@media(max-width: 767px) {
    .companies-heading h2 { font-size: 24px; }
    .companies-toolbar { flex-direction: column; align-items: flex-start; }
    .companies-main-section { padding: 25px 0 50px; }
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container companies">
        <div class="companies-heading">
            <h2>{{ __('Schools/Institutions') }}</h2>
            <p>{{ __('Search schools in your location, apply to jobs and connect directly') }}</p>
        </div>
    </div>
        </div>

{{-- Main Content --}}
<div class="companies-main-section companies-container">
    <div class="container">
        <div class="row">
            {{-- Sidebar Filters --}}
            <div class="col-lg-3 col-md-12 jobs-sidebar-modern">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar" style="padding: 0px;">
                        <div class="filter-header companies-filters-toggle" id="companies-filters-toggle">
                            <h3>
                                <i class="feather-filter"></i>
                                {{ __('Filters') }}
                            </h3>
                            <div class="companies-filters-header-right">
                                <a href="{{ request()->url() }}" class="btn-clear-all">
                                    <i class="feather-x"></i>
                                    {{ __('Clear All') }}
                                </a>
                                <i class="feather-chevron-down companies-filters-arrow d-md-none"></i>
                            </div>
                        </div>
                        <div class="sidebar-elements search-bx companies-filters-container" id="companies-filters-container">
                            <form action="{{ request()->url() }}" method="get" id="companies-filter-form" data-ajax-url="{{ route('public.ajax.companies') }}">
                                {!! Theme::partial('companies.filters.institution-name') !!}
                                {!! Theme::partial('companies.filters.institution-type') !!}
                                {!! Theme::partial('companies.filters.location') !!}
                                {!! Theme::partial('companies.filters.campus-type') !!}
                                {!! Theme::partial('companies.filters.currently-hiring') !!}
                                {!! Theme::partial('companies.filters.benefits-offered') !!}
                                {!! Theme::partial('companies.filters.standard-level') !!}
                                
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-apply-filter w-100">
                                        <i class="feather-check"></i>
                                        {{ __('Apply Filter') }}
                                    </button>
                                    <!-- <a href="{{ request()->url() }}" class="btn-clear-filter w-100 mt-2">{{ __('Clear Filters') }}</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile Companies Filters Dropdown (Top) --}}
            <style>
                @media (max-width: 991px) {
                    /* Make Companies filters look/behave like Jobs page (top dropdown) */
                    .jobs-sidebar-modern .side-bar-filter .backdrop { display: none !important; }

                    /* Push filters below fixed navbar (prevents overlap) */
                    .companies-main-section {
                        padding-top: 90px !important;
                    }
                    .companies-main-section .jobs-sidebar-modern {
                        margin-top: 0 !important;
                    }

                    .jobs-sidebar-modern .side-bar-filter {
                        position: relative !important;
                        top: 0 !important;
                        height: auto !important;
                        max-height: none !important;
                        display: block !important;
                        border-radius: 16px !important;
                        margin-bottom: 20px !important;
                    }

                    .jobs-sidebar-modern .side-bar {
                        position: relative !important;
                        left: auto !important;
                        top: auto !important;
                        width: 100% !important;
                        height: auto !important;
                        box-shadow: none !important;
                        transition: none !important;
                        overflow: visible !important;
                        /* remove theme mobile margin-bottom:30px (highlighted in devtools) */
                        margin-bottom: 0 !important;
                    }

                    /* Desktop uses flex + height:0 trick; on mobile we want normal flow */
                    .jobs-sidebar-modern .sidebar-elements {
                        height: auto !important;
                        min-height: auto !important;
                        flex: none !important;
                        overflow: visible !important;
                        padding: 0 !important; /* prevent white space when collapsed */
                    }

                    .companies-filters-toggle { cursor: pointer; user-select: none; }
                    .companies-filters-header-right { display: flex; align-items: center; gap: 10px; }
                    .companies-filters-arrow {
                        font-size: 20px;
                        color: #0c4a6e;
                        cursor: pointer;
                        display: inline-block !important; /* ensure arrow is visible */
                        line-height: 1;
                    }
                    .companies-filters-toggle.active .companies-filters-arrow { transform: rotate(180deg); }

                    /* Collapsible container */
                    #companies-filters-container {
                        max-height: 0 !important;
                        overflow: hidden !important;
                        opacity: 0 !important;
                        padding: 0 !important; /* remove whitespace under header */
                        visibility: hidden !important;
                        transition: none !important;
                        display: block !important;
                    }
                    #companies-filters-container.show {
                        max-height: 5000px !important;
                        overflow: visible !important;
                        opacity: 1 !important;
                        padding: 16px !important; /* add spacing only when open */
                        visibility: visible !important;
                        display: block !important;
                    }
                }
            </style>

            <script>
                (function () {
                    function initCompaniesFiltersDropdown() {
                        if (window.__companiesFiltersDropdownInitialized) return;
                        window.__companiesFiltersDropdownInitialized = true;

                        var toggle = document.getElementById('companies-filters-toggle');
                        var container = document.getElementById('companies-filters-container');
                        if (!toggle || !container) return;

                        // mobile default collapsed
                        if (window.innerWidth <= 991) {
                            toggle.classList.remove('active');
                            container.classList.remove('show');
                            container.style.setProperty('max-height', '0px', 'important');
                            container.style.setProperty('opacity', '0', 'important');
                            container.style.setProperty('visibility', 'hidden', 'important');
                            container.style.setProperty('overflow', 'hidden', 'important');
                            container.style.setProperty('padding-top', '0', 'important');
                        } else {
                            // Desktop: always visible
                            container.classList.add('show');
                            container.style.setProperty('max-height', 'none', 'important');
                            container.style.setProperty('opacity', '1', 'important');
                            container.style.setProperty('visibility', 'visible', 'important');
                            container.style.setProperty('overflow', 'visible', 'important');
                            container.style.setProperty('padding-top', '0', 'important');
                        }

                        function setOpen(open) {
                            if (open) {
                                toggle.classList.add('active');
                                container.classList.add('show');
                                container.style.setProperty('max-height', '5000px', 'important');
                                container.style.setProperty('opacity', '1', 'important');
                                container.style.setProperty('visibility', 'visible', 'important');
                                container.style.setProperty('overflow', 'visible', 'important');
                                container.style.setProperty('padding-top', '16px', 'important');
                            } else {
                                toggle.classList.remove('active');
                                container.classList.remove('show');
                                container.style.setProperty('max-height', '0px', 'important');
                                container.style.setProperty('opacity', '0', 'important');
                                container.style.setProperty('visibility', 'hidden', 'important');
                                container.style.setProperty('overflow', 'hidden', 'important');
                                container.style.setProperty('padding-top', '0', 'important');
                            }
                        }

                        toggle.addEventListener('click', function (e) {
                            // ignore clear all click
                            if (e.target && e.target.closest && e.target.closest('.btn-clear-all')) return;
                            if (window.innerWidth > 991) return;
                            e.preventDefault();
                            var isOpen = container.classList.contains('show');
                            setOpen(!isOpen);
                        });

                        window.addEventListener('resize', function () {
                            if (window.innerWidth > 991) {
                                container.classList.add('show');
                                container.style.setProperty('max-height', 'none', 'important');
                                container.style.setProperty('opacity', '1', 'important');
                                container.style.setProperty('visibility', 'visible', 'important');
                                container.style.setProperty('overflow', 'visible', 'important');
                                container.style.setProperty('padding-top', '0', 'important');
                            } else {
                                setOpen(false);
                            }
                        });
                    }

                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initCompaniesFiltersDropdown);
                    } else {
                        initCompaniesFiltersDropdown();
                    }
                })();
            </script>

            {{-- Companies Listings --}}
            <div class="col-lg-9 col-md-12 position-relative companies-listing-modern">
                <!-- <div class="companies-toolbar product-filter-wrap">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <button type="button" class="d-block d-md-none btn btn-open-filter">
                            <i class="feather-filter"></i>
                        </button>
                    <span class="woocommerce-result-count-left">
                            @if ($companies->total())
                        {{ __('Showing :from – :to of :total results', [
                            'from' => $companies->firstItem(),
                            'to' => $companies->lastItem(),
                            'total' => $companies->total(),
                        ]) }}
                            @endif
                    </span>
                </div>

                    <div class="woocommerce-ordering twm-filter-select gap-1">
                        <select class="wt-select-bar-2 selectpicker" name="sort_by" id="company-sort-by">
                        @foreach($orderByParams as $key => $value)
                                <option value="{{ $key }}" @selected(request()->query('sort_by') == $key)>{{ $value }}</option>
                        @endforeach
                    </select>
                        <select class="wt-select-bar-2 selectpicker" name="per_page" id="company-per-page">
                        @foreach(JobBoardHelper::getPerPageParams() as $page)
                                <option value="{{ $page }}" @selected(request()->query('per_page') == $page)>{{ __('Show :number', ['number' => $page]) }}</option>
                        @endforeach
                    </select>
                        <select class="wt-select-bar-2 selectpicker" name="layout" id="company-layout">
                            <option value="grid" @selected($layout == 'grid')>{{ __('Grid') }}</option>
                            <option value="list" @selected($layout == 'list')>{{ __('List') }}</option>
                    </select>
                    </div>
            </div> -->

            <div class="companies-wrap" id="companies-listing-container" style="position: relative; min-height: 400px;">
                {!! Theme::partial('loader', ['containerId' => 'companies-loader-overlay', 'size' => 'large', 'text' => 'Loading companies...']) !!}
                <div class="companies-content">
                    @switch($layout)
                        @case('list')
                            {!! Theme::partial('companies.company-list', compact('companies')) !!}
                        @break
                        @default
                            {!! Theme::partial('companies.company-grid', compact('companies')) !!}
                    @endswitch
                    {{ $companies->links(Theme::getThemeNamespace('partials.pagination')) }}
                    </div>
                </div>
            </div>

            {!! Form::open(['url' => route('public.ajax.companies'), 'method' => 'GET', 'id' => 'company-filter-form']) !!}
            <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page')) }}">
            <input type="hidden" name="page" value="{{ BaseHelper::stringify(request()->query('page')) }}">
            <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->style ?: 'grid') }}">
            <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
            {!! Form::close() !!}
        </div>
    </div>
</div>
