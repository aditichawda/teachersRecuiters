# Employer Credit Consumption – Features, Tables, UI

Sab employer features jinke liye credits deduct hote hain: **feature key**, **credits**, **kahan use hota hai**, **kaunsi table**, **storage**.

---

## 1. Table: `jb_credit_consumption`

**Kya store hota hai:** Har feature ke liye `account_type`, `feature_key`, `feature_label`, `credits`, `order`, `status`.

**Kahan dikhta hai:** Admin → **Job Board → Credit Consumption**. Wallet page par employer ko “Credit / Debit Information” list mein feature + credits dikhte hain.

**Kaise add/edit:** Admin isi table mein rows add karta hai (Create/Edit). Migration `2026_03_05_100000_seed_employer_credit_consumption_features` 14 employer features seed karti hai.

---

## 2. Table: `jb_transactions`

**Kya store hota hai:** Har **debit** (credit use) par ek row: `account_id`, `credits`, `type = 'deduct'`, `description`, `created_at`.

**Kahan dikhta hai:** Employer **Wallet** page par “Consumption Report” table: Date, Type, Package, Amount (coins), Current Balance.

---

## 3. Feature-wise detail

| # | Feature Key | Credits | Kahan use / trigger | Kaunsi table (extra) | Storage / Notes |
|---|-------------|---------|----------------------|----------------------|-----------------|
| 1 | **job_posting** | 600 | Job create (jab package slot khatam) | - | `jb_transactions`: debit; job `jb_jobs` mein save. Package slot pehle, phir credit. |
| 2 | **featured_job** | 250 | Job create/edit par “Featured” enable | `jb_jobs.is_featured` | Deduct jab employer “Featured” check kare; transaction + `is_featured = 1`. |
| 3 | **application_alert_wp** | 10 | Har naya application aane par WhatsApp alert bhejne par | - | `SendEmployerApplicationNotificationJob` / alert send logic: har alert pe 10 deduct. |
| 4 | **application_alert_email** | 100 | Additional email par “one time” application alert enable | - | Settings/job par “Add alert email” + one-time enable: 100 deduct, transaction. |
| 5 | **candidate_profile_view** | 25 | Candidate profile open (package limit ke baad, unique view) | `jb_account_candidate_views` | 1 view = 1 row (account_id, candidate_id). Same candidate dobara = count nahi. Debit 25. |
| 6 | **invite_candidate** | 25 | Candidate ko job ke liye invite | - | Invite API/action: 25 deduct per invite, transaction. |
| 7 | **featured_profile_employer** | 500 | Employer featured profile (photos, YouTube) – time as per plan | Company/settings | Package validity se control; 500 = activation/extension. Transaction + feature flag. |
| 8 | **multiple_login** | 250 | Har additional login/sub-account | - | Sub-account create: 250 deduct per new login. |
| 9 | **admission_enquiry** | 500 | Admission section use (time as per plan) | - | Package + lock; 500 for access/extension. `AdmissionAccountController` + transaction. |
| 10 | **additional_employer_profile** | 500 | Har naya employer profile (e.g. extra company) | `jb_companies` / account-company | New profile create: 500 deduct. |
| 11 | **job_posting_assistance** | 250 | Job post assistance request | - | “Assistance” request submit: 250 deduct. |
| 12 | **walkin_drive_ad** | 2500 | Walk-in / Drive ad – Home + Job listing page | Ad slot table / settings | Ad book/renew: 2500 deduct. |
| 13 | **dedicated_recruiter** | 5000 | Dedicated recruiter / account manager (per month) | - | Monthly subscription: 5000 deduct per month. |
| 14 | **social_promotion** | 3000 | LinkedIn/social par post/promote | - | “Promote on social” request: 3000 deduct. |

---

## 4. Code usage

- **Credits get karna:**  
  `CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_JOB_POSTING, 600)`
- **Deduct karna:**  
  `CreditConsumption::deductForFeature($account, CreditConsumption::FEATURE_JOB_POSTING, $credits, $description);`
- **Feature constants:**  
  `CreditConsumption::FEATURE_*` (e.g. `FEATURE_FEATURED_JOB`, `FEATURE_INVITE_CANDIDATE`).

---

## 5. Ab implement ho chuka

- **job_posting (600):** Job create – package slot ke baad credit deduct. Create + store dono mein check.
- **candidate_profile_view (25):** Profile view – package limit ke baad 25 deduct; same candidate = 1 count. `PackageContext` + `PublicController::getCandidate()`.

Baaki features ke liye same pattern: jahan action trigger ho (button/API/scheduler), wahan `getCreditsForFeature` se amount lo, balance check karo, `deductForFeature` call karo, phir feature logic chalao.
