<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\DedicatedRecruiterRequest;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobInvite;
use Botble\JobBoard\Models\SocialPromotionRequest;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployerCreditFeatureController extends BaseController
{
    /**
     * Multiple Login: Add sub-account (email, name, role, password). Deduct 250 credits.
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

        $companyId = $account->companies()->first()?->id;
        Account::query()->create([
            'first_name' => $request->input('name'),
            'last_name' => '',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'type' => AccountTypeEnum::EMPLOYER,
            'parent_account_id' => $account->id,
            'sub_account_role' => $request->input('role'),
            'credits' => 0,
        ])->companies()->attach($companyId ? [$companyId] : []);

        return $this->httpResponse()->setMessage(__('Sub-account created. :credits credits deducted.', ['credits' => $credits]));
    }

    /**
     * Dedicated Recruiter: Submit request (duration_months, company_id, start_date, end_date, note).
     */
    public function storeDedicatedRecruiterRequest(Request $request)
    {
        $request->validate([
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

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_DEDICATED_RECRUITER, 5000);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Dedicated Recruiter.', ['credits' => $credits]));
        }

        $companyId = $request->input('company_id');
        if ($companyId && ! $account->companies()->where('jb_companies.id', $companyId)->exists()) {
            return $this->httpResponse()->setError()->setMessage(__('Invalid institution.'));
        }

        DedicatedRecruiterRequest::query()->create([
            'account_id' => $account->id,
            'duration_months' => $request->input('duration_months', 1),
            'company_id' => $companyId,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'note' => $request->input('note'),
            'status' => DedicatedRecruiterRequest::STATUS_PENDING,
            'requested_at' => now(),
        ]);

        return $this->httpResponse()->setMessage(__('Request submitted. Admin will review and accept.'));
    }

    /**
     * Social Promotion: Submit request (company_id, title, tag, platform, message, image).
     * No credit deduction here; admin Accept will deduct 3000 credits.
     */
    public function storeSocialPromotionRequest(Request $request)
    {
        $request->validate([
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

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_SOCIAL_PROMOTION, 3000);
        if ($account->credits < $credits) {
            return $this->httpResponse()->setError()->setMessage(__('Insufficient credits. Need :credits for Social Promotion. Credits will be deducted when admin approves.', ['credits' => $credits]));
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

        return $this->httpResponse()->setMessage(__('Request submitted. Pending admin approval. Credits will be deducted when approved.'));
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
}
