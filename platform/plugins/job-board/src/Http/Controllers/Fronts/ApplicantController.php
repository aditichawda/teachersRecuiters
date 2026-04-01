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
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use CURL_IPRESOLVE;
use CURL_IPRESOLVE_V4;
use CURLOPT_IPRESOLVE;
use CURLOPT_SSLVERSION;
use CURL_SSLVERSION_TLSv1_2;
use CURLOPT_SSL_VERIFYPEER;
use CURLOPT_SSL_VERIFYHOST;

class ApplicantController extends BaseController
{
    public function index(ApplicantTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::messages.applicants'));

        $account = auth('account')->user();

        return $table->render(JobBoardHelper::viewPath('dashboard.table.base'), [], [
            'layout' => JobBoardHelper::viewPath('dashboard.layouts.master'),
            'account' => $account,
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
            
            // Debug logging for status update
            Log::info('[STATUS_UPDATE_DEBUG] Status update initiated', [
                'application_id' => $jobApplication->id,
                'old_status' => $oldStatus->getValue(),
                'new_status' => $newStatus->getValue(),
                'old_status_type' => get_class($oldStatus),
                'new_status_type' => get_class($newStatus),
            ]);
            
            if ($oldStatus->getValue() !== $newStatus->getValue()) {
                Log::info('[STATUS_UPDATE_DEBUG] Status changed, dispatching event', [
                    'application_id' => $jobApplication->id,
                    'old_status' => $oldStatus->getValue(),
                    'new_status' => $newStatus->getValue(),
                ]);
                
                try {
                    JobApplicationStatusUpdatedEvent::dispatch(
                        $jobApplication,
                        $jobApplication->job,
                        $oldStatus,
                        $newStatus
                    );
                    
                    Log::info('[STATUS_UPDATE_DEBUG] Event dispatched successfully', [
                        'application_id' => $jobApplication->id,
                        'new_status' => $newStatus->getValue(),
                    ]);
                } catch (\Throwable $e) {
                    Log::error('[STATUS_UPDATE_DEBUG] Event dispatch failed', [
                        'application_id' => $jobApplication->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    Log::warning('JobApplicationStatusUpdatedEvent failed: ' . $e->getMessage());
                    report($e);
                }
            } else {
                Log::info('[STATUS_UPDATE_DEBUG] Status unchanged, skipping event', [
                    'application_id' => $jobApplication->id,
                    'status' => $newStatus->getValue(),
                ]);
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

    public function sendEmail(int|string $applicant, Request $request): JsonResponse
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

            // Send notification to job seeker about enquiry on their application
            if ($jobApplication->account_id) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $schoolName = $jobApplication->job->company->name ?? 'School';
                    $notificationService->sendApplicationEnquiryNotification(
                        $jobApplication->account,
                        $jobApplication->job->name,
                        $jobApplication->job->id,
                        $schoolName
                    );
                    Log::info('[NOTIFICATION] Application enquiry notification sent', [
                        'application_id' => $jobApplication->id,
                        'account_id' => $jobApplication->account_id,
                    ]);
                } catch (\Exception $e) {
                    Log::error('[NOTIFICATION] Failed to send application enquiry notification', [
                        'application_id' => $jobApplication->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

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

    public function sendWhatsApp(int|string $applicant, Request $request): JsonResponse
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
            'message' => 'required|string|max:300',
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
            $jobSeekerPhone = preg_replace('/[^0-9]/', '', (string) $jobSeekerPhone);
            
            if (strlen($jobSeekerPhone) < 10) {
                return response()->json([
                    'error' => true,
                    'message' => 'Invalid phone number',
                ], 422);
            }

            /**
             * Normalize phone for WhatsApp gateway (MsgClub).
             *
             * IMPORTANT: Your Postman example uses a 10-digit number (no country code).
             * Some gateways error (500) if you pass E.164 here. So default is "national10".
             *
             * Supported formats via settings:
             * - whatsapp_api_phone_format = national10 (default): 9109459959
             * - whatsapp_api_phone_format = e164: 919109459959 (digits only, no +)
             */
            $digits = $jobSeekerPhone;
            $phone10 = substr($digits, -10);
            $defaultCountryCode = (string) setting('whatsapp_default_country_code', '91');
            $phoneFormat = (string) setting('whatsapp_api_phone_format', 'national10');

            $jobSeekerPhoneForApi = $phone10;
            if ($phoneFormat === 'e164') {
                $jobSeekerPhoneForApi = $defaultCountryCode . $phone10;
            }

            // For manual WhatsApp deep link, wa.me expects country code
            $jobSeekerPhoneForWhatsAppLink = $defaultCountryCode . $phone10;

            // Get WhatsApp API configuration
            $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url')));
            $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key')));
            $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', config('services.msgclub.sender_id')));
            $templateName = setting('whatsapp_template_custom_message', config('services.msgclub.template_custom_message', 'school_custom_message_to_applicant'));
            $buttonParam = setting('whatsapp_template_custom_message_button_param', config('services.msgclub.template_custom_message_button_param', 'login/'));

            if (!$apiUrl || !$authKey || !$senderId) {
                return response()->json([
                    'error' => true,
                    'message' => 'WhatsApp API configuration missing',
                ], 500);
            }

            $message = (string) $request->input('message');
            $employerName = (string) ($account->name ?? 'Employer');
            $schoolName = (string) (data_get($jobApplication, 'job.company.name') ?? data_get($jobApplication, 'job.name') ?? 'School');

            // Always provide a manual WhatsApp deep link as a fallback (works even when API gateway is down)
            $manualWhatsAppUrl = 'https://wa.me/' . $jobSeekerPhoneForWhatsAppLink . '?text=' . rawurlencode($message);

            // Build payload (MsgClub WhatsApp template API)
            // Template: school_custom_message_to_applicant
            // Body params: [employer_name, school_name, custom_message]
            // Button param: url suffix (e.g. "login/")
            $requestBody = [
                'mobileNumbers' => $jobSeekerPhoneForApi,
                'senderId' => $senderId,
                'component' => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'type' => 'template',
                    'template' => [
                        'name' => 'school_custom_message_to_applicant',
                        'language' => [
                            'code' => 'en'
                        ],
                        'components' => [
                            [
                                'type' => 'body',
                                'parameters' => [
                                    ['type' => 'text', 'text' => $jobApplication->full_name ?? 'Candidate'],
                                    ['type' => 'text', 'text' => $jobApplication->job->company->name ?? 'School'],
                                    ['type' => 'text', 'text' => $jobApplication->job->name ?? 'Job'],
                                    ['type' => 'text', 'text' => $request->input('message')],
                                ]
                            ],
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => 0,
                                'parameters' => [
                                    ['type' => 'text', 'text' => 'login/']
                                ]
                            ]
                        ]
                    ]
                ],
                'qrImageUrl' => false,
                'qrLinkUrl' => false,
                'to' => $jobSeekerPhoneForApi
            ];

            // Make API call
            $endpoint = $apiUrl . '?AUTH_KEY=' . $authKey;
            $proxy = setting('whatsapp_api_proxy');
            $verifySetting = setting('whatsapp_api_verify_ssl');
            $verify = is_null($verifySetting) ? ! app()->environment('local') : (bool) $verifySetting;
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
                ->withOptions([
                    // Some environments resolve to IPv6 first and can hang; force IPv4 for reliability.
                    'curl' => [
                        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                        // Some older cURL builds hang on TLS negotiation; force TLS 1.2 for MsgClub.
                        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                        // Local XAMPP often has broken CA bundle config; allow HTTPS calls in local env.
                        CURLOPT_SSL_VERIFYPEER => $verify ? 1 : 0,
                        CURLOPT_SSL_VERIFYHOST => $verify ? 2 : 0,
                    ],
                    // If local CA store is problematic, allow toggling SSL verify via settings.
                    'verify' => $verify,
                    // If your server/network requires an outbound proxy, set it in settings (e.g. http://user:pass@host:port)
                    'proxy' => $proxy ?: null,
                ])
                ->connectTimeout((int) setting('whatsapp_api_connect_timeout', 30))
                ->timeout((int) setting('whatsapp_api_timeout', 30))
                // Disable "throw" so 4xx/5xx responses don't become exceptions (we handle via $response->successful()).
                ->retry(2, 250, throw: false)
                ->post($endpoint, $requestBody);

            if ($response->successful()) {
                $responseData = $response->json();
                
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('[APPLICANT_WHATSAPP] WhatsApp message sent successfully', [
                        'application_id' => $jobApplication->id,
                        'phone' => $jobSeekerPhoneForApi,
                        'phone_format' => $phoneFormat,
                        'response' => $responseData,
                    ]);

                    return response()->json([
                        'error' => false,
                        'message' => 'WhatsApp message sent successfully',
                        'manual_url' => $manualWhatsAppUrl,
                    ]);
                } else {
                    Log::warning('[APPLICANT_WHATSAPP] WhatsApp API returned non-success response', [
                        'application_id' => $jobApplication->id,
                        'phone' => $jobSeekerPhoneForApi,
                        'phone_format' => $phoneFormat,
                        'response' => $responseData,
                    ]);

                    return response()->json([
                        'error' => true,
                        'message' => 'WhatsApp gateway could not send the message. You can still send it manually.',
                        'manual_url' => $manualWhatsAppUrl,
                    ], 503);
                }
            } else {
                Log::error('[APPLICANT_WHATSAPP] WhatsApp API request failed', [
                    'application_id' => $jobApplication->id,
                    'phone' => $jobSeekerPhoneForApi,
                    'phone_format' => $phoneFormat,
                    'status' => $response->status(),
                    'api_host' => parse_url((string) $apiUrl, PHP_URL_HOST),
                    'response_headers' => $response->headers(),
                    // Body can be empty for 500s; keep it small if present
                    'body' => mb_substr((string) $response->body(), 0, 1000),
                    // Helpful request context (avoid logging full message/auth key)
                    'template' => $templateName,
                    'sender_id' => $senderId,
                    'message_len' => mb_strlen($message),
                ]);

                return response()->json([
                    'error' => true,
                    'message' => 'WhatsApp gateway returned an error (' . $response->status() . '). You can still send it manually.',
                    'manual_url' => $manualWhatsAppUrl,
                ], 503);
            }
        } catch (ConnectionException $e) {
            // Network/gateway issue (timeouts, DNS, connection refused, etc). Don't hard-fail the UI.
            Log::warning('[APPLICANT_WHATSAPP] WhatsApp gateway connection failed', [
                'application_id' => $jobApplication->id,
                'phone' => $jobSeekerPhoneForApi ?? null,
                'phone_format' => $phoneFormat ?? null,
                'error' => $e->getMessage(),
                // Don't log AUTH_KEY in URLs
                'api_host' => parse_url((string) $apiUrl, PHP_URL_HOST),
            ]);

            /**
             * Workaround for local XAMPP environments where PHP cURL/SSL stack is broken or times out,
             * but the system curl works (e.g. Postman works too). We'll try sending via the curl CLI.
             */
            try {
                if (function_exists('exec')) {
                    $curlBin = trim((string) exec('command -v curl'));

                    if ($curlBin) {
                        $endpointForCurl = $apiUrl . '?AUTH_KEY=' . $authKey;

                        $payloadJson = json_encode($requestBody, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                        if ($payloadJson !== false) {
                            $cmd = escapeshellcmd($curlBin)
                                . ' --silent --show-error'
                                . ' --connect-timeout 15 --max-time 30'
                                . ' -H ' . escapeshellarg('Content-Type: application/json')
                                . ' -H ' . escapeshellarg('Accept: application/json')
                                . ' -X POST'
                                . ' --data ' . escapeshellarg($payloadJson)
                                . ' ' . escapeshellarg($endpointForCurl);

                            $out = [];
                            $exitCode = 0;
                            exec($cmd, $out, $exitCode);
                            $raw = trim(implode("\n", $out));

                            $decoded = $raw !== '' ? json_decode($raw, true) : null;

                            if ($exitCode === 0 && is_array($decoded) && (($decoded['responseCode'] ?? null) === '3001')) {
                                Log::info('[APPLICANT_WHATSAPP] WhatsApp message sent successfully (curl CLI fallback)', [
                                    'application_id' => $jobApplication->id,
                                    'phone' => $jobSeekerPhoneForApi,
                                    'phone_format' => $phoneFormat,
                                    'response' => $decoded,
                                ]);

                                return response()->json([
                                    'error' => false,
                                    'message' => 'WhatsApp message sent successfully',
                                    'manual_url' => $manualWhatsAppUrl,
                                ]);
                            }

                            Log::warning('[APPLICANT_WHATSAPP] curl CLI fallback failed', [
                                'application_id' => $jobApplication->id,
                                'phone' => $jobSeekerPhoneForApi,
                                'phone_format' => $phoneFormat,
                                'exit_code' => $exitCode,
                                'raw' => mb_substr((string) $raw, 0, 500),
                            ]);
                        }
                    }
                }
            } catch (\Throwable $t) {
                Log::warning('[APPLICANT_WHATSAPP] curl CLI fallback crashed', [
                    'application_id' => $jobApplication->id,
                    'error' => $t->getMessage(),
                ]);
            }

            $message = (string) $request->input('message');
            $manualWhatsAppUrl = !empty($jobSeekerPhoneForWhatsAppLink)
                ? ('https://wa.me/' . $jobSeekerPhoneForWhatsAppLink . '?text=' . rawurlencode($message))
                : null;

            return response()->json([
                'error' => true,
                'message' => 'WhatsApp gateway is unreachable right now. Please try again, or send manually via WhatsApp.',
                'manual_url' => $manualWhatsAppUrl,
                'manual' => true,
            ], 503);
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