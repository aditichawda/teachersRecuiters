# Credit Features – Full Flow (English) + What Goes Where & How It Is Stored

This document describes **flow only** – what happens at each step, how admin accepts requests, when credits are deducted – and **which fields/tables store what**. No implementation code here.

---

# Part 1: Flows in English

## 1. Invite Candidate to Apply for Job (Each Invite)

**Feature key:** `invite_candidate`  
**Credits:** 25 per invite (configurable in Admin → Credit Consumption)

### Flow (step-by-step)

| Step | Where | What happens |
|------|--------|----------------|
| 1 | Employer dashboard | Employer selects one **candidate** from job applications or candidate search for a **job**. |
| 2 | UI | "Invite to Apply" / "Invite Candidate" button is shown for that job + candidate. |
| 3 | Click | Employer clicks "Invite to Apply". |
| 4 | Backend | System checks: **account credits ≥ 25**. If not → error "Insufficient credits"; invite is not sent. |
| 5 | Backend | If enough credits: **deduct 25 credits** (debit row in `jb_transactions` with `feature_key` = `invite_candidate`). |
| 6 | Backend | Send **invite** to candidate: email/notification "You are invited to apply for [Job Title] by [Company]". Optional: link to job apply page. |
| 7 | DB (optional) | To track invites: store a row in a table like `jb_job_invites` (job_id, candidate_id/email, invited_by, invited_at). |
| 8 | UI | Success message: "Invite sent. 25 credits deducted." |

### Admin

- Only **credits per invite** are changed in Credit Consumption (e.g. 25 → 30). No "request accept" – invite is sent as soon as credits are deducted.
- Admin can see usage in `jb_transactions` (filter by `feature_key` = invite_candidate).

---

## 2. Multiple Login / Account Manage (Per Login)

**Feature key:** `multiple_login`  
**Credits:** 250 per (extra) login (configurable)

### Flow (step-by-step)

| Step | Where | What happens |
|------|--------|----------------|
| 1 | Employer dashboard / Settings | "Add Sub-Account" / "Multiple Login" / "Add Team Member" section. |
| 2 | Employer | Fills form: new user email, name, role (e.g. limited access). |
| 3 | Submit | System checks: **credits ≥ 250**. If not → "Insufficient credits. Need 250 for each additional login." |
| 4 | Backend | If enough → **deduct 250** (jb_transactions, feature_key = `multiple_login`). |
| 5 | Backend | Create new **sub-account** linked to same company/employer; send login credentials (email + set password / invite email). |
| 6 | DB | Sub-account stored in `jb_accounts` (e.g. linked via `parent_account_id` or `company_id`). |
| 7 | UI | Success: "Sub-account created. 250 credits deducted." |

### Admin

- Change **multiple_login** credits in Credit Consumption.
- See sub-accounts in Accounts/Companies; usage in `jb_transactions` (feature_key = multiple_login).

---

## 3. Dedicated Recruiter / Personal Account Manager (Per Month)

**Feature key:** `dedicated_recruiter`  
**Credits:** 5000 per month (configurable)

### Flow (step-by-step)

| Step | Where | What happens |
|------|--------|----------------|
| 1 | Employer dashboard / Wallet / Package | "Request Dedicated Recruiter" / "Personal Account Manager" option. |
| 2 | Employer | Clicks "Request" / "Subscribe (1 month)". |
| 3 | Backend | Check: **credits ≥ 5000**. If not → "Insufficient credits. Need 5000 for one month." |
| 4 | Option A – Instant activate | If enough → **deduct 5000** → set status "Dedicated Recruiter active till [date + 1 month]". Confirm to employer. |
| 5 | Option B – Request to Admin | If enough → create **request** (e.g. in table `jb_dedicated_recruiter_requests`: account_id, requested_at, status = pending). **Do not deduct yet.** Notify admin. |
| 6 | Admin | In admin panel: "Dedicated Recruiter Requests" list. Admin **Accepts** request. |
| 7 | Admin Accept | Backend: **deduct 5000** from that account → jb_transactions (feature_key = dedicated_recruiter). Set request status = accepted. Set valid_from / valid_till (1 month). Email employer: "Your Dedicated Recruiter is active from [date] to [date]." |
| 8 | Monthly renewal | Manual: same flow – employer or admin "Renew", then deduct 5000. Auto: cron/scheduler each month deducts 5000 and extends validity. |

### Admin

- Change **dedicated_recruiter** credits in Credit Consumption.
- If Option B: list of requests; Accept/Reject. Deduct only on Accept.
- History in jb_transactions (feature_key = dedicated_recruiter).

---

## 4. Post/Promote on LinkedIn/Other Social Page

**Feature key:** `social_promotion`  
**Credits:** 3000 per post/promotion (configurable)

### Flow (step-by-step)

| Step | Where | What happens |
|------|--------|----------------|
| 1 | Employer dashboard / Job / Company | "Promote on LinkedIn" / "Post on Social" / "Social Promotion" button (for a job or company profile). |
| 2 | Employer | Form: select job/profile, platform (LinkedIn / Other), optional message/copy, optional image. Submit. |
| 3 | Backend | Check: **credits ≥ 3000**. If not → "Insufficient credits. Need 3000 for social promotion." |
| 4 | Request create | If enough → create **request** (e.g. in `jb_social_promotion_requests`: account_id, job_id, platform, message, status = pending). **Do not deduct yet** – actual post is done by admin/team. |
| 5 | Admin | In admin panel: "Social Promotion Requests" list: employer, job, platform, message, date. |
| 6 | Admin action | Admin **Accepts** request → backend **deducts 3000** (jb_transactions, feature_key = social_promotion). Set request status = accepted. |
| 7 | Fulfillment | Admin/team actually posts on LinkedIn (or other platform) manually or via tool. Can set request status = "Posted" / "Completed". |
| 8 | Optional | Email employer: "Your social promotion request has been accepted and will be posted." / "Posted on [platform]." |

### Admin

- Change **social_promotion** credits in Credit Consumption.
- Social Promotion Requests: Pending → Accept (deduct) → Post manually → Mark complete.
- History in jb_transactions (feature_key = social_promotion).

---

## Summary Table (English)

| Feature | Trigger | Credit check | When deduct | Admin role |
|--------|---------|--------------|-------------|------------|
| **Invite Candidate** | Employer clicks "Invite to Apply" (per candidate per job) | ≥ 25 | Immediately (with invite) | Only credits config; no request accept |
| **Multiple Login** | Employer adds sub-account / team member | ≥ 250 | Immediately (with sub-account create) | Only credits config |
| **Dedicated Recruiter** | Employer requests "Dedicated Recruiter (1 month)" | ≥ 5000 | Option A: immediately; Option B: when admin Accepts | Option B: request list → Accept → deduct |
| **Social Promotion** | Employer submits "Promote on LinkedIn/Social" (job + details) | ≥ 3000 | When admin **Accepts** request (admin does the post) | Request list → Accept (deduct) → Post → Complete |

---

# Part 2: What Goes Where – Fields & Storage

Below: **which tables**, **which columns (fields)**, and **what data is stored** for each feature. Use this when creating migrations and saving data.

---

## Existing tables (already in project)

### 1. `jb_credit_consumption`

Stores **feature definition** and **credits per feature** (used for all four features).

| Column | Type | What is stored |
|--------|------|----------------|
| id | bigint PK | Auto. |
| account_type | string | `employer` or `job-seeker`. |
| feature_key | string(100) | e.g. `invite_candidate`, `multiple_login`, `dedicated_recruiter`, `social_promotion`. |
| feature_label | string(255) | Display name, e.g. "Invite Candidate to Apply for Job (each invite)". |
| credits | int | Cost per use (25, 250, 5000, 3000, etc.). |
| order | int | Display order. |
| status | string | e.g. `published`. |
| created_at, updated_at | timestamp | Usual. |

**Used for:** All four features – credits are read from here; no extra rows needed for these features.

---

### 2. `jb_transactions`

Stores **every credit debit** (and can store credit additions). Same structure for all features; `feature_key` tells which feature was used.

| Column | Type | What is stored |
|--------|------|----------------|
| id | bigint PK | Auto. |
| account_id | bigint FK | Employer account who used the feature. |
| account_type | string | e.g. `employer`. |
| feature_key | string(80) nullable | `invite_candidate`, `multiple_login`, `dedicated_recruiter`, `social_promotion`. |
| credits | int | Negative for debit (e.g. -25, -250, -5000, -3000). |
| payment_id | nullable | If linked to a payment. |
| package_id | nullable | If linked to a package. |
| description / meta | text/json | Optional description or extra data. |
| created_at, etc. | timestamp | Usual. |

**Used for:** All four features – one debit row per use, with the corresponding `feature_key`.

---

## New / optional tables (to be created if you implement)

### 3. `jb_job_invites` (Invite Candidate – optional tracking)

Stores **each invite** so you can avoid duplicate invites and show history.

| Column | Type | What is stored |
|--------|------|----------------|
| id | bigint PK | Auto. |
| job_id | bigint FK | Job for which invite was sent. |
| account_id | bigint FK | Employer who sent invite. |
| candidate_id | bigint FK nullable | Candidate account (if they have one). |
| email | string nullable | Candidate email if no account. |
| invited_at | timestamp | When invite was sent. |
| status | string | e.g. `sent`, `applied`, `expired`. |

**When to use:** When employer clicks "Invite to Apply" and you deduct 25 credits – optionally insert one row here and send email/notification.

---

### 4. `jb_accounts` (Multiple Login – use existing table, add columns)

Sub-accounts are **accounts** linked to a parent employer. Use existing `jb_accounts` and add a link to parent/company.

| Column | Type | What is stored |
|--------|------|----------------|
| (existing columns) | | id, name, email, password, type, etc. |
| parent_account_id | bigint FK nullable | **New.** Parent employer account_id. |
| company_id | bigint FK nullable | **Existing or new.** Company this sub-account belongs to. |
| role / permissions | string or json nullable | **Optional.** e.g. "view_only", "can_post_jobs". |

**When to use:** When employer adds sub-account and you deduct 250 credits – create a new row in `jb_accounts` with `parent_account_id` (and company_id) set, then send login/invite.

---

### 5. `jb_dedicated_recruiter_requests` (Dedicated Recruiter – Option B)

Stores **requests** when you use "request → admin accepts → then deduct" flow.

| Column | Type | What is stored |
|--------|------|----------------|
| id | bigint PK | Auto. |
| account_id | bigint FK | Employer who requested. |
| requested_at | timestamp | When request was created. |
| status | string | `pending`, `accepted`, `rejected`. |
| accepted_at | timestamp nullable | When admin accepted. |
| accepted_by | bigint nullable | Admin user id. |
| valid_from | date nullable | Start of 1-month period. |
| valid_till | date nullable | End of 1-month period. |

**When to use:** Employer clicks "Request Dedicated Recruiter" → insert row with status = pending. When admin Accepts → deduct 5000 in jb_transactions, update this row (status = accepted, accepted_at, valid_from, valid_till).

**Option A (instant):** No need for this table; only deduct 5000 and optionally store "active till" in a simple table or in account meta/settings.

---

### 6. `jb_social_promotion_requests` (Social Promotion)

Stores **promotion requests** until admin accepts and posts.

| Column | Type | What is stored |
|--------|------|----------------|
| id | bigint PK | Auto. |
| account_id | bigint FK | Employer who requested. |
| job_id | bigint FK nullable | Job to promote (if any). |
| company_id | bigint FK nullable | Company profile to promote (if any). |
| platform | string | e.g. `linkedin`, `other`. |
| message | text nullable | Copy/message for the post. |
| image_path | string nullable | Optional image for post. |
| status | string | `pending`, `accepted`, `posted`, `rejected`. |
| requested_at | timestamp | When employer submitted. |
| accepted_at | timestamp nullable | When admin accepted (and 3000 deducted). |
| accepted_by | bigint nullable | Admin user id. |
| posted_at | timestamp nullable | When admin marked as posted. |
| notes | text nullable | Admin notes (e.g. post URL). |

**When to use:** Employer submits "Promote on LinkedIn/Social" form → insert row with status = pending. Admin Accepts → deduct 3000 in jb_transactions, set accepted_at. After posting → set status = posted, posted_at, notes.

---

## Quick reference: What gets stored where

| Feature | Main storage | Extra table (optional/new) |
|---------|--------------|----------------------------|
| **Invite Candidate** | jb_transactions (debit, feature_key = invite_candidate) | jb_job_invites (one row per invite) |
| **Multiple Login** | jb_transactions (debit, feature_key = multiple_login) | jb_accounts (new row for sub-account; parent_account_id) |
| **Dedicated Recruiter** | jb_transactions (debit, feature_key = dedicated_recruiter) | jb_dedicated_recruiter_requests (if Option B) |
| **Social Promotion** | jb_transactions (debit, feature_key = social_promotion) | jb_social_promotion_requests (request + status + admin dates) |

---

# Part 3: Frontend se kya kya jayega & Admin Approve hone par kaise jayega

Yahan clearly likha hai: **frontend se backend tak kya data jayega** (form/API) aur **admin jab approve karega to kya hoga** (kya request jayegi, kya update hoga).

---

## 1. Invite Candidate (Admin approve nahi – turant deduct)

### Frontend se kya jayega

| Source | Data (fields) | Kaise jata hai |
|--------|----------------|----------------|
| Employer UI | `job_id`, `candidate_id` (ya `candidate_email`) | Button "Invite to Apply" click → POST/API call. Body: `{ "job_id": 5, "candidate_id": 12 }` ya `{ "job_id": 5, "email": "candidate@example.com" }`. |
| Optional | Custom message for invite | Form me optional text → `message` field. |

### Backend pe kya hota hai

1. Request aati hai → backend **credits check** karta hai (≥ 25).
2. Enough ho to **25 deduct** → `jb_transactions` me row (feature_key = `invite_candidate`).
3. **Invite bhejta hai** (email/notification). Optional: `jb_job_invites` me row (job_id, candidate_id, account_id, invited_at).
4. Response: success ya "Insufficient credits".

**Admin approve yahan nahi hota** – sirf Credit Consumption me credits change kar sakte hain.

---

## 2. Multiple Login (Admin approve nahi – turant deduct)

### Frontend se kya jayega

| Source | Data (fields) | Kaise jata hai |
|--------|----------------|----------------|
| Employer form | `email`, `name`, `role` (optional), `password` (ya "send invite" flag) | "Add Sub-Account" / "Add Team Member" form submit → POST. Body: `{ "email": "...", "name": "...", "role": "view_only", "send_invite": true }`. |

### Backend pe kya hota hai

1. Request aati hai → **credits check** (≥ 250).
2. Enough ho to **250 deduct** → `jb_transactions` (feature_key = `multiple_login`).
3. **Naya account** create → `jb_accounts` (email, name, parent_account_id = current employer, company_id). Password set ya invite email bhejo.
4. Response: success ya "Insufficient credits".

**Admin approve yahan nahi** – sirf Credit Consumption me credits.

---

## 3. Dedicated Recruiter (Option B – Admin Approve wala flow)

### Frontend (Employer) se kya jayega

| Source | Data (fields) | Kaise jata hai |
|--------|----------------|----------------|
| Employer UI | Sirf trigger – koi extra form nahi (ya optional note) | "Request Dedicated Recruiter (1 month)" button click → POST. Body: `{ "duration_months": 1 }` ya `{ "notes": "Need help for X role" }` (optional). |

### Backend pe request create hone par kya store hota hai

- **Table:** `jb_dedicated_recruiter_requests`
- **Columns:** `account_id` (logged-in employer), `requested_at` (now), `status` = `pending`, optional `notes`.
- **Credits abhi deduct nahi.**

### Admin panel me kya dikhega

- List: **Dedicated Recruiter Requests** – columns: Employer name, Email, Requested at, Status (Pending/Accepted/Rejected), Actions (Accept / Reject).

### Admin jab Accept kare – frontend (Admin) se kya jayega

| Source | Data (fields) | Kaise jata hai |
|--------|----------------|----------------|
| Admin UI | Request id + action | Accept button click → POST. Body: `{ "request_id": 7, "action": "accept" }`. Optional: `valid_from`, `valid_till` (ya backend auto 1 month set kare). |
| Reject | | Reject button → `{ "request_id": 7, "action": "reject", "reason": "..." }` (optional). |

### Backend jab admin Accept kare – kya hoga

1. Request aati hai: `request_id`, `action` = accept.
2. Backend **request row** nikalta hai (status = pending), **account_id** se employer milta hai.
3. **Credits check** (employer ke paas ≥ 5000).
4. **5000 deduct** → `jb_transactions` (feature_key = `dedicated_recruiter`, account_id = employer).
5. **Request update:** `status` = `accepted`, `accepted_at` = now, `accepted_by` = admin user id, `valid_from` = today, `valid_till` = today + 1 month.
6. **Email/notification** employer ko: "Your Dedicated Recruiter is active from [valid_from] to [valid_till]."
7. Response: success.

**Reject:** Request row me `status` = `rejected`, optional `rejected_at`, `rejected_by`. Employer ko optional email. **Deduction nahi.**

---

## 4. Social Promotion (Admin Approve wala flow)

### Frontend (Employer) se kya jayega

| Source | Data (fields) | Kaise jata hai |
|--------|----------------|----------------|
| Employer form | Job/profile, platform, message, optional image | "Promote on LinkedIn/Social" form submit → POST. Body: `{ "job_id": 10, "platform": "linkedin", "message": "We are hiring for...", "image": "<file ya URL>" }`. Optional: `company_id` agar company profile promote karna ho. |

### Backend pe request create hone par kya store hota hai

- **Table:** `jb_social_promotion_requests`
- **Columns:** `account_id`, `job_id` (ya company_id), `platform`, `message`, `image_path` (agar file upload), `status` = `pending`, `requested_at` = now.
- **Credits abhi deduct nahi.**

### Admin panel me kya dikhega

- List: **Social Promotion Requests** – columns: Employer, Job/Company, Platform, Message (short), Requested at, Status, Actions (Accept / Reject / View).

### Admin jab Accept kare – frontend (Admin) se kya jayega

| Source | Data (fields) | Kaise jata hai |
|--------|----------------|----------------|
| Admin UI | Request id + action | Accept button → POST. Body: `{ "request_id": 3, "action": "accept" }`. |
| Reject | | `{ "request_id": 3, "action": "reject", "reason": "..." }`. |

### Backend jab admin Accept kare – kya hoga

1. Request aati hai: `request_id`, `action` = accept.
2. Backend **request row** nikalta hai (status = pending), **account_id** se employer.
3. **Credits check** (≥ 3000).
4. **3000 deduct** → `jb_transactions` (feature_key = `social_promotion`).
5. **Request update:** `status` = `accepted`, `accepted_at` = now, `accepted_by` = admin user id.
6. **Email employer:** "Your social promotion request has been accepted. We will post on [platform] shortly."
7. Response: success.

Baad me admin actually post karke **status** = `posted` kar de (aur `posted_at`, `notes` me link daal de). Ye alag action ho sakta hai: "Mark as Posted" button → `{ "request_id": 3, "action": "mark_posted", "notes": "https://linkedin.com/..." }`.

**Reject:** `status` = `rejected`. **Deduction nahi.** Optional email to employer.

---

## Summary: Frontend → Backend & Admin Approve

| Feature | Frontend (Employer) se kya jata hai | Backend pe kya save (request table) | Admin se kya jata hai (Accept) | Admin Accept par backend kya kare |
|--------|-------------------------------------|--------------------------------------|---------------------------------|------------------------------------|
| **Invite Candidate** | job_id, candidate_id/email | – (no request table); turant jb_transactions + optional jb_job_invites | – | – |
| **Multiple Login** | email, name, role, send_invite | –; turant jb_transactions + jb_accounts (sub-account) | – | – |
| **Dedicated Recruiter (B)** | duration_months / notes (optional) | jb_dedicated_recruiter_requests (pending) | request_id, action=accept | Deduct 5000, update request (accepted, valid_from, valid_till), email employer |
| **Social Promotion** | job_id, platform, message, image | jb_social_promotion_requests (pending) | request_id, action=accept | Deduct 3000, update request (accepted), email employer; baad me mark_posted |

---

## Backend reference (same as before)

- **Get credits for feature:** `CreditConsumption::getCreditsForFeature('employer', feature_key)`
- **Deduct:** `CreditConsumption::deductForFeature($account, feature_key, $credits, $description)`
- **Transaction history:** Query `jb_transactions` filtered by `feature_key`.

Use this document to implement: first follow the flow, then add the trigger, deduction, and (where needed) the request tables and admin actions.

---

# Part 4: Implemented (Reference)

## Admin

- **Dedicated Recruiter Requests:** `Admin → Job Board → Dedicated Recruiter Requests`  
  Columns: Employer Name, Employer Id, Request Date, Duration, Staff, Status, Actions (Accept / Reject).  
  Accept = deduct 5000, set start_date/end_date (1 month), update status.

- **Social Promotion Requests:** `Admin → Job Board → Social Promotion Requests`  
  Columns: Employer, Title, Tag, Platform, Message, Status, Action (Accept / Reject).  
  Accept = deduct 3000, update status.

## Employer (API – frontend forms can POST to these)

| Feature | Method | Route name | Body (examples) |
|--------|--------|------------|------------------|
| Multiple Login (sub-account) | POST | public.account.team-members.store | email, name, role, password, password_confirmation |
| Dedicated Recruiter Request | POST | public.account.dedicated-recruiter-request.store | duration_months, company_id (optional), start_date, end_date, note |
| Social Promotion Request | POST | public.account.social-promotion-request.store | company_id, title, tag, platform, message, image |
| Invite Candidate | POST | public.account.invite-candidate.store | job_id, candidate_id (optional), email (optional – one required) |

Base URL for account routes: `/account/...` (e.g. POST `/account/team-members`). Employer must be logged in and credits system enabled.
