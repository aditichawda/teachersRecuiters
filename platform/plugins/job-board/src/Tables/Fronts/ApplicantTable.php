<?php

namespace Botble\JobBoard\Tables\Fronts;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobApplication;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\Action;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class ApplicantTable extends TableAbstract
{
    protected bool $bStateSave = false;

    protected array $defaultVisibleColumns = ['id', 'first_name', 'email', 'phone', 'status', 'job_id', 'created_at'];

    public function setup(): void
    {
        $this
            ->model(JobApplication::class)
            ->addActions([
                Action::make('view')
                    ->route('public.account.applicants.edit')
                    ->label(trans('plugins/job-board::messages.view'))
                    ->icon('ti ti-eye')
                    ->color('primary'),
            ]);
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
                try {
                    $url = $job->url ?? '#';
                    return Html::link(
                        $url,
                        $job->name . ' ' . BaseHelper::renderIcon('ti ti-external-link'),
                        ['target' => '_blank'],
                        null,
                        false
                    );
                } catch (\Throwable $e) {
                    return e($job->name);
                }
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
                    $rawStatus = $item->status?->getValue() ?? $item->getAttribute('status') ?? 'pending';
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
                        if (strpos((string) $label, 'plugins/job-board::') === 0) {
                            $label = ucfirst(str_replace('_', ' ', $val));
                        }
                        return '<option value="' . e($val) . '"' . ($val === $current ? ' selected' : '') . '>' . e($label) . '</option>';
                    })->implode('');
                    return '<select class="form-select form-select-sm applicant-status-select" data-id="' . $item->id . '" data-url="' . e($updateUrl) . '" style="min-width:140px;">' . $options . '</select>';
                } catch (\Throwable $e) {
                    return e($item->getAttribute('status') ?? '—');
                }
            });

        $data = $data
            ->filter(function ($query) {
                if ($keyword = $this->request->input('search.value')) {
                    $keyword =  '%' . $keyword . '%';

                    return $query
                        ->whereHas('job', function ($query) use ($keyword) {
                            return $query->where('name', 'LIKE', $keyword);
                        })
                        ->orWhereHas('job.company', function ($query) use ($keyword) {
                            return $query
                                ->where('account_id', auth('account')->id())
                                ->where('name', 'LIKE', $keyword);
                        })
                        ->orWhere('email', 'LIKE', $keyword)
                        ->orWhere('phone', 'LIKE', $keyword);
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
            IdColumn::make(),
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
            Column::make('email')
                ->title(trans('plugins/job-board::job-application.tables.email'))
                ->alignLeft(),
            Column::make('phone')
                ->title(trans('plugins/job-board::job-application.tables.phone'))
                ->alignLeft(),
            Column::make('status')
                ->title(trans('plugins/job-board::job-application.tables.status'))
                ->orderable(true)
                ->searchable(false)
                ->width(160)
                ->visible(true)
                ->columnVisibility(true),
            Column::make('job_id')
                ->title(trans('plugins/job-board::messages.job_name'))
                ->alignLeft(),
            CreatedAtColumn::make(),
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
