</div>
@php
    $hideFooterOnRoutes = ['public.account.login', 'public.account.register'];
    $shouldHideFooter = in_array(\Illuminate\Support\Facades\Route::currentRouteName(), $hideFooterOnRoutes, true);
@endphp

@unless ($shouldHideFooter)
    <!-- FOOTER START -->
    <footer class="footer-dark"
        @if (theme_option('footer_background')) style="background-image: url({{ RvMedia::getImageUrl(theme_option('footer_background')) }});"
        @else
            style="background-image: url({{ Theme::asset()->url('/images/f-bg.jpg') }});" @endif>
        <div class="container">
            <!-- FOOTER BLOCKES START -->
            <div class="footer-top">
                <div class="row">
                    <!-- Left Section: Company Information -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="footer-widget">
                            <h3 class="footer-title"
                                style="font-size: 24px; font-weight: bold; margin-bottom: 15px; color: #fff;">
                                TeachersRecruiter™</h3>
                            <p style="color: #ccc; line-height: 1.8; margin-bottom: 0;">
                                Connecting educators and schools across India since 2015. With thousands of teacher
                                placements and a dedicated education job portal, we make hiring and job searching simple,
                                fast, and reliable – empowering schools with talent and teachers with opportunities.
                            </p>
                        </div>
                    </div>

                    <!-- Middle Section: Important Links -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="footer-widget">
                            <h4 class="footer-title"
                                style="color: #fff; margin-bottom: 20px; border-bottom: 2px solid #1967d2; padding-bottom: 10px; display: inline-block;">
                                Important Links</h4>
                            <ul class="footer-links" style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 10px;">
                                    <a href="/home"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">Home</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="/about-us"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">About Us</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="/contact"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">Contact Us</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="/jobs"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">Services</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="/How it works"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">How it works</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="/blogs"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">Blogs</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="/faq"
                                        style="color: #ccc; text-decoration: none; transition: color 0.3s;">FAQ’s</a>
                                </li>
                                {{-- <li style="margin-bottom: 10px;">
                                    <a href="{{ route('public.account.register') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Signup for Free</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('public.account.login') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Login Here</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>

                    <!-- Right Section: Follow Us On -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="footer-widget">
                            <h4 class="footer-title"
                                style="color: #fff; margin-bottom: 20px; border-bottom: 2px solid #1967d2; padding-bottom: 10px; display: inline-block;">
                                Follow us on</h4>
                            @php($socialLinks = Theme::getSocialLinks())
                            @if ($socialLinks)
                                <ul class="social-icons"
                                    style="list-style: none; padding: 0; margin: 0; display: flex; gap: 15px; flex-wrap: wrap;">
                                    @foreach ($socialLinks as $socialLink)
                                        @continue(!$socialLink->getUrl() || !$socialLink->getIconHtml())
                                        <li>
                                            <a href="{{ $socialLink->getUrl() }}" target="_blank" rel="noopener"
                                                style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.12); color: #fff; text-align: center; text-decoration: none; transition: transform 0.3s;">
                                                {!! $socialLink->getIconHtml() !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="social-icons"
                                    style="list-style: none; padding: 0; margin: 0; display: flex; gap: 15px; flex-wrap: wrap;">
                                    <li>
                                        <a href="https://www.linkedin.com/company/teachersrecruiter" target="_blank"
                                            rel="noopener"
                                            style="display: inline-block; width: 40px; height: 40px; border-radius: 50%; background: #0077b5; color: #fff; text-align: center; line-height: 40px; text-decoration: none; transition: transform 0.3s;">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/teachersrecruiter" target="_blank" rel="noopener"
                                            style="display: inline-block; width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: #fff; text-align: center; line-height: 40px; text-decoration: none; transition: transform 0.3s;">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.google.com/search?q=teachersrecruiter" target="_blank"
                                            rel="noopener"
                                            style="display: inline-block; width: 40px; height: 40px; border-radius: 50%; background: #4285F4; color: #fff; text-align: center; line-height: 40px; text-decoration: none; transition: transform 0.3s;">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/teachersrecruiter" target="_blank" rel="noopener"
                                            style="display: inline-block; width: 40px; height: 40px; border-radius: 50%; background: #1877F2; color: #fff; text-align: center; line-height: 40px; text-decoration: none; transition: transform 0.3s;">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/@teachersrecruiter" target="_blank" rel="noopener"
                                            style="display: inline-block; width: 40px; height: 40px; border-radius: 50%; background: #FF0000; color: #fff; text-align: center; line-height: 40px; text-decoration: none; transition: transform 0.3s;">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-policy-links" style="color: #ccc; font-size: 14px;justify-content: center; display: flex; align-items: center; margin-bottom: 10px; gap: 10px;">
                <a href="/privacy-policy" style="color: #ccc; text-decoration: none; margin-right: 15px;">Privacy Policy</a>
                <span style="color: #666;">|</span>
                <a href="/terms-conditions" style="color: #ccc; text-decoration: none; margin: 0 15px;">Terms Conditions &
                    Refund Policy</a>
                <span style="color: #666;">|</span>
                <a href="/fraud-alert" style="color: #ccc; text-decoration: none; margin-left: 15px;">Fraud Alert</a>
            </div>
            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom"
                style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 0px; margin-top: 0px;">
                <div class="footer-bottom-info"
                    style="display: flex; justify-content:center; align-items: center; flex-wrap: wrap; gap: 15px;">

                    <div class="footer-copy-right">
                        <span class="copyrights-text"
                            style="color: #ccc; font-size: 14px; text-align: center; display: block; width: 100%;">
                            {!! Theme::getSiteCopyright() ?: 'Teachers Recruiter © ' . date('Y') . ', All Right Reserved.' !!}
                        </span>
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
