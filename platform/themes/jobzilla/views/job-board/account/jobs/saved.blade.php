@php
    Theme::asset()->container('footer')->scriptUsingPath('jquery.dataTables', 'plugins/js/jquery.dataTables.min.js');
    Theme::asset()->container('footer')->scriptUsingPath('datatables-js', 'plugins/js/dataTables.bootstrap5.min.js');
    Theme::asset()->styleUsingPath('dataTables-css', 'plugins/css/dataTables.bootstrap5.min.css');
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <div class="row">
        <div class="twm-right-section-panel candidate-save-job site-bg-gray">
            @if ($jobs->isNotEmpty())
                <div class="twm-D_table table-responsive">
                    <table id="applied_jobs_table" class="table table-bordered twm-candidate-save-job-list-wrap">
                        <thead>
                        <tr>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Salary') }}</th>
                            <th>{{ __('Expire Date') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs->all() as $job)
                            <tr>
                                <td>
                                    <div class="twm-candidate-save-job-list">
                                        @if ($job->hide_company)
                                            @if (Theme::getLogo())
                                                <div class="twm-media">
                                                    <div class="twm-media-pic">
                                                        {!! Theme::getLogoImage([], 'logo', 44) !!}
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="twm-media">
                                                <div class="twm-media-pic">
                                                    <a href="{{ $job->company->url }}">
                                                        <img src="{{ $job->company->logo_thumb }}" alt="{{ $job->company->name }}">
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="twm-mid-content">
                                            <a href="{{ $job->url }}" class="twm-job-title">
                                                <h4>{{ $job->name }}</h4>
                                            </a>
                                        </div>

                                    </div>
                                </td>
                                <td><a href="{{ $job->company->url }}">{{ $job->company->name }}</a></td>
                                <td><span>{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</span></td>
                                <td>
                                    <div>{{ $job->expire_date }}</div>
                                </td>

                                <td>
                                    <div class="twm-table-controls justify-content-center">
                                        <ul class="twm-DT-controls-icon list-unstyled px-0">
                                            <li>
                                                <a href="{{ $job->url }}" class="custom-toltip">
                                                    <span class="fa fa-eye"></span>
                                                    <span class="custom-toltip-block">{{ __('View') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Salary') }}</th>
                            <th>{{ __('Expire Date') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <p class="text-center">{{ __('No data available') }}</p>
            @endif
        </div>
    </div>
@endsection
