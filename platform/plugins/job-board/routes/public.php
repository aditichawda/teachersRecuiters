<?php

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Category;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\Tag;
use Botble\Location\Models\City;
use Botble\Location\Models\State;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\JobBoard\Http\Controllers\Fronts', 'middleware' => ['web', 'core']], function (): void {
    Route::post('jobs/apply/{id?}', [
        'as' => 'public.job.apply',
        'uses' => 'PublicController@postApplyJob',
    ]);

    Route::get('currency/switch/{code?}', [
        'as' => 'public.change-currency',
        'uses' => 'PublicController@changeCurrency',
    ]);

    // Register job detail route BEFORE Theme::registerRoutes to ensure it matches first
    // This prevents the catch-all route from matching /jobs/{slug} before this route
    Route::get(SlugHelper::getPrefix(Job::class, 'jobs') . '/{slug}', [
        'as' => 'public.job',
        'uses' => 'PublicController@getJob',
    ])->where('slug', '[a-z0-9-]+');

    Theme::registerRoutes(function (): void {
        Route::get('ajax/jobs/screening-questions/{id}', [
            'as' => 'public.ajax.job.screening-questions',
            'uses' => 'PublicController@getJobScreeningQuestions',
        ]);
        Route::post('ajax/jobs/validate-screening/{id}', [
            'as' => 'public.ajax.job.validate-screening',
            'uses' => 'PublicController@validateScreening',
        ]);

        Route::get('ajax/jobs', [
            'as' => 'public.ajax.jobs',
            'uses' => 'PublicController@getJobs',
        ]);

        Route::get('ajax/job-filters', [
            'as' => 'public.ajax.job-filters',
            'uses' => 'PublicController@getJobFilters',
        ]);

        Route::get('ajax/candidates', [
            'as' => 'public.ajax.candidates',
            'uses' => 'PublicController@getCandidates',
        ]);

        Route::get('ajax/companies', [
            'as' => 'public.ajax.companies',
            'uses' => 'PublicController@getcompanies',
        ]);

        Route::get(SlugHelper::getPrefix(Category::class, 'job-categories') . '/{slug}', [
            'as' => 'public.job-category',
            'uses' => 'PublicController@getJobCategory',
        ]);

        Route::get(SlugHelper::getPrefix(Tag::class, 'job-tags') . '/{slug}', [
            'as' => 'public.job-tag',
            'uses' => 'PublicController@getJobTag',
        ]);

        Route::get(SlugHelper::getPrefix(Company::class, 'companies') . '/{slug}', [
            'as' => 'public.company',
            'uses' => 'PublicController@getCompany',
        ]);

        Route::get(SlugHelper::getPrefix(Account::class, 'candidates') . '/{slug}', [
            'as' => 'public.candidate',
            'uses' => 'PublicController@getCandidate',
        ]);

        Route::get(
            sprintf('%s/%s/{slug?}', SlugHelper::getPrefix(Job::class, 'jobs'), SlugHelper::getPrefix(City::class, 'city')),
            'JobByLocationController@city'
        )->name('public.jobs-by-city');

        Route::get(
            sprintf('%s/%s/{slug?}', SlugHelper::getPrefix(Job::class, 'jobs'), SlugHelper::getPrefix(State::class, 'state')),
            'JobByLocationController@state'
        )->name('public.jobs-by-state');

        Route::get('admission', [
            'as' => 'public.admission',
            'uses' => 'AdmissionController@index',
        ]);
        Route::post('admission/enquiry', [
            'as' => 'public.admission.enquiry',
            'uses' => 'AdmissionController@storeEnquiry',
        ]);
    });

    Route::group(['prefix' => 'payments'], function (): void {
        Route::post('checkout', 'CheckoutController@postCheckout')->name('payments.checkout');
    });

    // Wallet recharge callback (Razorpay redirect POST) - no CSRF
    Theme::registerRoutes(function (): void {
        Route::prefix('account/wallet/recharge')->name('public.account.wallet.recharge.')
            ->withoutMiddleware([VerifyCsrfToken::class])
            ->group(function (): void {
                Route::match(['get', 'post'], 'callback/{token}', [
                    'as' => 'callback',
                    'uses' => 'WalletRechargeController@callback',
                ]);
            });
    }, ['core']);

    // User Notifications Routes
    Route::group(['prefix' => 'account/notifications', 'middleware' => ['auth:account']], function (): void {
        Route::post('read/{id}', [
            'as' => 'public.account.notifications.read',
            'uses' => 'UserNotificationController@read',
        ]);
        Route::post('mark-read/{id}', [
            'as' => 'public.account.notifications.mark-read',
            'uses' => 'UserNotificationController@markAsRead',
        ]);
        Route::post('mark-all-read', [
            'as' => 'public.account.notifications.mark-all-read',
            'uses' => 'UserNotificationController@markAllAsRead',
        ]);
        Route::delete('delete/{id}', [
            'as' => 'public.account.notifications.delete',
            'uses' => 'UserNotificationController@delete',
        ]);
        Route::delete('delete-all', [
            'as' => 'public.account.notifications.delete-all',
            'uses' => 'UserNotificationController@deleteAll',
        ]);
        Route::get('count-unread', [
            'as' => 'public.account.notifications.count-unread',
            'uses' => 'UserNotificationController@countUnread',
        ]);
        
        // Test Routes (for development/testing only)
        Route::get('test', [
            'as' => 'public.account.notifications.test',
            'uses' => 'NotificationTestController@generateAllNotifications',
        ]);
        Route::get('test-job-seeker', [
            'as' => 'public.account.notifications.test.job-seeker',
            'uses' => 'NotificationTestController@generateAllJobSeekerNotifications',
        ]);
        Route::get('test/{type}', [
            'as' => 'public.account.notifications.test.single',
            'uses' => 'NotificationTestController@generateSingleNotification',
        ]);
    });
});

Route::group(['namespace' => 'Botble\JobBoard\Http\Controllers', 'middleware' => ['web', 'core']], function (): void {
    Route::get('download-cv/{account}', [
        'as' => 'public.candidate.download-cv',
        'uses' => 'AccountDownloadCvController@__invoke',
    ]);
});
