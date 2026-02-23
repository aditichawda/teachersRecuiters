<?php

namespace Botble\Ads\Http\Controllers;

use Botble\Ads\Forms\AdsForm;
use Botble\Ads\Http\Requests\AdsRequest;
use Botble\Ads\Models\Ads;
use Botble\Ads\Tables\AdsTable;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdsController extends BaseController
{
    public function index(AdsTable $table)
    {
        PageTitle::setTitle(trans('plugins/ads::ads.name'));

        // Count ads expiring within 7 days
        $expiringAdsCount = Ads::whereNotNull('expired_at')
            ->whereDate('expired_at', '>=', Carbon::now())
            ->whereDate('expired_at', '<=', Carbon::now()->addDays(7))
            ->count();

        return $table->renderTable([], [
            'expiringAdsCount' => $expiringAdsCount,
        ]);
    }

    public function create()
    {
        PageTitle::setTitle(trans('plugins/ads::ads.create'));

        return AdsForm::create()->renderForm();
    }

    public function store(AdsRequest $request, BaseHttpResponse $response)
    {
        $form = AdsForm::create()->setRequest($request);
        $form->save();

        return $response
            ->setPreviousUrl(route('ads.index'))
            ->setNextUrl(route('ads.edit', $form->getModel()->id))
            ->withCreatedSuccessMessage();
    }

    public function edit(Ads $ads, Request $request)
    {
        event(new BeforeEditContentEvent($request, $ads));

        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $ads->name]));

        return AdsForm::createFromModel($ads)->renderForm();
    }

    public function update(Ads $ads, AdsRequest $request, BaseHttpResponse $response)
    {
        AdsForm::createFromModel($ads)
            ->setRequest($request)
            ->save();

        return $response
            ->setPreviousUrl(route('ads.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Ads $ads)
    {
        return DeleteResourceAction::make($ads);
    }
}
