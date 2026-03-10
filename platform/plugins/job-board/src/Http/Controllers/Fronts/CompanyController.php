<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\CompanyForm;
use Botble\JobBoard\Http\Requests\AccountCompanyRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountActivityLog;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Tables\Fronts\CompanyTable;
use Botble\Media\Facades\RvMedia;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Services\SlugService;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\Transaction;

class CompanyController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            abort_unless(JobBoardHelper::employerManageCompanyInfo(), 403);

            return $next($request);
        });

        $this->middleware(function (Request $request, Closure $next) {
            /**
             * @var Account $account
             */
            $account = $request->user('account');

            abort_if(! JobBoardHelper::employerCreateMultiplecompanies() && $account->companies()->exists(), 403);

            return $next($request);
        })->only(['create', 'store']);
    }

    public function index(CompanyTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::messages.companies'));

        SeoHelper::setTitle(trans('plugins/job-board::messages.companies'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::messages.companies'));

        return $table->render(JobBoardHelper::viewPath('dashboard.table.base'));
    }

    public function create()
    {
        $account = auth('account')->user();
        if ($account && JobBoardHelper::employerCreateMultiplecompanies() && JobBoardHelper::isEnabledCreditsSystem() && $account->companies()->count() >= 1) {
            $required = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE, 500);
            if ((int) $account->credits < $required) {
                return redirect()
                    ->to(route('public.account.wallet'))
                    ->with('error_msg', __('To add another institution you need :credits credits. Please buy or use credits from Wallet.', ['credits' => $required]));
            }
        }

        SeoHelper::setTitle(trans('plugins/job-board::messages.create_a_company'));
        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::messages.companies'), route('public.account.companies.index'))
            ->add(trans('plugins/job-board::messages.create_a_company'));

        $this->pageTitle(trans('plugins/job-board::messages.create_a_company'));

        Assets::addStyles(['datetimepicker'])
            ->addScripts([
                'moment',
                'datetimepicker',
                'jquery-ui',
                'input-mask',
                'blockui',
            ]);

        return CompanyForm::create()->renderForm();
    }

    public function store(AccountCompanyRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

<<<<<<< HEAD
        // Additional Employer Profile (per new profile): first company free, from second onwards deduct credits (unless already deducted via popup)
        $creditsAlreadyDeducted = (bool) $request->input('credits_already_deducted');
        if (JobBoardHelper::employerCreateMultiplecompanies() && JobBoardHelper::isEnabledCreditsSystem()) {
            $existingCount = $account->companies()->count();
            if ($existingCount >= 1 && ! $creditsAlreadyDeducted) {
=======
        // Additional Employer Profile (per new profile): first company free, from second onwards deduct credits
        if (JobBoardHelper::employerCreateMultiplecompanies() && JobBoardHelper::isEnabledCreditsSystem()) {
            $existingCount = $account->companies()->count();
            if ($existingCount >= 1) {
>>>>>>> 37fac6c5 (10 march)
                $profileCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE, 500);
                if ($account->credits < $profileCredits) {
                    return $this->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.insufficient_credits') . ' ' . __('Additional institution requires :credits credits.', ['credits' => $profileCredits]));
                }
                $ok = CreditConsumption::deductForFeature(
                    $account,
                    CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE,
                    $profileCredits,
                    'Additional Employer Profile (per new profile)',
                    ['company_create' => true]
                );
                if (! $ok) {
                    return $this->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.insufficient_credits'));
                }
            }
        }

        $request->merge([
            'status' => setting('verify_account_created_company', 1) == 1 ? BaseStatusEnum::PENDING : BaseStatusEnum::PUBLISHED,
            'logo' => null,
            'cover_image' => null,
            'is_featured' => false,
        ]);

        $request = $this->handleUpload($request);

        /** @var \Botble\JobBoard\Models\Company $company */
        $company = Company::query()->create($request->input());

        $company->accounts()->syncWithoutDetaching(['account_id' => $account->getKey()]);

        $slug = app(SlugService::class)->create($request->input('name'), 0, Company::class);

        $request->merge(compact('slug'));

        if (SlugHelper::isSupportedModel(Company::class)) {
            try {
                SlugHelper::createSlug($company, $slug);
            } catch (\Throwable $e) {
                // ignore
            }
        }

        event(new CreatedContentEvent(COMPANY_MODULE_SCREEN_NAME, $request, $company));

        if ($this->hasFeaturedProfileEntitlement($account)) {
            $company->is_featured = 1;
            $company->saveQuietly();
        }

        AccountActivityLog::query()->create([
            'action' => 'create_company',
            'reference_name' => $company->name,
            'reference_url' => route('public.account.companies.edit', $company->id),
        ]);

        EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'company_name' => $company->name,
                'company_url' => route('companies.edit', $company->id),
                'employer_name' => $account->name,
            ])
            ->sendUsingTemplate('new-company-profile-created');

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.companies.index'))
            ->setNextUrl(route('public.account.companies.edit', $company->id))
            ->setMessage(trans('plugins/job-board::messages.create_company_successfully'));
    }

    protected function handleUpload(Request $request)
    {
        if ($request->hasFile('logo_input')) {
            $result = RvMedia::handleUpload($request->file('logo_input'), 0, 'companies');
            if (! $result['error']) {
                $file = $result['data'];
                $request->merge(['logo' => $file->url]);
            }
        }

        if ($request->hasFile('cover_image_input')) {
            $result = RvMedia::handleUpload($request->file('cover_image_input'), 0, 'companies');
            if (! $result['error']) {
                $file = $result['data'];
                $request->merge(['cover_image' => $file->url]);
            }
        }

        return $request;
    }

    protected function getCompany(int $id, int $accountId)
    {
        return Company::query()
            ->select(['jb_companies.*'])
            ->where('id', $id)
            ->whereHas('accounts', function ($query) use ($accountId): void {
                $query->where('account_id', $accountId);
            })
            ->first();
    }

    public function edit(int|string $id)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $company = $this->getCompany($id, $account->getKey());
        abort_unless($company, 404);

        $title = trans('plugins/job-board::messages.edit_company', ['name' => $company->name]);
        SeoHelper::setTitle($title);
        $this->pageTitle($title);

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::messages.companies'), route('public.account.companies.index'))
            ->add($title);

        Assets::addStyles(['datetimepicker'])
            ->addScripts([
                'moment',
                'datetimepicker',
                'jquery-ui',
                'input-mask',
                'blockui',
            ]);

        return CompanyForm::createFromModel($company)
            ->renderForm();
    }

    public function update(int|string $id, AccountCompanyRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $company = $this->getCompany($id, $account->getKey());
        abort_unless($company, 404);

        $request->except([
            'status',
            'logo',
            'cover_image',
            'is_featured',
        ]);

        $request = $this->handleUpload($request);

        $company->fill($request->input());
        $company->save();

        if ($this->hasFeaturedProfileEntitlement($account)) {
            $company->is_featured = 1;
            $company->saveQuietly();
        }

        event(new UpdatedContentEvent(COMPANY_MODULE_SCREEN_NAME, $request, $company));

        AccountActivityLog::query()->create([
            'action' => 'update_company',
            'reference_name' => $company->name,
            'reference_url' => route('public.account.companies.edit', $company->id),
        ]);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.companies.index'))
            ->setNextUrl(route('public.account.companies.edit', $company->id))
            ->setMessage(trans('plugins/job-board::messages.update_company_successfully'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            /**
             * @var Account $account
             */
            $account = auth('account')->user();

            $company = $this->getCompany($id, $account->getKey());
            abort_unless($company, 404);

            $company->delete();

            event(new DeletedContentEvent(COMPANY_MODULE_SCREEN_NAME, $request, $company));

            AccountActivityLog::query()->create([
                'action' => 'delete_company',
                'reference_name' => $company->name,
            ]);

            return $this
                ->httpResponse()
                ->withDeletedSuccessMessage();
        } catch (Exception $exception) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * Employer has used credits for Featured Profile and entitlement is still valid (package not expired, or used within 365 days).
     */
    private function hasFeaturedProfileEntitlement(Account $account): bool
    {
        try {
            if (! Schema::hasColumn('jb_transactions', 'feature_key')) {
                return false;
            }

            $debit = Transaction::query()
                ->where('account_id', $account->getKey())
                ->where('type', Transaction::TYPE_DEBIT)
                ->where('feature_key', CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER)
                ->latest()
                ->first();

            if (! $debit || ! $debit->created_at) {
                return false;
            }

            $lastPurchase = Transaction::query()
                ->where('account_id', $account->getKey())
                ->where(function ($q): void {
                    $q->whereNull('type')->orWhere('type', '!=', 'deduct');
                })
                ->whereNotNull('payment_id')
                ->whereNotNull('package_id')
                ->with('package')
                ->latest()
                ->first();

            if ($lastPurchase && $lastPurchase->package && $lastPurchase->package->validity_days && $lastPurchase->created_at) {
                $packageExpiryAt = Carbon::parse($lastPurchase->created_at)->addDays($lastPurchase->package->validity_days);
                if (Carbon::now()->lte($packageExpiryAt)) {
                    return true;
                }
            }

            $debitDate = $debit->created_at instanceof \DateTimeInterface
                ? Carbon::parse($debit->created_at)
                : Carbon::parse((string) $debit->created_at);

            return $debitDate->gte(Carbon::now()->subDays(365));
        } catch (\Throwable $e) {
            Log::warning('JobBoard: hasFeaturedProfileEntitlement failed', ['account_id' => $account->getKey(), 'error' => $e->getMessage()]);
            return false;
        }
    }
}
