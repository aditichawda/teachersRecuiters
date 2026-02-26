<?php

namespace Theme\Jobzilla\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
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

        $keyword = BaseHelper::stringify($request->input('k'));

        // Only search if keyword is provided and has at least 2 characters
        if (empty($keyword) || strlen($keyword) < 2) {
            return $response->setData([]);
        }

        $cities = $cityRepository->filters($keyword, 20, ['state']);

        return $response->setData(CityResource::collection($cities));
    }

    public function ajaxGetJobRoles(Request $request, CategoryInterface $categoryRepository, BaseHttpResponse $response)
    {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(BaseHelper::getHomepageUrl());
        }

        $keyword = BaseHelper::stringify($request->input('k'));

        $categories = $categoryRepository->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
            'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
        ]);

        // If keyword is empty, return all categories (for dropdown on click)
        // Otherwise filter by keyword
        if (!empty($keyword) && strlen($keyword) >= 2) {
            $categories = $categories->filter(function ($category) use ($keyword) {
                return stripos($category->name, $keyword) !== false;
            });
        }

        $categories = $categories->take(100)->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });

        return $response->setData($categories->values());
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
