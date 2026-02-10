@if (is_plugin_active('blog'))
    @php
        switch ($config['type']) {
            case 'recent':
                $posts = get_recent_posts($config['number_display']);
                break;
            default:
                $posts = get_popular_posts($config['number_display']);
                break;
        }
    @endphp
    @if ($posts->isNotEmpty())
        <div class="mt-4 pt-2">
            <div class="sd-title">
                <h6 class="fs-16 mb-3">{{ $config['name'] ?: __('Blog Post') }}</h6>
            </div>
            <ul class="widget-popular-post list-unstyled my-4">
                @foreach ($posts as $post)
                    <li class="d-flex mb-3 align-items-center pb-3 border-bottom">
                        <img src="{{ RvMedia::getImageUrl($post->image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                            alt="{{ $post->name }}" class="widget-popular-post-img rounded" />
                        <div class="flex-grow-1 text-truncate ms-3">
                            <a href="{{ $post->url }}" class="text-dark">{{ $post->name }}</a>
                            <span class="d-block text-muted fs-14">{{ Theme::formatDate($post->created_at) }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
