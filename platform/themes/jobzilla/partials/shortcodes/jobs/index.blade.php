@php
    use Botble\Base\Facades\BaseHelper;
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    use Botble\Base\Enums\BaseStatusEnum;
    use Botble\JobBoard\Repositories\Interfaces\JobTypeInterface;
    
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
    
    // Get job roles (categories - can be filtered by parent)
    $jobRoles = $allCategories->take(50);
    
    // Get job types
    $jobTypes = app(JobTypeInterface::class)->advancedGet([
        'condition' => ['status' => BaseStatusEnum::PUBLISHED],
    ]);
@endphp

{!! Theme::partial('jobs-card-styles') !!}

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
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
}

.jobs-top-filter .filter-group {
    position: relative;
    animation: fadeInUp 0.5s ease-out both;
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

.jobs-top-filter .filter-group .location-input-wrapper {
    position: relative;
}

.jobs-top-filter .filter-group .location-input-wrapper i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #0073d1;
    font-size: 18px;
    z-index: 1;
}

.jobs-top-filter .filter-group .location-input-wrapper input {
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
    justify-content: space-between;
    margin-top: 30px;
    padding-top: 28px;
    border-top: 2px solid #e2e8f0;
    gap: 20px;
    position: relative;
    z-index: 1;
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
    padding: 12px 28px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.35), 0 2px 6px rgba(0, 115, 209, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
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
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 14px;
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
    font-size: 14px;
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

/* Jobs container animation */
.jobs-listing {
    animation: fadeIn 0.6s ease-out;
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
</style>

<div class="section-full p-t120 p-b90 site-bg-white jobs-container">
    <div class="container">
        <div class="jobs-sc-heading">
            <h2>{{ __('Jobs') }}</h2>
            <p>{{ __('Find the best teaching opportunities across India') }}</p>
        </div>
        
        <!-- Top Filter Section -->
        <form action="{{ JobBoardHelper::getJobsPageURL() }}" method="get" id="jobs-top-filter-form" class="jobs-top-filter">
            <input type="hidden" name="layout" value="{{ $layout }}" id="layout-input">
            <div class="filter-row">
                <div class="filter-group">
                    <label>
                        <i class="feather-briefcase"></i>
                        <span>{{ __('Select Job Role') }}</span>
                    </label>
                    <select name="job_categories[]" class="selectpicker" data-live-search="true" data-size="8" title="{{ __('Select Job Role') }}">
                        <option value="">{{ __('All Job Roles') }}</option>
                        @foreach($jobRoles as $jobRole)
                            <option value="{{ $jobRole->id }}" @selected(in_array($jobRole->id, (array) request()->query('job_categories', [])))>{{ $jobRole->name }}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" name="keyword" value="{{ BaseHelper::stringify(request()->query('keyword')) }}" placeholder="{{ __('Or Enter Teaching Subject or Post') }}" class="keyword-input-below"> -->
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-map-pin"></i>
                        <span>{{ __('Enter City or State') }}</span>
                    </label>
                    <div class="location-input-wrapper">
                        <i class="feather-map-pin"></i>
                        <input type="text" name="location" value="{{ BaseHelper::stringify(request()->query('location')) }}" placeholder="{{ __('Enter City or State') }}">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-building"></i>
                        <span>{{ __('Select Institution Type') }}</span>
                    </label>
                    <select name="institution_type" class="selectpicker">
                        <option value="">{{ __('All Institution Types') }}</option>
                        @foreach($institutionTypes as $institutionType)
                            <option value="{{ $institutionType->id }}" @selected($institutionType->id == request()->query('institution_type'))>{{ $institutionType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="filter-row advanced-filters-row" id="advanced-filters-row">
                <div class="filter-group">
                    <label>
                        <i class="feather-navigation"></i>
                        <span>{{ __('Radius') }}: <span class="radius-value" id="radius-value">{{ request()->query('radius', 0) }}</span> Km</span>
                    </label>
                    <div class="radius-slider-wrapper">
                        <input type="range" name="radius" id="radius-slider" class="radius-slider" min="0" max="100" value="{{ request()->query('radius', 0) }}" step="5">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-calendar"></i>
                        <span>{{ __('Date Posted') }}</span>
                    </label>
                    <select name="date_posted" class="selectpicker">
                        <option value="">{{ __('All') }}</option>
                        @foreach(JobBoardHelper::postedDateRanges() as $key => $item)
                            <option value="{{ $key }}" @selected($key == request()->query('date_posted'))>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-clock"></i>
                        <span>{{ __('Job Type') }}</span>
                    </label>
                    <select name="job_types[]" class="selectpicker" multiple>
                        @foreach($jobTypes as $jobType)
                            <option value="{{ $jobType->id }}" @selected(in_array($jobType->id, (array) request()->query('job_types', [])))>{{ $jobType->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-user"></i>
                        <span>{{ __('Select job role') }}</span>
                    </label>
                    <select name="job_categories[]" class="selectpicker" multiple>
                        @foreach($jobRoles as $jobRole)
                            <option value="{{ $jobRole->id }}" @selected(in_array($jobRole->id, (array) request()->query('job_categories', [])))>{{ $jobRole->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="filter-actions">
                <a href="#" class="advance-search-link" id="toggle-advance-search">
                    <i class="feather-plus"></i>
                    {{ __('Advance Search') }}
                </a>
                <div style="display: flex; gap: 12px; align-items: center;">
                    <button type="button" class="clear-filter-btn" id="clear-top-filters">
                        <i class="feather-x-circle"></i>
                        {{ __('Clear Filters') }}
                    </button>
                <button type="submit" class="search-btn">
                    <i class="feather-search"></i>
                    {{ __('Find Job') }}
                </button>
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
                            
                            {{-- Sidebar Header with Clear Filters --}}
                            <div class="sidebar-header">
                                <h4>
                                    <i class="feather-filter"></i>
                                        {{ __('Filters') }}
                                    </h4>
                                <button type="button" class="btn-clear-filters" id="clear-all-job-filters">
                                    <i class="feather-x-circle"></i>
                                        {{ __('Clear All') }}
                                    </button>
                            </div>
                            
                                <form action="{{ JobBoardHelper::getJobsPageURL() }}" method="get" id="jobs-filter-form" data-ajax-url="{{ route('public.ajax.jobs') }}">
                                        {!! Theme::partial('jobs.filters.keyword') !!}
                                        {!! Theme::partial('jobs.filters.categories') !!}
                                        {!! Theme::partial('jobs.filters.city') !!}
                                        {!! Theme::partial('jobs.filters.types') !!}
                                        {!! Theme::partial('jobs.filters.date_posted') !!}
                                        {!! Theme::partial('jobs.filters.experiences') !!}
                                        {!! Theme::partial('jobs.filters.skills') !!}
                                
                                <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page', 12)) }}">
                                <input type="hidden" name="page" value="1">
                                <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $layout ?: 'grid') }}">
                                <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
                                
                                <!-- Apply Filter Button -->
                                <div class="apply-filter-wrapper">
                                    <button type="submit" class="apply-filter-btn">
                                        <i class="feather-check-circle"></i>
                                        <span>{{ __('Apply Filter') }}</span>
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
                        
                        // Clear all filters - matching candidates page functionality
                        $('#clear-all-job-filters, .btn-clear-filters').on('click', function(e) {
                            e.preventDefault();
                            
                            // Clear sidebar form (#jobs-filter-form)
                            const sidebarFormInputs = $('#jobs-filter-form').find('input, select, textarea');
                            sidebarFormInputs.each(function() {
                                const $input = $(this);
                                if ($input.attr('type') === 'checkbox') {
                                    $input.prop('checked', false);
                                } else if ($input.attr('type') === 'radio') {
                                    $input.prop('checked', false);
                                } else if ($input.attr('type') === 'text' || $input.attr('type') === 'number' || $input.attr('type') === 'search' || $input.attr('type') === 'hidden') {
                                    if ($input.attr('name') !== 'layout' && $input.attr('name') !== 'per_page' && $input.attr('name') !== 'page' && $input.attr('name') !== 'sort_by') {
                                        $input.val('');
                                    }
                                } else if ($input.is('select')) {
                                    // Handle Bootstrap Select (selectpicker)
                                    if ($input.hasClass('selectpicker')) {
                                        if ($input.prop('multiple')) {
                                            $input.selectpicker('deselectAll');
                                        } else {
                                            $input.selectpicker('val', '');
                                        }
                                        $input.selectpicker('refresh');
                                    } else {
                                        // Regular select
                                        if ($input.prop('multiple')) {
                                            $input.val([]);
                                        } else {
                                            $input.val('').trigger('change');
                                        }
                                    }
                                }
                            });
                            
                            // Clear top filter form (#jobs-top-filter-form)
                            const topFormInputs = $('#jobs-top-filter-form').find('input, select, textarea');
                            topFormInputs.each(function() {
                                const $input = $(this);
                                if ($input.attr('type') === 'checkbox') {
                                    $input.prop('checked', false);
                                } else if ($input.attr('type') === 'radio') {
                                    $input.prop('checked', false);
                                } else if ($input.attr('type') === 'text' || $input.attr('type') === 'number' || $input.attr('type') === 'search') {
                                    if ($input.attr('name') !== 'layout') {
                                        $input.val('');
                        }
                                } else if ($input.is('select')) {
                                    // Handle Bootstrap Select (selectpicker)
                                    if ($input.hasClass('selectpicker')) {
                                        if ($input.prop('multiple')) {
                                            $input.selectpicker('deselectAll');
                                        } else {
                                            $input.selectpicker('val', '');
                                        }
                                        $input.selectpicker('refresh');
                                    } else {
                                        // Regular select
                                        if ($input.prop('multiple')) {
                                            $input.val([]);
                                        } else {
                                            $input.val('').trigger('change');
                        }
                                    }
                                }
                            });
                            
                            // Reset radius slider
                            const radiusSlider = document.getElementById('radius-slider');
                            if (radiusSlider) {
                                radiusSlider.value = 0;
                                const radiusValue = document.getElementById('radius-value');
                                if (radiusValue) {
                                    radiusValue.textContent = '0';
                                }
                            }
                            
                            // Clear Select2 (city filter)
                            if (typeof $ !== 'undefined' && $.fn.select2) {
                                $('#jobs-filter-form .selectpicker-location, #jobs-top-filter-form .selectpicker-location').each(function() {
                                    const $select = $(this);
                                    if ($select.hasClass('select2-hidden-accessible')) {
                                        $select.val(null).trigger('change');
                                    } else {
                                        $select.val('');
                                    }
                                });
                            }
                            
                            // Clear URL parameters and reload to initial state
                            const baseUrl = '{{ JobBoardHelper::getJobsPageURL() }}';
                            window.location.href = baseUrl.split('?')[0];
                        });
                    </script>
                </div>

            {{-- Widget Sidebar - Commented out if causing CSS display issues --}}
            {{-- {!! dynamic_sidebar('job_board_sidebar') !!} --}}

            <div class="col-lg-9 col-md-12 position-relative">
                <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <button type="submit" class="d-block d-md-none btn btn-open-filter" style="background: linear-gradient(135deg, #0073d1 0%, #00a8ff 100%); color: #fff; border: none; padding: 12px 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 115, 209, 0.3);">
                            <i class="feather-filter"></i>
                            <span style="margin-left: 8px;">{{ __('Filters') }}</span>
                        </button>
                        <span class="woocommerce-result-count-left">
                        @if ($jobs->total())
                                {{ __('Showing :from – :to of :total results', [
                                    'from' => $jobs->firstItem(),
                                    'to'=> $jobs->lastItem(),
                                    'total' => $jobs->total(),
                                ]) }}
                            @else
                                {{ __('No jobs found') }}
                            @endif
                    </span>
                    </div>
                    <button type="button" class="layout-toggle-btn-small" id="layout-toggle-sidebar" data-layout="{{ $layout }}">
                        <i class="feather-grid" id="layout-icon-sidebar"></i>
                        <span id="layout-text-sidebar">{{ $layout === 'list' ? __('List') : __('Grid') }}</span>
                    </button>
                </div>

                <div class="twm-jobs-list-wrap jobs-listing" id="jobs-listing-container">
                    {!! Theme::partial("jobs.$layout", ['jobs' => $jobs, 'style' => 2]) !!}
                </div>

                <div id="map" style="display: none" data-center="{{ json_encode(JobBoardHelper::getMapCenterLatLng()) }}"></div>

                <!-- <div class="job-board-street-map-container">
                    @foreach($jobs as $job)
                        <div
                            class="job-board-street-map"
                            data-job="{{ $job }}"
                            data-map-icon="{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}"
                            data-company-logo="{{ $job->company_logo_thumb }}"
                            data-full-address="{{ $job->full_address }}"
                            data-url="{{ $job->url }}"
                        >
                        </div>
                    @endforeach
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
        const currentLayout = '{{ $layout }}' || 'grid';
        const isList = currentLayout === 'list';
        
        if (layoutToggleSidebar) {
            if (isList) {
                layoutToggleSidebar.classList.add('active');
                if (layoutIconSidebar) layoutIconSidebar.className = 'feather-list';
                if (layoutTextSidebar) layoutTextSidebar.textContent = '{{ __('List') }}';
            } else {
                layoutToggleSidebar.classList.remove('active');
                if (layoutIconSidebar) layoutIconSidebar.className = 'feather-grid';
                if (layoutTextSidebar) layoutTextSidebar.textContent = '{{ __('Grid') }}';
            }
        }
    }
    
    updateLayoutButtons();
    
    if (layoutToggleSidebar) {
        layoutToggleSidebar.addEventListener('click', function() {
            const currentLayout = '{{ $layout }}' || 'grid';
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
    // Clear Top Filters Button
    const clearTopFiltersBtn = document.getElementById('clear-top-filters');
    if (clearTopFiltersBtn) {
        clearTopFiltersBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the form
            const form = document.getElementById('jobs-top-filter-form');
            if (!form) return;
            
            // Reset all input fields (except layout)
            const inputs = form.querySelectorAll('input[type="text"], input[type="number"], input[type="search"]');
            inputs.forEach(function(input) {
                if (input.name !== 'layout') {
                    input.value = '';
                }
            });
            
            // Reset all select dropdowns - Clear Bootstrap Select first
            const selects = form.querySelectorAll('select');
            selects.forEach(function(select) {
                const $select = $(select);
                if ($select.hasClass('selectpicker')) {
                    if (select.multiple) {
                        $select.selectpicker('deselectAll');
                    } else {
                        $select.selectpicker('val', '');
                    }
                    $select.selectpicker('refresh');
                } else {
                    // Fallback if selectpicker not initialized
                    if (select.multiple) {
                        Array.from(select.options).forEach(function(option) {
                            option.selected = false;
                        });
                    } else {
                        select.selectedIndex = 0;
                    }
                }
            });
            
            // Reset radius slider
            const radiusSlider = document.getElementById('radius-slider');
            if (radiusSlider) {
                radiusSlider.value = 0;
                const radiusValue = document.getElementById('radius-value');
                if (radiusValue) {
                    radiusValue.textContent = '0';
                }
            }
            
            // Clear Select2 if it exists
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('#jobs-top-filter-form .select2, #jobs-top-filter-form .selectpicker-location').each(function() {
                    const $select = $(this);
                    if ($select.hasClass('select2-hidden-accessible')) {
                        $select.val(null).trigger('change');
                    }
                });
            }
            
            // Also clear sidebar filters
            const sidebarForm = document.getElementById('jobs-filter-form');
            if (sidebarForm) {
                const sidebarInputs = sidebarForm.querySelectorAll('input, select, textarea');
                sidebarInputs.forEach(function(input) {
                    const $input = $(input);
                    if (input.type === 'checkbox') {
                        input.checked = false;
                    } else if (input.type === 'radio') {
                        input.checked = false;
                    } else if (input.type === 'text' || input.type === 'number' || input.type === 'search') {
                        if (input.name !== 'layout' && input.name !== 'per_page' && input.name !== 'page' && input.name !== 'sort_by') {
                            input.value = '';
                        }
                    } else if (input.tagName === 'SELECT') {
                        const $select = $(input);
                        if ($select.hasClass('selectpicker')) {
                            if (input.multiple) {
                                $select.selectpicker('deselectAll');
                            } else {
                                $select.selectpicker('val', '');
                            }
                            $select.selectpicker('refresh');
                        } else if ($select.hasClass('selectpicker-location') || $select.hasClass('select2-hidden-accessible')) {
                            $select.val(null).trigger('change');
                        } else {
                            if (input.multiple) {
                                input.value = [];
                            } else {
                                input.value = '';
                            }
                        }
                    }
                });
            }
            
            // Clear URL parameters and reload
            const baseUrl = '{{ JobBoardHelper::getJobsPageURL() }}';
            window.location.href = baseUrl.split('?')[0];
            
            // Clear URL parameters and reload to initial state (like page start)
            const baseUrl = '{{ JobBoardHelper::getJobsPageURL() }}';
            window.location.href = baseUrl.split('?')[0];
        });
    }
    
    const advanceSearchLink = document.getElementById('toggle-advance-search');
    const advancedFiltersRow = document.getElementById('advanced-filters-row');
    
    if (advanceSearchLink && advancedFiltersRow) {
        const hideText = '<i class="feather-minus"></i> {{ __("Hide Advanced Search") }}';
        const showText = '<i class="feather-plus"></i> {{ __("Advance Search") }}';
        
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
    
    // Handle institution_type to job_categories mapping
    const topFilterForm = document.getElementById('jobs-top-filter-form');
    if (topFilterForm) {
        topFilterForm.addEventListener('submit', function(e) {
            const institutionType = this.querySelector('[name="institution_type"]');
            if (institutionType && institutionType.value) {
                // Convert institution_type to job_categories
                const jobCategories = this.querySelectorAll('[name="job_categories[]"]');
                let found = false;
                jobCategories.forEach(function(cat) {
                    if (cat.value === institutionType.value) {
                        cat.selected = true;
                        found = true;
                    }
                });
                
                // If not found in existing selects, add as hidden input
                if (!found) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'job_categories[]';
                    hiddenInput.value = institutionType.value;
                    this.appendChild(hiddenInput);
                }
            }
        });
    }
});
</script>
