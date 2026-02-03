<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Date Posted') }}</h4>
    <ul>
        <li>
            <div class="form-check">
                <input type="radio" name="date_posted" class="form-check-input" id="date-posted-all" @checked(! request()->input('date_posted'))>
                <label class="form-check-label" for="date-posted-all">{{ __('All') }}</label>
            </div>
        </li>
        @foreach (JobBoardHelper::postedDateRanges() as $key => $item)
            <li>
                <div class="form-check">
                    <input type="radio" name="date_posted" value="{{ $key }}" class="form-check-input" id="date-posted-{{ $key }}" @checked($key == request()->input('date_posted'))>
                    <label class="form-check-label" for="date-posted-{{ $key }}">{{ $item['name'] }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
