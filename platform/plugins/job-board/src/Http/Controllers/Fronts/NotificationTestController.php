<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationTestController extends BaseController
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Generate all employer notifications for testing
     * Access: /account/notifications/test (only for logged-in employers)
     */
    public function generateAllNotifications(Request $request)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return response()->json([
                'error' => true,
                'message' => 'Please login as employer first'
            ], 401);
        }

        if (!$account->isEmployer()) {
            return response()->json([
                'error' => true,
                'message' => 'This test is only for employers'
            ], 403);
        }

        $notifications = [];

        try {
            // 1. Welcome to Teachers Recruiter
            $notifications[] = $this->notificationService->sendEmployerWelcomeNotification($account);

            // 2. Start your hiring by subscribing a hiring plan
            $notifications[] = $this->notificationService->sendSubscribePlanNotification($account);

            // 3. You successfully posted a job for {job title}
            // Note: For testing, we'll use a dummy job ID. In real scenario, use actual job ID
            try {
                $notifications[] = $this->notificationService->sendJobPostedNotification(
                    $account,
                    'Mathematics Teacher',
                    999 // dummy job ID for testing
                );
            } catch (\Exception $e) {
                // If route fails, create notification without action URL
                $notifications[] = $this->notificationService->createNotification(
                    $account,
                    \Botble\JobBoard\Services\NotificationService::TYPE_JOB_POSTED,
                    'Job Posted Successfully',
                    'You successfully posted a job for Mathematics Teacher',
                    null, // No action URL for test
                    ['job_id' => 999, 'job_title' => 'Mathematics Teacher']
                );
            }

            // 4. New Application received for {job title} by {candidate name}
            try {
                $notifications[] = $this->notificationService->sendNewApplicationNotification(
                    $account,
                    'Science Teacher',
                    1, // dummy job ID
                    'John Doe',
                    1 // dummy application ID
                );
            } catch (\Exception $e) {
                // If route fails, create notification without action URL
                $notifications[] = $this->notificationService->createNotification(
                    $account,
                    \Botble\JobBoard\Services\NotificationService::TYPE_NEW_APPLICATION,
                    'New Application Received',
                    'New Application received for Science Teacher by John Doe',
                    null, // No action URL for test
                    ['job_id' => 1, 'job_title' => 'Science Teacher', 'candidate_name' => 'John Doe', 'application_id' => 1]
                );
            }

            // 5. New contact form enquiry
            try {
                $notifications[] = $this->notificationService->sendContactEnquiryNotification(
                    $account,
                    1 // dummy enquiry ID
                );
            } catch (\Exception $e) {
                // If route fails, create notification without action URL
                $notifications[] = $this->notificationService->createNotification(
                    $account,
                    \Botble\JobBoard\Services\NotificationService::TYPE_CONTACT_ENQUIRY,
                    'New Contact Form Enquiry',
                    'You have received a new contact form enquiry',
                    null, // No action URL for test
                    ['enquiry_id' => 1]
                );
            }

            // 6. Your Hiring Plan {Plan Name} is now active
            $notifications[] = $this->notificationService->sendHiringPlanActiveNotification(
                $account,
                'Premium Hiring Plan'
            );

            // 7. You successfully active the {feature name} – Feature profile, admission enquiry service
            $notifications[] = $this->notificationService->sendFeatureActivatedNotification(
                $account,
                'Feature Profile, Admission Enquiry Service'
            );

            // 8. Complete your profile
            $notifications[] = $this->notificationService->sendProfileCompleteReminderNotification($account);

            // 9. Wallet recharge successful
            $notifications[] = $this->notificationService->sendEmployerWalletRechargedNotification(
                $account,
                '₹1,000'
            );

            // 10. Wallet low balance
            $notifications[] = $this->notificationService->sendEmployerWalletLowNotification(
                $account,
                '₹50'
            );

            // 11. Transaction successful of {100} credits for {service name}
            $notifications[] = $this->notificationService->sendTransactionSuccessNotification(
                $account,
                100,
                'Job Posting'
            );

            // 12. Successful login at 6/March/2026, 04:00 PM
            $loginTime = Carbon::now()->format('d/M/Y, h:i A');
            $notifications[] = $this->notificationService->sendLoginSuccessNotification(
                $account,
                $loginTime
            );

            // 13. Logout summary
            $notifications[] = $this->notificationService->sendLogoutSummaryNotification(
                $account,
                'Session duration: 2 hours 30 minutes. Activities: Posted 1 job, Reviewed 3 applications.'
            );

            // 14. You shortlisted a profile for {job title}
            $notifications[] = $this->notificationService->sendProfileShortlistedByEmployerNotification(
                $account,
                'English Teacher',
                1 // dummy job ID
            );

            return response()->json([
                'success' => true,
                'message' => 'All 14 notifications generated successfully!',
                'notifications_count' => count($notifications),
                'notifications' => array_map(function($n) {
                    return [
                        'id' => $n->id,
                        'type' => $n->type,
                        'title' => $n->title,
                        'message' => $n->message,
                    ];
                }, $notifications),
                'redirect_url' => route('public.notifications')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error generating notifications: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Generate all job seeker notifications for testing
     * Access: /account/notifications/test-job-seeker (only for logged-in job seekers)
     */
    public function generateAllJobSeekerNotifications(Request $request)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return response()->json([
                'error' => true,
                'message' => 'Please login as job seeker first'
            ], 401);
        }

        if ($account->isEmployer()) {
            return response()->json([
                'error' => true,
                'message' => 'This test is only for job seekers. Use /account/notifications/test for employers.'
            ], 403);
        }

        $notifications = [];

        try {
            // 1. Welcome notification after successful registration
            $notifications[] = $this->notificationService->sendWelcomeNotification($account);

            // 2. You successfully applied for {job title} job
            $notifications[] = $this->notificationService->sendJobAppliedNotification(
                $account,
                'Mathematics Teacher',
                1 // dummy job ID
            );

            // 3. You saved {job title} job to view later
            $notifications[] = $this->notificationService->sendJobSavedNotification(
                $account,
                'Science Teacher',
                2 // dummy job ID
            );

            // 4. Your profile shortlist for job {job title}
            $notifications[] = $this->notificationService->sendProfileShortlistedNotification(
                $account,
                'English Teacher',
                3, // dummy job ID
                'ABC School'
            );

            // 5. You application is not selected for job {job title}
            $notifications[] = $this->notificationService->sendApplicationNotSelectedNotification(
                $account,
                'Physics Teacher',
                4 // dummy job ID
            );

            // 6. {school name} made an enquiry on your application for {job title}
            $notifications[] = $this->notificationService->sendApplicationEnquiryNotification(
                $account,
                'Chemistry Teacher',
                5, // dummy job ID
                'XYZ School'
            );

            // 7. You have new job suggestion {job title}
            $notifications[] = $this->notificationService->sendJobSuggestionNotification(
                $account,
                'Biology Teacher',
                6 // dummy job ID
            );

            // 8. Your profile viewed by abc school {school/institution name}
            $notifications[] = $this->notificationService->sendProfileViewedNotification(
                $account,
                'ABC School'
            );

            // 9. New job posted by school {school name} you follow
            $notifications[] = $this->notificationService->sendNewJobFromFollowedSchoolNotification(
                $account,
                'History Teacher',
                7, // dummy job ID
                'XYZ School'
            );

            // 10. School {School Name} invite you to apply for a job {Job title}
            $notifications[] = $this->notificationService->sendJobInvitationNotification(
                $account,
                'Geography Teacher',
                8, // dummy job ID
                'ABC School'
            );

            // 11. Update your profile notification by admin (if not completed, and not updated in last 90-days)
            $notifications[] = $this->notificationService->sendProfileUpdateReminderNotification($account);

            // 12. School {school name} wants to contact you
            $notifications[] = $this->notificationService->sendSchoolContactRequestNotification(
                $account,
                'XYZ School'
            );

            // 13. Congratulations! for joining abc school for the ABC position
            $notifications[] = $this->notificationService->sendJobAcceptedNotification(
                $account,
                'Mathematics Teacher',
                'ABC School',
                'Senior Teacher'
            );

            // 14. Premium service {feature name} activated
            $notifications[] = $this->notificationService->sendPremiumActivatedNotification(
                $account,
                'Featured Profile'
            );

            // 15. Wallet recharge successful
            $notifications[] = $this->notificationService->sendWalletRechargedNotification(
                $account,
                '₹1,000'
            );

            // 16. Wallet low balance
            $notifications[] = $this->notificationService->sendWalletLowBalanceNotification(
                $account,
                '₹50'
            );

            // 17. You referred abc candidate/school and he/she/school successfully registered
            $notifications[] = $this->notificationService->sendReferralSuccessNotification(
                $account,
                'John Doe',
                'candidate'
            );

            // 18. Congratulations! You updated profile 100% message by admin
            $notifications[] = $this->notificationService->sendProfileCompletedNotification($account);

            // 19. New review to your profile by {School/Institution Name}
            $notifications[] = $this->notificationService->sendNewReviewNotification(
                $account,
                'ABC School'
            );

            return response()->json([
                'success' => true,
                'message' => 'All 19 job seeker notifications generated successfully!',
                'notifications_count' => count($notifications),
                'notifications' => array_map(function($n) {
                    return [
                        'id' => $n->id,
                        'type' => $n->type,
                        'title' => $n->title,
                        'message' => $n->message,
                    ];
                }, $notifications),
                'redirect_url' => route('public.notifications')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error generating notifications: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Generate single notification by type
     * Access: /account/notifications/test/{type} (for employers)
     * Access: /account/notifications/test-job-seeker/{type} (for job seekers)
     */
    public function generateSingleNotification(Request $request, $type)
    {
        $account = Auth::guard('account')->user();
        
        if (!$account) {
            return response()->json([
                'error' => true,
                'message' => 'Please login first'
            ], 401);
        }

        $isEmployer = $account->isEmployer();
        $isJobSeeker = !$isEmployer;

        try {
            $notification = null;

            if ($isEmployer) {
                // Employer notification types
                switch ($type) {
                    case 'welcome':
                        $notification = $this->notificationService->sendEmployerWelcomeNotification($account);
                        break;
                    case 'subscribe-plan':
                        $notification = $this->notificationService->sendSubscribePlanNotification($account);
                        break;
                    case 'job-posted':
                        $notification = $this->notificationService->sendJobPostedNotification(
                            $account,
                            'Test Job Title',
                            1
                        );
                        break;
                    case 'new-application':
                        $notification = $this->notificationService->sendNewApplicationNotification(
                            $account,
                            'Test Job',
                            1,
                            'Test Candidate',
                            1
                        );
                        break;
                    case 'contact-enquiry':
                        $notification = $this->notificationService->sendContactEnquiryNotification($account, 1);
                        break;
                    case 'hiring-plan-active':
                        $notification = $this->notificationService->sendHiringPlanActiveNotification(
                            $account,
                            'Test Plan'
                        );
                        break;
                    case 'feature-activated':
                        $notification = $this->notificationService->sendFeatureActivatedNotification(
                            $account,
                            'Test Feature'
                        );
                        break;
                    case 'complete-profile':
                        $notification = $this->notificationService->sendProfileCompleteReminderNotification($account);
                        break;
                    case 'wallet-recharged':
                        $notification = $this->notificationService->sendEmployerWalletRechargedNotification(
                            $account,
                            '₹500'
                        );
                        break;
                    case 'wallet-low':
                        $notification = $this->notificationService->sendEmployerWalletLowNotification(
                            $account,
                            '₹100'
                        );
                        break;
                    case 'transaction-success':
                        $notification = $this->notificationService->sendTransactionSuccessNotification(
                            $account,
                            50,
                            'Test Service'
                        );
                        break;
                    case 'login-success':
                        $notification = $this->notificationService->sendLoginSuccessNotification(
                            $account,
                            Carbon::now()->format('d/M/Y, h:i A')
                        );
                        break;
                    case 'logout-summary':
                        $notification = $this->notificationService->sendLogoutSummaryNotification(
                            $account,
                            'Test logout summary'
                        );
                        break;
                    case 'profile-shortlisted':
                        $notification = $this->notificationService->sendProfileShortlistedByEmployerNotification(
                            $account,
                            'Test Job',
                            1
                        );
                        break;
                    default:
                        return response()->json([
                            'error' => true,
                            'message' => 'Invalid notification type for employer. Available types: welcome, subscribe-plan, job-posted, new-application, contact-enquiry, hiring-plan-active, feature-activated, complete-profile, wallet-recharged, wallet-low, transaction-success, login-success, logout-summary, profile-shortlisted'
                        ], 400);
                }
            } else {
                // Job Seeker notification types
                switch ($type) {
                    case 'welcome':
                        $notification = $this->notificationService->sendWelcomeNotification($account);
                        break;
                    case 'job-applied':
                        $notification = $this->notificationService->sendJobAppliedNotification(
                            $account,
                            'Test Job Title',
                            1
                        );
                        break;
                    case 'job-saved':
                        $notification = $this->notificationService->sendJobSavedNotification(
                            $account,
                            'Test Job Title',
                            1
                        );
                        break;
                    case 'profile-shortlisted':
                        $notification = $this->notificationService->sendProfileShortlistedNotification(
                            $account,
                            'Test Job Title',
                            1,
                            'Test School'
                        );
                        break;
                    case 'application-not-selected':
                        $notification = $this->notificationService->sendApplicationNotSelectedNotification(
                            $account,
                            'Test Job Title',
                            1
                        );
                        break;
                    case 'application-enquiry':
                        $notification = $this->notificationService->sendApplicationEnquiryNotification(
                            $account,
                            'Test Job Title',
                            1,
                            'Test School'
                        );
                        break;
                    case 'job-suggestion':
                        $notification = $this->notificationService->sendJobSuggestionNotification(
                            $account,
                            'Test Job Title',
                            1
                        );
                        break;
                    case 'profile-viewed':
                        $notification = $this->notificationService->sendProfileViewedNotification(
                            $account,
                            'Test School'
                        );
                        break;
                    case 'new-job-followed-school':
                        $notification = $this->notificationService->sendNewJobFromFollowedSchoolNotification(
                            $account,
                            'Test Job Title',
                            1,
                            'Test School'
                        );
                        break;
                    case 'job-invitation':
                        $notification = $this->notificationService->sendJobInvitationNotification(
                            $account,
                            'Test Job Title',
                            1,
                            'Test School'
                        );
                        break;
                    case 'profile-update-reminder':
                        $notification = $this->notificationService->sendProfileUpdateReminderNotification($account);
                        break;
                    case 'school-contact-request':
                        $notification = $this->notificationService->sendSchoolContactRequestNotification(
                            $account,
                            'Test School'
                        );
                        break;
                    case 'job-accepted':
                        $notification = $this->notificationService->sendJobAcceptedNotification(
                            $account,
                            'Test Job Title',
                            'Test School',
                            'Test Position'
                        );
                        break;
                    case 'premium-activated':
                        $notification = $this->notificationService->sendPremiumActivatedNotification(
                            $account,
                            'Test Feature'
                        );
                        break;
                    case 'wallet-recharged':
                        $notification = $this->notificationService->sendWalletRechargedNotification(
                            $account,
                            '₹500'
                        );
                        break;
                    case 'wallet-low':
                        $notification = $this->notificationService->sendWalletLowBalanceNotification(
                            $account,
                            '₹100'
                        );
                        break;
                    case 'referral-success':
                        $notification = $this->notificationService->sendReferralSuccessNotification(
                            $account,
                            'Test Name',
                            'candidate'
                        );
                        break;
                    case 'profile-completed':
                        $notification = $this->notificationService->sendProfileCompletedNotification($account);
                        break;
                    case 'new-review':
                        $notification = $this->notificationService->sendNewReviewNotification(
                            $account,
                            'Test School'
                        );
                        break;
                    default:
                        return response()->json([
                            'error' => true,
                            'message' => 'Invalid notification type for job seeker. Available types: welcome, job-applied, job-saved, profile-shortlisted, application-not-selected, application-enquiry, job-suggestion, profile-viewed, new-job-followed-school, job-invitation, profile-update-reminder, school-contact-request, job-accepted, premium-activated, wallet-recharged, wallet-low, referral-success, profile-completed, new-review'
                        ], 400);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification generated successfully!',
                'notification' => [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                ],
                'redirect_url' => route('public.notifications')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error generating notification: ' . $e->getMessage()
            ], 500);
        }
    }
}
