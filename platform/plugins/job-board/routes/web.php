<?php

use Botble\Base\Facades\AdminHelper;
use Botble\JobBoard\Http\Controllers\AccountEducationController;
use Botble\JobBoard\Http\Controllers\AccountExperienceController;
use Botble\JobBoard\Http\Controllers\CouponController;
use Botble\JobBoard\Http\Controllers\CustomFieldController;
use Botble\JobBoard\Http\Controllers\ExportAccountController;
use Botble\JobBoard\Http\Controllers\ExportCompanyController;
use Botble\JobBoard\Http\Controllers\ExportJobController;
use Botble\JobBoard\Http\Controllers\ImportAccountController;
use Botble\JobBoard\Http\Controllers\ImportCompanyController;
use Botble\JobBoard\Http\Controllers\ImportJobController;
use Botble\JobBoard\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::group(['namespace' => 'Botble\JobBoard\Http\Controllers', 'prefix' => 'job-board', 'middleware' => 'auth'], function (): void {
        Route::prefix('settings')->name('job-board.settings.')->group(function (): void {
            Route::get('general', [
                'as' => 'general',
                'uses' => 'Settings\GeneralSettingController@edit',
            ]);

            Route::put('general', [
                'as' => 'general.update',
                'uses' => 'Settings\GeneralSettingController@update',
                'permission' => 'job-board.settings',
            ]);

            Route::get('currencies', [
                'as' => 'currencies',
                'uses' => 'Settings\CurrencySettingController@edit',
                'permission' => 'job-board.settings',
            ]);

            Route::put('currencies', [
                'as' => 'currencies.update',
                'uses' => 'Settings\CurrencySettingController@update',
                'permission' => 'job-board.settings',
            ]);

            Route::get('invoices', [
                'as' => 'invoices',
                'uses' => 'Settings\InvoiceSettingController@edit',
                'permission' => 'job-board.settings',
            ]);

            Route::put('invoices', [
                'as' => 'invoices.update',
                'uses' => 'Settings\InvoiceSettingController@update',
                'permission' => 'job-board.settings',
            ]);

            Route::get('invoice-template', [
                'as' => 'invoice-template',
                'uses' => 'Settings\InvoiceTemplateSettingController@edit',
                'permission' => 'invoice-template.index',
            ]);

            Route::put('invoice-template', [
                'as' => 'invoice-template.update',
                'uses' => 'Settings\InvoiceTemplateSettingController@update',
                'permission' => 'invoice-template.index',
                'middleware' => 'preventDemo',
            ]);

            Route::post('invoice-template/reset', [
                'as' => 'invoice-template.reset',
                'uses' => 'Settings\InvoiceTemplateSettingController@reset',
                'permission' => 'invoice-template.index',
                'middleware' => 'preventDemo',
            ]);

            Route::get('invoice-template/preview', [
                'as' => 'invoice-template.preview',
                'uses' => 'Settings\InvoiceTemplateSettingController@preview',
                'permission' => 'invoice-template.index',
            ]);
        });

        Route::group(['prefix' => 'jobs', 'as' => 'jobs.'], function (): void {
            Route::resource('', 'JobController')->parameters(['' => 'job']);

            Route::get('generate-slugs', [
                'as' => 'generate-slugs',
                'uses' => 'JobController@generateSlugs',
                'permission' => 'jobs.edit',
                'middleware' => 'preventDemo',
            ]);

            Route::get('{id}/analytics', [
                'as' => 'analytics',
                'uses' => 'JobController@analytics',
                'permission' => 'jobs.index',
            ])->wherePrimaryKey();
        });

        Route::group(['prefix' => 'job-types', 'as' => 'job-types.'], function (): void {
            Route::resource('', 'JobTypeController')
                ->parameters(['' => 'job-type']);
        });

        Route::group(['prefix' => 'screening-questions', 'as' => 'screening-questions.'], function (): void {
            Route::resource('', 'ScreeningQuestionController')->parameters(['' => 'screening-question']);
        });

        Route::group(['prefix' => 'job-skills', 'as' => 'job-skills.'], function (): void {
            Route::resource('', 'JobSkillController')->parameters(['' => 'job-skill']);
        });

        Route::group(['prefix' => 'specializations', 'as' => 'specializations.'], function (): void {
            Route::resource('', 'SpecializationController')->parameters(['' => 'specialization']);
        });

        Route::group(['prefix' => 'languages', 'as' => 'languages.'], function (): void {
            Route::resource('', 'LanguageController')->parameters(['' => 'language']);
        });

        Route::group(['prefix' => 'job-shifts', 'as' => 'job-shifts.'], function (): void {
            Route::resource('', 'JobShiftController')->parameters(['' => 'job-shift']);
        });

        Route::group(['prefix' => 'job-experiences', 'as' => 'job-experiences.'], function (): void {
            Route::resource('', 'JobExperienceController')->parameters(['' => 'job-experience']);
        });

        Route::group(['prefix' => 'language-levels', 'as' => 'language-levels.'], function (): void {
            Route::resource('', 'LanguageLevelController')->parameters(['' => 'language-level']);
        });

        Route::group(['prefix' => 'career-levels', 'as' => 'career-levels.'], function (): void {
            Route::resource('', 'CareerLevelController')
                ->parameters(['' => 'career-level']);
        });

        Route::group(['prefix' => 'functional-areas', 'as' => 'functional-areas.'], function (): void {
            Route::resource('', 'FunctionalAreaController')
                ->parameters(['' => 'functional-area']);
        });

        Route::group(['prefix' => 'job-categories', 'as' => 'job-categories.'], function (): void {
            Route::resource('', 'CategoryController')
                ->parameters(['' => 'job-category']);

            Route::put('update-tree', [
                'as' => 'update-tree',
                'uses' => 'CategoryController@updateTree',
                'permission' => 'job-categories.edit',
            ]);

            Route::get('search', [
                'as' => 'search',
                'uses' => 'CategoryController@getSearch',
                'permission' => 'job-categories.index',
            ]);
        });

        Route::group(['prefix' => 'degree-types', 'as' => 'degree-types.'], function (): void {
            Route::resource('', 'DegreeTypeController')
                ->parameters(['' => 'degree-type']);
        });

        Route::group(['prefix' => 'degree-levels', 'as' => 'degree-levels.'], function (): void {
            Route::resource('', 'DegreeLevelController')
                ->parameters(['' => 'degree-level']);
        });

        Route::group(['prefix' => 'tags', 'as' => 'job-board.tag.'], function (): void {
            Route::resource('', 'TagController')
                ->parameters(['' => 'tag']);

            Route::get('all', [
                'as' => 'all',
                'uses' => 'TagController@getAllTags',
                'permission' => 'job-board.tag.index',
            ]);
        });

        Route::group(['prefix' => 'accounts', 'as' => 'accounts.'], function (): void {
            Route::resource('', 'AccountController')->parameters(['' => 'account']);

            Route::group(['prefix' => 'educations', 'as' => 'educations.'], function (): void {
                Route::resource('', AccountEducationController::class)->parameters(['' => 'education']);
                Route::get('{id}/{accountId}/edit-modal', [AccountEducationController::class, 'editModal'])->name(
                    'edit-modal'
                )->wherePrimaryKey(['id', 'accountId']);
            });

            Route::group(['prefix' => 'experiences', 'as' => 'experiences.'], function (): void {
                Route::resource('', AccountExperienceController::class)->parameters(['' => 'experience']);
                Route::get('{id}/{accountId}/edit-modal', [AccountExperienceController::class, 'editModal'])->name(
                    'edit-modal'
                )->wherePrimaryKey(['id', 'accountId']);
            });

            Route::prefix('languages')->name('languages.')->group(function (): void {
                Route::resource('', 'AccountLanguageController')->parameters(['' => 'language']);
                Route::get('{id}/{accountId}/edit-modal', 'AccountLanguageController@editModal')->name('edit-modal')->wherePrimaryKey(['id', 'accountId']);
            });

            Route::get('list', [
                'as' => 'list',
                'uses' => 'AccountController@getList',
                'permission' => 'accounts.index',
            ]);

            Route::post('credits/{id}', [
                'as' => 'credits.add',
                'uses' => 'TransactionController@postCreate',
                'permission' => 'accounts.edit',
            ])->wherePrimaryKey();

            Route::get('all-employers', [
                'as' => 'all-employers',
                'uses' => 'AccountController@getAllEmployers',
                'permission' => 'accounts.index',
            ]);
        });

        Route::group(['prefix' => 'packages', 'as' => 'packages.'], function (): void {
            Route::match(['get', 'post'], '/', 'PackageController@index')->name('index');
            Route::get('create', 'PackageController@create')->name('create');
            Route::post('store', 'PackageController@store')->name('store');
            Route::get('{package}/edit', 'PackageController@edit')->name('edit')->whereNumber('package');
            Route::put('{package}', 'PackageController@update')->name('update')->whereNumber('package');
            Route::delete('{package}', 'PackageController@destroy')->name('destroy')->whereNumber('package');
        });

        Route::group(['prefix' => 'credit-consumption', 'as' => 'credit-consumption.'], function (): void {
            Route::resource('', 'CreditConsumptionController')->parameters(['' => 'creditConsumption']);
        });

        Route::group(['prefix' => 'companies', 'as' => 'companies.'], function (): void {
            Route::get('generate-slugs', [
                'as' => 'generate-slugs',
                'uses' => 'CompanyController@generateSlugs',
                'permission' => 'companies.edit',
                'middleware' => 'preventDemo',
            ]);

            Route::resource('', 'CompanyController')->parameters(['' => 'company']);

            Route::get('list', [
                'as' => 'list',
                'uses' => 'CompanyController@getList',
                'permission' => 'companies.index',
            ]);

            Route::get('all', [
                'as' => 'all',
                'uses' => 'CompanyController@getAllcompanies',
                'permission' => 'companies.index',
            ]);

            Route::get('{company}/analytics', [
                'as' => 'analytics',
                'uses' => 'CompanyController@analytics',
                'permission' => 'companies.index',
            ])->wherePrimaryKey();

            Route::get('{company}/view', [
                'as' => 'view',
                'uses' => 'CompanyController@view',
                'permission' => 'companies.index',
            ])->wherePrimaryKey();

            Route::post('{company}/verify', [
                'as' => 'verify',
                'uses' => 'CompanyController@verify',
                'permission' => 'companies.edit',
            ])->wherePrimaryKey();

            Route::post('{company}/unverify', [
                'as' => 'unverify',
                'uses' => 'CompanyController@unverify',
                'permission' => 'companies.edit',
            ])->wherePrimaryKey();
        });

        Route::get('ajax/companies/{company}', [
            'as' => 'ajax.company.show',
            'uses' => 'CompanyController@ajaxGetCompany',
            'permission' => 'companies.index',
        ])->wherePrimaryKey();

        Route::post('ajax/companies', [
            'as' => 'ajax.company.create',
            'uses' => 'CompanyController@ajaxCreateCompany',
            'permission' => 'companies.create',
        ])->wherePrimaryKey();

        Route::group(['prefix' => 'admission-enquiries', 'as' => 'admission-enquiries.'], function (): void {
            Route::match(['get', 'post'], '/', [
                'as' => 'index',
                'uses' => 'AdmissionEnquiryController@index',
                'permission' => 'admission-enquiries.index',
            ]);
            Route::delete('{admission_enquiry}', [
                'as' => 'destroy',
                'uses' => 'AdmissionEnquiryController@destroy',
                'permission' => 'admission-enquiries.destroy',
            ])->wherePrimaryKey('admission_enquiry');
        });

        Route::group(['prefix' => 'dedicated-recruiter-requests', 'as' => 'dedicated-recruiter-requests.'], function (): void {
            Route::match(['get', 'post'], '/', [
                'as' => 'index',
                'uses' => 'DedicatedRecruiterRequestController@index',
                'permission' => 'dedicated-recruiter-requests.index',
            ]);
            Route::get('{id}/edit', [
                'as' => 'edit',
                'uses' => 'DedicatedRecruiterRequestController@edit',
                'permission' => 'dedicated-recruiter-requests.index',
            ])->where('id', '[0-9]+');
            Route::put('{id}', [
                'as' => 'update',
                'uses' => 'DedicatedRecruiterRequestController@update',
                'permission' => 'dedicated-recruiter-requests.index',
            ])->where('id', '[0-9]+');
            Route::delete('{id}', [
                'as' => 'destroy',
                'uses' => 'DedicatedRecruiterRequestController@destroy',
                'permission' => 'dedicated-recruiter-requests.index',
            ])->where('id', '[0-9]+');
            Route::post('{id}/accept', [
                'as' => 'accept',
                'uses' => 'DedicatedRecruiterRequestController@accept',
                'permission' => 'dedicated-recruiter-requests.index',
            ])->where('id', '[0-9]+');
            Route::post('{id}/reject', [
                'as' => 'reject',
                'uses' => 'DedicatedRecruiterRequestController@reject',
                'permission' => 'dedicated-recruiter-requests.index',
            ])->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'job-posting-assistance-requests', 'as' => 'job-posting-assistance-requests.'], function (): void {
            Route::match(['get', 'post'], '/', [
                'as' => 'index',
                'uses' => 'JobPostingAssistanceRequestController@index',
                'permission' => 'job-posting-assistance-requests.index',
            ]);
            Route::get('{id}/edit', [
                'as' => 'edit',
                'uses' => 'JobPostingAssistanceRequestController@edit',
                'permission' => 'job-posting-assistance-requests.index',
            ])->where('id', '[0-9]+');
            Route::put('{id}', [
                'as' => 'update',
                'uses' => 'JobPostingAssistanceRequestController@update',
                'permission' => 'job-posting-assistance-requests.index',
            ])->where('id', '[0-9]+');
            Route::delete('{id}', [
                'as' => 'destroy',
                'uses' => 'JobPostingAssistanceRequestController@destroy',
                'permission' => 'job-posting-assistance-requests.index',
            ])->where('id', '[0-9]+');
            Route::post('{id}/accept', [
                'as' => 'accept',
                'uses' => 'JobPostingAssistanceRequestController@accept',
                'permission' => 'job-posting-assistance-requests.index',
            ])->where('id', '[0-9]+');
            Route::post('{id}/reject', [
                'as' => 'reject',
                'uses' => 'JobPostingAssistanceRequestController@reject',
                'permission' => 'job-posting-assistance-requests.index',
            ])->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'walkin-drive-ad-requests', 'as' => 'walkin-drive-ad-requests.'], function (): void {
            Route::match(['get', 'post'], '/', [
                'as' => 'index',
                'uses' => 'WalkinDriveAdRequestController@index',
                'permission' => 'walkin-drive-ad-requests.index',
            ]);
            Route::get('{id}/edit', [
                'as' => 'edit',
                'uses' => 'WalkinDriveAdRequestController@edit',
                'permission' => 'walkin-drive-ad-requests.index',
            ])->where('id', '[0-9]+');
            Route::put('{id}', [
                'as' => 'update',
                'uses' => 'WalkinDriveAdRequestController@update',
                'permission' => 'walkin-drive-ad-requests.index',
            ])->where('id', '[0-9]+');
            Route::delete('{id}', [
                'as' => 'destroy',
                'uses' => 'WalkinDriveAdRequestController@destroy',
                'permission' => 'walkin-drive-ad-requests.index',
            ])->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'social-promotion-requests', 'as' => 'social-promotion-requests.'], function (): void {
            Route::match(['get', 'post'], '/', [
                'as' => 'index',
                'uses' => 'SocialPromotionRequestController@index',
                'permission' => 'social-promotion-requests.index',
            ]);
            Route::get('{id}/edit', [
                'as' => 'edit',
                'uses' => 'SocialPromotionRequestController@edit',
                'permission' => 'social-promotion-requests.index',
            ])->where('id', '[0-9]+');
            Route::get('{id}/download-image', [
                'as' => 'download-image',
                'uses' => 'SocialPromotionRequestController@downloadImage',
                'permission' => 'social-promotion-requests.index',
            ])->where('id', '[0-9]+');
            Route::put('{id}', [
                'as' => 'update',
                'uses' => 'SocialPromotionRequestController@update',
                'permission' => 'social-promotion-requests.index',
            ])->where('id', '[0-9]+');
            Route::post('{id}/accept', [
                'as' => 'accept',
                'uses' => 'SocialPromotionRequestController@accept',
                'permission' => 'social-promotion-requests.index',
            ])->where('id', '[0-9]+');
            Route::post('{id}/reject', [
                'as' => 'reject',
                'uses' => 'SocialPromotionRequestController@reject',
                'permission' => 'social-promotion-requests.index',
            ])->where('id', '[0-9]+');
            Route::delete('{id}', [
                'as' => 'destroy',
                'uses' => 'SocialPromotionRequestController@destroy',
                'permission' => 'social-promotion-requests.index',
            ])->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'job-applications', 'as' => 'job-applications.'], function (): void {
            Route::resource('', 'JobApplicationController')
                ->except(['create', 'store'])
                ->parameters(['' => 'job-application']);

            Route::get('download-cv/{application}', [
                'as' => 'download-cv',
                'uses' => 'JobApplicationController@downloadCv',
                'permission' => false,
            ])->wherePrimaryKey('application');
        });

        Route::group(['prefix' => 'invoices', 'as' => 'invoice.'], function (): void {
            Route::resource('', 'InvoiceController')
                ->parameters(['' => 'invoice'])
                ->except(['create', 'store', 'update']);

            Route::get('generate-invoice/{id}', [
                'as' => 'generate-invoice',
                'uses' => 'InvoiceController@getGenerateInvoice',
                'permission' => 'invoice.edit',
            ])->wherePrimaryKey();
        });

        Route::prefix('custom-fields')->name('job-board.custom-fields.')->group(function (): void {
            Route::resource('', CustomFieldController::class)->parameters(['' => 'custom-field']);

            Route::get('info', [
                'as' => 'get-info',
                'uses' => 'CustomFieldController@getInfo',
                'permission' => false,
            ]);
        });



        Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function (): void {
            Route::resource('', CouponController::class)
                ->parameters(['' => 'coupon']);

            Route::post('generate-coupon', [
                'as' => 'generate-coupon',
                'uses' => 'CouponController@generateCouponCode',
                'permission' => 'coupons.index',
            ]);
        });

        Route::get('reports', [
            'as' => 'job-board.reports',
            'uses' => 'ReportController@index',
            'permission' => 'job-board.reports',
        ]);

        Route::prefix('tools/data-synchronize')->name('tools.data-synchronize.')->group(function (): void {
            Route::prefix('export')->name('export.')->group(function (): void {
                Route::group(['prefix' => 'companies', 'as' => 'companies.', 'permission' => 'companies.export'], function (): void {
                    Route::get('/', [ExportCompanyController::class, 'index'])->name('index');
                    Route::post('/', [ExportCompanyController::class, 'store'])->name('store');
                });

                Route::group(['prefix' => 'accounts', 'as' => 'accounts.', 'permission' => 'accounts.export'], function (): void {
                    Route::get('/', [ExportAccountController::class, 'index'])->name('index');
                    Route::post('/', [ExportAccountController::class, 'store'])->name('store');
                });

                Route::group(['prefix' => 'jobs', 'as' => 'jobs.', 'permission' => 'jobs.export'], function (): void {
                    Route::get('/', [ExportJobController::class, 'index'])->name('index');
                    Route::post('/', [ExportJobController::class, 'store'])->name('store');
                });
            });

            Route::prefix('import')->name('import.')->group(function (): void {
                Route::group(['prefix' => 'companies', 'as' => 'companies.', 'permission' => 'companies.import'], function (): void {
                    Route::get('/', [ImportCompanyController::class, 'index'])->name('index');
                    Route::post('/', [ImportCompanyController::class, 'import'])->name('store');
                    Route::post('validate', [ImportCompanyController::class, 'validateData'])->name('validate');
                    Route::post('download-example', [ImportCompanyController::class, 'downloadExample'])->name('download-example');
                });

                Route::group(['prefix' => 'accounts', 'as' => 'accounts.', 'permission' => 'accounts.import'], function (): void {
                    Route::get('/', [ImportAccountController::class, 'index'])->name('index');
                    Route::post('/', [ImportAccountController::class, 'import'])->name('store');
                    Route::post('validate', [ImportAccountController::class, 'validateData'])->name('validate');
                    Route::post('download-example', [ImportAccountController::class, 'downloadExample'])->name('download-example');
                });

                Route::group(['prefix' => 'jobs', 'as' => 'jobs.', 'permission' => 'jobs.import'], function (): void {
                    Route::get('/', [ImportJobController::class, 'index'])->name('index');
                    Route::post('/', [ImportJobController::class, 'import'])->name('store');
                    Route::post('validate', [ImportJobController::class, 'validateData'])->name('validate');
                    Route::post('download-example', [ImportJobController::class, 'downloadExample'])->name('download-example');
                });
            });
        });
    });
});

// WhatsApp Template Testing Routes (Web routes to bypass API middleware)
Route::group(['prefix' => 'whatsapp-test', 'as' => 'whatsapp.test.', 'middleware' => ['web']], function (): void {
    Route::get('template/{templateName?}', [\Botble\JobBoard\Http\Controllers\API\WhatsAppController::class, 'testTemplate'])->name('template');
    Route::get('all-templates', [\Botble\JobBoard\Http\Controllers\API\WhatsAppController::class, 'testAllTemplates'])->name('all-templates');
    Route::get('send-test-message', [\Botble\JobBoard\Http\Controllers\API\WhatsAppController::class, 'sendTestMessage'])->name('send-test-message');
});
