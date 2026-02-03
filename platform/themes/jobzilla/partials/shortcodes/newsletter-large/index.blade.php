@php
    $titlePrimary = preg_replace('/\{\{(.*)\}\}/', '<span>${1}</span>', $shortcode->title_primary ?: '');
@endphp

<div class="section-full twm-hpage-6-subs-wrap bg-cover " style="background-image: url(images/home-6/subscribe-bg.jpg)">
    <div class="container">

        <div class="section-content">
            <div class="row">

                <div class="col-lg-7 col-md-12">
                    <div class="twm-hpage-6-getintouch">
                        <div class="callus-bg-box">
                            <div class="callus-bg-box-shadow"></div>
                        </div>
                        <div class="twm-hpage-6-getintouch-title">
                            @if($subtitlePrimary = $shortcode->subtitle_primary)
                                <div class="wt-title-small">{!! BaseHelper::clean($subtitlePrimary) !!}</div>
                            @endif

                            @if ($titlePrimary)
                                <h2 class="wt-title">
                                    {!! BaseHelper::clean($titlePrimary) !!}
                                </h2>
                            @endif
                        </div>
                        <div class="twm-hpage-6-callus">
                            <div class="callus-icon">
                                <i class="flaticon-phone"></i>
                            </div>
                            <div class="callus-content">
                            @if($phone = $shortcode->phone)
                                <div class="callus-number">{{ $phone }}</div>
                            @endif
                            @if($email = $shortcode->email)
                                <div class="callus-email">{{ $email }}</div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="twm-hpage-6-subscribe-wrap">
                        <div class="hpage-6-nw-form-corner-wrap">
                            <div class="twm-hpage-6-subscribe">
                                @if ($titleSecondary = $shortcode->title_secondary)
                                    <h3 class="twm-sub-title">{!! BaseHelper::clean($titleSecondary) !!}</h3>
                                @endif

                                @if ($subtitleSecondary = $shortcode->subtitle_secondary)
                                    <div class="twm-sub-discription">
                                       {!! BaseHelper::clean($subtitleSecondary) !!}
                                    </div>
                                @endif
                                {!! Form::open(['route' => 'public.newsletter.subscribe', 'class' => 'newsletter-form']) !!}
                                    <div class="hpage-6-nw-form">
                                        <input name="email" class="form-control" placeholder="{{ __('Enter Your Email') }}" type="text">
                                        <button type="submit" class="hpage-6-nw-form-btn"><i class="fa fa-paper-plane"></i></button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="hpage-6-nw-form-corner"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
