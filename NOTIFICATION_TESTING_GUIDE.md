# Notification Testing Guide

## Overview
This guide explains how to test all 14 employer notification types in the Teachers Recruiter platform.

## All Notification Types

1. **Welcome to Teachers Recruiter**
2. **Start your hiring by subscribing a hiring plan**
3. **You successfully posted a job for {job title}**
4. **New Application received for {job title} by {candidate name}**
5. **New contact form enquiry**
6. **Your Hiring Plan {Plan Name} is now active**
7. **You successfully active the {feature name} – Feature profile, admission enquiry service**
8. **Complete your profile**
9. **Wallet recharge successful**
10. **Wallet low balance**
11. **Transaction successful of {100} credits for {service name}**
12. **Successful login at 6/March/2026, 04:00 PM**
13. **Logout summary**
14. **You shortlisted a profile for {job title}**

## Testing Methods

### Method 1: Generate All Notifications at Once (Recommended)

1. **Login as Employer**
   - Go to: `http://127.0.0.1:8000/account/login`
   - Login with your employer account

2. **Generate All Notifications**
   - Open browser and go to: `http://127.0.0.1:8000/account/notifications/test`
   - This will create all 14 notifications at once
   - You'll see a JSON response with all created notifications

3. **View Notifications**
   - Go to: `http://127.0.0.1:8000/notifications`
   - You should see all 14 notifications displayed attractively

### Method 2: Generate Single Notification by Type

1. **Login as Employer**

2. **Generate Specific Notification**
   - Use this URL pattern: `http://127.0.0.1:8000/account/notifications/test/{type}`
   
   **Available Types:**
   - `welcome` - Welcome to Teachers Recruiter
   - `subscribe-plan` - Start your hiring by subscribing a hiring plan
   - `job-posted` - You successfully posted a job
   - `new-application` - New Application received
   - `contact-enquiry` - New contact form enquiry
   - `hiring-plan-active` - Your Hiring Plan is now active
   - `feature-activated` - You successfully active the feature
   - `complete-profile` - Complete your profile
   - `wallet-recharged` - Wallet recharge successful
   - `wallet-low` - Wallet low balance
   - `transaction-success` - Transaction successful
   - `login-success` - Successful login
   - `logout-summary` - Logout summary
   - `profile-shortlisted` - You shortlisted a profile

   **Example:**
   ```
   http://127.0.0.1:8000/account/notifications/test/welcome
   http://127.0.0.1:8000/account/notifications/test/job-posted
   ```

3. **View Notification**
   - Go to: `http://127.0.0.1:8000/notifications`
   - Check if the notification appears

### Method 3: Test Through Actual Actions

#### 1. Welcome Notification
- **Trigger:** When employer registers
- **Test:** Register a new employer account

#### 2. Subscribe Plan Notification
- **Trigger:** When employer visits packages page (can be triggered manually)
- **Test:** Call `sendSubscribePlanNotification()` method

#### 3. Job Posted Notification
- **Trigger:** When employer posts a job
- **Test:** 
  - Go to: `http://127.0.0.1:8000/account/jobs/create`
  - Fill the form and post a job
  - Check notifications page

#### 4. New Application Notification
- **Trigger:** When a candidate applies for a job
- **Test:**
  - Login as candidate
  - Apply for a job posted by employer
  - Login as employer and check notifications

#### 5. Contact Enquiry Notification
- **Trigger:** When someone submits contact form
- **Test:** Submit contact form

#### 6. Hiring Plan Active Notification
- **Trigger:** When employer subscribes to a plan
- **Test:** Subscribe to a hiring plan

#### 7. Feature Activated Notification
- **Trigger:** When employer activates a feature
- **Test:** Activate a feature (e.g., Feature Profile)

#### 8. Complete Profile Notification
- **Trigger:** When profile is incomplete (can be scheduled)
- **Test:** Call `sendProfileCompleteReminderNotification()` method

#### 9. Wallet Recharged Notification
- **Trigger:** When employer recharges wallet
- **Test:** Recharge wallet from account

#### 10. Wallet Low Balance Notification
- **Trigger:** When wallet balance goes below threshold
- **Test:** Use credits until balance is low

#### 11. Transaction Success Notification
- **Trigger:** When transaction is successful
- **Test:** Make a transaction (buy credits, post job, etc.)

#### 12. Login Success Notification
- **Trigger:** When employer logs in
- **Test:** Login to employer account

#### 13. Logout Summary Notification
- **Trigger:** When employer logs out
- **Test:** Logout from employer account

#### 14. Profile Shortlisted Notification
- **Trigger:** When employer shortlists a candidate profile
- **Test:** Shortlist a candidate profile

## Notification Page Features

### Visual Features:
- ✅ **Gradient Background** - Beautiful gradient background
- ✅ **Animated Icons** - Icons with shine effect on hover
- ✅ **Smooth Transitions** - All interactions have smooth animations
- ✅ **Color-coded** - Each notification type has unique color
- ✅ **Unread Highlight** - Unread notifications have special styling
- ✅ **Hover Effects** - Cards lift and highlight on hover
- ✅ **Responsive Design** - Works on all screen sizes

### Functional Features:
- ✅ **Filter Tabs** - All, Unread, Read
- ✅ **Mark as Read** - Click checkmark to mark as read
- ✅ **Delete** - Click trash icon to delete
- ✅ **Click to View** - Click notification to go to related page
- ✅ **Real-time Counts** - Badge counts update automatically

## Quick Test Checklist

- [ ] Login as employer
- [ ] Generate all notifications: `/account/notifications/test`
- [ ] Visit notifications page: `/notifications`
- [ ] Verify all 14 notifications are displayed
- [ ] Check unread notifications have blue highlight
- [ ] Test filter tabs (All, Unread, Read)
- [ ] Test mark as read functionality
- [ ] Test delete functionality
- [ ] Test click to navigate to action URL
- [ ] Check responsive design on mobile

## Troubleshooting

### Notifications not showing?
1. Check if you're logged in as employer
2. Check database table `jb_user_notifications` exists
3. Check logs: `storage/logs/laravel.log`
4. Verify route is accessible: `/account/notifications/test`

### Notifications page not loading?
1. Check route exists: `public.notifications`
2. Check controller: `JobzillaController@notifications`
3. Check view exists: `themes/jobzilla/views/notifications.blade.php`

### Styling issues?
1. Clear cache: `php artisan cache:clear`
2. Clear view cache: `php artisan view:clear`
3. Check browser console for errors

## API Response Format

When you call `/account/notifications/test`, you'll get:

```json
{
  "success": true,
  "message": "All 14 notifications generated successfully!",
  "notifications_count": 14,
  "notifications": [
    {
      "id": 1,
      "type": "employer_welcome",
      "title": "Welcome to Teachers Recruiter",
      "message": "Welcome to Teachers Recruiter! Start your hiring journey today."
    },
    ...
  ],
  "redirect_url": "http://127.0.0.1:8000/notifications"
}
```

## Notes

- Test routes are only accessible when logged in as employer
- Notifications are stored in `jb_user_notifications` table
- Each notification has unique icon and color
- Notifications can be marked as read/unread
- Notifications can be deleted individually or all at once
