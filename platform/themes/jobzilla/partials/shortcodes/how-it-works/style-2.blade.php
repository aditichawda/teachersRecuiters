<!-- HOW IT WORK SECTION START -->
<div class="section-full p-b30 twm-how-it-work-area2" style="background-color: aliceblue">

    {{-- Section Heading --}}
    <div class="section-head left wt-small-separator-outer text-center pt-5">
    <h2 class="wt-title d-flex justify-content-center">
            {!! BaseHelper::clean($shortcode->subtitle) !!}
        </h2>
        <div class="wt-small-separator site-text-primary d-flex justify-content-center">
            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
        </div>

    </div>

    {{-- Check List --}}
    @php
        $checkList = $shortcode->check_list
            ? array_filter(explode(';', $shortcode->check_list))
            : [];
    @endphp

    @if ($checkList)
        <ul class="description-list text-center">
            @foreach ($checkList as $item)
                <li>
                    <i class="feather-check"></i> {{ $item }}
                </li>
            @endforeach
        </ul>
    @endif

    <div class="container">

        <div class="col-12">
            {{-- Steps Column --}}
            
            <div class="col-lg-12 col-md-12">

                {{-- Step Cards - Full Width Row --}}
                <div class="twm-w-process-steps-2-wrap">
                    <div class="row">
                        @foreach ($tabs as $tab)
                            @php
                                $rgbColor = Arr::get($tab, 'rgb_color');
                                $bgColor  = Arr::get($tab, 'bg_color');
                            @endphp

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="twm-w-process-steps-2">
                                    <div
                                        class="twm-w-pro-top shadow bg-opacity-50 {{ !$rgbColor ? 'bg-clr-sky-light' : '' }}"
                                        @if($bgColor)
                                            style="background-color: {{ $bgColor }};"
                                        @endif
                                    >
                                        <span
                                            class="twm-large-number {{ !$bgColor ? 'text-clr-sky' : '' }}"
                                            @if($bgColor)
                                                style="color: {{ $bgColor }};"
                                            @endif
                                        >
                                            {{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}
                                        </span>

                                        <div class="twm-media">
                                            <span>
                                                <img
                                                    src="{{ RvMedia::getImageUrl(
                                                        Arr::get($tab, 'image'),
                                                        null,
                                                        false,
                                                        RvMedia::getDefaultImage()
                                                    ) }}"
                                                    alt="{{ Arr::get($tab, 'title') }}"
                                                >
                                            </span>
                                        </div>

                                        <h4 class="twm-title">
                                            {{ Arr::get($tab, 'title') }}
                                        </h4>

                                        <p>
                                            {{ Arr::get($tab, 'subtitle') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Video Section - Below Cards --}}
                <div class="hiw-video-below-section">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="hiw-video-below-card">
                                <div class="hiw-video-below-inner">
                                    <iframe 
                                        src="https://www.youtube.com/embed/r4PevhrJA_A?si=oVH36shDIgdaL5D4" 
                                        title="Teachers Recruiter - How It Works" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- Video Column --}}
            @php
                // Check if URL exists - also check from shortcode directly as fallback
                $hasVideo = false;
                $videoUrl = $url;
                
                // First check if $url variable is set
                if (!empty($url) && is_string($url)) {
                    $hasVideo = true;
                    $videoUrl = $url;
                }
                // Fallback: check directly from shortcode
                elseif (!empty($shortcode->youtube_url)) {
                    $youtubeUrl = trim($shortcode->youtube_url);
                    
                    // Process URL directly here
                    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        $hasVideo = true;
                    } elseif (preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/watch\?.*&v=)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        $hasVideo = true;
                    } elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        $hasVideo = true;
                    } elseif (strpos($youtubeUrl, 'youtube.com/embed/') !== false) {
                        $videoUrl = $youtubeUrl;
                        $hasVideo = true;
                    }
                }
            @endphp
            
            @if ($hasVideo && !empty($videoUrl))
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <div
                        class="youtube-iframe"
                        style="{{ (!$width && !$height) ? 'position:relative;display:block;height:0;padding-bottom:56.25%;overflow:hidden;' : 'margin-bottom:20px;' }}"
                    >
                        <iframe
                            src="{{ $videoUrl }}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            frameborder="0"
                            title="Video"
                            style="
                                {{ (!$width && !$height) ? 'position:absolute;top:0;left:0;width:100%;height:100%;border:0;' : '' }}
                                {{ $width ? 'width:'.$width.'px !important;' : '' }}
                                {{ $height ? 'height:'.$height.'px !important;' : '' }}
                                max-width:100%;
                            "
                        ></iframe>
                    </div>
                </div>
            @endif
        </div>

        <div class="twm-how-it-work-section"></div>

    </div>
</div>




<!-- HOW IT WORK SECTION START -->
<!-- <div class="section-full  p-b30 site-bg-white twm-how-it-work-area2">
<div class="section-head left wt-small-separator-outer">
                    <div class="wt-small-separator site-text-primary" style="
    text-align: center;
    justify-content: center;
    display: flex;
">
                        <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                    </div>
                    <h2 class="wt-title" style="
    text-align: center;
    justify-content: center;
    display: flex;
">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                </div>
                @if ($shortcode->check_list && $list = array_filter(explode(';', $shortcode->check_list)))
                    <ul class="description-list">
                        @foreach ($list as $item)
                            <li><i class="feather-check"></i>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (!empty($url))
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-12">
                
               
    <div
        class="youtube-iframe"
        @if (!$width && !$height) style="position: relative; display: block; height: 0; padding-bottom: 56.25%; overflow: hidden;"
        @else
            style="margin-bottom: 20px;" @endif
    >
        <iframe
            src="{{ $url }}"
            allowfullscreen
            frameborder="0"
            @style([
                'position: absolute; top: 0; bottom: 0; left: 0; width: 100%; height: 100%; border: 0;' => !$width && !$height,
                "height: {$height}px !important;" => $height,
                "width: {$width}px !important;" => $width,
                'max-width: 100%',
            ])
            title="Video"
        ></iframe>
    </div>
@endif

               
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="twm-w-process-steps-2-wrap">
                    <div class="row col-6">
                        @foreach ($tabs as $tab)
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps-2">
                                    <div class="twm-w-pro-top shadow bg-opacity-50 @if (! Arr::get($tab, 'rgb_color')) bg-clr-sky-light @endif"
                                        @if (Arr::get($tab, 'rgb_color')) style="background-color: rgba({{ Arr::get($tab, 'rgb_color') }}, var(--bs-bg-opacity))" @endif>
                                        <span class="twm-large-number @if (! Arr::get($tab, 'bg_color')) text-clr-sky @endif" 
                                        @if (Arr::get($tab, 'rgb_color')) style="color: {{ Arr::get($tab, 'bg_color') }};" @endif>{{ $loop->iteration < 10 ? ('0' . $loop->iteration) : $loop->iteration }}</span>
                                        <div class="twm-media">
                                            <span>
                                                <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                            </span>
                                        </div>
                                        <h4 class="twm-title">{{ Arr::get($tab, 'title') }}</h4>
                                        <p>{{ Arr::get($tab, 'subtitle') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="twm-how-it-work-section"></div>
    </div>
</div> -->