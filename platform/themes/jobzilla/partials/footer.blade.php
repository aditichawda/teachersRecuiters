</div>
@php
    $hideFooterOnRoutes = ['public.account.login', 'public.account.register'];
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    $shouldHideFooter = in_array($currentRoute, $hideFooterOnRoutes, true);
    // Debug: Always show footer for now (remove this after testing)
    // $shouldHideFooter = false;
@endphp

@if (!$shouldHideFooter)
    <!-- FOOTER START -->
    <footer class="footer-dark teachersrecruiter-footer">
        <div class="container">
            <!-- FOOTER BLOCKES START -->
            <div class="footer-top">
                <div class="row">
                    <!-- Left Section: Company Information -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="footer-widget">
                            <h3 class="footer-brand-title">TeachersRecruiter™</h3>
                            <p class="footer-description">
                                Connecting educators and schools across India since 2015. With thousands of teacher
                                placements and a dedicated education job portal, we make hiring and job searching simple,
                                fast, and reliable – empowering schools with talent and teachers with opportunities.
                            </p>
                        </div>
                    </div>

                    <!-- Middle Section: Important Links -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="footer-widget">
                            <h4 class="footer-section-title">Important Links</h4>
                            <ul class="footer-links">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/about-us') }}">About Us</a></li>
                                <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                                <li><a href="{{ url('/services') }}">Services</a></li>
                                <li><a href="{{ url('/how-it-works') }}">How it works</a></li>
                                <li><a href="{{ url('/blogs') }}">Blogs</a></li>
                                <li><a href="{{ url('/faq') }}">FAQ's</a></li>
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
                            <h4 class="footer-section-title">Follow us on</h4>
                            @php($socialLinks = Theme::getSocialLinks())
                            @if ($socialLinks)
                                <ul class="social-icons">
                                    @foreach ($socialLinks as $socialLink)
                                        @continue(!$socialLink->getUrl() || !$socialLink->getIconHtml())
                                        <li>
                                            <a href="{{ $socialLink->getUrl() }}" target="_blank" rel="noopener" class="social-icon-link">
                                                {!! $socialLink->getIconHtml() !!}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.facebook.com/teachersrecruiter" target="_blank" rel="noopener" class="social-icon-link social-facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.google.com/search?q=teachersrecruiter" target="_blank" rel="noopener" class="social-icon-link social-google">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/@teachersrecruiter" target="_blank" rel="noopener" class="social-icon-link social-youtube">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/teachersrecruiter" target="_blank" rel="noopener" class="social-icon-link social-instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/teachersrecruiter" target="_blank" rel="noopener" class="social-icon-link social-linkedin">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Policy Links -->
            <div class="footer-policy-links">
                <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                <span class="separator">|</span>
                <a href="{{ url('/terms-conditions') }}">Terms Conditions & Refund Policy</a>
                <span class="separator">|</span>
                <a href="{{ url('/fraud-alert') }}">Fraud Alert</a>
            </div>
            
            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom">
                <div class="footer-bottom-info">
                    <div class="footer-copy-right">
                        <span class="copyrights-text">
                            {!! Theme::getSiteCopyright() ?: 'Teachers Recruiter © ' . date('Y') . ', All Right Reserved.' !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="whatsapp-float">
        <i class="fab fa-whatsapp"></i>
    </a>
    
    <!-- Footer Styles -->
    <style>
        /* Force footer to display with all possible selectors */
        footer.teachersrecruiter-footer,
        .teachersrecruiter-footer,
        .footer-dark.teachersrecruiter-footer,
        footer.footer-dark.teachersrecruiter-footer,
        footer.footer-dark {
            background: #2c3e50 !important;
            background-image: 
                linear-gradient(135deg, #2c3e50 0%, #34495e 100%),
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.05) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.05) 1px, transparent 1px),
                radial-gradient(circle at 40% 20%, rgba(255,255,255,0.05) 1px, transparent 1px) !important;
            background-size: 100% 100%, 50px 50px, 60px 60px, 45px 45px !important;
            background-position: 0 0, 0 0, 30px 30px, 15px 15px !important;
            background-repeat: no-repeat, repeat, repeat, repeat !important;
            color: #fff !important;
            padding: 60px 0 20px !important;
            position: relative !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            min-height: 300px !important;
            width: 100% !important;
            margin-top: 0 !important;
            clear: both !important;
            z-index: 1 !important;
            height: auto !important;
        }
        
        /* Override any existing footer-dark styles */
        .footer-dark {
            background: #2c3e50 !important;
        }
        
        /* Override any existing footer-dark styles */
        .footer-dark {
            background: #2c3e50 !important;
        }
        
        .footer-brand-title {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }
        
        .footer-description {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 0;
        }
        
        .footer-section-title {
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 12px;
            position: relative;
            display: inline-block;
        }
        
        .footer-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #1967D2;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links li a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .footer-links li a:hover {
            color: #1967D2;
            padding-left: 5px;
        }
        
        .social-icons {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .social-icon-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 18px;
        }
        
        .social-icon-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .social-facebook:hover {
            background: #1877F2;
        }
        
        .social-google:hover {
            background: #4285F4;
        }
        
        .social-youtube:hover {
            background: #FF0000;
        }
        
        .social-instagram:hover {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }
        
        .social-linkedin:hover {
            background: #0077b5;
        }
        
        .footer-policy-links {
            text-align: center;
            padding: 25px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin: 30px 0 20px;
        }
        
        .footer-policy-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
            margin: 0 10px;
        }
        
        .footer-policy-links a:hover {
            color: #1967D2;
        }
        
        .footer-policy-links .separator {
            color: rgba(255, 255, 255, 0.3);
            margin: 0 5px;
        }
        
        .footer-bottom {
            padding: 20px 0 10px;
        }
        
        .footer-bottom-info {
            text-align: center;
        }
        
        .copyrights-text {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
        }
        
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }
        
        .whatsapp-float i {
            color: #fff;
        }
        
        @media (max-width: 991px) {
            .teachersrecruiter-footer {
                padding: 40px 0 15px;
            }
            
            .footer-brand-title {
                font-size: 28px;
            }
            
            .footer-section-title {
                font-size: 16px;
                margin-bottom: 20px;
            }
            
            .social-icon-link {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .footer-policy-links {
                padding: 20px 0;
                margin: 20px 0 15px;
            }
            
            .footer-policy-links a {
                display: block;
                margin: 8px 0;
            }
            
            .footer-policy-links .separator {
                display: none;
            }
        }
    </style>
@endif

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
