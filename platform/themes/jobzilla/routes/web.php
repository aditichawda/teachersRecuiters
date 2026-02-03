<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Jobzilla\Http\Controllers\JobzillaController;

Route::group(['controller' => JobzillaController::class, 'middleware' => ['web', 'core']], function (): void {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function (): void {
        Route::get('ajax/cities', 'ajaxGetCities')->name('public.ajax.cities');
    });
});

Theme::routes();
