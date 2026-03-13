<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\DedicatedRecruiterRequest;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class DedicatedRecruiterRequestTable extends TableAbstract
{
    public function setup(): void
    {
        $this->model(DedicatedRecruiterRequest::class);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->query()->select(['*'])->with(['account:id,first_name,last_name,email', 'company:id,name']);

        if ($keyword = $this->request()->input('search.value')) {
            $keyword = '%' . $keyword . '%';
            $query->where(function (Builder $q) use ($keyword) {
                $q->whereHas('account', fn ($b) => $b->where('first_name', 'LIKE', $keyword)
                    ->orWhere('last_name', 'LIKE', $keyword)
                    ->orWhere('email', 'LIKE', $keyword));
            });
        }

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            Column::make('account_id')
                ->title(__('Employer Name'))
                ->orderable(false)
                ->formatUsing(function ($value, DedicatedRecruiterRequest $item) {
                    $a = $item->account;
                    if (! $a) {
                        return '—';
                    }
                    $name = trim(e($a->first_name . ' ' . $a->last_name)) ?: e($a->email);
                    return $name . ' <span class="text-muted">(ID: ' . (int) $a->id . ')</span>';
                }),
            Column::make('employer_id')
                ->title(__('Employer Id'))
                ->orderable(false)
                ->formatUsing(fn ($_, DedicatedRecruiterRequest $item) => (int) $item->account_id),
            Column::make('requested_at')
                ->title(__('Request Date'))
                ->dateFormat(),
            Column::make('duration_months')
                ->title(__('Duration'))
                ->formatUsing(fn ($v) => $v ? $v . ' ' . __('month(s)') : '—'),
            Column::make('staff_id')
                ->title(__('Staff'))
                ->orderable(false)
                ->formatUsing(fn ($v) => $v ?: '—'),
            Column::make('status')
                ->title(__('Status'))
                ->formatUsing(fn ($v) => ucfirst($v ?? 'pending')),
            Column::make('actions')
                ->title(__('Actions'))
                ->orderable(false)
                ->searchable(false)
                ->formatUsing(function ($_, DedicatedRecruiterRequest $item) {
                    if ($item->status !== DedicatedRecruiterRequest::STATUS_PENDING) {
                        return '<span class="badge bg-secondary">' . ucfirst($item->status) . '</span>';
                    }
                    $accept = route('dedicated-recruiter-requests.accept', $item->id);
                    $reject = route('dedicated-recruiter-requests.reject', $item->id);
                    $csrf = csrf_field();
                    return '<form method="post" action="' . e($accept) . '" class="d-inline me-1">' . $csrf . '<button type="submit" class="btn btn-sm btn-success">' . __('Accept') . '</button></form>' .
                        '<form method="post" action="' . e($reject) . '" class="d-inline">' . $csrf . '<button type="submit" class="btn btn-sm btn-danger">' . __('Reject') . '</button></form>';
                }),
            CreatedAtColumn::make(),
        ];
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table->eloquent($this->query());
        // Do not escape so Action (Accept/Reject) HTML renders (admin-only table)
        return $this->toJson($data, []);
    }

    public function buttons(): array
    {
        return [];
    }
}
