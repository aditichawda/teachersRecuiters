# Job Board – Tables Reference (Job Seeker & Employer)

Yeh document batata hai ki **registration, login aur saari details** kaun‑kaun si table me store hoti hain.

---

## 1. Registration & Login (dono Job Seeker + Employer)

| Table | Purpose | Kya store hota hai |
|-------|---------|---------------------|
| **jb_accounts** | Main account table (Job Seeker + Employer dono) | Email, password (hashed), first_name, last_name, full_name, phone, type (job-seeker/employer), registration_type, email_verified_at, phone_verified_at, confirmed_at, remember_token, credits, avatar_id, dob, gender, address, bio, resume, **introductory_audio** (job seeker self-intro audio URL), **introductory_audio_duration** (seconds), **introductory_video_url** (e.g. YouTube), cover_letter, salary fields, location (country_id, state_id, city_id), institution_name, teaching_subjects, qualifications, skills, languages, is_public_profile, profile_views, unique_id, job_post_credits_balance, profile_view_credits_balance, verification/OTP fields, created_at, updated_at, etc. |
| **jb_account_password_resets** | Password reset (forgot password) | email, token, created_at – password reset link ke liye token |
| **sessions** (Laravel default) | Login session | User browser session – login state (session_id, user_id/payload, ip_address, etc.) – agar driver `database` hai to `sessions` table use hoti hai |

**Auth config:** Job Seeker / Employer login **guard = `account`**, **provider = `accounts`** (model = `Botble\JobBoard\Models\Account` → table `jb_accounts`).

---

## 2. Employer-specific (Institution / Company)

| Table | Purpose | Kya store hota hai |
|-------|---------|---------------------|
| **jb_companies** | Employer ki company/institution profile | name, email, phone, logo, description, content, address, country_id, state_id, city_id, website, year_founded, status, is_featured, cover_image, social links, verification fields, etc. |
| **jb_companies_accounts** | Employer ↔ Company link (many-to-many) | company_id, account_id – ek employer multiple companies se link ho sakta hai |
| **jb_account_activity_logs** | Account activity (create job, update company, etc.) | account_id, action, reference_url, reference_name, user_agent, ip_address |

---

## 3. Job Seeker – Education, Experience, Languages, Skills

| Table | Purpose | Kya store hota hai |
|-------|---------|---------------------|
| **jb_account_educations** | Job seeker education | account_id, degree, school, major, start_date, end_date, description, etc. |
| **jb_account_experiences** | Job seeker work experience | account_id, company, position, start_date, end_date, description, etc. |
| **jb_account_languages** | Job seeker languages | account_id, language level, etc. |
| **jb_account_favorite_skills** | **User (job seeker) skills** | account_id, skill_id → user jo skills select karta hai (Account Settings → Key Skills & Competencies) yahan store hoti hain; skill_id **jb_job_skills** se aata hai |
| **jb_account_favorite_tags** | Favorite tags | account_id, tag_id |
| **jb_job_skills** | Master list of skills | id, name (admin add karta hai); dropdown/list isi se banta hai |
| **jb_job_skills_translations** | Skill names (multi-language) | lang_code, jb_job_skills_id, name |

---

## 4. Jobs, Applications, Saved Jobs

| Table | Purpose | Kya store hota hai |
|-------|---------|---------------------|
| **jb_jobs** | Job posts (employer create karta hai) | name, description, company_id, author_id, author_type, address, country_id, state_id, city_id, salary, status, moderation_status, is_featured, expire_date, apply_url, screening questions ref, apply_internal_emails, apply_internal_phones, enable_whatsapp_notifications, etc. |
| **jb_applications** | Job applications (apply karte waqt) | job_id, account_id (agar logged in), first_name, last_name, email, phone, message, resume, cover_letter, status, screening_answers, etc. |
| **jb_saved_jobs** | Job seeker saved jobs | account_id, job_id |

---

## 5. Package, Transaction, Coins (Credits) – Sare details

### 5.1 Package (Plan) – **jb_packages**

| Column | Type | Kya store hota hai |
|--------|------|---------------------|
| id | bigint | Primary key |
| name | string(120) | Package name (e.g. "Basic", "Premium") |
| description | string(400) nullable | Short description |
| price | double | Package price |
| currency_id | FK | jb_currencies se link |
| percent_save | int | Discount % (e.g. 10) |
| number_of_listings | int | Kitni job posts package me (e.g. 5, 10) |
| order | tinyint | Display order |
| account_limit | int nullable | Max accounts (optional) |
| is_default | tinyint | Default package flag |
| features | text/json nullable | Package features (JSON) |
| status | string(60) | published / etc. |
| package_type | string(30) | employer / job-seeker |
| validity_days | int nullable | Package kitne din valid (e.g. 365) |
| credits_included | int nullable | Kitne credits package ke sath (e.g. 1000) |
| profile_views_allowed | int nullable | Kitne profile views allowed (employer) |
| worth | decimal nullable | “Worth” display value |
| created_at, updated_at | timestamp | |

**Translations:** **jb_packages_translations** – lang_code, jb_packages_id, name, description, features (multi-language).

---

### 5.2 Account ↔ Package link – **jb_account_packages**

| Column | Kya store hota hai |
|--------|---------------------|
| id | Primary key |
| account_id | Kis account ne liya |
| package_id | Kaun sa package |
| created_at, updated_at | |

(Yeh pivot hai – kaun account ne kab kaun sa package purchase kiya; direct “current package” jb_accounts.credits + jb_transactions se derive hota hai.)

---

### 5.3 Coins / Credits – Transaction – **jb_transactions**

Har credit add ya deduct isi table me row banata hai.

| Column | Type | Kya store hota hai |
|--------|------|---------------------|
| id | bigint | Primary key |
| credits | int | Kitne credits add/deduct |
| description | string(400) nullable | Text description (e.g. "Purchased credits", "Used for Featured Job") |
| type | string | **add** (credit) ya **deduct** (debit) |
| user_id | FK nullable | Admin ne add kiye to admin user_id |
| account_id | FK nullable | Kis account ke credits |
| account_type | string(50) nullable | employer / job_seeker |
| feature_key | string nullable | Kaun si feature pe use (e.g. featured_job, application_alert_wp, job_posting, admission_enquiry) |
| meta | json nullable | Extra data (e.g. job_id, application_id) |
| user_details | json nullable | Name, email, phone, address (purchase time) |
| institution_name | string nullable | Employer institution name |
| payment_id | FK nullable | Payment record (payment plugin) |
| package_id | FK nullable | Kis package se credits (purchase) |
| package_name | string nullable | Package name (display) |
| created_at, updated_at | timestamp | |

**Use:** Package purchase = type **add**, package_id set, account_id + credits. Feature use (e.g. Featured Job, WhatsApp alert) = type **deduct**, feature_key set.

---

### 5.4 Feature-wise credit cost – **jb_credit_consumption**

Har feature (e.g. job post, featured job, WhatsApp alert) ke liye kitne credits lagte hain – isi table me.

| Column | Type | Kya store hota hai |
|--------|------|---------------------|
| id | bigint | Primary key |
| account_type | string(30) | employer / job-seeker |
| feature_key | string(100) | e.g. job_posting, featured_job, application_alert_wp, application_alert_email, additional_employer_profile, admission_enquiry |
| feature_label | string(255) | Display label (e.g. "New Application Alert by WhatsApp (per alert)") |
| credits | int | Kitne credits is feature ke liye |
| order | tinyint | Display order |
| status | string(60) | published |
| created_at, updated_at | timestamp | |

---

### 5.5 Currency – **jb_currencies**

Package price kis currency me hai – isi table se.

| Column | Kya store hota hai |
|--------|---------------------|
| id, title, symbol, is_prefix_symbol, decimals, order, is_default, exchange_rate, timestamps |

---

### 5.6 Invoice (Payment receipt) – **jb_invoices**

Package/credits purchase pe invoice generate hoti hai.

| Column | Type | Kya store hota hai |
|--------|------|---------------------|
| id | bigint | Primary key |
| reference_type, reference_id | morphs | Invoice kis cheez ke liye (e.g. Package, Payment) |
| code | string unique | Invoice code (e.g. INV-001) |
| customer_name | string | Customer name |
| company_name | string nullable | Company/institution name |
| customer_email | string | Email |
| customer_phone | string nullable | Phone |
| customer_address | string nullable | Address |
| customer_tax_id | string nullable | GST/tax ID |
| customer_gst_number | string nullable | (migration se add) |
| sub_total | decimal | Subtotal |
| tax_amount | decimal | Tax |
| shipping_amount | decimal | Shipping (if any) |
| discount_amount | decimal | Discount |
| amount | decimal | Total amount |
| payment_id | FK nullable | Payment record |
| status | string | pending / paid / etc. |
| paid_at | timestamp nullable | Kab pay hua |
| created_at, updated_at | timestamp | |

---

### 5.7 Invoice items – **jb_invoice_items**

Ek invoice me kitne line items (e.g. 1 package, 1 add-on).

| Column | Kya store hota hai |
|--------|---------------------|
| id, invoice_id, reference_type, reference_id, name, description, image, qty, sub_total, tax_amount, discount_amount, amount, metadata, timestamps |

---

### 5.8 Account me coins balance – **jb_accounts** (relevant columns)

| Column | Kya store hota hai |
|--------|---------------------|
| credits | int | Current total credits (wallet balance) |
| job_post_credits_balance | int nullable | Pre-purchased job post slots (credits se buy kiye) |
| profile_view_credits_balance | int nullable | Pre-purchased profile view slots |
| package_id | FK nullable | (Agar use ho to) last/current package reference |

Balance **jb_transactions** se calculate bhi ho sakta hai; often **jb_accounts.credits** hi source of truth hota hai (purchase pe add, use pe deduct + transaction row).

---

## 6. Other (Categories, Invoices, Reviews, etc.)

| Table | Purpose |
|-------|---------|
| **jb_categories** | Job categories |
| **jb_jobs_categories** | Job ↔ Category (pivot) |
| **jb_account_candidate_views** | Employer ne kaun‑kaun se candidates view kiye (profile view count) |
| **jb_job_alerts** | Job seeker job alerts |
| **jb_user_notifications** | User/account notifications |
| **jb_account_password_resets** | Password reset tokens (section 1) |
| **jb_coupons** | Coupon codes (discount) |

---

## Short summary

- **Registration / Login / Profile (dono Job Seeker + Employer):**  
  → **jb_accounts**, **jb_account_password_resets**, **sessions**.

- **Employer extra:**  
  → **jb_companies**, **jb_companies_accounts**, **jb_account_activity_logs**.

- **Job Seeker extra:**  
  → **jb_account_educations**, **jb_account_experiences**, **jb_account_languages**, **jb_account_favorite_skills**, **jb_account_favorite_tags**.

- **Jobs & Apply:**  
  → **jb_jobs**, **jb_applications**, **jb_saved_jobs**.

- **Package, Transaction, Coins (sare details):**  
  → **jb_packages** + **jb_packages_translations** (plan name, price, validity_days, number_of_listings, credits_included, profile_views_allowed, features).  
  → **jb_account_packages** (account–package link).  
  → **jb_transactions** (har credit add/deduct, type, feature_key, package_id, payment_id, user_details).  
  → **jb_credit_consumption** (feature_key wise credit cost).  
  → **jb_currencies** (price currency).  
  → **jb_invoices** + **jb_invoice_items** (invoice + line items).  
  → **jb_accounts.credits** (current coin balance).

Yahi tables use karke register, login, package, transaction aur coin detail store ki jati hain.
