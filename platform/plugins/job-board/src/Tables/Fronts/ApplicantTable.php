<?php

namespace Botble\JobBoard\Tables\Fronts;

use Botble\Base\Facades\BaseHelper;
use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Tables\Fronts\BulkActions\ExportResumesBulkAction;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\Action;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\FormattedColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ApplicantTable extends TableAbstract
{
    protected bool $bStateSave = false;

    protected string $filterTemplate = 'plugins/job-board::themes.dashboard.table.applicant-filter';

    protected array $defaultVisibleColumns = ['first_name', 'job_id', 'email', 'created_at', 'status'];

    public function setup(): void
    {
        $this->hasResponsive = false;

        $this
            ->model(JobApplication::class)
            ->addBulkAction(new ExportResumesBulkAction())
            ->addActions([
                Action::make('view')
                    ->route('public.account.applicants.edit')
                    ->label(trans('plugins/job-board::messages.view'))
                    ->icon('ti ti-eye')
                    ->color('primary'),
                Action::make('download_cv')
                    ->label(trans('plugins/job-board::job-application.tables.download_resume'))
                    ->icon('ti ti-download')
                    ->color('secondary')
                    ->url(fn ($action) => route('public.account.applicants.download-cv', $action->getItem()->id))
                    ->openUrlInNewTable(true),
            ]);
    }

    public function getFilters(): array
    {
        $account = auth('account')->user();
        $jobChoices = ['' => trans('core/table::table.select_field')];
        if ($account) {
            $jobIds = JobApplication::query()
                ->whereHas('job.company.accounts', fn (Builder $q) => $q->where('account_id', $account->getKey()))
                ->distinct()
                ->pluck('job_id')
                ->filter()
                ->values();
            $jobs = Job::query()
                ->whereIn('id', $jobIds)
                ->orderBy('name')
                ->get(['id', 'name']);
            $counts = JobApplication::query()
                ->whereHas('job.company.accounts', fn (Builder $q) => $q->where('account_id', $account->getKey()))
                ->whereIn('job_id', $jobIds)
                ->selectRaw('job_id, count(*) as total')
                ->groupBy('job_id')
                ->pluck('total', 'job_id');
            foreach ($jobs as $job) {
                $count = $counts->get($job->id, 0);
                $label = $job->name . ' (ID: ' . $job->id . ')' . ($count > 0 ? ' - ' . $count . ' ' . trans('plugins/job-board::job-application.tables.applicants', ['count' => $count]) : '');
                $jobChoices[$job->id] = $label;
            }
        }
        return [
            'job_id' => [
                'title' => trans('plugins/job-board::dashboard.filter_by_job'),
                'type' => 'select',
                'choices' => $jobChoices,
            ],
            'status' => [
                'title' => trans('plugins/job-board::dashboard.filter_by_status'),
                'type' => 'select',
                'choices' => array_merge(['' => trans('core/table::table.select_field')], JobApplicationStatusEnum::labels()),
            ],
            'created_at_from' => [
                'title' => trans('plugins/job-board::dashboard.filter_date_from'),
                'type' => 'datePicker',
            ],
            'created_at_to' => [
                'title' => trans('plugins/job-board::dashboard.filter_date_to'),
                'type' => 'datePicker',
            ],
        ];
    }

    public function applyFilterCondition(
        \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Relations\Relation $query,
        string $key,
        string $operator,
        ?string $value
    ) {
        if ($value === null || $value === '') {
            return $query;
        }
        $key = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '', $key));
        $table = $this->getModel()->getTable();

        if ($key === 'job_id') {
            $jobId = (int) $value;
            if ($jobId > 0) {
                $query->where($table . '.job_id', '=', $jobId);
            }

            return $query;
        }
        if ($key === 'status' && $value !== '') {
            $query->where($table . '.status', '=', $value);

            return $query;
        }
        if ($key === 'created_at_from' && $value) {
            $validator = Validator::make([$key => $value], [$key => ['date']]);
            if (! $validator->fails()) {
                $query->whereDate($table . '.created_at', '>=', BaseHelper::formatDate($value));
            }
            return $query;
        }
        if ($key === 'created_at_to' && $value) {
            $validator = Validator::make([$key => $value], [$key => ['date']]);
            if (! $validator->fails()) {
                $query->whereDate($table . '.created_at', '<=', BaseHelper::formatDate($value));
            }
            return $query;
        }

        return parent::applyFilterCondition($query, $key, $operator, $value);
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('job_id', function (JobApplication $item) {
                $job = $item->relationLoaded('job') ? $item->job : null;
                if (! $job || ! $job->name) {
                    return '&mdash;';
                }
                return e($job->name);
            })
            ->editColumn('is_external_apply', function (JobApplication $item) {
                return $item->is_external_apply ? trans('plugins/job-board::messages.external') : trans('plugins/job-board::messages.internal');
            })
            ->editColumn('company', function (JobApplication $item) {
                $job = $item->relationLoaded('job') ? $item->job : null;
                $company = $job && $job->relationLoaded('company') ? $job->company : null;
                return ($company && $company->name) ? e($company->name) : '&mdash;';
            })
            ->editColumn('status', function (JobApplication $item) {
                try {
                    $rawStatus = $item->getRawOriginal('status') ?? $item->getAttribute('status');
                    if (is_object($rawStatus) && method_exists($rawStatus, 'getValue')) {
                        $rawStatus = $rawStatus->getValue();
                    }
                    $rawStatus = $rawStatus ?? 'pending';
                    $rawStatus = is_string($rawStatus) ? $rawStatus : 'pending';
                    $validStatuses = ['pending', 'hired', 'rejected', 'short_list'];
                    $current = in_array($rawStatus, $validStatuses) ? $rawStatus : 'pending';
                    $updateUrl = route('public.account.applicants.update', $item->id);
                    $statusLabels = [
                        'pending' => trans('plugins/job-board::job-application.statuses.pending'),
                        'hired' => trans('plugins/job-board::job-application.statuses.hired'),
                        'rejected' => trans('plugins/job-board::job-application.statuses.rejected'),
                        'short_list' => trans('plugins/job-board::job-application.statuses.short_list'),
                    ];
                    $options = collect($validStatuses)->map(function ($val) use ($current, $statusLabels) {
                        $label = $statusLabels[$val] ?? ucfirst(str_replace('_', ' ', $val));
                        if (is_string($label) && strpos($label, 'plugins/job-board::') === 0) {
                            $label = ucfirst(str_replace('_', ' ', $val));
                        }
                        return '<option value="' . e($val) . '"' . ($val === $current ? ' selected' : '') . '>' . e($label) . '</option>';
                    })->implode('');
                    return '<select class="form-select form-select-sm applicant-status-select" data-id="' . $item->id . '" data-url="' . e($updateUrl) . '" style="max-width:140px;">' . $options . '</select>';
                } catch (\Throwable $e) {
                    return e($item->getRawOriginal('status') ?? $item->getAttribute('status') ?? '—');
                }
            })
            ->editColumn('created_at', function (JobApplication $item) {
                $date = $item->created_at;
                return $date ? BaseHelper::formatDate($date) : '—';
            });

        $data = $data
            ->filter(function ($query) {
                if ($keyword = $this->request->input('search.value')) {
                    $rawKeyword = trim($keyword);
                    if ($rawKeyword === '') {
                        return $query;
                    }
                    $keyword = '%' . $rawKeyword . '%';
                    $table = $this->getModel()->getTable();
                    // Search within logged-in employer's data only; include job_id (exact when numeric) and job name
                    return $query->where(function (Builder $q) use ($keyword, $rawKeyword, $table) {
                        $q->where($table . '.first_name', 'LIKE', $keyword)
                            ->orWhere($table . '.last_name', 'LIKE', $keyword)
                            ->orWhere($table . '.email', 'LIKE', $keyword)
                            ->orWhere($table . '.phone', 'LIKE', $keyword)
                            ->orWhereHas('job', fn (Builder $job) => $job->where('name', 'LIKE', $keyword))
                            ->orWhereHas('job.company', fn (Builder $company) => $company->where('name', 'LIKE', $keyword));
                        if (is_numeric($rawKeyword) && (int) $rawKeyword > 0) {
                            $q->orWhere($table . '.job_id', '=', (int) $rawKeyword);
                        }
                    });
                }

                return $query;
            });

        return $this->toJson($data);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $query = $this
            ->getModel()
            ->query()
            ->select([
                'id',
                'job_id',
                'account_id',
                'first_name',
                'last_name',
                'email',
                'phone',
                'created_at',
                'is_external_apply',
                'status',
            ])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->with([
                'account',
                'job:id,name,company_id',
                'job.slugable',
                'job.company:id,name',
            ]);

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            FormattedColumn::make('first_name')
                ->title(trans('plugins/job-board::job-application.tables.name'))
                ->alignLeft()
                ->getValueUsing(function (FormattedColumn $column) {
                    try {
                        $jobApplication = $column->getItem();
                        $name = $jobApplication->full_name ?: '&mdash;';

                        if ($jobApplication->is_external_apply) {
                            $url = route('public.account.applicants.edit', $jobApplication->id);
                            return '<a href="' . e($url) . '" class="text-primary text-decoration-none">' . e($name) . '</a>';
                        }

                        $account = $jobApplication->relationLoaded('account') ? $jobApplication->account : null;
                        if ($account && $account->getKey() && $account->is_public_profile && ! empty($account->url)) {
                            return '<a href="' . e($account->url) . '" target="_blank" class="text-primary text-decoration-none">' . e($account->name) . ' ' . BaseHelper::renderIcon('ti ti-external-link') . '</a>';
                        }

                        $url = route('public.account.applicants.edit', $jobApplication->id);
                        return '<a href="' . e($url) . '" class="text-primary text-decoration-none">' . e($name) . '</a>';
                    } catch (\Throwable $e) {
                        return '&mdash;';
                    }
                }),
            Column::make('job_id')
                ->title(trans('plugins/job-board::dashboard.applied_for_job'))
                ->alignLeft()
                ->visible(true)
                ->orderable(false),
            Column::make('email')
                ->title(trans('plugins/job-board::job-application.tables.email'))
                ->alignLeft()
                ->visible(true)
                ->width(100),
            CreatedAtColumn::make()
                ->title(trans('plugins/job-board::dashboard.applied_at'))
                ->visible(true),
            Column::make('status')
                ->title(trans('plugins/job-board::job-application.tables.status'))
                ->orderable(true)
                ->searchable(false)
                ->width(160)
                ->visible(true)
                ->columnVisibility(true),
        ];
    }

    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
