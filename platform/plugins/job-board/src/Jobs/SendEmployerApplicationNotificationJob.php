<?php

namespace Botble\JobBoard\Jobs;

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

class SendEmployerApplicationNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(
        public JobApplication $application,
        public Job $job
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            $employerEmails = array_filter($this->job->employer_emails ?: []);

            if (empty($employerEmails)) {
                Log::warning('No employer emails found for job application notification', [
                    'job_id' => $this->job->id,
                    'application_id' => $this->application->id,
                ]);
                return;
            }

            // Get screening questions and answers
            $screeningAnswersHtml = $this->formatScreeningAnswers();

            // Get job seeker details
            $jobSeekerName = $this->application->full_name;
            $jobSeekerEmail = $this->application->email ?? 'N/A';
            $jobSeekerPhone = $this->application->phone ?? 'N/A';
            $message = strip_tags($this->application->message ?? '');
            $resumeUrl = $this->application->resume ? RvMedia::url($this->application->resume) : null;
            $coverLetterUrl = $this->application->cover_letter ? RvMedia::url($this->application->cover_letter) : null;

            // Build email content
            $emailContent = $this->buildEmailContent([
                'job_seeker_name' => $jobSeekerName,
                'position_applied' => $this->job->name,
                'job_seeker_email' => $jobSeekerEmail,
                'job_seeker_phone' => $jobSeekerPhone,
                'message' => $message,
                'resume_url' => $resumeUrl,
                'cover_letter_url' => $coverLetterUrl,
                'screening_answers_html' => $screeningAnswersHtml,
                'company_name' => $this->job->company->name ?? 'N/A',
                'application_url' => route('public.account.applicants.edit', $this->application->id),
                'job_url' => $this->job->url,
            ]);

            $emailSubject = 'New Job Application: ' . $jobSeekerName . ' - ' . $this->job->name;

            // Send to all employer emails
            foreach ($employerEmails as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

                Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $email, $resumeUrl) {
                    $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                        ->to($email)
                        ->subject($emailSubject)
                        ->html($emailContent);

                    // Attach resume if available
                    if ($resumeUrl && filter_var($resumeUrl, FILTER_VALIDATE_URL)) {
                        try {
                            $message->attach($resumeUrl);
                        } catch (\Exception $e) {
                            Log::warning('Failed to attach resume to email', [
                                'resume_url' => $resumeUrl,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }
                });
            }

            Log::info('Employer application notification email sent', [
                'application_id' => $this->application->id,
                'job_id' => $this->job->id,
                'employer_emails' => $employerEmails,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send employer application notification email', [
                'application_id' => $this->application->id,
                'job_id' => $this->job->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function formatScreeningAnswers(): string
    {
        $screeningAnswers = $this->application->screening_answers ?? [];
        
        if (empty($screeningAnswers)) {
            return '<p style="color: #666; font-style: italic;">No screening questions answered.</p>';
        }

        $questionsMap = $this->job->getAllScreeningQuestionsForApply()->keyBy('id');

        $html = '<div style="margin-top: 15px;">';
        $html .= '<h4 style="color: #1967d2; margin-bottom: 10px;">Screening Questions & Answers:</h4>';

        foreach ($screeningAnswers as $questionId => $answer) {
            $q = $questionsMap->get($questionId) ?? $questionsMap->get('sq_' . $questionId);
            $questionText = $q ? $q->question : "Question #{$questionId}";
            
            // Decode JSON answers (for checkboxes, etc.)
            $decodedAnswer = json_decode($answer, true);
            if (is_array($decodedAnswer)) {
                $answer = implode(', ', $decodedAnswer);
            }

            // Check if answer is a URL (file upload)
            $isUrl = filter_var($answer, FILTER_VALIDATE_URL);
            
            $html .= '<div style="margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-left: 3px solid #1967d2;">';
            $html .= '<p style="margin: 0 0 5px 0; font-weight: bold; color: #333;">' . htmlspecialchars($questionText) . '</p>';
            
            if ($isUrl) {
                $html .= '<p style="margin: 0; color: #1967d2;"><a href="' . htmlspecialchars($answer) . '" target="_blank">View File</a></p>';
            } else {
                $html .= '<p style="margin: 0; color: #666;">' . htmlspecialchars($answer) . '</p>';
            }
            
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
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
                    <h2>New Job Application Received</h2>
                    <p>Hello,</p>
                    <p>You have received a new job application for the position: <strong>" . htmlspecialchars($variables['position_applied']) . "</strong></p>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Applicant Details:</h3>
                        <div class='info-row'>
                            <span class='info-label'>Name:</span>
                            <span>" . htmlspecialchars($variables['job_seeker_name']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Email:</span>
                            <span><a href='mailto:" . htmlspecialchars($variables['job_seeker_email']) . "'>" . htmlspecialchars($variables['job_seeker_email']) . "</a></span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Phone:</span>
                            <span>" . htmlspecialchars($variables['job_seeker_phone']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Company:</span>
                            <span>" . htmlspecialchars($variables['company_name']) . "</span>
                        </div>
                    </div>
                    
                    " . (!empty($variables['message']) ? "<div class='info-box'><h4 style='color: #1967d2; margin-top: 0;'>Cover Letter:</h4><p>" . nl2br(htmlspecialchars($variables['message'])) . "</p></div>" : "") . "
                    
                    " . $variables['screening_answers_html'] . "
                    
                    " . ($variables['resume_url'] ? "<div class='info-box'><p><strong>Resume:</strong> <a href='" . htmlspecialchars($variables['resume_url']) . "' target='_blank'>Download Resume</a></p></div>" : "") . "
                    
                    " . ($variables['cover_letter_url'] ? "<div class='info-box'><p><strong>Cover Letter File:</strong> <a href='" . htmlspecialchars($variables['cover_letter_url']) . "' target='_blank'>Download Cover Letter</a></p></div>" : "") . "
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['application_url']) . "' class='button'>View Application Details</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['job_url']) . "' style='color: #1967d2; text-decoration: none;'>View Job Posting</a>
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center; margin-top: 30px;'>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
