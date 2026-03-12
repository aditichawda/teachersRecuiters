# WhatsApp Notifications Integration Guide

## ✅ Successfully Integrated!

Ab **sabhi job seeker notifications** automatically **Email + WhatsApp** dono par bhej di jayengi!

## 🎯 How It Works

### Automatic Flow:
```
User Action (e.g., apply for job)
  ↓
NotificationService->createNotification() called
  ↓
1. Notification saved in database ✅
2. Email sent automatically ✅
3. WhatsApp sent automatically ✅ (NEW!)
```

## 📱 WhatsApp Integration Details

### Requirements:
1. ✅ **Phone Number** - Account mein phone number hona chahiye
2. ✅ **WhatsApp Available** - `is_whatsapp_available = true` hona chahiye
3. ✅ **MSG Club API** - Already configured (same API jo OTP ke liye use ho rahi hai)

### API Configuration:
- **API URL:** `config('services.msgclub.url')` ya `setting('whatsapp_api_url')`
- **Auth Key:** `config('services.msgclub.key')` ya `setting('whatsapp_api_key')`
- **Sender ID:** `setting('whatsapp_sender_id')`

## 📋 Supported Notifications (12/12)

### Job Seekers - WhatsApp Templates Needed:

1. ✅ **Welcome** - Template: `welcome_notification`
2. ✅ **Job Applied** - Template: `job_applied_notification`
3. ✅ **Job Saved** - Template: `job_saved_notification`
4. ✅ **Profile Shortlisted** - Template: `shortlist_application_for_job` (Already exists!)
5. ✅ **Application Not Selected** - Template: `application_reject_for_position` (Already exists!)
6. ✅ **Application Enquiry** - Template: `application_enquiry_notification`
7. ✅ **Profile Viewed** - Template: `profile_viewed_notification`
8. ✅ **Job Accepted** - Template: `job_accepted_notification`
9. ✅ **Wallet Recharged** - Template: `wallet_recharged_notification`
10. ✅ **Wallet Low Balance** - Template: `wallet_low_balance_notification`
11. ✅ **Profile Completed** - Template: `profile_completed_notification`
12. ✅ **New Review** - Template: `new_review_notification`

## 🔧 WhatsApp Template Setup

### Step 1: Create Templates in MSG Club Dashboard

Aapko MSG Club dashboard mein ye templates create karne honge:

#### Example Template Structure:

**Template Name:** `welcome_notification`
**Language:** English
**Category:** UTILITY
**Body:**
```
Hello {{1}}! Welcome to {{2}}. We're excited to help you find your dream teaching position.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Platform Name

**Template Name:** `job_applied_notification`
**Body:**
```
Hi {{1}}, your application for {{2}} has been submitted successfully!
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Job Title

**Template Name:** `job_saved_notification`
**Body:**
```
Hi {{1}}, you saved {{2}} job to view later.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Job Title

**Template Name:** `application_enquiry_notification`
**Body:**
```
Hi {{1}}, {{3}} has sent you an enquiry about your application for {{2}}.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Job Title
- {{3}} = School Name

**Template Name:** `profile_viewed_notification`
**Body:**
```
Hi {{1}}, your profile was viewed by {{2}}.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = School Name

**Template Name:** `job_accepted_notification`
**Body:**
```
Congratulations {{1}}! You've been accepted for {{2}} at {{3}}.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Job Title
- {{3}} = School Name

**Template Name:** `wallet_recharged_notification`
**Body:**
```
Hi {{1}}, your wallet has been recharged with {{2}}.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Amount (e.g., "100 credits")

**Template Name:** `wallet_low_balance_notification`
**Body:**
```
Hi {{1}}, your wallet balance is low ({{2}}). Please recharge to continue using services.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Balance (e.g., "50 credits")

**Template Name:** `profile_completed_notification`
**Body:**
```
Congratulations {{1}}! Your profile is now 100% complete.
```
**Parameters:**
- {{1}} = User Name

**Template Name:** `new_review_notification`
**Body:**
```
Hi {{1}}, you received a new review from {{2}}.
```
**Parameters:**
- {{1}} = User Name
- {{2}} = Reviewer Name

### Step 2: Template Approval

1. MSG Club dashboard mein templates create karo
2. Templates ko approve karne ke liye submit karo
3. Approval ke baad templates ready honge use ke liye

### Step 3: Update Template Names (Optional)

Agar aapko different template names use karni hain, to `NotificationService.php` mein `getWhatsAppTemplateName()` method update karo:

```php
protected function getWhatsAppTemplateName(string $type): ?string
{
    $templates = [
        self::TYPE_WELCOME => 'your_custom_template_name',
        // ... other templates
    ];
    return $templates[$type] ?? null;
}
```

## 🔍 How It Works Technically

### 1. Notification Creation:
```php
$notificationService->sendJobAppliedNotification($account, $jobTitle, $jobId);
```

### 2. Automatic WhatsApp Send:
- `createNotification()` method automatically calls `sendWhatsAppNotification()`
- Checks if phone number exists and WhatsApp is available
- Builds message parameters based on notification type
- Sends via MSG Club API

### 3. Error Handling:
- If WhatsApp fails, notification still works (email + in-app)
- Errors are logged but don't break the flow
- Try-catch blocks ensure stability

## 📊 Current Status

### ✅ Working:
- **Email notifications** - All 12 types working
- **In-app notifications** - All 12 types working
- **WhatsApp notifications** - Code ready, templates needed

### ⏳ Pending:
- **WhatsApp templates** - MSG Club dashboard mein create karni hongi
- **Template approval** - MSG Club se approve karwana hoga

## 🚀 Testing

### Test WhatsApp Notification:
1. User account mein phone number aur `is_whatsapp_available = true` set karo
2. Notification trigger karo (e.g., job apply)
3. Check logs: `storage/logs/laravel.log`
4. Look for: `[NOTIFICATION_WHATSAPP] ✓ WhatsApp notification sent successfully`

### Logs to Check:
```
[NOTIFICATION_WHATSAPP] ✓ WhatsApp notification sent successfully
  - notification_id: 123
  - account_id: 456
  - type: job_applied
  - template: job_applied_notification
  - phone: 919109459959
```

## ⚠️ Important Notes

1. **Templates must be approved** - MSG Club se approve hone ke baad hi kaam karengi
2. **Phone number required** - Account mein phone number hona chahiye
3. **WhatsApp available** - `is_whatsapp_available = true` hona chahiye
4. **Error handling** - WhatsApp fail hone par bhi email + in-app notifications kaam karengi
5. **Same API** - OTP ke liye jo API use ho rahi hai, wahi use ho rahi hai

## 📝 Template Parameters Reference

### Common Parameters:
- **{{1}}** - Usually User Name
- **{{2}}** - Usually Job Title / Amount / etc.
- **{{3}}** - Usually School Name / Additional Info

### Template-Specific:
- **Welcome:** {{1}} = Name, {{2}} = Platform
- **Job Applied:** {{1}} = Name, {{2}} = Job Title
- **Shortlisted:** {{1}} = Name, {{2}} = Job Title, {{3}} = School
- **Wallet:** {{1}} = Name, {{2}} = Amount/Balance

## 🎉 Result

**Ab sabhi notifications automatically Email + WhatsApp dono par bhej di jayengi!**

Bas MSG Club dashboard mein templates create karke approve karwana hai, phir sab automatically kaam karega!
