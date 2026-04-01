@if (is_plugin_active('blog'))
    @php
        $limit = (int) Arr::get($config, 'limit') ?: 5;
        $type = Arr::get($config, 'type');
        $categories = get_popular_categories($limit);
    @endphp

    @if ($categories->count())
        <div class="widget all_services_list">
            <h4 class="section-head-small mb-4">{{ Arr::get($config, 'name') }}</h4>
            <div class="all_services m-b30">
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{ $category->url }}">{{ $category->name }}</a> <span class="badge">{{ $category->posts->count() }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endif
