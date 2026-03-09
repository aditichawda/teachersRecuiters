<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\CreditConsumption;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CreditConsumptionTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(CreditConsumption::class)
            ->addActions([
                EditAction::make()->route('credit-consumption.edit'),
                DeleteAction::make()->route('credit-consumption.destroy'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this
            ->getModel()
            ->query()
            ->select([
                'id',
                'account_type',
                'feature_key',
                'feature_label',
                'credits',
                'order',
                'created_at',
                'status',
            ]);

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            Column::make('account_type')
                ->title(trans('plugins/job-board::credit-consumption.account_type'))
                ->formatUsing(fn ($value) => $value === 'job-seeker' ? trans('plugins/job-board::package.package_type_job_seeker') : trans('plugins/job-board::package.package_type_employer')),
            Column::make('feature_key')->title(trans('plugins/job-board::credit-consumption.feature_key')),
            Column::make('feature_label')->title(trans('plugins/job-board::credit-consumption.feature_label')),
            Column::make('credits')->title(trans('plugins/job-board::credit-consumption.credits'))->width(100),
            Column::make('order')->title(trans('core/base::tables.order'))->width(80),
            StatusColumn::make(),
            CreatedAtColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('credit-consumption.create'), 'credit-consumption.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('credit-consumption.destroy'),
        ];
    }
}
