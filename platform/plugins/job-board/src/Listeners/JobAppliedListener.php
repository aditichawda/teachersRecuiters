<?php

namespace Botble\JobBoard\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\JobBoard\Events\JobAppliedEvent;
use Botble\JobBoard\Jobs\SendEmployerApplicationNotificationJob;
use Botble\JobBoard\Jobs\SendJobSeekerApplicationConfirmationJob;
use Botble\Media\Facades\RvMedia;
use Illuminate\Support\Facades\Log;

class JobAppliedListener
{
    public function handle(JobAppliedEvent $event)
    {
        $job = $event->job;
        $jobApplication = $event->jobApplication;

        try {
            // Check queue connection - if not 'sync', send emails immediately
            // This ensures emails are sent even if queue worker is not running
            $queueConnection = config('queue.default', 'database');
            
            if ($queueConnection === 'sync') {
                // Queue is sync, use regular dispatch (will run immediately)
                SendEmployerApplicationNotificationJob::dispatch($jobApplication, $job);
                SendJobSeekerApplicationConfirmationJob::dispatch($jobApplication, $job);
                
                Log::info('Job application email jobs dispatched (sync queue)', [
                    'application_id' => $jobApplication->id,
                    'job_id' => $job->id,
                ]);
            } else {
                // Queue is not sync, run jobs immediately to ensure emails are sent
                // This ensures emails are sent even without a queue worker running
                // Directly instantiate and run the jobs synchronously
                try {
                    (new SendEmployerApplicationNotificationJob($jobApplication, $job))->handle();
                    (new SendJobSeekerApplicationConfirmationJob($jobApplication, $job))->handle();
                    
                    Log::info('Job application email jobs executed synchronously (immediate send)', [
                        'application_id' => $jobApplication->id,
                        'job_id' => $job->id,
                        'queue_connection' => $queueConnection,
                        'note' => 'Emails sent immediately without queue worker',
                    ]);
                } catch (\Exception $syncException) {
                    Log::error('Failed to execute email jobs synchronously', [
                        'application_id' => $jobApplication->id,
                        'job_id' => $job->id,
                        'error' => $syncException->getMessage(),
                    ]);
                    throw $syncException; // Re-throw to trigger fallback
                }
            }

        } catch (\Exception $e) {
            Log::error('Failed to dispatch job application email jobs', [
                'application_id' => $jobApplication->id,
                'job_id' => $job->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Fallback to old email handler system if queue fails
            try {
                $this->sendLegacyEmails($job, $jobApplication);
            } catch (\Exception $legacyException) {
                Log::error('Legacy email sending also failed', [
                    'application_id' => $jobApplication->id,
                    'job_id' => $job->id,
                    'error' => $legacyException->getMessage(),
                ]);
            }
        }
    }

    /**
     * Legacy email sending method (fallback)
     */
    protected function sendLegacyEmails($job, $jobApplication): void
    {
        $employerEmails = array_filter($job->employer_emails ?: []);

        $emailHandler = EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'job_application_name' => $jobApplication->full_name,
                'job_application_position' => $jobApplication->job->name ?? null,
                'job_application_email' => $jobApplication->email ?? null,
                'job_application_phone' => $jobApplication->phone ?? null,
                'job_application_summary' => $jobApplication->message ? strip_tags(
                    $jobApplication->message
                ) : null,
                'job_application_resume' => $jobApplication->resume ? RvMedia::url(
                    $jobApplication->resume
                ) : null,
                'job_application_cover_letter' => $jobApplication->cover_letter ? RvMedia::url(
                    $jobApplication->cover_letter
                ) : null,
                'job_application' => $jobApplication,
                'job_name' => $job->name,
                'company_name' => $job->company->name ?? null,
            ]);

        $data = [
            'attachments' => $jobApplication->resume ? RvMedia::getRealPath($jobApplication->resume) : '',
        ];

        if (count($employerEmails)) {
            $emailHandler->sendUsingTemplate('employer-new-job-application', $employerEmails, $data);
        }

        $emailHandler->sendUsingTemplate('admin-new-job-application', null, $data);
        $emailHandler->sendUsingTemplate('job-seeker-applied-job', $jobApplication->email);
    }
}
