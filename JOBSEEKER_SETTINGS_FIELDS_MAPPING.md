# Job Seeker Account – Settings Form: Field Names & Database Mapping

Ye list job seeker settings form ke **form field names** aur **database table/column** ka mapping hai.

**Form route:** `public.account.post.settings` (POST)  
**Controller:** `AccountController@postSettings`  
**Request:** `SettingRequest` (validated data → `jb_accounts` + pivot tables)

---

## 1. Personal Details

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Full Name                 | `first_name`                 | **jb_accounts** | `first_name` (save pe `full_name` bhi sync) |
| Email Address             | (read-only, no name)         | **jb_accounts** | `email`           |
| Phone Number              | `phone`                      | **jb_accounts** | `phone`           |
| This number is WhatsApp   | `is_whatsapp_available`      | **jb_accounts** | `is_whatsapp_available` |
| Alternate Phone           | `alternate_phone`            | **jb_accounts** | `alternate_phone` |
| Alternate on WhatsApp     | `is_alternate_whatsapp_available` | **jb_accounts** | `is_alternate_whatsapp_available` |
| Date of Birth             | `dob`                        | **jb_accounts** | `dob`             |
| Gender                    | `gender`                     | **jb_accounts** | `gender`          |
| Marital Status            | `marital_status`             | **jb_accounts** | `marital_status`  |

---

## 2. Security / Profile Visibility

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Profile Visibility        | `profile_visibility`         | **jb_accounts** | `profile_visibility` |
| Hide Resume               | `hide_resume`                | **jb_accounts** | `hide_resume`     |
| Hide only name for Employer | `hide_name_for_employer`   | **jb_accounts** | `hide_name_for_employer` |

---

## 3. Work Status

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Current Work Status       | `current_work_status`        | **jb_accounts** | `current_work_status` |
| Available for Immediate Joining | `available_for_immediate_joining` | **jb_accounts** | `available_for_immediate_joining` |
| Notice Period             | `notice_period`              | **jb_accounts** | `notice_period`   |
| Current Salary            | `current_salary`             | **jb_accounts** | `current_salary`  |
| Current Salary Period     | `current_salary_period`      | **jb_accounts** | `current_salary_period` |
| Expected Salary           | `expected_salary`            | **jb_accounts** | `expected_salary` |
| Expected Salary Period    | `expected_salary_period`     | **jb_accounts** | `expected_salary_period` |

---

## 4. About Me / Bio

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Teaching Philosophy / Bio | `bio`                        | **jb_accounts** | `bio`             |

---

## 5. Job Preferences

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Preferred Institution Type | `institution_types[]`       | **jb_accounts** | `institution_types` (JSON array) |
| Position Type (Teaching/Non-teaching) | `position_type[]` | **jb_accounts** | `position_type` (comma string) |
| Teaching Subjects        | `teaching_subjects[]`        | **jb_accounts** | `teaching_subjects` (JSON array) |
| Non-Teaching Positions   | `non_teaching_positions[]`   | **jb_accounts** | `non_teaching_positions` (JSON array) |
| Job Type Preferences     | `job_type_preferences[]`    | **jb_accounts** | `job_type_preferences` (JSON array) |
| Remote Only              | `remote_only`                | **jb_accounts** | `remote_only`     |

---

## 6. Current Location

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| City                     | `city_id` (hidden)           | **jb_accounts** | `city_id`         |
| State                    | `state_id` (hidden)          | **jb_accounts** | `state_id`        |
| Country                  | `country_id` (hidden)        | **jb_accounts** | `country_id`      |
| Address                  | `address`                    | **jb_accounts** | `address`         |
| Pin Code                 | `pin_code`                   | **jb_accounts** | `pin_code`        |

---

## 7. Native Location

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Same as current          | `native_same_as_current`     | **jb_accounts** | `native_same_as_current` |
| Native City/State/Country | `native_city_id`, `native_state_id`, `native_country_id` | **jb_accounts** | `native_city_id`, `native_state_id`, `native_country_id` |
| Native Locality         | `native_locality`            | **jb_accounts** | `native_locality` |
| Native Address          | `native_address`             | **jb_accounts** | `native_address`  |
| Native Pin Code         | `native_pin_code`            | **jb_accounts** | `native_pin_code` |

---

## 8. Work Location Preference

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Preference Type          | `work_location_preference_type` | **jb_accounts** | `work_location_preference_type` |
| Preferred Locations (list) | `work_location_preferences[i][country_id]`, `state_id`, `city_id`, `country_name`, `state_name`, `city_name`, `locality` | **jb_accounts** | `work_location_preferences` (JSON array) |

---

## 9. Qualifications & Experience (in same form)

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Qualification Level      | `qualifications[i][level]`   | **jb_accounts** | `qualifications` (JSON array) |
| Specialization          | `qualifications[i][specialization]` | **jb_accounts** | `qualifications` |
| Institution             | `qualifications[i][institution]`    | **jb_accounts** | `qualifications` |
| Teaching Certifications  | `teaching_certifications[]` | **jb_accounts** | `teaching_certifications` (JSON array) |
| Total Experience        | `total_experience`           | **jb_accounts** | `total_experience` |

**Note:** Detailed Education entries (school, dates, etc.) = **jb_account_educations** (separate CRUD: add/edit/delete from dashboard).  
Detailed Experience entries (company, position, dates) = **jb_account_experiences** (separate CRUD). Settings form me sirf qualifications summary + total_experience store hota hai.

---

## 10. Languages

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Language + Proficiency   | `languages[i][language]`, `languages[i][proficiency]` | **jb_accounts** | `languages` (JSON array) |

**Note:** Separate **jb_account_languages** table bhi hai (language_level_id, etc.) – agar use ho raha ho to wahan bhi store ho sakta hai; is form me `languages` JSON use hota hai.

---

## 11. Skills & Documents

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| Favorite Skills          | `favorite_skills` (comma-separated IDs) | **jb_account_favorite_skills** | `account_id`, `skill_id` (sync) |
| Favorite Tags            | `favorite_tags`              | **jb_account_favorite_tags** | `account_id`, `tag_id` (sync) |
| Resume (file)            | `resume`                     | **jb_accounts** | `resume` (file URL) |
| Resume parsing allowed   | `resume_parsing_allowed`     | **jb_accounts** | `resume_parsing_allowed` |
| Cover Letter (file)      | `cover_letter`               | **jb_accounts** | `cover_letter` (file URL) |
| Introductory Audio (file) | `introductory_audio`        | **jb_accounts** | `introductory_audio`, `introductory_audio_duration` |
| Introductory Video URL   | `introductory_video_url`     | **jb_accounts** | `introductory_video_url` |

---

## 12. Social & Professional Links

| Form label / purpose     | Form field name              | Database table  | Database column   |
|--------------------------|------------------------------|-----------------|-------------------|
| LinkedIn                 | `social_links[linkedin]`      | **jb_accounts** | `social_links` (JSON) |
| Facebook                 | `social_links[facebook]`      | **jb_accounts** | `social_links` (JSON) |

(SettingRequest me twitter, instagram, youtube bhi allowed hain; form me sirf LinkedIn/Facebook dikh rahe hain.)

---

## Summary: Tables used

| Table                          | Kya store hota hai |
|--------------------------------|--------------------|
| **jb_accounts**                | Personal details, visibility, work status, salary, bio, job preferences, current/native location, work_location_preferences, qualifications, teaching_certifications, total_experience, languages (JSON), resume, cover_letter, introductory_audio/url, social_links (JSON), etc. |
| **jb_account_favorite_skills** | account_id, skill_id (form: favorite_skills → sync) |
| **jb_account_favorite_tags**    | account_id, tag_id (form: favorite_tags → sync) |
| **jb_account_educations**       | Alag CRUD – settings form me nahi; dashboard se add/edit/delete |
| **jb_account_experiences**     | Alag CRUD – settings form me nahi; dashboard se add/edit/delete |
| **jb_account_activity_logs**   | action = update_setting (save pe log) |

---

## Extra (form me optional / validation me hai)

- `phone_country_code`, `alternate_phone_country_code`
- `description`, `career_aspiration`, `interests`, `activities`, `achievements`
- `locality`, `country_name`, `state_name`, `city_name`
- `native_country_name`, `native_state_name`, `native_city_name`
- `hidden_for_schools` (array)
- `is_public_profile`, `hide_cv`, `available_for_hiring`
- `location_type`, `ready_for_relocation`
- `skills` (array)

Sab **jb_accounts** columns hain; fillable/casts Account model me defined hain.
