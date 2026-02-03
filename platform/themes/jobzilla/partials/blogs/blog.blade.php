@php
    $numberOfPostInRow = (int) theme_option('number_of_post_in_row') ?: 3;
    $boxStyle = theme_option('style_box_post') ?: 1;
@endphp

@if ($boxStyle == 3)
    @forelse($posts as $post)
        {!! Theme::partial('blogs.box.style-' . $boxStyle, compact('post', 'numberOfPostInRow')) !!}
    @empty
        <p class="text-center">{{ __('No data available') }}</p>
    @endforelse
@else
    <div class="masonry-wrap row d-flex">
        @forelse($posts as $post)
            {!! Theme::partial('blogs.box.style-' . $boxStyle, compact('post', 'numberOfPostInRow')) !!}
        @empty
            <p class="text-center">{{ __('No data available') }}</p>
        @endforelse
    </div>
@endif
