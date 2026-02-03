<div class="twm-bnr-search-bar">
    {!! Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET']) !!}
        <div class="row">
            <div class="form-group col-xl-3 col-lg-6 col-md-6">
                <label>{{ __('What') }}</label>
                <select class="wt-search-bar-select selectpicker" name="job_categories[]">
                    <option disabled selected value="">{{ __('Select Category') }}</option>
                    @foreach (app(\Botble\JobBoard\Repositories\Interfaces\CategoryInterface::class)->allBy(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED]) as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xl-3 col-lg-6 col-md-6">
                <label>{{ __('Type') }}</label>
                <select class="wt-search-bar-select selectpicker" name="job_types[]">
                    <option disabled selected value="">{{ __('Select Job Type') }}</option>
                    @foreach (app(\Botble\JobBoard\Repositories\Interfaces\JobTypeInterface::class)->allBy(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED]) as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (is_plugin_active('location'))
                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                    <label>{{ __('Location') }}</label>
                    <select name="city_id" class="wt-search-bar-select selectpicker-location">
                        <option value="">{{ __('Select City') }}</option>
                    </select>
                </div>
            @endif

            <div class="form-group col-xl-3 col-lg-6 col-md-6">
                <button type="submit" class="site-button">{{ __('Find Job') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
