<div class="twm-bnr-search-bar">
    {!! Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET']) !!}
        <div class="row">
            <div class="form-group col-xl-4 col-lg-5 col-md-6">
                <label>{{ __('Keyword') }}</label>
                <select class="wt-search-bar-select selectpicker-keyword" name="job_categories[]">
                    <option value="">{{ __('Type to search...') }}</option>
                    @foreach (app(\Botble\JobBoard\Repositories\Interfaces\CategoryInterface::class)->allBy(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED]) as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (is_plugin_active('location'))
                <div class="form-group col-xl-4 col-lg-5 col-md-6">
                    <label>{{ __('Location') }}</label>
                    <select name="city_id" class="wt-search-bar-select selectpicker-location">
                        <option value="">{{ __('Select Your Location') }}</option>
                    </select>
                </div>
            @endif

            <div class="form-group col-xl-4 col-lg-2 col-md-12">
                <button type="submit" class="site-button">{{ __('Find Job') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
