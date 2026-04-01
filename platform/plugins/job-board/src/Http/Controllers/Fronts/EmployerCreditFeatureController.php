<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\DedicatedRecruiterRequest;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobInvite;
use Botble\JobBoard\Models\JobPostingAssistanceRequest;
use Botble\JobBoard\Models\SocialPromotionRequest;
use Botble\JobBoard\Models\WalkinDriveAdRequest;
use Botble\JobBoard\Supports\PackageContext;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class EmployerCreditFeatureController extends BaseController
{
    /**
     * List staff (sub-accounts) created by this employer via Multiple Login.
     */
    public function indexTeamMembers()
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            abort(404);
        }

        $staff = $account->staffAccounts()
            ->orderBy('created_at', 'desc')
            ->get(['id', 'first_name', 'last_name', 'email', 'sub_account_role', 'created_at']);

        return \Botble\JobBoard\Facades\JobBoardHelper::view('dashboard.team-members', [
            'staff' => $staff,
            'account' => $account,
        ]);
    }

    /**
     * Multiple Login: Deduct 250 credits first (called before showing form). Frontend calls this then shows form.
     */
    public function deductMultipleLogin(Request $request)
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can add sub-accounts.'));
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_MULTIPLE_LOGIN, 250);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for each additional login.', ['credits' => $credits]));
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_MULTIPLE_LOGIN,
            $credits,
            'Multiple Login – Sub-account (credits deducted first)'
        );

        return $this->httpResponse()->setMessage(__('Credits deducted. Please fill the form to add sub-account.'));
    }

    /**
     * Multiple Login: Add sub-account (email, name, role, password). No deduction if credits_already_deducted=1.
     */
    public function storeSubAccount(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:jb_accounts,email'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:60'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can add sub-accounts.'));
        }

        // Guard: feature requires these columns (some servers may not have migrated yet)
        if (! Schema::hasColumn('jb_accounts', 'parent_account_id') || ! Schema::hasColumn('jb_accounts', 'sub_account_role')) {
            return $this->httpResponse()
                ->setError()
                ->setMessage(__('Server database is missing required columns for Multiple Login. Please run migrations on live server (php artisan migrate).'));
        }

        $creditsAlreadyDeducted = $request->boolean('credits_already_deducted');

        if (! $creditsAlreadyDeducted) {
            $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_MULTIPLE_LOGIN, 250);
            if ($account->credits < $credits) {
                return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for each additional login.', ['credits' => $credits]));
            }

            CreditConsumption::deductForFeature(
                $account,
                CreditConsumption::FEATURE_MULTIPLE_LOGIN,
                $credits,
                'Multiple Login – Sub-account: ' . $request->input('email')
            );
        }

        try {
            $companyId = $account->companies()->first()?->id;

            DB::transaction(function () use ($request, $account, $companyId): void {
                $sub = Account::query()->create([
                    'first_name' => $request->input('name'),
                    'last_name' => '',
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'type' => AccountTypeEnum::EMPLOYER,
                    'parent_account_id' => $account->id,
                    'sub_account_role' => $request->input('role'),
                    'credits' => 0,
                ]);

                if ($companyId) {
                    $sub->companies()->attach([$companyId]);
                }
            });
        } catch (QueryException $e) {
            // Most common live issue: migrations not executed (missing columns/tables)
            $ref = 'ML-' . now()->format('YmdHis') . '-' . substr(md5((string) microtime(true)), 0, 8);
            \Log::error('Multiple Login: failed to create sub-account', [
                'ref' => $ref,
                'error' => $e->getMessage(),
            ]);

            $msg = __('Server Error (:ref)', ['ref' => $ref]);
            $lower = strtolower((string) $e->getMessage());
            if (str_contains($lower, 'unknown column') || str_contains($lower, 'doesn\'t exist') || str_contains($lower, 'does not exist')) {
                $msg = __('Database schema is not updated on server. Please run: php artisan migrate');
            } elseif (str_contains($lower, 'duplicate') || str_contains($lower, 'unique')) {
                $msg = __('This email is already registered. Please use another email.');
            } elseif (str_contains($lower, 'cannot be null') || str_contains($lower, 'not null')) {
                $msg = __('Some required fields are missing on server. Please contact admin. (:ref)', ['ref' => $ref]);
            }

            return $this->httpResponse()
                ->setError()
                ->setAdditional(['ref' => $ref])
                ->setMessage($msg);
        } catch (\Throwable $e) {
            $ref = 'ML-' . now()->format('YmdHis') . '-' . substr(md5((string) microtime(true)), 0, 8);
            \Log::error('Multiple Login: unexpected error', [
                'ref' => $ref,
                'error' => $e->getMessage(),
            ]);

            return $this->httpResponse()
                ->setError()
                ->setAdditional(['ref' => $ref])
                ->setMessage(__('Server Error (:ref)', ['ref' => $ref]));
        }

        $msg = $creditsAlreadyDeducted
            ? __('Sub-account created.')
            : __('Sub-account created. :credits credits deducted.', ['credits' => CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_MULTIPLE_LOGIN, 250)]);

        return $this->httpResponse()->setMessage($msg);
    }

    /**
     * Additional Employer Profile: Deduct credits first (popup confirm). Then frontend redirects to companies/create with credits_already_deducted=1.
     */
    public function deductAdditionalEmployerProfile(Request $request)
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can add institutions.'));
        }

        if ($account->companies()->count() < 1) {
            return $this->httpResponse()->setError()->setMessage(__('First institution is free. Use the Create button to add.'));
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE, 500);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits to add another institution.', ['credits' => $credits]));
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE,
            $credits,
            'Additional Employer Profile (per new profile)',
            ['company_create' => true]
        );

        return $this->httpResponse()->setMessage(__(':credits credits deducted. You can now add the institution.', ['credits' => $credits]));
    }

    /**
     * Dedicated Recruiter: Step 1 – Only deduct credits. Frontend then opens form; form submit calls storeDedicatedRecruiterRequest with credits_already_deducted=1.
     */
    public function deductDedicatedRecruiter(Request $request)
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_DEDICATED_RECRUITER, 2500);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Dedicated Recruiter.', ['credits' => $credits]));
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_DEDICATED_RECRUITER,
            $credits,
            'Dedicated Recruiter – 1 month (form will follow)'
        );

        return $this->httpResponse()->setMessage(__(':credits credits deducted. Please fill the form.', ['credits' => $credits]));
    }

    /**
     * Dedicated Recruiter: Step 2 – Create request (form). If credits_already_deducted=1, do not deduct again. Sets valid_till = now + duration_months.
     */
    public function storeDedicatedRecruiterRequest(Request $request)
    {
        $request->validate([
            'credits_already_deducted' => ['nullable', 'in:0,1'],
            'duration_months' => ['required', 'integer', 'min:1', 'max:24'],
            'company_id' => ['nullable', 'integer', Rule::exists('jb_companies', 'id')],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $creditsAlreadyDeducted = (bool) $request->input('credits_already_deducted');
        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_DEDICATED_RECRUITER, 2500);

        if (! $creditsAlreadyDeducted) {
            if ($account->credits < $credits) {
                return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Dedicated Recruiter.', ['credits' => $credits]));
            }
            CreditConsumption::deductForFeature(
                $account,
                CreditConsumption::FEATURE_DEDICATED_RECRUITER,
                $credits,
                'Dedicated Recruiter – ' . $request->input('duration_months', 1) . ' month(s)'
            );
        }

        $companyId = $request->input('company_id');
        if ($companyId && ! $account->companies()->where('jb_companies.id', $companyId)->exists()) {
            return $this->httpResponse()->setError()->setMessage(__('Invalid institution.'));
        }

        $durationMonths = (int) $request->input('duration_months', 1);
        $startDate = $request->input('start_date') ? \Carbon\Carbon::parse($request->input('start_date')) : now();
        $validTill = $startDate->copy()->addMonths($durationMonths)->toDateString();

        DedicatedRecruiterRequest::query()->create([
            'account_id' => $account->id,
            'duration_months' => $durationMonths,
            'company_id' => $companyId,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'valid_till' => $validTill,
            'note' => $request->input('note'),
            'status' => DedicatedRecruiterRequest::STATUS_PENDING,
            'requested_at' => now(),
        ]);

        return $this->httpResponse()->setMessage(__('Request submitted. Valid for :n month(s) till :date.', ['n' => $durationMonths, 'date' => $validTill]));
    }

    /**
     * Social Promotion: Step 1 – Only deduct credits. Frontend then opens form; form submit calls storeSocialPromotionRequest with credits_already_deducted=1.
     */
    public function deductSocialPromotion(Request $request)
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_SOCIAL_PROMOTION, 3000);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Social Promotion.', ['credits' => $credits]));
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_SOCIAL_PROMOTION,
            $credits,
            'Social Promotion – (form will follow)'
        );

        return $this->httpResponse()->setMessage(__(':credits credits deducted. Please fill the form.', ['credits' => $credits]));
    }

    /**
     * Social Promotion: Step 2 – Create request (form). If credits_already_deducted=1, do not deduct again.
     */
    public function storeSocialPromotionRequest(Request $request)
    {
        $request->validate([
            'credits_already_deducted' => ['nullable', 'in:0,1'],
            'company_id' => ['nullable', 'integer', Rule::exists('jb_companies', 'id')],
            'title' => ['nullable', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:60'],
            'message' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
        ]);

        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $creditsAlreadyDeducted = (bool) $request->input('credits_already_deducted');
        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_SOCIAL_PROMOTION, 3000);

        if (! $creditsAlreadyDeducted) {
            if ($account->credits < $credits) {
                return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Social Promotion.', ['credits' => $credits]));
            }
        }

        $companyId = $request->input('company_id');
        if ($companyId && ! $account->companies()->where('jb_companies.id', $companyId)->exists()) {
            return $this->httpResponse()->setError()->setMessage(__('Invalid institution.'));
        }

        $imageUrl = null;
        /** @var UploadedFile|null $imageFile */
        $imageFile = $request->file('image');
        if ($imageFile) {
            try {
                @set_time_limit(120);
                $result = RvMedia::uploadFromBlob($imageFile, null, 0, 'social-promotion');
                if (! empty($result['error'])) {
                    $imageUrl = null;
                } else {
                    $data = $result['data'] ?? null;
                    $imageUrl = is_object($data) ? ($data->url ?? null) : ($data['url'] ?? null);
                }
            } catch (\Throwable $e) {
                $imageUrl = null;
            }
        }

        if (! $creditsAlreadyDeducted) {
            CreditConsumption::deductForFeature(
                $account,
                CreditConsumption::FEATURE_SOCIAL_PROMOTION,
                $credits,
                'Social Promotion – ' . ($request->input('platform') ?: 'social')
            );
        }

        SocialPromotionRequest::query()->create([
            'account_id' => $account->id,
            'company_id' => $companyId,
            'title' => $request->input('title'),
            'tag' => $request->input('tag'),
            'platform' => $request->input('platform'),
            'message' => $request->input('message'),
            'image' => $imageUrl,
            'status' => SocialPromotionRequest::STATUS_PENDING,
            'requested_at' => now(),
        ]);

        return $this->httpResponse()->setMessage(__('Request submitted. Credits have been deducted from your wallet.'));
    }

    /**
     * Job Posting Assistance: Deduct 250 credits immediately, then create request. Admin will approve and can create job for institution.
     */
    public function storeJobPostingAssistanceRequest(Request $request)
    {
        $request->validate([
            'company_id' => ['nullable', 'integer', Rule::exists('jb_companies', 'id')],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $packageContext = PackageContext::forAccount($account);
        $includedInPackage = $packageContext->hasJobPostingAssistance();

        if (! $includedInPackage) {
            $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE, 250);
            if ($account->credits < $credits) {
                return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Job Posting Assistance.', ['credits' => $credits]));
            }
        }

        $companyId = $request->input('company_id');
        if ($companyId && ! $account->companies()->where('jb_companies.id', $companyId)->exists()) {
            return $this->httpResponse()->setError()->setMessage(__('Invalid institution.'));
        }

        if (! $includedInPackage) {
            $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE, 250);
            CreditConsumption::deductForFeature(
                $account,
                CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE,
                $credits,
                'Job Posting Assistance – Request'
            );
        }

        JobPostingAssistanceRequest::query()->create([
            'account_id' => $account->id,
            'company_id' => $companyId,
            'message' => $request->input('message'),
            'status' => JobPostingAssistanceRequest::STATUS_PENDING,
            'requested_at' => now(),
        ]);

        $message = $includedInPackage
            ? __('Request submitted. Included in your package. Admin will approve and can create job for your institution.')
            : __('Request submitted. Credits deducted. Admin will approve and can create job for your institution.');

        return $this->httpResponse()->setMessage($message);
    }

    /**
     * Invite Candidate to Apply for Job. Deduct 25 credits per invite.
     */
    public function inviteCandidate(Request $request)
    {
        $request->validate([
            'job_id' => ['required', 'integer', Rule::exists('jb_jobs', 'id')],
            'candidate_id' => ['nullable', 'integer', Rule::exists('jb_accounts', 'id')],
            'email' => ['nullable', 'email'],
        ], [], ['job_id' => __('Job'), 'candidate_id' => __('Candidate'), 'email' => __('Email')]);

        if (! $request->filled('candidate_id') && ! $request->filled('email')) {
            return $this->httpResponse()->setError()->setMessage(__('Provide candidate id or email.'));
        }

        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can invite.'));
        }

        $job = Job::query()->with('company')->find($request->input('job_id'));
        if (! $job || ! $job->company_id) {
            return $this->httpResponse()->setError()->setMessage(__('Job not found.'));
        }
        $employerCompanyIds = $account->companies()->pluck('jb_companies.id')->all();
        if (! in_array($job->company_id, $employerCompanyIds)) {
            return $this->httpResponse()->setError()->setMessage(__('Access denied to this job.'));
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_INVITE_CANDIDATE, 25);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :n for each invite.', ['n' => $credits]));
        }

        $candidateId = $request->input('candidate_id');
        $email = $request->input('email');
        if ($candidateId) {
            $candidate = Account::query()
                ->where('id', $candidateId)
                ->where('type', AccountTypeEnum::JOB_SEEKER)
                ->first();
            if (! $candidate) {
                return $this->httpResponse()->setError()->setMessage(__('Candidate not found.'));
            }
            $email = $candidate->email;
        }
        if (! $email) {
            return $this->httpResponse()->setError()->setMessage(__('Candidate email is required.'));
        }

        $existingInvite = JobInvite::query()
            ->where('job_id', $job->id)
            ->where('account_id', $account->id)
            ->where(function ($q) use ($candidateId, $email): void {
                if ($candidateId) {
                    $q->where('candidate_id', $candidateId);
                } else {
                    $q->where('email', $email);
                }
            })
            ->exists();
        if ($existingInvite) {
            return $this->httpResponse()->setError()->setMessage(__('This candidate has already been invited to this job.'));
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_INVITE_CANDIDATE,
            $credits,
            'Invite Candidate – Job #' . $job->id
        );

        JobInvite::query()->create([
            'job_id' => $job->id,
            'account_id' => $account->id,
            'candidate_id' => $candidateId,
            'email' => $email,
            'status' => 'sent',
            'invited_at' => now(),
        ]);

        try {
            $jobTitle = $job->name;
            $companyName = $job->company ? $job->company->name : $account->name;
            Mail::send([], [], function ($message) use ($email, $jobTitle, $companyName, $job) {
                $message->to($email)
                    ->subject(__('You are invited to apply – :job', ['job' => $jobTitle]))
                    ->html(__('Hello,') . '<br><br>' . __('You have been invited by :company to apply for the job: :job.', ['company' => $companyName, 'job' => $jobTitle]) . '<br><br>' . __('Apply here:') . ' ' . route('public.job.apply', $job->id));
            });
        } catch (\Throwable $e) {
            // Invite still recorded and credits deducted
        }

        return $this->httpResponse()->setMessage(__('Invite sent. :n credits deducted.', ['n' => $credits]));
    }

    /**
     * Walk-in Drive Ad: Step 1 – Only deduct credits. Frontend then opens form; form submit calls storeWalkinDriveAdRequest with credits_already_deducted=1.
     */
    public function deductWalkinDriveAd(Request $request)
    {
        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_WALKIN_DRIVE_AD, 2500);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Walk-in Drive Ad Space.', ['credits' => $credits]));
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_WALKIN_DRIVE_AD,
            $credits,
            'Walk-in Drive Ad Space – (form will follow)'
        );

        return $this->httpResponse()->setMessage(__(':credits credits deducted. Please fill the form.', ['credits' => $credits]));
    }

    /**
     * Walk-in Drive Ad Space: Step 2 – Create request (form). If credits_already_deducted=1, do not deduct again.
     */
    public function storeWalkinDriveAdRequest(Request $request)
    {
        $request->validate([
            'credits_already_deducted' => ['nullable', 'in:0,1'],
            'company_id' => ['nullable', 'integer', Rule::exists('jb_companies', 'id')],
            'placement' => ['required', 'string', Rule::in(['home', 'job_listing', 'both'])],
            'message' => ['nullable', 'string', 'max:2000'],
            'banner_image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
        ]);

        $account = auth('account')->user();
        if (! $account || ! $account->isEmployer()) {
            return $this->httpResponse()->setError()->setMessage(__('Only employers can request.'));
        }

        $creditsAlreadyDeducted = (bool) $request->input('credits_already_deducted');
        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_WALKIN_DRIVE_AD, 2500);

        if (! $creditsAlreadyDeducted) {
            if ($account->credits < $credits) {
                return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Walk-in Drive Ad Space.', ['credits' => $credits]));
            }
        }

        $companyId = $request->input('company_id');
        if ($companyId && ! $account->companies()->where('jb_companies.id', $companyId)->exists()) {
            return $this->httpResponse()->setError()->setMessage(__('Invalid institution.'));
        }

        $imageUrl = null;
        /** @var UploadedFile|null $imageFile */
        $imageFile = $request->file('banner_image');
        if ($imageFile) {
            try {
                @set_time_limit(120);
                $result = RvMedia::uploadFromBlob($imageFile, null, 0, 'walkin-drive-ad');
                if (! empty($result['error'])) {
                    return $this->httpResponse()->setError()->setMessage(__('Failed to upload banner image.'));
                }
                $data = $result['data'] ?? null;
                $imageUrl = is_object($data) ? ($data->url ?? null) : ($data['url'] ?? null);
            } catch (\Throwable $e) {
                return $this->httpResponse()->setError()->setMessage(__('Failed to upload banner image.'));
            }
        }

        if (! $imageUrl) {
            return $this->httpResponse()->setError()->setMessage(__('Banner image is required.'));
        }

        if (! $creditsAlreadyDeducted) {
            CreditConsumption::deductForFeature(
                $account,
                CreditConsumption::FEATURE_WALKIN_DRIVE_AD,
                $credits,
                'Walk-in Drive Ad Space – ' . $request->input('placement')
            );
        }

        WalkinDriveAdRequest::query()->create([
            'account_id' => $account->id,
            'company_id' => $companyId,
            'banner_image' => $imageUrl,
            'placement' => $request->input('placement'),
            'message' => $request->input('message'),
            'status' => WalkinDriveAdRequest::STATUS_PENDING,
            'requested_at' => now(),
        ]);

        return $this->httpResponse()->setMessage(__('Request submitted. Admin will approve to show your ad.'));
    }
}
