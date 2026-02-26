<div class="jd-content-card" style="margin-top: 24px;">
    <h4 class="jd-section-title">{{ __('Location') }}</h4>
    @if ($job->latitude && $job->longitude)
        <div class="job-board-street-map-container" style="margin-top: 16px; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
            <div class="job-board-street-map" style="width: 100%; height: 400px; min-height: 400px;"
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
    @else
        <div style="margin-top: 16px; padding: 20px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
            @if ($job->full_address)
                <p style="margin: 0; color: #475569; font-size: 15px;">
                    <i class="fas fa-map-marker-alt" style="color: #0ea5e9; margin-right: 8px;"></i>
                    {{ $job->full_address }}
                </p>
            @elseif ($job->location)
                <p style="margin: 0; color: #475569; font-size: 15px;">
                    <i class="fas fa-map-marker-alt" style="color: #0ea5e9; margin-right: 8px;"></i>
                    {{ $job->location }}
                </p>
            @else
                <p style="margin: 0; color: #94a3b8; font-size: 14px;">
                    {{ __('Location information not available') }}
                </p>
            @endif
        </div>
    @endif
</div>
