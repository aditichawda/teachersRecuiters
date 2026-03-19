<?php

namespace Botble\JobBoard\Services;

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\UserNotification;
use Botble\JobBoard\Mail\UserNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    /**
     * Notification types for Job Seekers
     */
    const TYPE_WELCOME = 'welcome';
    const TYPE_JOB_APPLIED = 'job_applied';
    const TYPE_JOB_SAVED = 'job_saved';
    const TYPE_PROFILE_SHORTLISTED = 'profile_shortlisted';
    const TYPE_APPLICATION_NOT_SELECTED = 'application_not_selected';
    const TYPE_APPLICATION_ENQUIRY = 'application_enquiry';
    const TYPE_JOB_SUGGESTION = 'job_suggestion';
    const TYPE_PROFILE_VIEWED = 'profile_viewed';
    const TYPE_NEW_JOB_FROM_FOLLOWED_SCHOOL = 'new_job_followed_school';
    const TYPE_JOB_INVITATION = 'job_invitation';
    const TYPE_PROFILE_UPDATE_REMINDER = 'profile_update_reminder';
    const TYPE_SCHOOL_CONTACT_REQUEST = 'school_contact_request';
    const TYPE_JOB_ACCEPTED = 'job_accepted';
    const TYPE_PREMIUM_ACTIVATED = 'premium_activated';
    const TYPE_WALLET_RECHARGED = 'wallet_recharged';
    const TYPE_WALLET_LOW_BALANCE = 'wallet_low_balance';
    const TYPE_REFERRAL_SUCCESS = 'referral_success';
    const TYPE_PROFILE_COMPLETED = 'profile_completed';
    const TYPE_NEW_REVIEW = 'new_review';

    /**
     * Notification types for Employers
     */
    const TYPE_EMPLOYER_WELCOME = 'employer_welcome';
    const TYPE_SUBSCRIBE_PLAN = 'subscribe_plan';
    const TYPE_JOB_POSTED = 'job_posted';
    const TYPE_NEW_APPLICATION = 'new_application';
    const TYPE_CONTACT_ENQUIRY = 'contact_enquiry';
    const TYPE_HIRING_PLAN_ACTIVE = 'hiring_plan_active';
    const TYPE_FEATURE_ACTIVATED = 'feature_activated';
    const TYPE_PROFILE_COMPLETE_REMINDER = 'profile_complete_reminder';
    const TYPE_EMPLOYER_WALLET_RECHARGED = 'employer_wallet_recharged';
    const TYPE_EMPLOYER_WALLET_LOW = 'employer_wallet_low';
    const TYPE_TRANSACTION_SUCCESS = 'transaction_success';
    const TYPE_LOGIN_SUCCESS = 'login_success';
    const TYPE_LOGOUT_SUMMARY = 'logout_summary';
    const TYPE_PROFILE_SHORTLISTED_BY_EMPLOYER = 'profile_shortlisted_by_employer';
    const TYPE_ADMISSION_ENQUIRY = 'admission_enquiry';
    const TYPE_JOB_EXPIRING = 'job_expiring';
    const TYPE_JOB_EXPIRED = 'job_expired';
    const TYPE_EMPLOYER_NEW_REVIEW = 'employer_new_review';

    /**
     * Create and send notification
     */
    public function createNotification(
        Account $account,
        string $type,
        string $title,
        string $message,
        ?string $actionUrl = null,
        array $data = [],
        ?string $icon = null,
        ?string $color = null
    ): UserNotification {
        // Set default icon and color based on type
        $icon = $icon ?? $this->getDefaultIcon($type);
        $color = $color ?? $this->getDefaultColor($type);

        $notification = UserNotification::create([
            'account_id' => $account->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
            'color' => $color,
            'action_url' => $actionUrl,
            'data' => $data,
        ]);

        // Send email notification
        try {
            Mail::to($account->email)->send(new UserNotificationMail($notification, $account));
        } catch (\Exception $e) {
            Log::error('Failed to send notification email: ' . $e->getMessage(), [
                'notification_id' => $notification->id,
                'account_id' => $account->id,
                'type' => $type,
            ]);
        }

        // Send WhatsApp notification if phone number is available
        $this->sendWhatsAppNotification($account, $notification, $type, $data);

        return $notification;
    }

    /**
     * Job Seeker Notifications
     */

    public function sendWelcomeNotification(Account $account): UserNotification
    {
        $title = __('Welcome to Teachers Recruiter');
        $message = __('Thank you for joining Teachers Recruiter! We are excited to help you find your dream teaching position.');
        
        return $this->createNotification(
            $account,
            self::TYPE_WELCOME,
            $title,
            $message,
            route('public.account.dashboard'),
            ['account_id' => $account->id]
        );
    }

    public function sendJobAppliedNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('Application Submitted Successfully');
        $message = __('You successfully applied for :job_title job', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_APPLIED,
            $title,
            $message,
            route('public.account.applications'),
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendJobSavedNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('Job Saved');
        $message = __('You saved :job_title job to view later', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_SAVED,
            $title,
            $message,
            route('public.account.saved-jobs'),
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendProfileShortlistedNotification(Account $account, $jobTitle, $jobId, $schoolName): UserNotification
    {
        $title = __('Profile Shortlisted');
        $message = __('Your profile shortlist for job :job_title', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_PROFILE_SHORTLISTED,
            $title,
            $message,
            route('public.account.applications'),
            ['job_id' => $jobId, 'job_title' => $jobTitle, 'school_name' => $schoolName]
        );
    }

    public function sendApplicationNotSelectedNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('Application Update');
        $message = __('Your application is not selected for job :job_title', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_APPLICATION_NOT_SELECTED,
            $title,
            $message,
            route('public.account.applications'),
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendApplicationEnquiryNotification(Account $account, $jobTitle, $jobId, $schoolName): UserNotification
    {
        $title = __('New Enquiry on Your Application');
        $message = __(':school_name made an enquiry on your application for :job_title', [
            'school_name' => $schoolName,
            'job_title' => $jobTitle
        ]);
        
        return $this->createNotification(
            $account,
            self::TYPE_APPLICATION_ENQUIRY,
            $title,
            $message,
            route('public.account.applications'),
            ['job_id' => $jobId, 'job_title' => $jobTitle, 'school_name' => $schoolName]
        );
    }

    public function sendJobSuggestionNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('New Job Suggestion');
        $message = __('You have new job suggestion :job_title', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_SUGGESTION,
            $title,
            $message,
            route('public.jobs.detail', ['slug' => $jobId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendProfileViewedNotification(Account $account, $schoolName): UserNotification
    {
        $title = __('Profile Viewed');
        $message = __('Your profile viewed by :school_name', ['school_name' => $schoolName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_PROFILE_VIEWED,
            $title,
            $message,
            route('public.account.profile'),
            ['school_name' => $schoolName]
        );
    }

    public function sendNewJobFromFollowedSchoolNotification(Account $account, $jobTitle, $jobId, $schoolName): UserNotification
    {
        $title = __('New Job Posted');
        $message = __('New job posted by school :school_name you follow', ['school_name' => $schoolName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_NEW_JOB_FROM_FOLLOWED_SCHOOL,
            $title,
            $message,
            route('public.jobs.detail', ['slug' => $jobId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle, 'school_name' => $schoolName]
        );
    }

    public function sendJobInvitationNotification(Account $account, $jobTitle, $jobId, $schoolName): UserNotification
    {
        $title = __('Job Invitation');
        $message = __('School :school_name invite you to apply for a job :job_title', [
            'school_name' => $schoolName,
            'job_title' => $jobTitle
        ]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_INVITATION,
            $title,
            $message,
            route('public.jobs.detail', ['slug' => $jobId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle, 'school_name' => $schoolName]
        );
    }

    public function sendProfileUpdateReminderNotification(Account $account): UserNotification
    {
        $title = __('Update Your Profile');
        $message = __('Your profile is not completed or not updated in last 90 days. Please update your profile to get better job matches.');
        
        return $this->createNotification(
            $account,
            self::TYPE_PROFILE_UPDATE_REMINDER,
            $title,
            $message,
            route('public.account.profile'),
            []
        );
    }

    public function sendSchoolContactRequestNotification(Account $account, $schoolName): UserNotification
    {
        $title = __('Contact Request');
        $message = __('School :school_name wants to contact you', ['school_name' => $schoolName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_SCHOOL_CONTACT_REQUEST,
            $title,
            $message,
            route('public.account.messages'),
            ['school_name' => $schoolName]
        );
    }

    public function sendJobAcceptedNotification(Account $account, $jobTitle, $schoolName, $position): UserNotification
    {
        $title = __('Congratulations!');
        $message = __('Congratulations! for joining :school_name for the :position position', [
            'school_name' => $schoolName,
            'position' => $position
        ]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_ACCEPTED,
            $title,
            $message,
            route('public.account.dashboard'),
            ['job_title' => $jobTitle, 'school_name' => $schoolName, 'position' => $position]
        );
    }

    public function sendPremiumActivatedNotification(Account $account, $featureName): UserNotification
    {
        $title = __('Premium Service Activated');
        $message = __('Premium service :feature_name activated', ['feature_name' => $featureName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_PREMIUM_ACTIVATED,
            $title,
            $message,
            route('public.account.dashboard'),
            ['feature_name' => $featureName]
        );
    }

    public function sendWalletRechargedNotification(Account $account, $amount): UserNotification
    {
        $title = __('Wallet Recharged');
        $message = __('Wallet recharge successful. Amount: :amount', ['amount' => $amount]);
        
        return $this->createNotification(
            $account,
            self::TYPE_WALLET_RECHARGED,
            $title,
            $message,
            route('public.account.wallet'),
            ['amount' => $amount]
        );
    }

    public function sendWalletLowBalanceNotification(Account $account, $balance): UserNotification
    {
        $title = __('Low Wallet Balance');
        $message = __('Your wallet balance is low. Current balance: :balance', ['balance' => $balance]);
        
        return $this->createNotification(
            $account,
            self::TYPE_WALLET_LOW_BALANCE,
            $title,
            $message,
            route('public.account.wallet'),
            ['balance' => $balance]
        );
    }

    public function sendReferralSuccessNotification(Account $account, $referredName, $referredType = 'candidate'): UserNotification
    {
        $title = __('Referral Successful');
        $message = __('You referred :referred_name :type and he/she/school successfully registered', [
            'referred_name' => $referredName,
            'type' => $referredType
        ]);
        
        return $this->createNotification(
            $account,
            self::TYPE_REFERRAL_SUCCESS,
            $title,
            $message,
            route('public.account.dashboard'),
            ['referred_name' => $referredName, 'referred_type' => $referredType]
        );
    }

    public function sendProfileCompletedNotification(Account $account): UserNotification
    {
        $title = __('Profile Completed');
        $message = __('Congratulations! You updated profile 100%');
        
        return $this->createNotification(
            $account,
            self::TYPE_PROFILE_COMPLETED,
            $title,
            $message,
            route('public.account.profile'),
            []
        );
    }

    public function sendNewReviewNotification(Account $account, $reviewerName): UserNotification
    {
        $title = __('New Review');
        $message = __('New review to your profile by :reviewer_name', ['reviewer_name' => $reviewerName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_NEW_REVIEW,
            $title,
            $message,
            route('public.account.reviews'),
            ['reviewer_name' => $reviewerName]
        );
    }

    /**
     * Employer Notifications
     */

    public function sendEmployerWelcomeNotification(Account $account): UserNotification
    {
        $title = __('Welcome to Teachers Recruiter');
        $message = __('Welcome to Teachers Recruiter! Start your hiring journey today.');
        
        return $this->createNotification(
            $account,
            self::TYPE_EMPLOYER_WELCOME,
            $title,
            $message,
            route('public.account.dashboard'),
            ['account_id' => $account->id]
        );
    }

    public function sendSubscribePlanNotification(Account $account): UserNotification
    {
        $title = __('Start Your Hiring');
        $message = __('Start your hiring by subscribing a hiring plan');
        
        // Use packages route or dashboard as fallback
        try {
            $actionUrl = route('public.account.packages');
        } catch (\Exception $e) {
            try {
                $actionUrl = route('public.account.dashboard');
            } catch (\Exception $e2) {
                $actionUrl = null;
            }
        }
        
        return $this->createNotification(
            $account,
            self::TYPE_SUBSCRIBE_PLAN,
            $title,
            $message,
            $actionUrl,
            []
        );
    }

    public function sendJobPostedNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('Job Posted Successfully');
        $message = __('You successfully posted a job for :job_title', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_POSTED,
            $title,
            $message,
            route('public.account.jobs.edit', ['job' => $jobId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendNewApplicationNotification(Account $account, $jobTitle, $jobId, $candidateName, $applicationId): UserNotification
    {
        $title = __('New Application Received');
        $message = __('New Application received for :job_title by :candidate_name', [
            'job_title' => $jobTitle,
            'candidate_name' => $candidateName
        ]);
        
        return $this->createNotification(
            $account,
            self::TYPE_NEW_APPLICATION,
            $title,
            $message,
            route('public.account.applicants.edit', ['applicant' => $applicationId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle, 'candidate_name' => $candidateName, 'application_id' => $applicationId]
        );
    }

    public function sendContactEnquiryNotification(Account $account, $enquiryId): UserNotification
    {
        $title = __('New Contact Form Enquiry');
        $message = __('You have received a new contact form enquiry');
        
        // Use dashboard route if enquiries route doesn't exist
        // You can update this later when contact enquiries page is created
        try {
            $actionUrl = route('public.account.dashboard');
        } catch (\Exception $e) {
            $actionUrl = null;
        }
        
        return $this->createNotification(
            $account,
            self::TYPE_CONTACT_ENQUIRY,
            $title,
            $message,
            $actionUrl,
            ['enquiry_id' => $enquiryId]
        );
    }

    public function sendHiringPlanActiveNotification(Account $account, $planName): UserNotification
    {
        $title = __('Hiring Plan Activated');
        $message = __('Your Hiring Plan :plan_name is now active', ['plan_name' => $planName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_HIRING_PLAN_ACTIVE,
            $title,
            $message,
            route('public.account.dashboard'),
            ['plan_name' => $planName]
        );
    }

    public function sendFeatureActivatedNotification(Account $account, $featureName): UserNotification
    {
        $title = __('Feature Activated');
        $message = __('You successfully active the :feature_name', ['feature_name' => $featureName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_FEATURE_ACTIVATED,
            $title,
            $message,
            route('public.account.dashboard'),
            ['feature_name' => $featureName]
        );
    }

    public function sendProfileCompleteReminderNotification(Account $account): UserNotification
    {
        $title = __('Complete Your Profile');
        $message = __('Please complete your profile to get better results');
        
        return $this->createNotification(
            $account,
            self::TYPE_PROFILE_COMPLETE_REMINDER,
            $title,
            $message,
            route('public.account.profile'),
            []
        );
    }

    public function sendEmployerWalletRechargedNotification(Account $account, $amount): UserNotification
    {
        $title = __('Wallet Recharged');
        $message = __('Wallet recharge successful. Amount: :amount', ['amount' => $amount]);
        
        return $this->createNotification(
            $account,
            self::TYPE_EMPLOYER_WALLET_RECHARGED,
            $title,
            $message,
            route('public.account.wallet'),
            ['amount' => $amount]
        );
    }

    public function sendEmployerWalletLowNotification(Account $account, $balance): UserNotification
    {
        $title = __('Low Wallet Balance');
        $message = __('Your wallet balance is low. Current balance: :balance', ['balance' => $balance]);
        
        return $this->createNotification(
            $account,
            self::TYPE_EMPLOYER_WALLET_LOW,
            $title,
            $message,
            route('public.account.wallet'),
            ['balance' => $balance]
        );
    }

    public function sendTransactionSuccessNotification(Account $account, $credits, $serviceName): UserNotification
    {
        $title = __('Transaction Successful');
        $message = __('Transaction successful of :credits credits for :service_name', [
            'credits' => $credits,
            'service_name' => $serviceName
        ]);
        
        // Use wallet route as fallback since transactions route might not exist
        try {
            $actionUrl = route('public.account.wallet');
        } catch (\Exception $e) {
            try {
                $actionUrl = route('public.account.dashboard');
            } catch (\Exception $e2) {
                $actionUrl = null;
            }
        }
        
        return $this->createNotification(
            $account,
            self::TYPE_TRANSACTION_SUCCESS,
            $title,
            $message,
            $actionUrl,
            ['credits' => $credits, 'service_name' => $serviceName]
        );
    }

    public function sendLoginSuccessNotification(Account $account, $loginTime): UserNotification
    {
        $title = __('Login Successful');
        $message = __('Successful login at :login_time', ['login_time' => $loginTime]);
        
        return $this->createNotification(
            $account,
            self::TYPE_LOGIN_SUCCESS,
            $title,
            $message,
            route('public.account.dashboard'),
            ['login_time' => $loginTime]
        );
    }

    public function sendLogoutSummaryNotification(Account $account, $summary): UserNotification
    {
        $title = __('Logout Summary');
        $message = __('Logout summary: :summary', ['summary' => $summary]);
        
        return $this->createNotification(
            $account,
            self::TYPE_LOGOUT_SUMMARY,
            $title,
            $message,
            route('public.account.dashboard'),
            ['summary' => $summary]
        );
    }

    public function sendProfileShortlistedByEmployerNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('Profile Shortlisted');
        $message = __('You shortlisted a profile for :job_title', ['job_title' => $jobTitle]);
        
        // Use applicants route (not applications)
        try {
            $actionUrl = route('public.account.applicants.index');
        } catch (\Exception $e) {
            try {
                $actionUrl = route('public.account.dashboard');
            } catch (\Exception $e2) {
                $actionUrl = null;
            }
        }
        
        return $this->createNotification(
            $account,
            self::TYPE_PROFILE_SHORTLISTED_BY_EMPLOYER,
            $title,
            $message,
            $actionUrl,
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendAdmissionEnquiryNotification(Account $account, $enquiryId): UserNotification
    {
        $title = __('New Admission Enquiry');
        $message = __('New admission enquiry generated');
        
        // Use admission edit page or dashboard as fallback
        try {
            $actionUrl = route('public.account.admission.edit');
        } catch (\Exception $e) {
            try {
                $actionUrl = route('public.account.dashboard');
            } catch (\Exception $e2) {
                $actionUrl = null;
            }
        }
        
        return $this->createNotification(
            $account,
            self::TYPE_ADMISSION_ENQUIRY,
            $title,
            $message,
            $actionUrl,
            ['enquiry_id' => $enquiryId]
        );
    }

    public function sendJobExpiringNotification(Account $account, $jobTitle, $jobId, $daysLeft): UserNotification
    {
        $title = __('Job Expiring Soon');
        $message = __('Your job :job_title is about to expire in :days days', [
            'job_title' => $jobTitle,
            'days' => $daysLeft
        ]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_EXPIRING,
            $title,
            $message,
            route('public.account.jobs.edit', ['job' => $jobId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle, 'days_left' => $daysLeft]
        );
    }

    public function sendJobExpiredNotification(Account $account, $jobTitle, $jobId): UserNotification
    {
        $title = __('Job Expired');
        $message = __('Your job :job_title is expired', ['job_title' => $jobTitle]);
        
        return $this->createNotification(
            $account,
            self::TYPE_JOB_EXPIRED,
            $title,
            $message,
            route('public.account.jobs.edit', ['job' => $jobId]),
            ['job_id' => $jobId, 'job_title' => $jobTitle]
        );
    }

    public function sendEmployerNewReviewNotification(Account $account, $candidateName): UserNotification
    {
        $title = __('New Review Added');
        $message = __('New review added to your profile by :candidate_name', ['candidate_name' => $candidateName]);
        
        return $this->createNotification(
            $account,
            self::TYPE_EMPLOYER_NEW_REVIEW,
            $title,
            $message,
            route('public.account.reviews'),
            ['candidate_name' => $candidateName]
        );
    }

    /**
     * Get default icon for notification type
     */
    protected function getDefaultIcon(string $type): string
    {
        $icons = [
            // Job Seeker icons
            self::TYPE_WELCOME => 'feather-user-plus',
            self::TYPE_JOB_APPLIED => 'feather-check-circle',
            self::TYPE_JOB_SAVED => 'feather-bookmark',
            self::TYPE_PROFILE_SHORTLISTED => 'feather-star',
            self::TYPE_APPLICATION_NOT_SELECTED => 'feather-x-circle',
            self::TYPE_APPLICATION_ENQUIRY => 'feather-message-circle',
            self::TYPE_JOB_SUGGESTION => 'feather-briefcase',
            self::TYPE_PROFILE_VIEWED => 'feather-eye',
            self::TYPE_NEW_JOB_FROM_FOLLOWED_SCHOOL => 'feather-bell',
            self::TYPE_JOB_INVITATION => 'feather-mail',
            self::TYPE_PROFILE_UPDATE_REMINDER => 'feather-edit',
            self::TYPE_SCHOOL_CONTACT_REQUEST => 'feather-phone',
            self::TYPE_JOB_ACCEPTED => 'feather-award',
            self::TYPE_PREMIUM_ACTIVATED => 'feather-zap',
            self::TYPE_WALLET_RECHARGED => 'feather-dollar-sign',
            self::TYPE_WALLET_LOW_BALANCE => 'feather-alert-circle',
            self::TYPE_REFERRAL_SUCCESS => 'feather-users',
            self::TYPE_PROFILE_COMPLETED => 'feather-check',
            self::TYPE_NEW_REVIEW => 'feather-star',
            
            // Employer icons
            self::TYPE_EMPLOYER_WELCOME => 'feather-user-plus',
            self::TYPE_SUBSCRIBE_PLAN => 'feather-credit-card',
            self::TYPE_JOB_POSTED => 'feather-check-circle',
            self::TYPE_NEW_APPLICATION => 'feather-file-text',
            self::TYPE_CONTACT_ENQUIRY => 'feather-mail',
            self::TYPE_HIRING_PLAN_ACTIVE => 'feather-check',
            self::TYPE_FEATURE_ACTIVATED => 'feather-zap',
            self::TYPE_PROFILE_COMPLETE_REMINDER => 'feather-edit',
            self::TYPE_EMPLOYER_WALLET_RECHARGED => 'feather-dollar-sign',
            self::TYPE_EMPLOYER_WALLET_LOW => 'feather-alert-circle',
            self::TYPE_TRANSACTION_SUCCESS => 'feather-check-circle',
            self::TYPE_LOGIN_SUCCESS => 'feather-log-in',
            self::TYPE_LOGOUT_SUMMARY => 'feather-log-out',
            self::TYPE_PROFILE_SHORTLISTED_BY_EMPLOYER => 'feather-star',
            self::TYPE_ADMISSION_ENQUIRY => 'feather-file-text',
            self::TYPE_JOB_EXPIRING => 'feather-clock',
            self::TYPE_JOB_EXPIRED => 'feather-alert-circle',
            self::TYPE_EMPLOYER_NEW_REVIEW => 'feather-star',
        ];

        return $icons[$type] ?? 'feather-bell';
    }

    /**
     * Get default color for notification type
     */
    protected function getDefaultColor(string $type): string
    {
        $colors = [
            // Job Seeker colors
            self::TYPE_WELCOME => '#10b981',
            self::TYPE_JOB_APPLIED => '#3b82f6',
            self::TYPE_JOB_SAVED => '#8b5cf6',
            self::TYPE_PROFILE_SHORTLISTED => '#f59e0b',
            self::TYPE_APPLICATION_NOT_SELECTED => '#ef4444',
            self::TYPE_APPLICATION_ENQUIRY => '#06b6d4',
            self::TYPE_JOB_SUGGESTION => '#6366f1',
            self::TYPE_PROFILE_VIEWED => '#14b8a6',
            self::TYPE_NEW_JOB_FROM_FOLLOWED_SCHOOL => '#ec4899',
            self::TYPE_JOB_INVITATION => '#8b5cf6',
            self::TYPE_PROFILE_UPDATE_REMINDER => '#f59e0b',
            self::TYPE_SCHOOL_CONTACT_REQUEST => '#06b6d4',
            self::TYPE_JOB_ACCEPTED => '#10b981',
            self::TYPE_PREMIUM_ACTIVATED => '#f59e0b',
            self::TYPE_WALLET_RECHARGED => '#10b981',
            self::TYPE_WALLET_LOW_BALANCE => '#ef4444',
            self::TYPE_REFERRAL_SUCCESS => '#8b5cf6',
            self::TYPE_PROFILE_COMPLETED => '#10b981',
            self::TYPE_NEW_REVIEW => '#f59e0b',
            
            // Employer colors
            self::TYPE_EMPLOYER_WELCOME => '#10b981',
            self::TYPE_SUBSCRIBE_PLAN => '#6366f1',
            self::TYPE_JOB_POSTED => '#3b82f6',
            self::TYPE_NEW_APPLICATION => '#06b6d4',
            self::TYPE_CONTACT_ENQUIRY => '#8b5cf6',
            self::TYPE_HIRING_PLAN_ACTIVE => '#10b981',
            self::TYPE_FEATURE_ACTIVATED => '#f59e0b',
            self::TYPE_PROFILE_COMPLETE_REMINDER => '#f59e0b',
            self::TYPE_EMPLOYER_WALLET_RECHARGED => '#10b981',
            self::TYPE_EMPLOYER_WALLET_LOW => '#ef4444',
            self::TYPE_TRANSACTION_SUCCESS => '#10b981',
            self::TYPE_LOGIN_SUCCESS => '#3b82f6',
            self::TYPE_LOGOUT_SUMMARY => '#64748b',
            self::TYPE_PROFILE_SHORTLISTED_BY_EMPLOYER => '#f59e0b',
            self::TYPE_ADMISSION_ENQUIRY => '#06b6d4',
            self::TYPE_JOB_EXPIRING => '#f59e0b',
            self::TYPE_JOB_EXPIRED => '#ef4444',
            self::TYPE_EMPLOYER_NEW_REVIEW => '#f59e0b',
        ];

        return $colors[$type] ?? '#1967d2';
    }

    /**
     * Send WhatsApp notification using MSG Club API
     */
    protected function sendWhatsAppNotification(Account $account, UserNotification $notification, string $type, array $data = []): void
    {
        Log::info('[NOTIFICATION_WHATSAPP] Attempting WhatsApp notification', [
            'notification_id' => $notification->id ?? null,
            'account_id' => $account->id,
            'type' => $type,
            'has_phone' => ! empty($account->phone),
            'raw_phone' => $account->phone,
            'phone_country_code' => $account->phone_country_code,
            'is_whatsapp_available' => (bool) ($account->is_whatsapp_available ?? false),
        ]);

        // Check if account has phone number and WhatsApp is available
        if (!$account->phone) {
            Log::warning('[NOTIFICATION_WHATSAPP] Skipped: account has no phone', [
                'account_id' => $account->id,
                'type' => $type,
            ]);
            return;
        }

        if (! $account->is_whatsapp_available) {
            Log::warning('[NOTIFICATION_WHATSAPP] Skipped: WhatsApp not enabled for this number', [
                'account_id' => $account->id,
                'type' => $type,
                'raw_phone' => $account->phone,
            ]);
            return;
        }

        // Get phone number
        // Note: in our registration flow, `phone` may already include the country code (e.g. "+9199xxxxxx")
        // so we must avoid double-prepending `phone_country_code`.
        $phone = (string) $account->phone;
        $phoneCountryCode = (string) ($account->phone_country_code ?? '');

        $trimmedPhone = ltrim($phone);
        $hasLeadingPlus = str_starts_with($trimmedPhone, '+');

        if (! $hasLeadingPlus && $phoneCountryCode !== '') {
            $ccDigits = preg_replace('/[^0-9]/', '', $phoneCountryCode);
            $phoneDigits = preg_replace('/[^0-9]/', '', $phone);

            // Prepend CC only if phone doesn't already start with it (basic safeguard)
            if ($ccDigits !== '' && $phoneDigits !== '' && ! str_starts_with($phoneDigits, $ccDigits)) {
                $phone = $ccDigits . $phoneDigits;
            } else {
                $phone = $phoneDigits;
            }
        }

        // Remove any non-numeric characters (including "+")
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (empty($phone)) {
            return;
        }

        // Get WhatsApp API configuration
        $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate')));
        $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key', '4625770ffb62853af287cedec7f50b0')));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));

        if (!$apiUrl || !$authKey) {
            Log::warning('[NOTIFICATION_WHATSAPP] WhatsApp API configuration missing');
            return;
        }

        // Build WhatsApp message based on notification type
        $templateName = $this->getWhatsAppTemplateName($type);
        $messageParams = $this->buildWhatsAppMessageParams($notification, $type, $data);

        if (!$templateName || empty($messageParams)) {
            Log::debug('[NOTIFICATION_WHATSAPP] No template or message params for type', ['type' => $type]);
            return;
        }

        // Build request body components
        $components = [];
        
        // Handle body parameters
        if (isset($messageParams['body']) && is_array($messageParams['body'])) {
            $bodyParameters = [];
            foreach ($messageParams['body'] as $param) {
                $bodyParameters[] = [
                    'type' => 'text',
                    'text' => (string)$param
                ];
            }
            if (!empty($bodyParameters)) {
                $components[] = [
                    'type' => 'body',
                    'index' => 0,
                    'parameters' => $bodyParameters
                ];
            }
        } elseif (is_array($messageParams) && !isset($messageParams['body'])) {
            // Legacy format: simple array of parameters
        $bodyParameters = [];
        foreach ($messageParams as $param) {
            $bodyParameters[] = [
                'type' => 'text',
                'text' => (string)$param
            ];
            }
            if (!empty($bodyParameters)) {
                $components[] = [
                    'type' => 'body',
                    'index' => 0,
                    'parameters' => $bodyParameters
                ];
            }
        }
        
        // Handle button parameters (for templates with buttons)
        if (isset($messageParams['button']) && is_array($messageParams['button'])) {
            $buttonParameters = [];
            foreach ($messageParams['button'] as $param) {
                $buttonParameters[] = [
                    'type' => 'text',
                    'text' => (string)$param
                ];
            }
            if (!empty($buttonParameters)) {
                $components[] = [
                    'type' => 'button',
                    'sub_type' => 'url',
                    'index' => 0,
                    'parameters' => $buttonParameters
                ];
            }
        }

        $requestBody = [
            'mobileNumbers' => $phone,
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
                    'components' => $components
                ]
            ],
            'qrImageUrl' => false,
            'qrLinkUrl' => false,
            'to' => $phone
        ];

        // Send WhatsApp message
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(90)
            ->connectTimeout(30)
            ->retry(3, 2000, function ($exception, $request) {
                return $exception instanceof \Illuminate\Http\Client\ConnectionException
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            if ($response->successful()) {
                $responseData = $response->json();
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('[NOTIFICATION_WHATSAPP] ✓ WhatsApp notification sent successfully', [
                        'notification_id' => $notification->id,
                        'account_id' => $account->id,
                        'type' => $type,
                        'template' => $templateName,
                        'phone' => $phone,
                    ]);
                } else {
                    Log::warning('[NOTIFICATION_WHATSAPP] ✗ WhatsApp API returned non-success response', [
                        'notification_id' => $notification->id,
                        'response' => $responseData,
                        'response_code' => $responseData['responseCode'] ?? 'unknown',
                    ]);
                }
            } else {
                Log::error('[NOTIFICATION_WHATSAPP] ✗ WhatsApp API request failed', [
                    'notification_id' => $notification->id,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('[NOTIFICATION_WHATSAPP] ✗ Error sending WhatsApp notification', [
                'notification_id' => $notification->id,
                'account_id' => $account->id,
                'type' => $type,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get WhatsApp template name for notification type
     */
    protected function getWhatsAppTemplateName(string $type): ?string
    {
        // Map notification types to WhatsApp template names
        // You need to create these templates in MSG Club dashboard
        $templates = [
            self::TYPE_WELCOME => 'educator_successful_registration',
            self::TYPE_EMPLOYER_WELCOME => 'institution_registration_success',
            self::TYPE_JOB_APPLIED => 'job_applied_notification',
            self::TYPE_JOB_SAVED => 'job_saved_notification',
            self::TYPE_PROFILE_SHORTLISTED => 'shortlist_application_for_job', // Already exists
            self::TYPE_APPLICATION_NOT_SELECTED => 'application_reject_for_position', // Already exists
            self::TYPE_APPLICATION_ENQUIRY => 'application_enquiry_notification',
            self::TYPE_PROFILE_VIEWED => 'profile_viewed_notification',
            self::TYPE_JOB_ACCEPTED => 'job_accepted_notification',
            self::TYPE_WALLET_RECHARGED => 'wallet_recharged_notification',
            self::TYPE_WALLET_LOW_BALANCE => 'wallet_low_balance_notification',
            self::TYPE_PROFILE_COMPLETED => 'profile_completed_notification',
            self::TYPE_NEW_REVIEW => 'new_review_notification',
        ];

        return $templates[$type] ?? null;
    }

    /**
     * Build WhatsApp message parameters based on notification type
     */
    protected function buildWhatsAppMessageParams(UserNotification $notification, string $type, array $data = []): array
    {
        $account = $notification->account;
        $params = [];

        switch ($type) {
            case self::TYPE_WELCOME:
                // For educator_successful_registration template (Job Seeker)
                // Body parameter: educator/account name
                $params = [
                    'body' => [
                        $account->name ?? 'User'
                    ],
                    'button' => [
                        'login/' // Button text for login (with trailing slash)
                    ]
                ];
                break;

            case self::TYPE_EMPLOYER_WELCOME:
                // For institution_registration_success template (Employer)
                // Body parameter: institution/account name
                $params = [
                    'body' => [
                        $account->name ?? 'User'
                    ],
                    'button' => [
                        'login' // Button text for login
                    ]
                ];
                break;

            case self::TYPE_JOB_APPLIED:
                $jobTitle = $data['job_title'] ?? 'Job';
                $params = [
                    $account->name ?? 'User',
                    $jobTitle
                ];
                break;

            case self::TYPE_JOB_SAVED:
                $jobTitle = $data['job_title'] ?? 'Job';
                $params = [
                    $account->name ?? 'User',
                    $jobTitle
                ];
                break;

            case self::TYPE_PROFILE_SHORTLISTED:
                $jobTitle = $data['job_title'] ?? 'Job';
                $schoolName = $data['school_name'] ?? 'School';
                $params = [
                    $account->name ?? 'User',
                    $jobTitle,
                    $schoolName
                ];
                break;

            case self::TYPE_APPLICATION_NOT_SELECTED:
                $jobTitle = $data['job_title'] ?? 'Job';
                $params = [
                    $account->name ?? 'User',
                    $jobTitle
                ];
                break;

            case self::TYPE_APPLICATION_ENQUIRY:
                $jobTitle = $data['job_title'] ?? 'Job';
                $schoolName = $data['school_name'] ?? 'School';
                $params = [
                    $account->name ?? 'User',
                    $jobTitle,
                    $schoolName
                ];
                break;

            case self::TYPE_PROFILE_VIEWED:
                $schoolName = $data['school_name'] ?? 'School';
                $params = [
                    $account->name ?? 'User',
                    $schoolName
                ];
                break;

            case self::TYPE_JOB_ACCEPTED:
                $jobTitle = $data['job_title'] ?? 'Job';
                $schoolName = $data['school_name'] ?? 'School';
                $params = [
                    $account->name ?? 'User',
                    $jobTitle,
                    $schoolName
                ];
                break;

            case self::TYPE_WALLET_RECHARGED:
                $amount = $data['amount'] ?? '0';
                $params = [
                    $account->name ?? 'User',
                    $amount . ' credits'
                ];
                break;

            case self::TYPE_WALLET_LOW_BALANCE:
                $balance = $data['balance'] ?? '0';
                $params = [
                    $account->name ?? 'User',
                    $balance . ' credits'
                ];
                break;

            case self::TYPE_PROFILE_COMPLETED:
                $params = [
                    $account->name ?? 'User'
                ];
                break;

            case self::TYPE_NEW_REVIEW:
                $reviewerName = $data['reviewer_name'] ?? 'School';
                $params = [
                    $account->name ?? 'User',
                    $reviewerName
                ];
                break;

            default:
                // Generic notification
                $params = [
                    $account->name ?? 'User',
                    $notification->title,
                    $notification->message
                ];
                break;
        }

        return $params;
    }
}