# Notification System Usage Guide

This document explains how to use the comprehensive notification system for both Job Seekers and Employers.

## Overview

The notification system provides:
- In-app notifications (stored in database)
- Email notifications (sent automatically)
- Dynamic notification page with filtering
- All notification types for both user roles

## Basic Usage

### Getting the Notification Service

```php
use Botble\JobBoard\Services\NotificationService;

$notificationService = app(NotificationService::class);
```

## Job Seeker Notifications

### 1. Welcome Notification (After Registration)
```php
$notificationService->sendWelcomeNotification($account);
```

### 2. Job Applied Notification
```php
$notificationService->sendJobAppliedNotification($account, $jobTitle, $jobId);
```

### 3. Job Saved Notification
```php
$notificationService->sendJobSavedNotification($account, $jobTitle, $jobId);
```

### 4. Profile Shortlisted Notification
```php
$notificationService->sendProfileShortlistedNotification($account, $jobTitle, $jobId, $schoolName);
```

### 5. Application Not Selected Notification
```php
$notificationService->sendApplicationNotSelectedNotification($account, $jobTitle, $jobId);
```

### 6. Application Enquiry Notification
```php
$notificationService->sendApplicationEnquiryNotification($account, $jobTitle, $jobId, $schoolName);
```

### 7. Job Suggestion Notification
```php
$notificationService->sendJobSuggestionNotification($account, $jobTitle, $jobId);
```

### 8. Profile Viewed Notification
```php
$notificationService->sendProfileViewedNotification($account, $schoolName);
```

### 9. New Job from Followed School
```php
$notificationService->sendNewJobFromFollowedSchoolNotification($account, $jobTitle, $jobId, $schoolName);
```

### 10. Job Invitation Notification
```php
$notificationService->sendJobInvitationNotification($account, $jobTitle, $jobId, $schoolName);
```

### 11. Profile Update Reminder
```php
$notificationService->sendProfileUpdateReminderNotification($account);
```

### 12. School Contact Request
```php
$notificationService->sendSchoolContactRequestNotification($account, $schoolName);
```

### 13. Job Accepted Notification
```php
$notificationService->sendJobAcceptedNotification($account, $jobTitle, $schoolName, $position);
```

### 14. Premium Service Activated
```php
$notificationService->sendPremiumActivatedNotification($account, $featureName);
```

### 15. Wallet Recharged
```php
$notificationService->sendWalletRechargedNotification($account, $amount);
```

### 16. Wallet Low Balance
```php
$notificationService->sendWalletLowBalanceNotification($account, $balance);
```

### 17. Referral Success
```php
$notificationService->sendReferralSuccessNotification($account, $referredName, $referredType);
// $referredType can be 'candidate' or 'school'
```

### 18. Profile Completed
```php
$notificationService->sendProfileCompletedNotification($account);
```

### 19. New Review
```php
$notificationService->sendNewReviewNotification($account, $reviewerName);
```

## Employer Notifications

### 1. Welcome Notification
```php
$notificationService->sendEmployerWelcomeNotification($account);
```

### 2. Subscribe Plan Reminder
```php
$notificationService->sendSubscribePlanNotification($account);
```

### 3. Job Posted Successfully
```php
$notificationService->sendJobPostedNotification($account, $jobTitle, $jobId);
```

### 4. New Application Received
```php
$notificationService->sendNewApplicationNotification($account, $jobTitle, $jobId, $candidateName, $applicationId);
```

### 5. Contact Form Enquiry
```php
$notificationService->sendContactEnquiryNotification($account, $enquiryId);
```

### 6. Hiring Plan Activated
```php
$notificationService->sendHiringPlanActiveNotification($account, $planName);
```

### 7. Feature Activated
```php
$notificationService->sendFeatureActivatedNotification($account, $featureName);
```

### 8. Profile Complete Reminder
```php
$notificationService->sendProfileCompleteReminderNotification($account);
```

### 9. Wallet Recharged
```php
$notificationService->sendEmployerWalletRechargedNotification($account, $amount);
```

### 10. Wallet Low Balance
```php
$notificationService->sendEmployerWalletLowNotification($account, $balance);
```

### 11. Transaction Success
```php
$notificationService->sendTransactionSuccessNotification($account, $credits, $serviceName);
```

### 12. Login Success
```php
$notificationService->sendLoginSuccessNotification($account, $loginTime);
// $loginTime format: '6/March/2026, 04:00 PM'
```

### 13. Logout Summary
```php
$notificationService->sendLogoutSummaryNotification($account, $summary);
```

### 14. Profile Shortlisted by Employer
```php
$notificationService->sendProfileShortlistedByEmployerNotification($account, $jobTitle, $jobId);
```

### 15. Admission Enquiry
```php
$notificationService->sendAdmissionEnquiryNotification($account, $enquiryId);
```

### 16. Job Expiring Soon
```php
$notificationService->sendJobExpiringNotification($account, $jobTitle, $jobId, $daysLeft);
```

### 17. Job Expired
```php
$notificationService->sendJobExpiredNotification($account, $jobTitle, $jobId);
```

### 18. New Review Added
```php
$notificationService->sendEmployerNewReviewNotification($account, $candidateName);
```

## Integration Examples

### Example 1: After Job Application
```php
use Botble\JobBoard\Services\NotificationService;

// In your job application controller
$jobApplication = JobApplication::create([...]);

// Send notification to job seeker
if ($account && !$account->isEmployer()) {
    $notificationService = app(NotificationService::class);
    $notificationService->sendJobAppliedNotification(
        $account, 
        $job->name, 
        $job->id
    );
}

// Send notification to employer
if ($job->author) {
    $notificationService->sendNewApplicationNotification(
        $job->author,
        $job->name,
        $job->id,
        $account->full_name ?? $account->name,
        $jobApplication->id
    );
}
```

### Example 2: After Registration
```php
// In RegisterController after successful registration
$account = Account::create([...]);

$notificationService = app(NotificationService::class);
if ($account->isEmployer()) {
    $notificationService->sendEmployerWelcomeNotification($account);
} else {
    $notificationService->sendWelcomeNotification($account);
}
```

### Example 3: Profile Update Reminder (Scheduled Job)
```php
// In a scheduled command or job
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Services\NotificationService;

$accounts = Account::where('is_employer', false)
    ->where(function($query) {
        $query->whereNull('updated_at')
              ->orWhere('updated_at', '<', now()->subDays(90));
    })
    ->get();

$notificationService = app(NotificationService::class);
foreach ($accounts as $account) {
    // Check if profile is incomplete
    if (!$account->isProfileComplete()) {
        $notificationService->sendProfileUpdateReminderNotification($account);
    }
}
```

### Example 4: Job Expiring Reminder (Scheduled Job)
```php
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Services\NotificationService;

$jobs = Job::where('status', 'published')
    ->where('expire_date', '<=', now()->addDays(7))
    ->where('expire_date', '>', now())
    ->with('author')
    ->get();

$notificationService = app(NotificationService::class);
foreach ($jobs as $job) {
    if ($job->author) {
        $daysLeft = now()->diffInDays($job->expire_date);
        $notificationService->sendJobExpiringNotification(
            $job->author,
            $job->name,
            $job->id,
            $daysLeft
        );
    }
}
```

## Custom Notifications

You can also create custom notifications using the `createNotification` method:

```php
$notificationService->createNotification(
    $account,                    // Account instance
    'custom_type',              // Notification type
    'Custom Title',             // Title
    'Custom message here',      // Message
    route('public.account.dashboard'), // Action URL (optional)
    ['custom_data' => 'value'], // Additional data (optional)
    'feather-bell',             // Icon (optional, defaults based on type)
    '#1967d2'                   // Color (optional, defaults based on type)
);
```

## Notification Page

The notification page is available at:
- Route: `public.notifications`
- View: `platform/themes/jobzilla/views/notifications.blade.php`

Features:
- Filter by All/Unread/Read
- Mark as read
- Delete notifications
- Click to navigate to action URL
- Real-time badge counts

## API Routes

All notification routes are prefixed with `public.account.notifications`:

- `POST /account/notifications/read/{id}` - Mark notification as read
- `POST /account/notifications/mark-read/{id}` - Mark notification as read (alternative)
- `POST /account/notifications/mark-all-read` - Mark all as read
- `DELETE /account/notifications/delete/{id}` - Delete notification
- `DELETE /account/notifications/delete-all` - Delete all notifications
- `GET /account/notifications/count-unread` - Get unread count

## Error Handling

All notification methods are wrapped in try-catch blocks to prevent failures from breaking the main flow:

```php
try {
    $notificationService->sendWelcomeNotification($account);
} catch (\Exception $e) {
    \Log::error('Failed to send notification: ' . $e->getMessage());
    // Continue with normal flow
}
```

## Notes

1. All notifications are automatically sent via email
2. Notifications are stored in the `jb_user_notifications` table
3. Email failures are logged but don't break the application flow
4. Each notification type has default icons and colors
5. Notifications can include action URLs for navigation
6. Additional data can be stored in the `data` JSON field
