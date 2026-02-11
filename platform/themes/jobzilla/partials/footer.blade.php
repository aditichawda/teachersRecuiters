</div>
@php
    $hideFooterOnRoutes = ['public.account.login', 'public.account.register'];
    $shouldHideFooter = in_array(\Illuminate\Support\Facades\Route::currentRouteName(), $hideFooterOnRoutes, true);
@endphp

@unless ($shouldHideFooter)
    <!-- FOOTER STYLES -->
    <style>
        .footer-screenshot-style {
            background-color: #1a1d21;
            color: #c5c9d1;
            padding-top: 60px;
        }
        .footer-screenshot-style .footer-top {
            padding-bottom: 40px;
        }
        .footer-screenshot-style .footer-widget {
            margin-bottom: 20px;
        }
        .footer-screenshot-style .footer-title {
            color: #ffffff !important;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .footer-screenshot-style h3.footer-title {
            font-size: 22px;
        }
        .footer-screenshot-style .footer-desc {
            color: #9ca3af !important;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 12px;
        }
        .footer-screenshot-style .footer-read-more {
            color: var(--primary-color, #1967d2) !important;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer-screenshot-style .footer-read-more:hover {
            color: #ffffff !important;
        }
        .footer-screenshot-style .footer-links {
            list-style: none !important;
            padding: 0;
            margin: 0;
        }
        .footer-screenshot-style .footer-links li {
            margin-bottom: 12px;
            list-style: none !important;
        }
        .footer-screenshot-style .footer-links li::before {
            display: none !important;
        }
        .footer-screenshot-style .footer-links li a {
            color: #9ca3af !important;
            font-size: 14px;
            text-decoration: none !important;
            transition: color 0.3s, padding-left 0.3s;
        }
        .footer-screenshot-style .footer-links li a:hover {
            color: #ffffff !important;
            padding-left: 5px;
        }
        .footer-screenshot-style .footer-social-links li a i,
        .footer-screenshot-style .footer-social-links li a svg {
            margin-right: 8px;
            width: 16px;
            text-align: center;
            color: #9ca3af;
            transition: color 0.3s;
        }
        .footer-screenshot-style .footer-social-links li a:hover i,
        .footer-screenshot-style .footer-social-links li a:hover svg {
            color: #ffffff;
        }
        .footer-screenshot-style .footer-partners-inner {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .footer-screenshot-style .footer-partners-label {
            color: #ffffff !important;
            font-weight: 600;
            font-size: 15px;
        }
        .footer-screenshot-style .footer-partners-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .footer-screenshot-style .footer-partner-item {
            background: rgba(255,255,255,0.08);
            color: #c5c9d1 !important;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            text-decoration: none !important;
            transition: background 0.3s, color 0.3s;
        }
        .footer-screenshot-style .footer-partner-item:hover {
            background: var(--primary-color, #1967d2);
            color: #ffffff !important;
        }
        .footer-screenshot-style .footer-see-all {
            color: var(--primary-color, #1967d2) !important;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none !important;
            margin-left: auto;
            transition: color 0.3s;
        }
        .footer-screenshot-style .footer-see-all:hover {
            color: #ffffff !important;
        }
        .footer-screenshot-style .footer-bottom {
            padding: 20px 0;
        }
        .footer-screenshot-style .footer-bottom-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .footer-screenshot-style .footer-copy-right {
            color: #7a7f8a !important;
            font-size: 13px;
        }
        .footer-screenshot-style .footer-copy-right a {
            color: #9ca3af !important;
            text-decoration: none;
        }
        .footer-screenshot-style .footer-copy-right a:hover {
            color: #ffffff !important;
        }
        .footer-screenshot-style .footer-legal {
            display: flex;
            gap: 20px;
        }
        .footer-screenshot-style .footer-legal a {
            color: #7a7f8a !important;
            font-size: 13px;
            text-decoration: none !important;
            transition: color 0.3s;
        }
        .footer-screenshot-style .footer-legal a:hover {
            color: #ffffff !important;
        }
        @media (max-width: 767px) {
            .footer-screenshot-style .footer-bottom-inner {
                flex-direction: column;
                text-align: center;
            }
            .footer-screenshot-style .footer-partners-inner {
                flex-direction: column;
                text-align: center;
            }
            .footer-screenshot-style .footer-see-all {
                margin-left: 0;
            }
        }
    </style>

    <!-- FOOTER START -->
    <footer class="footer-dark footer-screenshot-style"
        @if (theme_option('footer_background')) style="background-image: url({{ RvMedia::getImageUrl(theme_option('footer_background')) }});"
        @else style="background-color: #1a1d21;" @endif>
        <div class="container">
            <!-- Section 1: Top – 5 columns -->
            <div class="footer-top">
                <div class="row g-4">
                    <!-- Col 1: Brand -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h3 class="footer-title">TeachersRecruiter™</h3>
                            <p class="footer-desc">
                                Connecting educators and schools across India since 2015. With thousands of teacher
                                placements and a dedicated education job portal, we make hiring and job searching simple,
                                fast, and reliable.
                            </p>
                            <a href="/about-us" class="footer-read-more">read more →</a>
                        </div>
                    </div>
                    <!-- Col 2: Discover -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Discover</h4>
                            <ul class="footer-links">
                                <li><a href="/">Home</a></li>
                                <li><a href="/jobs">Jobs</a></li>
                                <li><a href="/companies">Institutes</a></li>
                                <li><a href="/candidates">Candidates</a></li>
                                <li><a href="/contact">Help & Support</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 3: About -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">About</h4>
                            <ul class="footer-links">
                                <li><a href="/about-us">About Us</a></li>
                                <li><a href="/contact">Contact Us</a></li>
                                <li><a href="/how-it-works">How it works</a></li>
                                <li><a href="/blogs">Blog</a></li>
                                <li><a href="/faq">FAQ's</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 4: Resources -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Resources</h4>
                            <ul class="footer-links">
                                <li><a href="/privacy-policy">Privacy Policy</a></li>
                                <li><a href="/terms-conditions">Terms & Conditions</a></li>
                                <li><a href="/fraud-alert">Fraud Alert</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 5: Social -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Social</h4>
                            @php($socialLinks = Theme::getSocialLinks())
                            @if ($socialLinks)
                                <ul class="footer-links footer-social-links">
                                    @foreach ($socialLinks as $socialLink)
                                        @continue(!$socialLink->getUrl() || !$socialLink->getIconHtml())
                                        <li>
                                            <a href="{{ $socialLink->getUrl() }}" target="_blank" rel="noopener">{!! $socialLink->getIconHtml() !!} {{ $socialLink->getName() }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="footer-links footer-social-links">
                                    <li><a href="https://www.facebook.com/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                    <li><a href="https://www.google.com/search?q=teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-google"></i> Google</a></li>
                                    <li><a href="https://www.youtube.com/@teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-youtube"></i> YouTube</a></li>
                                    <li><a href="https://www.instagram.com/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-instagram"></i> Instagram</a></li>
                                    <li><a href="https://www.linkedin.com/company/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="footer-partners">
                <div class="footer-partners-inner">
                    <span class="footer-partners-label">Our Partner:</span>
                    <div class="footer-partners-list">
                        <a href="/companies" class="footer-partner-item">Featured Institutions</a>
                        <a href="/jobs" class="footer-partner-item">Jobs</a>
                        <a href="/about-us" class="footer-partner-item">About</a>
                    </div>
                    <a href="/companies" class="footer-see-all">See All →</a>
                </div>
            </div>
            </div>

            <!-- Section 2: Partners -->
            

            <!-- Section 3: Bottom – Copyright + Legal -->
            <div class="footer-bottom">
                <div class="footer-bottom-inner">
                    <div class="footer-copy-right">
                        {!! Theme::getSiteCopyright() ?: 'Teachers Recruiter &copy; ' . date('Y') . '. All Right Reserved.' !!}
                    </div>
                    <!-- <div class="footer-legal">
                        <a href="/terms-conditions">Terms</a>
                        <a href="/privacy-policy">Privacy</a>
                        <a href="/fraud-alert">Fraud Alert</a> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="whatsapp-float"
        style="position: fixed; width: 60px; height: 60px; bottom: 20px; right: 20px; background-color: #25D366; color: #FFF; border-radius: 50px; text-align: center; font-size: 30px; box-shadow: 2px 2px 10px rgba(0,0,0,0.3); z-index: 1000; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.3s;">
        <i class="fab fa-whatsapp" style="color: #fff;"></i>
    </a>
    <style>
        .whatsapp-float:hover {
            transform: scale(1.1);
        }
    </style>
@endunless

@if (is_plugin_active('job-board'))
    @include(Theme::getThemeNamespace('views.job-board.partials.apply-modal'))
    <script id="traffic-popup-map-template" type="text/x-jquery-tmpl">
            @include(Theme::getThemeNamespace('views.job-board.partials.map'))
        </script>
@endif

{!! Theme::footer() !!}

{{-- Fix Testimonials Equal Height --}}
<script>
(function() {
    function equalizeTestimonialHeights() {
        var $carousel = jQuery('.twm-testimonial-2-carousel');
        if ($carousel.length && $carousel.data('owl.carousel')) {
            var $items = $carousel.find('.owl-item:not(.cloned)');
            if ($items.length === 0) return;
            
            var maxHeight = 0;
            
            // Reset heights first
            $items.each(function() {
                var $item = jQuery(this);
                $item.css('height', 'auto');
                var $testimonial = $item.find('.twm-testimonial-2');
                if ($testimonial.length) {
                    $testimonial.css('height', 'auto');
                }
            });
            
            // Find max height
            $items.each(function() {
                var height = jQuery(this).outerHeight(true);
                if (height > maxHeight) {
                    maxHeight = height;
                }
            });
            
            // Apply max height to all items
            if (maxHeight > 0) {
                $items.each(function() {
                    var $item = jQuery(this);
                    $item.css('height', maxHeight + 'px');
                    var $testimonial = $item.find('.twm-testimonial-2');
                    if ($testimonial.length) {
                        $testimonial.css('height', '100%');
                    }
                });
            }
        }
    }
    
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function() {
            // Hook into owl carousel initialization
            var originalOwlCarousel = jQuery.fn.owlCarousel;
            jQuery.fn.owlCarousel = function(options) {
                var result = originalOwlCarousel.apply(this, arguments);
                
                if (this.hasClass('twm-testimonial-2-carousel')) {
                    this.on('initialized.owl.carousel', function() {
                        setTimeout(equalizeTestimonialHeights, 50);
                    });
                    
                    this.on('refreshed.owl.carousel changed.owl.carousel', function() {
                        setTimeout(equalizeTestimonialHeights, 50);
                    });
                    
                    // Initial equalization
                    setTimeout(equalizeTestimonialHeights, 200);
                }
                
                return result;
            };
            
            // Also run for already initialized carousels
            setTimeout(function() {
                var $carousel = jQuery('.twm-testimonial-2-carousel');
                if ($carousel.length && $carousel.data('owl.carousel')) {
                    $carousel.on('initialized.owl.carousel refreshed.owl.carousel changed.owl.carousel', function() {
                        setTimeout(equalizeTestimonialHeights, 50);
                    });
                    equalizeTestimonialHeights();
                }
            }, 300);
        });
        
        // Also run after window load
        jQuery(window).on('load', function() {
            setTimeout(equalizeTestimonialHeights, 500);
        });
        
        // Run on window resize
        var resizeTimer;
        jQuery(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(equalizeTestimonialHeights, 250);
        });
    }
})();
</script>

{{-- Hide Newsletter Popup Completely --}}
<style>
    #newsletter-popup,
    .newsletter-popup,
    .modal.newsletter-popup,
    .modal#newsletter-popup {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
        position: absolute !important;
        left: -9999px !important;
    }
</style>
<script>
    (function() {
        // Remove newsletter popup immediately
        function removeNewsletterPopup() {
            var popup = document.getElementById('newsletter-popup');
            if (popup) {
                popup.remove();
            }
            var modals = document.querySelectorAll('.newsletter-popup, .modal.newsletter-popup, .modal#newsletter-popup');
            modals.forEach(function(modal) {
                modal.remove();
            });
        }
        
        // Remove on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', removeNewsletterPopup);
        } else {
            removeNewsletterPopup();
        }
        
        // Also remove after a short delay to catch dynamically added elements
        setTimeout(removeNewsletterPopup, 100);
        setTimeout(removeNewsletterPopup, 500);
        setTimeout(removeNewsletterPopup, 1000);
        
        // Prevent jQuery from initializing it
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(function($) {
                removeNewsletterPopup();
                // Override modal show for newsletter popup
                var originalModal = $.fn.modal;
                $.fn.modal = function(options) {
                    if (this.attr('id') === 'newsletter-popup' || this.hasClass('newsletter-popup')) {
                        return this;
                    }
                    return originalModal.apply(this, arguments);
                };
            });
        }
    })();
</script>

@if (session()->has('status') ||
        session()->has('success_msg') ||
        session()->has('error_msg') ||
        (isset($errors) && $errors->count() > 0) ||
        isset($error_msg))
    <script type="text/javascript">
        'use strict';
        window.onload = function() {
            @if (session()->has('success_msg'))
                window.showAlert('text-success', "{!! addslashes(session('success_msg')) !!}");
            @endif
            @if (session()->has('status'))
                window.showAlert('text-success', "{!! addslashes(session('status')) !!}");
            @endif
            @if (session()->has('error_msg'))
                window.showAlert('text-danger', "{!! addslashes(session('error_msg')) !!}");
            @endif
            @if (isset($error_msg))
                window.showAlert('text-danger', "{!! addslashes($error_msg) !!}");
            @endif
            @if (isset($errors))
                @foreach ($errors->all() as $error)
                    window.showAlert('text-danger', "{!! addslashes($error) !!}");
                @endforeach
            @endif
        };
    </script>
@endif
</body>

</html>
