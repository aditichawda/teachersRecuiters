<?php

namespace Botble\Ads\Tables;

use Botble\Ads\Models\Ads;
use Botble\Base\Facades\Html;
use Carbon\Carbon;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\DateBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\DateColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;

class AdsTable extends TableAbstract
{

    public function setup(): void
    {
        $this
            ->model(Ads::class)
            ->addColumns([
                IdColumn::make(),
                ImageColumn::make(),
                NameColumn::make()->route('ads.edit'),
                FormattedColumn::make('url')
                    ->title(trans('plugins/ads::ads.url'))
                    ->alignStart()
                    ->getValueUsing(function (FormattedColumn $column) {
                        $ad = $column->getItem();
                        $url = $ad->url;

                        if (empty($url)) {
                            return '<span class="text-muted">' . trans('plugins/ads::ads.not_set') . '</span>';
                        }

                        // Truncate long URLs for display
                        $displayUrl = strlen($url) > 50 ? substr($url, 0, 50) . '...' : $url;
                        
                        return Html::link($url, $displayUrl, [
                            'target' => '_blank',
                            'rel' => 'noopener noreferrer',
                            'title' => $url,
                            'class' => 'text-primary text-decoration-none'
                        ]);
                    }),
                Column::make('clicked')
                    ->title(trans('plugins/ads::ads.clicked'))
                    ->alignStart(),
                FormattedColumn::make('expired_at')
                    ->title(trans('plugins/ads::ads.expired_at'))
                    ->getValueUsing(function (FormattedColumn $column) {
                        $ad = $column->getItem();
                        $expiredAt = $ad->expired_at;
                        
                        if (!$expiredAt) {
                            return '';
                        }
                        
                        $expiredAtCarbon = Carbon::parse($expiredAt);
                        $now = Carbon::now();
                        $daysUntilExpiry = (int) $now->diffInDays($expiredAtCarbon, false);
                        
                        $dateFormatted = $expiredAtCarbon->format('Y-m-d');
                        
                        if ($daysUntilExpiry >= 0 && $daysUntilExpiry <= 7) {
                            $badgeClass = $daysUntilExpiry <= 3 ? 'badge bg-danger' : 'badge bg-warning';
                            if ($daysUntilExpiry == 0) {
                                $badgeText = 'Today';
                            } elseif ($daysUntilExpiry == 1) {
                                $badgeText = '1 day left';
                            } else {
                                $badgeText = $daysUntilExpiry . ' days left';
                            }
                            return $dateFormatted . ' ' . Html::tag('span', $badgeText, ['class' => $badgeClass . ' ms-2']);
                        }
                        
                        return $dateFormatted;
                    }),
                StatusColumn::make(),
            ])
            ->addHeaderAction(CreateHeaderAction::make()->route('ads.create'))
            ->addActions([
                EditAction::make()->route('ads.edit'),
                DeleteAction::make()->route('ads.destroy'),
            ])
            ->addBulkAction(DeleteBulkAction::make()->permission('ads.destroy'))
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                DateBulkChange::make()->name('expired_at')->title(trans('plugins/ads::ads.expired_at')),
            ])
            ->queryUsing(function ($query): void {
                $now = Carbon::now();
                $sevenDaysFromNow = Carbon::now()->addDays(7);
                
                $query->select([
                    'id',
                    'image',
                    'key',
                    'name',
                    'url',
                    'clicked',
                    'expired_at',
                    'status',
                ])
                ->orderByRaw('CASE 
                    WHEN expired_at IS NOT NULL AND expired_at >= ? AND expired_at <= ? THEN 0 
                    WHEN expired_at IS NOT NULL AND expired_at >= ? THEN 1 
                    ELSE 2 
                END', [$now, $sevenDaysFromNow, $now])
                ->orderBy('expired_at', 'asc');
            });
    }
}
