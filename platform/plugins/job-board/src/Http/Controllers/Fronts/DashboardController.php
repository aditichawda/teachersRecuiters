<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\Assets;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Http\Resources\AccountResource;
use Botble\JobBoard\Http\Resources\PackageResource;
use Botble\JobBoard\Http\Resources\TransactionResource;
use Botble\JobBoard\Enums\InvoiceStatusEnum;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountActivityLog;
use Botble\JobBoard\Models\Invoice;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Supports\InvoiceHelper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Botble\JobBoard\Services\CouponService;
use Botble\Language\Facades\Language;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Botble\PayPal\Services\Gateways\PayPalPaymentService;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends BaseController
{
    public function index()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $this->pageTitle(trans('plugins/job-board::messages.dashboard'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.dashboard'));

        $totalcompanies = $account->companies()->count();

        // @phpstan-ignore-next-line
        $totalJobs = Job::query()
            ->select(['jb_jobs.id'])
            ->byAccount($account->getKey())
            ->count();

        $totalApplicants = JobApplication::query()
            ->select(['jb_applications.id'])
            ->whereHas('job', function (Builder $query) use ($account): void {
                // @phpstan-ignore-next-line
                $query->byAccount($account->getKey());
            })
            ->count();

        // @phpstan-ignore-next-line
        $expiredJobs = Job::query()
            ->select([
                'id',
                'name',
                'status',
                'company_id',
                'expire_date',
            ])
            ->byAccount($account->getKey())
            ->where(function ($query): void {
                $warningDays = (int) setting('job_board_job_expiration_warning_days', 30);
                if ($warningDays < 1) {
                    $warningDays = 30;
                }

                $query->where('jb_jobs.expire_date', '>=', Carbon::now())
                    ->where('jb_jobs.expire_date', '<=', Carbon::now()->addDays($warningDays))
                    ->where('never_expired', false);
            })
            ->with('company')
            ->withCount(['applicants'])
            ->orderBy('jb_jobs.expire_date', 'asc')
            ->get();

        $newApplicants = JobApplication::query()
            ->select([
                'jb_applications.id',
                'jb_applications.first_name',
                'jb_applications.last_name',
                'jb_applications.email',
                'jb_applications.phone',
            ])
            ->whereHas('job', function (Builder $query) use ($account): void {
                // @phpstan-ignore-next-line
                $query->byAccount($account->getKey());
            })
            ->orderBy('jb_applications.created_at', 'desc')
            ->limit(10)
            ->get();

        $activities = AccountActivityLog::query()
            ->where('account_id', $account->getKey())
            ->latest('created_at')
            ->paginate(10);

        $data = compact('totalJobs', 'totalcompanies', 'totalApplicants', 'expiredJobs', 'newApplicants', 'activities');

        if ($account->isEmployer() && method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
            return JobBoardHelper::view('dashboard.index-consultant', $data);
        }

        return JobBoardHelper::view('dashboard.index', $data);
    }

    public function getPackages()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $this->pageTitle(trans('plugins/job-board::messages.packages'));
        SeoHelper::setTitle(trans('plugins/job-board::messages.packages'));

        Assets::addScriptsDirectly('vendor/core/plugins/job-board/js/components.js');
        Assets::usingVueJS();

        $account->load(['packages']);
        $packageType = $account->isEmployer() ? 'employer' : 'job-seeker';
        $packagesQuery = Package::query()
            ->wherePublished()
            ->where('package_type', $packageType)
            ->when($packageType === 'employer' && Schema::hasColumn('jb_packages', 'show_for_consultancy'), function ($query) use ($account) {
                if (method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
                    $query->where('show_for_consultancy', true);
                } else {
                    $query->where('show_for_school_institution', true);
                }
            })
            ->when($packageType === 'employer' && Schema::hasColumn('jb_packages', 'visible_for_account_ids'), function ($query) use ($account) {
                $query->where(function ($sub) use ($account) {
                    $sub->whereNull('visible_for_account_ids')
                        ->orWhereJsonContains('visible_for_account_ids', (int) $account->getKey());
                });
            })
            ->latest('order')
            ->withCount([
                'accounts' => function ($query) use ($account): void {
                    $query->where('account_id', $account->getKey());
                },
            ])
            ;

        $packages = $packagesQuery->get();

        try {
            if (is_plugin_active('language') && is_plugin_active('language-advanced')) {
                Language::setCurrentAdminLocale(App::getLocale());
                LanguageAdvancedManager::initModelRelations();
                $packages->load('translations');
            }
        } catch (\Throwable $e) {
            // If language/translations fail, continue without translations
        }

        $paidPackages = $packages->filter(function ($package) {
            return $package->total_price > 0;
        });

        $freePackages = $packages->filter(function ($package) {
            return $package->total_price == 0;
        });

        $data = compact('paidPackages', 'freePackages', 'packages');

        return JobBoardHelper::view('dashboard.packages', $data);
    }

    public function ajaxGetPackages()
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $account = Account::query()
            ->with(['packages'])
            ->findOrFail(auth('account')->id());

        $packageType = $account->isEmployer() ? 'employer' : 'job-seeker';
        $packagesQuery = Package::query()
            ->wherePublished()
            ->where('package_type', $packageType)
            ->when($packageType === 'employer' && Schema::hasColumn('jb_packages', 'show_for_consultancy'), function ($query) use ($account) {
                if (method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
                    $query->where('show_for_consultancy', true);
                } else {
                    $query->where('show_for_school_institution', true);
                }
            });

        $packagesQuery
            ->when($packageType === 'employer' && Schema::hasColumn('jb_packages', 'visible_for_account_ids'), function ($query) use ($account) {
                $query->where(function ($sub) use ($account) {
                    $sub->whereNull('visible_for_account_ids')
                        ->orWhereJsonContains('visible_for_account_ids', (int) $account->getKey());
                });
            });

        $packages = $packagesQuery->get();

        if (is_plugin_active('language') && is_plugin_active('language-advanced')) {
            Language::setCurrentAdminLocale(App::getLocale());
            LanguageAdvancedManager::initModelRelations();

            $packages->load('translations');
        }

        $packages = $packages->filter(function ($package) use ($account) {
            return $package->account_limit === null || $account->packages->where(
                'id',
                $package->id
            )->count() < $package->account_limit;
        });

        return $this
            ->httpResponse()
            ->setData([
                'packages' => PackageResource::collection($packages),
                'account' => new AccountResource($account),
            ]);
    }

    public function subscribePackage(
        Request $request,
    ) {
        $id = $request->input('id');
        abort_if(! JobBoardHelper::isEnabledCreditsSystem() || ! $id, 404);

        /**
         * @var Package $package
         */
        $package = $this->getPackageById($id);

        /**
         * @var Account $account
         */
        $account = Account::query()->findOrFail(auth('account')->id());

        abort_if($package->account_limit && $account->packages()->where(
            'package_id',
            $package->id
        )->count() >= $package->account_limit, 403);

        if ((float) $package->price) {
            session(['subscribed_packaged_id' => $package->id]);
            $checkoutUrl = route('public.account.package.subscribe.checkout', $package->id);

            if ($request->expectsJson()) {
                return $this->httpResponse()
                    ->setNextUrl($checkoutUrl)
                    ->setMessage(trans('plugins/job-board::package.subscribe_package', ['name' => $package->name]));
            }

            return redirect()->to($checkoutUrl);
        }

        $this->savePayment($package, null, true);

        return $this
            ->httpResponse()

            ->setData(new AccountResource($account->refresh()))
            ->setMessage(trans('plugins/job-board::package.add_credit_success'));
    }

    protected function getPackageById(int $id)
    {
        $package = Package::query()
            ->where([
                'id' => $id,
                'status' => BaseStatusEnum::PUBLISHED,
            ])
            ->firstOrFail();

        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        if ($package->account_limit) {
            $accountLimit = $account->packages()->where('package_id', $package->getKey())->count();
            abort_if($accountLimit >= $package->account_limit, 403);
        }

        // Enforce employer visibility rules (School/Institution vs Consultancy + specific employers)
        if (
            $account->isEmployer()
            && $package->package_type === 'employer'
            && Schema::hasColumn('jb_packages', 'show_for_consultancy')
        ) {
            if (method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
                abort_if(! (bool) $package->show_for_consultancy, 403);
            } else {
                abort_if(! (bool) $package->show_for_school_institution, 403);
            }
        }

        if (
            $account->isEmployer()
            && $package->package_type === 'employer'
            && Schema::hasColumn('jb_packages', 'visible_for_account_ids')
        ) {
            $visibleFor = $package->visible_for_account_ids;
            if (is_array($visibleFor) && count(array_filter($visibleFor)) > 0) {
                abort_if(! in_array((int) $account->getKey(), array_map('intval', $visibleFor), true), 403);
            }
        }

        return $package;
    }

    protected function savePayment(Package $package, ?string $chargeId, bool $force = false)
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        $payment = Payment::query()
            ->where('charge_id', $chargeId)
            ->first();

        if (! $payment && ! $force) {
            return false;
        }

        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        if ($payment && (! $payment->customer_id || ! $payment->customer_type)) {
            $payment->customer_id = $account->getKey();
            $payment->customer_type = Account::class;
            $payment->order_id = $payment->order_id ?: $package->getKey();
            $payment->save();
        }

        if (($payment && $payment->status == PaymentStatusEnum::COMPLETED) || $force) {
            $creditsToAdd = $package->credits_included ?? $package->number_of_listings;
            $account->credits += $creditsToAdd;
            $account->save();

            $account->packages()->attach($package);
        }

        $accountType = $account->isEmployer() ? 'employer' : 'job_seeker';
        $userDetails = [
            'name' => $account->name,
            'email' => $account->email,
            'phone' => $account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : null,
            'address' => $account->address,
            'state' => $account->state_name,
            'city' => $account->city_name,
            'country' => $account->country_name,
        ];
        $institutionName = null;
        if ($account->isEmployer()) {
            $company = $account->companies()->first();
            $institutionName = $company ? $company->name : null;
        }

        Transaction::query()->create([
            'user_id' => 0,
            'account_id' => $account->getKey(),
            'account_type' => $accountType,
            'user_details' => $userDetails,
            'institution_name' => $institutionName,
            'credits' => $creditsToAdd ?? ($package->credits_included ?? $package->number_of_listings),
            'payment_id' => $payment?->id,
            'package_id' => $package->getKey(),
            'package_name' => $package->name,
        ]);

        if ($payment && $payment->status == PaymentStatusEnum::COMPLETED) {
            $invoiceExists = \Botble\JobBoard\Models\Invoice::query()->where('payment_id', $payment->id)->exists();
            if (! $invoiceExists) {
                $invoiceCreated = InvoiceHelper::store([
                    'order_id' => $package->getKey(),
                    'customer_type' => Account::class,
                    'customer_id' => $account->getKey(),
                    'charge_id' => $payment->charge_id,
                    'status' => PaymentStatusEnum::COMPLETED,
                    'amount' => (float) $payment->amount,
                    'discount_amount' => Session::get('coupon_discount_amount', 0),
                    'coupon_code' => Session::get('applied_coupon_code'),
                ]);
                if (! $invoiceCreated) {
                    \Illuminate\Support\Facades\Log::warning('JobBoard: Invoice could not be created for payment.', [
                        'payment_id' => $payment->id,
                        'charge_id' => $payment->charge_id,
                        'package_id' => $package->getKey(),
                        'order_id_on_payment' => $payment->order_id,
                    ]);
                }
            }
        }

        $emailHandler = EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME);

        if (! $package->price) {
            $emailHandler
                ->setVariableValues([
                    'account_name' => $account->name,
                    'account_email' => $account->email,
                ])
                ->sendUsingTemplate('free-credit-claimed');
        } else {
            $emailHandler
                ->setVariableValues([
                    'account_name' => $account->name,
                    'account_email' => $account->email,
                    'package_name' => $package->name,
                    'package_price' => $package->price ?: 0,
                    'package_percent_discount' => $package->percent_save,
                    'package_number_of_listings' => $package->number_of_listings ?: 1,
                    'package_price_per_credit' => $package->price ? $package->price / ($package->number_of_listings ?: 1) : 0,
                ])
                ->sendUsingTemplate('payment-received');
        }

        $emailHandler
            ->setVariableValues([
                'account_name' => $account->name,
                'account_email' => $account->email,
                'package_name' => $package->name,
                'package_price' => $package->price ?: 0,
                'package_percent_discount' => $package->percent_save,
                'package_number_of_listings' => $package->number_of_listings ?: 1,
                'package_price_per_credit' => $package->price ? $package->price / ($package->number_of_listings ?: 1) : 0,
            ])
            ->sendUsingTemplate('payment-receipt', auth('account')->user()->email);

        return true;
    }

    public function getSubscribePackage(int|string $id, CouponService $service)
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        Assets::addScripts('form-validation');

        $package = $this->getPackageById($id);

        Session::put('cart_total', $package->price);
        Session::put('subscribed_packaged_id', $package->id);

        SeoHelper::setTitle(trans('plugins/job-board::package.subscribe_package', ['name' => $package->name]));

        add_filter(PAYMENT_FILTER_AFTER_PAYMENT_METHOD, function () use ($service, $package) {
            $totalAmount = $service->getAmountAfterDiscount(
                Session::get('coupon_discount_amount', 0),
                $package->price
            );

            return view('plugins/job-board::coupons.partials.form', compact('package', 'totalAmount'));
        });

        $account = auth('account')->user();

        $walletUrl = $account->isJobSeeker()
            ? route('public.account.jobseeker.wallet')
            : route('public.account.wallet');

        return view(JobBoardHelper::viewPath('dashboard.checkout'), compact('package', 'account', 'walletUrl'));
    }

    public function getPackageSubscribeCallback(int $packageId, Request $request)
    {
        abort_unless(JobBoardHelper::isEnabledCreditsSystem(), 404);

        /**
         * @var Package $package
         */
        $package = $this->getPackageById($packageId);

        if (is_plugin_active('paypal') && $request->input('type') == PAYPAL_PAYMENT_METHOD_NAME) {
            $validator = Validator::make($request->input(), [
                'amount' => ['required', 'numeric'],
                'currency' => ['required'],
            ]);

            if ($validator->fails()) {
                return $this
                    ->httpResponse()
                    ->setError()->setMessage($validator->getMessageBag()->first());
            }

            $payPalService = app(PayPalPaymentService::class);

            $paymentStatus = $payPalService->getPaymentStatus($request);
            if ($paymentStatus) {
                $chargeId = session('paypal_payment_id');

                $payPalService->afterMakePayment($request->input());

                $this->savePayment($package, $chargeId);

                $walletUrl = auth('account')->user()->isJobSeeker()
                    ? route('public.account.jobseeker.wallet')
                    : route('public.account.wallet');

                return $this
                    ->httpResponse()
                    ->setNextUrl($walletUrl)
                    ->setMessage(trans('plugins/job-board::package.add_credit_success'));
            }

            $walletUrl = auth('account')->user()->isJobSeeker()
                ? route('public.account.jobseeker.wallet')
                : route('public.account.wallet');

            return $this
                ->httpResponse()
                ->setError()
                ->setNextUrl($walletUrl)
                ->setMessage($payPalService->getErrorMessage());
        }

        $chargeId = $request->input('charge_id');
        if ($chargeId) {
            $payment = Payment::query()->where('charge_id', $chargeId)->first();
            // Mark COMPLETED if still PENDING (COD, Razorpay, or any gateway that redirected here after success).
            if ($payment && $payment->status != PaymentStatusEnum::COMPLETED) {
                $payment->status = PaymentStatusEnum::COMPLETED;
                $payment->save();
                Invoice::query()
                    ->where('reference_id', $package->getKey())
                    ->where('reference_type', Package::class)
                    ->update(['status' => InvoiceStatusEnum::COMPLETED]);
            }
        }
        $this->savePayment($package, $chargeId);

        $walletUrl = auth('account')->user()->isJobSeeker()
            ? route('public.account.jobseeker.wallet')
            : route('public.account.wallet');

        if (! $request->has('success') || $request->input('success')) {
            return redirect()->to($walletUrl);
        }

        return redirect()->to($walletUrl);
    }

    public function ajaxGetTransactions()
    {
        $transactions = Transaction::query()
            ->where('account_id', auth('account')->id())->latest()
            ->with(['payment', 'user'])
            ->paginate(10);

        return $this
            ->httpResponse()
            ->setData(TransactionResource::collection($transactions))->toApiResponse();
    }

    public function candidates(Request $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        abort_unless($account->isEmployer(), 403, __('Only employers can view candidates'));

        $this->pageTitle(__('All Candidates'));
        SeoHelper::setTitle(__('All Candidates'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.dashboard'), route('public.account.dashboard'))
            ->add(__('All Candidates'));

        // Set layout same as companies page
        Theme::layout('job-board.dashboard.layouts.master');

        // Get filtered candidates
        $input = $request->all();
        $candidates = JobBoardHelper::filterCandidates($input);

        $orderByParams = JobBoardHelper::getSortByParams();
        $layout = $request->query('layout', 'grid');

        // Debug counts to quickly confirm whether candidate data exists and is eligible for listing
        $totalJobSeekers = Account::query()->where('type', \Botble\JobBoard\Enums\AccountTypeEnum::JOB_SEEKER)->count();
        $publicJobSeekers = Account::query()
            ->where('type', \Botble\JobBoard\Enums\AccountTypeEnum::JOB_SEEKER)
            ->where('is_public_profile', 1)
            ->count();
        $eligibleJobSeekers = $publicJobSeekers;
        if (setting('verify_account_email', 0)) {
            $eligibleJobSeekers = Account::query()
                ->where('type', \Botble\JobBoard\Enums\AccountTypeEnum::JOB_SEEKER)
                ->where('is_public_profile', 1)
                ->whereNotNull('confirmed_at')
                ->count();
        }

        $data = compact(
            'candidates',
            'orderByParams',
            'layout',
            'totalJobSeekers',
            'publicJobSeekers',
            'eligibleJobSeekers'
        );

        return JobBoardHelper::view('account.candidates', $data);
    }
}
