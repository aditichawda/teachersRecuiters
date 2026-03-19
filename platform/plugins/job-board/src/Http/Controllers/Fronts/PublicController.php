<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\AdminHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Helper;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Enums\JobStatusEnum;
use Botble\JobBoard\Events\JobAppliedEvent;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Http\Requests\ApplyJobRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountEducation;
use Botble\JobBoard\Models\AccountExperience;
use Botble\JobBoard\Models\Analytics;
use Botble\JobBoard\Models\Category;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Currency;
use Botble\JobBoard\Models\ExternalApplyClickLog;
use Botble\JobBoard\Models\Job as JobModel;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Models\JobExperience;
use Botble\JobBoard\Models\JobSkill;
use Botble\JobBoard\Support\ScreeningQuestionPlaceholder;
use Botble\JobBoard\Models\JobType;
use Botble\JobBoard\Models\Tag;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\Transaction;
use Botble\JobBoard\Repositories\Interfaces\JobInterface;
use Botble\JobBoard\Supports\JobSeekerPackageContext;
use Botble\JobBoard\Supports\JobSeekerPackageContext;
use Botble\JobBoard\Supports\PackageContext;
use Botble\Language\Facades\Language;
use Botble\Location\Facades\Location;
use Botble\Media\Facades\RvMedia;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug as SlugModel;
use Botble\Theme\Facades\Theme;
use Exception;
use GeoIp2\Database\Reader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PublicController extends BaseController
{
    public function __construct(
        protected JobInterface $jobRepository,
    ) {
    }

    /**
     * Get screening questions for a job (for apply form).
     * Includes admin pool questions AND job-specific (extra) questions added by employer.
     */
    public function getJobScreeningQuestions(int $id)
    {
        $job = JobModel::with(['screeningQuestions'])->find($id);
        if (! $job) {
            return response()->json(['questions' => []], 200);
        }
        
        // Only load jobScreeningQuestions if table exists
        try {
            if (Schema::hasTable('jb_job_screening_questions')) {
                $job->load('jobScreeningQuestions');
            }
        } catch (\Exception $e) {
            // Ignore if table doesn't exist
        }
        
        $allQuestions = $job->getAllScreeningQuestionsForApply();
        $questions = $allQuestions->map(function ($q) {
            $opts = $q->options ?? [];
            $optsArray = is_array($opts) ? array_values($opts) : [];
            return [
                'id' => $q->id,
                'question' => $q->question,
                'question_type' => $q->question_type,
                'options' => $optsArray,
                'is_required' => (bool) ($q->is_required ?? false),
            ];
        })->values()->all();
        return response()->json(['questions' => $questions]);
    }

    /**
     * Validate screening answers before showing resume step.
     * Validates both admin pool and job-specific (extra) questions.
     */
    public function validateScreening(Request $request, int $id)
    {
        $job = JobModel::with(['screeningQuestions'])->find($id);
        if (! $job) {
            return response()->json(['valid' => false, 'message' => 'Job not found.'], 404);
        }
        
        // Only load jobScreeningQuestions if table exists
        try {
            if (Schema::hasTable('jb_job_screening_questions')) {
                $job->load('jobScreeningQuestions');
            }
        } catch (\Exception $e) {
            // Ignore if table doesn't exist
        }
        $screeningAnswers = $request->input('screening_answers', []);
        if (! is_array($screeningAnswers)) {
            $screeningAnswers = [];
        }
        foreach ($screeningAnswers as $qId => $val) {
            if (is_array($val)) {
                $screeningAnswers[$qId] = json_encode(array_values($val));
            }
        }
        $allQuestions = $job->getAllScreeningQuestionsForApply();
        foreach ($allQuestions as $sq) {
            $correctAnswer = $sq->correct_answer ?? null;
            if (! $correctAnswer || ! ($sq->is_required ?? false)) {
                continue;
            }
            $answer = $screeningAnswers[$sq->id] ?? null;
            if ($answer === null || $answer === '') {
                return response()->json([
                    'valid' => false,
                    'message' => trans('plugins/job-board::messages.screening_answer_required', ['question' => $sq->question]),
                ]);
            }
            $matches = false;
            if (is_string($answer) && str_starts_with(trim($answer), '[')) {
                $decoded = json_decode($answer, true);
                $matches = is_array($decoded) && in_array(trim($correctAnswer), array_map('trim', $decoded));
            } else {
                $matches = trim((string) $answer) === trim($correctAnswer);
            }
            if (! $matches) {
                return response()->json([
                    'valid' => false,
                    'message' => trans('plugins/job-board::messages.screening_answer_incorrect'),
                ]);
            }
        }
        return response()->json(['valid' => true]);
    }

    public function getJob(string $slug)
    {
        // Get prefix - use 'jobs' as default to match route definition
        $prefix = SlugHelper::getPrefix(JobModel::class, 'jobs');
        
        // Try to get slug with prefix
        $slugModel = SlugHelper::getSlug($slug, $prefix, JobModel::class);

        // If slug not found with prefix, try without prefix (in case prefix setting changed)
        if (! $slugModel) {
            $slugModel = SlugHelper::getSlug($slug, null, JobModel::class);
        }

        // If still not found, try to find job by slug key in slugable relationship
        if (! $slugModel) {
            $job = JobModel::query()
                ->whereHas('slugable', function ($query) use ($slug) {
                    $query->where('key', $slug);
                })
                ->first();
            
            if ($job && $job->slugable) {
                $slugModel = $job->slugable;
            }
        }

        // Last resort: try to find job by matching the slug to job name
        if (! $slugModel) {
            // Convert slug back to potential job name patterns
            $slugParts = explode('-', $slug);
            $searchTerm = implode(' ', $slugParts);
            
            // Try to find job by name (case-insensitive, partial match)
            $job = JobModel::query()
                ->where(function($query) use ($searchTerm) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                          ->orWhereRaw('LOWER(name) = ?', [strtolower($searchTerm)]);
                })
                ->first();
            
            if ($job) {
                // Load or create slug for this job
                if (! $job->slugable) {
                    try {
                        SlugHelper::createSlug($job);
                        $job->refresh();
                        $job->load('slugable');
                    } catch (\Exception $e) {
                        // If slug creation fails, continue without it
                    }
                }
                
                if ($job->slugable && $job->slugable->key === $slug) {
                    $slugModel = $job->slugable;
                } elseif ($job->slugable) {
                    // If slug exists but doesn't match, use it anyway (might be updated slug)
                    $slugModel = $job->slugable;
                }
            }
        }

        // If still no slug model found, try to find by all slugs table directly
        if (! $slugModel) {
            $slugRecord = SlugModel::query()
                ->where('key', $slug)
                ->where('reference_type', JobModel::class)
                ->first();
            
            if ($slugRecord) {
                $slugModel = $slugRecord;
            }
        }

        abort_unless($slugModel, 404);

        $condition = ['jb_jobs.id' => $slugModel->reference_id];

        if (AdminHelper::isPreviewing()) {
            Arr::forget($condition, 'status');
            Arr::forget($condition, 'moderation_status');
        }

        // Load all necessary relationships for job details
        $with = [
            'slugable',
            'tags',
            'tags.slugable',
            'jobTypes',
            'jobExperience',
            'jobShift',
            'functionalArea',
            'degreeLevel',
            'careerLevel',
            'categories',
            'skills',
            'customFields',
            'company',
            'company.slugable',
            'currency',
        ];

        if (is_plugin_active('location')) {
            $with = array_merge($with, ['state', 'city', 'country']);
        }

        $job = $this->jobRepository->getJobs([], [
            'condition' => $condition,
            'take' => 1,
            'with' => $with,
        ]);

        if (! $job) {
            $expiredJob = JobModel::query()
                ->where('id', $slugModel->reference_id)
                ->first();

            if ($expiredJob && $expiredJob->is_expired) {
                return $this->showExpiredJob($expiredJob, $slugModel);
            }

            abort(404);
        }

        $job->setRelation('slugable', $slugModel);

        SeoHelper::setTitle($job->name)->setDescription($job->description);

        $meta = new SeoOpenGraph();
        $meta->setDescription($job->description);
        $meta->setUrl($job->url);
        $meta->setTitle($job->name);
        $meta->setType('article');

        $companyJobs = collect();

        $company = $job->company;

        if ($company && $company->id) {
            $company->loadCount('jobs');

            if (! $job->hide_company) {
                if ($company->logo) {
                    $meta->setImage(RvMedia::getImageUrl($company->logo));
                }

                $condition = [
                    ['jb_jobs.company_id', '=', $company->id],
                    ['jb_jobs.id', '!=', $job->id],
                    ['jb_jobs.hide_company', '=', false],
                ];

                $companyJobs = $this->jobRepository->getJobs(
                    [],
                    [
                        'condition' => $condition,
                        'take' => 5,
                        'order_by' => [
                            'jb_jobs.created_at' => 'desc',
                        ],
                    ],
                );
            }
        }

        SeoHelper::setSeoOpenGraph($meta);

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.jobs'), JobBoardHelper::getJobsPageURL())
            ->add($job->name, $job->url);

        if (function_exists('admin_bar')) {
            admin_bar()->registerLink(trans('plugins/job-board::messages.edit_this_job'), route('jobs.edit', $job->id), 'jobs.edit');
        }

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, JOB_MODULE_SCREEN_NAME, $job);

        if (
            JobBoardHelper::shouldNoIndexInactiveJobs()
            && ($job->is_expired || $job->status == JobStatusEnum::CLOSED)
        ) {
            SeoHelper::meta()->addMeta('robots', 'noindex, follow');
        }

        $viewed = Helper::handleViewCount($job, 'viewed_job');

        if ($viewed) {
            $ip = Helper::getIpFromThirdParty();

            $countries = $this->getCountries($ip);

            Analytics::query()->create([
                'job_id' => $job->id,
                'country' => Arr::get($countries, 'countryCode'),
                'country_full' => Arr::get($countries, 'countryName'),
                'referer' => Str::limit(request()->server('HTTP_REFERER') ?? null, 250),
                'ip_address' => Str::limit($ip, 39),
                'ip_hashed' => 0,
            ]);
        }

        // Load all necessary relationships for job details
        $job->loadMissing([
            'customFields',
            'jobShift',
            'functionalArea',
            'degreeLevel',
            'careerLevel',
            'jobExperience',
            'jobTypes',
            'categories',
            'skills',
            'tags',
            'company',
        ]);

        return Theme::scope(
            'job-board.job',
            compact('job', 'companyJobs', 'company'),
            'plugins/job-board::themes.job'
        )->render();
    }

    public function getJobs(Request $request)
    {
        $requestQuery = JobBoardHelper::getJobFilters($request->input());

        if (! empty($requestQuery['keyword'])) {
            SeoHelper::setTitle(trans('plugins/job-board::messages.search_results_for', ['keyword' => $requestQuery['keyword']]));
        }

        if (! empty($requestQuery['job_categories'])) {
            $categories = Category::query()
                ->whereIn('id', $requestQuery['job_categories'])
                ->select('id', 'name')
                ->get()
                ->map(fn ($category) => $category->name)
                ->implode(', ');

            if ($categories) {
                if (! empty($requestQuery['keyword'])) {
                    SeoHelper::setTitle(trans('plugins/job-board::messages.search_results_in_categories', [
                        'keyword' => $requestQuery['keyword'],
                        'categories' => $categories,
                    ]));
                } else {
                    SeoHelper::setTitle(trans('plugins/job-board::messages.jobs_in_categories', [
                        'keyword' => $requestQuery['keyword'],
                        'categories' => $categories,
                    ]));
                }
            }
        }

        $with = [
            'tags.slugable',
            'jobTypes',
            'slugable',
            'jobExperience',
            'company',
            'company.metadata',
            'company.slugable',
        ];

        $sortBy = match ($request->input('sort_by') ?: 'newest') {
            'oldest' => [
                'jb_jobs.created_at' => 'ASC',
            ],
            default => [
                'jb_jobs.created_at' => 'DESC',
            ],
        };

        // Always prioritize featured jobs
        $sortBy = ['jb_jobs.is_featured' => 'DESC', ...$sortBy];

        if (is_plugin_active('location')) {
            $with = array_merge($with, array_keys(Location::getSupported(JobModel::class)));
        }

        $jobs = app(JobInterface::class)->getJobs(
            $requestQuery,
            [
                'with' => $with,
                'order_by' => $sortBy,
                'paginate' => [
                    'per_page' => $requestQuery['per_page'] ?? Arr::first(JobBoardHelper::getPerPageParams()),
                    'current_paged' => $requestQuery['page'] ?? 1,
                ],
            ],
        );

        $additional['total'] = $jobs->total();

        if ($additional['total']) {
            $message = trans('plugins/job-board::messages.showing_results', [
                'from' => number_format($jobs->firstItem()),
                'to' => number_format($jobs->lastItem()),
                'total' => number_format($jobs->total()),
            ]);
        } else {
            $message = trans('plugins/job-board::messages.no_results_found');
        }

        $additional['message'] = $message;

        $jobsView = Theme::getThemeNamespace('views.job-board.partials.job-items');

        if (! view()->exists($jobsView)) {
            $jobsView = 'plugins/job-board::themes.partials.job-items';
        }

        $filtersData['jobs'] = $jobs;
        if ($requestQuery['city_id']) {
            $filtersData['stateId'] = $requestQuery['city_id'];
        }
        if ($requestQuery['state_id']) {
            $filtersData['stateId'] = $requestQuery['state_id'];
        }

        $filtersView = Theme::getThemeNamespace('views.job-board.partials.filters');

        if (view()->exists($filtersView)) {
            $additional['filters_html'] = view(
                $filtersView,
                $filtersData
            )->render();
        }

        return $this
            ->httpResponse()
            ->setData(view($jobsView, compact('jobs'))->render())
            ->setAdditional($additional)
            ->setMessage($message);
    }

    public function getcompanies(Request $request)
    {
        $requestQuery = JobBoardHelper::getCompanyFilterParams($request->input());

        $companies = Company::query()
            ->withCount([
                'activeJobs as jobs_count',
                'reviews',
            ])
            ->withAvg('reviews', 'star')
            ->with(['slugable', 'accounts'])
            ->with(['slugable', 'accounts'])
            ->pinFeatured();

        // Filter by company ID (institution name)
        if ($request->input('company_id')) {
            $companies = $companies->where('id', $request->input('company_id'));
        }

        // Filter by institution type
        if ($request->has('institution_type') && is_array($request->input('institution_type'))) {
            $companies = $companies->whereIn('institution_type', $request->input('institution_type'));
        }

        // Filter by location
        if ($request->input('country_id')) {
            $companies = $companies->where('country_id', $request->input('country_id'));
        }
        if ($request->input('state_id')) {
            $companies = $companies->where('state_id', $request->input('state_id'));
        }
        if ($request->input('city_id')) {
            $companies = $companies->where('city_id', $request->input('city_id'));
        }

        // Filter by campus type
        if ($request->has('campus_type') && is_array($request->input('campus_type'))) {
            $companies = $companies->whereIn('campus_type', $request->input('campus_type'));
        }

        // Filter by currently hiring (has active jobs)
        if ($request->boolean('currently_hiring')) {
            $companies = $companies->has('activeJobs');
        }

        // Filter by benefits offered (staff_facilities)
        if ($request->has('benefits') && is_array($request->input('benefits'))) {
            $benefits = $request->input('benefits');
            $companies = $companies->where(function (Builder $query) use ($benefits): void {
                foreach ($benefits as $benefit) {
                    $query->orWhereJsonContains('staff_facilities', $benefit);
                }
            });
        }

        // Filter by standard level
        if ($request->has('standard_level') && is_array($request->input('standard_level'))) {
            $standardLevels = $request->input('standard_level');
            $companies = $companies->where(function (Builder $query) use ($standardLevels): void {
                foreach ($standardLevels as $level) {
                    $query->orWhereJsonContains('standard_level', $level);
                }
            });
        }

        if ($requestQuery['keyword']) {
            if (
                is_plugin_active('language') &&
                is_plugin_active('language-advanced') &&
                Language::getCurrentLocale() != Language::getDefaultLocale()
            ) {
                $companies = $companies->where(function (Builder $query) use ($requestQuery): void {
                    $query->where('name', 'LIKE', $requestQuery['keyword'] . '%')
                        ->orWhereHas('translations', function (Builder $query) use ($requestQuery): void {
                            $query->where('name', 'LIKE', $requestQuery['keyword'] . '%');
                        });
                });
            } else {
                $companies = $companies->where('name', 'LIKE', $requestQuery['keyword'] . '%');
            }
        }

        match ($requestQuery['sort_by'] ?? 'oldest') {
            'newest' => $companies = $companies->orderBy('is_featured', 'DESC')->latest(),
            default => $companies = $companies->orderBy('is_featured', 'DESC')->oldest(),
        };

        $companies = $companies->paginate($requestQuery['per_page'] ?: 12);

        $total = $companies->total();

        if ($total) {
            $message = trans('plugins/job-board::messages.showing_results', [
                'from' => number_format($companies->firstItem()),
                'to' => number_format($companies->lastItem()),
                'total' => number_format($companies->total()),
            ]);
        } else {
            $message = trans('plugins/job-board::messages.no_results_found');
        }

        $view = Theme::getThemeNamespace('views.job-board.partials.companies');

        if (! view()->exists($view)) {
            $view = 'plugins/job-board::themes.partials.companies';
        }

        return $this
            ->httpResponse()
            ->setData(view($view, compact('companies'))->render())
            ->setAdditional([
                'total' => $total,
                'message' => $message,
            ])
            ->setMessage($message);
    }

    public function postApplyJob(ApplyJobRequest $request, ?int $id = null)
    {
        if (! auth('account')->check() && ! JobBoardHelper::isGuestApplyEnabled()) {
            throw new HttpException(422, trans('plugins/job-board::messages.please_login_to_apply'));
        }

        try {
            if (! $id) {
                $id = $request->input('job_id');
            }

            if (! $id) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setCode(404);
            }

            $request->merge(['account_id' => null]);

            $job = $this->jobRepository->getJobs([], [
                'condition' => ['jb_jobs.id' => $id],
                'take' => 1,
                'with' => ['author'],
            ]);

            if (! $job) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setCode(404);
            }

            if (! $job->isJobOpen()) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage(trans('plugins/job-board::messages.job_closed'))
                    ->setCode(404);
            }

            $jobType = $request->input('job_type');

            if (($job->apply_url && $jobType !== 'external') ||
                (! $job->apply_url && $jobType !== 'internal')
            ) {
                return $this
                    ->httpResponse()->setError()->setMessage(trans('plugins/job-board::messages.job_not_available'));
            }

            $account = null;

            if (auth('account')->check()) {
                /**
                 * @var Account $account
                 */
                $account = auth('account')->user();

                if ($account->isEmployer()) {
                    return $this
                        ->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.employers_cannot_apply'));
                }

                $request->merge(['account_id' => $account->getKey()]);

                if ($job->is_applied) {
                    return $this
                        ->httpResponse()
                        ->setError()
                        ->setMessage(
                            trans('plugins/job-board::messages.already_applied')
                        );
                }

                // Job seeker package: enforce apply limit; if exceeded, ask to upgrade
                $jsCtx = JobSeekerPackageContext::forAccount($account);
                if (! $jsCtx->canApply()) {
                    $message = $jsCtx->hasPackage() && $jsCtx->isPeriodValid()
                        ? trans('plugins/job-board::messages.job_apply_limit_reached')
                        : trans('plugins/job-board::messages.job_apply_upgrade_required');

                    return $this
                        ->httpResponse()
                        ->setError()
                        ->setMessage($message)
                        ->setData([
                            'upgrade_url' => $jsCtx->packagesUrl(),
                            'apply_ctx' => [
                                'hasPackage' => $jsCtx->hasPackage(),
                                'isPeriodValid' => $jsCtx->isPeriodValid(),
                                'jobApplicationsUsed' => $jsCtx->jobApplicationsUsed,
                                'jobApplyLimit' => $jsCtx->jobApplyLimit,
                                'jobApplyCreditsBalance' => $jsCtx->jobApplyCreditsBalance,
                                'periodEnd' => $jsCtx->periodEnd?->toDateTimeString(),
                                'packageId' => $jsCtx->package?->getKey(),
                                'packageName' => $jsCtx->package?->name,
                            ],
                        ]);
                }
            }

            $jobApplication = new JobApplication();

            $request->merge(['job_id' => $job->id]);

            // Full name: use request or fallback to account name (fix 422 when profile name empty)
            $fullName = $request->input('full_name');
            if ((! is_string($fullName) || trim($fullName) === '') && $account) {
                $fullName = trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) ?: ($account->full_name ?? $account->name ?? '');
                $request->merge(['full_name' => $fullName]);
            }
            $fullName = $request->input('full_name');
            if (is_string($fullName) && trim($fullName) !== '') {
                $parts = preg_split('/\s+/', trim($fullName), 2, PREG_SPLIT_NO_EMPTY);
                $request->merge([
                    'first_name' => $parts[0] ?? '',
                    'last_name' => $parts[1] ?? '',
                ]);
            }
            // Email: ensure sent (hidden in form; use account email when logged in)
            if ($account && ! $request->filled('email')) {
                $request->merge(['email' => $account->email]);
            }

            if (! $job->apply_url) {
                if ($request->hasFile('resume')) {
                    $result = RvMedia::handleUpload($request->file('resume'), 0, 'job-applications');

                    if (! $result['error']) {
                        $file = $result['data'];
                        $request->merge(['resume' => $file->url]);
                    } else {
                        $request->merge(['resume' => null]);
                    }
                } elseif ($account && $resume = $account->resume) {
                    $request->merge(['resume' => $resume]);
                }

                if ($request->hasFile('cover_letter')) {
                    $result = RvMedia::handleUpload($request->file('cover_letter'), 0, 'job-applications');

                    if (! $result['error']) {
                        $file = $result['data'];
                        $request->merge(['cover_letter' => $file->url]);
                    } else {
                        $request->merge(['cover_letter' => null]);
                    }
                } elseif ($account && $coverLetter = $account->cover_letter) {
                    $request->merge(['cover_letter' => $coverLetter]);
                }
            } else {
                $request->merge(['resume' => null, 'cover_letter' => null]);
                $jobApplication->is_external_apply = true;
            }

            $input = $request->input();
            $screeningAnswers = $request->input('screening_answers', []);
            if (! is_array($screeningAnswers)) {
                $screeningAnswers = [];
            }
            // Flatten screening_answers: arrays (e.g. from checkboxes) as JSON string
            foreach ($screeningAnswers as $qId => $val) {
                if (is_array($val)) {
                    $screeningAnswers[$qId] = json_encode(array_values($val));
                }
            }
            // Validate correct_answer restriction for all questions (admin + job-specific)
            // Check if table exists before loading relationship to avoid errors
            try {
                if (Schema::hasTable('jb_job_screening_questions')) {
            $job->load(['screeningQuestions', 'jobScreeningQuestions']);
                } else {
                    // Table doesn't exist, only load admin pool questions
                    $job->load(['screeningQuestions']);
                }
            } catch (\Exception $e) {
                // If there's any error loading relationships, just load admin pool
                \Log::warning('Could not load jobScreeningQuestions: ' . $e->getMessage());
                $job->load(['screeningQuestions']);
            }
            
            $allQuestions = $job->getAllScreeningQuestionsForApply();
            foreach ($allQuestions as $sq) {
                $correctAnswer = $sq->correct_answer ?? null;
                if (! $correctAnswer || ! ($sq->is_required ?? false)) {
                    continue;
                }
                $answer = $screeningAnswers[$sq->id] ?? null;
                if ($answer === null || $answer === '') {
                    return $this
                        ->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.screening_answer_required', ['question' => $sq->question]));
                }
                $matches = false;
                if (is_string($answer) && str_starts_with(trim($answer), '[')) {
                    $decoded = json_decode($answer, true);
                    $matches = is_array($decoded) && in_array(trim($correctAnswer), array_map('trim', $decoded));
                } else {
                    $matches = trim((string) $answer) === trim($correctAnswer);
                }
                if (! $matches) {
                    return $this
                        ->httpResponse()
                        ->setError()
                        ->setMessage(trans('plugins/job-board::messages.screening_answer_incorrect'));
                }
            }
            // Screening file uploads: upload and store URL in screening_answers
            $screeningFiles = $request->file('screening_answers_file', []);
            if (is_array($screeningFiles)) {
                foreach ($screeningFiles as $qId => $file) {
                    if ($file && $file->isValid()) {
                        $result = RvMedia::handleUpload($file, 0, 'job-applications');
                        if (! $result['error'] && isset($result['data'])) {
                            $screeningAnswers[$qId] = $result['data']->url;
                        }
                    }
                }
            }
            $input['screening_answers'] = array_filter($screeningAnswers, function ($v) {
                return $v !== null && $v !== '';
            });
            
            // Only fill with fillable fields to prevent mass assignment issues
            $fillableFields = [
                'first_name',
                'last_name',
                'phone',
                'email',
                'resume',
                'cover_letter',
                'message',
                'screening_answers',
                'job_id',
                'account_id',
                'status',
            ];
            
            $fillableData = array_intersect_key($input, array_flip($fillableFields));
            
            // Set status if not provided - use enum
            if (!isset($fillableData['status'])) {
                $fillableData['status'] = JobApplicationStatusEnum::PENDING;
            }
            
            $jobApplication->fill($fillableData);
            $jobApplication->save();

            if ($account && $account->isJobSeeker()) {
                // Used wallet-purchased job apply slot when package limit was already reached
                if (Schema::hasColumn('jb_accounts', 'job_apply_credits_balance')) {
                    $bal = (int) ($account->getAttribute('job_apply_credits_balance') ?? 0);
                    if ($bal > 0 && $jsCtx->jobApplyLimit !== null && $jsCtx->jobApplicationsUsed >= $jsCtx->jobApplyLimit) {
                        $account->job_apply_credits_balance = $bal - 1;
                        $account->save();
                    }
                }
                JobSeekerPackageContext::clearCache((int) $account->getKey());
            }

            if ($account && $account->isJobSeeker()) {
                // Used wallet-purchased job apply slot when package limit was already reached
                if (Schema::hasColumn('jb_accounts', 'job_apply_credits_balance')) {
                    $bal = (int) ($account->getAttribute('job_apply_credits_balance') ?? 0);
                    if ($bal > 0 && $jsCtx->jobApplyLimit !== null && $jsCtx->jobApplicationsUsed >= $jsCtx->jobApplyLimit) {
                        $account->job_apply_credits_balance = $bal - 1;
                        $account->save();
                    }
                }
                JobSeekerPackageContext::clearCache((int) $account->getKey());
            }

            \Log::info('[JOB_APPLICATION] Application saved successfully', [
                'application_id' => $jobApplication->id,
                'job_id' => $job->id,
                'candidate_email' => $jobApplication->email ?? 'N/A',
                'candidate_name' => ($jobApplication->first_name ?? '') . ' ' . ($jobApplication->last_name ?? ''),
                'has_screening_answers' => !empty($fillableData['screening_answers']),
                'screening_answers_count' => is_array($fillableData['screening_answers'] ?? []) ? count($fillableData['screening_answers']) : 0,
            ]);

            $job::withoutEvents(fn () => $job::withoutTimestamps(fn () => $job->increment('number_of_applied')));

            // Send notification to job seeker if logged in
            if ($account && !$account->isEmployer()) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $notificationService->sendJobAppliedNotification($account, $job->name, $job->id);
                } catch (\Exception $e) {
                    \Log::error('Failed to send job applied notification: ' . $e->getMessage());
                }
            }

            // Send notification to employer
            if ($job->author) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $candidateName = ($jobApplication->first_name ?? '') . ' ' . ($jobApplication->last_name ?? '');
                    if (empty(trim($candidateName))) {
                        $candidateName = $jobApplication->email ?? 'A candidate';
                    }
                    $notificationService->sendNewApplicationNotification(
                        $job->author,
                        $job->name,
                        $job->id,
                        $candidateName,
                        $jobApplication->id
                    );
                } catch (\Exception $e) {
                    \Log::error('Failed to send new application notification to employer: ' . $e->getMessage());
                }
            }
            
            \Log::debug('[JOB_APPLICATION] Job application count incremented', [
                'job_id' => $job->id,
            ]);

            // WhatsApp notifications are now handled by SendEmployerApplicationNotificationJob
            // This ensures all employer phones (author, company, additional) receive notifications

            // Prepare response message first
            $message = $job->apply_url
                ? trans('plugins/job-board::job-application.email.external_redirect')
                : trans('plugins/job-board::job-application.email.success');

            // Prepare response data
            $responseData = ['url' => $job->apply_url];

            if (! $job->apply_url) {
                $jobApplication->setRelation('job', $job);

                if ($account) {
                    $jobApplication->setRelation('account', $account);
                }

                // Dispatch event in background using queue to avoid blocking response
                // Store IDs to avoid serialization issues with full objects
                $applicationId = $jobApplication->id;
                $jobId = $job->id;
                
                try {
                    \Log::info('[JOB_APPLICATION] Dispatching email notification via queue', [
                        'application_id' => $applicationId,
                        'job_id' => $jobId,
                    ]);
                    
                    // Dispatch event in a closure-based queue job to run after response
                    Queue::push(function () use ($applicationId, $jobId) {
                        \Log::info('[JOB_APPLICATION] Queue job started - loading application and job', [
                            'application_id' => $applicationId,
                            'job_id' => $jobId,
                        ]);
                        
                        $app = JobApplication::find($applicationId);
                        $jobModel = JobModel::find($jobId);
                        
                        if ($app && $jobModel) {
                            // Reload relationships if needed
                            $app->loadMissing(['job', 'account']);
                            $jobModel->loadMissing(['author', 'company']);
                            
                            \Log::info('[JOB_APPLICATION] Dispatching JobAppliedEvent', [
                                'application_id' => $app->id,
                                'job_id' => $jobModel->id,
                            ]);
                            
                            JobAppliedEvent::dispatch($app, $jobModel);
                            
                            \Log::info('[JOB_APPLICATION] JobAppliedEvent dispatched successfully', [
                                'application_id' => $app->id,
                            ]);
                        } else {
                            \Log::error('[JOB_APPLICATION] Application or Job not found in queue job', [
                                'application_id' => $applicationId,
                                'job_id' => $jobId,
                                'app_found' => $app ? 'yes' : 'no',
                                'job_found' => $jobModel ? 'yes' : 'no',
                            ]);
                        }
                    });
                    
                    \Log::info('[JOB_APPLICATION] Queue job pushed successfully', [
                        'application_id' => $applicationId,
                    ]);
                } catch (\Exception $eventException) {
                    \Log::warning('[JOB_APPLICATION] Queue push failed, trying synchronous dispatch', [
                        'application_id' => $applicationId,
                        'error' => $eventException->getMessage(),
                    ]);
                    
                    // If queue fails, try synchronous dispatch as fallback
                    try {
                        \Log::info('[JOB_APPLICATION] Attempting synchronous event dispatch', [
                            'application_id' => $applicationId,
                        ]);
                        
                        JobAppliedEvent::dispatch($jobApplication, $job);
                        
                        \Log::info('[JOB_APPLICATION] Synchronous event dispatch successful', [
                            'application_id' => $applicationId,
                        ]);
                    } catch (\Exception $syncException) {
                        // Log error but don't fail the application
                        \Log::error('[JOB_APPLICATION] Failed to dispatch JobAppliedEvent (both queue and sync failed)', [
                            'exception' => $syncException,
                            'application_id' => $applicationId,
                            'job_id' => $jobId,
                            'error_message' => $syncException->getMessage(),
                            'trace' => $syncException->getTraceAsString(),
                        ]);
                    }
                }
            } else {
                // Track external apply click: increment counter and log user info
                $job::withoutEvents(fn () => $job::withoutTimestamps(fn () => $job->increment('external_apply_clicks')));
                ExternalApplyClickLog::query()->create([
                    'job_id' => $job->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'account_id' => $account?->getKey(),
                    'referer' => $request->header('referer'),
                    'clicked_at' => now(),
                ]);
            }

            // Return response immediately - don't wait for email sending
            if (! $request->ajax()) {
                return redirect()->to($job->apply_url);
            }

            return $this
                ->httpResponse()
                ->setData($responseData)
                ->setMessage($message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors specifically
            \Log::error('Job application validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->except(['resume', 'cover_letter', 'screening_answers_file']),
            ]);
            
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($e->getMessage())
                ->setData(['errors' => $e->errors()]);
        } catch (Exception $e) {
            // Log the actual error for debugging
            \Log::error('Job application failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['resume', 'cover_letter', 'screening_answers_file']),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            // Always show the actual error message for better debugging
            $errorMessage = $e->getMessage() ?: trans('plugins/job-board::job-application.email.failed');
            
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($errorMessage);
        }
    }

    public function getJobCategory(
        string $slug,
        Request $request
    ) {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Category::class));

        abort_unless($slug, 404);

        $condition = [
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (AdminHelper::isPreviewing()) {
            Arr::forget($condition, 'status');
            Arr::forget($condition, 'moderation_status');
        }

        $category = Category::query()
            ->where($condition)
            ->with('activeChildren')
            ->firstOrFail();

        SeoHelper::setTitle($category->name)->setDescription($category->description);

        $meta = new SeoOpenGraph();
        $meta->setDescription($category->description);
        $meta->setUrl($category->url);
        $meta->setTitle($category->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.categories'), JobBoardHelper::getJobCategoriesPageURL())
            ->add($category->name, $category->url);

        if (function_exists('admin_bar')) {
            admin_bar()->registerLink(
                trans('plugins/job-board::messages.edit_job_category'),
                route('job-categories.edit', $category->id),
                'job-categories.edit'
            );
        }

        $requestQuery = JobBoardHelper::getJobFilters($request->input());

        // Get all category IDs including child categories
        $categoryIds = $category->getAllCategoryIds();

        $with = [
            'tags.slugable',
            'jobTypes',
            'slugable',
            'jobExperience',
            'company',
            'company.metadata',
            'company.slugable',
        ];

        $sortBy = match ($request->input('sort_by') ?: 'newest') {
            'oldest' => [
                'jb_jobs.created_at' => 'ASC',
            ],
            default => [
                'jb_jobs.created_at' => 'DESC',
            ],
        };

        // Always prioritize featured jobs
        $sortBy = ['jb_jobs.is_featured' => 'DESC', ...$sortBy];

        if (is_plugin_active('location')) {
            $with = array_merge($with, array_keys(Location::getSupported(JobModel::class)));
        }

        $jobs = $this->jobRepository->getJobs(
            array_merge($requestQuery, [
                'job_categories' => $categoryIds,
            ]),
            [
                'with' => $with,
                'order_by' => $sortBy,
                'paginate' => [
                    'per_page' => $requestQuery['per_page'] ?? Arr::first(JobBoardHelper::getPerPageParams()),
                    'current_paged' => $requestQuery['page'] ?? 1,
                ],
            ]
        );

        // Handle AJAX request
        if ($request->ajax()) {
            $additional['total'] = $jobs->total();

            if ($additional['total']) {
                $message = trans('plugins/job-board::messages.showing_results', [
                    'from' => number_format($jobs->firstItem()),
                    'to' => number_format($jobs->lastItem()),
                    'total' => number_format($jobs->total()),
                ]);
            } else {
                $message = trans('plugins/job-board::messages.no_results_found');
            }

            $additional['message'] = $message;

            $jobsView = Theme::getThemeNamespace('views.job-board.partials.job-items');

            if (! view()->exists($jobsView)) {
                $jobsView = 'plugins/job-board::themes.partials.job-items';
            }

            $filtersData['jobs'] = $jobs;
            if ($requestQuery['city_id']) {
                $filtersData['stateId'] = $requestQuery['city_id'];
            }
            if ($requestQuery['state_id']) {
                $filtersData['stateId'] = $requestQuery['state_id'];
            }

            $filtersView = Theme::getThemeNamespace('views.job-board.partials.filters');

            if (view()->exists($filtersView)) {
                $additional['filters_html'] = view(
                    $filtersView,
                    $filtersData
                )->render();
            }

            return $this
                ->httpResponse()
                ->setData(view($jobsView, compact('jobs'))->render())
                ->setAdditional($additional)
                ->setMessage($message);
        }

        $data = $this->getJobFilterData();

        $data['category'] = $category;
        $data['jobs'] = $jobs;

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, JOB_CATEGORY_MODULE_SCREEN_NAME, $category);

        return Theme::scope('job-board.job-category', $data, 'plugins/job-board::themes.job-category')->render();
    }

    protected function getJobFilterData(): array
    {
        return Cache::remember('job_filter_data', 3600, function () {
            $jobCategories = Category::query()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->with(['activeChildren.activeChildren.activeChildren'])
                ->get();

            Category::addJobsCountWithChildren($jobCategories);

            $jobTypes = JobType::query()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->withCount([
                    'jobs' => function ($query): void {
                        $query
                            ->where('jb_jobs.status', JobStatusEnum::PUBLISHED)
                            ->notExpired();
                    },
                ])
                ->get();

            $jobExperiences = JobExperience::query()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->withCount([
                    'jobs' => function ($query): void {
                        $query
                            ->where('jb_jobs.status', JobStatusEnum::PUBLISHED)
                            ->notExpired();
                    },
                ])
                ->get();

            $jobSkills = JobSkill::query()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->withCount([
                    'jobs' => function ($query): void {
                        $query
                            ->where('jb_jobs.status', JobStatusEnum::PUBLISHED)
                            ->notExpired();
                    },
                ])
                ->get();

            $jobFeaturedCategories = $jobCategories->where('is_featured');

            return compact(
                'jobCategories',
                'jobTypes',
                'jobExperiences',
                'jobFeaturedCategories',
                'jobSkills'
            );
        });
    }

    public function getJobTag(string $slug, Request $request)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Tag::class));

        abort_unless($slug, 404);

        $condition = [
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (AdminHelper::isPreviewing()) {
            Arr::forget($condition, 'status');
            Arr::forget($condition, 'moderation_status');
        }

        $tag = Tag::query()
            ->where($condition)
            ->firstOrFail();

        SeoHelper::setTitle($tag->name)->setDescription($tag->description);

        $meta = new SeoOpenGraph();
        $meta->setDescription($tag->description);
        $meta->setUrl($tag->url);
        $meta->setTitle($tag->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        Theme::breadcrumb()
            ->add($tag->name, $tag->url);

        if (function_exists('admin_bar')) {
            admin_bar()->registerLink(
                trans('plugins/job-board::messages.edit_job_tag'),
                route('job-board.tag.edit', $tag->id),
                'job-board.tag.edit'
            );
        }

        $requestQuery = JobBoardHelper::getJobFilters($request->input());

        $jobs = $this->jobRepository->getJobs(
            array_merge($requestQuery, [
                'tags' => [$tag->getKey()],
                'job_tags' => [$tag->getKey()],
            ]),
            [
                'paginate' => [
                    'per_page' => isset($requestQuery['per_page']) ? (int) $requestQuery['per_page'] : 20,
                    'current_paged' => isset($requestQuery['page']) ? (int) $requestQuery['page'] : 1,
                ],
            ]
        );

        $data = $this->getJobFilterData();

        $data['tag'] = $tag;
        $data['jobs'] = $jobs;

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, JOB_BOARD_TAG_MODULE_SCREEN_NAME, $tag);

        return Theme::scope('job-board.job-tag', $data, 'plugins/job-board::themes.job-tag')->render();
    }

    protected function getCountries(string $ip): array
    {
        // We try to get the IP country using (or not) the anonymized IP
        // If it fails, because GeoLite2 doesn't know the IP country, we
        // will set it to Unknown
        try {
            $reader = new Reader(__DIR__ . '/../../../database/GeoLite2-Country.mmdb');
            $record = $reader->country($ip);
            $countryCode = $record->country->isoCode;
            $countryName = $record->country->name;
        } catch (Exception) {
            $countryCode = 'N/A';
            $countryName = 'Unknown';
        }

        return compact('countryCode', 'countryName');
    }

    public function getCompany(string $slug)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Company::class));

        abort_unless($slug, 404);

        $condition = [
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (AdminHelper::isPreviewing()) {
            Arr::forget($condition, 'status');
        }

        /**
         * @var Company $company
         */
        $with = ['admission', 'slugable'];
        
        // Load location relationships if location plugin is active
        if (is_plugin_active('location')) {
            $with = array_merge($with, array_keys(Location::getSupported(Company::class)));
        }
        
        $company = Company::query()
            ->where($condition)
            ->with($with)
            ->withCount([
                'jobs' => function (Builder $query): void {
                    // @phpstan-ignore-next-line
                    $query
                        ->active()
                        ->where(['jb_jobs.hide_company' => false]);
                },
                'reviews',
            ])
            ->withAvg('reviews', 'star')
            ->firstOrFail();

        $company->setRelation('slugable', $slug);

        $params = [
            'condition' => [
                'jb_jobs.company_id' => $company->getKey(),
                'jb_jobs.hide_company' => false,
            ],
            'order_by' => ['created_at' => 'DESC'],
            'paginate' => [
                'per_page' => 3,
                'current_paged' => request()->integer('page') ?: 1,
            ],
        ];

        $jobs = $this->jobRepository->getJobs([], $params);

        if (request()->ajax()) {
            $view = Theme::getThemeNamespace('views.job-board.partials.company-job-items');

            if (! view()->exists($view)) {
                $view = 'plugins/job-board::themes.partials.job-items';
            }

            return $this
                ->httpResponse()->setData(view($view, compact('jobs', 'company'))->render());
        }

        if (function_exists('admin_bar')) {
            admin_bar()->registerLink(trans('plugins/job-board::messages.edit_this_company'), route('companies.edit', $company->getKey()), 'companies.edit');
        }

        SeoHelper::setTitle($company->name)->setDescription($company->description);

        $meta = new SeoOpenGraph();
        if ($company->logo) {
            $meta->setImage(RvMedia::getImageUrl($company->logo));
        }
        $meta->setDescription($company->description);
        $meta->setUrl($company->url);
        $meta->setTitle($company->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        Helper::handleViewCount($company, 'viewed_company');

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.companies'), JobBoardHelper::getJobcompaniesPageURL())
            ->add($company->name, $company->url);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, COMPANY_MODULE_SCREEN_NAME, $company);

        $canReview = false;
        $canReviewCompany = false;

        if (JobBoardHelper::isEnabledReview()) {
            try {
            $company->setRelation('reviews', $company->reviews()->with('createdBy')->paginate(10));

            /** @var Account $account */
            $account = Auth::guard('account')->user();

                if ($account) {
                    $canReview = ! $account->isEmployer() && $account->canReview($company);
                }
            } catch (\Exception $e) {
                \Log::error('Error loading reviews for company: ' . $e->getMessage());
            }
        }

        $canReviewCompany = $canReview;

        // Admission on profile: unlocked if (package has "Admission Form on Profile" OR credits entitlement) and company has content
        $ownerAccount = $company->accounts()->first();
        $hasAdmissionContent = $company->admission && trim((string) ($company->admission->content ?? '')) !== '';
        $showAdmissionFromPackage = false;
        $hasAdmissionEntitlement = false;
        if ($ownerAccount && JobBoardHelper::isEnabledCreditsSystem()) {
            $ctx = PackageContext::forAccount($ownerAccount);
            $showAdmissionFromPackage = $ctx->hasAdmissionFormOnProfile();
            $hasAdmissionEntitlement = CreditConsumption::hasAdmissionEnquiryAccess($ownerAccount);
        }
        $showAdmissionOnProfile = $hasAdmissionContent && (
            ! JobBoardHelper::isEnabledCreditsSystem()
            || $hasAdmissionEntitlement
        );

        $admissionFormLocked = $hasAdmissionContent && ! $showAdmissionOnProfile;
        $admissionUnlockCredits = 0;
        if (JobBoardHelper::isEnabledCreditsSystem()) {
            $admissionUnlockCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_ADMISSION_ENQUIRY, 500);
        }
        $isOwner = false;
        $canUnlockAdmission = false;
        if (Auth::guard('account')->check()) {
            $currentAccount = Auth::guard('account')->user();
            $isOwner = $currentAccount->isEmployer() && $company->accounts()->where('account_id', $currentAccount->getKey())->exists();
            $canUnlockAdmission = $isOwner && $currentAccount->credits >= $admissionUnlockCredits && $admissionUnlockCredits > 0;
        }

        // Job seeker package: "View School Contact Info" – gate email, phone, address, website for job seekers without feature
        $canViewSchoolContactInfo = true;
        $contactInfoUpgradeUrl = null;
        if (Auth::guard('account')->check() && JobBoardHelper::isEnabledCreditsSystem()) {
            $viewerAccount = Auth::guard('account')->user();
            if ($viewerAccount->isJobSeeker()) {
                $jsCtx = JobSeekerPackageContext::forAccount($viewerAccount);
                $canViewSchoolContactInfo = $jsCtx->hasViewContactInfo();
                if (! $canViewSchoolContactInfo) {
                    $contactInfoUpgradeUrl = $jsCtx->packagesUrl();
                }
            }
        }

        return Theme::scope(
            'job-board.company',
            compact(
                'company',
                'jobs',
                'canReview',
                'canReviewCompany',
                'showAdmissionOnProfile',
                'admissionFormLocked',
                'admissionUnlockCredits',
                'isOwner',
                'canUnlockAdmission',
                'canViewSchoolContactInfo',
                'contactInfoUpgradeUrl',
            ),
            compact(
                'company',
                'jobs',
                'canReview',
                'canReviewCompany',
                'showAdmissionOnProfile',
                'admissionFormLocked',
                'admissionUnlockCredits',
                'isOwner',
                'canUnlockAdmission',
                'canViewSchoolContactInfo',
                'contactInfoUpgradeUrl',
            ),
            'plugins/job-board::themes.company'
        )->render();
    }

    public function getCandidate(string $slugParam)
    public function getCandidate(string $slugParam)
    {
        abort_if(JobBoardHelper::isDisabledPublicProfile(), 404);

        $prefix = SlugHelper::getPrefix(Account::class, 'candidates');
        $slug = SlugHelper::getSlug($slugParam, $prefix);
        $prefix = SlugHelper::getPrefix(Account::class, 'candidates');
        $slug = SlugHelper::getSlug($slugParam, $prefix);

        $condition = [
            ['is_public_profile', '=', 1],
            ['type', '=', AccountTypeEnum::JOB_SEEKER],
        ];

        if (setting('verify_account_email', 0)) {
            $condition[] = ['confirmed_at', '!=', null];
        }

        /**
         * @var Account|null $candidate
         * @var Account|null $candidate
         */
        $candidate = null;

        if ($slug) {
            $candidate = Account::query()
                ->where(array_merge($condition, [['id', '=', $slug->reference_id]]))
                ->first();
        }

        // Fallback: find by unique_id or numeric id when slug record is missing
        if (! $candidate && Schema::hasColumn('jb_accounts', 'unique_id')) {
            $candidate = Account::query()
                ->where($condition)
                ->where(function (Builder $q) use ($slugParam): void {
                    $q->where('unique_id', $slugParam);
                    if (is_numeric($slugParam)) {
                        $q->orWhere('id', (int) $slugParam);
                    }
                })
                ->first();
            if ($candidate && ! $slug) {
                $slug = \Botble\Slug\Models\Slug::query()->firstOrCreate(
                    [
                        'reference_type' => Account::class,
                        'reference_id' => $candidate->getKey(),
                        'prefix' => $prefix,
                    ],
                    ['key' => Str::slug($slugParam ?: $candidate->full_name ?: (string) $candidate->id)]
                );
            }
        }

        if (! $candidate) {
            $candidate = $slug
                ? Account::query()->where($condition)->where('id', $slug->reference_id)->first()
                : null;
        }

        abort_unless($candidate, 404);
        $candidate = null;

        if ($slug) {
            $candidate = Account::query()
                ->where(array_merge($condition, [['id', '=', $slug->reference_id]]))
                ->first();
        }

        // Fallback: find by unique_id or numeric id when slug record is missing
        if (! $candidate && Schema::hasColumn('jb_accounts', 'unique_id')) {
            $candidate = Account::query()
                ->where($condition)
                ->where(function (Builder $q) use ($slugParam): void {
                    $q->where('unique_id', $slugParam);
                    if (is_numeric($slugParam)) {
                        $q->orWhere('id', (int) $slugParam);
                    }
                })
                ->first();
            if ($candidate && ! $slug) {
                $slug = \Botble\Slug\Models\Slug::query()->firstOrCreate(
                    [
                        'reference_type' => Account::class,
                        'reference_id' => $candidate->getKey(),
                        'prefix' => $prefix,
                    ],
                    ['key' => Str::slug($slugParam ?: $candidate->full_name ?: (string) $candidate->id)]
                );
            }
        }

        if (! $candidate) {
            $candidate = $slug
                ? Account::query()->where($condition)->where('id', $slug->reference_id)->first()
                : null;
        }

        abort_unless($candidate, 404);

        // Allow employers to view any candidate profile; allow job seeker to view their own profile
        $account = Auth::guard('account')->user();
        $canView = $account && ($account->isEmployer() || $account->id === $candidate->id);
        if (!$canView) {
            abort(403, __('Only employers can view candidate profiles'));
        }

        // Candidate profile: package gives N views (1 count per unique candidate); same employer same candidate = no extra count; over limit = allow with 1 credit
        $profileLocked = false;
        $alreadyViewedThisCandidate = false;
        if ($account->isEmployer() && Schema::hasTable('jb_account_candidate_views')) {
            $alreadyViewedThisCandidate = DB::table('jb_account_candidate_views')
                ->where('account_id', $account->getKey())
                ->where('candidate_id', $candidate->getKey())
                ->exists();
        }
        if ($account->isEmployer() && JobBoardHelper::isEnabledCreditsSystem()) {
            $packageContext = PackageContext::forAccount($account);
            $profileLocked = ! $packageContext->canViewProfile($account, $alreadyViewedThisCandidate);
        }

        $candidate->setRelation('slugable', $slug);

        // Record view when allowed (unique per candidate). If over package limit: use pre-paid profile view balance first, else deduct credits (25).
        if (! $profileLocked && $account->isEmployer() && Schema::hasTable('jb_account_candidate_views')) {
            $packageContext = PackageContext::forAccount($account);
            $usesCredit = JobBoardHelper::isEnabledCreditsSystem() && ! $packageContext->profileViewUsesPackageSlot($alreadyViewedThisCandidate);
            if ($usesCredit) {
                $usedBalance = false;
                if (Schema::hasColumn('jb_accounts', 'profile_view_credits_balance')) {
                    $balance = (int) ($account->getAttribute('profile_view_credits_balance') ?? 0);
                    if ($balance >= 1) {
                        $account->profile_view_credits_balance = $balance - 1;
                        $account->save();
                        $usedBalance = true;
                    }
                }
                if (! $usedBalance) {
                    $profileViewCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW, 25);
                    if ($account->credits >= $profileViewCredits) {
                        CreditConsumption::deductForFeature(
                            $account,
                            CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW,
                            $profileViewCredits,
                            trans('plugins/job-board::messages.credits_used_profile_view', ['candidate' => $candidate->name])
                        );
                    }
                }
            }
            $viewInserted = DB::table('jb_account_candidate_views')->insertOrIgnore([
                'account_id' => $account->getKey(),
                'candidate_id' => $candidate->getKey(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Send notification to job seeker when their profile is viewed (only for new views, not repeat views)
            if ($viewInserted && $candidate->id) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $schoolName = $account->companies()->first()->name ?? $account->name ?? 'School';
                    $notificationService->sendProfileViewedNotification(
                        $candidate,
                        $schoolName
                    );
                    Log::info('[NOTIFICATION] Profile viewed notification sent', [
                        'candidate_id' => $candidate->id,
                        'viewer_id' => $account->id,
                        'school_name' => $schoolName,
                    ]);
                } catch (\Exception $e) {
                    Log::error('[NOTIFICATION] Failed to send profile viewed notification', [
                        'candidate_id' => $candidate->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        SeoHelper::setTitle($candidate->name)->setDescription($candidate->description);

        $meta = new SeoOpenGraph();
        if ($candidate->avatar_url) {
            $meta->setImage(RvMedia::getImageUrl($candidate->avatar_url));
        }
        $meta->setDescription($candidate->description);
        $meta->setUrl($candidate->url);
        $meta->setTitle($candidate->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        Helper::handleViewCount($candidate, 'viewed_account');

        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.candidates'), JobBoardHelper::getJobCandidatesPageURL())
            ->add($candidate->name, $candidate->url);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, ACCOUNT_MODULE_SCREEN_NAME, $candidate);

        $experiences = AccountExperience::where('account_id', $candidate->id)->get();
        $educations = AccountEducation::where('account_id', $candidate->id)->get();

        if (JobBoardHelper::isEnabledReview()) {
            $candidate
                ->loadCount('reviews')
                ->loadAvg('reviews', 'star')
                ->setRelation('reviews', $candidate->reviews()->latest()->paginate(10));

            $canReview = $account
                && $account->isEmployer()
                && $account->canReview($candidate);
        } else {
            $canReview = false;
        }

        $employerJobs = collect();
        if ($account && $account->isEmployer()) {
            $companyIds = $account->companies()->pluck('jb_companies.id')->all();
            $employerJobs = JobModel::query()
                ->whereIn('company_id', $companyIds)
                ->where('status', JobStatusEnum::PUBLISHED)
                ->orderBy('name')
                ->get(['id', 'name']);
        }

        $candidateIsFeatured = $candidate->isJobSeeker()
            ? JobSeekerPackageContext::forAccount($candidate)->hasFeaturedProfile()
            : false;

        $employerJobs = collect();
        if ($account && $account->isEmployer()) {
            $companyIds = $account->companies()->pluck('jb_companies.id')->all();
            $employerJobs = JobModel::query()
                ->whereIn('company_id', $companyIds)
                ->where('status', JobStatusEnum::PUBLISHED)
                ->orderBy('name')
                ->get(['id', 'name']);
        }

        $candidateIsFeatured = $candidate->isJobSeeker()
            ? JobSeekerPackageContext::forAccount($candidate)->hasFeaturedProfile()
            : false;

        return Theme::scope(
            'job-board.candidate',
            compact('candidate', 'experiences', 'educations', 'account', 'canReview', 'profileLocked', 'employerJobs', 'candidateIsFeatured'),
            compact('candidate', 'experiences', 'educations', 'account', 'canReview', 'profileLocked', 'employerJobs', 'candidateIsFeatured'),
            'plugins/job-board::themes.candidate'
        )->render();
    }

    public function getCandidates(Request $request)
    {
        abort_if(! $request->ajax() || JobBoardHelper::isDisabledPublicProfile(), 404);

        // Check if user is authenticated and is an employer
        $account = Auth::guard('account')->user();
        if (!$account || !$account->isEmployer()) {
            abort(403, __('Only employers can view candidates'));
        }

        // Get all input parameters including arrays
        $input = $request->all();
        $candidates = JobBoardHelper::filterCandidates($input);

        return $this
            ->httpResponse()
            ->setData([
                'list' => view(
                    Theme::getThemeNamespace('views.job-board.partials.candidate-list'),
                    compact('candidates')
                )->render(),
                'total_text' => trans('plugins/job-board::messages.showing_candidates', [
                    'from' => number_format($candidates->firstItem()),
                    'to' => number_format($candidates->lastItem()),
                    'total' => number_format($candidates->total()),
                ]),
            ]);
    }

    public function getJobFilters(Request $request)
    {
        $requestQuery = JobBoardHelper::getJobFilters($request->input());

        [$jobCategories, $jobTypes, $jobExperiences, $jobSkills, $maxSalaryRange, $jobTags] = JobBoardHelper::dataForFilter($requestQuery);

        return $this
            ->httpResponse()
            ->setData([
                'jobTypes' => $jobTypes->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'jobs_count' => $item->jobs_count ?? 0,
                    ];
                }),
                'jobExperiences' => $jobExperiences->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'jobs_count' => $item->jobs_count ?? 0,
                    ];
                }),
                'jobSkills' => $jobSkills->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'jobs_count' => $item->jobs_count ?? 0,
                    ];
                }),
                'maxSalaryRange' => $maxSalaryRange,
            ]);
    }

    public function changeCurrency(Request $request, ?string $title = null)
    {
        if (empty($title)) {
            $title = $request->input('currency');
        }

        if (! $title) {
            return $this->httpResponse();
        }

        /**
         * @var Currency $currency
         */
        $currency = Currency::query()
            ->where('title', $title)
            ->first();

        if ($currency) {
            cms_currency()->setApplicationCurrency($currency);
        }

        return $this->httpResponse();
    }

    protected function showExpiredJob(JobModel $job, $slug)
    {
        $job->setRelation('slugable', $slug);

        $job->load(['company', 'company.slugable']);

        SeoHelper::setTitle(trans('plugins/job-board::messages.position_closed', ['name' => $job->name]))
            ->setDescription(trans('plugins/job-board::messages.position_no_longer_available'))
            ->meta()
            ->addMeta('robots', 'noindex, follow');

        $meta = new SeoOpenGraph();
        $meta->setDescription(trans('plugins/job-board::messages.position_no_longer_available'));
        $meta->setUrl($job->url);
        $meta->setTitle(trans('plugins/job-board::messages.position_closed', ['name' => $job->name]));
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        $jobsUrl = JobBoardHelper::getJobsPageURL();

        return Theme::scope(
            'job-board.job-expired',
            compact('job', 'jobsUrl'),
            'plugins/job-board::themes.job-expired'
        )->render();
    }
}
