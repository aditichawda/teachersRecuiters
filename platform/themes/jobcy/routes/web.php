<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Jobcy\Http\Controllers\JobcyController;

/**
 * IMPORTANT
 * This project is currently running with missing APP_KEY, which breaks the "web" middleware group
 * (cookie encryption / session). Location AJAX endpoints must remain accessible without "web"
 * so city/state/country dropdowns can work on the frontend/dashboard.
 */
Route::middleware(['core'])->group(function (): void {
    Route::get('ajax/search-cities', [JobcyController::class, 'ajaxSearchCities'])->name('ajax.search-cities');
    Route::get('ajax/states-by-country', [JobcyController::class, 'ajaxStatesByCountry'])->name('ajax.states-by-country');
    Route::get('ajax/cities-by-state', [JobcyController::class, 'ajaxCitiesByState'])->name('ajax.cities-by-state');
});

Route::group(['controller' => JobcyController::class, 'middleware' => ['web', 'core']], function (): void {
    Theme::registerRoutes(function (): void {
        Route::group(['prefix' => 'ajax', 'as' => 'public.ajax.'], function (): void {
            Route::get('cities', [
                'as' => 'cities',
                'uses' => 'ajaxGetCities',
            ]);

            Route::get('locations', [
                'as' => 'locations',
                'uses' => 'ajaxGetLocation',
            ]);

            Route::get('job-categories', [
                'as' => 'job-categories',
                'uses' => 'ajaxGetJobCategories',
            ]);

            Route::get('job-categories-list', [
                'as' => 'job-categories-list',
                'uses' => 'ajaxGetJobCategoriesList',
            ]);

            Route::get('featured-job-categories', [
                'as' => 'featured-job-categories',
                'uses' => 'ajaxGetFeaturedJobCategories',
            ]);

            Route::get('job-tabs/{type}', [
                'as' => 'job-tabs',
                'uses' => 'ajaxGetJobTabs',
            ])->where('type', 'featured|recent|popular');
        });
    });
});

Theme::routes();
