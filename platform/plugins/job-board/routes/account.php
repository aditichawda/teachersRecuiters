<?php

use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Http\Controllers\CustomFieldController;
use Botble\JobBoard\Http\Controllers\Fronts\AccountEducationController;
use Botble\JobBoard\Http\Controllers\Fronts\AccountExperienceController;
use Botble\JobBoard\Http\Controllers\Fronts\AccountLanguageController;
use Botble\JobBoard\Http\Controllers\Fronts\CouponController;
use Botble\JobBoard\Http\Controllers\JobApplicationController;
use Botble\JobBoard\Http\Middleware\LocaleMiddleware;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\JobBoard\Http\Controllers'], function (): void {
    Theme::registerRoutes(function (): void {
        Route::group(['as' => 'public.account.', 'namespace' => 'Auth'], function (): void {
            Route::group(['middleware' => ['account.guest']], function (): void {
                Route::controller('LoginController')->group(function (): void {
                    Route::get('login', [
                        'as' => 'login',
                        'uses' => 'showLoginForm',
                    ]);
                    Route::post('login', [
                        'as' => 'login.post',
                        'uses' => 'login',
                    ]);
                    
                    // OTP Login Routes
                    Route::post('login/send-email-otp', [
                        'as' => 'login.sendEmailOtp',
                        'uses' => 'sendEmailOtp',
                    ]);
                    Route::post('login/send-whatsapp-otp', [
                        'as' => 'login.sendWhatsAppOtp',
                        'uses' => 'sendWhatsAppOtp',
                    ]);
                    Route::post('login/verify-otp', [
                        'as' => 'login.verifyOtp',
                        'uses' => 'verifyOtpLogin',
                    ]);
                    Route::post('login/resend-otp', [
                        'as' => 'login.resendOtp',
                        'uses' => 'resendOtp',
                    ]);
                });

                Route::controller('RegisterController')->group(function (): void {
                    Route::get('register', [
                        'as' => 'register',
                        'uses' => 'showRegistrationForm',
                    ]);

                    Route::post('register', [
                        'as' => 'register.post',
                        'uses' => 'register',
                    ]);

                    // Employer Registration Routes - Multi-step
                    Route::get('register/employer', [
                        'as' => 'register.employer',
                        'uses' => 'showEmployerRegistrationForm',
                    ]);

                    Route::post('register/employer', [
                        'as' => 'register.employer.post',
                        'uses' => 'registerEmployerStep1',
                    ]);

                    // Employer Step 2: OTP Verification
                    Route::get('register/employer/verify-email', [
                        'as' => 'register.employer.verifyEmailPage',
                        'uses' => 'showEmployerEmailVerificationPage',
                    ]);

                    Route::post('register/employer/verify-email-code', [
                        'as' => 'register.employer.verifyEmailCode',
                        'uses' => 'verifyEmployerEmailCode',
                    ]);

                    Route::post('register/employer/resend-verification-code', [
                        'as' => 'register.employer.resendVerificationCode',
                        'uses' => 'resendEmployerVerificationCode',
                    ]);

                    // Employer Step 3: Institution Type
                    Route::get('register/employer/institution-type', [
                        'as' => 'register.employer.institutionTypePage',
                        'uses' => 'showEmployerInstitutionTypePage',
                    ]);

                    Route::post('register/employer/save-institution-type', [
                        'as' => 'register.employer.saveInstitutionType',
                        'uses' => 'saveEmployerInstitutionType',
                    ]);

                    // Employer Step 4: Location
                    Route::get('register/employer/location', [
                        'as' => 'register.employer.locationPage',
                        'uses' => 'showEmployerLocationPage',
                    ]);

                    Route::post('register/employer/save-location', [
                        'as' => 'register.employer.saveLocation',
                        'uses' => 'saveEmployerLocation',
                    ]);

                    // Dedicated email verification step (OTP page)
                    Route::get('register/verify-email', [
                        'as' => 'register.verifyEmailPage',
                        'uses' => 'showEmailVerificationPage',
                    ]);

                    // AJAX endpoints for step-1 email verification (job seeker)
                    Route::post('register/check-email', [
                        'as' => 'register.checkEmail',
                        'uses' => 'checkEmailExists',
                    ]);
                    Route::post('register/send-verification-code', [
                        'as' => 'register.sendVerificationCode',
                        'uses' => 'sendVerificationCode',
                    ]);

                    Route::get('register/get-session-data', [
                        'as' => 'register.getSessionData',
                        'uses' => 'getSessionData',
                    ]);

                    Route::post('register/store-email-session', [
                        'as' => 'register.storeEmailSession',
                        'uses' => 'storeEmailSession',
                    ]);

                    Route::get('register/get-verification-data', [
                        'as' => 'register.getVerificationData',
                        'uses' => 'getVerificationData',
                    ]);

                    Route::post('register/verify-email-code', [
                        'as' => 'register.verifyEmailCode',
                        'uses' => 'verifyEmailCode',
                    ]);

                    // Step 2: Institution Type page
                    Route::get('register/institution-type', [
                        'as' => 'register.institutionTypePage',
                        'uses' => 'showInstitutionTypePage',
                    ]);

                    Route::post('register/save-institution-type', [
                        'as' => 'register.saveInstitutionType',
                        'uses' => 'saveInstitutionType',
                    ]);

                    // Step 3: Location page
                    Route::get('register/location', [
                        'as' => 'register.locationPage',
                        'uses' => 'showLocationPage',
                    ]);

                    Route::post('register/save-location', [
                        'as' => 'register.saveLocation',
                        'uses' => 'saveLocation',
                    ]);
                });

                Route::group(['prefix' => 'password', 'as' => 'password.'], function (): void {
                    Route::controller('ForgotPasswordController')->group(function (): void {
                        Route::get('request', [
                            'as' => 'request',
                            'uses' => 'showLinkRequestForm',
                        ]);

                        Route::post('email', [
                            'as' => 'email',
                            'uses' => 'sendResetLinkEmail',
                        ]);
                    });

                    Route::controller('ResetPasswordController')->group(function (): void {
                        Route::get('reset/{token}', [
                            'as' => 'reset',
                            'uses' => 'showResetForm',
                        ]);

                        Route::post('reset', [
                            'as' => 'reset.update',
                            'uses' => 'reset',
                        ]);
                    });
                });
            });

            Route::group([
                'middleware' => [setting('verify_account_email', 0) ? 'account.guest' : 'account'],
            ], function (): void {
                Route::group(['prefix' => 'register/confirm'], function (): void {
                    Route::controller('RegisterController')->group(function (): void {
                        Route::get('resend', [
                            'as' => 'resend_confirmation',
                            'uses' => 'resendConfirmation',
                        ]);
                        Route::get('{email}', [
                            'as' => 'confirm',
                            'uses' => 'confirm',
                        ]);
                    });
                });
            });
        });

        Route::group([
            'middleware' => ['account'],
            'as' => 'public.account.',
            'namespace' => 'Auth',
        ], function (): void {
            Route::group(['prefix' => 'account'], function (): void {
                Route::post('logout', [
                    'as' => 'logout',
                    'uses' => 'LoginController@logout',
                ]);
            });
        });

        Route::group([
            'middleware' => ['account'],
            'as' => 'public.account.',
            'namespace' => 'Fronts',
        ], function (): void {
            Route::group(['prefix' => 'account'], function (): void {
                Route::prefix('custom-fields')->name('custom-fields.')->group(function (): void {
                    Route::get('info', [CustomFieldController::class, 'getInfo'])->name('get-info');
                });

                Route::controller('AccountController')->group(function (): void {
                    // Job Seeker Dashboard
                    Route::get('jobseeker-dashboard', [
                        'as' => 'jobseeker.dashboard',
                        'uses' => 'getDashboard',
                        'middleware' => ['account:' . AccountTypeEnum::JOB_SEEKER],
                    ]);

                    Route::get('overview', [
                        'as' => 'overview',
                        'uses' => 'getOverview',
                    ]);

                    Route::get('settings', [
                        'as' => 'settings',
                        'uses' => 'getSettings',
                    ]);

                    Route::post('settings', [
                        'as' => 'post.settings',
                        'uses' => 'postSettings',
                    ]);

                    Route::get('security', [
                        'as' => 'security',
                        'uses' => 'getSecurity',
                    ]);

                    Route::put('security', [
                        'as' => 'post.security',
                        'uses' => 'postSecurity',
                    ]);

                    Route::post('avatar', [
                        'as' => 'avatar',
                        'uses' => 'postAvatar',
                    ]);

                    Route::delete('avatar', [
                        'as' => 'avatar.destroy',
                        'uses' => 'deleteAvatar',
                    ]);

                    Route::controller('AccountJobController')->group(function (): void {
                        Route::group([
                            'middleware' => ['account:' . AccountTypeEnum::JOB_SEEKER],
                            'as' => 'jobs.',
                        ], function (): void {
                            Route::get('applied-jobs', [
                                'as' => 'applied-jobs',
                                'uses' => 'appliedJobs',
                            ]);

                            Route::get('saved-jobs', [
                                'as' => 'saved',
                                'uses' => 'savedJobs',
                            ]);

                            Route::post('saved-jobs/action/{id?}', [
                                'as' => 'saved.action',
                                'uses' => 'savedJob',
                            ]);
                        });
                    });

                    Route::get('resume-builder', [
                        'as' => 'resume-builder',
                        'uses' => 'getResumeBuilder',
                    ]);

                    Route::get('resume-builder/download', [
                        'as' => 'resume-builder.download',
                        'uses' => 'downloadResume',
                    ]);
                });

                Route::group(['prefix' => 'experiences', 'as' => 'experiences.'], function (): void {
                    Route::resource('', AccountExperienceController::class)->parameters(['' => 'experience']);
                });

                Route::group(['prefix' => 'educations', 'as' => 'educations.'], function (): void {
                    Route::resource('', AccountEducationController::class)->parameters(['' => 'education']);
                });

                Route::prefix('languages')->name('languages.')->group(function (): void {
                    Route::post('', [AccountLanguageController::class, 'store'])->name('store');
                    Route::delete('{id}', [AccountLanguageController::class, 'destroy'])->name('destroy');
                });
            });
        });
    });

    Route::group([
        'middleware' => ['web', 'core'],
        'as' => 'public.account.',
        'namespace' => 'Fronts',
    ], function (): void {
        Route::group([
            'prefix' => 'account',
            'middleware' => ['account:' . AccountTypeEnum::EMPLOYER, LocaleMiddleware::class],
        ], function (): void {
            Route::get('dashboard', [
                'as' => 'dashboard',
                'uses' => 'DashboardController@index',
            ]);

            Route::get('employer/settings', [
                'as' => 'employer.settings.edit',
                'uses' => 'EmployerSettingController@edit',
                'middleware' => [LocaleMiddleware::class],
            ]);

            Route::post('employer/settings', [
                'as' => 'employer.settings.update',
                'uses' => 'EmployerSettingController@update',
            ]);

            Route::group([
                'prefix' => 'companies',
                'as' => 'companies.',
            ], function (): void {
                Route::resource('', 'CompanyController')->parameters(['' => 'companies']);
            });

            Route::group([
                'prefix' => 'reviews',
                'as' => 'reviews.',
            ], function (): void {
                Route::resource('', 'AccountReviewController')->parameters(['' => 'review'])->only(['index', 'destroy']);
            });

            Route::group([
                'prefix' => 'applicants',
                'as' => 'applicants.',
            ], function (): void {
                Route::resource('', 'ApplicantController')
                    ->parameters(['' => 'applicant'])
                    ->only(['index', 'edit', 'update', 'destroy']);
            });

            Route::get('applicants/download-cv/{application}', [JobApplicationController::class, 'downloadCv'])
                ->name('applicants.download-cv')->wherePrimaryKey('application');

            Route::group([
                'prefix' => 'jobs',
                'as' => 'jobs.',
            ], function (): void {
                Route::resource('', 'AccountJobController')->parameters(['' => 'job']);

                Route::controller('AccountJobController')->group(function (): void {
                    Route::post('renew/{id}', [
                        'as' => 'renew',
                        'uses' => 'renew',
                    ])->wherePrimaryKey();

                    Route::get('{id}/analytics', [
                        'as' => 'analytics',
                        'uses' => 'analytics',
                    ])->wherePrimaryKey();

                    Route::get('tags/all', [
                        'as' => 'tags.all',
                        'uses' => 'getAllTags',
                    ]);
                });
            });

            Route::group([
                'prefix' => 'packages',
                'middleware' => [
                    'account:' . AccountTypeEnum::EMPLOYER,
                    'enable-credits',
                    LocaleMiddleware::class,
                ],
            ], function (): void {
                Route::controller('DashboardController')->group(function (): void {
                    Route::get('/', [
                        'as' => 'packages',
                        'uses' => 'getPackages',
                    ]);

                    Route::get('{id}/subscribe', [
                        'as' => 'package.subscribe',
                        'uses' => 'getSubscribePackage',
                    ])->wherePrimaryKey();

                    Route::get('{id}/subscribe/callback', [
                        'as' => 'package.subscribe.callback',
                        'uses' => 'getPackageSubscribeCallback',
                    ])->wherePrimaryKey();

                    Route::put('/', [
                        'as' => 'package.subscribe.put',
                        'uses' => 'subscribePackage',
                    ]);
                });
            });

            Route::group([
                'prefix' => 'invoices',
                'as' => 'invoices.',
            ], function (): void {
                Route::resource('', 'InvoiceController')
                    ->only('index')
                    ->parameters('invoices');
                Route::get('{invoice}', 'InvoiceController@show')->name('show')->wherePrimaryKey();
                Route::get('{invoice}/generate-invoice', 'InvoiceController@getGenerateInvoice')
                    ->name('generate_invoice')
                    ->wherePrimaryKey();
            });
        });

        Route::group(['prefix' => 'ajax/accounts'], function (): void {
            Route::controller('AccountController')->group(function (): void {
                Route::get('activity-logs', [
                    'as' => 'activity-logs',
                    'uses' => 'getActivityLogs',
                ]);

                Route::post('upload', [
                    'as' => 'upload',
                    'uses' => 'postUpload',
                ]);

                Route::post('upload-resume', [
                    'as' => 'upload-resume',
                    'uses' => 'postUploadResume',
                ]);

                Route::post('upload-from-editor', [
                    'as' => 'upload-from-editor',
                    'uses' => 'postUploadFromEditor',
                ]);
            });

            Route::group([
                'middleware' => [
                    'account:' . AccountTypeEnum::EMPLOYER,
                    'enable-credits',
                    LocaleMiddleware::class,
                ],
            ], function (): void {
                Route::controller('DashboardController')->group(function (): void {
                    Route::get('transactions', [
                        'as' => 'ajax.transactions',
                        'uses' => 'ajaxGetTransactions',
                    ]);

                    Route::get('packages', [
                        'as' => 'ajax.packages',
                        'uses' => 'ajaxGetPackages',
                    ]);
                });

                Route::prefix('coupon')->name('coupon.')->group(function (): void {
                    Route::post('apply', [CouponController::class, 'apply'])->name('apply');
                    Route::post('remove', [CouponController::class, 'remove'])->name('remove');
                    Route::get('refresh/{id}', [CouponController::class, 'refresh'])->name('refresh');
                });
            });
        });
    });
});
