<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\WalkinDriveAdRequest;
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

class WalkinDriveAdRequestTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(WalkinDriveAdRequest::class)
            ->addActions([
                EditAction::make()->route('walkin-drive-ad-requests.edit')->permission('walkin-drive-ad-requests.index'),
                DeleteAction::make()->route('walkin-drive-ad-requests.destroy')->permission('walkin-drive-ad-requests.index'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->query()->select(['*'])->with(['account:id,first_name,last_name,email', 'company:id,name']);

        if ($keyword = $this->request()->input('search.value')) {
            $keyword = '%' . $keyword . '%';
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('message', 'LIKE', $keyword)
                    ->orWhere('placement', 'LIKE', $keyword)
                    ->orWhereHas('account', fn ($b) => $b->where('first_name', 'LIKE', $keyword)
                        ->orWhere('last_name', 'LIKE', $keyword)
                        ->orWhere('email', 'LIKE', $keyword))
                    ->orWhereHas('company', fn ($b) => $b->where('name', 'LIKE', $keyword));
            });
        }

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            FormattedColumn::make('banner_image')
                ->title(__('Image'))
                ->orderable(false)
                ->searchable(false)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $url = $item->banner_image_url
                        ?? (! empty($item->banner_image) ? \Botble\Media\Facades\RvMedia::getImageUrl($item->banner_image) : null)
                        ?? ($item->banner_image ?? null);
                    if (! $url) {
                        return '—';
                    }
                    return '<img src="' . e($url) . '" alt="" class="rounded" style="max-width:80px;max-height:50px;object-fit:cover;">';
                }),
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
            FormattedColumn::make('placement')
                ->title(__('Placement'))
                ->orderable(true)
                ->getValueUsing(function (FormattedColumn $column) {
                    $v = $column->getItem()->placement ?? '';
                    return match ($v) {
                        'home' => __('Home page'),
                        'job_listing' => __('Job Listing page'),
                        'both' => __('Both'),
                        default => e($v),
                    };
                }),
            FormattedColumn::make('status')
                ->title(__('Status'))
                ->orderable(true)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $status = $item->status ?? 'pending';
                    $badge = match ($status) {
                        WalkinDriveAdRequest::STATUS_APPROVED => 'bg-success',
                        WalkinDriveAdRequest::STATUS_REJECTED => 'bg-danger',
                        default => 'bg-warning text-dark',
                    };
                    return '<span class="badge ' . $badge . '">' . ucfirst($status) . '</span>';
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
