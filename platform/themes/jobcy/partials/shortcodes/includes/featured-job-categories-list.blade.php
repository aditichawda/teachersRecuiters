@foreach ($categories as $category)
    <div class="col-lg-3 col-md-6 mt-4 pt-2">
        <div class="popu-category-box rounded text-center">
            <div class="popu-category-icon icons-md">
                @if ($iconImage = $category->getMetaData('icon_image', true))
                    <img
                        src="{{ RvMedia::getImageUrl($iconImage) }}"
                        alt="{{ $category->name }}"
                        width="64"
                        height="64"
                    >
                @elseif ($icon = $category->getMetaData('icon', true))
                    {!! BaseHelper::renderIcon($icon) !!}
                @endif
            </div>
            <div class="popu-category-content mt-4">
                <a
                    class="text-dark stretched-link"
                    href="{{ $category->url }}"
                >
                    <h3 class="fs-18">{{ $category->name }}</h3>
                </a>
                @if (($shortcode->show_jobs_count ?? 'yes') == 'yes')
                    <p class="text-muted mb-0">{{ __(':jobs Jobs', ['jobs' => $category->active_jobs_count]) }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@endforeach

@if (isset($page) && $page)
    <div class="col-12">
        <div class="mt-5 text-center">
            <a
                class="btn btn-primary btn-hover"
                href="{{ $page->url }}"
            >
                <span>{{ __('Browse All Categories') }}</span>
                <i class="mdi mdi mdi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
@endif
