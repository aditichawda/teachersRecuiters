@if (is_plugin_active('blog'))
    @if (($posts = get_recent_posts($config['number_display'])) && $posts->count() && $posts->loadMissing(['author']))
        <div class="widget recent-posts-entry">
            <h4 class="section-head-small mb-4">{!! BaseHelper::clean(Arr::get($config, 'name')) !!}</h4>
            <div class="section-content">
                <div class="widget-post-bx">
                    @foreach ($posts as $post)
                        <div class="widget-post clearfix">
                        <div class="wt-post-media">
                            <a href="{{ $post->url }}">
                                <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                            </a>
                        </div>
                        <div class="wt-post-info">
                            <div class="wt-post-header">
                                <span class="post-date">{{ Theme::formatDate($post->created_at) }}</span>
                                <span class="post-title">
                                    <a href="{{ $post->url }}">{!! BaseHelper::clean($post->name) !!}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif
