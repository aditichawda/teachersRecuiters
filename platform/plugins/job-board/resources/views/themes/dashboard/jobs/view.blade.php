@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
    <div class="mb-4">
        <a href="{{ route('public.account.jobs.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left"></i> {{ trans('plugins/job-board::messages.manage_jobs') }}
        </a>
    </div>

    {{-- Job Title & Basic Info --}}
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                {{ $job->name }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body>
            <div class="row g-3">
                @if($job->company)
                <div class="col-md-6">
                    <strong>{{ trans('plugins/job-board::messages.company') }}:</strong>
                    <span>{{ $job->company->name }}</span>
                </div>
                @endif
                <div class="col-md-6">
                    <strong>{{ trans('plugins/job-board::messages.expire_date') }}:</strong>
                    {{ $job->never_expired ? __('Never') : ($job->expire_date?->format('Y-m-d') ?? '—') }}
                </div>
                <div class="col-md-6">
                    <strong>{{ trans('plugins/job-board::messages.salary_amount') }}:</strong>
                    {{ $job->salary_text ?? '—' }}
                </div>
                @if($job->jobExperience && $job->jobExperience->getKey())
                <div class="col-md-6">
                    <strong>{{ trans('plugins/job-board::forms.job_experience') }}:</strong>
                    <span>{{ $job->jobExperience->name }}</span>
                </div>
                @endif
                @php
                    $locationParts = array_filter([
                        $job->address,
                        $job->city?->name ?? null,
                        $job->state?->name ?? null,
                        $job->country?->name ?? null,
                    ]);
                @endphp
                @if(!empty($locationParts))
                <div class="col-12">
                    <strong>{{ trans('plugins/job-board::dashboard.address') }}:</strong>
                    <span>{{ implode(', ', $locationParts) }}</span>
                </div>
                @endif
                <div class="col-md-6">
                    <strong>{{ trans('plugins/job-board::general.views') }}:</strong>
                    {{ number_format($job->views ?? 0) }}
                </div>
            </div>
        </x-core::card.body>
    </x-core::card>

    @if($job->description || $job->content)
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>{{ __('Description') }}</x-core::card.title>
        </x-core::card.header>
        <x-core::card.body>
            @if($job->description)
                <p class="text-muted mb-2">{{ $job->description }}</p>
            @endif
            @if($job->content)
                <div class="job-content">
                    {!! BaseHelper::clean($job->content) !!}
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>
    @endif

    {{-- Applicants List --}}
    <x-core::card>
        <x-core::card.header>
            <x-core::card.title>
                {{ trans('plugins/job-board::job.applicants') }}
                <span class="badge bg-primary text-white">{{ $applications->total() }}</span>
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body>
            @if($applications->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ trans('plugins/job-board::job-application.tables.name') }}</th>
                                <th>{{ trans('plugins/job-board::job-application.tables.email') }}</th>
                                <th>{{ trans('plugins/job-board::messages.phone_label') }}</th>
                                <th>{{ trans('core/base::tables.created_at') }}</th>
                                <th>{{ trans('core/base::tables.operations') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>{{ $loop->iteration + ($applications->currentPage() - 1) * $applications->perPage() }}</td>
                                    <td>{{ $application->full_name }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->phone ?: '—' }}</td>
                                    <td>{{ $application->created_at?->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('public.account.applicants.edit', $application->id) }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-eye"></i> {{ trans('plugins/job-board::messages.view') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $applications->links() }}
                </div>
            @else
                <x-core::empty-state
                    :title="trans('plugins/job-board::dashboard.no_new_applicants')"
                    :subtitle="trans('plugins/job-board::dashboard.no_new_applicants_subtitle')"
                />
            @endif
        </x-core::card.body>
    </x-core::card>
@stop
