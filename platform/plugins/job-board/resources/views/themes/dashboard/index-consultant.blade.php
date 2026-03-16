@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
    @php
        $account = auth('account')->user();
    @endphp

    <div class="row mb-4 align-items-stretch">
        <div class="col-12">
            <x-core::stat-widget class="mb-0 row-cols-1 row-cols-sm-2 row-cols-md-3 h-100">
                <x-core::stat-widget.item
                    :label="trans('plugins/job-board::dashboard.jobs_label')"
                    :value="$totalJobs"
                    icon="ti ti-briefcase"
                    color="primary"
                />

                <x-core::stat-widget.item
                    :label="trans('plugins/job-board::dashboard.companies_label')"
                    :value="$totalcompanies"
                    icon="ti ti-building"
                    color="success"
                />

                <x-core::stat-widget.item
                    :label="trans('plugins/job-board::dashboard.applicants_label')"
                    :value="$totalApplicants"
                    icon="ti ti-users-group"
                    color="danger"
                />
            </x-core::stat-widget>
        </div>
    </div>

    <div class="row row-cards mb-3">
        <div class="col-lg-6">
            <x-core::card>
                <x-core::card.header>
                    <x-core::card.title>
                        {{ trans('plugins/job-board::dashboard.new_applicants') }}
                    </x-core::card.title>
                </x-core::card.header>
                <div class="list-group list-group-flush">
                    @forelse ($newApplicants as $applicant)
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col text-truncate">
                                    <a href="{{ route('public.account.applicants.edit', $applicant->id) }}" class="text-reset d-block">{{ $applicant->full_name }}</a>
                                    <div class="d-block text-secondary text-truncate mt-n1">{{ $applicant->email }}</div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('public.account.applicants.edit', $applicant->id) }}" class="list-group-item-actions" title="{{ trans('plugins/job-board::dashboard.view_label') }}">
                                        <x-core::icon name="ti ti-eye" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-core::empty-state
                            :title="trans('plugins/job-board::dashboard.no_new_applicants')"
                            :subtitle="trans('plugins/job-board::dashboard.no_new_applicants_subtitle')"
                        />
                    @endforelse
                </div>
            </x-core::card>
        </div>
        <div class="col-lg-6">
            <x-core::card>
                <x-core::card.header>
                    <x-core::card.title>
                        {{ trans('plugins/job-board::dashboard.recent_activities') }}
                    </x-core::card.title>
                </x-core::card.header>
                <div class="list-group list-group-flush">
                    @forelse ($activities as $activity)
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col text-truncate">
                                    <div class="d-block text-secondary text-truncate">{!! BaseHelper::clean($activity->getDescription(false)) !!}</div>
                                </div>
                                <div class="col-auto">
                                    <div class="d-flex align-items-center gap-1">
                                        <x-core::icon name="ti ti-clock" />
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-core::empty-state
                            :title="trans('plugins/job-board::dashboard.no_recent_activities')"
                            :subtitle="trans('plugins/job-board::dashboard.no_recent_activities_subtitle')"
                        />
                    @endforelse
                </div>
            </x-core::card>
        </div>
    </div>

    <x-core::card>
        <x-core::card.header>
            <x-core::card.title>
                {{ trans('plugins/job-board::dashboard.jobs_about_to_expire') }}
            </x-core::card.title>
        </x-core::card.header>
        <div class="table-responsive">
            <x-core::table>
                <x-core::table.header>
                    <x-core::table.header.cell>
                        {{ trans('plugins/job-board::dashboard.job_name_label') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell>
                        {{ trans('plugins/job-board::dashboard.company_label') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell>
                        {{ trans('plugins/job-board::dashboard.expire_date_label') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell>
                        {{ trans('plugins/job-board::dashboard.status_label') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell>
                        {{ trans('plugins/job-board::dashboard.total_applicants_label') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell>
                        {{ trans('plugins/job-board::dashboard.actions_label') }}
                    </x-core::table.header.cell>
                </x-core::table.header>
                <x-core::table.body>
                    @foreach ($expiredJobs as $job)
                        <x-core::table.body.row>
                            <x-core::table.body.cell>
                                <a class="fw-bold" href="{{ route('public.account.jobs.edit', $job->id) }}">
                                    {{ $job->name }}
                                </a>
                            </x-core::table.body.cell>
                            <x-core::table.body.cell>
                                {{ $job->company->name }}
                            </x-core::table.body.cell>
                            <x-core::table.body.cell>
                                {{ BaseHelper::formatDate($job->expire_date) }}
                            </x-core::table.body.cell>
                            <x-core::table.body.cell>
                                {!! $job->status->toHtml() !!}
                            </x-core::table.body.cell>
                            <x-core::table.body.cell>
                                {{ $job->applicants_count }}
                            </x-core::table.body.cell>
                            <x-core::table.body.cell>
                                <div class="btn-list">
                                    <x-core::button
                                        tag="a"
                                        color="primary"
                                        icon="ti ti-edit"
                                        size="sm"
                                        :icon-only="true"
                                        :href="route('public.account.jobs.edit', $job->id)"
                                        data-bs-toggle="tooltip"
                                        title="{{ trans('plugins/job-board::dashboard.view_label') }}"
                                    />
                                </div>
                            </x-core::table.body.cell>
                        </x-core::table.body.row>
                    @endforeach
                </x-core::table.body>
            </x-core::table>
        </div>
    </x-core::card>
@stop

