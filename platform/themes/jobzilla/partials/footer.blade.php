</div>
@php
    $hideFooterOnRoutes = ['public.account.login', 'public.account.register'];
    $shouldHideFooter = in_array(\Illuminate\Support\Facades\Route::currentRouteName(), $hideFooterOnRoutes, true);
@endphp

@unless ($shouldHideFooter)
    <!-- FOOTER START (screenshot style: dark, 5 columns, partners, bottom bar) -->
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
                                <li><a href="/companies">Companies</a></li>
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
                                <li><a href="/faq">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 4: Resources -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Resources</h4>
                            <ul class="footer-links">
                                <li><a href="/privacy-policy">Privacy</a></li>
                                <li><a href="/terms-conditions">Terms & Refund</a></li>
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
                                    <li><a href="https://www.linkedin.com/company/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
                                    <li><a href="https://www.instagram.com/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-instagram"></i> Instagram</a></li>
                                    <li><a href="https://www.google.com/search?q=teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-google"></i> Google</a></li>
                                    <li><a href="https://www.facebook.com/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                    <li><a href="https://www.youtube.com/@teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-youtube"></i> YouTube</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Partners -->
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

            <!-- Section 3: Bottom – Copyright + Legal -->
            <div class="footer-bottom">
                <div class="footer-bottom-inner">
                    <div class="footer-copy-right">
                        {!! Theme::getSiteCopyright() ?: 'Copyright ©' . date('Y') . ' All rights reserved | This template is made with ❤️ by <a href="https://teachersrecruiter.in" class="footer-accent">TeachersRecruiter™</a>' !!}
                    </div>
                    <div class="footer-legal">
                        <a href="/terms-conditions">Terms</a>
                        <a href="/privacy-policy">Privacy</a>
                        <a href="/fraud-alert">Compliances</a>
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

<!-- </div>
   
    <footer class="footer-dark"
        @if (theme_option('footer_background')) style="background-image: url({{ RvMedia::getImageUrl(theme_option('footer_background')) }});"
        @else
            style="background-image: url({{ Theme::asset()->url('/images/f-bg.jpg') }});" @endif>
        <div class="container">

            <div class="ftr-nw-content">
                {!! dynamic_sidebar('pre_footer_sidebar') !!}
            </div>

           
            <div class="footer-top">
                <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1">
                    {!! dynamic_sidebar('footer_sidebar') !!}
                </div>
            </div>
           
            <div class="footer-bottom">
                <div class="footer-bottom-info">
                    <div class="footer-copy-right">
                        <span class="copyrights-text">{!! Theme::getSiteCopyright() !!}</span>
                    </div>
                    @if ($socialLinks = Theme::getSocialLinks())
                        <ul class="social-icons">
                            @foreach ($socialLinks as $socialLink)
@continue(!$socialLink->getUrl() || !$socialLink->getIconHtml())

                                <a {!! $socialLink->getAttributes(['class' => 'text-white ms-2 me-2']) !!}>{{ $socialLink->getIconHtml() }}</a>
@endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </footer>
   

    @if (is_plugin_active('job-board'))
@include(Theme::getThemeNamespace('views.job-board.partials.apply-modal'))
        <script id="traffic-popup-map-template" type="text/x-jquery-tmpl">
            @include(Theme::getThemeNamespace('views.job-board.partials.map'))
        </script>
@endif

    {!! Theme::footer() !!}

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
</html> -->
