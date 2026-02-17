<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\ScreeningQuestion;
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

class ScreeningQuestionTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(ScreeningQuestion::class)
            ->addActions([
                EditAction::make()->route('screening-questions.edit'),
                DeleteAction::make()->route('screening-questions.destroy'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this
            ->getModel()
            ->query()
            ->select([
                'id',
                'question',
                'question_type',
                'correct_answer',
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
            Column::make('correct_answer')
                ->title(trans('plugins/job-board::screening-question.correct_answer'))
                ->width(160)
                ->limit(30),
            Column::make('question')
                ->title(trans('plugins/job-board::screening-question.question'))
                ->limit(60)
                ->route('screening-questions.edit'),
            Column::make('question_type')
                ->title(trans('plugins/job-board::screening-question.question_type'))
                ->width(120),
            Column::make('order')
                ->title(trans('core/base::tables.order'))
                ->width(80),
            StatusColumn::make(),
            CreatedAtColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('screening-questions.create'), 'screening-questions.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('screening-questions.destroy'),
        ];
    }
}
