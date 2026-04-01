@php
    Theme::set('pageTitle', __('Saved Jobs'));
@endphp

<!-- START BOOKMARKS -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div>
                    <h6 class="fs-16 mb-0">{{ __('Saved Jobs') }}</h6>
                </div>
            </div>
            <div class="col-lg-6">
                <form action="{{ URL::current() }}" method="GET">
                    <div class="candidate-list-widgets">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="selection-widget mt-3 mt-lg-0">
                                    <select class="form-select" data-trigger name="order_by" id="choices-single-filter-order_by" aria-label="Default select example">
                                        <option value="">{{ __('Default') }}</option>
                                        @foreach(JobBoardHelper::getSortByParams() as $key => $label)
                                            <option value="{{ $key }}" @selected(request()->input('order_by') == $key)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="selection-widget mt-3 mt-lg-0">
                                    <select class="form-select" data-trigger name="category" id="choices-candidate-page" aria-label="Default select example">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach (Botble\JobBoard\Models\Category::query()->wherePublished()->orderBy('order')->orderByDesc('created_at')->get() as $category)
                                            <option value="{{ $category->id }}" @if (request()->input('category') == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="uil uil-search"></i>
                                </button>
                            </div>
                        </div>
                    </div><!--end candidate-list-widgets-->
                </form>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @forelse ($jobs as $job)
                    <div class="job-box card mt-4">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-1">
                                    <a href="{{ $job->company->url }}">
                                        <img src="{{ $job->company->logo_thumb }}" alt="logo" class="img-fluid rounded-3">
                                    </a>
                                </div>
                                <div class="col-lg-9">
                                    <div class="mt-3 mt-lg-0">
                                        <h5 class="fs-17 mb-1">
                                            <a href="{{ $job->url }}" class="text-dark">{{ $job->name }}</a>
                                            <small class="text-muted fw-normal">({{ $job->jobExperience->name }})</small>
                                        </h5>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <p class="text-muted fs-14 mb-0">{{ $job->company->name }}</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <p class="text-muted fs-14 mb-0">
                                                    <i class="mdi mdi-map-marker"></i>
                                                    <span>{{ $job->full_address }}</span>
                                                </p>
                                            </li>
                                            <li class="list-inline-item">
                                                <p class="text-muted fs-14 mb-0">
                                                    <i class="uil uil-wallet"></i>
                                                    <span>{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</span>
                                                </p>
                                            </li>
                                        </ul>
                                        @if ($job->jobTypes->isNotEmpty())
                                            <div class="mt-2">
                                                @foreach($job->jobTypes as $jobType)
                                                    <span class="badge bg-soft-danger mt-1">{{ $jobType->name }}@if (!$loop->last), @endif</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2 align-self-center">
                                    <ul class="list-inline mt-3 mb-0">
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('View Detail') }}">
                                            <a href="{{ $job->url }}" class="avatar-sm bg-soft-success d-inline-block text-center rounded-circle fs-18">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('bookmark-form-{{ $job->id }}').submit();"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"  class="avatar-sm bg-soft-danger d-inline-block text-center rounded-circle fs-18">
                                                <i class="uil uil-trash-alt"></i>
                                            </a>
                                            <form id="bookmark-form-{{ $job->id }}" action="{{ route('public.account.jobs.saved.action') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--end job-box-->

                @empty
                    <div class="alert alert-warning my-2">
                        {{ __('No job found') }}
                    </div>
                @endforelse
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-4 pt-2">
                {!! $jobs->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            </div>
        </div>
    </div>
</section>
<!-- START BOOKMARKS -->
