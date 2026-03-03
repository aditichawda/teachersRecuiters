<?php
    Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
    $orderByParams = JobBoardHelper::getSortByParams();
    $layout = request()->query('layout') ?: $shortcode->layout;
?>

<?php echo Theme::partial('candidate-card-styles'); ?>


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
    padding-right: 16px;
    border-bottom: 1px solid #f1f5f9;
    background: #fff;
    transition: background 0.2s;
    overflow: visible;
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
    max-height: 100px;
    overflow-y: auto;
    overflow-x: visible;
    padding: 4px 12px 4px 4px;
    margin: 0 -4px;
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
/* Scrollbar styling for all filter containers */
.candidates-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar,
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar {
    width: 4px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-track,
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-track,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-thumb,
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 10px;
}
.candidates-sidebar-modern .twm-sidebar-ele-filter::-webkit-scrollbar-thumb:hover,
.candidates-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb:hover,
.candidates-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-thumb:hover {
    background: #005bb5;
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
    gap: 12px;
    padding: 8px 10px;
    padding-left: 4px;
    transition: all 0.2s;
    border-radius: 8px;
    margin-bottom: 4px;
    margin-left: 0;
    cursor: pointer;
    min-width: 0;
    overflow: visible;
}
.candidates-sidebar-modern .form-check:hover {
    background: #f0f7ff;
    transform: translateX(2px);
}
.candidates-sidebar-modern .form-check-input {
    margin-top: 0;
    margin-left: 0;
    margin-right: 0;
    border: 2px solid #cbd5e1;
    cursor: pointer;
    width: 20px;
    height: 20px;
    min-width: 20px;
    min-height: 20px;
    flex-shrink: 0;
    border-radius: 4px;
    transition: all 0.2s;
    position: relative;
    background-color: #fff;
    overflow: visible;
}
.candidates-sidebar-modern .form-check-input:hover {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
}
.candidates-sidebar-modern .form-check-input:checked {
    background-color: #0073d1;
    border-color: #0073d1;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
    background-size: 14px 14px;
    background-position: center;
    background-repeat: no-repeat;
}
.candidates-sidebar-modern .form-check-input:focus {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.15);
    outline: none;
}
.candidates-sidebar-modern .form-check-label {
    font-size: 14px;
    color: #334155;
    cursor: pointer;
    transition: color 0.2s;
    margin: 0;
    line-height: 1.5;
    font-weight: 500;
    user-select: none;
}
.candidates-sidebar-modern .form-check:hover .form-check-label {
    color: #0073d1;
}
.candidates-sidebar-modern .form-check-input:checked ~ .form-check-label {
    color: #0073d1;
    font-weight: 600;
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

/* Candidate City Search Autocomplete Styling */
.candidate-city-search-wrapper {
    position: relative;
}
.candidate-city-search-input {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #475569;
    background: #f8fafc;
    transition: all 0.2s;
}
.candidate-city-search-input:focus {
    border-color: #0073d1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    background: #fff;
}
.candidate-city-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 1000;
    max-height: 200px;
    overflow-y: auto;
    margin-top: 4px;
}
.candidate-city-suggestion-item {
    padding: 10px 14px;
    cursor: pointer;
    transition: background 0.2s;
    border-bottom: 1px solid #f1f5f9;
}
.candidate-city-suggestion-item:last-child {
    border-bottom: none;
}
.candidate-city-suggestion-item:hover,
.candidate-city-suggestion-item.active {
    background: #f8faff;
}
.candidate-city-suggestion-item .city-name {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 2px;
}
.candidate-city-suggestion-item .city-location {
    font-size: 11px;
    color: #64748b;
}
.candidate-city-loading,
.candidate-city-no-results {
    padding: 12px 14px;
    text-align: center;
    font-size: 12px;
    color: #64748b;
}
.candidate-city-suggestions::-webkit-scrollbar {
    width: 4px;
}
.candidate-city-suggestions::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.candidate-city-suggestions::-webkit-scrollbar-thumb {
    background: #0073d1;
    border-radius: 10px;
}
.candidate-city-suggestions::-webkit-scrollbar-thumb:hover {
    background: #005bb5;
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

/* ===== Candidates Loader (Top-Right Position) ===== */
.candidates-listing {
    position: relative;
    min-height: 400px;
}

.candidates-listing .overlay {
    position: absolute !important;
    top: 0 !important;
    right: 0 !important;
    left: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    min-height: auto !important;
    background: transparent !important;
    backdrop-filter: none;
    display: none;
    align-items: flex-start !important;
    justify-content: flex-end !important;
    z-index: 9999 !important;
    border-radius: 0;
    margin: 0 !important;
    padding: 16px 20px !important;
    box-sizing: border-box !important;
}

.candidates-listing .overlay[style*="display: flex"],
.candidates-listing .overlay.show {
    display: flex !important;
}

.candidates-listing .overlay .blue-loader {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(0, 115, 209, 0.2);
    border-top-color: #0073d1;
    border-radius: 50%;
    animation: blue-spin 0.8s linear infinite;
    position: relative;
    margin: 0;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0, 115, 209, 0.3);
}

.candidates-listing .overlay .blue-loader.large {
    width: 40px;
    height: 40px;
    border-width: 4px;
}

@keyframes blue-spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.candidates-listing {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

#candidates-listing-container {
    position: relative !important;
    min-height: 400px;
    width: 100%;
    display: block;
}

.twm-candidates-list-wrap.candidates-listing {
    position: relative !important;
    min-height: 400px;
    width: 100%;
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">
        <div class="cand-heading">
            <?php if($shortcode->title || $shortcode->subtitle): ?>
                <?php if($shortcode->subtitle): ?>
                    <h2><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
                <?php endif; ?>
                <?php if($shortcode->title): ?>
                    <p><?php echo BaseHelper::clean($shortcode->title); ?></p>
                <?php endif; ?>
            <?php else: ?>
                <h2><?php echo e(__('Candidates')); ?></h2>
                <p><?php echo e(__('Find talented teachers ready to make a difference')); ?></p>
            <?php endif; ?>
        </div>

        <div class="section-content">
            <div class="candidates candidates-container">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-12 candidates-sidebar-modern">
                        <div class="side-bar-filter">
                            <div class="backdrop"></div>
                            <div class="side-bar p-0">
                                <div class="sidebar-elements search-bx">
                                    <button class="d-md-none position-absolute btn btn-link btn-close-filter" style="top: 10px; right: 10px; z-index: 10;">
                                        <i class="feather-x"></i>
                                    </button>
                                    
                                    
                                    <div class="sidebar-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
                                        <h4 style="font-size: 16px; font-weight: 700; color: #ffffff; margin: 0; display: flex; align-items: center; gap: 8px;">
                                            <i class="feather-filter" style="color:rgb(255, 255, 255);"></i>
                                            <?php echo e(__('Filters')); ?>

                                        </h4>
                                        <button type="button" class="btn-clear-filters" id="clear-all-candidate-filters" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 14px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; cursor: pointer;">
                                            <i class="feather-x-circle" style="font-size: 14px;"></i>
                                            <?php echo e(__('Clear All')); ?>

                                        </button>
                                    </div>
                                    
                                    <form action="<?php echo e(request()->url()); ?>" method="get" id="candidate-filter-form" class="p-2">
                                        
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(__('Keyword / Subject / Post')); ?></label>
                                            <input type="text" name="keyword" class="form-control" placeholder="<?php echo e(__('Search by name, subject, or post...')); ?>" value="<?php echo e(request('keyword')); ?>" autocomplete="off">
                                        </div>

                                        
                                        <?php if(is_plugin_active('location')): ?>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(__('Location')); ?></label>
                                                <?php
                                                    $selectedCityId = request('city_id');
                                                    $selectedCityName = '';
                                                    if ($selectedCityId) {
                                                        $city = \Botble\Location\Models\City::find($selectedCityId);
                                                        $selectedCityName = $city ? $city->name : '';
                                                    }
                                                ?>
                                                <div class="candidate-city-search-wrapper" style="position: relative;">
                                                    <input type="text" name="city_search" id="candidate_city_search" class="form-control candidate-city-search-input" placeholder="<?php echo e(__('Select City')); ?>" autocomplete="off" value="<?php echo e(request('city_search', $selectedCityName)); ?>" />
                                                    <input type="hidden" name="city_id" id="candidate_city_id" value="<?php echo e($selectedCityId); ?>" />
                                                    <div class="candidate-city-suggestions" id="candidate-city-suggestions" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000; max-height: 200px; overflow-y: auto; margin-top: 4px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(__('Radius (km)')); ?></label>
                                                <input type="number" name="radius" class="form-control" placeholder="10" value="<?php echo e(request('radius')); ?>" min="1" max="100">
                                            </div>
                                        <?php endif; ?>

                                        
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(__('Last Updated')); ?></label>
                                            <select name="last_updated" class="form-control">
                                                <option value=""><?php echo e(__('Any Time')); ?></option>
                                                <option value="last_24_hours" <?php echo e(request('last_updated') == 'last_24_hours' ? 'selected' : ''); ?>><?php echo e(__('Last 24 Hours')); ?></option>
                                                <option value="last_7_days" <?php echo e(request('last_updated') == 'last_7_days' ? 'selected' : ''); ?>><?php echo e(__('Last 7 Days')); ?></option>
                                                <option value="last_30_days" <?php echo e(request('last_updated') == 'last_30_days' ? 'selected' : ''); ?>><?php echo e(__('Last 30 Days')); ?></option>
                                                <option value="last_3_months" <?php echo e(request('last_updated') == 'last_3_months' ? 'selected' : ''); ?>><?php echo e(__('Last 3 Months')); ?></option>
                                            </select>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Position Type')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="position_type[]" value="teaching" id="filter-teaching" <?php echo e(in_array('teaching', (array)request('position_type', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-teaching"><?php echo e(__('Teaching')); ?></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="position_type[]" value="non_teaching" id="filter-non-teaching" <?php echo e(in_array('non_teaching', (array)request('position_type', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-non-teaching"><?php echo e(__('Non-Teaching')); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Gender')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="gender[]" value="male" id="filter-gender-male" <?php echo e(in_array('male', (array)request('gender', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-gender-male"><?php echo e(__('Male')); ?></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="gender[]" value="female" id="filter-gender-female" <?php echo e(in_array('female', (array)request('gender', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-gender-female"><?php echo e(__('Female')); ?></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="gender[]" value="other" id="filter-gender-other" <?php echo e(in_array('other', (array)request('gender', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-gender-other"><?php echo e(__('Other')); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Marital Status')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="marital_status[]" value="single" id="filter-marital-single" <?php echo e(in_array('single', (array)request('marital_status', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-marital-single"><?php echo e(__('Single')); ?></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="marital_status[]" value="married" id="filter-marital-married" <?php echo e(in_array('married', (array)request('marital_status', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-marital-married"><?php echo e(__('Married')); ?></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="marital_status[]" value="divorced" id="filter-marital-divorced" <?php echo e(in_array('divorced', (array)request('marital_status', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-marital-divorced"><?php echo e(__('Divorced')); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Institution Type')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <?php
                                                    $instTypes = [
                                                        'cbse_school' => 'CBSE',
                                                        'icse_school' => 'ICSE',
                                                        'cambridge_school' => 'Cambridge',
                                                        'ib_school' => 'IB',
                                                        'state_board_school' => 'State Board',
                                                        'play_school' => 'Play School',
                                                        'engineering_college' => 'Engineering',
                                                        'medical_college' => 'Medical',
                                                        'nursing_college' => 'Nursing',
                                                        'edtech_company' => 'EdTech',
                                                        'coaching_institute' => 'Coaching',
                                                        'university' => 'University'
                                                    ];
                                                    $selectedInstTypes = (array)request('institution_types', []);
                                                ?>
                                                <?php $__currentLoopData = $instTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="institution_types[]" value="<?php echo e($key); ?>" id="filter-inst-<?php echo e($key); ?>" <?php echo e(in_array($key, $selectedInstTypes) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="filter-inst-<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Qualification Level')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <?php
                                                    $qualLevels = [
                                                        'diploma' => 'Diploma',
                                                        'bachelors' => "Bachelor's",
                                                        'masters' => "Master's",
                                                        'phd' => 'PhD',
                                                        'post_graduate' => 'Post Graduate'
                                                    ];
                                                    $selectedQuals = (array)request('qualification_levels', []);
                                                ?>
                                                <?php $__currentLoopData = $qualLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="qualification_levels[]" value="<?php echo e($key); ?>" id="filter-qual-<?php echo e($key); ?>" <?php echo e(in_array($key, $selectedQuals) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="filter-qual-<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Certifications')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <?php
                                                    $certs = [
                                                        'b_ed' => 'B.Ed',
                                                        'm_ed' => 'M.Ed',
                                                        'ctet' => 'CTET',
                                                        'tet' => 'TET',
                                                        'net' => 'NET',
                                                        'set' => 'SET',
                                                        'phd' => 'PhD'
                                                    ];
                                                    $selectedCerts = (array)request('certifications', []);
                                                ?>
                                                <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="certifications[]" value="<?php echo e($key); ?>" id="filter-cert-<?php echo e($key); ?>" <?php echo e(in_array($key, $selectedCerts) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="filter-cert-<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(__('Experience (years)')); ?></label>
                                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                                <input type="number" name="experience_min" class="form-control" placeholder="<?php echo e(__('Min')); ?>" value="<?php echo e(request('experience_min')); ?>" min="0" max="50">
                                                <input type="number" name="experience_max" class="form-control" placeholder="<?php echo e(__('Max')); ?>" value="<?php echo e(request('experience_max')); ?>" min="0" max="50">
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(__('Expected Salary (₹)')); ?></label>
                                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                                <input type="number" name="salary_min" class="form-control" placeholder="<?php echo e(__('Min')); ?>" value="<?php echo e(request('salary_min')); ?>" min="0">
                                                <input type="number" name="salary_max" class="form-control" placeholder="<?php echo e(__('Max')); ?>" value="<?php echo e(request('salary_max')); ?>" min="0">
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Languages')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <?php
                                                    $languages = ['English', 'Hindi', 'Marathi', 'Gujarati', 'Tamil', 'Telugu', 'Kannada', 'Malayalam', 'Bengali', 'Punjabi', 'Urdu'];
                                                    $selectedLangs = (array)request('languages', []);
                                                ?>
                                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="languages[]" value="<?php echo e($lang); ?>" id="filter-lang-<?php echo e(strtolower($lang)); ?>" <?php echo e(in_array($lang, $selectedLangs) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="filter-lang-<?php echo e(strtolower($lang)); ?>"><?php echo e($lang); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Current Status')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="current_status[]" value="working" id="filter-status-working" <?php echo e(in_array('working', (array)request('current_status', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-status-working"><?php echo e(__('Working Now')); ?></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="current_status[]" value="not_working" id="filter-status-not-working" <?php echo e(in_array('not_working', (array)request('current_status', [])) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-status-not-working"><?php echo e(__('Not Working')); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Notice Period')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <?php
                                                    $noticePeriods = [
                                                        'immediate' => 'Immediate',
                                                        '15_days' => '15 Days',
                                                        '1_month' => '1 Month',
                                                        '2_months' => '2 Months',
                                                        '3_months' => '3 Months',
                                                        'more_than_3_months' => 'More than 3 Months'
                                                    ];
                                                    $selectedNotice = (array)request('notice_period', []);
                                                ?>
                                                <?php $__currentLoopData = $noticePeriods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="notice_period[]" value="<?php echo e($key); ?>" id="filter-notice-<?php echo e($key); ?>" <?php echo e(in_array($key, $selectedNotice) ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="filter-notice-<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="section-head-small"><?php echo e(__('Immediate Joiner')); ?></label>
                                            <div class="twm-sidebar-ele-filter">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="immediate_joiner" value="1" id="filter-immediate-joiner" <?php echo e(request('immediate_joiner') == '1' ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="filter-immediate-joiner"><?php echo e(__('Available for Immediate Joining')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="per_page" value="<?php echo e(BaseHelper::stringify(request()->query('per_page', 12))); ?>">
                                        <input type="hidden" name="page" value="<?php echo e(request()->query('page', 1)); ?>" id="filter-page-input">
                                        <input type="hidden" name="layout" value="list">
                                        <input type="hidden" name="sort_by" value="<?php echo e(BaseHelper::stringify(request()->query('sort_by'))); ?>">
                                        
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="feather-filter" style="margin-right: 6px;"></i>
                                                <?php echo e(__('Apply Filters')); ?>

                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-9 col-md-12 position-relative candidates-listing-modern">
                        <!-- <div class="candidates-toolbar product-filter-wrap" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 20px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,.04);">
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="d-block d-md-none btn btn-open-filter" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px;">
                                    <i class="feather-filter"></i>
                                </button>
                                <span class="woocommerce-result-count-left" style="font-size: 14px; color: #64748b; font-weight: 500;">
                                <?php if($candidates->total()): ?>
                                    <?php echo e(__('Showing :from – :to of :total results', [
                                        'from'  => $candidates->firstItem(),
                                        'to'    => $candidates->lastItem(),
                                        'total' => $candidates->total(),
                                    ])); ?>

                                <?php endif; ?>
                            </span>
                            </div>
                        </div>

                        
                        <div class="candidates-toolbar product-filter-wrap">
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="d-block d-md-none btn btn-open-filter" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px;">
                                    <i class="feather-filter"></i>
                                </button>
                                <span class="woocommerce-result-count-left">
                                    <?php if($candidates->total()): ?>
                                        <?php echo e(__('Showing :from – :to of :total results', [
                                            'from'  => $candidates->firstItem(),
                                            'to'    => $candidates->lastItem(),
                                            'total' => $candidates->total(),
                                        ])); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        </div> -->

                        <div class="twm-candidates-list-wrap candidates-listing" id="candidates-listing-container" style="position: relative;">
                            
                            <?php echo $__env->make(Theme::getThemeNamespace('partials.loader'), [
                                'size' => 'large',
                                'overlay' => true,
                                'containerId' => 'candidates-loader-overlay',
                                'show' => false
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.candidates.index'), ['layout' => 'list'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
                if (input.name === 'page') {
                    // Reset page to 1 when clearing filters
                    input.value = '1';
                } else if (input.type === 'checkbox') {
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
            
            // Show loader
            if (typeof $ !== 'undefined') {
                const $overlay = $('.candidates-listing .overlay');
                if ($overlay.length) {
                    $overlay.css('display', 'flex').addClass('show');
                }
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
    
    // Loader functionality for form submission
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            // If form is submitted from filter change (not pagination), reset page to 1
            const pageInput = filterForm.querySelector('#filter-page-input');
            const isPaginationClick = filterForm.dataset.paginationSubmit === 'true';
            
            if (!isPaginationClick && pageInput) {
                // Check if any filter value changed (except page)
                const currentUrl = new URL(window.location.href);
                const formData = new FormData(filterForm);
                let filterChanged = false;
                
                for (const [key, value] of formData.entries()) {
                    if (key !== 'page' && key !== 'layout' && key !== 'per_page' && key !== 'sort_by') {
                        const urlValue = currentUrl.searchParams.get(key);
                        if (urlValue !== value) {
                            filterChanged = true;
                            break;
                        }
                    }
                }
                
                // If filter changed, reset to page 1
                if (filterChanged) {
                    pageInput.value = '1';
                }
            }
            
            // Reset pagination flag
            filterForm.dataset.paginationSubmit = 'false';
            
            // Show loader immediately
            if (typeof window.LoaderHelper !== 'undefined') {
                LoaderHelper.show('candidates-loader-overlay');
            } else if (typeof $ !== 'undefined') {
                $('#candidates-loader-overlay').css('display', 'flex').addClass('show');
            }
            // Scroll to top
            if (typeof $ !== 'undefined') {
                $('html, body').animate({
                    scrollTop: $('.candidates-container, .candidates-listing').first().offset().top - 130
                }, 0);
            }
            // Allow form to submit normally (full page reload)
            // Loader will be visible during page transition
        });
    }
    
    // Also handle filter changes (like select dropdowns, checkboxes) that trigger auto-submit
    if (filterForm) {
        const filterInputs = filterForm.querySelectorAll('select, input[type="checkbox"], input[type="radio"]');
        filterInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                // Reset page to 1 when filters change
                const pageInput = filterForm.querySelector('#filter-page-input');
                if (pageInput) {
                    pageInput.value = '1';
                }
            // Show loader
            if (typeof window.LoaderHelper !== 'undefined') {
                LoaderHelper.show('candidates-loader-overlay');
            } else if (typeof $ !== 'undefined') {
                $('#candidates-loader-overlay').css('display', 'flex').addClass('show');
            }
            // Scroll to top
            if (typeof $ !== 'undefined') {
                $('html, body').animate({
                    scrollTop: $('.candidates-container, .candidates-listing').first().offset().top - 130
                }, 0);
            }
                // Submit form
                filterForm.submit();
            });
        });
    }
    
    // Handle pagination clicks
    if (typeof $ !== 'undefined') {
        $(document).on('click', '.pagination a, .pagination-button', function(e) {
            e.preventDefault();
            
            const $link = $(this);
            const href = $link.attr('href');
            const page = $link.data('page') || (href ? new URL(href, window.location.origin).searchParams.get('page') : null);
            
            if (page && filterForm) {
                // Mark as pagination submit
                filterForm.dataset.paginationSubmit = 'true';
                
                // Update page input in form
                const pageInput = filterForm.querySelector('#filter-page-input');
                if (pageInput) {
                    pageInput.value = page;
                }
                
                // Show loader
                if (typeof window.LoaderHelper !== 'undefined') {
                    LoaderHelper.show('candidates-loader-overlay');
                } else if (typeof $ !== 'undefined') {
                    $('#candidates-loader-overlay').css('display', 'flex').addClass('show');
                }
                // Scroll to top
                if (typeof $ !== 'undefined') {
                    $('html, body').animate({
                        scrollTop: $('.candidates-container, .candidates-listing').first().offset().top - 130
                    }, 0);
                }
                
                // Submit form with new page
                filterForm.submit();
            } else if (href && href !== 'javascript:;') {
                // Fallback: navigate directly if href is available
                window.location.href = href;
            }
        });
    }
    
    // Initialize Candidate City Search Autocomplete
    function initCandidateCitySearch() {
        const $cityInput = $('#candidate_city_search');
        const $cityId = $('#candidate_city_id');
        const $suggestions = $('#candidate-city-suggestions');
        let searchTimeout = null;
        let activeSuggestionIndex = -1;

        if (!$cityInput.length) return;

        // City search autocomplete
        $cityInput.on('input', function() {
            const keyword = $(this).val().trim();
            activeSuggestionIndex = -1;

            // Clear city selection when user types
            $cityId.val('');

            if (searchTimeout) clearTimeout(searchTimeout);

            if (keyword.length < 2) {
                $suggestions.hide().empty();
                return;
            }

            $suggestions.html('<div class="candidate-city-loading">Searching...</div>').show();

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: (window.siteUrl || window.location.origin) + '/ajax/search-cities',
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    data: { k: keyword },
                    success: function(response) {
                        console.log('City search response:', response);
                        
                        // Handle different response formats
                        let cities = [];
                        if (Array.isArray(response)) {
                            cities = response;
                        } else if (response && response.data) {
                            if (Array.isArray(response.data)) {
                                cities = response.data;
                            } else if (response.data.cities && Array.isArray(response.data.cities)) {
                                cities = response.data.cities;
                            } else if (typeof response.data === 'object' && response.data.length !== undefined) {
                                cities = response.data;
                            }
                        } else if (response && response.cities) {
                            cities = response.cities;
                        }
                        
                        console.log('Parsed cities:', cities);
                        
                        if (!cities || cities.length === 0) {
                            $suggestions.html('<div class="candidate-city-no-results" style="padding: 12px 16px; font-size: 13px; color: #64748b; text-align: center;">No cities found</div>');
                            return;
                        }

                        let html = '';
                        cities.forEach(function(city) {
                            if (!city || !city.id || !city.name) return;
                            
                            const locationParts = [];
                            if (city.state_name) locationParts.push(city.state_name);
                            if (city.country_name) locationParts.push(city.country_name);
                            
                            html += '<div class="candidate-city-suggestion-item" ' +
                                'data-id="' + city.id + '" ' +
                                'data-name="' + city.name + '" ' +
                                'style="padding: 10px 16px; cursor: pointer; font-size: 13px; color: #1f2937; border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;">' +
                                '<div class="city-name" style="font-weight: 500;">' + city.name + '</div>' +
                                (locationParts.length ? '<div class="city-location" style="font-size: 11px; color: #6b7280; margin-top: 2px;">' + locationParts.join(', ') + '</div>' : '') +
                                '</div>';
                        });

                        $suggestions.html(html);
                    },
                    error: function(xhr, status, error) {
                        console.error('City search error:', {
                            status: status,
                            error: error,
                            responseText: xhr.responseText,
                            statusCode: xhr.status,
                            responseJSON: xhr.responseJSON
                        });
                        $suggestions.html('<div class="candidate-city-no-results" style="padding: 12px 16px; font-size: 13px; color: #dc2626; text-align: center;">Error searching cities. Please try again.</div>');
                    }
                });
            }, 300);
        });

        // Keyboard navigation for suggestions
        $cityInput.on('keydown', function(e) {
            const $items = $suggestions.find('.candidate-city-suggestion-item');

            if (!$suggestions.is(':visible') || $items.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
                $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
                $suggestions.scrollTop($items.eq(activeSuggestionIndex).position().top + $suggestions.scrollTop() - 50);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, 0);
                $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
                $suggestions.scrollTop($items.eq(activeSuggestionIndex).position().top + $suggestions.scrollTop() - 50);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (activeSuggestionIndex >= 0) {
                    $items.eq(activeSuggestionIndex).trigger('click');
                }
            } else if (e.key === 'Escape') {
                $suggestions.hide();
            }
        });

        // Select city from suggestions
        $(document).on('click', '.candidate-city-suggestion-item', function() {
            const $item = $(this);
            const cityId = $item.data('id');
            const cityName = $item.data('name');

            // Set city
            $cityInput.val(cityName);
            $cityId.val(cityId);
            $suggestions.hide();
        });

        // Close suggestions on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.candidate-city-search-wrapper').length) {
                $suggestions.hide();
            }
        });

        // Load city name if city_id is already set
        const existingCityId = $cityId.val();
        if (existingCityId) {
            $.ajax({
                url: (window.siteUrl || window.location.origin) + '/ajax/search-cities',
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                data: { city_id: existingCityId },
                success: function(response) {
                    let cities = [];
                    if (Array.isArray(response)) {
                        cities = response;
                    } else if (response.data) {
                        cities = Array.isArray(response.data) ? response.data : (response.data.cities || []);
                    } else if (response.cities) {
                        cities = response.cities;
                    }
                    if (cities.length > 0) {
                        $cityInput.val(cities[0].name);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading city:', error);
                }
            });
        }
    }
    
    // Initialize city search
    if (typeof $ !== 'undefined') {
        initCandidateCitySearch();
    }
});
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/candidates/style-1.blade.php ENDPATH**/ ?>