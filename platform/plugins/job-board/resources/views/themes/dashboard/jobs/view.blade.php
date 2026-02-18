@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
    <div class="mb-4">
        <a href="{{ route('public.account.jobs.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left"></i> {{ trans('plugins/job-board::messages.manage_jobs') }}
        </a>
    </div>

    @php
        $fullDescription = $job->description || $job->content ? trim(($job->description ?? '') . "\n" . ($job->content ? strip_tags(BaseHelper::clean($job->content)) : '')) : '';
        $hasLongDescription = strlen($fullDescription) > 150;
    @endphp
    {{-- Job Title, Basic Info & Description (single card) --}}
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                {{ $job->name }}
            </x-core::card.title>
            @if($hasLongDescription)
                <button type="button" class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#jobDescriptionModal">
                    {{ __('View full description') }}
                </button>
            @endif
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
            @if($job->description || $job->content)
            <div class="mt-4 pt-3 border-top">
                <strong class="d-block mb-2">{{ __('Description') }}</strong>
                <div class="job-description-wrap text-muted" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5; font-size: 14px;">
                    @if($job->description)
                        <p class="mb-2">{{ $job->description }}</p>
                    @endif
                    @if($job->content)
                        <div class="job-content">
                            {!! BaseHelper::clean($job->content) !!}
                        </div>
                    @endif
                </div>
                @if($hasLongDescription)
                    <button type="button" class="btn btn-sm btn-link text-primary px-0 mt-2" data-bs-toggle="modal" data-bs-target="#jobDescriptionModal">
                        {{ __('View more') }}
                    </button>
                @endif
            </div>
            @endif
        </x-core::card.body>
    </x-core::card>

    @if($hasLongDescription)
    <div class="modal fade" id="jobDescriptionModal" tabindex="-1" aria-labelledby="jobDescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobDescriptionModalLabel">{{ __('Description') }} - {{ $job->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    @if($job->description)
                        <p class="text-muted mb-3">{{ $job->description }}</p>
                    @endif
                    @if($job->content)
                        <div class="job-content">{!! BaseHelper::clean($job->content) !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
                                <th>{{ trans('plugins/job-board::job-application.tables.status') }}</th>
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
                                        @php
                                            $statusVal = $application->status?->getValue() ?? 'pending';
                                            $statusLabels = [
                                                'pending' => trans('plugins/job-board::job-application.statuses.pending'),
                                                'short_list' => trans('plugins/job-board::job-application.statuses.short_list'),
                                                'hired' => trans('plugins/job-board::job-application.statuses.hired'),
                                                'rejected' => trans('plugins/job-board::job-application.statuses.rejected'),
                                            ];
                                            $statusLabel = $statusLabels[$statusVal] ?? 'Pending';
                                            if (strpos($statusLabel, 'plugins/job-board::') === 0) {
                                                $statusLabel = ucfirst(str_replace('_', ' ', $statusVal));
                                            }
                                            $badgeClass = match($statusVal) {
                                                'hired' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                'short_list' => 'bg-info',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} text-white">{{ $statusLabel }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('public.account.applicants.edit', $application->id) }}" class="btn btn-sm btn-primary" title="{{ trans('plugins/job-board::messages.view') }}">
                                            <i class="fa fa-eye"></i>
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

    @if($applications->isNotEmpty())
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('change', function(e) {
            var el = e.target;
            if (el.classList && el.classList.contains('applicant-status-select')) {
                var url = el.getAttribute('data-url');
                var status = el.value;
                var formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('status', status);
                fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (typeof Botble !== 'undefined' && data.error === false) {
                            Botble.showSuccess(data.message || '{{ __("Updated successfully") }}');
                        } else if (data.error) {
                            Botble.showError(data.message || '{{ __("Update failed") }}');
                        }
                    })
                    .catch(function() {
                        if (typeof Botble !== 'undefined') Botble.showError('{{ __("Update failed") }}');
                    });
            }
        });
    });
    </script>
    @endif
@stop
