<?php

/**
 * Cursor AI: Merge conflicts resolved, job create success flow (session/email), stash apply (16 Feb changes) - 17 Feb 2026
 * @see CURSOR_AI_CHANGES.md for full list of changes
 */
namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\JobStatusEnum;
use Botble\JobBoard\Enums\ModerationStatusEnum;
use Botble\JobBoard\Enums\SalaryRangeEnum;
use Botble\JobBoard\Events\EmployerPostedJobEvent;
use Botble\JobBoard\Events\JobPublishedEvent;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\JobForm;
use Botble\JobBoard\Http\Requests\AccountJobRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountActivityLog;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\Currency;
use Botble\JobBoard\Models\CustomFieldValue;
use Botble\JobBoard\Models\DegreeLevel;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Models\JobExperience;
use Botble\JobBoard\Models\JobScreeningQuestion;
use Botble\JobBoard\Models\ScreeningQuestion;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Models\JobShift;
use Botble\JobBoard\Models\JobSkill;
use Illuminate\Support\Facades\Schema;
use Botble\JobBoard\Models\JobType;
use Botble\JobBoard\Models\Tag;
use Botble\JobBoard\Repositories\Interfaces\AnalyticsInterface;
use Botble\JobBoard\Services\JobDescriptionAiService;
use Botble\JobBoard\Services\StoreTagService;
use Botble\JobBoard\Supports\PackageContext;
use Botble\JobBoard\Tables\Fronts\JobTable;
use Botble\Media\Facades\RvMedia;
use Botble\Optimize\Facades\OptimizerHelper;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AccountJobController extends BaseController
{
    public function __construct(
        protected AnalyticsInterface $analyticsRepository
    ) {
        OptimizerHelper::disable();
    }

    public function index(JobTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::messages.manage_jobs'));

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::messages.manage_jobs'));

        SeoHelper::setTitle(trans('plugins/job-board::messages.manage_jobs'));

        /**
         * Fallback: if the scheduler isn't running, expired-job notifications will never be generated.
         * So when the employer opens "Manage Jobs", we generate missing "Job Expired" notifications once.
         */
        try {
            /** @var Account|null $account */
            $account = auth('account')->user();

            if ($account instanceof Account) {
                $cacheKey = 'job_board:expired_notif_fallback:account:' . $account->getKey();

                // Throttle to avoid repeated scans on every page load.
                if (Cache::add($cacheKey, 1, now()->addMinutes(10))) {
                    $expiredJobs = Job::query()
                        ->where('author_type', Account::class)
                        ->where('author_id', $account->getKey())
                        ->where('never_expired', false)
                        ->whereNotNull('expire_date')
                        ->where('expire_date', '<=', Carbon::now())
                        ->with(['author', 'company'])
                        ->orderBy('expire_date', 'desc')
                        ->limit(25)
                        ->get(['id', 'name', 'author_id', 'author_type', 'company_id', 'expire_date']);

                    foreach ($expiredJobs as $job) {
                        if (! $job->author instanceof Account) {
                            continue;
                        }

                        $alreadySent = \Botble\JobBoard\Models\UserNotification::query()
                            ->where('account_id', $job->author->getKey())
                            ->where('type', \Botble\JobBoard\Services\NotificationService::TYPE_JOB_EXPIRED)
                            ->where('data->job_id', $job->id)
                            ->exists();

                        if ($alreadySent) {
                            continue;
                        }

                        $institutionName = $job->company?->name
                            ?: ($job->hiring_school_name ?: $job->author->name);

                        app(\Botble\JobBoard\Services\NotificationService::class)->sendJobExpiredNotification(
                            $job->author,
                            $job->name,
                            $job->id,
                            $job->expire_date,
                            $institutionName
                        );
                    }

                    Log::info('[JOB_EXPIRED_FALLBACK] Checked expired jobs from /account/jobs', [
                        'account_id' => $account->getKey(),
                        'expired_jobs_found' => $expiredJobs->count(),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::warning('[JOB_EXPIRED_FALLBACK] Failed to run fallback check', [
                'error' => $e->getMessage(),
            ]);
        }

        return $table->render(JobBoardHelper::viewPath('dashboard.table.base'), [], [
            'layout' => JobBoardHelper::viewPath('dashboard.layouts.master'),
            'account' => $account,
        ]);
    }

    /**
     * Generate job description using AI (Gemini or OpenAI). Called via AJAX from job create form.
     * Uses title, optional short_description, and optional institution_title (institle) for the prompt.
     */
    public function generateDescription(Request $request, JobDescriptionAiService $aiService)
    {
        try {
            $title = is_string($request->input('title')) ? trim($request->input('title')) : '';
            $institutionTitle = is_string($request->input('institution_title')) ? trim($request->input('institution_title')) : '';

            if ($title === '') {
                return response()->json(['success' => false, 'message' => __('Please enter a job title first.')], 422);
            }

            if (! $aiService->isEnabled()) {
                return response()->json([
                    'success' => false,
                    'message' => __('AI is not configured. Set GEMINI_API_KEY or OPENAI_API_KEY in .env and JOB_BOARD_AI_PROVIDER to gemini or openai.'),
                ], 503);
            }

            $result = $aiService->generateFromTitle($title, '', $institutionTitle);

            if ($result['error'] !== null) {
                return response()->json([
                    'success' => false,
                    'message' => $result['error'],
                ], 502);
            }

            return response()->json([
                'success' => true,
                'description' => $result['description'],
                'fallback' => $result['fallback'] ?? false,
                'api_error' => $result['api_error'] ?? null,
            ]);
        } catch (\Throwable $e) {
            Log::error('JobBoard AI generate-description failed.', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Deduct 100 credits for additional email (one-time). Call before allowing "Add email" in UI.
     * Valid till package active. If already has entitlement, returns success without deducting.
     */
    public function deductAdditionalEmail(Request $request): JsonResponse
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return response()->json(['success' => false, 'message' => __('Unauthorized.')], 403);
        }
        if (! JobBoardHelper::isEnabledCreditsSystem()) {
            return response()->json(['success' => true, 'has_entitlement' => true]);
        }
        if (CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL)) {
            return response()->json(['success' => true, 'has_entitlement' => true, 'message' => __('Already enabled.')]);
        }
        $emailCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL, 100);
        if ($account->credits < $emailCredits) {
            return response()->json([
                'success' => false,
                'message' => __('Insufficient credits. Need :credits credits (one-time). Valid till your package is active.', ['credits' => $emailCredits]),
            ], 422);
        }
        $ok = CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL,
            $emailCredits,
            __('Additional Email for Application Alerts (one-time). Valid till package active.'),
            ['source' => 'add_email_button']
        );
        if (! $ok) {
            return response()->json(['success' => false, 'message' => __('Insufficient credits.')], 422);
        }
        return response()->json([
            'success' => true,
            'has_entitlement' => true,
            'message' => __('Credits deducted. You can add additional email. Valid till your package is active.'),
            'credits' => (int) $account->fresh()->credits,
        ]);
    }

    /**
     * Deduct 10 credits for one WhatsApp number (one-time per number). Call before allowing "Add phone" in UI.
     * Valid till package active. Max 3 numbers per job.
     */
    public function deductWhatsAppNumber(Request $request): JsonResponse
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return response()->json(['success' => false, 'message' => __('Unauthorized.')], 403);
        }
        if (! JobBoardHelper::isEnabledCreditsSystem()) {
            return response()->json(['success' => true]);
        }
        $wpCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_WP, 10);
        if ($account->credits < $wpCredits) {
            return response()->json([
                'success' => false,
                'message' => __('Insufficient credits. Need :credits credits per number (one-time). Valid till your package is active.', ['credits' => $wpCredits]),
            ], 422);
        }
        $ok = CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_APPLICATION_ALERT_WP,
            $wpCredits,
            __('WhatsApp number for application alerts (one-time per number). Valid till package active.'),
            ['source' => 'add_phone_button']
        );
        if (! $ok) {
            return response()->json(['success' => false, 'message' => __('Insufficient credits.')], 422);
        }
        return response()->json([
            'success' => true,
            'message' => __('Credits deducted. You can add phone number. Valid till your package is active.'),
            'credits' => (int) $account->fresh()->credits,
        ]);
    }

    public function create()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        if ($account && $account->getKey()) {
            $account = Account::find($account->getKey()) ?? $account;
        }

        // Lock job post: no package ever purchased OR (package period invalid and no credits) OR no slot and no credits
        $packageContext = PackageContext::forAccount($account);
        $hasPurchasedPackage = $this->hasPurchasedPackage($account);
        $canPost = $hasPurchasedPackage && $packageContext->canPostJob($account);
        if (JobBoardHelper::isEnabledCreditsSystem() && (! $hasPurchasedPackage || ! $packageContext->canPostJob($account))) {
            return redirect()->route('public.account.wallet')
                ->with('error_msg', trans('plugins/job-board::messages.use_credits_for_job_post'));
        }

        if (JobBoardHelper::employerManageCompanyInfo() && ! $account->companies()->exists()) {
            // Auto-create company from registration data so "Are you hiring" dropdown shows school
            $companyName = $account->institution_name ?: trim($account->first_name . ' ' . $account->last_name);
            if ($companyName) {
                $company = Company::create([
                    'name' => $companyName,
                    'email' => $account->email,
                    'phone' => $account->phone,
                    'institution_type' => $account->institution_type,
                    'country_id' => $account->country_id,
                    'state_id' => $account->state_id,
                    'city_id' => $account->city_id,
                    'status' => 'published',
                ]);
                $account->companies()->attach($company->id);
                if (SlugHelper::isSupportedModel(Company::class)) {
                    try {
                        $existing = SlugHelper::getSlug(null, SlugHelper::getPrefix(Company::class), Company::class, $company->id);
                        if (! $existing) {
                            SlugHelper::createSlug($company, $company->slugSourceWithUniqueId());
                        }
                    } catch (\Throwable $e) {
                        Log::warning('JobBoard: Failed to create slug for company ' . $company->id, ['error' => $e->getMessage()]);
                    }
                }
            } else {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setNextUrl(route('public.account.companies.create'))
                    ->setMessage(trans('plugins/job-board::messages.please_update_company_info'));
            }
        }

        $this->pageTitle(trans('plugins/job-board::messages.post_job'));
        SeoHelper::setTitle(trans('plugins/job-board::messages.post_job'));

        // Prepare data for custom job posting form
        $companies = $account->companies->pluck('name', 'id')->all();
        $companyInstitutionTypes = $account->companies->pluck('institution_type', 'id')->all();

        // Company details for auto-fill
        $companyDetails = [];
        foreach ($account->companies as $company) {
            $cityName = '';
            $stateName = '';
            $countryName = '';

            if ($company->city_id && is_plugin_active('location')) {
                $city = \Botble\Location\Models\City::find($company->city_id);
                $cityName = $city ? $city->name : '';
            }
            if ($company->state_id && is_plugin_active('location')) {
                $state = \Botble\Location\Models\State::find($company->state_id);
                $stateName = $state ? $state->name : '';
            }
            if ($company->country_id && is_plugin_active('location')) {
                $country = \Botble\Location\Models\Country::find($company->country_id);
                $countryName = $country ? $country->name : '';
            }

            $companyDetails[$company->id] = [
                'institution_type' => $company->institution_type,
                'address' => $company->address,
                'postal_code' => $company->postal_code,
                'city_id' => $company->city_id,
                'city_name' => $cityName,
                'state_id' => $company->state_id,
                'state_name' => $stateName,
                'country_id' => $company->country_id,
                'country_name' => $countryName,
            ];
        }

        $screeningQuestions = ScreeningQuestion::query()
            ->wherePublished()
            ->oldest('order')
            ->oldest('id')
            ->get();

        $skills = JobSkill::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $jobTypes = JobType::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $degreeLevels = DegreeLevel::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $jobExperiences = JobExperience::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $jobShifts = JobShift::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $languagesList = [];
        if (Schema::hasTable('languages')) {
            $languagesList = \Illuminate\Support\Facades\DB::table('languages')
                ->orderBy('lang_order')->orderBy('lang_name')
                ->pluck('lang_name')->values()->all();
        }

        $currencies = Currency::query()->oldest('order')->oldest('title')
            ->pluck('title', 'id')->all();

        $salaryRanges = SalaryRangeEnum::labels();

        $job = null;
        $editJobData = null;
        $defaultCompanyId = count($companies) === 1 ? array_key_first($companies) : null;

        $creditsEnabled = JobBoardHelper::isEnabledCreditsSystem();
        $walletUrl = route('public.account.wallet');
        $accountCredits = $creditsEnabled ? (int) $account->credits : 0;
        $emailCreditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL, 100);
        $wpCreditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_WP, 10);

        $view = 'dashboard.jobs.create';
        if ($account->isEmployer() && method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
            $view = 'dashboard.jobs.create-consultant';
        }

        return JobBoardHelper::view($view, compact(
            'account', 'companies', 'companyInstitutionTypes', 'companyDetails',
            'skills', 'jobTypes', 'degreeLevels', 'jobExperiences',
            'jobShifts', 'languagesList', 'currencies', 'salaryRanges', 'canPost', 'screeningQuestions', 'job', 'editJobData', 'defaultCompanyId',
            'walletUrl', 'accountCredits', 'emailCreditsRequired', 'wpCreditsRequired', 'creditsEnabled'
        ));
    }

    public function store(AccountJobRequest $request, StoreTagService $storeTagService)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $packageContext = PackageContext::forAccount($account);
        $jobPostCreditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_JOB_POSTING, 600);
        if (JobBoardHelper::isEnabledCreditsSystem()) {
            $hasPurchasedPackage = $this->hasPurchasedPackage($account);
            if (! $hasPurchasedPackage || ! $packageContext->canPostJob($account)) {
                if ($request->expectsJson()) {
                    return $this->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.insufficient_credits'))
                        ->setNextUrl(route('public.account.wallet'));
                }
                return redirect()->route('public.account.wallet')
                    ->with('error_msg', trans('plugins/job-board::messages.insufficient_credits'));
            }
            if (! $packageContext->jobPostUsesPackageSlot() && $account->credits < $jobPostCreditsRequired) {
                if ($request->expectsJson()) {
                    return $this->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.insufficient_credits'))
                        ->setNextUrl(route('public.account.wallet'));
                }
                return redirect()->route('public.account.wallet')
                    ->with('error_msg', trans('plugins/job-board::messages.insufficient_credits'));
            }
        }

        $canPost = $packageContext->canPostJob($account);
        $this->processRequestData($request);

        $request->except([
            'is_featured',
            'moderation_status',
            'never_expired',
        ]);

        // Remove fields if columns don't exist in database yet
        // This will be enabled after migrations are run
        if ($request->has('apply_internal_phones')) {
            if (!Schema::hasColumn('jb_jobs', 'apply_internal_phones')) {
                $request->request->remove('apply_internal_phones');
            }
        }
        if ($request->has('enable_whatsapp_notifications')) {
            if (!Schema::hasColumn('jb_jobs', 'enable_whatsapp_notifications')) {
                $request->request->remove('enable_whatsapp_notifications');
            }
        }

        // WhatsApp: allow if employer has entitlement (they deducted when adding phone; valid till package)
        if (JobBoardHelper::isEnabledCreditsSystem() && $request->input('enable_whatsapp_notifications')) {
            if (! CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_APPLICATION_ALERT_WP)) {
                $request->merge(['enable_whatsapp_notifications' => 0]);
            }
        }

        // Additional Email (one-time): require entitlement or one-time deduct; else don't save additional emails
        $applyEmails = array_filter((array) $request->input('apply_internal_emails', []));
        if (JobBoardHelper::isEnabledCreditsSystem() && ! empty($applyEmails)) {
            if (! CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL)) {
                $emailCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL, 100);
                if ($account->credits < $emailCredits) {
                    $request->merge(['apply_internal_emails' => []]);
                } else {
                    $ok = CreditConsumption::deductForFeature(
                        $account,
                        CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL,
                        $emailCredits,
                        'Additional Email for Application Alerts (one time)',
                        ['job_create' => true]
                    );
                    if (! $ok) {
                        $request->merge(['apply_internal_emails' => []]);
                    }
                }
            }
        }

        $jobValidityDays = null;
        $packagePeriodEnd = null;
        if ($account->isEmployer() && class_exists(\Botble\JobBoard\Supports\PackageContext::class)) {
            $ctx = \Botble\JobBoard\Supports\PackageContext::forAccount($account);
            if ($ctx->hasPackage() && $ctx->isPeriodValid() && $ctx->periodEnd) {
                $packagePeriodEnd = $ctx->periodEnd;
            }
            if ($ctx->hasPackage() && $ctx->isPeriodValid() && $ctx->package && \Illuminate\Support\Facades\Schema::hasColumn('jb_packages', 'job_validity_days')) {
                $val = (int) ($ctx->package->job_validity_days ?? 0);
                if ($val > 0) {
                    $jobValidityDays = $val;
                }
            }
        }

        $jobExpireAt = Carbon::now()->addDays($jobValidityDays ?? JobBoardHelper::jobExpiredDays($account));
        // Don't let job outlive the employer package period (when package is active).
        if ($packagePeriodEnd && $jobExpireAt->gt($packagePeriodEnd)) {
            $jobExpireAt = $packagePeriodEnd->copy();
        }

        $request->merge([
            'expire_date' => $jobExpireAt,
            'author_id' => $account->getAuthIdentifier(),
            'author_type' => Account::class,
        ]);

        if (! $request->has('employer_colleagues')) {
            $request->merge(['employer_colleagues' => []]);
        }

        // Handle checkbox fields
        if (! $request->has('hide_salary')) {
            $request->merge(['hide_salary' => 0]);
        }
        if (! $request->has('hide_company')) {
            $request->merge(['hide_company' => 0]);
        }
        if (! $request->has('is_remote')) {
            $request->merge(['is_remote' => 0]);
        }
        if (! $request->has('hide_hiring_school_name')) {
            $request->merge(['hide_hiring_school_name' => 0]);
        }

        // Ensure job can be stored: set defaults for optional fields if empty
        $input = $request->input();
        if (empty($input['degree_level_id'])) {
            $firstDegree = DegreeLevel::query()->wherePublished()->oldest('order')->oldest('id')->value('id');
            if ($firstDegree) {
                $request->merge(['degree_level_id' => $firstDegree]);
            }
        }
        if (empty($input['job_experience_id'])) {
            $firstExp = JobExperience::query()->wherePublished()->oldest('order')->oldest('id')->value('id');
            if ($firstExp) {
                $request->merge(['job_experience_id' => $firstExp]);
            }
        }
        if (empty($input['number_of_positions']) || (int) ($input['number_of_positions'] ?? 0) < 1) {
            $request->merge(['number_of_positions' => 1]);
        }

        $job = new Job();
        $job->fill($request->input());

        if (JobBoardHelper::isEnabledJobApproval()) {
            $job->moderation_status = ModerationStatusEnum::PENDING;
            if (empty($job->status)) {
                $job->status = JobStatusEnum::PENDING;
            }
        } else {
            $job->moderation_status = ModerationStatusEnum::APPROVED;
            // Always set status to PUBLISHED if approval is disabled (override any existing status)
            $job->status = JobStatusEnum::PUBLISHED;
        }

        $job->save();

        if ($this->hasFeaturedJobEntitlement($account)) {
            $job->is_featured = 1;
            $job->saveQuietly();
            // Employer ne Featured Job buy kiya hai to is account ki saari jobs featured karo
            Job::query()
                ->where('author_id', $account->getKey())
                ->where('author_type', Account::class)
                ->update(['is_featured' => 1]);
        }

        if ($this->hasFeaturedJobEntitlement($account)) {
            $job->is_featured = 1;
            $job->saveQuietly();
            // Employer ne Featured Job buy kiya hai to is account ki saari jobs featured karo
            Job::query()
                ->where('author_id', $account->getKey())
                ->where('author_type', Account::class)
                ->update(['is_featured' => 1]);
        }

        if (SlugHelper::isSupportedModel(Job::class)) {
            try {
                // Always (re)build slug from current name; SlugHelper makes key unique (…-1, …-2, …) globally.
                SlugHelper::createSlug($job, $job->slugSourceWithUniqueId());
            } catch (\Throwable $e) {
                Log::warning('JobBoard: Failed to create slug for job ' . $job->id, ['error' => $e->getMessage()]);
            }
        }

        // Reload to ensure status is correct
        $job->refresh();
        
        // Debug: Log job status
        error_log('[JOB_CREATE] Job created - ID: ' . $job->id . ', Status: ' . ($job->status ? $job->status->getValue() : 'null') . ', Moderation: ' . ($job->moderation_status ? $job->moderation_status->getValue() : 'null') . ', Approval Enabled: ' . (JobBoardHelper::isEnabledJobApproval() ? 'Yes' : 'No'));

        $customFields = CustomFieldValue::formatCustomFields($request->input('custom_fields') ?? []);

        $job->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $job->customFields()->saveMany($customFields);

        $job->skills()->sync($request->input('skills', []));
        $job->jobTypes()->sync($request->input('jobTypes', []));
        $job->categories()->sync($request->input('categories', []));
        
       // Job alert notifications ENABLED - sending email and WhatsApp to matching candidates
        // Trigger event after all relationships are synced
        // IMPORTANT: Only trigger if job is published AND approved by admin
        if ($job->status == JobStatusEnum::PUBLISHED && $job->moderation_status == ModerationStatusEnum::APPROVED) {
            // Reload job with relationships before triggering event
            try {
                $job->load(['categories', 'jobTypes', 'skills', 'company', 'city', 'state', 'country', 'currency']);
                \Log::info('Triggering JobPublishedEvent for job: ' . $job->id . ' (Approved)');
                error_log('[JOB_CREATE] Triggering JobPublishedEvent for job: ' . $job->id . ' - ' . $job->name . ' (Status: APPROVED)');
                
                event(new JobPublishedEvent($job));
            } catch (\Exception $e) {
                \Log::error('Failed to trigger JobPublishedEvent: ' . $e->getMessage());
                error_log('[JOB_CREATE] Failed to trigger JobPublishedEvent: ' . $e->getMessage());
                
                // Continue even if event fails
            }
        } else {
            $status = $job->status ? $job->status->getValue() : 'null';
            $moderation = $job->moderation_status ? $job->moderation_status->getValue() : 'null';
            \Log::info('JobPublishedEvent NOT triggered - Job status: ' . $status . ', Moderation: ' . $moderation);
            error_log('[JOB_CREATE] JobPublishedEvent NOT triggered - Status: ' . $status . ', Moderation: ' . $moderation . ' (Job must be PUBLISHED and APPROVED)');
        }

        // Sync screening questions (from admin pool) with is_required, overrides, correct_answer per job
        $sqIds = array_filter((array) $request->input('screening_question_ids', []));
        $requiredIds = array_flip(array_filter((array) $request->input('screening_question_required', [])));
        $questionOverrides = (array) $request->input('screening_question_question', []);
        $optionsOverrides = (array) $request->input('screening_question_options', []);
        $correctAnswers = (array) $request->input('screening_question_correct', []);
        $syncData = [];
        foreach (array_values($sqIds) as $order => $sqId) {
            $sqId = (int) $sqId;
            $syncData[$sqId] = [
                'order' => $order,
                'is_required' => isset($requiredIds[$sqId]),
                'question_override' => $questionOverrides[$sqId] ?? null,
                'options_override' => $optionsOverrides[$sqId] ?? null,
                'correct_answer' => $correctAnswers[$sqId] ?? null,
            ];
        }
        $job->screeningQuestions()->sync($syncData);

        // Job-specific screening questions (employer-added for this job only)
        $this->syncJobScreeningQuestions($job, $request->input('job_screening_questions', []));

        $storeTagService->execute($request, $job);

        event(new CreatedContentEvent(JOB_MODULE_SCREEN_NAME, $request, $job));

        AccountActivityLog::query()->create([
            'action' => 'create_job',
            'reference_name' => $job->name,
            'reference_url' => route('public.account.jobs.edit', $job->id),
        ]);

        // Use 1 pre-paid job post slot when not using package slot (user bought slot via wallet popup; no auto-deduct here)
        $packageContext = PackageContext::forAccount($account);
        if (JobBoardHelper::isEnabledCreditsSystem() && ! $packageContext->jobPostUsesPackageSlot() && Schema::hasColumn('jb_accounts', 'job_post_credits_balance')) {
            $balance = (int) ($account->getAttribute('job_post_credits_balance') ?? 0);
            if ($balance >= 1) {
                $account->job_post_credits_balance = $balance - 1;
                $account->save();
            }
        }

        // Check if job is published (use the model instance, not query again)
        if ($job->status == JobStatusEnum::PUBLISHED && $job->moderation_status == ModerationStatusEnum::APPROVED) {
            EmployerPostedJobEvent::dispatch($job, $account);
        }

        // Send notification to employer when job is posted successfully
        try {
            $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
            $notificationService->sendJobPostedNotification(
                $account,
                $job->name,
                $job->id
            );
            \Log::info('[JOB_POST] Notification sent to employer for job posting', [
                'job_id' => $job->id,
                'job_title' => $job->name,
                'employer_id' => $account->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('[JOB_POST] Failed to send notification to employer: ' . $e->getMessage(), [
                'job_id' => $job->id,
                'employer_id' => $account->id,
            ]);
            // Don't break the flow if notification fails
        }

        // Send notification to employer when job is posted successfully
        try {
            $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
            $notificationService->sendJobPostedNotification(
                $account,
                $job->name,
                $job->id
            );
            \Log::info('[JOB_POST] Notification sent to employer for job posting', [
                'job_id' => $job->id,
                'job_title' => $job->name,
                'employer_id' => $account->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('[JOB_POST] Failed to send notification to employer: ' . $e->getMessage(), [
                'job_id' => $job->id,
                'employer_id' => $account->id,
            ]);
            // Don't break the flow if notification fails
        }

        $jobsUrl = url('/account/jobs');
        return redirect()->to($jobsUrl)
            ->with('success_msg', trans('core/base::notices.create_success_message'));
        // Get job seekers list from session if emails were sent
        $jobSeekersList = session()->get('job_created_email_recipients', []);
        $emailCount = count($jobSeekersList);
        
        // Build success message with job seekers list
        $successMessage = trans('plugins/job-board::job.create_success');
        
        if ($emailCount > 0) {
            $successMessage .= "\n\n✅ Email sent successfully to " . $emailCount . " job seeker(s):\n";
            $namesList = [];
            foreach ($jobSeekersList as $index => $jobSeeker) {
                $namesList[] = ($index + 1) . ". " . $jobSeeker['name'] . " (" . $jobSeeker['email'] . ")";
            }
            $successMessage .= implode("\n", $namesList);
            
            // Store in session for JavaScript console output
            session()->put('job_created_console_data', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'email_count' => $emailCount,
                'job_seekers' => $jobSeekersList
            ]);
            
            // Also log to console
            \Log::info('Job created successfully. Emails sent to job seekers:', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'total_emails_sent' => $emailCount,
                'job_seekers' => $jobSeekersList
            ]);
            
            error_log('[JOB_CREATE] ✅ Job created successfully!');
            error_log('[JOB_CREATE] 📧 Email sent to ' . $emailCount . ' job seeker(s):');
            foreach ($jobSeekersList as $index => $jobSeeker) {
                error_log('[JOB_CREATE]    ' . ($index + 1) . '. ' . $jobSeeker['name'] . ' (' . $jobSeeker['email'] . ')');
            }
        } else {
            session()->put('job_created_console_data', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'email_count' => 0,
                'job_seekers' => []
            ]);
            error_log('[JOB_CREATE] ✅ Job created successfully!');
            error_log('[JOB_CREATE] ⚠️ No job seekers found to send emails.');
        }
        
        // Clear session data
        session()->forget('job_created_email_recipients');

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.jobs.index'))
            ->setNextUrl(route('public.account.jobs.edit', $job->id))
            ->setMessage($successMessage)
            ->withCreatedSuccessMessage();

    }

    public function edit(Job $job, Request $request)
    {
        abort_unless($this->canManageJob($job), 404);

        event(new BeforeEditContentEvent($request, $job));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $job->name]));
        SeoHelper::setTitle(trans('core/base::forms.edit_item', ['name' => $job->name]));

        $job->load(['screeningQuestions', 'jobScreeningQuestions', 'skills', 'jobTypes', 'company']);

        // Use same form as create (theme) for consistency - same fields, same names
        $account = auth('account')->user();
        $hasPurchasedPackage = $this->hasPurchasedPackage($account);
        $canPost = $hasPurchasedPackage && $account->canPost();
        $companies = $account->companies->pluck('name', 'id')->all();
        $companyInstitutionTypes = $account->companies->pluck('institution_type', 'id')->all();

        $companyDetails = [];
        foreach ($account->companies as $company) {
            $cityName = $stateName = $countryName = '';
            if (is_plugin_active('location')) {
                if ($company->city_id) {
                    $city = \Botble\Location\Models\City::find($company->city_id);
                    $cityName = $city ? $city->name : '';
                }
                if ($company->state_id) {
                    $state = \Botble\Location\Models\State::find($company->state_id);
                    $stateName = $state ? $state->name : '';
                }
                if ($company->country_id) {
                    $country = \Botble\Location\Models\Country::find($company->country_id);
                    $countryName = $country ? $country->name : '';
                }
            }
            $companyDetails[$company->id] = [
                'institution_type' => $company->institution_type,
                'address' => $company->address,
                'postal_code' => $company->postal_code,
                'city_id' => $company->city_id,
                'city_name' => $cityName,
                'state_id' => $company->state_id,
                'state_name' => $stateName,
                'country_id' => $company->country_id,
                'country_name' => $countryName,
            ];
        }

        $screeningQuestions = ScreeningQuestion::query()
            ->wherePublished()
            ->oldest('order')
            ->oldest('id')
            ->get();

        $skills = JobSkill::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $jobTypes = JobType::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $degreeLevels = DegreeLevel::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $jobExperiences = JobExperience::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $jobShifts = JobShift::query()->wherePublished()->oldest('order')->oldest('name')
            ->select('name', 'id')->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])->all();

        $languagesList = [];
        if (Schema::hasTable('languages')) {
            $languagesList = \Illuminate\Support\Facades\DB::table('languages')
                ->orderBy('lang_order')->orderBy('lang_name')
                ->pluck('lang_name')->values()->all();
        }

        $currencies = Currency::query()->oldest('order')->oldest('title')
            ->pluck('title', 'id')->all();

        $salaryRanges = SalaryRangeEnum::labels();

        $editJobData = null;
        if ($job->exists) {
            $cityName = $stateName = $countryName = '';
            if (is_plugin_active('location')) {
                if ($job->city_id) {
                    $city = \Botble\Location\Models\City::find($job->city_id);
                    $cityName = $city ? $city->name : '';
                }
                if ($job->state_id) {
                    $state = \Botble\Location\Models\State::find($job->state_id);
                    $stateName = $state ? $state->name : '';
                }
                if ($job->country_id) {
                    $country = \Botble\Location\Models\Country::find($job->country_id);
                    $countryName = $country ? $country->name : '';
                }
            }
            $editJobData = [
                'skills' => $job->skills->map(fn ($s) => ['id' => (string) $s->id, 'name' => $s->name])->values()->all(),
                'required_certifications' => is_array($job->required_certifications) ? $job->required_certifications : (is_string($job->required_certifications) ? (json_decode($job->required_certifications, true) ?? []) : []),
                'language_proficiency' => is_array($job->language_proficiency) ? $job->language_proficiency : (is_string($job->language_proficiency) ? (json_decode($job->language_proficiency, true) ?? []) : []),
                'application_locations' => is_array($job->application_locations) ? $job->application_locations : (is_string($job->application_locations) ? (json_decode($job->application_locations, true) ?? []) : []),
                'city_name' => $cityName,
                'state_name' => $stateName,
                'country_name' => $countryName,
                'job_screening_questions' => $job->jobScreeningQuestions->map(fn ($q) => [
                    'id' => $q->id,
                    'question' => $q->question,
                    'question_type' => $q->question_type,
                    'options' => is_array($q->options_array) ? implode("\n", $q->options_array) : (string) $q->options,
                    'is_required' => $q->is_required,
                    'correct_answer' => $q->correct_answer,
                ])->values()->all(),
            ];
        }

        $creditsEnabled = JobBoardHelper::isEnabledCreditsSystem();
        $walletUrl = route('public.account.wallet');
        $accountCredits = $creditsEnabled ? (int) $account->credits : 0;
        $emailCreditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL, 100);
        $wpCreditsRequired = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_WP, 10);

        $view = 'dashboard.jobs.create';
        if ($account->isEmployer() && method_exists($account, 'isConsultancy') && $account->isConsultancy()) {
            $view = 'dashboard.jobs.create-consultant';
        }
        $defaultCompanyId = $job->company_id ?? (count($companies) === 1 ? array_key_first($companies) : null);

        return JobBoardHelper::view($view, compact(
            'account', 'companies', 'companyInstitutionTypes', 'companyDetails',
            'skills', 'jobTypes', 'degreeLevels', 'jobExperiences',
            'jobShifts', 'languagesList', 'currencies', 'salaryRanges', 'canPost', 'screeningQuestions', 'job', 'editJobData', 'defaultCompanyId',
            'walletUrl', 'accountCredits', 'emailCreditsRequired', 'wpCreditsRequired', 'creditsEnabled'
        ));
    }

    protected function canManageJob(Job $job): bool
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        if (! $account->isEmployer()) {
            return false;
        }

        if ($job->company_id && in_array($job->company_id, $account->companies()->pluck('id')->all())) {
            return true;
        }

        return $account->id == $job->author_id && $job->author_type == Account::class;
    }

    /**
     * Sync job-specific screening questions (employer-added per job, not in admin pool).
     *
     * @param  array<int, array{id?: int, question?: string, question_type?: string, options?: string, is_required?: bool, correct_answer?: string}>  $rows
     */
    protected function syncJobScreeningQuestions(Job $job, array $rows): void
    {
        $rows = array_values($rows);
        $keepIds = collect($rows)->pluck('id')->filter()->values()->all();

        $job->jobScreeningQuestions()->whereNotIn('id', $keepIds)->delete();

        foreach ($rows as $order => $row) {
            $question = trim((string) ($row['question'] ?? ''));
            if ($question === '') {
                continue;
            }
            $data = [
                'question' => $question,
                'question_type' => in_array($row['question_type'] ?? '', ['text', 'textarea', 'dropdown', 'checkbox'], true)
                    ? $row['question_type'] : 'text',
                'options' => $row['options'] ?? null,
                'is_required' => ! empty($row['is_required']),
                'correct_answer' => isset($row['correct_answer']) ? trim((string) $row['correct_answer']) : null,
                'order' => $order,
            ];
            $id = isset($row['id']) ? (int) $row['id'] : 0;
            if ($id && $job->jobScreeningQuestions()->where('id', $id)->exists()) {
                $job->jobScreeningQuestions()->where('id', $id)->update($data);
            } else {
                $job->jobScreeningQuestions()->create(array_merge($data, ['job_id' => $job->id]));
            }
        }
    }

    public function update(Job $job, AccountJobRequest $request, StoreTagService $storeTagService)
    {
        abort_unless($this->canManageJob($job), 404);

        $this->processRequestData($request);

        $request->except([
            'is_featured',
            'moderation_status',
            'never_expired',
            'expire_date',
        ]);
 // Remove fields if columns don't exist in database yet (same as store method)
 if ($request->has('apply_internal_phones')) {
    if (!Schema::hasColumn('jb_jobs', 'apply_internal_phones')) {
        $request->request->remove('apply_internal_phones');
    }
}
if ($request->has('enable_whatsapp_notifications')) {
    if (!Schema::hasColumn('jb_jobs', 'enable_whatsapp_notifications')) {
        $request->request->remove('enable_whatsapp_notifications');
    }
}


        if (! $request->has('employer_colleagues')) {
            $request->merge(['employer_colleagues' => []]);
        }
// Remove fields if columns don't exist in database yet (same as store method)
if ($request->has('apply_internal_phones')) {
    if (!Schema::hasColumn('jb_jobs', 'apply_internal_phones')) {
        $request->request->remove('apply_internal_phones');
    }
}
if ($request->has('enable_whatsapp_notifications')) {
    if (!Schema::hasColumn('jb_jobs', 'enable_whatsapp_notifications')) {
        $request->request->remove('enable_whatsapp_notifications');
    }
}

if (! $request->has('employer_colleagues')) {
    $request->merge(['employer_colleagues' => []]);
}
if (! $request->has('hide_hiring_school_name')) {
    $request->merge(['hide_hiring_school_name' => 0]);
}

// Handle enable_whatsapp_notifications checkbox (same logic as store)
if (! $request->has('enable_whatsapp_notifications')) {
    // If additional phones are provided, auto-enable WhatsApp notifications
    $phones = (array) $request->input('apply_internal_phones', []);
    if ($request->has('apply_internal_phones') && ! empty(array_filter($phones))) {
        $request->merge(['enable_whatsapp_notifications' => 1]);
        \Log::info('[JOB_UPDATE] Auto-enabling WhatsApp notifications because additional phones are provided');
    } else {
        $request->merge(['enable_whatsapp_notifications' => 0]);
    }
} else {
    // Checkbox was checked, ensure value is 1
    $request->merge(['enable_whatsapp_notifications' => 1]);
}

// WhatsApp: allow if employer has entitlement (they deducted when adding phone; valid till package)
$accountForUpdate = auth('account')->user();
if (JobBoardHelper::isEnabledCreditsSystem() && $request->input('enable_whatsapp_notifications')) {
    if (! CreditConsumption::hasEntitlement($accountForUpdate, CreditConsumption::FEATURE_APPLICATION_ALERT_WP)) {
        $request->merge(['enable_whatsapp_notifications' => 0]);
    }
}

// Additional Email (one-time): require entitlement or one-time deduct
$applyEmailsUpdate = array_filter((array) $request->input('apply_internal_emails', []));
if (JobBoardHelper::isEnabledCreditsSystem() && ! empty($applyEmailsUpdate)) {
    if (! CreditConsumption::hasEntitlement($accountForUpdate, CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL)) {
        $emailCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL, 100);
        if ($accountForUpdate->credits < $emailCredits) {
            $request->merge(['apply_internal_emails' => []]);
        } else {
            $ok = CreditConsumption::deductForFeature(
                $accountForUpdate,
                CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL,
                $emailCredits,
                'Additional Email for Application Alerts (one time)',
                ['job_update' => true]
            );
            if (! $ok) {
                $request->merge(['apply_internal_emails' => []]);
            }
        }
    }
}

        if ($job->status != JobStatusEnum::PUBLISHED && $request->input('status') == JobStatusEnum::PUBLISHED) {
            $job->loadMissing('author');
            EmployerPostedJobEvent::dispatch($job, $job->author);
        }

        $job->fill($request->input());
        $job->save();

        if (SlugHelper::isSupportedModel(Job::class)) {
            try {
                $job->refresh();
                SlugHelper::createSlug($job, $job->slugSourceWithUniqueId());
            } catch (\Throwable $e) {
                Log::warning('JobBoard: Failed to update slug for job ' . $job->id, ['error' => $e->getMessage()]);
            }
        }

        if ($this->hasFeaturedJobEntitlement($account = auth('account')->user())) {
            $job->is_featured = 1;
            $job->saveQuietly();
            // Employer ne Featured Job buy kiya hai to is account ki saari jobs featured karo
            Job::query()
                ->where('author_id', $account->getKey())
                ->where('author_type', Account::class)
                ->update(['is_featured' => 1]);
        }

        if ($this->hasFeaturedJobEntitlement($account = auth('account')->user())) {
            $job->is_featured = 1;
            $job->saveQuietly();
            // Employer ne Featured Job buy kiya hai to is account ki saari jobs featured karo
            Job::query()
                ->where('author_id', $account->getKey())
                ->where('author_type', Account::class)
                ->update(['is_featured' => 1]);
        }

        $customFields = CustomFieldValue::formatCustomFields($request->input('custom_fields') ?? []);

        $job->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $job->customFields()->saveMany($customFields);

        $job->skills()->sync($request->input('skills', []));
        $job->jobTypes()->sync($request->input('jobTypes', []));
        $job->categories()->sync($request->input('categories', []));

        $sqIds = array_filter((array) $request->input('screening_question_ids', []));
        $requiredIds = array_flip(array_filter((array) $request->input('screening_question_required', [])));
        $questionOverrides = (array) $request->input('screening_question_question', []);
        $optionsOverrides = (array) $request->input('screening_question_options', []);
        $correctAnswers = (array) $request->input('screening_question_correct', []);
        $syncData = [];
        foreach (array_values($sqIds) as $order => $sqId) {
            $sqId = (int) $sqId;
            $syncData[$sqId] = [
                'order' => $order,
                'is_required' => isset($requiredIds[$sqId]),
                'question_override' => $questionOverrides[$sqId] ?? null,
                'options_override' => $optionsOverrides[$sqId] ?? null,
                'correct_answer' => $correctAnswers[$sqId] ?? null,
            ];
        }
        $job->screeningQuestions()->sync($syncData);

        $this->syncJobScreeningQuestions($job, $request->input('job_screening_questions', []));

        $storeTagService->execute($request, $job);

        event(new UpdatedContentEvent(JOB_MODULE_SCREEN_NAME, $request, $job));

        AccountActivityLog::query()->create([
            'action' => 'update_job',
            'reference_name' => $job->name,
            'reference_url' => route('public.account.jobs.edit', $job->id),
        ]);

        $jobsUrl = url('/account/jobs');
        return redirect()->to($jobsUrl)
            ->with('success_msg', trans('core/base::notices.update_success_message'));
    }

    protected function processRequestData(Request $request): Request
    {
        if ($request->hasFile('featured_image_input')) {
            $account = auth('account')->user();
            $result = RvMedia::handleUpload($request->file('featured_image_input'), 0, $account->upload_folder);
            if (! $result['error']) {
                $file = $result['data'];
                $request->merge(['featured_image' => $file->url]);
            }
        }

        $shortcodeCompiler = shortcode()->getCompiler();

        $request->merge([
            'content' => $shortcodeCompiler->strip(
                $request->input('content'),
                $shortcodeCompiler->whitelistShortcodes()
            ),
        ]);

        // When not internal, clear internal emails; when internal, keep only non-empty (max 3 validated in request)
        if ($request->input('apply_type') !== 'internal') {
            $request->merge(['apply_internal_emails' => null]);
            $request->merge(['apply_internal_phones' => null]);

        } else {
            $emails = array_values(array_filter(array_map('trim', (array) $request->input('apply_internal_emails', []))));
            $slicedEmails = array_slice($emails, 0, 3);
            // Fix: Empty array should be null, not []
            $request->merge(['apply_internal_emails' => !empty($slicedEmails) ? $slicedEmails : null]);
            
            \Log::info('[JOB_POST] Processed apply_internal_emails', [
                'original_emails' => $request->input('apply_internal_emails', []),
                'filtered_emails' => $emails,
                'sliced_emails' => $slicedEmails,
                'final_emails' => !empty($slicedEmails) ? $slicedEmails : null,
            ]);
            
            $slicedEmails = array_slice($emails, 0, 3);
            // Fix: Empty array should be null, not []
            $request->merge(['apply_internal_emails' => !empty($slicedEmails) ? $slicedEmails : null]);
            
            \Log::info('[JOB_POST] Processed apply_internal_emails', [
                'original_emails' => $request->input('apply_internal_emails', []),
                'filtered_emails' => $emails,
                'sliced_emails' => $slicedEmails,
                'final_emails' => !empty($slicedEmails) ? $slicedEmails : null,
            ]);
            
        // Process apply_internal_phones - format with country code and store
        $phones = array_filter(array_map('trim', (array) $request->input('apply_internal_phones', [])));
        $formattedPhones = [];
        
        foreach ($phones as $phone) {
            if (empty($phone)) {
                continue;
            }
            
            // Format phone with country code (same logic as registration)
            // If phone already has +, clean it
            if (strpos($phone, '+') === 0) {
                // Phone already has country code, just clean spaces
                $formattedPhone = '+' . preg_replace('/[^0-9]/', '', $phone);
            } elseif (preg_match('/^91/', preg_replace('/[^0-9]/', '', $phone))) {
                // Phone starts with 91 (country code), add +
                $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
                $formattedPhone = '+' . $cleanPhone;
            } elseif (strlen(preg_replace('/[^0-9]/', '', $phone)) == 10) {
                // 10 digit phone, add 91 country code
                $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
                $formattedPhone = '+91' . $cleanPhone;
            } else {
                // Keep as is if format is unclear
                $formattedPhone = $phone;
            }
            
            $formattedPhones[] = $formattedPhone;
        }
        
        // Store formatted phones (max 3)
        // Fix: Empty array should be null, not []
        $slicedPhones = array_slice($formattedPhones, 0, 3);
        $request->merge(['apply_internal_phones' => !empty($slicedPhones) ? $slicedPhones : null]);
        // Fix: Empty array should be null, not []
        $slicedPhones = array_slice($formattedPhones, 0, 3);
        $request->merge(['apply_internal_phones' => !empty($slicedPhones) ? $slicedPhones : null]);
        
        \Log::info('[JOB_POST] Processed apply_internal_phones', [
            'original_phones' => $phones,
            'formatted_phones' => $formattedPhones,
            'stored_phones' => array_slice($formattedPhones, 0, 3) ?: null,
        ]);
    }
        
        
        $except = [
            'is_featured',
        ];

        foreach ($except as $item) {
            $request->request->remove($item);
        }

        return $request;
    }

    public function destroy(Job $job)
    {
        abort_unless($this->canManageJob($job), 404);

        $job->delete();

        AccountActivityLog::query()->create([
            'action' => 'delete_job',
            'reference_name' => $job->name,
        ]);

        return $this
            ->httpResponse()->setMessage(trans('plugins/job-board::messages.delete_job_successfully'));
    }

    public function renew(int|string $id)
    {
        /** @var \Botble\JobBoard\Models\Job $job */
        $job = Job::query()->findOrFail($id);

        abort_unless($this->canManageJob($job), 404);
        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        if ($account->credits < 1) {
            return $this
                ->httpResponse()->setError()->setMessage(trans('plugins/job-board::messages.not_enough_credit_renew'));
        }

        $days = null;
        $packagePeriodEnd = null;
        if ($account->isEmployer() && class_exists(\Botble\JobBoard\Supports\PackageContext::class)) {
            $ctx = \Botble\JobBoard\Supports\PackageContext::forAccount($account);
            if ($ctx->hasPackage() && $ctx->isPeriodValid() && $ctx->periodEnd) {
                $packagePeriodEnd = $ctx->periodEnd;
            }
            if ($ctx->hasPackage() && $ctx->isPeriodValid() && $ctx->package && \Illuminate\Support\Facades\Schema::hasColumn('jb_packages', 'job_validity_days')) {
                $val = (int) ($ctx->package->job_validity_days ?? 0);
                if ($val > 0) {
                    $days = $val;
                }
            }
        }

        $newExpireAt = $job->expire_date->addDays($days ?? JobBoardHelper::jobExpiredDays($account));
        if ($packagePeriodEnd && $newExpireAt->gt($packagePeriodEnd)) {
            $newExpireAt = $packagePeriodEnd->copy();
        }
        $job->expire_date = $newExpireAt;
        $job->save();

        if (JobBoardHelper::isEnabledCreditsSystem() && $account->credits > 0) {
            $account->credits--;
            $account->save();
            Transaction::query()->create([
                'account_id' => $account->getKey(),
                'credits' => 1,
                'type' => Transaction::TYPE_DEBIT,
                'description' => trans('plugins/job-board::messages.credits_used_job_renew', ['job' => $job->name]),
            ]);
        }

        AccountActivityLog::query()->create([
            'action' => 'renew_job',
            'reference_name' => $job->name,
        ]);

        return $this
            ->httpResponse()->setMessage(trans('plugins/job-board::messages.renew_job_successfully'));
    }

    public function analytics(int|string $id)
    {
        /** @var \Botble\JobBoard\Models\Job $job */
        $job = Job::query()->findOrFail($id);

        abort_unless($this->canManageJob($job), 404);

        $job->loadCount([
            'savedJobs',
            'applicants',
        ]);

        $numberSaved = $job->saved_jobs_count;
        $applicants = $job->applicants_count;
        $viewsToday = $this->analyticsRepository->getTodayViews($job->id);
        $referrers = $this->analyticsRepository->getReferrers($job->id);
        $countries = $this->analyticsRepository->getCountriesViews($job->id);

        $title = trans('plugins/job-board::messages.analytics_for_job_named', ['name' => $job->name]);

        SeoHelper::setTitle($title);
        $this->pageTitle($title);

        $data = compact('job', 'viewsToday', 'numberSaved', 'applicants', 'referrers', 'countries', 'title');

        return JobBoardHelper::view('dashboard.jobs.analytics', $data);
    }

    public function view(int|string $id)
    {
        /** @var \Botble\JobBoard\Models\Job $job */
        $job = Job::query()->findOrFail($id);

        abort_unless($this->canManageJob($job), 404);

        $job->load(['company', 'country', 'state', 'city', 'currency', 'jobTypes', 'jobExperience']);

        $applications = JobApplication::query()
            ->where('job_id', $job->id)
            ->with(['account'])
            ->latest()
            ->paginate(20);

        $title = trans('plugins/job-board::messages.view_job', ['name' => $job->name]);

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.dashboard'))
            ->add(trans('plugins/job-board::messages.manage_jobs'), route('public.account.jobs.index'))
            ->add($job->name);

        SeoHelper::setTitle($title);
        $this->pageTitle($title);

        $data = compact('job', 'applications', 'title');

        return JobBoardHelper::view('dashboard.jobs.view', $data);
    }

    public function appliedJobs(Request $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $with = [
            'job',
            'job.slugable',
            'job.jobTypes',
            'job.jobExperience',
            'job.company',
            'job.company.slugable',
        ];

        if (is_plugin_active('location')) {
            $with = array_merge($with, ['job.state', 'job.city']);
        }

        $applications = JobApplication::query()
            ->whereHas('job')
            ->where('account_id', $account->getKey())
            ->with($with);

        switch ($request->input('order_by')) {
            case 'newest':
                $applications = $applications->latest();

                break;
            case 'oldest':
                $applications = $applications->latest();

                break;
            case 'random':
                $applications = $applications->inRandomOrder();

                break;
        }

        $applications = $applications->paginate(10);

        SeoHelper::setTitle(trans('plugins/job-board::messages.applied_jobs'));
        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.overview'))
            ->add(trans('plugins/job-board::messages.applied_jobs'));

        $data = compact('account', 'applications');

        return JobBoardHelper::scope('account.jobs.applied', $data);
    }

    public function savedJobs(Request $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $with = [
            'slugable',
            'company',
        ];

        if (is_plugin_active('location')) {
            $with = array_merge($with, ['city', 'state']);
        }

        // @phpstan-ignore-next-line
        $jobs = Job::query()
            ->select(['jb_jobs.*'])
            ->active()
            ->whereHas('savedJobs', function ($query) use ($account): void {
                $query->where('jb_saved_jobs.account_id', $account->getKey());
            })
            ->addApplied()
            ->with($with);

        if ($category = $request->integer('category')) {
            $jobs->whereHas('categories', function ($query) use ($category): void {
                $query->where('jb_categories.id', $category);
            });
        }

        switch ($request->input('order_by')) {
            case 'newest':
                $jobs = $jobs->orderBy('jb_jobs.created_at', 'DESC');

                break;
            case 'oldest':
                $jobs = $jobs->orderBy('jb_jobs.created_at', 'ASC');

                break;
            case 'random':
                $jobs = $jobs->inRandomOrder();

                break;
        }

        $jobs = $jobs->paginate();

        SeoHelper::setTitle(trans('plugins/job-board::messages.saved_jobs'));
        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.overview'))
            ->add(trans('plugins/job-board::messages.saved_jobs'));

        $data = compact('account', 'jobs');

        return JobBoardHelper::scope('account.jobs.saved', $data);
    }

    public function savedJob(Request $request, ?int $id = null)
    {
        if (! $id) {
            $id = $request->input('job_id');
        }

        abort_unless($id, 404);

        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        // @phpstan-ignore-next-line
        $job = Job::query()
            ->select(['jb_jobs.id', 'jb_jobs.name'])
            ->active()
            ->where(['jb_jobs.id' => $id])
            ->addSaved()
            ->firstOrFail();

        if (! $job->is_saved) {
            $account->savedJobs()->attach($job->id);
            $message = trans('plugins/job-board::messages.job_added_to_saved', ['job' => $job->name]);
            
            // Send notification to job seeker when job is saved
            if (!$account->isEmployer()) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $notificationService->sendJobSavedNotification($account, $job->name, $job->id);
                } catch (\Exception $e) {
                    \Log::error('Failed to send job saved notification: ' . $e->getMessage());
                }
            }
            
            // Send notification to job seeker when job is saved
            if (!$account->isEmployer()) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $notificationService->sendJobSavedNotification($account, $job->name, $job->id);
                } catch (\Exception $e) {
                    \Log::error('Failed to send job saved notification: ' . $e->getMessage());
                }
            }
        } else {
            $account->savedJobs()->detach($job->id);
            $message = trans('plugins/job-board::messages.job_removed_from_saved', ['job' => $job->name]);
        }

        return $this
            ->httpResponse()
            ->setData([
                'is_saved' => ! $job->is_saved,
                'count' => $account->savedJobs()->count(),
            ])
            ->setMessage($message);
    }

    public function getAllTags(): array
    {
        return Tag::query()->pluck('name')->all();
    }

    private function hasPurchasedPackage(Account $account): bool
    {
        return Transaction::query()
            ->where('account_id', $account->getKey())
            ->where(function ($q): void {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })
            ->whereNotNull('payment_id')
            ->whereNotNull('package_id')
            ->exists();
    }

    /**
     * Employer has used credits for Featured Job and entitlement is still valid (package not expired, or used within 365 days).
     */
    private function hasFeaturedJobEntitlement(Account $account): bool
    {
        try {
            if (! Schema::hasColumn('jb_transactions', 'feature_key')) {
                return false;
            }

            $debit = Transaction::query()
                ->where('account_id', $account->getKey())
                ->where('type', Transaction::TYPE_DEBIT)
                ->where('feature_key', CreditConsumption::FEATURE_FEATURED_JOB)
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
            Log::warning('JobBoard: hasFeaturedJobEntitlement failed', ['account_id' => $account->getKey(), 'error' => $e->getMessage()]);
            return false;
        }
    }
}
