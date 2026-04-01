@if (is_plugin_active('blog'))
    @php
        $limit = (int) Arr::get($config, 'limit') ?: 5;
        $type = Arr::get($config, 'type');
        $tags = get_popular_tags($limit);
    @endphp

    @if ($tags->count())
        <div class="widget tw-sidebar-tags-wrap">
            <h4 class="section-head-small mb-4">{{ Arr::get($config, 'name') }}</h4>

            <div class="tagcloud">
                @foreach($tags as $tag)
                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    @endif
@endif
