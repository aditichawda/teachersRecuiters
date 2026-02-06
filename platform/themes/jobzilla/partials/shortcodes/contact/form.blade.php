<div class="section-full twm-contact-one">
    <div class="section-content">
        <div class="container">

            <!-- CONTACT FORM-->
            <div class="contact-one-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-form-outer">
                            <div class="section-head left wt-small-separator-outer">
                                <h2 class="wt-title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                                <p>{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                            </div>

                            {!! Form::open(['route' => 'public.send.contact', 'class' => 'contact-form cons-contact-form']) !!}
                                {!! apply_filters('pre_contact_form', null) !!}
                                <span id="error-msg"></span>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="name" id="contact-name" class="form-control @error('name') is-invalid @endif"
                                                placeholder="{{ __('Enter your name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @endif" required
                                                placeholder="{{ __('Enter your email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input name="phone" type="text" class="form-control @error('phone') is-invalid @endif" required
                                                placeholder="{{ __('Enter your phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" id="contact-subject @error('subject') is-invalid @endif" name="subject"
                                                placeholder="{{ __('Enter your subject') }}">
                                            @error('subject')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('subject') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <textarea class="form-control @error('content') is-invalid @endif" placeholder="{{ __('Enter your message') }}" name="content" id="contact-content" rows="3"></textarea>
                                            @error('content')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('content') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    @if (is_plugin_active('captcha'))
                                        @if (setting('enable_captcha'))
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    {!! Captcha::display() !!}
                                                </div>
                                            </div>
                                        @endif

                                        @if (setting('enable_math_captcha_for_contact_form', 0))
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="math-group">{{ app('math-captcha')->label() }}</label>
                                                    {!! app('math-captcha')->input(['class' => 'form-control', 'id' => 'math-group', 'placeholder' => app('math-captcha')->getMathLabelOnly() . ' = ?']) !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-12">
                                        <button type="submit" class="site-button">{{ __('Submit Now') }}</button>
                                    </div>
                                </div>

                                {!! apply_filters('after_contact_form', null) !!}

                                <div class="col-12">
                                    <div class="contact-form-group mt-4">
                                        <div class="contact-message contact-success-message" style="display: none"></div>
                                        <div class="contact-message contact-error-message" style="display: none"></div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="contact-info-wrap">
                            <div class="contact-info">
                                <div class="contact-info-section">

                                    @if ($shortcode->address_1)
                                        <div class="c-info-column mb-6">
                                            <div class="c-info-icon">
                                                <i class=" fas fa-map-marker-alt"></i>
                                            </div>
                                            <h3 class="twm-title">{{ $shortcode->address_title ?: __('Address') }}</h3>
                                            <p>{{ $shortcode->address_1 }}</p>
                                            @if ($shortcode->address_2)
                                                <p>{{ $shortcode->address_2 }}</p>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($shortcode->phone_1)
                                        <div class="c-info-column mb-6">
                                            <div class="c-info-icon custome-size">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <h3 class="twm-title">{{ $shortcode->phone_title ?: __('Feel free to contact us') }}</h3>
                                            <p><a href="tel:{{ $shortcode->phone_1 }}" dir="ltr">{{ $shortcode->phone_1 }}</a></p>
                                            @if ($shortcode->phone_2)
                                                <p><a href="tel:{{ $shortcode->phone_2 }}" dir="ltr">{{ $shortcode->phone_2 }}</a></p>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($shortcode->email_1)
                                        <div class="c-info-column mb-6">
                                            <div class="c-info-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <h3 class="twm-title">{{ $shortcode->email_title ?: __('Support') }}</h3>
                                            <p><a href="tel:{{ $shortcode->email_1 }}">{{ $shortcode->email_1 }}</a></p>
                                            @if ($shortcode->email_2)
                                                <p><a href="tel:{{ $shortcode->email_2 }}">{{ $shortcode->email_2 }}</a></p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
