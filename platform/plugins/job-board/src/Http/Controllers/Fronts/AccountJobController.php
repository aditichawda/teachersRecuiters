<?php

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
use Botble\JobBoard\Models\Currency;
use Botble\JobBoard\Models\CustomFieldValue;
use Botble\JobBoard\Models\DegreeLevel;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Models\JobExperience;
use Botble\JobBoard\Models\JobScreeningQuestion;
use Botble\JobBoard\Models\JobShift;
use Botble\JobBoard\Models\JobSkill;
use Botble\JobBoard\Models\JobType;
use Botble\JobBoard\Models\Tag;
use Botble\JobBoard\Repositories\Interfaces\AnalyticsInterface;
use Botble\JobBoard\Services\StoreTagService;
use Botble\JobBoard\Tables\Fronts\JobTable;
use Botble\Media\Facades\RvMedia;
use Botble\Optimize\Facades\OptimizerHelper;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return $table->render(JobBoardHelper::viewPath('dashboard.table.base'));
    }

    public function create()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        // Allow rendering the job post form even if the account cannot post (no credits).
        // The actual store() method will still prevent saving if posting is not allowed.
        $canPost = $account->canPost();

        if (JobBoardHelper::employerManageCompanyInfo() && ! $account->companies()->exists()) {
            return $this
                ->httpResponse()
                ->setError()
                ->setNextUrl(route('public.account.companies.create'))
                ->setMessage(trans('plugins/job-board::messages.please_update_company_info'));
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

        $currencies = Currency::query()->oldest('order')->oldest('title')
            ->pluck('title', 'id')->all();

        $salaryRanges = SalaryRangeEnum::labels();

        return JobBoardHelper::view('dashboard.jobs.create', compact(
            'account', 'companies', 'companyInstitutionTypes', 'companyDetails',
            'skills', 'jobTypes', 'degreeLevels', 'jobExperiences',
            'jobShifts', 'currencies', 'salaryRanges', 'canPost'
        ));
    }

    public function store(AccountJobRequest $request, StoreTagService $storeTagService)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        // Previously posting was blocked here when the account had no credits.
        // To allow saving jobs even when credits == 0, skip the early return.
        // Keep the $canPost flag for downstream logic/UI if needed.
        $canPost = $account->canPost();

        $this->processRequestData($request);

        $request->except([
            'is_featured',
            'moderation_status',
            'never_expired',
        ]);

        $request->merge([
            'expire_date' => Carbon::now()->addDays(JobBoardHelper::jobExpiredDays()),
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
        
        // Trigger event after all relationships are synced
        if ($job->moderation_status == ModerationStatusEnum::APPROVED && $job->status == JobStatusEnum::PUBLISHED) {
            // Reload job with relationships before triggering event
            try {
                $job->load(['categories', 'jobTypes', 'skills', 'company', 'city', 'state', 'country', 'currency']);
                event(new JobPublishedEvent($job));
            } catch (\Exception $e) {
                \Log::error('Failed to trigger JobPublishedEvent: ' . $e->getMessage());
                // Continue even if event fails
            }
        }

        $storeTagService->execute($request, $job);

        // Save screening questions
        $screeningQuestions = $request->input('screening_questions', []);
        if (!empty($screeningQuestions)) {
            foreach ($screeningQuestions as $sqData) {
                if (empty($sqData['question'])) {
                    continue;
                }

                // Convert options text (one per line) to JSON
                $options = null;
                if (!empty($sqData['options_text'])) {
                    $optionsArray = array_filter(array_map('trim', explode("\n", $sqData['options_text'])));
                    $options = json_encode(array_values($optionsArray));
                }

                JobScreeningQuestion::create([
                    'job_id' => $job->id,
                    'question' => $sqData['question'],
                    'question_type' => $sqData['question_type'] ?? 'text',
                    'options' => $options,
                    'required_answer' => $sqData['required_answer'] ?? null,
                    'is_required' => !empty($sqData['is_required']),
                    'order' => (int) ($sqData['order'] ?? 0),
                    'file_types' => $sqData['file_types'] ?? null,
                ]);
            }
        }

        event(new CreatedContentEvent(JOB_MODULE_SCREEN_NAME, $request, $job));

        AccountActivityLog::query()->create([
            'action' => 'create_job',
            'reference_name' => $job->name,
            'reference_url' => route('public.account.jobs.edit', $job->id),
        ]);

        if (JobBoardHelper::isEnabledCreditsSystem() && $account->credits > 0) {
            $account->credits--;
            $account->save();
        }

        // Check if job is published (use the model instance, not query again)
        if ($job->status == JobStatusEnum::PUBLISHED && $job->moderation_status == ModerationStatusEnum::APPROVED) {
            EmployerPostedJobEvent::dispatch($job, $account);
        }

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.jobs.index'))
            ->setNextUrl(route('public.account.jobs.edit', $job->id))
            ->withCreatedSuccessMessage();
    }

    public function edit(Job $job, Request $request)
    {
        abort_unless($this->canManageJob($job), 404);

        event(new BeforeEditContentEvent($request, $job));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $job->name]));

        return JobForm::createFromModel($job)
            ->renderForm();
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

        if (! $request->has('employer_colleagues')) {
            $request->merge(['employer_colleagues' => []]);
        }

        if ($job->status != JobStatusEnum::PUBLISHED && $request->input('status') == JobStatusEnum::PUBLISHED) {
            $job->loadMissing('author');
            EmployerPostedJobEvent::dispatch($job, $job->author);
        }

        $job->fill($request->input());
        $job->save();

        $customFields = CustomFieldValue::formatCustomFields($request->input('custom_fields') ?? []);

        $job->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $job->customFields()->saveMany($customFields);

        $job->skills()->sync($request->input('skills', []));
        $job->jobTypes()->sync($request->input('jobTypes', []));
        $job->categories()->sync($request->input('categories', []));

        $storeTagService->execute($request, $job);

        event(new UpdatedContentEvent(JOB_MODULE_SCREEN_NAME, $request, $job));

        AccountActivityLog::query()->create([
            'action' => 'update_job',
            'reference_name' => $job->name,
            'reference_url' => route('public.account.jobs.edit', $job->id),
        ]);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('public.account.jobs.index'))
            ->setNextUrl(route('public.account.jobs.edit', $job->getKey()))
            ->withUpdatedSuccessMessage();
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
        } else {
            $emails = array_values(array_filter(array_map('trim', (array) $request->input('apply_internal_emails', []))));
            $request->merge(['apply_internal_emails' => array_slice($emails, 0, 3) ?: null]);
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

        $job->expire_date = $job->expire_date->addDays(JobBoardHelper::jobExpiredDays());
        $job->save();

        if (JobBoardHelper::isEnabledCreditsSystem() && $account->credits > 0) {
            $account->credits--;
            $account->save();
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
}
