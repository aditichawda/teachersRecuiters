<?php

namespace Botble\JobBoard\Tables\Fronts;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\JobBoard\Models\Job;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\Action;
use Botble\Table\Actions\EditAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\EnumColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class JobTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Job::class)
            ->addActions([
                Action::make('view')
                    ->route('public.account.jobs.view')
                    ->label(trans('plugins/job-board::messages.view'))
                    ->icon('ti ti-eye')
                    ->color('primary'),
                EditAction::make()->route('public.account.jobs.edit'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        // @phpstan-ignore-next-line
        $query = $this
            ->getModel()
            ->query()
            ->select([
                'id',
                'name',
                'created_at',
                'status',
                'moderation_status',
                'company_id',
                'expire_date',
                'never_expired',
                'application_closing_date',
                'views',
            ])
            ->with(['company:id,name', 'slugable'])
            ->byAccount(auth('account')->id());

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            FormattedColumn::make('name')
                ->title(trans('core/base::tables.name'))
                ->alignStart()
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $name = trim((string) ($item->name ?? ''));

                    if ($name === '') {
                        return '&mdash;';
                    }

                    $slug = $item->slugable?->key;
                    $url = $slug ? route('public.job', $slug) : route('public.account.jobs.view', $item->id);

                    return '<a href="' . e($url) . '" target="_blank" class="text-primary text-decoration-none">' . e($name) . ' ' . BaseHelper::renderIcon('ti ti-external-link') . '</a>';
                }),
            FormattedColumn::make('company_id')
                ->title(trans('plugins/job-board::forms.company'))
                ->withEmptyState()
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();

                    if (empty($item->company_id)) {
                        return 'NA';
                    }

                    $companyName = trim((string) optional($item->company)->name);

                    if ($companyName === '') {
                        return 'NA';
                    }

                    return $companyName;
                }),
            CreatedAtColumn::make(),
            FormattedColumn::make('expire_date')
                ->title(trans('plugins/job-board::messages.expire_date'))
                ->width(150)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $deadline = $item->effectiveApplicationDeadline();

                    if ($deadline === null) {
                        if ($item->never_expired) {
                            return BaseHelper::renderIcon('ti ti-infinity');
                        }

                        return 'NA';
                    }

                    if ($deadline->isPast()) {
                        return Html::tag('span', $deadline->toDateString(), ['class' => 'text-danger'])->toHtml();
                    }

                    if (Carbon::now()->diffInDays($deadline) < 3) {
                        return Html::tag('span', $deadline->toDateString(), ['class' => 'text-warning'])->toHtml();
                    }

                    return $deadline->toDateString();
                }),
            FormattedColumn::make('views')
                ->title(trans('plugins/job-board::general.views'))
                ->width(100)
                ->orderable(false)
                ->searchable(false)
                ->getValueUsing(function (FormattedColumn $column) {
                    $item = $column->getItem();
                    $views = (int) (is_object($item) ? ($item->views ?? 0) : (data_get($item, 'views', 0)));

                    return (string) $views;
                }),
            StatusColumn::make(),
            EnumColumn::make('moderation_status')
                ->title(trans('plugins/job-board::job.moderation_status'))
                ->width(150),
        ];
    }

    public function buttons(): array
    {
        if (! auth('account')->user()->canPost()) {
            return [];
        }

        return $this->addCreateButton(route('public.account.jobs.create'));
    }
}
