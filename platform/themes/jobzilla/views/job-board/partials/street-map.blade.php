@if ($job->latitude && $job->longitude)
    <div>
        <h4 class="twm-s-title">{{ __('Location') }}</h4>
        <div class="job-board-street-map-container">
            <div class="job-board-street-map"
                data-popup-id="#street-map-popup-template"
                data-center="{{ json_encode([$job->latitude, $job->longitude]) }}"
                data-map-icon="{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}"></div>
        </div>
        <div class="d-none" id="street-map-popup-template">
            <div>
                <table width="100%">
                    <tr>
                        <td width="40">
                            <div >
                                <img src="{{ $job->company_logo_thumb }}" width="40" alt="{{ $job->company_name ?: $job->name }}">
                            </div>
                        </td>
                        <td>
                            <div class="infomarker">
                                @if ($job->has_company)
                                    <h5>
                                        <a href="{{ $company->url }}" target="_blank">{{ $company->name }} {!! $company->badge !!}</a>
                                    </h5>
                                @endif
                                <div class="text-info">
                                    <strong>{{ $job->name }}</strong>
                                </div>
                                <div class="text-info">
                                    <i class="mdi mdi-account"></i>
                                    <span>{{ __(':number Vacancy', ['number' => $job->number_of_positions])}}</span>
                                    @if ($job->jobTypes->count())
                                        <span>-</span>
                                        @foreach($job->jobTypes as $jobType)
                                            <span>{{ $jobType->name }}@if (!$loop->last), @endif</span>
                                        @endforeach
                                    @endif
                                </div>
                                @if ($job->full_address)
                                    <div class="text-muted">
                                        <i class="uil uil-map"></i>
                                        <span>{{ $job->full_address }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endif
