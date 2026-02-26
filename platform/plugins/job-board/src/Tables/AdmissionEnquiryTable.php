<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\AdmissionEnquiry;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class AdmissionEnquiryTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(AdmissionEnquiry::class)
            ->addActions([
                DeleteAction::make()->route('admission-enquiries.destroy'),
            ]);
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('company_id', function (AdmissionEnquiry $item) {
                return $item->company ? e($item->company->name) : '&mdash;';
            })
            ->editColumn('contact_number', function (AdmissionEnquiry $item) {
                return $item->contact_number ?: '&mdash;';
            })
            ->editColumn('email', function (AdmissionEnquiry $item) {
                return $item->email ?: '&mdash;';
            })
            ->editColumn('address', function (AdmissionEnquiry $item) {
                return $item->address ? \Illuminate\Support\Str::limit($item->address, 50) : '&mdash;';
            })
            ->editColumn('message', function (AdmissionEnquiry $item) {
                return $item->message ? \Illuminate\Support\Str::limit($item->message, 60) : '&mdash;';
            });

        return $this->toJson($data);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->query()->select(['*'])->with(['company:id,name']);

        if ($keyword = $this->request()->input('search.value')) {
            $keyword = '%' . $keyword . '%';
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('student_name', 'LIKE', $keyword)
                    ->orWhere('contact_number', 'LIKE', $keyword)
                    ->orWhere('email', 'LIKE', $keyword)
                    ->orWhere('address', 'LIKE', $keyword)
                    ->orWhere('message', 'LIKE', $keyword)
                    ->orWhere('age', 'LIKE', $keyword)
                    ->orWhere('admission_for_standard', 'LIKE', $keyword)
                    ->orWhereHas('company', function (Builder $b) use ($keyword) {
                        $b->where('name', 'LIKE', $keyword);
                    });
            });
        }

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            Column::make('student_name')
                ->title(__('Student Name'))
                ->alignLeft(),
            Column::make('company_id')
                ->title(__('School / Institution'))
                ->orderable(false)
                ->alignLeft(),
            Column::make('contact_number')
                ->title(__('Contact Number'))
                ->alignLeft(),
            Column::make('email')
                ->title(__('Email'))
                ->alignLeft(),
            Column::make('age')
                ->title(__('Age'))
                ->alignLeft(),
            Column::make('admission_for_standard')
                ->title(__('Standard'))
                ->alignLeft(),
            Column::make('address')
                ->title(__('Address'))
                ->alignLeft()
                ->orderable(false),
            Column::make('message')
                ->title(__('Message'))
                ->alignLeft()
                ->orderable(false),
            CreatedAtColumn::make()->title(__('Created Date')),
        ];
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('admission-enquiries.destroy'),
        ];
    }

    public function getDefaultButtons(): array
    {
        return ['reload'];
    }
}
