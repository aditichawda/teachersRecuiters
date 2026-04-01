<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\Package;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class PackageTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Package::class)
            ->addActions([
                EditAction::make()->route('packages.edit'),
                DeleteAction::make()->route('packages.destroy'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->newQuery()->orderBy('id');

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            NameColumn::make()->route('packages.edit'),
            Column::make('package_type')
                ->title(trans('plugins/job-board::package.package_type'))
                ->formatUsing(function ($value) {
                    if (empty($value)) return '—';
                    return str_contains(strtolower((string) $value), 'job-seeker') || str_contains(strtolower((string) $value), 'seeker')
                        ? trans('plugins/job-board::package.package_type_job_seeker')
                        : trans('plugins/job-board::package.package_type_employer');
                }),
            Column::make('number_of_listings')->title(trans('plugins/job-board::package.number_of_listings'))->width(100),
            Column::make('credits_included')->title(trans('plugins/job-board::package.credits_included'))->width(100),
            StatusColumn::make(),
            CreatedAtColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('packages.create'), 'packages.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('packages.destroy'),
        ];
    }

    public function getBulkChanges(): array
    {
        return [
            NameBulkChange::make(),
            StatusBulkChange::make(),
            CreatedAtBulkChange::make(),
        ];
    }
}
