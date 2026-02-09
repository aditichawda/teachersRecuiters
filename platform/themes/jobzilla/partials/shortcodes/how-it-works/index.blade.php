@php
    $tabs = [];
    $quantity = max((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if (($title = $shortcode->{'title_' . $i})) {
                $bgColor = $shortcode->{'bg_color_' . $i};
                $rgbColor = '';
                if ($bgColor) {
                    [$r, $g, $b] = sscanf($bgColor, "#%02x%02x%02x");
                    $rgbColor = $r . ', ' . $g . ', ' . $b;
                }
                $tabs[] = [
                    'title' => $title,
                    'subtitle' => $shortcode->{'subtitle_' . $i},
                    'image' => $shortcode->{'image_' . $i},
                    'bg_color' => $bgColor,
                    'rgb_color' => $rgbColor,
                ];
            }
        }
    }

    $style = in_array($shortcode->style, ['style-1', 'style-2', 'style-3', 'style-4', 'style-7', 'style-8']) ? $shortcode->style : 'style-1';
    
    // Process YouTube video URL if provided
    $url = null;
    $width = !empty($shortcode->youtube_width) ? (int) $shortcode->youtube_width : null;
    $height = !empty($shortcode->youtube_height) ? (int) $shortcode->youtube_height : null;
    
    if (!empty($shortcode->youtube_url)) {
        $youtubeUrl = trim($shortcode->youtube_url);
        
        // Try to use the Youtube class if available
        if (class_exists(\Botble\Theme\Supports\Youtube::class)) {
            try {
                $url = \Botble\Theme\Supports\Youtube::getYoutubeVideoEmbedURL($youtubeUrl);
            } catch (\Exception $e) {
                // Fallback to manual processing
            }
        }
        
        // Fallback: manual YouTube URL processing
        if (empty($url)) {
            // Handle youtu.be format: https://youtu.be/VIDEO_ID
            if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                $url = 'https://www.youtube.com/embed/' . $matches[1];
            }
            // Handle youtube.com/watch?v= format
            elseif (preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/watch\?.*&v=)([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                $url = 'https://www.youtube.com/embed/' . $matches[1];
            }
            // Handle youtube.com/embed/ format
            elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $youtubeUrl, $matches)) {
                $url = 'https://www.youtube.com/embed/' . $matches[1];
            }
            // If already an embed URL, use as is
            elseif (strpos($youtubeUrl, 'youtube.com/embed/') !== false) {
                $url = $youtubeUrl;
            }
        }
    }
@endphp

@if (count($tabs))
    {!! Theme::partial('shortcodes.how-it-works.' . $style, compact('shortcode', 'tabs', 'url', 'width', 'height')) !!}
@endif
