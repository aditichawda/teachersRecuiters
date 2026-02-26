<style>
/* Fixed height for all job cards */
.hpage-6-featured-block {
    height: 380px !important;
    min-height: 380px !important;
    max-height: 380px !important;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}
.hpage-6-featured-block .inner-content {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}
.hpage-6-featured-block .mid-content {
    flex: 1;
    min-height: 0;
    overflow: hidden;
}
.hpage-6-featured-block .company-info {
    flex: 1;
    min-height: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}
.hpage-6-featured-block .bottom-content {
    flex-shrink: 0;
    margin-top: auto;
}
/* Ensure carousel items are aligned */
.owl-item .hpage-6-featured-block,
.swiper-slide .hpage-6-featured-block {
    height: 380px !important;
    min-height: 380px !important;
    max-height: 380px !important;
}
.owl-item,
.swiper-slide {
    display: flex;
    align-items: stretch;
    height: auto;
}
.owl-item > div,
.swiper-slide > div {
    width: 100%;
    display: flex;
    height: 100%;
}

/* Responsive adjustments */
@media (max-width: 1199px) {
    .hpage-6-featured-block {
        height: 400px !important;
        min-height: 400px !important;
        max-height: 400px !important;
    }
    .owl-item .hpage-6-featured-block,
    .swiper-slide .hpage-6-featured-block {
        height: 400px !important;
        min-height: 400px !important;
        max-height: 400px !important;
    }
}

@media (max-width: 991px) {
    .hpage-6-featured-block {
        height: auto !important;
        min-height: 350px !important;
        max-height: none !important;
    }
    .owl-item .hpage-6-featured-block,
    .swiper-slide .hpage-6-featured-block {
        height: auto !important;
        min-height: 350px !important;
        max-height: none !important;
    }
}

@media (max-width: 767px) {
    .hpage-6-featured-block {
        height: auto !important;
        min-height: 320px !important;
        max-height: none !important;
    }
    .owl-item .hpage-6-featured-block,
    .swiper-slide .hpage-6-featured-block {
        height: auto !important;
        min-height: 320px !important;
        max-height: none !important;
    }
}
</style>
<div class="hpage-6-featured-block">
    <div class="inner-content">
        <div class="top-content">
            <span class="job-time">
                @if ($job->jobTypes->count() > 0)
                    @foreach($job->jobTypes as $jobType)
                        {{ $jobType->name }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </span>
            <span class="job-post-time">{{ $job->created_at->diffForHumans() }}</span>
        </div>
        <div class="mid-content">
            <div class="company-logo">
                <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->company_name }}">
            </div>
            <div class="company-info">
                <a href="{{ $job->url }}" class="company-name">{{ $job->company->name }} {!! $job->company->badge !!}</a>
                @php
                    $institutionType = $job->company->institution_type ?? 'School';
                    $institutionType = !empty($institutionType) ? $institutionType : 'School';
                    
                    // Check if job is from a consultancy
                    $isConsultancy = false;
                    // Check company's institution_type
                    if (strtolower($institutionType) === 'consultancy' || strtolower($institutionType) === 'consulting') {
                        $isConsultancy = true;
                    }
                    // Also check author's registration_type as fallback
                    if (!$isConsultancy && $job->author && method_exists($job->author, 'registration_type')) {
                        $authorRegistrationType = $job->author->registration_type ?? '';
                        if (strtolower($authorRegistrationType) === 'consultancy') {
                            $isConsultancy = true;
                        }
                    }
                    
                    $displayType = $isConsultancy ? 'Consultancy' : $institutionType;
                @endphp
                <p class="company-institution-type" style="font-size: 13px; color: #64748b; margin: 3px 0;">
                    <i class="feather-briefcase" style="font-size: 12px;"></i> {{ $displayType }}
                </p>
                @if (!empty($job->gender_preference))
                    @php
                        $genderLabel = ucfirst($job->gender_preference);
                        if ($job->gender_preference == 'male') {
                            $genderIcon = '♂';
                            $genderLabel = __('Male Preferred');
                        } elseif ($job->gender_preference == 'female') {
                            $genderIcon = '♀';
                            $genderLabel = __('Female Preferred');
                        } else {
                            $genderIcon = '';
                        }
                    @endphp
                    <p class="company-gender-preference" style="font-size: 13px; color: #64748b; margin: 3px 0;">
                        @if ($genderIcon){{ $genderIcon }} @endif{{ $genderLabel }}
                    </p>
                @endif
                <p class="company-address"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
            </div>
        </div>
        <div class="bottom-content">
            <h4 class="job-name-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;" title="{{ $job->name }}">
                @php
                    $jobName = strip_tags($job->name);
                    $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
                @endphp
                {{ $truncatedName }}
            </h4>
            <div class="job-payment">
                {{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}
            </div>
        </div>
        <div class="aply-btn-area">
            <a href="{{ $job->url }}" class="aplybtn">
                <i class="fa fa-check"></i>
            </a>
        </div>
    </div>
</div>
