<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Jobzilla\Http\Controllers\JobzillaController;

Route::group(['controller' => JobzillaController::class, 'middleware' => ['web', 'core']], function (): void {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function (): void {
        Route::get('ajax/cities', 'ajaxGetCities')->name('public.ajax.cities');
        /**
         * Location AJAX endpoints
         *
         * Some theme views rely on these names. The Location plugin normally registers them,
         * but in some setups (plugin disabled / route caching) they may be missing.
         */
        Route::get('ajax/search-cities', 'ajaxSearchCities')->name('ajax.search-cities');
        Route::get('ajax/states-by-country', 'ajaxStatesByCountry')->name('ajax.states-by-country');
        Route::get('ajax/cities-by-state', 'ajaxCitiesByState')->name('ajax.cities-by-state');
        Route::get('ajax/job-roles', 'ajaxGetJobRoles')->name('public.ajax.job-roles');
        
        // FAQ Page
        Route::get('faq', 'faq')->name('public.faq');
        
        // Premium Service Page
        Route::get('premium-service', 'premiumService')->name('public.premium-service');
        
        // For Teachers Page
        Route::get('for-teachers', 'forTeachers')->name('public.for-teachers');
        
        // For Schools Page
        Route::get('for-schools', 'forSchools')->name('public.for-schools');
        
        // Start Hiring Page
        Route::get('start-hiring', 'startHiring')->name('public.start-hiring');
        
        // Careers Page
        Route::get('careers', 'careers')->name('public.careers');
        
        // Notifications Page
        Route::get('notifications', 'notifications')->name('public.notifications');
    });
});

Theme::routes();
