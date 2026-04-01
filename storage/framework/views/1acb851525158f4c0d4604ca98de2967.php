<style>
/* Home City Search Dropdown Styling */
.home-city-search-wrapper {
    position: relative;
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

/* Home Keyword Search Dropdown Styling */
.home-keyword-search-wrapper {
    position: relative;
}

.home-keyword-suggestions {
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

.home-keyword-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #000000 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}

.home-keyword-suggestion-item:last-child {
    border-bottom: none !important;
}

.home-keyword-suggestion-item:hover,
.home-keyword-suggestion-item.active {
    background: #f0f7ff !important;
    color: #000000 !important;
}

.home-keyword-suggestion-item .keyword-name {
    font-weight: 500 !important;
    color: #000000 !important;
    margin-bottom: 2px !important;
}

.home-keyword-suggestion-item:hover .keyword-name,
.home-keyword-suggestion-item.active .keyword-name {
    color: #000000 !important;
}

.home-keyword-loading,
.home-keyword-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #ffffff !important;
}

/* Ensure dropdown appears above other elements */
.twm-bnr-search-bar {
    position: relative;
    z-index: 1;
}

.home-city-search-wrapper {
    z-index: 1001;
}

.home-keyword-search-wrapper {
    z-index: 1001;
}

/* Remove outline from location input field */
.home-city-search-input,
.home-city-search-input:focus,
.home-city-search-input:active,
.home-city-search-input:focus-visible,
.home-city-search-input:hover {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

.wt-search-bar-select.home-city-search-input,
.wt-search-bar-select.home-city-search-input:focus,
.wt-search-bar-select.home-city-search-input:active,
.wt-search-bar-select.home-city-search-input:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

/* Remove outline from keyword input field */
.home-keyword-search-input,
.home-keyword-search-input:focus,
.home-keyword-search-input:active,
.home-keyword-search-input:focus-visible,
.home-keyword-search-input:hover {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

.wt-search-bar-select.home-keyword-search-input,
.wt-search-bar-select.home-keyword-search-input:focus,
.wt-search-bar-select.home-keyword-search-input:active,
.wt-search-bar-select.home-keyword-search-input:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

/* Select2 Dropdown Styling for Keyword Search - White Background, Black Text */
.select2-container--default .select2-selection--single {
    color: #000000 !important;
    background: #ffffff !important;
    border: none !important;
    height: auto !important;
    min-height: 34px !important;
    line-height: 34px !important;
    padding: 0 12px !important;
    box-shadow: none !important;
}

/* Remove border when placeholder is shown */
.select2-container--default .select2-selection--single[aria-expanded="false"] {
    border: none !important;
    box-shadow: none !important;
}

.select2-container--default.selectpicker-keyword .select2-selection--single {
    border: none !important;
    box-shadow: none !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #000000 !important;
    line-height: 34px !important;
    padding-left: 0 !important;
    padding-right: 20px !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #94a3b8 !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 34px !important;
    right: 8px !important;
}

.select2-container--default.select2-container--open .select2-selection--single {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Specific styling for keyword select container */
#home_keyword_search.selectpicker-keyword + .select2-container {
    width: 100% !important;
}

#home_keyword_search.selectpicker-keyword + .select2-container .select2-selection--single {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
}

#home_keyword_search.selectpicker-keyword + .select2-container.select2-container--default .select2-selection--single {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    padding: 8px 12px !important;
    color: #000000 !important;
    background: #ffffff !important;
}

.select2-container--default .select2-search--dropdown .select2-search__field::placeholder {
    color: #94a3b8 !important;
    opacity: 1 !important;
}

.select2-container--default .select2-search--dropdown .select2-search__field:focus {
    outline: none !important;
    border-color: rgba(0, 0, 0, 0.2) !important;
}

.select2-container--default .select2-results__option {
    color: #000000 !important;
    background: #ffffff !important;
    padding: 12px 16px !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.select2-container--default .select2-results__option:last-child {
    border-bottom: none !important;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background: #f0f7ff !important;
    color: #000000 !important;
}

.select2-container--default .select2-results__option[aria-selected=true] {
    background: #f0f7ff !important;
    color: #000000 !important;
}

.select2-dropdown {
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    background: #ffffff !important;
}

.select2-container {
    width: 100% !important;
}

/* Bootstrap Select Dropdown Styling - White Background, Black Text (for other selects) */
.wt-search-bar-select.selectpicker-keyword,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select,
.bootstrap-select.selectpicker-keyword {
    width: 100% !important;
}

/* Remove all outlines from selectpicker */
.wt-search-bar-select.selectpicker-keyword,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select *,
.bootstrap-select.selectpicker-keyword * {
    outline: none !important;
}

.wt-search-bar-select.selectpicker-keyword:focus,
.wt-search-bar-select.selectpicker-keyword:active,
.wt-search-bar-select.selectpicker-keyword:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

/* Dropdown Button/Input */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle,
.bootstrap-select.selectpicker-keyword .dropdown-toggle {
    background: #ffffff !important;
    color: #000000 !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    padding: 8px 12px !important;
    font-size: 14px !important;
    height: auto !important;
    min-height: 34px !important;
    outline: none !important;
    box-shadow: none !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:focus,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:focus,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:active,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:active,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:focus-visible,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:focus-visible {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    box-shadow: none !important;
    outline: none !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:hover,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:hover {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Selected Text */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option,
.bootstrap-select.selectpicker-keyword .filter-option {
    color: #000000 !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option-inner,
.bootstrap-select.selectpicker-keyword .filter-option-inner {
    color: #000000 !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option-inner-inner,
.bootstrap-select.selectpicker-keyword .filter-option-inner-inner {
    color: #000000 !important;
}

/* Dropdown Menu (List) */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu,
.bootstrap-select.selectpicker-keyword .dropdown-menu,
.bootstrap-select.selectpicker-keyword.show .dropdown-menu {
    background: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    padding: 4px 0 !important;
    margin-top: 4px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
}

/* Dropdown Menu Items */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item,
.bootstrap-select.selectpicker-keyword .dropdown-menu li a {
    background: #ffffff !important;
    color: #000000 !important;
    padding: 12px 16px !important;
    font-size: 14px !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item:last-child,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item:last-child,
.bootstrap-select.selectpicker-keyword .dropdown-menu li:last-child a {
    border-bottom: none !important;
}

/* Hover State */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item:hover,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item:hover,
.bootstrap-select.selectpicker-keyword .dropdown-menu li a:hover,
.bootstrap-select.selectpicker-keyword .dropdown-menu li:hover a {
    background: #f0f7ff !important;
    color: #000000 !important;
}

/* Active/Selected State */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item.active,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item.active,
.bootstrap-select.selectpicker-keyword .dropdown-menu .selected a,
.bootstrap-select.selectpicker-keyword .dropdown-menu li.selected a {
    background: #f0f7ff !important;
    color: #000000 !important;
}

/* Placeholder Text */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option-inner-inner:empty::before,
.bootstrap-select.selectpicker-keyword .filter-option-inner-inner:empty::before {
    content: "Type to search..." !important;
    color: #94a3b8 !important;
}

/* Dropdown Arrow */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle::after,
.bootstrap-select.selectpicker-keyword .dropdown-toggle::after {
    color: #000000 !important;
    border-top-color: #000000 !important;
}

/* Search Input Inside Dropdown (if present) */
.bootstrap-select.selectpicker-keyword .bs-searchbox input,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .bs-searchbox input {
    background: #ffffff !important;
    color: #000000 !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    padding: 8px 12px !important;
}

.bootstrap-select.selectpicker-keyword .bs-searchbox input:focus,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .bs-searchbox input:focus {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: rgba(0, 0, 0, 0.2) !important;
    outline: none !important;
}
</style>

<div class="twm-bnr-search-bar">
    <?php echo Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET']); ?>

        <div class="row">
            <div class="form-group col-xl-4 col-lg-5 col-md-6">
                <label><?php echo e(__('Keyword')); ?></label>
                <div class="home-keyword-search-wrapper" style="position: relative;">
                    <input
                        type="text"
                        name="keyword"
                        id="home_job_title_search"
                        class="wt-search-bar-select home-keyword-search-input"
                        placeholder="<?php echo e(__('Type job title...')); ?>"
                        autocomplete="off"
                        value="<?php echo e(request('keyword', '')); ?>"
                    />
                    <div class="home-keyword-suggestions" id="home-keyword-suggestions" style="display: none;"></div>
                </div>
            </div>

            <?php if(is_plugin_active('location')): ?>
                <div class="form-group col-xl-4 col-lg-5 col-md-6">
                    <label><?php echo e(__('Location')); ?></label>
                    <div class="home-city-search-wrapper" style="position: relative;">
                        <input type="text" name="state_search" id="home_state_search" class="wt-search-bar-select home-city-search-input" placeholder="<?php echo e(__('Select State')); ?>" autocomplete="off" value="<?php echo e(request('state_search', '')); ?>" />
                        <input type="hidden" name="state_id" id="home_state_id" value="<?php echo e(request('state_id', '')); ?>" />
                        <div class="home-city-suggestions" id="home-state-suggestions" style="display: none;"></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group col-xl-4 col-lg-2 col-md-12">
                <button type="submit" class="site-button" style="border-radius: 10px;"><?php echo e(__('Find Job')); ?></button>
            </div>
        </div>
    <?php echo Form::close(); ?>

</div>

<script>
    (function () {
        function ajaxGet(url, params) {
            const q = new URLSearchParams(params || {}).toString();
            return fetch(url + (q ? ('?' + q) : ''), {
                method: 'GET',
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin',
            }).then(r => r.json());
        }

        function initJobTitleAutocomplete() {
            const input = document.getElementById('home_job_title_search');
            const box = document.getElementById('home-keyword-suggestions');
            if (!input || !box) return;

            let t = null;
            let active = -1;
            let lastItems = [];

            function render(items) {
                lastItems = items || [];
                active = -1;
                if (!lastItems.length) {
                    box.innerHTML = '<div class="home-keyword-no-results"><?php echo e(__('No results found')); ?></div>';
                    box.style.display = 'block';
                    return;
                }
                box.innerHTML = lastItems.map((it) => (
                    '<div class="home-keyword-suggestion-item" data-title="' + (it.title || '') + '">' +
                        '<div class="keyword-name">' + (it.title || '') + '</div>' +
                    '</div>'
                )).join('');
                box.style.display = 'block';
            }

            function search() {
                const k = (input.value || '').trim();
                if (t) clearTimeout(t);
                if (k.length && k.length < 2) {
                    box.style.display = 'none';
                    box.innerHTML = '';
                    return;
                }
                box.innerHTML = '<div class="home-keyword-loading"><?php echo e(__('Searching...')); ?></div>';
                box.style.display = 'block';
                t = setTimeout(function () {
                    ajaxGet((window.siteUrl || window.location.origin) + '/ajax/search-job-titles', { k })
                        .then((res) => render((res && res.data) ? res.data : []))
                        .catch(() => {
                            box.innerHTML = '<div class="home-keyword-no-results"><?php echo e(__('Error searching')); ?></div>';
                            box.style.display = 'block';
                        });
                }, 250);
            }

            input.addEventListener('input', search);
            input.addEventListener('focus', search);

            input.addEventListener('keydown', function (e) {
                const items = box.querySelectorAll('.home-keyword-suggestion-item');
                if (box.style.display === 'none' || !items.length) return;
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    active = Math.min(active + 1, items.length - 1);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    active = Math.max(active - 1, 0);
                } else if (e.key === 'Enter') {
                    if (active >= 0) {
                        e.preventDefault();
                        items[active].click();
                    }
                    return;
                } else if (e.key === 'Escape') {
                    box.style.display = 'none';
                    return;
                } else {
                    return;
                }
                items.forEach((el) => el.classList.remove('active'));
                if (items[active]) items[active].classList.add('active');
            });

            document.addEventListener('click', function (e) {
                const target = e.target;
                if (!(target instanceof Element)) return;
                if (!target.closest('.home-keyword-search-wrapper')) {
                    box.style.display = 'none';
                }
            });

            box.addEventListener('click', function (e) {
                const target = e.target;
                if (!(target instanceof Element)) return;
                const item = target.closest('.home-keyword-suggestion-item');
                if (!item) return;
                const title = item.getAttribute('data-title') || '';
                input.value = title;
                box.style.display = 'none';
            });
        }

        function initStateAutocomplete() {
            const input = document.getElementById('home_state_search');
            const hidden = document.getElementById('home_state_id');
            const box = document.getElementById('home-state-suggestions');
            if (!input || !hidden || !box) return;

            let t = null;
            let active = -1;

            function render(items) {
                active = -1;
                if (!items || !items.length) {
                    box.innerHTML = '<div class="home-city-no-results"><?php echo e(__('No results found')); ?></div>';
                    box.style.display = 'block';
                    return;
                }

                box.innerHTML = items.map((st) => {
                    const loc = st.country_name ? ('<div class="city-location">' + st.country_name + '</div>') : '';
                    return '<div class="home-city-suggestion-item" data-id="' + st.id + '" data-name="' + (st.name || '') + '">' +
                        '<div class="city-name">' + (st.name || '') + '</div>' + loc +
                    '</div>';
                }).join('');
                box.style.display = 'block';
            }

            function search() {
                const k = (input.value || '').trim();
                hidden.value = '';
                if (t) clearTimeout(t);
                if (k.length < 2) {
                    box.style.display = 'none';
                    box.innerHTML = '';
                    return;
                }

                box.innerHTML = '<div class="home-city-loading"><?php echo e(__('Searching...')); ?></div>';
                box.style.display = 'block';
                t = setTimeout(function () {
                    ajaxGet((window.siteUrl || window.location.origin) + '/ajax/search-states', { k })
                        .then((res) => render((res && res.data) ? res.data : []))
                        .catch(() => {
                            box.innerHTML = '<div class="home-city-no-results"><?php echo e(__('Error searching')); ?></div>';
                            box.style.display = 'block';
                        });
                }, 250);
            }

            input.addEventListener('input', search);
            input.addEventListener('focus', search);

            input.addEventListener('keydown', function (e) {
                const items = box.querySelectorAll('.home-city-suggestion-item');
                if (box.style.display === 'none' || !items.length) return;
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    active = Math.min(active + 1, items.length - 1);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    active = Math.max(active - 1, 0);
                } else if (e.key === 'Enter') {
                    if (active >= 0) {
                        e.preventDefault();
                        items[active].click();
                    }
                    return;
                } else if (e.key === 'Escape') {
                    box.style.display = 'none';
                    return;
                } else {
                    return;
                }
                items.forEach((el) => el.classList.remove('active'));
                if (items[active]) items[active].classList.add('active');
            });

            document.addEventListener('click', function (e) {
                const target = e.target;
                if (!(target instanceof Element)) return;
                if (!target.closest('.home-city-search-wrapper')) {
                    box.style.display = 'none';
                }
            });

            box.addEventListener('click', function (e) {
                const target = e.target;
                if (!(target instanceof Element)) return;
                const item = target.closest('.home-city-suggestion-item');
                if (!item) return;
                input.value = item.getAttribute('data-name') || '';
                hidden.value = item.getAttribute('data-id') || '';
                box.style.display = 'none';
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () {
                initJobTitleAutocomplete();
                initStateAutocomplete();
            });
        } else {
            initJobTitleAutocomplete();
            initStateAutocomplete();
        }
    })();
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/search-bar/form.blade.php ENDPATH**/ ?>