<?php

namespace Botble\JobBoard\Tables;

use Botble\JobBoard\Models\SocialPromotionRequest;
use Botble\Media\Facades\RvMedia;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class SocialPromotionRequestTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(SocialPromotionRequest::class)
            ->addActions([
                EditAction::make()->route('social-promotion-requests.edit')->permission('social-promotion-requests.index'),
                DeleteAction::make()->route('social-promotion-requests.destroy')->permission('social-promotion-requests.index'),
            ]);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->query()->select(['*'])->with(['account:id,first_name,last_name,email', 'company:id,name']);

        if ($keyword = $this->request()->input('search.value')) {
            $keyword = '%' . $keyword . '%';
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'LIKE', $keyword)
                    ->orWhere('tag', 'LIKE', $keyword)
                    ->orWhere('message', 'LIKE', $keyword)
                    ->orWhere('platform', 'LIKE', $keyword)
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
            Column::make('account_id')
                ->title(__('Employer'))
                ->orderable(false)
                ->formatUsing(function ($value, SocialPromotionRequest $item) {
                    $a = $item->account;
                    if (! $a) {
                        return '—';
                    }
                    $name = trim(e($a->first_name . ' ' . $a->last_name)) ?: e($a->email);
                    return $name . ' <span class="text-muted">(ID: ' . (int) $a->id . ')</span>';
                }),
            Column::make('title')
                ->title(__('Title'))
                ->limit(30),
            Column::make('tag')
                ->title(__('Tag'))
                ->limit(20),
            Column::make('platform')
                ->title(__('Platform')),
            Column::make('message')
                ->title(__('Message'))
                ->limit(40)
                ->orderable(false),
            Column::make('image')
                ->title(__('Image'))
                ->orderable(false)
                ->searchable(false)
                ->width(120)
                ->formatUsing(function ($value, SocialPromotionRequest $item) {
                    if (! $item->image) {
                        return '<span class="text-muted">—</span>';
                    }
                    $thumbUrl = RvMedia::getImageUrl($item->image, 'thumb');
                    $fullUrl = RvMedia::getImageUrl($item->image);
                    if ($thumbUrl && ! str_starts_with($thumbUrl, 'http')) {
                        $thumbUrl = url($thumbUrl);
                    }
                    if ($fullUrl && ! str_starts_with($fullUrl, 'http')) {
                        $fullUrl = url($fullUrl);
                    }
                    $downloadUrl = route('social-promotion-requests.download-image', $item->id);
                    return '<div class="d-flex align-items-center gap-1 flex-wrap">' .
                        '<a href="' . e($fullUrl) . '" target="_blank" rel="noopener" class="d-inline-block">' .
                        '<img src="' . e($thumbUrl) . '" alt="" class="rounded" style="max-width:50px;max-height:50px;object-fit:cover;" onerror="this.style.display=\'none\'">' .
                        '</a>' .
                        '<a href="' . e($downloadUrl) . '" class="btn btn-sm btn-outline-secondary" title="' . e(__('Download image')) . '"><i class="fa fa-download"></i> ' . __('Download') . '</a>' .
                        '</div>';
                }),
            Column::make('status')
                ->title(__('Status'))
                ->orderable(true)
                ->formatUsing(function ($v, SocialPromotionRequest $item) {
                    $status = $item->status ?? 'pending';
                    $badge = match ($status) {
                        SocialPromotionRequest::STATUS_ACCEPTED => 'bg-success',
                        SocialPromotionRequest::STATUS_REJECTED => 'bg-danger',
                        SocialPromotionRequest::STATUS_POSTED => 'bg-info',
                        default => 'bg-warning text-dark',
                    };
                    return '<span class="badge ' . $badge . '">' . ucfirst($status) . '</span>';
                }),
            Column::make('actions')
                ->title(__('Actions'))
                ->orderable(false)
                ->searchable(false)
                ->formatUsing(function ($_, SocialPromotionRequest $item) {
                    if ($item->status !== SocialPromotionRequest::STATUS_PENDING) {
                        return '—';
                    }
                    $accept = route('social-promotion-requests.accept', $item->id);
                    $reject = route('social-promotion-requests.reject', $item->id);
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
        // Do not escape any column so Image (thumbnail + Download) and Action (Accept/Reject/Edit) HTML render (admin-only table)
        return $this->toJson($data, []);
    }

    public function buttons(): array
    {
        return [];
    }
}
