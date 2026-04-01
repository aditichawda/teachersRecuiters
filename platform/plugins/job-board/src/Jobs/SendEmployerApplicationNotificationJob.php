<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\Media\Facades\RvMedia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Notify employer(s) when a job seeker applies.
 *
 * NOTE: This file was previously corrupted (duplicate blocks / broken braces) which caused a PHP
 * parse error and broke the apply flow. Keep this implementation small and robust.
 */
class SendEmployerApplicationNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(
        public JobApplication $application,
        public Job $jobModel
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        $job = $this->jobModel->fresh(['author', 'company']) ?? $this->jobModel;
        $application = $this->application->fresh() ?? $this->application;

        $emails = $this->getEmployerEmails($job);
        if (! $emails) {
            Log::warning('[EMAIL_NOTIFICATION] No employer emails found', [
                'job_id' => $job->id ?? null,
                'application_id' => $application->id ?? null,
            ]);

            return;
        }

        $jobSeekerName = (string) ($application->full_name ?? '');
        $jobSeekerName = trim($jobSeekerName);
        if ($jobSeekerName === '') {
            $jobSeekerName = trim((string) ($application->first_name ?? '') . ' ' . (string) ($application->last_name ?? ''));
        }
        if ($jobSeekerName === '') {
            $jobSeekerName = (string) ($application->email ?? 'A candidate');
        }

        $subject = $jobSeekerName . ' has applied for the job you posted: ' . (string) ($job->name ?? '');

        $emailContent = $this->buildEmailContent([
                'job_seeker_name' => $jobSeekerName,
            'position_applied' => (string) ($job->name ?? ''),
            'job_seeker_email' => (string) ($application->email ?? 'N/A'),
            'job_seeker_phone' => (string) ($application->phone ?? 'N/A'),
            'message' => (string) strip_tags((string) ($application->message ?? '')),
            'resume_url' => $application->resume ? RvMedia::url($application->resume) : null,
            'cover_letter_url' => $application->cover_letter ? RvMedia::url($application->cover_letter) : null,
            'screening_answers_html' => $this->formatScreeningAnswers($job, $application),
            'company_name' => (string) ($job->company?->name ?? 'N/A'),
            'application_url' => route('public.account.applicants.edit', ['applicant' => $application->id]),
            'job_url' => (string) ($job->url ?? ''),
        ]);

        foreach ($emails as $email) {
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

            try {
                Mail::send([], [], function ($message) use ($email, $subject, $emailContent) {
                        $fromAddress = config('mail.from.address', 'noreply@example.com');
                        $fromName = config('mail.from.name', 'TeachersRecruiter');
                        
                        $message->from($fromAddress, $fromName)
                            ->to($email)
                        ->subject($subject)
                            ->html($emailContent);
                });
            } catch (\Throwable $e) {
                Log::warning('[EMAIL_NOTIFICATION] Failed to send employer email', [
                        'email' => $email,
                    'job_id' => $job->id ?? null,
                    'application_id' => $application->id ?? null,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
    }

    /**
     * @return array<int, string>
     */
    protected function getEmployerEmails(Job $job): array
    {
        $emails = [];

        $author = $job->author instanceof Account ? $job->author : null;
        if ($author && is_string($author->email) && trim($author->email) !== '') {
            $emails[] = trim($author->email);
        }

        $hasAdditionalEmailEntitlement = ! JobBoardHelper::isEnabledCreditsSystem()
            || ($author && CreditConsumption::hasEntitlement($author, CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL));

        if ($hasAdditionalEmailEntitlement && is_array($job->apply_internal_emails ?? null)) {
            foreach ($job->apply_internal_emails as $email) {
                if (is_string($email) && trim($email) !== '') {
                    $emails[] = trim($email);
                }
            }
        }

        if (is_array($job->employer_colleagues ?? null)) {
            foreach ($job->employer_colleagues as $email) {
                if (is_string($email) && trim($email) !== '') {
                    $emails[] = trim($email);
                }
            }
        }

        return array_values(array_unique(array_filter($emails)));
    }

    protected function formatScreeningAnswers(Job $job, JobApplication $application): string
    {
        $answers = $application->screening_answers ?? [];
        if (! is_array($answers) || ! $answers) {
            return '<p style="color: #666; font-style: italic; padding: 10px;">No screening questions were answered by the candidate.</p>';
        }

        try {
            $questions = $job->getAllScreeningQuestionsForApply()->keyBy('id');
        } catch (\Throwable) {
            $questions = collect();
        }

        $html = '<div style="margin-top: 15px;">';

        foreach ($answers as $questionId => $answer) {
            if ($answer === null || $answer === '') {
                continue;
            }

            $q = $questions->get($questionId);
            $questionText = $q?->question ?: ('Question #' . $questionId);

            $formatted = $this->formatAnswer($answer);
            $isUrl = filter_var($formatted, FILTER_VALIDATE_URL);

            $html .= '<div style="margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-left: 4px solid #1967d2; border-radius: 4px;">';
            $html .= '<p style="margin: 0 0 6px 0; font-weight: 600; color: #1967d2; font-size: 14px;">' . htmlspecialchars($questionText) . '</p>';
            if ($isUrl) {
                $html .= '<p style="margin: 0;"><a href="' . htmlspecialchars($formatted) . '" target="_blank" style="color: #1967d2; text-decoration: underline;">View Uploaded File</a></p>';
            } else {
                $html .= '<p style="margin: 0; color: #333; line-height: 1.6;">' . nl2br(htmlspecialchars($formatted)) . '</p>';
            }
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    protected function formatAnswer(mixed $answer): string
    {
        if ($answer === null || $answer === '') {
            return '—';
        }

        if (is_string($answer) && str_starts_with(trim($answer), '[')) {
            $decoded = json_decode($answer, true);
            if (is_array($decoded)) {
                return implode(', ', array_map('trim', $decoded));
            }
        }

        if (is_array($answer)) {
            return implode(', ', array_map('trim', $answer));
        }

        return (string) $answer;
    }

    protected function buildEmailContent(array $variables): string
    {
        return "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='utf-8'>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    h2 { color: #1967d2; }
                    .info-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .info-row { margin: 8px 0; }
                    .info-label { font-weight: bold; color: #333; display: inline-block; min-width: 120px; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2 style='color: #1967d2; margin-bottom: 20px;'>New Job Application</h2>
                    <p style='font-size: 16px; line-height: 1.6; margin-bottom: 20px;'>
                        <strong>" . htmlspecialchars((string) ($variables['job_seeker_name'] ?? '')) . "</strong>
                        has applied for the job you posted:
                        <strong>" . htmlspecialchars((string) ($variables['position_applied'] ?? '')) . "</strong>
                    </p>
                    
                    <div style='background: #e8f4f8; padding: 15px; border-radius: 8px; border-left: 4px solid #1967d2; margin: 20px 0;'>
                        <h3 style='color: #1967d2; margin-top: 0; margin-bottom: 15px; font-size: 18px;'>Screening Answers</h3>
                        " . ($variables['screening_answers_html'] ?? '') . "
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Applicant Details:</h3>
                        <div class='info-row'><span class='info-label'>Name:</span> <span>" . htmlspecialchars((string) ($variables['job_seeker_name'] ?? '')) . "</span></div>
                        <div class='info-row'><span class='info-label'>Email:</span> <span>" . htmlspecialchars((string) ($variables['job_seeker_email'] ?? '')) . "</span></div>
                        <div class='info-row'><span class='info-label'>Phone:</span> <span>" . htmlspecialchars((string) ($variables['job_seeker_phone'] ?? '')) . "</span></div>
                        <div class='info-row'><span class='info-label'>Company:</span> <span>" . htmlspecialchars((string) ($variables['company_name'] ?? '')) . "</span></div>
                    </div>
                    
                    " . (! empty($variables['message']) ? "<div class='info-box'><h4 style='color: #1967d2; margin-top: 0;'>Cover Letter:</h4><p>" . nl2br(htmlspecialchars((string) $variables['message'])) . "</p></div>" : "") . "
                    
                    " . (! empty($variables['resume_url']) ? "<div class='info-box'><p><strong>Resume:</strong> <a href='" . htmlspecialchars((string) $variables['resume_url']) . "' target='_blank'>Download</a></p></div>" : "") . "
                    " . (! empty($variables['cover_letter_url']) ? "<div class='info-box'><p><strong>Cover Letter File:</strong> <a href='" . htmlspecialchars((string) $variables['cover_letter_url']) . "' target='_blank'>Download</a></p></div>" : "") . "
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars((string) ($variables['application_url'] ?? '#')) . "' class='button'>View Application Details</a>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}

