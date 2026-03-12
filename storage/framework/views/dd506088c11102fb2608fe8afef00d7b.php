<?php
    use Botble\Base\Facades\BaseHelper;
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    use Botble\Base\Enums\BaseStatusEnum;
    use Botble\JobBoard\Repositories\Interfaces\JobTypeInterface;
    
    // Get cities for location dropdown
    $cities = collect();
    if (is_plugin_active('location')) {
        $cities = app(\Botble\Location\Repositories\Interfaces\CityInterface::class)->advancedGet([
            'condition' => ['status' => BaseStatusEnum::PUBLISHED],
            'order_by' => ['order' => 'ASC', 'name' => 'ASC'],
            'take' => 500, // Get all cities from database
            'with' => ['state', 'country'],
        ]);
    }
    
    Theme::asset()->usePath()->add('leaflet-markercluster-css', 'plugins/leaflet.markercluster/MarkerCluster.css');
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::asset()->container('footer')->usePath()->add('leaflet-markercluster-js', 'plugins/leaflet.markercluster/leaflet.markercluster.js');
    Theme::asset()->container('footer')->usePath()->add('jobs-js', 'js/jobs.js', ['leaflet-js', 'leaflet-markercluster-js'], [], get_cms_version());

    $layout = \Theme\Jobzilla\Supports\ThemeHelper::getCurrentLayout();
    
    $allCategories = app(CategoryInterface::class)->advancedGet([
        'condition' => ['status' => BaseStatusEnum::PUBLISHED],
        'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
    ]);
    
    // Get institution types (root categories or specific parent)
    $institutionTypes = $allCategories->where('parent_id', 0)->take(20);
    
    // Get job roles (categories - fetch all published categories from database)
    $jobRoles = app(CategoryInterface::class)->advancedGet([
        'condition' => ['status' => BaseStatusEnum::PUBLISHED],
        'order_by' => ['order' => 'ASC', 'name' => 'ASC'],
        'take' => 500, // Get all job roles from database
    ]);
    
    // Get job types
    $jobTypes = app(JobTypeInterface::class)->advancedGet([
        'condition' => ['status' => BaseStatusEnum::PUBLISHED],
    ]);
?>

<?php echo Theme::partial('jobs-card-styles'); ?>


<style>
/* Enhanced Heading Styles */
.jobs-sc-heading {
    text-align: center;
    padding: 6px 0 4px;
    background: linear-gradient(135deg, rgba(0, 115, 209, 0.05) 0%, rgba(0, 168, 255, 0.02) 50%, rgba(255, 255, 255, 0) 100%);
    margin-bottom: 50px;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}
.jobs-sc-heading::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 50%, rgba(0, 115, 209, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(0, 168, 255, 0.06) 0%, transparent 50%);
    pointer-events: none;
}
.jobs-sc-heading h2 {
    font-size: 48px;
    font-weight: 900;
    background: black;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 16px;
    position: relative;
    display: inline-block;
    letter-spacing: -1px;
    animation: fadeInUp 0.6s ease-out;
}
.jobs-sc-heading h2::after {
    content: '';
    display: block;
    width: 100px;
    height: 6px;
    background: black;
    border-radius: 10px;
    margin: 18px auto 0;
    box-shadow: 0 4px 16px rgba(0, 115, 209, 0.4);
    animation: expandWidth 0.8s ease-out 0.3s both;
}
.jobs-sc-heading p {
    font-size: 18px;
    color: #475569;
    margin-bottom: 0;
    font-weight: 500;
    margin-top: 12px;
    position: relative;
    animation: fadeInUp 0.6s ease-out 0.2s both;
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes expandWidth {
    from {
        width: 0;
    }
    to {
        width: 100px;
    }
}

/* Enhanced Top Filter Section */
.jobs-top-filter {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    padding: 40px;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
    margin-bottom: 45px;
    border: 1px solid rgba(0, 115, 209, 0.12);
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.6s ease-out 0.4s both;
}

.jobs-top-filter::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #0073d1 0%, #00a8ff 30%, #0073d1 60%, #00a8ff 100%);
    background-size: 200% 100%;
    animation: shimmer 3s ease-in-out infinite;
}
@keyframes shimmer {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.jobs-top-filter::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 115, 209, 0.03) 0%, transparent 70%);
    pointer-events: none;
}

.jobs-top-filter .filter-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
    flex-wrap: wrap;
}

@media(max-width: 991px) {
    .jobs-top-filter .filter-row {
        flex-wrap: wrap;
    }
}

@media(max-width: 767px) {
    .jobs-top-filter .filter-row {
        flex-direction: column;
        gap: 16px;
    }
}

.jobs-top-filter .filter-group {
    position: relative;
    animation: fadeInUp 0.5s ease-out both;
    flex: 0 0 auto;
}

.jobs-top-filter .filter-row .filter-group {
    min-width: 180px;
    flex: 1 1 0;
    max-width: 250px;
}

.jobs-top-filter .filter-row .filter-actions {
    flex: 0 0 auto;
    min-width: auto;
    max-width: none;
    margin-left: auto;
}

@media(max-width: 991px) {
    .jobs-top-filter .filter-row .filter-group {
        min-width: 160px;
        max-width: 220px;
    }
}

@media(max-width: 767px) {
    .jobs-top-filter .filter-row .filter-group {
        min-width: 100%;
        max-width: 100%;
    }
    
    .jobs-top-filter .filter-row .filter-actions {
        width: 100%;
        justify-content: space-between;
    }
    
    .jobs-top-filter .filter-row .filter-actions > div {
        width: 100%;
        display: flex;
        gap: 12px;
    }
    
    .clear-filter-btn,
    .search-btn {
        flex: 1;
        justify-content: center;
    }
}

.jobs-top-filter .filter-group:nth-child(1) { animation-delay: 0.1s; }
.jobs-top-filter .filter-group:nth-child(2) { animation-delay: 0.2s; }
.jobs-top-filter .filter-group:nth-child(3) { animation-delay: 0.3s; }
.jobs-top-filter .filter-group:nth-child(4) { animation-delay: 0.4s; }

.jobs-top-filter .filter-group label {
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    position: relative;
}
.jobs-top-filter .filter-group label i {
    color: #0073d1;
    font-size: 14px;
    opacity: 0.8;
}

.jobs-top-filter .filter-group input[type="text"],
.jobs-top-filter .filter-group select {
    width: 100%;
    padding: 16px 18px;
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    font-size: 15px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #ffffff;
    color: #1e293b;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
}

.jobs-top-filter .filter-group input[type="text"]:hover,
.jobs-top-filter .filter-group select:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
    transform: translateY(-1px);
}

.jobs-top-filter .filter-group input[type="text"]:focus,
.jobs-top-filter .filter-group select:focus {
    outline: none;
    border-color: #003d82;
    box-shadow: 0 0 0 5px rgba(0, 61, 130, 0.1), 0 6px 20px rgba(0, 61, 130, 0.15);
    transform: translateY(-2px);
    background: #ffffff;
}

/* Keyword input below job role dropdown */
.jobs-top-filter .filter-group .keyword-input-below {
    margin-top: 10px;
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    color: #1e293b;
    background: #ffffff;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
}

.jobs-top-filter .filter-group .keyword-input-below:focus {
    outline: none;
    border-color: #003d82;
    box-shadow: 0 0 0 5px rgba(0,61,130,.1), 0 6px 20px rgba(0,61,130,.15);
    transform: translateY(-2px);
    background: #ffffff;
}

.jobs-top-filter .filter-group .keyword-input-below:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
    transform: translateY(-1px);
}

/* Bootstrap Select (selectpicker) Styling - High Specificity */
.jobs-top-filter .filter-group .bootstrap-select,
.jobs-top-filter .filter-group .bootstrap-select.form-control {
    width: 100% !important;
    display: block !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle {
    width: 100% !important;
    padding: 16px 18px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 14px !important;
    font-size: 15px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    background: #ffffff !important;
    background-color: #ffffff !important;
    color: #1e293b !important;
    font-weight: 500 !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02) !important;
    min-height: auto !important;
    height: auto !important;
    line-height: 1.5 !important;
    text-align: left !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle:hover,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle:hover {
    border-color: #cbd5e1 !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04) !important;
    transform: translateY(-1px);
    background: #ffffff !important;
    background-color: #ffffff !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle:focus,
.jobs-top-filter .filter-group .bootstrap-select.show .dropdown-toggle,
.jobs-top-filter .filter-group .bootstrap-select.open .dropdown-toggle,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle:focus,
.jobs-top-filter .filter-group .bootstrap-select.form-control.show .dropdown-toggle {
    outline: none !important;
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 5px rgba(0, 115, 209, 0.1), 0 6px 20px rgba(0, 115, 209, 0.15) !important;
    transform: translateY(-2px);
    background: #ffffff !important;
    background-color: #ffffff !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle .filter-option,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle .filter-option {
    color: #1e293b !important;
    font-weight: 500 !important;
    padding: 0 !important;
    text-align: left !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle .filter-option-inner,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle .filter-option-inner {
    color: #1e293b !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle .caret,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle .caret {
    color: #64748b !important;
    border-top-color: #64748b !important;
    border-width: 6px 6px 0 6px !important;
    margin-top: -3px !important;
    right: 18px !important;
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Fix dropdown arrow using ::after pseudo-element */
.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle::after,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle::after {
    content: "" !important;
    position: absolute !important;
    right: 18px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    width: 0 !important;
    height: 0 !important;
    border-left: 5px solid transparent !important;
    border-right: 5px solid transparent !important;
    border-top: 6px solid #64748b !important;
    margin: 0 !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: none !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle.bs-placeholder,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle.bs-placeholder {
    color: #94a3b8 !important;
}

.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle.bs-placeholder .filter-option,
.jobs-top-filter .filter-group .bootstrap-select.form-control .dropdown-toggle.bs-placeholder .filter-option {
    color: #94a3b8 !important;
}

/* Bootstrap Select Multiple (for Job Type and Job Role) */
.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle {
    width: 100% !important;
    padding: 16px 18px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 14px !important;
    font-size: 15px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    background: #ffffff !important;
    background-color: #ffffff !important;
    color: #1e293b !important;
    font-weight: 500 !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02) !important;
    min-height: auto !important;
    height: auto !important;
    line-height: 1.5 !important;
    text-align: left !important;
}

.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle:hover,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle:hover {
    border-color: #cbd5e1 !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04) !important;
    transform: translateY(-1px);
    background: #ffffff !important;
    background-color: #ffffff !important;
}

.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle:focus,
.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"].show .dropdown-toggle,
.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"].open .dropdown-toggle,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle:focus,
.jobs-top-filter .filter-group .bootstrap-select.multiple.show .dropdown-toggle {
    outline: none !important;
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 5px rgba(0, 115, 209, 0.1), 0 6px 20px rgba(0, 115, 209, 0.15) !important;
    transform: translateY(-2px);
    background: #ffffff !important;
    background-color: #ffffff !important;
}

.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle .filter-option,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle .filter-option {
    color: #1e293b !important;
    font-weight: 500 !important;
    padding: 0 !important;
    text-align: left !important;
}

.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle .filter-option-inner,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle .filter-option-inner {
    color: #1e293b !important;
}

/* Fix dropdown arrow for multiple selects */
.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle .caret,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle .caret {
    color: #64748b !important;
    border-top-color: #64748b !important;
    border-width: 6px 6px 0 6px !important;
    margin-top: -3px !important;
    right: 18px !important;
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.jobs-top-filter .filter-group .bootstrap-select[data-multiple="true"] .dropdown-toggle::after,
.jobs-top-filter .filter-group .bootstrap-select.multiple .dropdown-toggle::after {
    content: "" !important;
    position: absolute !important;
    right: 18px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    width: 0 !important;
    height: 0 !important;
    border-left: 5px solid transparent !important;
    border-right: 5px solid transparent !important;
    border-top: 6px solid #64748b !important;
    margin: 0 !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: none !important;
}

/* Select2 Styling (if Select2 is being used instead) */
.jobs-top-filter .filter-group .select2-container {
    width: 100% !important;
}

.jobs-top-filter .filter-group .select2-container--default .select2-selection--single,
.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple {
    padding: 16px 18px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 14px !important;
    font-size: 15px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    background: #ffffff !important;
    background-color: #ffffff !important;
    color: #1e293b !important;
    font-weight: 500 !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02) !important;
    height: auto !important;
    min-height: 50px !important;
}

.jobs-top-filter .filter-group .select2-container--default .select2-selection--single:hover,
.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple:hover {
    border-color: #cbd5e1 !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04) !important;
    transform: translateY(-1px);
}

.jobs-top-filter .filter-group .select2-container--default.select2-container--focus .select2-selection--single,
.jobs-top-filter .filter-group .select2-container--default.select2-container--open .select2-selection--single,
.jobs-top-filter .filter-group .select2-container--default.select2-container--focus .select2-selection--multiple,
.jobs-top-filter .filter-group .select2-container--default.select2-container--open .select2-selection--multiple {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 5px rgba(0, 115, 209, 0.1), 0 6px 20px rgba(0, 115, 209, 0.15) !important;
    transform: translateY(-2px);
}

.jobs-top-filter .filter-group .select2-container--default .select2-selection--single .select2-selection__rendered,
.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple .select2-selection__rendered {
    color: #1e293b !important;
    font-weight: 500 !important;
    padding: 0 !important;
    line-height: 1.5 !important;
}

.jobs-top-filter .filter-group .select2-container--default .select2-selection--single .select2-selection__placeholder,
.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #94a3b8 !important;
}

/* Fix Select2 dropdown arrow */
.jobs-top-filter .filter-group .select2-container--default .select2-selection--single .select2-selection__arrow,
.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple .select2-selection__arrow {
    position: absolute !important;
    right: 18px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    height: auto !important;
    width: auto !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.jobs-top-filter .filter-group .select2-container--default .select2-selection--single .select2-selection__arrow b,
.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple .select2-selection__arrow b {
    border-color: #64748b transparent transparent transparent !important;
    border-style: solid !important;
    border-width: 6px 5px 0 5px !important;
    height: 0 !important;
    width: 0 !important;
    margin-left: -5px !important;
    margin-top: -3px !important;
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #0073d1 !important;
    border-color: #0073d1 !important;
    color: #ffffff !important;
    border-radius: 6px !important;
    padding: 4px 10px !important;
    margin: 2px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
}

.jobs-top-filter .filter-group input[type="text"]::placeholder {
    color: #94a3b8;
    font-weight: 400;
}

.jobs-top-filter .filter-group .location-input-wrapper,
.jobs-top-filter .filter-group .keyword-input-wrapper {
    position: relative;
}

.jobs-top-filter .filter-group .location-input-wrapper i,
.jobs-top-filter .filter-group .keyword-input-wrapper i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #0073d1;
    font-size: 18px;
    z-index: 1;
}

.jobs-top-filter .filter-group .location-input-wrapper input,
.jobs-top-filter .filter-group .keyword-input-wrapper input {
    padding-left: 45px;
}

/* Enhanced Radius Slider */
.radius-slider-wrapper {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 12px 0;
    background: #f8fafc;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.radius-slider {
    flex: 1;
    height: 10px;
    border-radius: 10px;
    background: linear-gradient(90deg, #e2e8f0 0%, #cbd5e1 50%, #e2e8f0 100%);
    outline: none;
    -webkit-appearance: none;
    cursor: pointer;
    position: relative;
}

.radius-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0073d1 0%, #00a8ff 100%);
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.4), 0 0 0 4px rgba(0, 115, 209, 0.1);
    transition: all 0.3s;
}

.radius-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
    box-shadow: 0 6px 16px rgba(0, 115, 209, 0.5), 0 0 0 6px rgba(0, 115, 209, 0.15);
}

.radius-slider::-moz-range-thumb {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0073d1 0%, #00a8ff 100%);
    cursor: pointer;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.4), 0 0 0 4px rgba(0, 115, 209, 0.1);
    transition: all 0.3s;
}

.radius-slider::-moz-range-thumb:hover {
    transform: scale(1.15);
    box-shadow: 0 6px 16px rgba(0, 115, 209, 0.5), 0 0 0 6px rgba(0, 115, 209, 0.15);
}

.radius-value {
    min-width: 70px;
    font-size: 16px;
    font-weight: 700;
    color: #0073d1;
    background: linear-gradient(135deg, rgba(0, 115, 209, 0.12) 0%, rgba(0, 168, 255, 0.08) 100%);
    padding: 8px 14px;
    border-radius: 10px;
    text-align: center;
    border: 1px solid rgba(0, 115, 209, 0.2);
    box-shadow: 0 2px 6px rgba(0, 115, 209, 0.1);
    transition: all 0.3s;
}
.radius-value:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.2);
}

/* Enhanced Filter Actions */
.filter-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-top: 0;
    padding-top: 0;
    border-top: none;
    gap: 12px;
    position: relative;
    z-index: 1;
    flex: 0 0 auto;
}

.jobs-top-filter .filter-row .filter-actions {
    margin-top: 0;
    padding-top: 0;
    border-top: none;
}

@media(max-width: 767px) {
    .filter-actions {
        width: 100%;
        justify-content: space-between;
    }
}

.advance-search-link {
    color: #0073d1;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(135deg, rgba(0, 115, 209, 0.08) 0%, rgba(0, 168, 255, 0.05) 100%);
    border: 1px solid rgba(0, 115, 209, 0.15);
    position: relative;
    overflow: hidden;
}

.advance-search-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s;
}
.advance-search-link:hover::before {
    left: 100%;
}

.advance-search-link:hover {
    background: linear-gradient(135deg, rgba(0, 115, 209, 0.15) 0%, rgba(0, 168, 255, 0.1) 100%);
    transform: translateX(4px) translateY(-1px);
    text-decoration: none;
    color: #005ba3;
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.2);
    border-color: rgba(0, 115, 209, 0.25);
}

.advance-search-link i {
    font-size: 16px;
    transition: transform 0.3s;
}

.advance-search-link:hover i {
    transform: rotate(90deg);
}

.search-btn {
    background: linear-gradient(135deg, #0073d1 0%, #00a8ff 50%, #0073d1 100%);
    background-size: 200% 100%;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 3px 10px rgba(0, 115, 209, 0.3), 0 2px 5px rgba(0, 115, 209, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.3px;
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

.search-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.search-btn:hover::before {
    left: 100%;
}

.search-btn:hover {
    background-position: 100% 0;
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 6px 20px rgba(0, 115, 209, 0.45), 0 3px 10px rgba(0, 115, 209, 0.25);
}
.search-btn:active {
    transform: translateY(-1px) scale(0.99);
}

.search-btn i {
    font-size: 14px;
}

/* Clear Filter Button */
.clear-filter-btn {
    background: #fff;
    color: #64748b;
    border: 2px solid #e2e8f0;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    position: relative;
    overflow: hidden;
}

.clear-filter-btn:hover {
    background: #f1f5f9;
    color: #475569;
    border-color: #cbd5e1;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.clear-filter-btn:active {
    transform: translateY(0);
}

.clear-filter-btn i {
    font-size: 12px;
}

.search-btn i {
    font-size: 13px;
}

@media(max-width: 767px) {
    .clear-filter-btn,
    .search-btn {
        flex: 1;
        justify-content: center;
    }
}

/* Enhanced Layout Toggle Button - Small version for sidebar */
.layout-toggle-btn-small {
    background: #fff;
    border: 1px solid #e2e8f0;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    color: #64748b;
    transition: all 0.2s ease;
}

.layout-toggle-btn-small:hover {
    border-color: #cbd5e1;
    color: #475569;
    background: #f8fafc;
}

.layout-toggle-btn-small.active {
    background: #0073d1;
    color: #fff;
    border-color: #0073d1;
}

.layout-toggle-btn-small i {
    font-size: 14px;
}

/* Advanced filters row animation */
.advanced-filters-row {
    display: none !important; /* Hidden by default - only show 3 basic fields */
    margin-top: 20px;
    padding-top: 20px;
    padding-bottom: 20px;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    overflow: hidden;
}

.advanced-filters-row.show {
    display: grid !important;
    animation: slideDown 0.3s ease-out;
    padding-top: 20px;
    padding-bottom: 20px;
}

@keyframes slideDown {
    from {
        opacity: 0;
        max-height: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        max-height: 500px;
        transform: translateY(0);
    }
}

@media(max-width: 767px) {
    .advanced-filters-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

/* Enhanced Result Count */
.product-filter-wrap {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

.woocommerce-result-count-left {
    font-size: 14px !important;
    font-weight: 600;
    color: #475569;
    background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
    padding: 4px 6px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.woocommerce-result-count-left::before {
    content: '📊';
    font-size: 16px;
}

/* Responsive Design */
/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Additional polish for filter groups */
.jobs-top-filter .filter-group {
    animation: fadeInUp 0.5s ease-out both;
}

.jobs-top-filter .filter-group:nth-child(1) { animation-delay: 0.1s; }
.jobs-top-filter .filter-group:nth-child(2) { animation-delay: 0.2s; }
.jobs-top-filter .filter-group:nth-child(3) { animation-delay: 0.3s; }
.jobs-top-filter .filter-group:nth-child(4) { animation-delay: 0.4s; }
.jobs-top-filter .filter-group:nth-child(5) { animation-delay: 0.5s; }
.jobs-top-filter .filter-group:nth-child(6) { animation-delay: 0.6s; }
.jobs-top-filter .filter-group:nth-child(7) { animation-delay: 0.7s; }

/* Loading state improvements */
.loading {
    position: relative;
    min-height: 200px;
}

/* Blue Loader Overlay for Jobs Filter */
.jobs-listing {
    position: relative;
    min-height: 400px;
}

.jobs-listing .overlay {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 400px !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(3px);
    display: none;
    align-items: center !important;
    justify-content: center !important;
    z-index: 100 !important; /* Lower than navbar (999) but still visible in container */
    border-radius: 8px;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box !important;
}

.jobs-listing .overlay[style*="display: flex"],
.jobs-listing .overlay.show {
    display: flex !important;
}

/* Ensure jobs listing container has proper positioning */
#jobs-listing-container {
    position: relative !important;
    min-height: 400px;
    width: 100%;
    display: block;
}

.twm-jobs-list-wrap.jobs-listing {
    position: relative !important;
    min-height: 400px;
    width: 100%;
}

.jobs-listing .overlay .blue-loader {
    width: 60px;
    height: 60px;
    border: 5px solid rgba(0, 115, 209, 0.2);
    border-top-color: #0073d1;
    border-radius: 50%;
    animation: blue-spin 0.8s linear infinite;
    position: relative;
    margin: 0 auto;
    flex-shrink: 0;
}

@keyframes blue-spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

/* Jobs container animation */
.jobs-listing {
    animation: fadeIn 0.6s ease-out;
}

/* Ensure parent container allows absolute positioning */
.col-lg-9.col-md-12.position-relative {
    position: relative;
}

.twm-jobs-list-wrap {
    position: relative;
    width: 100%;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@media(max-width: 991px) {
    .jobs-sc-heading {
        padding: 40px 0 30px;
    }
    .jobs-sc-heading h2 { 
        font-size: 36px; 
    }
    .jobs-sc-heading p { 
        font-size: 16px; 
    }
    .jobs-top-filter {
        padding: 28px;
    }
    .jobs-top-filter .filter-row {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px;
    }
}

@media(max-width: 767px) {
    .jobs-sc-heading {
        padding: 40px 20px 30px;
        margin-bottom: 35px;
    }
    .jobs-sc-heading h2 { 
        font-size: 32px; 
    }
    .jobs-sc-heading p { 
        font-size: 15px; 
    }
    .jobs-top-filter {
        padding: 24px 20px;
        border-radius: 18px;
    }
    .jobs-top-filter .filter-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .filter-actions {
        flex-direction: column;
        gap: 16px;
    }
    .search-btn {
        width: 100%;
        justify-content: center;
        padding: 16px 35px;
        font-size: 15px;
    }
    .advance-search-link {
        width: 100%;
        justify-content: center;
        padding: 12px 20px;
    }
    .product-filter-wrap {
        flex-direction: column;
        gap: 16px;
        align-items: stretch !important;
        padding: 20px;
    }
    .radius-slider-wrapper {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    .radius-value {
        width: 100%;
        text-align: center;
    }
    .sidebar-header-controls {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 12px;
    }
    .layout-toggle-btn-small {
        width: 100%;
        justify-content: center;
    }
}

/* ===== Jobs Sidebar - Matching Candidates Page Style ===== */
.jobs-sidebar-modern {
    position: relative;
}
.jobs-sidebar-modern .side-bar-filter {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    position: sticky;
    top: 100px;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
}
.jobs-sidebar-modern .sidebar-elements {
    padding: 16px;
    padding-right: 12px;
}
.jobs-sidebar-modern .sidebar-header {
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
    /* border-radius: 16px 16px 0 0; */
    box-shadow: 0 2px 8px rgba(0, 61, 130, 0.1);
}
.jobs-sidebar-modern .sidebar-header h4 {
    font-size: 15px;
    font-weight: 700;
    color: #0c4a6e;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.jobs-sidebar-modern .sidebar-header h4 i {
    color: #0284c7;
}
.jobs-sidebar-modern .btn-clear-filters {
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
.jobs-sidebar-modern .btn-clear-filters:hover {
    background: rgba(255, 255, 255, 1);
    color: #075985;
    border-color: rgba(2, 132, 199, 0.5);
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 61, 130, 0.15);
}
.jobs-sidebar-modern .btn-clear-filters i {
    font-size: 14px;
}
.jobs-sidebar-modern .form-group {
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.jobs-sidebar-modern .form-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter {
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.jobs-sidebar-modern .section-head-small {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 10px !important;
}
.jobs-sidebar-modern .input-group {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    transition: all .2s;
}
.jobs-sidebar-modern .input-group:focus-within {
    border-color: #003d82;
    box-shadow: 0 0 0 3px rgba(0,61,130,.1);
}
.jobs-sidebar-modern .input-group .form-control {
    border: none;
    padding: 6px 12px;
    height: 36px;
    font-size: 13px;
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
    margin-bottom: 6px;
}

/* Scroll for filter sections with many options */
.jobs-sidebar-modern .twm-sidebar-ele-filter,
.jobs-sidebar-modern .form-group {
    position: relative;
}

/* Apply scroll only to lists/options containers that have many items */
.jobs-sidebar-modern .twm-sidebar-ele-filter ul,
.jobs-sidebar-modern .form-group ul[style*="height"],
.jobs-sidebar-modern .twm-sidebar-ele-filter > div:has(> ul),
.jobs-sidebar-modern .form-group > div:has(> ul),
.jobs-sidebar-modern .twm-sidebar-ele-filter .form-check,
.jobs-sidebar-modern .form-group .form-check {
    max-height: 180px;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 6px;
}

/* For select elements with multiple options */
.jobs-sidebar-modern select[multiple] {
    max-height: 150px;
    overflow-y: auto;
}

/* Custom scrollbar for filter sections */
.jobs-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar,
.jobs-sidebar-modern .form-group ul::-webkit-scrollbar,
.jobs-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar,
.jobs-sidebar-modern .form-group > div::-webkit-scrollbar {
    width: 6px;
}

.jobs-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-track,
.jobs-sidebar-modern .form-group ul::-webkit-scrollbar-track,
.jobs-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-track,
.jobs-sidebar-modern .form-group > div::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.jobs-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb,
.jobs-sidebar-modern .form-group ul::-webkit-scrollbar-thumb,
.jobs-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-thumb,
.jobs-sidebar-modern .form-group > div::-webkit-scrollbar-thumb {
    background: #003d82;
    border-radius: 10px;
}

.jobs-sidebar-modern .twm-sidebar-ele-filter ul::-webkit-scrollbar-thumb:hover,
.jobs-sidebar-modern .form-group ul::-webkit-scrollbar-thumb:hover,
.jobs-sidebar-modern .twm-sidebar-ele-filter > div::-webkit-scrollbar-thumb:hover,
.jobs-sidebar-modern .form-group > div::-webkit-scrollbar-thumb:hover {
    background: #002d5f;
}
.jobs-sidebar-modern .form-check {
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
.jobs-sidebar-modern .form-check:hover {
    background: #f8faff;
}
.jobs-sidebar-modern .form-check-input {
    margin-top: 0 !important;
    border-radius: 4px;
    border-color: #cbd5e1;
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    cursor: pointer;
    position: relative;
}
.jobs-sidebar-modern .form-check-input:checked {
    background-color: #003d82;
    border-color: #003d82;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
    background-size: 100% 100%;
    background-position: center;
    background-repeat: no-repeat;
}
.jobs-sidebar-modern .form-check-input:focus {
    border-color: #003d82;
    box-shadow: 0 0 0 3px rgba(0, 61, 130, 0.1);
    outline: none;
}
.jobs-sidebar-modern .form-check-label {
    font-size: 13px;
    color: #475569;
    margin: 0;
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1.4;
    flex: 1;
}
.jobs-sidebar-modern .form-check:hover .form-check-label {
    color: #003d82;
}
.jobs-sidebar-modern .form-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 6px;
}
.jobs-sidebar-modern .wt-select-bar-large {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 6px 12px;
    height: 36px;
    font-size: 13px;
    color: #1e293b;
}
.jobs-sidebar-modern .wt-select-bar-large:focus {
    border-color: #003d82;
    box-shadow: 0 0 0 3px rgba(0,61,130,.1);
    outline: none;
}
.jobs-sidebar-modern .side-bar-filter::-webkit-scrollbar {
    width: 6px;
}
.jobs-sidebar-modern .side-bar-filter::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}
.jobs-sidebar-modern .side-bar-filter::-webkit-scrollbar-thumb {
    background: #003d82;
    border-radius: 10px;
}
.jobs-sidebar-modern .side-bar-filter::-webkit-scrollbar-thumb:hover {
    background: #002d5f;
}

/* Apply Filter Button */
.jobs-sidebar-modern .apply-filter-wrapper {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
    margin-left: -16px;
    margin-right: -12px;
    padding-left: 16px;
    padding-right: 12px;
}
.jobs-sidebar-modern .apply-filter-btn {
    width: 100%;
    background: linear-gradient(135deg, #7dd3fc 0%, #bae6fd 50%, #e0f2fe 100%);
    color: #0c4a6e;
    border: 1px solid rgba(2, 132, 199, 0.3);
    border-radius: 10px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(2, 132, 199, 0.2);
}
.jobs-sidebar-modern .apply-filter-btn:hover {
    background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 50%, #38bdf8 100%);
    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
    transform: translateY(-1px);
    color: #075985;
}
.jobs-sidebar-modern .apply-filter-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(2, 132, 199, 0.2);
}
.jobs-sidebar-modern .apply-filter-btn i {
    font-size: 16px;
}

.jobs-sidebar-modern .sidebar-elements {
    margin-right: 0;
}
.jobs-sidebar-modern .form-group,
.jobs-sidebar-modern .twm-sidebar-ele-filter {
    padding-right: 0;
    margin-right: 0;
}
.jobs-sidebar-modern .form-check,
.jobs-sidebar-modern .form-control,
.jobs-sidebar-modern .wt-select-bar-large,
.jobs-sidebar-modern select {
    margin-right: 0;
}

@media(max-width: 991px) {
    .jobs-sidebar-modern .side-bar-filter {
        position: relative;
        top: 0;
        max-height: none;
    }
    .jobs-sidebar-modern .sidebar-header {
        flex-wrap: wrap;
        gap: 12px;
    }
    .jobs-sidebar-modern .sidebar-header h4 {
        font-size: 15px;
    }
    .jobs-sidebar-modern .btn-clear-filters {
        font-size: 12px;
        padding: 5px 12px;
    }
}
/* ===== Job City Search Autocomplete Styling ===== */
.job-city-search-wrapper {
    position: relative;
}
.job-city-search-input {
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
.job-city-search-input:focus {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
    outline: none !important;
}
.job-city-search-input::placeholder {
    color: #94a3b8 !important;
}
.job-city-suggestions {
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
.job-city-search-wrapper {
    position: relative !important;
    z-index: 10000 !important;
}
.job-city-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #1e293b !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}
.job-city-suggestion-item:last-child {
    border-bottom: none !important;
}
.job-city-suggestion-item:hover,
.job-city-suggestion-item.active {
    background: #f0f7ff !important;
    color: #0073d1 !important;
}
.job-city-suggestion-item .city-name {
    font-weight: 500 !important;
    color: #1e293b !important;
    margin-bottom: 2px !important;
}
.job-city-suggestion-item:hover .city-name,
.job-city-suggestion-item.active .city-name {
    color: #0073d1 !important;
}
.job-city-suggestion-item .city-location {
    font-size: 12px !important;
    color: #64748b !important;
    margin-top: 2px !important;
}
.job-city-loading,
.job-city-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}

/* Job Role Search Suggestions */
/* Home Category Search (Same as Homepage) */
.jobs-top-filter .filter-group {
    position: relative;
    z-index: 1;
}
.jobs-top-filter .filter-group:has(.home-category-search-wrapper) {
    z-index: 1001 !important;
}
.home-category-search-wrapper {
    position: relative !important;
    z-index: 1001 !important;
}
.home-category-dropdown-arrow {
    position: absolute !important;
    right: 18px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    pointer-events: none !important;
    color: #64748b !important;
    font-size: 18px !important;
    transition: all 0.2s ease !important;
    z-index: 10 !important;
}
.home-category-search-wrapper:focus-within .home-category-dropdown-arrow,
.home-category-search-wrapper.active .home-category-dropdown-arrow {
    color: #003d82 !important;
    transform: translateY(-50%) rotate(180deg) !important;
}
/* Keyword Select Dropdown Styling */
.keyword-select-dropdown {
    width: 100% !important;
    height: 44px !important;
    padding: 10px 45px 10px 16px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 10px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #fff !important;
    transition: all 0.2s ease !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    cursor: pointer !important;
}

.keyword-select-dropdown:focus {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
    outline: none !important;
}

.keyword-select-dropdown option {
    padding: 10px 16px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #fff !important;
}

.keyword-select-dropdown option:hover {
    background: #f0f7ff !important;
}

/* Bootstrap Select styling for keyword dropdown */
.keyword-select-dropdown.selectpicker {
    width: 100% !important;
}

.keyword-select-dropdown.selectpicker + .dropdown-toggle {
    height: 44px !important;
    line-height: 44px !important;
    padding: 0 45px 0 16px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 10px !important;
    background: #fff !important;
    color: #1e293b !important;
    font-size: 14px !important;
}

.keyword-select-dropdown.selectpicker + .dropdown-toggle:focus,
.keyword-select-dropdown.selectpicker + .dropdown-toggle:hover {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
}

.keyword-select-dropdown.selectpicker + .dropdown-toggle .filter-option {
    text-align: left !important;
    padding-right: 30px !important;
}

.keyword-select-dropdown.selectpicker + .dropdown-toggle .bs-caret {
    right: 18px !important;
}

.keyword-select-dropdown.selectpicker + .dropdown-toggle .bs-caret .caret {
    border-top-color: #64748b !important;
    border-width: 5px 5px 0 !important;
}

/* Location Select Dropdown Styling (Same as Keyword) */
.location-select-dropdown {
    width: 100% !important;
    height: 44px !important;
    padding: 10px 45px 10px 16px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 10px !important;
    font-size: 14px !important;
    color: #1e293b !important;
    background: #fff !important;
    transition: all 0.2s ease !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    cursor: pointer !important;
}

.location-select-dropdown:focus {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
    outline: none !important;
}

.location-select-dropdown.selectpicker {
    width: 100% !important;
}

.location-select-dropdown.selectpicker + .dropdown-toggle {
    height: 44px !important;
    line-height: 44px !important;
    padding: 0 45px 0 16px !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 10px !important;
    background: #fff !important;
    color: #1e293b !important;
    font-size: 14px !important;
}

.location-select-dropdown.selectpicker + .dropdown-toggle:focus,
.location-select-dropdown.selectpicker + .dropdown-toggle:hover {
    border-color: #0073d1 !important;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1) !important;
}

.location-select-dropdown.selectpicker + .dropdown-toggle .filter-option {
    text-align: left !important;
    padding-right: 30px !important;
}

.location-select-dropdown.selectpicker + .dropdown-toggle .bs-caret {
    right: 18px !important;
}

.location-select-dropdown.selectpicker + .dropdown-toggle .bs-caret .caret {
    border-top-color: #64748b !important;
    border-width: 5px 5px 0 !important;
}

#home_category_search {
    padding-right: 45px !important;
}
.home-category-suggestions {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-top: none !important;
    border-radius: 0 0 14px 14px !important;
    max-height: 400px !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    z-index: 10000 !important;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    margin-top: 0 !important;
    display: none !important;
    padding: 8px 0 !important;
    visibility: hidden !important;
    opacity: 0 !important;
}
.home-category-suggestions[style*="display: block"],
.home-category-suggestions.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}
/* Custom scrollbar for dropdown */
.home-category-suggestions::-webkit-scrollbar {
    width: 6px !important;
}
.home-category-suggestions::-webkit-scrollbar-track {
    background: #f1f5f9 !important;
    border-radius: 10px !important;
}
.home-category-suggestions::-webkit-scrollbar-thumb {
    background: #003d82 !important;
    border-radius: 10px !important;
}
.home-category-suggestions::-webkit-scrollbar-thumb:hover {
    background: #002d5f !important;
}
.home-category-suggestion-item {
    padding: 10px 16px !important;
    cursor: pointer !important;
    font-size: 13px !important;
    color: #475569 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: all 0.2s ease !important;
    background: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    min-height: 40px !important;
    margin: 0 !important;
}
.home-category-suggestion-item:last-child {
    border-bottom: none !important;
}
.home-category-suggestion-item:hover,
.home-category-suggestion-item.active {
    background: #f0f7ff !important;
    color: #003d82 !important;
}
.home-category-suggestion-item .city-name {
    font-weight: 500 !important;
    color: inherit !important;
    margin: 0 !important;
    font-size: 13px !important;
    line-height: 1.4 !important;
    width: 100% !important;
}
.home-category-suggestion-item:hover .city-name,
.home-category-suggestion-item.active .city-name {
    color: #003d82 !important;
    font-weight: 600 !important;
}
.home-category-loading,
.home-category-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}

/* Home City Search (Same as Homepage) */
.home-city-search-wrapper {
    position: relative;
    z-index: 1001;
}
.home-city-suggestions {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    background: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-top: none !important;
    border-radius: 0 0 8px 8px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    z-index: 1000 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    margin-top: 0 !important;
}
.home-city-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #000000 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}
.home-city-suggestion-item:last-child {
    border-bottom: none !important;
}
.home-city-suggestion-item:hover,
.home-city-suggestion-item.active {
    background: #f0f7ff !important;
    color: #000000 !important;
}
.home-city-suggestion-item .city-name {
    font-weight: 500 !important;
    color: #000000 !important;
    margin-bottom: 2px !important;
}
.home-city-suggestion-item:hover .city-name,
.home-city-suggestion-item.active .city-name {
    color: #000000 !important;
}
.home-city-suggestion-item .city-location {
    font-size: 12px !important;
    color: #64748b !important;
    margin-top: 2px !important;
}
.home-city-loading,
.home-city-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}
.job-role-search-wrapper {
    position: relative;
}
.job-role-suggestions {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    background: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-top: none !important;
    border-radius: 0 0 8px 8px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    z-index: 1000 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    margin-top: 0 !important;
}
.job-role-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #000000 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}
.job-role-suggestion-item:last-child {
    border-bottom: none !important;
}
.job-role-suggestion-item:hover,
.job-role-suggestion-item.active {
    background: #f0f7ff !important;
    color: #000000 !important;
}
.job-role-suggestion-item .role-name {
    font-weight: 500 !important;
    color: #000000 !important;
    margin-bottom: 2px !important;
}
.job-role-suggestion-item:hover .role-name,
.job-role-suggestion-item.active .role-name {
    color: #000000 !important;
}
.job-role-loading,
.job-role-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}

/* Job Location Search Suggestions (Same as signin/login) */
.job-location-search-wrapper {
    position: relative;
}
.job-location-suggestions {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    background: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-top: none !important;
    border-radius: 0 0 8px 8px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    z-index: 1000 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    margin-top: 0 !important;
}
.job-location-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #000000 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}
.job-location-suggestion-item:last-child {
    border-bottom: none !important;
}
.job-location-suggestion-item:hover,
.job-location-suggestion-item.active {
    background: #f0f7ff !important;
    color: #000000 !important;
}
.job-location-suggestion-item .city-name {
    font-weight: 500 !important;
    color: #000000 !important;
    margin-bottom: 2px !important;
}
.job-location-suggestion-item:hover .city-name,
.job-location-suggestion-item.active .city-name {
    color: #000000 !important;
}
.job-location-suggestion-item .city-location {
    font-size: 12px !important;
    color: #64748b !important;
    margin-top: 2px !important;
}
.job-location-loading,
.job-location-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white jobs-container">
    <div class="container">
        <div class="jobs-sc-heading">
            <h2><?php echo e(__('Jobs')); ?></h2>
            <p><?php echo e(__('Find the best teaching opportunities across India')); ?></p>
        </div>
        
        <!-- Top Filter Section -->
        <script>
            // Define clearAllFiltersNow function BEFORE buttons are rendered
            // This ensures it's available when onclick handlers are called
            window.clearAllFiltersNow = function() {
                console.log('[CLEAR_FILTERS] clearAllFiltersNow() called - INLINE HANDLER');
                
                // Show loader
                const loader = document.getElementById('jobs-loader-overlay');
                if (loader) {
                    loader.setAttribute('style', 'display: flex !important; visibility: visible !important; opacity: 1 !important;');
                    loader.classList.add('show');
                } else {
                    const jobsListContainer = document.getElementById('jobs-listing-container');
                    if (jobsListContainer) {
                        const loaderHtml = '<div class="blue-loader-overlay" id="jobs-loader-overlay" style="display: flex !important; visibility: visible !important; opacity: 1 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading jobs...</p></div></div>';
                        jobsListContainer.insertAdjacentHTML('afterbegin', loaderHtml);
                    }
                }
                
                // Clear all form inputs using jQuery
                if (typeof jQuery !== 'undefined') {
                    console.log('[CLEAR_FILTERS] jQuery available, clearing forms');
                    
                    // Clear top filter form
                    const $topForm = jQuery('#jobs-top-filter-form');
                    if ($topForm.length) {
                        console.log('[CLEAR_FILTERS] Clearing top form');
                        $topForm.find('input[type="text"], input[type="search"], input[type="number"]').val('');
                        $topForm.find('input[type="checkbox"]').prop('checked', false);
                        $topForm.find('input[type="radio"]').prop('checked', false);
                        $topForm.find('input[type="hidden"]').each(function() {
                            const name = jQuery(this).attr('name');
                            if (name && name !== 'layout' && name !== 'per_page' && name !== 'page' && name !== 'sort_by') {
                                jQuery(this).val('');
                            }
                        });
                        
                                // Clear all selects
                                $topForm.find('select').each(function() {
                                    const $select = jQuery(this);
                                    const name = $select.attr('name');
                                    if (name && name !== 'layout' && name !== 'per_page' && name !== 'page' && name !== 'sort_by') {
                                        // Check if selectpicker is available and initialized
                                        if ($select.hasClass('selectpicker') && typeof jQuery.fn.selectpicker !== 'undefined') {
                                            try {
                                                if (this.multiple) {
                                                    $select.selectpicker('deselectAll');
                                                } else {
                                                    $select.selectpicker('val', '');
                                                }
                                                $select.selectpicker('refresh');
                                                console.log('[CLEAR_FILTERS] Cleared selectpicker:', name);
                                            } catch (e) {
                                                console.log('[CLEAR_FILTERS] Error clearing selectpicker:', name, e);
                                                // Fallback: clear normally
                                                if (this.multiple) {
                                                    $select.val([]);
                                                } else {
                                                    $select.val('').trigger('change');
                                                }
                                            }
                                        } else {
                                            // Regular select - clear normally
                                            if (this.multiple) {
                                                $select.val([]);
                                            } else {
                                                $select.val('').trigger('change');
                                            }
                                        }
                                    }
                                });
                    }
                    
                    // Clear sidebar form
                    const $sidebarForm = jQuery('#jobs-filter-form');
                    if ($sidebarForm.length) {
                        console.log('[CLEAR_FILTERS] Clearing sidebar form');
                        $sidebarForm.find('input[type="text"], input[type="search"], input[type="number"]').val('');
                        $sidebarForm.find('input[type="checkbox"]').prop('checked', false);
                        $sidebarForm.find('input[type="radio"]').prop('checked', false);
                        $sidebarForm.find('select').each(function() {
                            const $select = jQuery(this);
                            // Check if selectpicker is available and initialized
                            if ($select.hasClass('selectpicker') && typeof jQuery.fn.selectpicker !== 'undefined') {
                                try {
                                    if (this.multiple) {
                                        $select.selectpicker('deselectAll');
                                    } else {
                                        $select.selectpicker('val', '');
                                    }
                                    $select.selectpicker('refresh');
                                } catch (e) {
                                    console.log('[CLEAR_FILTERS] Error clearing sidebar selectpicker:', e);
                                    // Fallback: clear normally
                                    if (this.multiple) {
                                        $select.val([]);
                                    } else {
                                        $select.val('').trigger('change');
                                    }
                                }
                            } else {
                                // Regular select - clear normally
                                if (this.multiple) {
                                    $select.val([]);
                                } else {
                                    $select.val('').trigger('change');
                                }
                            }
                        });
                    }
                    
                    // Clear specific search inputs
                    jQuery('#job_city_search, #job_city_id, #job_role_search, #job_role_id').val('');
                    jQuery('#job-city-suggestions, #job-role-suggestions').hide().empty();
                    
                    // Reset radius slider
                    const radiusSlider = document.getElementById('radius-slider');
                    if (radiusSlider) {
                        radiusSlider.value = 0;
                        const radiusValue = document.getElementById('radius-value');
                        if (radiusValue) {
                            radiusValue.textContent = '0';
                        }
                        jQuery(radiusSlider).trigger('change');
                    }
                    
                    // Refresh selectpickers after a delay
                    setTimeout(function() {
                        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.selectpicker !== 'undefined') {
                            jQuery('#home_category_search, #home_city_search').each(function() {
                                const $select = jQuery(this);
                                if ($select.hasClass('selectpicker')) {
                                    try {
                                        const oldVal = $select.selectpicker('val');
                                        $select.selectpicker('val', '');
                                        $select.selectpicker('refresh');
                                        const newVal = $select.selectpicker('val');
                                        console.log('[CLEAR_FILTERS] Selectpicker', $select.attr('id'), '- old:', oldVal, 'new:', newVal);
                                    } catch (e) {
                                        console.log('[CLEAR_FILTERS] Error refreshing selectpicker', $select.attr('id'), e);
                                        // Fallback: clear normally
                                        $select.val('').trigger('change');
                                    }
                                } else {
                                    // Not a selectpicker, clear normally
                                    $select.val('').trigger('change');
                                }
                            });
                        } else {
                            console.log('[CLEAR_FILTERS] Selectpicker not available, clearing selects normally');
                            // Fallback: clear normally
                            jQuery('#home_category_search, #home_city_search').each(function() {
                                jQuery(this).val('').trigger('change');
                            });
                        }
                    }, 100);
                    
                    // Update URL and submit form
                    setTimeout(function() {
                        const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
                        const cleanUrl = baseUrl.split('?')[0];
                        console.log('[CLEAR_FILTERS] Updating URL to:', cleanUrl);
                        window.history.pushState({}, '', cleanUrl);
                        
                        const $topForm = jQuery('#jobs-top-filter-form');
                        if ($topForm.length) {
                            console.log('[CLEAR_FILTERS] Submitting form');
                            $topForm.trigger('submit');
                        } else {
                            console.log('[CLEAR_FILTERS] Form not found, redirecting');
                            window.location.href = cleanUrl;
                        }
                    }, 200);
                } else {
                    console.log('[CLEAR_FILTERS] jQuery not available, redirecting');
                    // Fallback: redirect to base URL
                    const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
                    window.location.href = baseUrl.split('?')[0];
                }
            };
            console.log('[CLEAR_FILTERS] clearAllFiltersNow function defined');
        </script>
        
        <form action="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" method="get" id="jobs-top-filter-form" class="jobs-top-filter">
            <input type="hidden" name="layout" value="<?php echo e($layout); ?>" id="layout-input">
            <div class="filter-row">
                <div class="filter-group">
                    <label>
                        <i class="feather-briefcase"></i>
                        <span><?php echo e(__('Keyword')); ?></span>
                    </label>
                    <div class="home-category-search-wrapper" style="position: relative;">
                        <select id="home_category_search" name="job_categories[]" class="wt-search-bar-select keyword-select-dropdown selectpicker" data-live-search="true">
                            <option value=""><?php echo e(__('Select keyword')); ?></option>
                            <?php $__currentLoopData = $jobRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php if($category->id == request()->query('job_categories.0')): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-map-pin"></i>
                        <span><?php echo e(__('Location')); ?></span>
                    </label>
                    <div class="home-city-search-wrapper" style="position: relative;">
                        <select id="home_city_search" name="city_id" class="wt-search-bar-select location-select-dropdown selectpicker" data-live-search="true">
                            <option value=""><?php echo e(__('Select Your Location')); ?></option>
                            <?php if(is_plugin_active('location') && $cities->count() > 0): ?>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $cityLabel = $city->name;
                                        if ($city->state && $city->state->name) {
                                            $cityLabel .= ', ' . $city->state->name;
                                        }
                                        if ($city->country && $city->country->name) {
                                            $cityLabel .= ', ' . $city->country->name;
                                        }
                                    ?>
                                    <option value="<?php echo e($city->id); ?>" <?php if($city->id == request()->query('city_id')): echo 'selected'; endif; ?>><?php echo e($cityLabel); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <button type="button" class="clear-filter-btn" id="clear-top-filters" onclick="clearAllFiltersNow(); return false;">
                            <i class="feather-x-circle"></i>
                            <?php echo e(__('Clear Filters')); ?>

                        </button>
                        <button type="submit" class="search-btn">
                            <i class="feather-search"></i>
                            <?php echo e(__('Find Job')); ?>

                        </button>
                    </div>
                </div>
            </div>
            
            <div class="filter-row advanced-filters-row" id="advanced-filters-row">
                <div class="filter-group">
                    <label>
                        <i class="feather-navigation"></i>
                        <span><?php echo e(__('Radius')); ?>: <span class="radius-value" id="radius-value"><?php echo e(request()->query('radius', 0)); ?></span> Km</span>
                    </label>
                    <div class="radius-slider-wrapper">
                        <input type="range" name="radius" id="radius-slider" class="radius-slider" min="0" max="100" value="<?php echo e(request()->query('radius', 0)); ?>" step="5">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-calendar"></i>
                        <span><?php echo e(__('Date Posted')); ?></span>
                    </label>
                    <select name="date_posted" class="selectpicker">
                        <option value=""><?php echo e(__('All')); ?></option>
                        <?php $__currentLoopData = JobBoardHelper::postedDateRanges(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php if($key == request()->query('date_posted')): echo 'selected'; endif; ?>><?php echo e($item['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-clock"></i>
                        <span><?php echo e(__('Job Type')); ?></span>
                    </label>
                    <select name="job_types[]" class="selectpicker" multiple>
                        <?php $__currentLoopData = $jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jobType->id); ?>" <?php if(in_array($jobType->id, (array) request()->query('job_types', []))): echo 'selected'; endif; ?>><?php echo e($jobType->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-user"></i>
                        <span><?php echo e(__('Select job role')); ?></span>
                    </label>
                    <select name="job_categories[]" class="selectpicker" multiple>
                        <?php $__currentLoopData = $jobRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobRole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jobRole->id); ?>" <?php if(in_array($jobRole->id, (array) request()->query('job_categories', []))): echo 'selected'; endif; ?>><?php echo e($jobRole->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </form>
        
        <div class="row">
            <div class="col-lg-3 col-md-12 jobs-sidebar-modern">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar p-0">
                        <div class="sidebar-elements search-bx">
                            <button class="d-md-none position-absolute btn btn-link btn-close-filter" style="top: 10px; right: 10px; z-index: 10;">
                                <i class="feather-x"></i>
                            </button>
                            
                            
                            <div class="sidebar-header">
                                <h4>
                                    <i class="feather-filter"></i>
                                        <?php echo e(__('Filters')); ?>

                                    </h4>
                                <button type="button" class="btn-clear-filters" id="clear-all-job-filters" onclick="clearAllFiltersNow(); return false;">
                                    <i class="feather-x-circle"></i>
                                        <?php echo e(__('Clear All')); ?>

                                    </button>
                            </div>
                            
                                <form action="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" method="get" id="jobs-filter-form" data-ajax-url="<?php echo e(route('public.ajax.jobs')); ?>">
                                        <?php echo Theme::partial('jobs.filters.institute-name'); ?>

                                        <?php echo Theme::partial('jobs.filters.institute-type'); ?>

                                        <?php echo Theme::partial('jobs.filters.city'); ?>

                                        <?php echo Theme::partial('jobs.filters.types'); ?>

                                        <?php echo Theme::partial('jobs.filters.date_posted'); ?>

                                        <?php echo Theme::partial('jobs.filters.categories'); ?>

                                
                                <input type="hidden" name="per_page" value="<?php echo e(BaseHelper::stringify(request()->query('per_page', 12))); ?>">
                                <input type="hidden" name="page" value="1">
                                <input type="hidden" name="layout" value="<?php echo e(BaseHelper::stringify(request()->query('layout') ?: $layout ?: 'grid')); ?>">
                                <input type="hidden" name="sort_by" value="<?php echo e(BaseHelper::stringify(request()->query('sort_by'))); ?>">
                                
                                <!-- Apply Filter Button -->
                                <div class="apply-filter-wrapper">
                                    <button type="submit" class="apply-filter-btn">
                                        <i class="feather-check-circle"></i>
                                        <span><?php echo e(__('Apply Filter')); ?></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                <script>
                    $(document).ready(function() {
                        // Initialize filters from URL parameters (for home page search)
                        function initializeFiltersFromURL() {
                            const urlParams = new URLSearchParams(window.location.search);
                            
                            // City filter is already pre-selected in the blade template
                            // Just ensure Select2 shows the selected value if it exists
                            const cityId = urlParams.get('city_id');
                            if (cityId) {
                                const $citySelect = $('#jobs-filter-form .selectpicker-location');
                                if ($citySelect.length) {
                                    // Wait for Select2 to be initialized (by main.js)
                                    const checkSelect2 = setInterval(function() {
                                        if ($citySelect.hasClass('select2-hidden-accessible')) {
                                            clearInterval(checkSelect2);
                                            // Select2 is initialized, ensure the value is set
                                            if ($citySelect.val() !== cityId) {
                                                $citySelect.val(cityId).trigger('change');
                                            }
                                        }
                                    }, 100);
                                    
                                    // Stop checking after 3 seconds
                                    setTimeout(function() {
                                        clearInterval(checkSelect2);
                                    }, 3000);
                        }
                            }
                            
                            // Initialize job categories checkboxes from URL
                            const jobCategories = urlParams.getAll('job_categories[]');
                            if (jobCategories.length > 0) {
                                jobCategories.forEach(function(categoryId) {
                                    const $checkbox = $('#jobs-filter-form input[name="job_categories[]"][value="' + categoryId + '"]');
                                    if ($checkbox.length) {
                                        $checkbox.prop('checked', true);
                                    }
                                });
                            }
                            
                            // Initialize top filter dropdown from URL (already handled in blade template)
                            // Just refresh selectpicker to show selected values
                            const topJobCategories = urlParams.getAll('job_categories[]');
                            if (topJobCategories.length > 0 && typeof $ !== 'undefined' && $.fn.selectpicker) {
                                setTimeout(function() {
                                    const $topSelect = $('#jobs-top-filter-form select[name="job_categories[]"]');
                                    if ($topSelect.length) {
                                        $topSelect.selectpicker('refresh');
                                    }
                                }, 300);
                            }
                        }
                        
                        // Initialize filters after a short delay to ensure Select2/Selectpicker are ready
                        setTimeout(function() {
                            initializeFiltersFromURL();
                        }, 800);
                        
                        // Clear all filters - comprehensive clearing
                        // Use event delegation to ensure it works even if button is added dynamically
                        console.log('[CLEAR_FILTERS] Setting up event handlers');
                        
                        // Test if buttons exist
                        const clearAllBtn = $('#clear-all-job-filters');
                        const clearTopBtn = $('#clear-top-filters');
                        console.log('[CLEAR_FILTERS] Clear All button found:', clearAllBtn.length > 0);
                        console.log('[CLEAR_FILTERS] Clear Top button found:', clearTopBtn.length > 0);
                        
                        $(document).off('click', '#clear-all-job-filters, .btn-clear-filters, #clear-top-filters').on('click', '#clear-all-job-filters, .btn-clear-filters, #clear-top-filters', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            const buttonId = this.id || 'unknown';
                            console.log('[CLEAR_FILTERS] ===== BUTTON CLICKED =====', buttonId);
                            console.log('[CLEAR_FILTERS] Event object:', e);
                            
                            // Show loader - force show
                            const loader = $('#jobs-loader-overlay');
                            if (loader.length) {
                                loader.attr('style', 'display: flex !important; visibility: visible !important; opacity: 1 !important;').addClass('show');
                                        } else {
                                // Create loader if it doesn't exist
                                const loaderHtml = '<div class="blue-loader-overlay" id="jobs-loader-overlay" style="display: flex !important; visibility: visible !important; opacity: 1 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading jobs...</p></div></div>';
                                $('#jobs-listing-container').prepend(loaderHtml);
                            }
                            
                            // Function to clear all inputs in a form
                            function clearForm(formSelector) {
                                const form = $(formSelector);
                                if (!form.length) {
                                    console.log('[CLEAR_FILTERS] Form not found:', formSelector);
                                    return;
                                }
                                console.log('[CLEAR_FILTERS] Clearing form:', formSelector);
                                
                                // Clear all text inputs, search inputs
                                let textInputsCleared = 0;
                                form.find('input[type="text"], input[type="search"], input[type="number"]').each(function() {
                                const $input = $(this);
                                    const name = $input.attr('name');
                                    if (name && name !== 'layout' && name !== 'per_page' && name !== 'page' && name !== 'sort_by') {
                                        const oldVal = $input.val();
                                        $input.val('');
                                        textInputsCleared++;
                                        if (oldVal) console.log('[CLEAR_FILTERS] Cleared text input:', name, 'old value:', oldVal);
                                    }
                                });
                                console.log('[CLEAR_FILTERS] Cleared', textInputsCleared, 'text inputs');
                                
                                // Clear all checkboxes
                                const checkboxesCleared = form.find('input[type="checkbox"]:checked').length;
                                form.find('input[type="checkbox"]').prop('checked', false);
                                if (checkboxesCleared > 0) console.log('[CLEAR_FILTERS] Cleared', checkboxesCleared, 'checkboxes');
                                
                                // Clear all radio buttons
                                const radiosCleared = form.find('input[type="radio"]:checked').length;
                                form.find('input[type="radio"]').prop('checked', false);
                                if (radiosCleared > 0) console.log('[CLEAR_FILTERS] Cleared', radiosCleared, 'radio buttons');
                                
                                // Clear all hidden inputs (except system ones)
                                let hiddenInputsCleared = 0;
                                form.find('input[type="hidden"]').each(function() {
                                const $input = $(this);
                                    const name = $input.attr('name');
                                    if (name && name !== 'layout' && name !== 'per_page' && name !== 'page' && name !== 'sort_by') {
                                        const oldVal = $input.val();
                                        $input.val('');
                                        hiddenInputsCleared++;
                                        if (oldVal) console.log('[CLEAR_FILTERS] Cleared hidden input:', name, 'old value:', oldVal);
                        }
                                });
                                if (hiddenInputsCleared > 0) console.log('[CLEAR_FILTERS] Cleared', hiddenInputsCleared, 'hidden inputs');
                                
                                // Clear all selects (Bootstrap Select, Select2, regular)
                                let selectsCleared = 0;
                                form.find('select').each(function() {
                                    const $select = $(this);
                                    const name = $select.attr('name');
                                    if (name && name !== 'layout' && name !== 'per_page' && name !== 'page' && name !== 'sort_by') {
                                        const oldVal = $select.val();
                                        // Bootstrap Select
                                        if ($select.hasClass('selectpicker')) {
                                            if ($select.prop('multiple')) {
                                                $select.selectpicker('deselectAll');
                                        } else {
                                                $select.selectpicker('val', '');
                                            }
                                            $select.selectpicker('refresh');
                                            selectsCleared++;
                                            if (oldVal) console.log('[CLEAR_FILTERS] Cleared selectpicker:', name, 'old value:', oldVal, 'new value:', $select.selectpicker('val'));
                                        }
                                        // Select2
                                        else if ($select.hasClass('select2-hidden-accessible') || $select.hasClass('selectpicker-location')) {
                                            $select.val(null).trigger('change');
                                            selectsCleared++;
                                            if (oldVal) console.log('[CLEAR_FILTERS] Cleared Select2:', name, 'old value:', oldVal);
                                        }
                                        // Regular select
                                        else {
                                            if ($select.prop('multiple')) {
                                                $select.val([]);
                                        } else {
                                                $select.val('').trigger('change');
                        }
                                            selectsCleared++;
                                            if (oldVal) console.log('[CLEAR_FILTERS] Cleared regular select:', name, 'old value:', oldVal);
                                    }
                                }
                            });
                                if (selectsCleared > 0) console.log('[CLEAR_FILTERS] Cleared', selectsCleared, 'selects');
                            }
                            
                            // Clear sidebar form
                            console.log('[CLEAR_FILTERS] ===== CLEARING SIDEBAR FORM =====');
                            clearForm('#jobs-filter-form');
                            
                            // Clear top filter form
                            console.log('[CLEAR_FILTERS] ===== CLEARING TOP FILTER FORM =====');
                            clearForm('#jobs-top-filter-form');
                            
                            // Clear job city search inputs (sidebar)
                            const jobCitySearch = $('#job_city_search');
                            const jobCityId = $('#job_city_id');
                            if (jobCitySearch.length && jobCitySearch.val()) {
                                console.log('[CLEAR_FILTERS] Clearing job_city_search, old value:', jobCitySearch.val());
                                jobCitySearch.val('');
                            }
                            if (jobCityId.length && jobCityId.val()) {
                                console.log('[CLEAR_FILTERS] Clearing job_city_id, old value:', jobCityId.val());
                                jobCityId.val('');
                            }
                            $('#job-city-suggestions').hide().empty();
                            
                            // Clear job role search inputs (sidebar)
                            const jobRoleSearch = $('#job_role_search');
                            const jobRoleId = $('#job_role_id');
                            if (jobRoleSearch.length && jobRoleSearch.val()) {
                                console.log('[CLEAR_FILTERS] Clearing job_role_search, old value:', jobRoleSearch.val());
                                jobRoleSearch.val('');
                            }
                            if (jobRoleId.length && jobRoleId.val()) {
                                console.log('[CLEAR_FILTERS] Clearing job_role_id, old value:', jobRoleId.val());
                                jobRoleId.val('');
                            }
                            $('#job-role-suggestions').hide().empty();
                            
                            // Clear job location search inputs
                            $('#job_location_search, #job_location_city_id').val('');
                            $('#job-location-suggestions').hide().empty();
                            
                            // Reset radius slider
                            const radiusSlider = document.getElementById('radius-slider');
                            if (radiusSlider) {
                                const oldRadius = radiusSlider.value;
                                radiusSlider.value = 0;
                                const radiusValue = document.getElementById('radius-value');
                                if (radiusValue) {
                                    radiusValue.textContent = '0';
                                }
                                // Trigger change event to update display
                                $(radiusSlider).trigger('change');
                                if (oldRadius !== '0') console.log('[CLEAR_FILTERS] Reset radius slider from', oldRadius, 'to 0');
                            }
                            
                            // Force refresh all selectpickers after clearing (keyword and location dropdowns)
                            setTimeout(function() {
                                console.log('[CLEAR_FILTERS] ===== REFRESHING SELECTPICKERS =====');
                                if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                                    // Refresh keyword dropdown
                                    const $keywordSelect = $('#home_category_search');
                                    if ($keywordSelect.length && $keywordSelect.hasClass('selectpicker')) {
                                        const oldKeywordVal = $keywordSelect.selectpicker('val');
                                        $keywordSelect.selectpicker('val', '');
                                        $keywordSelect.selectpicker('refresh');
                                        const newKeywordVal = $keywordSelect.selectpicker('val');
                                        console.log('[CLEAR_FILTERS] Keyword dropdown - old:', oldKeywordVal, 'new:', newKeywordVal);
                                    } else {
                                        console.log('[CLEAR_FILTERS] Keyword dropdown not found or not selectpicker');
                                    }
                                    
                                    // Refresh location dropdown
                                    const $locationSelect = $('#home_city_search');
                                    if ($locationSelect.length && $locationSelect.hasClass('selectpicker')) {
                                        const oldLocationVal = $locationSelect.selectpicker('val');
                                        $locationSelect.selectpicker('val', '');
                                        $locationSelect.selectpicker('refresh');
                                        const newLocationVal = $locationSelect.selectpicker('val');
                                        console.log('[CLEAR_FILTERS] Location dropdown - old:', oldLocationVal, 'new:', newLocationVal);
                                    } else {
                                        console.log('[CLEAR_FILTERS] Location dropdown not found or not selectpicker');
                                    }
                                    
                                    // Refresh all other selectpickers in the form
                                    $('#jobs-top-filter-form .selectpicker, #jobs-filter-form .selectpicker').each(function() {
                                    const $select = $(this);
                                        const name = $select.attr('name');
                                        const oldVal = $select.selectpicker('val');
                                        if ($select.prop('multiple')) {
                                            $select.selectpicker('deselectAll');
                                    } else {
                                            $select.selectpicker('val', '');
                                        }
                                        $select.selectpicker('refresh');
                                        const newVal = $select.selectpicker('val');
                                        if (oldVal && oldVal !== '') {
                                            console.log('[CLEAR_FILTERS] Selectpicker', name, '- old:', oldVal, 'new:', newVal);
                                        }
                                    });
                                } else {
                                    console.log('[CLEAR_FILTERS] jQuery or selectpicker not available');
                                }
                            }, 150);
                            
                            // Submit the form to refresh results with cleared filters
                            setTimeout(function() {
                                console.log('[CLEAR_FILTERS] ===== SUBMITTING FORM =====');
                                const topForm = $('#jobs-top-filter-form');
                                if (topForm.length) {
                                    // Update URL to remove all query parameters
                                    const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
                                    const cleanUrl = baseUrl.split('?')[0];
                                    console.log('[CLEAR_FILTERS] Updating URL to:', cleanUrl);
                                    window.history.pushState({}, '', cleanUrl);
                                    
                                    // Check form values before submission
                                    const formData = new FormData(topForm[0]);
                                    const formValues = {};
                                    for (let [key, value] of formData.entries()) {
                                        if (value && value !== '') {
                                            formValues[key] = value;
                                        }
                                    }
                                    console.log('[CLEAR_FILTERS] Form values before submit:', formValues);
                                    
                                    // Trigger form submission via AJAX (jobs.js handles this)
                                    console.log('[CLEAR_FILTERS] Triggering form submit');
                                    topForm.trigger('submit');
                                } else {
                                    console.log('[CLEAR_FILTERS] Form not found, redirecting');
                                    // Fallback: redirect to base URL
                            const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
                            window.location.href = baseUrl.split('?')[0];
                                }
                            }, 300);
                        });
                    </script>
                </div>

            
            

            <div class="col-lg-9 col-md-12 position-relative">
                <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <button type="submit" class="d-block d-md-none btn btn-open-filter" style="background: linear-gradient(135deg, #0073d1 0%, #00a8ff 100%); color: #fff; border: none; padding: 12px 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 115, 209, 0.3);">
                            <i class="feather-filter"></i>
                            <span style="margin-left: 8px;"><?php echo e(__('Filters')); ?></span>
                        </button>
                        <span class="woocommerce-result-count-left">
                        <?php if($jobs->total()): ?>
                                <?php echo e(__('Showing :from – :to of :total results', [
                                    'from' => $jobs->firstItem(),
                                    'to'=> $jobs->lastItem(),
                                    'total' => $jobs->total(),
                                ])); ?>

                            <?php else: ?>
                                <?php echo e(__('No jobs found')); ?>

                            <?php endif; ?>
                    </span>
                    </div>
                    
                </div>

                <div class="twm-jobs-list-wrap jobs-listing" id="jobs-listing-container" style="position: relative; min-height: 400px;">
                    
                    <div class="blue-loader-overlay" id="jobs-loader-overlay" style="display: none !important;">
                        <div class="blue-loader-wrapper">
                            <div class="blue-loader large"></div>
                            <p class="blue-loader-text">Loading jobs...</p>
                        </div>
                    </div>
                    <?php echo Theme::partial("jobs.$layout", ['jobs' => $jobs, 'style' => 2]); ?>

                </div>
                
                
                <style>
                /* Blue Loader Styles for Jobs Page */
                #jobs-listing-container {
                    position: relative !important;
                    min-height: 400px !important;
                }
                
                .blue-loader-overlay {
                    position: absolute !important;
                    top: 0 !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 0 !important;
                    width: 100% !important;
                    height: 100% !important;
                    min-height: 400px !important;
                    background: rgba(255, 255, 255, 0.98) !important;
                    backdrop-filter: blur(5px);
                    -webkit-backdrop-filter: blur(5px);
                    display: none !important;
                    align-items: center !important;
                    justify-content: center !important;
                    z-index: 99999 !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    pointer-events: all !important;
                }
                
                .blue-loader-overlay[style*="display: flex"],
                .blue-loader-overlay[style*="display:flex"],
                .blue-loader-overlay.show {
                    display: flex !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }
                
                .blue-loader {
                    width: 60px;
                    height: 60px;
                    border: 5px solid rgba(0, 115, 209, 0.2);
                    border-top-color: #0073d1;
                    border-radius: 50%;
                    animation: blue-spin 0.8s linear infinite;
                    flex-shrink: 0;
                }
                
                @keyframes blue-spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
                
                .blue-loader-wrapper {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 15px;
                }
                
                .blue-loader-text {
                    color: #0073d1;
                    font-size: 14px;
                    font-weight: 500;
                    margin: 0;
                    text-align: center;
                }
                </style>

                <div id="map" style="display: none" data-center="<?php echo e(json_encode(JobBoardHelper::getMapCenterLatLng())); ?>"></div>

                <!-- <div class="job-board-street-map-container">
                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="job-board-street-map"
                            data-job="<?php echo e($job); ?>"
                            data-map-icon="<?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?>"
                            data-company-logo="<?php echo e($job->company_logo_thumb); ?>"
                            data-full-address="<?php echo e($job->full_address); ?>"
                            data-url="<?php echo e($job->url); ?>"
                        >
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to reapply selectpicker styles after initialization/refresh
    function reapplySelectpickerStyles() {
        // Single and multiple selectpickers
        const selectpickers = document.querySelectorAll('.jobs-top-filter .filter-group .bootstrap-select .dropdown-toggle');
        selectpickers.forEach(function(toggle) {
            toggle.style.padding = '16px 18px';
            toggle.style.border = '2px solid #e2e8f0';
            toggle.style.borderRadius = '14px';
            toggle.style.fontSize = '15px';
            toggle.style.background = '#ffffff';
            toggle.style.backgroundColor = '#ffffff';
            toggle.style.color = '#1e293b';
            toggle.style.fontWeight = '500';
            toggle.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.02)';
            toggle.style.textAlign = 'left';
        });
        
        // Also handle Select2 if it's being used (single and multiple)
        const select2Single = document.querySelectorAll('.jobs-top-filter .filter-group .select2-container--default .select2-selection--single');
        const select2Multiple = document.querySelectorAll('.jobs-top-filter .filter-group .select2-container--default .select2-selection--multiple');
        
        [...select2Single, ...select2Multiple].forEach(function(selection) {
            selection.style.padding = '16px 18px';
            selection.style.border = '2px solid #e2e8f0';
            selection.style.borderRadius = '14px';
            selection.style.fontSize = '15px';
            selection.style.background = '#ffffff';
            selection.style.backgroundColor = '#ffffff';
            selection.style.color = '#1e293b';
            selection.style.fontWeight = '500';
            selection.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.02)';
        });
    }
    
    // Reapply styles after a short delay to ensure selectpicker is initialized
    setTimeout(function() {
        reapplySelectpickerStyles();
    }, 500);
    
    // Reapply styles when selectpicker is refreshed
    if (typeof $ !== 'undefined' && $.fn.selectpicker) {
        $(document).on('refreshed.bs.select', '.jobs-top-filter .selectpicker', function() {
            setTimeout(reapplySelectpickerStyles, 50);
        });
    }
    
    // Use MutationObserver to watch for DOM changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' || mutation.type === 'attributes') {
                setTimeout(reapplySelectpickerStyles, 100);
            }
        });
    });
    
    const filterContainer = document.querySelector('.jobs-top-filter');
    if (filterContainer) {
        observer.observe(filterContainer, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class', 'style']
        });
    }
    
    // Radius slider update
    const radiusSlider = document.getElementById('radius-slider');
    const radiusValue = document.getElementById('radius-value');
    
    if (radiusSlider && radiusValue) {
        radiusValue.textContent = radiusSlider.value;
        radiusSlider.addEventListener('input', function() {
            radiusValue.textContent = this.value;
        });
    }
    
    // Layout toggle functionality - for sidebar button
    const layoutToggleSidebar = document.getElementById('layout-toggle-sidebar');
    const layoutIconSidebar = document.getElementById('layout-icon-sidebar');
    const layoutTextSidebar = document.getElementById('layout-text-sidebar');
    
    function updateLayoutButtons() {
        const currentLayout = '<?php echo e($layout); ?>' || 'grid';
        const isList = currentLayout === 'list';
        
        if (layoutToggleSidebar) {
            if (isList) {
                layoutToggleSidebar.classList.add('active');
                if (layoutIconSidebar) layoutIconSidebar.className = 'feather-list';
                if (layoutTextSidebar) layoutTextSidebar.textContent = '<?php echo e(__('List')); ?>';
            } else {
                layoutToggleSidebar.classList.remove('active');
                if (layoutIconSidebar) layoutIconSidebar.className = 'feather-grid';
                if (layoutTextSidebar) layoutTextSidebar.textContent = '<?php echo e(__('Grid')); ?>';
            }
        }
    }
    
    updateLayoutButtons();
    
    if (layoutToggleSidebar) {
        layoutToggleSidebar.addEventListener('click', function() {
            const currentLayout = '<?php echo e($layout); ?>' || 'grid';
            const isList = currentLayout === 'list';
            const newLayout = isList ? 'grid' : 'list';
            
            // Update hidden input
            const layoutInput = document.getElementById('layout-input');
            if (layoutInput) {
                layoutInput.value = newLayout;
            }
            
            // Update URL parameter and reload
            const url = new URL(window.location.href);
            url.searchParams.set('layout', newLayout);
            window.location.href = url.toString();
        });
    }
    
    // Advance search toggle - show/hide advanced filters
    // Clear Top Filters Button - Comprehensive clearing
    // Use both jQuery and vanilla JS to ensure it works
    function attachClearTopFiltersHandler() {
        console.log('[CLEAR_TOP_FILTERS] Attempting to attach handler');
        
        // Try jQuery first (more reliable with event delegation)
        if (typeof jQuery !== 'undefined') {
            jQuery(document).off('click', '#clear-top-filters').on('click', '#clear-top-filters', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('[CLEAR_TOP_FILTERS] Clear Top Filters button clicked (jQuery handler)');
                
                // Trigger the same logic as clear-all button
                jQuery('#clear-all-job-filters').trigger('click');
            });
            console.log('[CLEAR_TOP_FILTERS] jQuery handler attached');
        }
        
        // Also try vanilla JS
    const clearTopFiltersBtn = document.getElementById('clear-top-filters');
    if (clearTopFiltersBtn) {
            // Remove existing listeners
            const newBtn = clearTopFiltersBtn.cloneNode(true);
            clearTopFiltersBtn.parentNode.replaceChild(newBtn, clearTopFiltersBtn);
            
            newBtn.addEventListener('click', function(e) {
            e.preventDefault();
                e.stopPropagation();
                console.log('[CLEAR_TOP_FILTERS] Clear Top Filters button clicked (vanilla JS handler)');
                
                // Trigger the same logic as clear-all button
                if (typeof jQuery !== 'undefined') {
                    jQuery('#clear-all-job-filters').trigger('click');
                } else {
                    const clearAllBtn = document.getElementById('clear-all-job-filters');
                    if (clearAllBtn) {
                        clearAllBtn.click();
                    }
                }
            });
            console.log('[CLEAR_TOP_FILTERS] Vanilla JS handler attached');
        } else {
            console.log('[CLEAR_TOP_FILTERS] Button not found, will retry');
            setTimeout(attachClearTopFiltersHandler, 500);
        }
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', attachClearTopFiltersHandler);
    } else {
        attachClearTopFiltersHandler();
    }
    
    // Also try with jQuery ready
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function() {
            attachClearTopFiltersHandler();
        });
    }
    
    // Old handler (keeping for compatibility but will be overridden)
    const clearTopFiltersBtnOld = document.getElementById('clear-top-filters');
    if (clearTopFiltersBtnOld) {
        clearTopFiltersBtnOld.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('[CLEAR_TOP_FILTERS] Clear Top Filters button clicked (OLD handler - should not see this)');
            
            // Show loader - force show with setAttribute
            const loader = document.getElementById('jobs-loader-overlay');
            if (loader) {
                loader.setAttribute('style', 'display: flex !important; visibility: visible !important; opacity: 1 !important;');
                loader.classList.add('show');
            } else {
                // Create loader if it doesn't exist
                const jobsListContainer = document.getElementById('jobs-listing-container');
                if (jobsListContainer) {
                    const loaderHtml = '<div class="blue-loader-overlay" id="jobs-loader-overlay" style="display: flex !important; visibility: visible !important; opacity: 1 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading jobs...</p></div></div>';
                    jobsListContainer.insertAdjacentHTML('afterbegin', loaderHtml);
                }
            }
            
            // Function to clear all inputs in a form
            function clearForm(formSelector) {
                const form = document.querySelector(formSelector);
            if (!form) {
                console.log('[CLEAR_TOP_FILTERS] Form not found:', formSelector);
                return;
            }
            console.log('[CLEAR_TOP_FILTERS] Clearing form:', formSelector);
            
                // Clear all text inputs, search inputs
                form.querySelectorAll('input[type="text"], input[type="search"], input[type="number"]').forEach(function(input) {
                    if (input.name && input.name !== 'layout' && input.name !== 'per_page' && input.name !== 'page' && input.name !== 'sort_by') {
                    input.value = '';
                }
            });
            
                // Clear all checkboxes
                form.querySelectorAll('input[type="checkbox"]').forEach(function(input) {
                    input.checked = false;
                });
                
                // Clear all radio buttons
                form.querySelectorAll('input[type="radio"]').forEach(function(input) {
                    input.checked = false;
                });
                
                // Clear all hidden inputs (except system ones)
                form.querySelectorAll('input[type="hidden"]').forEach(function(input) {
                    if (input.name && input.name !== 'layout' && input.name !== 'per_page' && input.name !== 'page' && input.name !== 'sort_by') {
                        input.value = '';
                    }
                });
                
                // Clear all selects
                form.querySelectorAll('select').forEach(function(select) {
                    if (select.name && select.name !== 'layout' && select.name !== 'per_page' && select.name !== 'page' && select.name !== 'sort_by') {
                const $select = $(select);
                        // Bootstrap Select
                if ($select.hasClass('selectpicker')) {
                    if (select.multiple) {
                        $select.selectpicker('deselectAll');
                    } else {
                        $select.selectpicker('val', '');
                    }
                    $select.selectpicker('refresh');
                        }
                        // Select2
                        else if ($select.hasClass('select2-hidden-accessible') || $select.hasClass('selectpicker-location')) {
                            $select.val(null).trigger('change');
                        }
                        // Regular select
                        else {
                    if (select.multiple) {
                                select.value = [];
                    } else {
                                select.value = '';
                                select.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                    }
                }
            });
            }
            
            // Clear top filter form
            console.log('[CLEAR_TOP_FILTERS] ===== CLEARING TOP FILTER FORM =====');
            clearForm('#jobs-top-filter-form');
            
            // Clear sidebar form
            console.log('[CLEAR_TOP_FILTERS] ===== CLEARING SIDEBAR FORM =====');
            clearForm('#jobs-filter-form');
            
            // Clear job city search inputs (sidebar)
            const citySearch = document.getElementById('job_city_search');
            const cityId = document.getElementById('job_city_id');
            const citySuggestions = document.getElementById('job-city-suggestions');
            if (citySearch && citySearch.value) {
                console.log('[CLEAR_TOP_FILTERS] Clearing job_city_search, old value:', citySearch.value);
                citySearch.value = '';
            }
            if (cityId && cityId.value) {
                console.log('[CLEAR_TOP_FILTERS] Clearing job_city_id, old value:', cityId.value);
                cityId.value = '';
            }
            if (citySuggestions) {
                citySuggestions.style.display = 'none';
                citySuggestions.innerHTML = '';
            }
            
            // Clear job role search inputs (sidebar)
            const roleSearch = document.getElementById('job_role_search');
            const roleId = document.getElementById('job_role_id');
            const roleSuggestions = document.getElementById('job-role-suggestions');
            if (roleSearch && roleSearch.value) {
                console.log('[CLEAR_TOP_FILTERS] Clearing job_role_search, old value:', roleSearch.value);
                roleSearch.value = '';
            }
            if (roleId && roleId.value) {
                console.log('[CLEAR_TOP_FILTERS] Clearing job_role_id, old value:', roleId.value);
                roleId.value = '';
            }
            if (roleSuggestions) {
                roleSuggestions.style.display = 'none';
                roleSuggestions.innerHTML = '';
            }
            
            // Clear keyword and location select dropdowns (top filter) - do this AFTER clearForm
            // Use setTimeout to ensure selectpicker is ready
            setTimeout(function() {
                console.log('[CLEAR_TOP_FILTERS] ===== REFRESHING SELECTPICKERS =====');
                if (typeof jQuery !== 'undefined' && jQuery.fn.selectpicker) {
                    // Clear keyword dropdown
                    const $keywordSelect = jQuery('#home_category_search');
                    if ($keywordSelect.length && $keywordSelect.hasClass('selectpicker')) {
                        const oldKeywordVal = $keywordSelect.selectpicker('val');
                        $keywordSelect.selectpicker('val', '');
                        $keywordSelect.selectpicker('refresh');
                        const newKeywordVal = $keywordSelect.selectpicker('val');
                        console.log('[CLEAR_TOP_FILTERS] Keyword dropdown - old:', oldKeywordVal, 'new:', newKeywordVal);
                    } else {
                        console.log('[CLEAR_TOP_FILTERS] Keyword dropdown not found or not selectpicker');
                    }
                    
                    // Clear location dropdown
                    const $locationSelect = jQuery('#home_city_search');
                    if ($locationSelect.length && $locationSelect.hasClass('selectpicker')) {
                        const oldLocationVal = $locationSelect.selectpicker('val');
                        $locationSelect.selectpicker('val', '');
                        $locationSelect.selectpicker('refresh');
                        const newLocationVal = $locationSelect.selectpicker('val');
                        console.log('[CLEAR_TOP_FILTERS] Location dropdown - old:', oldLocationVal, 'new:', newLocationVal);
                            } else {
                        console.log('[CLEAR_TOP_FILTERS] Location dropdown not found or not selectpicker');
                            }
                        } else {
                    console.log('[CLEAR_TOP_FILTERS] jQuery or selectpicker not available');
                }
            }, 100);
            
            // Clear job location search inputs
            const locationSearch = document.getElementById('job_location_search');
            const locationCityId = document.getElementById('job_location_city_id');
            const locationSuggestions = document.getElementById('job-location-suggestions');
            if (locationSearch) locationSearch.value = '';
            if (locationCityId) locationCityId.value = '';
            if (locationSuggestions) {
                locationSuggestions.style.display = 'none';
                locationSuggestions.innerHTML = '';
            }
            
            // Reset radius slider
            const radiusSlider = document.getElementById('radius-slider');
            if (radiusSlider) {
                radiusSlider.value = 0;
                const radiusValue = document.getElementById('radius-value');
                if (radiusValue) {
                    radiusValue.textContent = '0';
                }
                // Trigger change event to update display
                radiusSlider.dispatchEvent(new Event('change', { bubbles: true }));
            }
            
            // Clear home city search (top filter)
            const homeCitySearch = document.getElementById('home_city_search');
            const homeCityId = document.getElementById('home_city_id');
            const homeCitySuggestions = document.getElementById('home-city-suggestions');
            if (homeCitySearch) homeCitySearch.value = '';
            if (homeCityId) homeCityId.value = '';
            if (homeCitySuggestions) {
                homeCitySuggestions.style.display = 'none';
                homeCitySuggestions.innerHTML = '';
            }
            
            // Submit the form to refresh results with cleared filters
            // Use jQuery to trigger form submission which will handle AJAX properly
            if (typeof jQuery !== 'undefined') {
                const $topForm = jQuery('#jobs-top-filter-form');
                if ($topForm.length) {
                    // Update URL to remove all query parameters
            const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
                    const cleanUrl = baseUrl.split('?')[0];
                    window.history.pushState({}, '', cleanUrl);
            
                    // Trigger form submission via AJAX (jobs.js handles this)
                    $topForm.trigger('submit');
                            } else {
                    // Fallback: redirect to base URL
            const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
            window.location.href = baseUrl.split('?')[0];
                            }
                        } else {
                // Fallback: redirect to base URL
            const baseUrl = '<?php echo e(JobBoardHelper::getJobsPageURL()); ?>';
            window.location.href = baseUrl.split('?')[0];
            }
        });
    }
    
    const advanceSearchLink = document.getElementById('toggle-advance-search');
    const advancedFiltersRow = document.getElementById('advanced-filters-row');
    
    if (advanceSearchLink && advancedFiltersRow) {
        const hideText = '<i class="feather-minus"></i> <?php echo e(__("Hide Advanced Search")); ?>';
        const showText = '<i class="feather-plus"></i> <?php echo e(__("Advance Search")); ?>';
        
        // Force hide initially to ensure default state
        advancedFiltersRow.classList.remove('show');
        advancedFiltersRow.style.display = 'none';
        
        // Function to update UI state
        function updateAdvancedFiltersState(show) {
            if (show) {
                // Show advanced filters
                advancedFiltersRow.style.display = 'grid';
                advancedFiltersRow.classList.add('show');
                advanceSearchLink.innerHTML = hideText;
                // Trigger selectpicker refresh if needed
                if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                    setTimeout(function() {
                        $('.selectpicker').selectpicker('refresh');
                    }, 100);
                }
            } else {
                // Hide advanced filters
                advancedFiltersRow.classList.remove('show');
                advancedFiltersRow.style.display = 'none';
                advanceSearchLink.innerHTML = showText;
            }
        }
        
        // Check URL parameter to see if advanced search was previously opened
        const urlParams = new URLSearchParams(window.location.search);
        const showAdvanced = urlParams.get('show_advanced') === '1';
        
        // Set initial state - default is hidden (only 3 basic fields visible)
        // Only show if URL explicitly has show_advanced=1
        if (showAdvanced) {
            updateAdvancedFiltersState(true);
        } else {
            updateAdvancedFiltersState(false);
        }
        
        // Handle button click
        advanceSearchLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle state
            const isCurrentlyShowing = advancedFiltersRow.classList.contains('show') || advancedFiltersRow.style.display === 'grid';
            
            if (isCurrentlyShowing) {
                // Currently showing, so hide them
                updateAdvancedFiltersState(false);
                
                // Remove show_advanced from URL
                const url = new URL(window.location.href);
                url.searchParams.delete('show_advanced');
                window.history.replaceState({}, '', url);
            } else {
                // Currently hidden, so show them
                updateAdvancedFiltersState(true);
                
                // Update URL to maintain state
                const url = new URL(window.location.href);
                url.searchParams.set('show_advanced', '1');
                window.history.replaceState({}, '', url);
            }
        });
    }
    
    
    
});

// Load job categories for jobs page (like homepage) - use same data as sidebar job roles
<?php
    // Use the same $jobRoles that are displayed in the sidebar
    $jobCategories = $jobRoles->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        })
        ->values()
        ->toArray();
?>
<script>
// Set window.jobCategories for jobs page (required by home_category_search)
// This uses the same data as the sidebar job roles dropdown
window.jobCategories = <?php echo json_encode($jobCategories, 15, 512) ?>;
console.log('[JOB_ROLES] window.jobCategories set with', window.jobCategories.length, 'roles');

// Initialize keyword and location select dropdowns using Bootstrap Select
(function($) {
    $(document).ready(function() {
        // Initialize Keyword Dropdown
        const $keywordSelect = $('#home_category_search');
        
        if ($keywordSelect.length) {
            // Initialize Bootstrap Select if available
            if (typeof $.fn.selectpicker !== 'undefined') {
                $keywordSelect.selectpicker({
                    liveSearch: true,
                    liveSearchPlaceholder: 'Search job roles...',
                    noneSelectedText: 'Select keyword',
                    noneResultsText: 'No job roles found',
                    style: 'btn-default',
                    size: false
                });
                
                console.log('[KEYWORD_DROPDOWN] Bootstrap Select initialized');
                
                // Handle change event to submit form
                $keywordSelect.on('changed.bs.select', function() {
                    console.log('[KEYWORD_DROPDOWN] Selection changed:', $(this).val());
                    const $form = $('#jobs-top-filter-form');
                    if ($form.length) {
                        $form.trigger('submit');
                    }
                });
                } else {
                // Fallback: Handle change event for native select
                $keywordSelect.on('change', function() {
                    const $form = $('#jobs-top-filter-form');
                    if ($form.length) {
                        $form.trigger('submit');
                    }
                });
            }
        }
        
        // Initialize Location Dropdown
        const $locationSelect = $('#home_city_search');
        
        if ($locationSelect.length) {
            // Initialize Bootstrap Select if available
            if (typeof $.fn.selectpicker !== 'undefined') {
                $locationSelect.selectpicker({
                    liveSearch: true,
                    liveSearchPlaceholder: 'Search cities...',
                    noneSelectedText: 'Select Your Location',
                    noneResultsText: 'No cities found',
                    style: 'btn-default',
                    size: false
                });
                
                console.log('[LOCATION_DROPDOWN] Bootstrap Select initialized');
                
                // Handle change event to submit form
                $locationSelect.on('changed.bs.select', function() {
                    console.log('[LOCATION_DROPDOWN] Selection changed:', $(this).val());
                    const $form = $('#jobs-top-filter-form');
                    if ($form.length) {
                        $form.trigger('submit');
                    }
                });
            } else {
                // Fallback: Handle change event for native select
                $locationSelect.on('change', function() {
                    const $form = $('#jobs-top-filter-form');
                    if ($form.length) {
                        $form.trigger('submit');
                    }
                });
            }
        }
    });
})(window.jQuery || window.$);

// Use homepage functions for jobs page filters
document.addEventListener('DOMContentLoaded', function() {
    console.log('[JOB_ROLES] DOMContentLoaded - initializing search functions');
    // Wait a bit for window.jobCategories to be set
    setTimeout(function() {
        console.log('[JOB_ROLES] Initializing search functions, jobCategories count:', window.jobCategories ? window.jobCategories.length : 0);
        // Initialize homepage category search if element exists
        if (typeof home_category_search === 'function') {
            console.log('[JOB_ROLES] Calling home_category_search()');
            home_category_search();
        } else {
            console.warn('[JOB_ROLES] home_category_search function not found');
        }
        
        // Initialize homepage city search if element exists
        if (typeof home_city_search === 'function') {
            home_city_search();
        }
    }, 100);
});
</script>

<script>
// Note: home_category_search is now a select dropdown, not a text input
// The select dropdown is initialized above using Bootstrap Select
// Old text input handler code removed - select dropdown works directly
</script>


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/jobs/index.blade.php ENDPATH**/ ?>