<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Events\JobApplicationStatusUpdatedEvent;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\ApplicantForm;
use Botble\JobBoard\Http\Requests\EditJobApplicationRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Tables\Fronts\ApplicantTable;
use Botble\SeoHelper\Facades\SeoHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class ApplicantController extends BaseController
{
    public function index(ApplicantTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::messages.applicants'));

        return $table->render(JobBoardHelper::viewPath('dashboard.table.base'), [], [
            'layout' => 'plugins/job-board::themes.dashboard.layouts.master',
        ]);
    }

    public function edit(int|string $applicant)
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $jobApplication = JobApplication::query()
            ->select(['*'])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->with(['account', 'job.screeningQuestions'])
            ->where('id', $id)
            ->firstOrFail();

        $title = trans('plugins/job-board::messages.view_applicant', ['name' => $jobApplication->full_name]);

        $this->pageTitle($title);

        SeoHelper::setTitle($title);

        return ApplicantForm::createFromModel($jobApplication)->renderForm();
    }

    public function update(int|string $applicant, EditJobApplicationRequest $request): RedirectResponse|Response
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        try {
            $jobApplication = JobApplication::query()
                ->select(['*'])
                ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                    $query->where('account_id', $account->getKey());
                })
                ->with(['job'])
                ->where('id', $id)
                ->firstOrFail();

            $oldStatus = $jobApplication->status ?? JobApplicationStatusEnum::PENDING();

            $jobApplication->fill($request->only(['status']));
            $jobApplication->save();

            $newStatus = $jobApplication->status ?? JobApplicationStatusEnum::PENDING();
            if ($oldStatus->getValue() !== $newStatus->getValue()) {
                try {
                    JobApplicationStatusUpdatedEvent::dispatch(
                        $jobApplication,
                        $jobApplication->job,
                        $oldStatus,
                        $newStatus
                    );
                } catch (\Throwable $e) {
                    Log::warning('JobApplicationStatusUpdatedEvent failed: ' . $e->getMessage());
                    report($e);
                }
            }

            try {
                event(new UpdatedContentEvent(JOB_APPLICATION_MODULE_SCREEN_NAME, $request, $jobApplication));
            } catch (\Throwable $e) {
                Log::warning('UpdatedContentEvent failed: ' . $e->getMessage());
                report($e);
            }
        } catch (\Throwable $e) {
            Log::error('Applicant update failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'error' => true,
                    'message' => trans('core/base::notices.update_failed_message'),
                ], 422);
            }
            return redirect()
                ->to(route('public.account.applicants.edit', $id))
                ->with('error_msg', trans('core/base::notices.update_failed_message'))
                ->withInput();
        }

        $successMessage = trans('core/base::notices.update_success_message');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'error' => false,
                'message' => $successMessage,
            ]);
        }

        return redirect()
            ->to(route('public.account.applicants.edit', $id))
            ->with('success_msg', $successMessage);
    }

    public function destroy(int|string $applicant)
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $jobApplication = JobApplication::query()
            ->select(['*'])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->where('id', $id)
            ->firstOrFail();

        return DeleteResourceAction::make($jobApplication);
    }

    public function sendEmail(int|string $applicant, Request $request): Response
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $jobApplication = JobApplication::query()
            ->select(['*'])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->with(['job', 'account'])
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $emailSubject = $request->input('subject');
            $emailMessage = $request->input('message');
            $jobSeekerEmail = $jobApplication->email;

            if (!filter_var($jobSeekerEmail, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Invalid email address',
                ], 422);
            }

            Mail::send([], [], function ($message) use ($emailSubject, $emailMessage, $jobSeekerEmail) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($jobSeekerEmail)
                    ->subject($emailSubject)
                    ->html(nl2br(e($emailMessage)));
            });

            Log::info('[APPLICANT_EMAIL] Email sent to job seeker', [
                'application_id' => $jobApplication->id,
                'email' => $jobSeekerEmail,
                'subject' => $emailSubject,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Email sent successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('[APPLICANT_EMAIL] Failed to send email', [
                'application_id' => $jobApplication->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function sendWhatsApp(int|string $applicant, Request $request): Response
    {
        $id = $applicant instanceof JobApplication ? $applicant->getKey() : $applicant;
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $jobApplication = JobApplication::query()
            ->select(['*'])
            ->whereHas('job.company.accounts', function (Builder $query) use ($account): void {
                $query->where('account_id', $account->getKey());
            })
            ->with(['job', 'account'])
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'message' => 'required|string',
        ]);

        try {
            // Get job seeker phone number
            $jobSeekerPhone = $jobApplication->phone ?? $jobApplication->account->phone ?? null;
            
            if (empty($jobSeekerPhone)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Phone number not available',
                ], 422);
            }

            // Clean phone number
            $jobSeekerPhone = preg_replace('/[^0-9]/', '', $jobSeekerPhone);
            
            if (strlen($jobSeekerPhone) < 10) {
                return response()->json([
                    'error' => true,
                    'message' => 'Invalid phone number',
                ], 422);
            }

            // Extract 10-digit phone number (same logic as OTP)
            if (strlen($jobSeekerPhone) == 12 && substr($jobSeekerPhone, 0, 2) == '91') {
                $jobSeekerPhone = substr($jobSeekerPhone, 2);
            } elseif (strlen($jobSeekerPhone) > 10) {
                $jobSeekerPhone = substr($jobSeekerPhone, -10);
            }

            // Get WhatsApp API configuration
            $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate')));
            $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key', '4625770ffb62853af287cedec7f50b0')));
            $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));

            if (!$apiUrl || !$authKey) {
                return response()->json([
                    'error' => true,
                    'message' => 'WhatsApp API configuration missing',
                ], 500);
            }

            // Use a simple template or direct message format
            // For now, using a generic template - you can customize this
            $templateName = 'otp_signup_login'; // Using existing template for custom messages
            $message = $request->input('message');

            // Build payload (using OTP template structure for custom messages)
            $requestBody = [
                'mobileNumbers' => $jobSeekerPhone,
                'senderId' => $senderId,
                'component' => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'type' => 'template',
                    'template' => [
                        'name' => $templateName,
                        'language' => [
                            'code' => 'en'
                        ],
                        'components' => [
                            [
                                'type' => 'body',
                                'index' => 0,
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $message
                                    ]
                                ]
                            ],
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => 0,
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $message
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'qrImageUrl' => false,
                'qrLinkUrl' => false,
                'to' => $jobSeekerPhone
            ];

            // Make API call
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            if ($response->successful()) {
                $responseData = $response->json();
                
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('[APPLICANT_WHATSAPP] WhatsApp message sent successfully', [
                        'application_id' => $jobApplication->id,
                        'phone' => $jobSeekerPhone,
                        'response' => $responseData,
                    ]);

                    return response()->json([
                        'error' => false,
                        'message' => 'WhatsApp message sent successfully',
                    ]);
                } else {
                    Log::warning('[APPLICANT_WHATSAPP] WhatsApp API returned non-success response', [
                        'application_id' => $jobApplication->id,
                        'phone' => $jobSeekerPhone,
                        'response' => $responseData,
                    ]);

                    return response()->json([
                        'error' => true,
                        'message' => 'Failed to send WhatsApp message',
                    ], 500);
                }
            } else {
                Log::error('[APPLICANT_WHATSAPP] WhatsApp API request failed', [
                    'application_id' => $jobApplication->id,
                    'phone' => $jobSeekerPhone,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'error' => true,
                    'message' => 'Failed to send WhatsApp message',
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('[APPLICANT_WHATSAPP] Failed to send WhatsApp', [
                'application_id' => $jobApplication->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to send WhatsApp: ' . $e->getMessage(),
            ], 500);
        }
    }
}
