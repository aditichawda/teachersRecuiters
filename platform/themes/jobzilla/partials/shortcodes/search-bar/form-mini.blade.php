<div class="twm-bnr-search-bar">
    {!! Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET']) !!}
        <div class="row">
            <div class="form-group col-xl-8 col-lg-8 col-md-8">
                <label>{{ __('What') }}</label>
                <div class="twm-single-iput">
                    <input name="keyword" type="text" required class="form-control bg-none" placeholder="{{ __('Job title, Keywords, or company') }}">
                </div>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-4">
                <button type="submit" class="site-button">{{ __('Find Job') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
