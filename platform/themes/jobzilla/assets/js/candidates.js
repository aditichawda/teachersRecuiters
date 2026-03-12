(function ($) {
    const candidates = $('.candidates-main-section');
    
    // Blue Loader System (same as jobs and companies page)
    const $candidatesContainer = candidates;
    const $candidatesList = $('#candidates-content');
    let $candidatesLoader = $('#candidates-loader-overlay');

    // Create loader if it doesn't exist
    if (!$candidatesLoader.length && $candidatesList.length) {
        const loaderHtml = '<div class="blue-loader-overlay" id="candidates-loader-overlay" style="display: none !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading candidates...</p></div></div>';
        $candidatesList.before(loaderHtml);
        $candidatesLoader = $('#candidates-loader-overlay');
    }

    function showCandidatesLoader() {
        if ($candidatesLoader.length) {
            $candidatesLoader.attr('style', 'display: flex !important; visibility: visible !important; opacity: 1 !important; z-index: 100 !important;').addClass('show');
        } else {
            // Create loader if it doesn't exist
            const loaderHtml = '<div class="blue-loader-overlay" id="candidates-loader-overlay" style="display: flex !important; visibility: visible !important; opacity: 1 !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading candidates...</p></div></div>';
            $candidatesList.before(loaderHtml);
            $candidatesLoader = $('#candidates-loader-overlay');
        }
    }

    function hideCandidatesLoader() {
        if ($candidatesLoader.length) {
            setTimeout(() => {
                $candidatesLoader.css({
                    'display': 'none',
                    'visibility': 'hidden',
                    'opacity': '0'
                }).removeClass('show');
            }, 300);
        }
    }

    // Handle filter form submission
    candidates.on('submit', '#candidates-filter-form', function (e) {
        e.preventDefault();
        
        // Show loader IMMEDIATELY when button is clicked
        showCandidatesLoader();
        
        const form = $(this);
        const formData = form.serialize();
        const action = form.attr('action');
        const currentUrl = location.origin + location.pathname;

        // Update URL
        window.history.pushState({}, '', `${currentUrl}?${formData}`);

        // Make AJAX request
        $.ajax({
            url: action,
            method: 'GET',
            data: formData,
            beforeSend: () => {
                // Ensure loader is visible
                showCandidatesLoader();
            },
            success: (response) => {
                // If response is HTML (full page), extract candidates content
                if (typeof response === 'string') {
                    const $response = $(response);
                    const candidatesContent = $response.find('#candidates-content').html() || $response.find('.candidates-listing-modern').html();
                    if (candidatesContent) {
                        $('#candidates-content').html(candidatesContent);
                    }
                } else if (response.data) {
                    // If response is JSON with data
                    $('#candidates-content').html(response.data);
                }
                
                // Re-add loader component if not present after HTML update
                if (!$candidatesList.find('#candidates-loader-overlay').length) {
                    const loaderHtml = '<div class="blue-loader-overlay" id="candidates-loader-overlay" style="display: none !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading candidates...</p></div></div>';
                    $candidatesList.before(loaderHtml);
                }
                $candidatesLoader = $('#candidates-loader-overlay');
            },
            error: () => {
                hideCandidatesLoader();
            },
            complete: () => {
                hideCandidatesLoader();
            }
        });
        
        // Close mobile filter on submit
        $('.candidates-sidebar-modern .side-bar-filter').removeClass('active');
        $('body').removeClass('filter-open');
    });

    // Handle individual filter changes (auto-submit)
    candidates.on('change', '#candidates-filter-form input, #candidates-filter-form select', function() {
        // Skip if it's a selectpicker - those are handled by form submit
        if ($(this).hasClass('selectpicker')) {
            return;
        }
        
        // Show loader IMMEDIATELY when filter changes
        showCandidatesLoader();
        
        // Submit form
        $('#candidates-filter-form').trigger('submit');
    });

    // Handle selectpicker changes
    candidates.on('changed.bs.select', '#candidates-filter-form select.selectpicker', function() {
        // Show loader IMMEDIATELY when selectpicker changes
        showCandidatesLoader();
        
        // Submit form
        $('#candidates-filter-form').trigger('submit');
    });

    // Handle pagination clicks
    candidates.on('click', '.pagination a, a.pagination-button', function (e) {
        e.preventDefault();
        
        // Show loader IMMEDIATELY when pagination is clicked
        showCandidatesLoader();
        
        const url = $(this).attr('href');
        if (url) {
            window.location.href = url;
        }
    });

    // Mobile filter toggle
    candidates.on('click', '.btn-open-filter', function (e) {
        e.preventDefault();
        $('.candidates-sidebar-modern .side-bar-filter').addClass('active');
        $('body').addClass('filter-open');
    });

    candidates.on('click', '.btn-close-filter, .candidates-sidebar-modern .backdrop', function (e) {
        e.preventDefault();
        $('.candidates-sidebar-modern .side-bar-filter').removeClass('active');
        $('body').removeClass('filter-open');
    });
})(jQuery);
