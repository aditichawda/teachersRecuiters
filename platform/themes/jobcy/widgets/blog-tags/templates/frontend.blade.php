@if (is_plugin_active('blog'))
    @php
        $tags = get_popular_tags((int)$config['number_display'] ?: 5);
    @endphp
    @if ($tags->isNotEmpty())
        <div class="mt-4 pt-2">
            <div class="sd-title">
                <h6 class="fs-16 mb-3">{!! BaseHelper::clean($config['name'] ?: __('Tags')) !!}</h6>
            </div>
            <div class="tagcloud mt-3">
                @foreach ($tags as $tag)
                    <a class="badge tag-cloud fs-12 mt-2" href="{{ $tag->url }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    @endif
@endif
