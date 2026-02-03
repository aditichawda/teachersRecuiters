<?php

namespace Theme\Jobzilla\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Location\Repositories\Interfaces\CityInterface;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Theme\Jobzilla\Http\Resources\CityResource;

class JobzillaController extends PublicController
{
    public function ajaxGetCities(Request $request, CityInterface $cityRepository, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $keyword = $request->input('k');

        $cities = $cityRepository->filters($keyword, 20, ['state']);

        return $response->setData(CityResource::collection($cities));
    }
}
