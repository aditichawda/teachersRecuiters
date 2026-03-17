# Credit Features – Pura Flow (Dedicated Recruiter, Social Promote, Invite Candidate, Multiple Login)

Yeh document **sirf flow / follow** batata hai – kaunsi step pe kya hoga, admin se request kaise accept hogi, credits kaise deduct honge. **Implementation code yahan nahi hai.**

---

## 1. Invite Candidate to Apply for Job (Each Invite)

**Feature key:** `invite_candidate`  
**Credits:** 25 per invite (Admin → Credit Consumption se change ho sakta hai)

### Flow (step-by-step)

| Step | Kahan | Kya hota hai |
|------|--------|----------------|
| 1 | Employer dashboard | Employer kisi **job** ke liye **candidate list** (job applications / candidate search) se ek candidate select karta hai. |
| 2 | UI | "Invite to Apply" / "Invite Candidate" button dikhta hai (us job + candidate ke liye). |
| 3 | Click | Employer "Invite to Apply" click karta hai. |
| 4 | Backend | System check karta hai: **account credits ≥ 25** (invite_candidate feature ke credits). Agar kam hai → error message "Insufficient credits", invite nahi hota. |
| 5 | Backend | Credits enough hone par: **25 credits deduct** (jb_transactions mein debit row, feature_key = `invite_candidate`). |
| 6 | Backend | Candidate ko **invite** bheja jata hai: email/notification "You are invited to apply for [Job Title] by [Company]". Optional: job apply page ka link. |
| 7 | DB (optional) | Agar invite track karna ho: table jaisa `jb_job_invites` (job_id, candidate_id/email, invited_by, invited_at) mein row. |
| 8 | UI | Success message: "Invite sent. 25 credits deducted." |

### Admin side

- **Credit Consumption** se sirf **credits per invite** change hote hain (e.g. 25 → 30). Koi "request accept" nahi – invite **turant** bhej diya jata hai jab credits deduct ho jayein.
- Admin **jb_transactions** se dekh sakta hai kaunse employer ne kab "Invite Candidate" use kiya (feature_key = invite_candidate).

### Short flow

```
Employer → Job/Candidate select → Invite to Apply click
  → Balance check (≥ 25) → Deduct 25 → Send invite (email/notification) → Success
```

---

## 2. Multiple Login / Account Manage (Per Login)

**Feature key:** `multiple_login`  
**Credits:** 250 per (extra) login (Admin se configurable)

### Flow (step-by-step)

| Step | Kahan | Kya hota hai |
|------|--------|----------------|
| 1 | Employer dashboard / Settings | "Add Sub-Account" / "Multiple Login" / "Add Team Member" section. |
| 2 | Employer | Form fill karta hai: naya user email, name, role (e.g. limited access). |
| 3 | Submit | System check: **credits ≥ 250**. Agar kam → "Insufficient credits. Need 250 for each additional login." |
| 4 | Backend | Credits enough → **250 deduct** (jb_transactions, feature_key = `multiple_login`). |
| 5 | Backend | Naya **sub-account** create hota hai (same company/employer se link), login credentials (email + set password / invite email) bheje jaate hain. |
| 6 | DB | Sub-account jb_accounts mein (e.g. parent_account_id / company_id se link). |
| 7 | UI | Success: "Sub-account created. 250 credits deducted." |

### Admin side

- **Credit Consumption** mein **multiple_login** ki credits (250) change kar sakte hain.
- Admin **Accounts** ya **Companies** se dekh sakta hai kaunse employer ke kitne sub-accounts hain. **jb_transactions** (feature_key = multiple_login) se kitni baar use hua.

### Short flow

```
Employer → Add Sub-Account / Team Member form → Submit
  → Balance check (≥ 250) → Deduct 250 → Create sub-account + send login → Success
```

---

## 3. Dedicated Recruiter / Personal Account Manager (Per Month)

**Feature key:** `dedicated_recruiter`  
**Credits:** 5000 per month (Admin se configurable)

### Flow (step-by-step)

| Step | Kahan | Kya hota hai |
|------|--------|----------------|
| 1 | Employer dashboard / Wallet / Package | "Request Dedicated Recruiter" / "Personal Account Manager" option. |
| 2 | Employer | "Request" / "Subscribe (1 month)" click karta hai. |
| 3 | Backend | Check: **credits ≥ 5000**. Agar kam → "Insufficient credits. Need 5000 for one month." |
| 4 | Option A – Turant activate | Credits enough → **5000 deduct** → status "Dedicated Recruiter active till [date + 1 month]". Employer ko confirmation. |
| 5 | Option B – Request to Admin | Credits enough → **request** create hoti hai (e.g. table `jb_dedicated_recruiter_requests`: account_id, requested_at, status = pending). **Credits abhi deduct nahi.** Admin ko notification. |
| 6 | Admin | Admin panel mein "Dedicated Recruiter Requests" list. Admin request **Accept** karta hai. |
| 7 | Admin Accept | Backend: us account se **5000 deduct** → jb_transactions (feature_key = dedicated_recruiter). Request status = accepted. Valid-from / valid-till (1 month) set. Employer ko email: "Your Dedicated Recruiter is active from [date] to [date]." |
| 8 | Monthly renewal | Agar renewal manual hai: same flow – employer ya admin "Renew" kare, phir 5000 deduct. Agar auto-renew hai: cron/scheduler har month check kare, auto 5000 deduct + validity extend. |

### Admin side

- **Credit Consumption** se **dedicated_recruiter** credits (5000) change.
- **Requests list** (agar Option B ho): Admin "Accept" / "Reject" kare. Accept par hi deduction.
- **jb_transactions** (feature_key = dedicated_recruiter) se history: kaun employer, kab subscribe/renew kiya.

### Short flow (Option A – direct)

```
Employer → Request Dedicated Recruiter (1 month) → Balance check (≥ 5000)
  → Deduct 5000 → Mark "Active till [+1 month]" → Success
```

### Short flow (Option B – admin approval)

```
Employer → Request Dedicated Recruiter → Request saved (pending), no deduction
  → Admin sees request → Admin Accepts → Deduct 5000 → Set validity 1 month → Notify employer
```

---

## 4. Post/Promote on LinkedIn/Other Social Page

**Feature key:** `social_promotion`  
**Credits:** 3000 per post/promotion (Admin se configurable)

### Flow (step-by-step)

| Step | Kahan | Kya hota hai |
|------|--------|----------------|
| 1 | Employer dashboard / Job / Company | "Promote on LinkedIn" / "Post on Social" / "Social Promotion" button (job ya company profile ke saath). |
| 2 | Employer | Form: job/profile select, platform (LinkedIn / Other), optional message/copy, optional image. Submit. |
| 3 | Backend | Check: **credits ≥ 3000**. Agar kam → "Insufficient credits. Need 3000 for social promotion." |
| 4 | Request create | Credits enough hone par **request** create hoti hai (e.g. `jb_social_promotion_requests`: account_id, job_id, platform, message, status = pending). **Credits abhi deduct nahi** – kyunki actual post admin/team karega. |
| 5 | Admin | Admin panel mein "Social Promotion Requests" list: employer, job, platform, message, date. |
| 6 | Admin action | Admin request **Accept** karta hai → backend **3000 deduct** (jb_transactions, feature_key = social_promotion). Request status = accepted. |
| 7 | Fulfillment | Admin / team actually LinkedIn (ya dusri platform) par post karte hain (manual ya tool). Request status = "Posted" / "Completed" kar sakte hain. |
| 8 | Optional | Employer ko email: "Your social promotion request has been accepted and will be posted." / "Posted on [platform]." |

### Admin side

- **Credit Consumption** se **social_promotion** credits (3000) change.
- **Social Promotion Requests** list: Pending → Accept (deduct) → Post manually → Mark complete.
- **jb_transactions** (feature_key = social_promotion) se history.

### Short flow

```
Employer → Promote on LinkedIn/Social form (job + details) → Submit
  → Request saved (pending), no deduction
  → Admin sees request → Admin Accepts → Deduct 3000 → Admin/team posts on social → Mark complete → Notify employer
```

---

## Summary Table

| Feature | Trigger | Credit check | Deduct kab | Admin role |
|--------|---------|--------------|------------|------------|
| **Invite Candidate** | Employer clicks "Invite to Apply" (per candidate per job) | ≥ 25 | Turant (invite ke saath) | Sirf credits config; koi request accept nahi |
| **Multiple Login** | Employer adds sub-account / team member | ≥ 250 | Turant (sub-account create ke saath) | Sirf credits config |
| **Dedicated Recruiter** | Employer requests "Dedicated Recruiter (1 month)" | ≥ 5000 | Option A: turant; Option B: jab admin Accept kare | Option B: request list → Accept → deduct |
| **Social Promotion** | Employer submits "Promote on LinkedIn/Social" (job + details) | ≥ 3000 | Jab admin request **Accept** kare (post admin karega) | Request list → Accept (deduct) → Post → Complete |

---

## Common Backend Points (reference)

- **Credits check:** `CreditConsumption::getCreditsForFeature('employer', feature_key)`
- **Deduct:** `CreditConsumption::deductForFeature($account, feature_key, $credits, $description)`
- **Transaction:** jb_transactions mein `feature_key` se filter karke history dekh sakte ho.

Is document ke hisaab se baad mein functionality implement ki ja sakti hai – pehle ye flow follow karo, phir code mein trigger + deduct + (jahan chahiye) request table + admin actions add karo.
