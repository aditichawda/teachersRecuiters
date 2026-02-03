@if ($company->latitude && $company->longitude)
    <div>
        <h4 class="twm-s-title">{{ __('Location') }}</h4>
        <div class="job-board-street-map-container">
            <div class="job-board-street-map"
                 data-popup-id="#street-map-popup-template"
                 data-center="{{ json_encode([$company->latitude, $company->longitude]) }}"
                 data-map-icon="{{ $company->name }}"></div>
        </div>
        <div class="d-none" id="street-map-popup-template">
            <div>
                <table width="100%">
                    <tr>
                        <td width="40">
                            <div >
                                <img src="{{ $company->logo_thumb }}" width="40" alt="{{ $company->name }}">
                            </div>
                        </td>
                        <td>
                            <div class="infomarker">
                                <h5>
                                    <a href="{{ $company->url }}" target="_blank"> {{ $company->name }}</a>
                                </h5>
                                <div class="text-info">
                                    <strong> {{ __(':number Offices', ['number' => $company->number_of_offices])}}</strong>
                                </div>
                                <div class="text-info">
                                    <i class="mdi mdi-account"></i>
                                    <span> {{ __(':number Employees', ['number' => $company->number_of_employees])}}</span>
                                </div>
                                @if ($company->full_address)
                                    <div class="text-muted">
                                        <i class="uil uil-map"></i>
                                        <span>{{ $company->full_address }}</span>
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
