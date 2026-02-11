@php
    use Botble\Base\Facades\BaseHelper;
    use Botble\Slug\Facades\SlugHelper;
    
    $bgColor = $shortcode->bg_color ?? '#E8F4F8';
@endphp

<!-- JOBS BY CATEGORIES SECTION START -->
<div class="section-full p-t80 p-b80 site-bg-light" style="background-color: {{ $bgColor }};">
    <div class="container">
        @if ($shortcode->title || $shortcode->subtitle)
            <div class="section-head center wt-small-separator-outer text-center">
                @if ($shortcode->title)
                    <div class="wt-small-separator site-text-primary">
                        <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                    </div>
                @endif
                @if ($shortcode->subtitle)
                    <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                @endif
            </div>
        @endif

        <div class="row" style="padding: 0 4rem;">
            <!-- Jobs by Location -->
            <!-- <div class="col-lg-3 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-map-pin" style="color: #1967D2; margin-right: 8px;"></i>
                            {{ __('Jobs by Location') }}
                        </h4>
                    </div>
                    @if ($locations->isNotEmpty())
                        <ul class="jobs-category-list">
                            @foreach ($locations as $location)
                                <li>
                                    <a href="{{ route('public.jobs-by-state', $location->slug) }}" class="jobs-category-link">
                                        {{ __('Teacher Jobs in :location', ['location' => $location->name]) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">{{ __('No locations available') }}</p>
                    @endif
                </div>
            </div> -->

            <!-- Jobs by Job Role -->
            <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-briefcase" style="color: #1967D2; margin-right: 8px;"></i>
                            {{ __('Jobs by Designation') }}
                        </h4>
                    </div>
                    @if ($jobRoles->isNotEmpty())
                        <ul class="jobs-category-list">
                            @foreach ($jobRoles as $role)
                                <li>
                                    <a href="{{ $role->url }}" class="jobs-category-link">
                                        {{ $role->name }} {{ __('Jobs') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">{{ __('No job roles available') }}</p>
                    @endif
                </div>
            </div>

            <!-- Jobs by Teaching Subject -->
            <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-book" style="color: #1967D2; margin-right: 8px;"></i>
                            {{ __('Jobs by Teaching Subject') }}
                        </h4>
                    </div>
                    @if ($teachingSubjects->isNotEmpty())
                        <ul class="jobs-category-list">
                            @foreach ($teachingSubjects as $subject)
                                <li>
                                    <a href="{{ $subject->url }}" class="jobs-category-link">
                                        {{ $subject->name }} {{ __('Teacher Jobs') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">{{ __('No teaching subjects available') }}</p>
                    @endif
                </div>
            </div>

            <!-- Jobs by Institution Type -->
            <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-building" style="color: #1967D2; margin-right: 8px;"></i>
                            {{ __('Jobs by Institution Type') }}
                        </h4>
                    </div>
                    @if ($institutionTypes->isNotEmpty())
                        <ul class="jobs-category-list">
                            @foreach ($institutionTypes as $institution)
                                <li>
                                    <a href="{{ $institution->url }}" class="jobs-category-link">
                                        {{ $institution->name }} {{ __('Jobs') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">{{ __('No institution types available') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JOBS BY CATEGORIES SECTION END -->

<style>
/* Section Container - Keep content within blue background */
.section-full.site-bg-light {
    overflow: hidden;
    position: relative;
}

.section-full.site-bg-light .container {
    max-width: 100%;
    padding-left: 15px;
    padding-right: 15px;
    overflow: hidden;
}

.section-full.site-bg-light .row {
    margin-left: -15px;
    margin-right: -15px;
    overflow: hidden;
}

.section-full.site-bg-light .row > [class*="col-"] {
    padding-left: 15px;
    padding-right: 15px;
}

.jobs-category-box {
    background: #ffffff;
    border-radius: 8px;
    padding: 30px;
    height: 100%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    max-width: 100%;
    box-sizing: border-box;
}

.jobs-category-header {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #E8F4F8;
}

.jobs-category-title {
    font-size: 20px;
    font-weight: 600;
    color: #1A1A1A;
    margin: 0;
    display: flex;
    align-items: center;
}

.jobs-category-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 240px;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 8px;
    width: 100%;
    box-sizing: border-box;
}

.jobs-category-list::-webkit-scrollbar {
    width: 6px;
}

.jobs-category-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.jobs-category-list::-webkit-scrollbar-thumb {
    background: #1967D2;
    border-radius: 10px;
}

.jobs-category-list::-webkit-scrollbar-thumb:hover {
    background: #1557b8;
}

.jobs-category-list li {
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #F0F0F0;
}

.jobs-category-list li:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.jobs-category-link {
    color: #1A1A1A;
    text-decoration: none;
    font-size: 15px;
    transition: all 0.3s ease;
    display: block;
    position: relative;
    padding-left: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100%;
}

.jobs-category-link:hover {
    color: #1967D2;
    text-decoration: underline;
    padding-left: 8px;
}

.jobs-category-link::before {
    content: '';
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 2px;
    background-color: #1967D2;
    transition: width 0.3s ease;
}

.jobs-category-link:hover::before {
    width: 4px;
}

@media (max-width: 768px) {
    .jobs-category-box {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .jobs-category-title {
        font-size: 18px;
    }
    
    .jobs-category-link {
        font-size: 14px;
    }
}
</style>