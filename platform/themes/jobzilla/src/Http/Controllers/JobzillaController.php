<?php

namespace Theme\Jobzilla\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Location\Repositories\Interfaces\CityInterface;
use Botble\Theme\Facades\Theme;
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

    public function faq()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('FAQ'), route('public.faq'));

        return Theme::scope('faq')->render();
    }

    public function premiumService()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Premium Service'), route('public.premium-service'));

        return Theme::scope('premium-service')->render();
    }

    public function forTeachers()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('For Teachers'), route('public.for-teachers'));

        return Theme::scope('for-teachers')->render();
    }

    public function forSchools()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('For Schools'), route('public.for-schools'));

        return Theme::scope('for-schools')->render();
    }

    public function careers()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Careers'), route('public.careers'));

        return Theme::scope('careers')->render();
    }

    public function notifications()
    {
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Notifications'), route('public.notifications'));

        return Theme::scope('notifications')->render();
    }
}
