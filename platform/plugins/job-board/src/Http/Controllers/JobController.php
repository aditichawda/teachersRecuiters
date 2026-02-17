<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Enums\ModerationStatusEnum;
use Botble\JobBoard\Events\AdminApprovedJobEvent;
use Botble\JobBoard\Events\JobPublishedEvent;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\JobForm;
use Botble\JobBoard\Http\Requests\ExpireJobsRequest;
use Botble\JobBoard\Http\Requests\JobRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CustomFieldValue;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Repositories\Interfaces\AnalyticsInterface;
use Botble\JobBoard\Services\StoreTagService;
use Botble\JobBoard\Tables\JobTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends BaseController
{
    public function __construct(protected AnalyticsInterface $analyticsRepository)
    {
    }

    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::job.name'), route('jobs.index'));
    }

    public function index(JobTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::job.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::job.create'));

        return JobForm::create()->renderForm();
    }

    public function store(JobRequest $request, StoreTagService $storeTagService)
    {
        $request->merge([
            'expire_date' => Carbon::now()->addDays(JobBoardHelper::jobExpiredDays()),
            'author_type' => Account::class,
        ]);

        if (! $request->has('employer_colleagues')) {
            $request->merge(['employer_colleagues' => []]);
        }

        $job = new Job();
        $job = $job->fill($request->input());
        $job->moderation_status = $request->input('moderation_status');
        $job->never_expired = $request->input('never_expired');
        $job->save();

        $customFields = CustomFieldValue::formatCustomFields($request->input('custom_fields') ?? []);

        $job->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $job->customFields()->saveMany($customFields);

        $job->skills()->sync($request->input('skills', []));
        $job->jobTypes()->sync($request->input('jobTypes', []));
        $job->categories()->sync($request->input('categories', []));

        event(new CreatedContentEvent(JOB_MODULE_SCREEN_NAME, $request, $job));

        if ($job->moderation_status == ModerationStatusEnum::APPROVED) {
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
            \Log::info('Job created successfully by admin. Emails sent to job seekers:', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'total_emails_sent' => $emailCount,
                'job_seekers' => $jobSeekersList
            ]);
            
            error_log('[JOB_CREATE] ✅ Job created successfully by admin!');
            error_log('[JOB_CREATE] 📧 Email sent to ' . $emailCount . ' job seeker(s):');
            foreach ($jobSeekersList as $index => $jobSeeker) {
                error_log('[JOB_CREATE]    ' . ($index + 1) . '. ' . $jobSeeker['name'] . ' (' . $jobSeeker['email'] . ')');
            }
        } else {
            // Even if no emails sent, check if fixed email was attempted
            $fixedEmailInfo = session()->get('job_alert_fixed_email_info', null);
            session()->forget('job_alert_fixed_email_info');
            
            session()->put('job_created_console_data', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'email_count' => 0,
                'job_seekers' => [],
                'debug_info' => $fixedEmailInfo ? 'Fixed email attempted: ' . ($fixedEmailInfo['sent'] ? 'Sent ✅' : 'Failed ❌') : 'Event listener may not have run'
            ]);
            error_log('[JOB_CREATE] ✅ Job created successfully by admin!');
            error_log('[JOB_CREATE] ⚠️ No job seekers found to send emails.');
            if ($fixedEmailInfo) {
                error_log('[JOB_CREATE] Fixed email status: ' . ($fixedEmailInfo['sent'] ? 'Sent' : 'Failed - ' . ($fixedEmailInfo['error'] ?? 'Unknown error')));
            }
        }
        
        // Clear session data
        session()->forget('job_created_email_recipients');

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('jobs.index'))
            ->setNextUrl(route('jobs.edit', $job->id))
            ->setMessage($successMessage)
            ->withCreatedSuccessMessage();
    }

    public function edit(Job $job, Request $request)
    {
        $job->load(['skills', 'customFields']);

        event(new BeforeEditContentEvent($request, $job));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $job->name]));

        return JobForm::createFromModel($job)->renderForm();
    }

    public function update(Job $job, JobRequest $request, StoreTagService $storeTagService)
    {
        if (! $request->has('employer_colleagues')) {
            $request->merge(['employer_colleagues' => []]);
        }

        $moderationStatus = $job->moderation_status;

        $isApproved = ($job->moderation_status->getValue() == ModerationStatusEnum::PENDING) && ($request->input('moderation_status') == ModerationStatusEnum::APPROVED);

        $job->fill($request->except(['expire_date']));
        $job->moderation_status = $request->input('moderation_status');
        $job->never_expired = $request->input('never_expired');
        $job->save();

        if ($isApproved) {
            AdminApprovedJobEvent::dispatch($job);
        }

        $customFields = CustomFieldValue::formatCustomFields($request->input('custom_fields') ?? []);

        $job->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $job->customFields()->saveMany($customFields);

        $job->skills()->sync($request->input('skills', []));
        $job->jobTypes()->sync($request->input('jobTypes', []));
        $job->categories()->sync($request->input('categories', []));

        event(new UpdatedContentEvent(JOB_MODULE_SCREEN_NAME, $request, $job));

        if (
            $moderationStatus != ModerationStatusEnum::APPROVED
            && $request->input('moderation_status') == ModerationStatusEnum::APPROVED
        ) {
            event(new JobPublishedEvent($job));
        }

        $storeTagService->execute($request, $job);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('jobs.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Job $job)
    {
        return DeleteResourceAction::make($job);
    }

    public function analytics(int|string $id)
    {
        $job = Job::query()
            ->withCount([
                'savedJobs',
                'applicants',
            ])
            ->findOrFail($id);

        Assets::addScripts(['counterup', 'equal-height'])
            ->addStylesDirectly('vendor/core/core/dashboard/css/dashboard.css');

        $numberSaved = $job->saved_jobs_count;
        $applicants = $job->applicants_count;
        $viewsToday = $this->analyticsRepository->getTodayViews($job->id);
        $referrers = $this->analyticsRepository->getReferrers($job->id);
        $countries = $this->analyticsRepository->getCountriesViews($job->id);

        $this->pageTitle(trans('plugins/job-board::messages.analytics_for_job', ['name' => $job->name]));

        $data = compact('job', 'viewsToday', 'numberSaved', 'applicants', 'referrers', 'countries');

        return view('plugins/job-board::analytics', $data);
    }

    public function expireJobs(ExpireJobsRequest $request)
    {
        $ids = $request->input('ids');

        if (! $ids || ! is_array($ids)) {
            return $this
                ->httpResponse();
        }

        Job::query()
            ->whereIn('id', $ids)
            ->update([
                'never_expired' => false,
                'expire_date' => Carbon::now(),
            ]);

        return $this
            ->httpResponse();
    }
}
