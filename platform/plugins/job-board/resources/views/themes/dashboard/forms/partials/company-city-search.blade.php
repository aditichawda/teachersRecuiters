@if (is_plugin_active('location'))
    <style>
        /* Job Post-like city dropdown UI for company form */
        .jp-suggest-wrap { position: relative; overflow: visible; }
        .jp-suggest-wrap.jp-suggest-open { z-index: 100000; }
        .jp-suggest-list {
            position: absolute; top: calc(100% + 4px); left: 0; right: 0;
            background: #fff; border: 1px solid #e0e0e0; border-radius: 8px;
            max-height: 240px; overflow-y: auto;
            z-index: 99999;
            display: none;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            padding: 6px 0;
            min-height: 44px;
            font-size: 14px;
            line-height: 1.4;
        }
        .jp-suggest-list.show { display: block !important; }
        .jp-suggest-item {
            padding: 10px 14px; cursor: pointer; font-size: 14px;
            border-bottom: 1px solid #f5f5f5;
        }
        .jp-suggest-item:last-child { border-bottom: none; }
        .jp-suggest-item:hover, .jp-suggest-item.active { background: #fff5f5; color: #E32526; }
        .jp-suggest-item .muted { display:block; font-size: 12px; color:#94a3b8; margin-top:2px; }
        /* Hide the old dependent selects UI (we still use them as real form values) */
        .select-location-fields { display: none !important; }
    </style>

    <div class="row mt-2">
        <div class="col-md-4 mb-3">
            <label class="form-label">{{ __('City') }}</label>
            <div class="jp-suggest-wrap company-city-search-wrapper">
                <input
                    type="text"
                    id="company_city_search"
                    class="form-control"
                    placeholder="{{ __('Search city...') }}"
                    autocomplete="off"
                />
                <div class="jp-suggest-list" id="company_city_suggestions"></div>
            </div>
            <small class="text-muted d-block mt-1">{{ __('Start typing (2+ letters). State & Country will auto-fill.') }}</small>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">{{ __('State') }}</label>
            <input type="text" id="company_state_display" class="form-control" placeholder="{{ __('State') }}" readonly style="background:#f5f5f5;">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">{{ __('Country') }}</label>
            <input type="text" id="company_country_display" class="form-control" placeholder="{{ __('Country') }}" readonly style="background:#f5f5f5;">
        </div>
    </div>

    <script>
        (function () {
            function $(id) { return document.getElementById(id); }

            var input = $('company_city_search');
            var list = $('company_city_suggestions');
            if (!input || !list) return;

            var countrySel = document.getElementById('country_id');
            var stateSel = document.getElementById('state_id');
            var citySel = document.getElementById('city_id');

            var stateDisplay = document.getElementById('company_state_display');
            var countryDisplay = document.getElementById('company_country_display');

            var timer = null;

            function openDropdown() {
                list.classList.add('show');
                input.closest('.jp-suggest-wrap') && input.closest('.jp-suggest-wrap').classList.add('jp-suggest-open');
            }
            function closeDropdown() {
                list.classList.remove('show');
                input.closest('.jp-suggest-wrap') && input.closest('.jp-suggest-wrap').classList.remove('jp-suggest-open');
            }

            function clearSelection() {
                if (citySel) citySel.value = '';
                if (stateSel) stateSel.value = '';
                if (countrySel) countrySel.value = '';
                if (stateDisplay) stateDisplay.value = '';
                if (countryDisplay) countryDisplay.value = '';
            }

            function setOption(selectEl, value, label) {
                if (!selectEl || !value) return;
                var v = String(value);
                var opt = selectEl.querySelector('option[value="' + v.replace(/"/g, '\\"') + '"]');
                if (!opt) {
                    opt = document.createElement('option');
                    opt.value = v;
                    opt.textContent = label || v;
                    selectEl.appendChild(opt);
                } else if (label && !opt.textContent) {
                    opt.textContent = label;
                }
                selectEl.value = v;
            }

            function triggerChange(el) {
                if (!el) return;
                try {
                    // If select2 is used
                    if (window.jQuery && window.jQuery.fn && window.jQuery.fn.select2) {
                        window.jQuery(el).trigger('change');
                        return;
                    }
                } catch (e) {}

                el.dispatchEvent(new Event('change', { bubbles: true }));
            }

            function renderItems(cities) {
                if (!cities || !cities.length) {
                    list.innerHTML = '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;">{{ __('No cities found') }}</div>';
                    openDropdown();
                    return;
                }

                var html = '';
                cities.forEach(function (c) {
                    var parts = [];
                    if (c.state_name) parts.push(c.state_name);
                    if (c.country_name) parts.push(c.country_name);
                    html += '<div class="jp-suggest-item company-city-item" ' +
                        'data-city-id="' + (c.id || '') + '" ' +
                        'data-city-name="' + (c.name || '') + '" ' +
                        'data-state-id="' + (c.state_id || '') + '" ' +
                        'data-state-name="' + (c.state_name || '') + '" ' +
                        'data-country-id="' + (c.country_id || '') + '" ' +
                        'data-country-name="' + (c.country_name || '') + '">' +
                        '<div style="font-weight:600;">' + (c.name || '') + '</div>' +
                        (parts.length ? '<span class="muted">' + parts.join(', ') + '</span>' : '') +
                        '</div>';
                });
                list.innerHTML = html;
                openDropdown();
            }

            function fetchCities(keyword) {
                var k = (keyword || '').trim();
                var url = '{{ route("ajax.search-cities") }}' + (k.length >= 2 ? ('?k=' + encodeURIComponent(k)) : '?default_country=1&page=1');
                list.innerHTML = '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;">' + (k.length >= 2 ? '{{ __('Searching...') }}' : '{{ __('Loading...') }}') + '</div>';
                openDropdown();

                fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(function (r) { return r.json(); })
                    .then(function (res) {
                        var raw = res && res.data;
                        var cities = Array.isArray(raw) ? raw : (raw && Array.isArray(raw.cities) ? raw.cities : []);
                        renderItems(cities);
                    })
                    .catch(function () {
                        list.innerHTML = '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;">{{ __('Error loading cities') }}</div>';
                        openDropdown();
                    });
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                var val = this.value;
                clearSelection();
                timer = setTimeout(function () { fetchCities(val); }, 250);
            });

            input.addEventListener('focus', function () {
                var v = (this.value || '').trim();
                fetchCities(v);
            });

            list.addEventListener('mousedown', function (e) {
                var item = e.target.closest('.company-city-item');
                if (!item) return;
                e.preventDefault();

                var cityId = item.getAttribute('data-city-id');
                var cityName = item.getAttribute('data-city-name');
                var stateId = item.getAttribute('data-state-id');
                var stateName = item.getAttribute('data-state-name');
                var countryId = item.getAttribute('data-country-id');
                var countryName = item.getAttribute('data-country-name');

                input.value = cityName || '';
                if (stateDisplay) stateDisplay.value = stateName || '';
                if (countryDisplay) countryDisplay.value = countryName || '';

                // Set selects and trigger dependent loading (location.js listens to change events)
                setOption(countrySel, countryId, countryName);
                triggerChange(countrySel);

                setOption(stateSel, stateId, stateName);
                triggerChange(stateSel);

                setOption(citySel, cityId, cityName);
                triggerChange(citySel);

                closeDropdown();
            });

            document.addEventListener('click', function (e) {
                var wrap = input.closest('.jp-suggest-wrap');
                if (wrap && !wrap.contains(e.target)) closeDropdown();
            });
        })();
    </script>
@endif

