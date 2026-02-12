<?php
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
    border-color: #0073d1;
    box-shadow: 0 0 0 5px rgba(0, 115, 209, 0.1), 0 6px 20px rgba(0, 115, 209, 0.15);
    transform: translateY(-2px);
    background: #ffffff;
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
    padding: 18px 45px;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 6px 20px rgba(0, 115, 209, 0.35), 0 2px 8px rgba(0, 115, 209, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.8px;
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
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 10px 30px rgba(0, 115, 209, 0.45), 0 4px 12px rgba(0, 115, 209, 0.25);
}
.search-btn:active {
    transform: translateY(-1px) scale(0.98);
}

.search-btn:active {
    transform: translateY(0);
}

.search-btn i {
    font-size: 18px;
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
</style>

<div class="section-full p-t120 p-b90 site-bg-white jobs-container">
    <div class="container">
        <div class="jobs-sc-heading">
            <h2><?php echo e(__('Jobs')); ?></h2>
            <p><?php echo e(__('Find the best teaching opportunities across India')); ?></p>
        </div>
        
        <!-- Top Filter Section -->
        <form action="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" method="get" id="jobs-top-filter-form" class="jobs-top-filter">
            <input type="hidden" name="layout" value="<?php echo e($layout); ?>" id="layout-input">
            <div class="filter-row">
                <div class="filter-group">
                    <label>
                        <i class="feather-briefcase"></i>
                        <span><?php echo e(__('Enter Teaching Subject or Post')); ?></span>
                    </label>
                    <input type="text" name="keyword" value="<?php echo e(BaseHelper::stringify(request()->query('keyword'))); ?>" placeholder="<?php echo e(__('Enter Teaching Subject or Post')); ?>">
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-map-pin"></i>
                        <span><?php echo e(__('Enter City or State')); ?></span>
                    </label>
                    <div class="location-input-wrapper">
                        <i class="feather-map-pin"></i>
                        <input type="text" name="location" value="<?php echo e(BaseHelper::stringify(request()->query('location'))); ?>" placeholder="<?php echo e(__('Enter City or State')); ?>">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>
                        <i class="feather-building"></i>
                        <span><?php echo e(__('Select Institution Type')); ?></span>
                    </label>
                    <select name="institution_type" class="selectpicker">
                        <option value=""><?php echo e(__('All Institution Types')); ?></option>
                        <?php $__currentLoopData = $institutionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institutionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($institutionType->id); ?>" <?php if($institutionType->id == request()->query('institution_type')): echo 'selected'; endif; ?>><?php echo e($institutionType->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
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
            
            <div class="filter-actions">
                <a href="#" class="advance-search-link" id="toggle-advance-search">
                    <i class="feather-plus"></i>
                    <?php echo e(__('Advance Search')); ?>

                </a>
                <button type="submit" class="search-btn">
                    <i class="feather-search"></i>
                    <?php echo e(__('Find Job')); ?>

                </button>
            </div>
        </form>
        
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar">
                        <div class="sidebar-elements search-bx">
                            <button class="d-md-none position-absolute btn btn-link btn-close-filter">
                                <i class="feather-x"></i>
                            </button>
                            <div class="sidebar-header-controls" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                                <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e293b;"><?php echo e(__('Filters')); ?></h4>
                            </div>
                            <form action="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" method="get" id="jobs-filter-form" data-ajax-url="<?php echo e(route('public.ajax.jobs')); ?>">
                                <?php echo Theme::partial('jobs.filters.keyword'); ?>


                                <?php echo Theme::partial('jobs.filters.categories'); ?>


                                <?php echo Theme::partial('jobs.filters.city'); ?>


                                <?php echo Theme::partial('jobs.filters.types'); ?>


                                <?php echo Theme::partial('jobs.filters.date_posted'); ?>


                                <?php echo Theme::partial('jobs.filters.experiences'); ?>


                                <?php echo Theme::partial('jobs.filters.skills'); ?>

                            </form>
                        </div>
                    </div>
                </div>

                <?php echo dynamic_sidebar('job_board_sidebar'); ?>

            </div>

            <div class="col-lg-8 col-md-12 position-relative">
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
                    <button type="button" class="layout-toggle-btn-small" id="layout-toggle-sidebar" data-layout="<?php echo e($layout); ?>">
                        <i class="feather-grid" id="layout-icon-sidebar"></i>
                        <span id="layout-text-sidebar"><?php echo e($layout === 'list' ? __('List') : __('Grid')); ?></span>
                    </button>
                </div>

                <div class="loading">
                    <div class="loading__inner">
                        <div class="loading__content">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>

                <div class="twm-jobs-list-wrap jobs-listing" id="jobs-listing-container">
                    <?php echo Theme::partial("jobs.$layout", ['jobs' => $jobs, 'style' => 2]); ?>

                </div>

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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/jobs/index.blade.php ENDPATH**/ ?>