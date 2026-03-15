<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\JobPostingAssistanceRequest;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class JobPostingAssistanceRequestTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(JobPostingAssistanceRequest::class)
            ->addActions([
                EditAction::make()->route('job-posting-assistance-requests.edit')->permission('job-posting-assistance-requests.index'),
                DeleteAction::make()->route('job-posting-assistance-requests.destroy')->permission('job-posting-assistance-requests.index'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->query()->select(['*'])->with(['account:id,first_name,last_name,email', 'company:id,name']);

        if ($keyword = $this->request()->input('search.value')) {
            $keyword = '%' . $keyword . '%';
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('institution_name', 'LIKE', $keyword)
                    ->orWhere('message', 'LIKE', $keyword)
                    ->orWhereHas('account', fn ($b) => $b->where('first_name', 'LIKE', $keyword)
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
            FormattedColumn::make('account_id')
                ->title(__('Employer'))
                ->orderable(false)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $a = $item->account;
                    if (! $a) {
                        return '—';
                    }
                    $name = trim($a->first_name . ' ' . $a->last_name) ?: $a->email;
                    return e($name);
                }),
            FormattedColumn::make('company_id')
                ->title(__('Institution'))
                ->orderable(false)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $c = $item->company;
                    if (! $c) {
                        return '—';
                    }
                    return e($c->name);
                }),
            FormattedColumn::make('institution_name')
                ->title(__('Institution Name'))
                ->orderable(false)
                ->getValueUsing(function (FormattedColumn $column) {
                    $v = $column->getOriginalValue();
                    return $v ? e($v) : '—';
                }),
            FormattedColumn::make('message')
                ->title(__('Message'))
                ->limit(40)
                ->orderable(false),
            FormattedColumn::make('status')
                ->title(__('Status'))
                ->orderable(true)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $status = $item->status ?? 'pending';
                    $badge = match ($status) {
                        JobPostingAssistanceRequest::STATUS_ACCEPTED => 'bg-success',
                        JobPostingAssistanceRequest::STATUS_REJECTED => 'bg-danger',
                        default => 'bg-warning text-dark',
                    };
                    return '<span class="badge ' . $badge . '">' . ucfirst($status) . '</span>';
                }),
            FormattedColumn::make('actions')
                ->title(__('Actions'))
                ->orderable(false)
                ->searchable(false)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $createJobUrl = $item->company_id ? route('jobs.create', ['company_id' => $item->company_id]) : null;
                    if ($item->status !== JobPostingAssistanceRequest::STATUS_PENDING) {
                        if ($createJobUrl) {
                            return '<a href="' . e($createJobUrl) . '" class="btn btn-sm btn-outline-primary">' . __('Create Job') . '</a>';
                        }
                        return '—';
                    }
                    $accept = route('job-posting-assistance-requests.accept', $item->id);
                    $reject = route('job-posting-assistance-requests.reject', $item->id);
                    $csrf = csrf_field();
                    $out = '<form method="post" action="' . e($accept) . '" class="d-inline me-1">' . $csrf . '<button type="submit" class="btn btn-sm btn-success">' . __('Accept') . '</button></form>';
                    $out .= '<form method="post" action="' . e($reject) . '" class="d-inline me-1">' . $csrf . '<button type="submit" class="btn btn-sm btn-danger">' . __('Reject') . '</button></form>';
                    if ($createJobUrl) {
                        $out .= ' <a href="' . e($createJobUrl) . '" class="btn btn-sm btn-outline-primary">' . __('Create Job') . '</a>';
                    }
                    return $out;
                }),
            CreatedAtColumn::make(),
        ];
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table->eloquent($this->query());
        return $this->toJson($data, []);
    }

    public function buttons(): array
    {
        return [];
    }
}
