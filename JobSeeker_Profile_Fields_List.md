# Job Seeker Profile – Fields List & Database Storage

Profile me jo fields hain aur database me kis **table** / **column** me store ho rahe hain.

---

## 1. ABOUT ME section – kaha store, store ho raha hai?

| Profile section | Form field name | Table | Column | Store ho raha hai? |
|-----------------|-----------------|-------|--------|--------------------|
| **About Me** (Teaching Philosophy / Career Objective / Key Strengths) | `bio` | **jb_accounts** | `bio` | **Haan** – SettingRequest me `bio` validate hai, Account fillable me hai, postSettings me `$data` se save hota hai |

**Detail:** Form me "About Me" wala text editor `Form::customEditor('bio', ...)` use karta hai, isliye form name = `bio`. Ye value **jb_accounts.bio** column me save hoti hai. Koi alag table nahi.

---

## 2. JOB PREFERENCES section – kaha store, store ho raha hai?

Sab **jb_accounts** table me hi store hota hai. Har field ke liye:

| Profile field (Job Preferences) | Form field name | Table | Column | Store ho raha hai? |
|----------------------------------|-----------------|-------|--------|--------------------|
| Preferred Institution Type | `institution_types[]` | jb_accounts | `institution_types` (JSON array) | **Haan** |
| Position Type (Teaching / Non-teaching) | `position_type[]` | jb_accounts | `position_type` (comma string) | **Haan** |
| Teaching Subjects | `teaching_subjects[]` | jb_accounts | `teaching_subjects` (JSON array) | **Haan** |
| Non-Teaching Positions | `non_teaching_positions[]` | jb_accounts | `non_teaching_positions` (JSON array) | **Haan** |
| Job Type Preferences (Full-time, Part-time, etc.) | `job_type_preferences[]` | jb_accounts | `job_type_preferences` (JSON array) | **Haan** |
| Remote Only | `remote_only` | jb_accounts | `remote_only` | **Haan** |

**Detail:** SettingRequest me job seeker ke liye ye sab rules hain; `$request->validated()` se `$data` me aate hain, phir `$model->fill($data)->save()` se **jb_accounts** me save ho jate hain. Koi alag table nahi – sab jb_accounts ke columns.

---

## 3. LOCATION section – kaha store, store ho raha hai?

Sab **jb_accounts** table me hi store hota hai. Do hisse hain: **Current Location** aur **Native / Work location preferences**.

### Current Location

| Profile field | Form field name | Table | Column | Store ho raha hai? |
|---------------|-----------------|-------|--------|--------------------|
| City | `city_id` | jb_accounts | `city_id` | **Haan** |
| State | `state_id` | jb_accounts | `state_id` | **Haan** |
| Country | `country_id` | jb_accounts | `country_id` | **Haan** |
| Address | `address` | jb_accounts | `address` | **Haan** |
| Pin Code | `pin_code` | jb_accounts | `pin_code` | **Haan** |
| (Optional: locality, country_name, state_name, city_name) | `locality`, `country_name`, `state_name`, `city_name` | jb_accounts | `locality`, `country_name`, `state_name`, `city_name` | **Haan** (validation me hain, fillable me hain) |

### Native Location

| Profile field | Form field name | Table | Column | Store ho raha hai? |
|---------------|-----------------|-------|--------|--------------------|
| Native same as current | `native_same_as_current` | jb_accounts | `native_same_as_current` | **Haan** |
| Native City | `native_city_id` | jb_accounts | `native_city_id` | **Haan** |
| Native State | `native_state_id` | jb_accounts | `native_state_id` | **Haan** |
| Native Country | `native_country_id` | jb_accounts | `native_country_id` | **Haan** |
| Native Locality | `native_locality` | jb_accounts | `native_locality` | **Haan** |
| Native Address | `native_address` | jb_accounts | `native_address` | **Haan** |
| Native Pin Code | `native_pin_code` | jb_accounts | `native_pin_code` | **Haan** |
| (Optional: native_country_name, native_state_name, native_city_name) | — | jb_accounts | `native_country_name`, `native_state_name`, `native_city_name` | **Haan** |

### Work location preference (kahan kaam karna chahte ho)

| Profile field | Form field name | Table | Column | Store ho raha hai? |
|---------------|-----------------|-------|--------|--------------------|
| Preference type (Current only / Relocation India / Other) | `work_location_preference_type` | jb_accounts | `work_location_preference_type` | **Haan** |
| Preferred locations list (country, state, city, locality) | `work_location_preferences[i][country_id]`, `[state_id]`, `[city_id]`, `[country_name]`, `[state_name]`, `[city_name]`, `[locality]` | jb_accounts | `work_location_preferences` (JSON array) | **Haan** – Controller me normalize karke save hota hai |

**Detail:** Location ka koi alag table nahi. Current location, native location, aur work location preferences sab **jb_accounts** ke columns / JSON column me store hote hain. Form submit pe sab validate aur save ho rahe hain.

---

## Table: **jb_accounts** (sabse zyada fields yahi)

| # | Profile field (form pe dikhne wala) | Form field name | Database column name |
|---|-------------------------------------|-----------------|----------------------|
| 1 | Full Name | first_name | first_name, full_name |
| 2 | Email (read-only) | — | email |
| 3 | Phone Number | phone | phone |
| 4 | This number is WhatsApp | is_whatsapp_available | is_whatsapp_available |
| 5 | Alternate Phone | alternate_phone | alternate_phone |
| 6 | Alternate on WhatsApp | is_alternate_whatsapp_available | is_alternate_whatsapp_available |
| 7 | Date of Birth | dob | dob |
| 8 | Gender | gender | gender |
| 9 | Marital Status | marital_status | marital_status |
| 10 | Profile Visibility | profile_visibility | profile_visibility |
| 11 | Hide Resume | hide_resume | hide_resume |
| 12 | Hide name for Employer | hide_name_for_employer | hide_name_for_employer |
| 13 | Current Work Status | current_work_status | current_work_status |
| 14 | Available for Immediate Joining | available_for_immediate_joining | available_for_immediate_joining |
| 15 | Notice Period | notice_period | notice_period |
| 16 | Current Salary | current_salary | current_salary |
| 17 | Current Salary Period | current_salary_period | current_salary_period |
| 18 | Expected Salary | expected_salary | expected_salary |
| 19 | Expected Salary Period | expected_salary_period | expected_salary_period |
| 20 | About Me / Bio | bio | bio |
| 21 | Preferred Institution Type | institution_types[] | institution_types |
| 22 | Position Type (Teaching/Non-teaching) | position_type[] | position_type |
| 23 | Teaching Subjects | teaching_subjects[] | teaching_subjects |
| 24 | Non-Teaching Positions | non_teaching_positions[] | non_teaching_positions |
| 25 | Job Type Preferences | job_type_preferences[] | job_type_preferences |
| 26 | Remote Only | remote_only | remote_only |
| 27 | Current Location – City | city_id | city_id |
| 28 | Current Location – State | state_id | state_id |
| 29 | Current Location – Country | country_id | country_id |
| 30 | Address | address | address |
| 31 | Pin Code | pin_code | pin_code |
| 32 | Native same as current | native_same_as_current | native_same_as_current |
| 33 | Native City | native_city_id | native_city_id |
| 34 | Native State | native_state_id | native_state_id |
| 35 | Native Country | native_country_id | native_country_id |
| 36 | Native Locality | native_locality | native_locality |
| 37 | Native Address | native_address | native_address |
| 38 | Native Pin Code | native_pin_code | native_pin_code |
| 39 | Work location preference type | work_location_preference_type | work_location_preference_type |
| 40 | Preferred work locations (list) | work_location_preferences[i][country_id], [state_id], [city_id], [country_name], [state_name], [city_name], [locality] | work_location_preferences |
| 41 | Qualification – Level | qualifications[i][level] | qualifications |
| 42 | Qualification – Specialization | qualifications[i][specialization] | qualifications |
| 43 | Qualification – Institution | qualifications[i][institution] | qualifications |
| 44 | Teaching Certifications | teaching_certifications[] | teaching_certifications |
| 45 | Total Experience | total_experience | total_experience |
| 46 | Languages (language + proficiency) | languages[i][language], languages[i][proficiency] | languages |
| 47 | Resume (file) | resume | resume |
| 48 | Resume parsing allowed | resume_parsing_allowed | resume_parsing_allowed |
| 49 | Cover Letter (file) | cover_letter | cover_letter |
| 50 | Introductory Audio (file) | introductory_audio | introductory_audio, introductory_audio_duration |
| 51 | Introductory Video URL | introductory_video_url | introductory_video_url |
| 52 | LinkedIn | social_links[linkedin] | social_links |
| 53 | Facebook | social_links[facebook] | social_links |

---

## Table: **jb_account_favorite_skills** (skills list)

| # | Profile field | Form field name | Database storage |
|---|---------------|-----------------|-------------------|
| 54 | Favorite Skills | favorite_skills | account_id, skill_id (har skill ke liye ek row) |

---

## Table: **jb_account_favorite_tags** (tags list)

| # | Profile field | Form field name | Database storage |
|---|---------------|-----------------|-------------------|
| 55 | Favorite Tags | favorite_tags | account_id, tag_id (har tag ke liye ek row) |

---

## Alag tables (profile settings form se nahi, alag pages se bharate hain)

| Table | Kya store hota hai | Kaise bharate hain |
|-------|--------------------|--------------------|
| **jb_account_educations** | Education: school, specialized, started_at, ended_at, description | Dashboard → Education → Add/Edit/Delete |
| **jb_account_experiences** | Experience: company, position, started_at, ended_at, description | Dashboard → Experience → Add/Edit/Delete |

---

## Short summary

- **jb_accounts** → Job seeker ka saara profile data (name, phone, DOB, salary, bio, location, qualifications JSON, languages JSON, resume, social links, etc.).
- **jb_account_favorite_skills** → Chune hue skills (account_id + skill_id).
- **jb_account_favorite_tags** → Chune hue tags (account_id + tag_id).
- **jb_account_educations** → Education entries (alag CRUD).
- **jb_account_experiences** → Experience entries (alag CRUD).

Form submit: `POST` → `public.account.post.settings` (AccountController@postSettings).
