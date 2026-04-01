<section class="section">
    <div class="container">
        <div class="row align-items-center mb-4">
            <div class="col-lg-7">
                <div class="mb-3 mb-lg-0">
                    @if ($companies->total())
                        <h6 class="fs-16 mb-0">
                            {{ __('Showing :from – :to of :total results', [
                                'from' => $companies->firstItem(),
                                'to' => $companies->lastItem(),
                                'total' => $companies->total(),
                            ]) }}
                        </h6>
                    @endif
                </div>
            </div>

            <div class="col-lg-5">
                <div class="candidate-list-widgets">
                    {!! Form::open(['method' => 'GET']) !!}
                    <div class="row justify-content-end">
                        <div class="col-5">
                            <div class="filler-job-form">
                                <i class="mdi mdi-account-search"></i>
                                <input
                                    class="form-control filter-job-input-box"
                                    name="keyword"
                                    type="search"
                                    value="{{ BaseHelper::stringify(request()->query('keyword')) }}"
                                    placeholder="{{ __('Keyword...') }}"
                                >
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="selection-widget">
                                <select
                                    class="form-select"
                                    id="choices-single-filter-order_by"
                                    name="order_by"
                                    data-trigger
                                    aria-label="Default select example"
                                >
                                    @foreach (JobBoardHelper::getSortByParams() as $key => $label)
                                        <option
                                            value="{{ $key }}"
                                            @selected(request()->input('order_by') == $key)
                                        >{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-outline-primary">
                                <i class="uil uil-search"></i>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($companies as $company)
                @include(Theme::getThemeNamespace('views.job-board.partials.company-item'), [
                    'company' => $company,
                ])
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12 mt-5">
                {!! $companies->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            </div>
        </div>
    </div>
</section>
