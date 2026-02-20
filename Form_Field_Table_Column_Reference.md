# Form Field → Table → Column Reference

**Format:** Form field name | Table name | Database column name

---

## EMPLOYER SETTINGS FORM

| Form Field Name | Table Name | Database Column Name |
|-----------------|------------|----------------------|
| full_name | jb_accounts | first_name, last_name, full_name |
| account_phone | jb_accounts | phone |
| designation | jb_accounts | designation |
| name | jb_accounts | institution_name (sync) |
| name | jb_companies | name |
| institution_type[] | jb_accounts | institution_type |
| institution_type[] | jb_companies | institution_type |
| description | jb_companies | description |
| email | jb_companies | email |
| phone | jb_companies | phone |
| website | jb_companies | website |
| year_founded | jb_companies | year_founded |
| total_staff | jb_companies | total_staff |
| campus_type | jb_companies | campus_type |
| standard_level[] | jb_companies | standard_level |
| staff_facilities[] | jb_companies | staff_facilities |
| country_id | jb_companies | country_id |
| state_id | jb_companies | state_id |
| city_id | jb_companies | city_id |
| address | jb_companies | address |
| postal_code | jb_companies | postal_code |
| facebook | jb_companies | facebook |
| linkedin | jb_companies | linkedin |
| youtube_video | jb_companies | youtube_video |
| instagram | jb_companies | instagram |
| logo | jb_companies | logo |
| awards[i][title], awards[i][year], awards_photos[i] | jb_companies | awards |
| affiliations[i][title], affiliations_photos[i] | jb_companies | affiliations |
| team_members[i][name], team_members[i][designation], team_members[i][linkedin] | jb_companies | team_members |
| working_days[] | jb_companies | working_days |
| working_hours_start | jb_companies | working_hours_start |
| working_hours_end | jb_companies | working_hours_end |
| campus_photos | jb_companies | campus_photos |

**Link table:** jb_companies_accounts → company_id, account_id (employer ↔ company link)

---

## JOB SEEKER SETTINGS FORM

| Form Field Name | Table Name | Database Column Name |
|-----------------|------------|----------------------|
| first_name | jb_accounts | first_name, full_name |
| phone | jb_accounts | phone |
| is_whatsapp_available | jb_accounts | is_whatsapp_available |
| alternate_phone | jb_accounts | alternate_phone |
| is_alternate_whatsapp_available | jb_accounts | is_alternate_whatsapp_available |
| dob | jb_accounts | dob |
| gender | jb_accounts | gender |
| marital_status | jb_accounts | marital_status |
| profile_visibility | jb_accounts | profile_visibility |
| hide_resume | jb_accounts | hide_resume |
| hide_name_for_employer | jb_accounts | hide_name_for_employer |
| current_work_status | jb_accounts | current_work_status |
| available_for_immediate_joining | jb_accounts | available_for_immediate_joining |
| notice_period | jb_accounts | notice_period |
| current_salary | jb_accounts | current_salary |
| current_salary_period | jb_accounts | current_salary_period |
| expected_salary | jb_accounts | expected_salary |
| expected_salary_period | jb_accounts | expected_salary_period |
| bio | jb_accounts | bio |
| institution_types[] | jb_accounts | institution_types |
| position_type[] | jb_accounts | position_type |
| teaching_subjects[] | jb_accounts | teaching_subjects |
| non_teaching_positions[] | jb_accounts | non_teaching_positions |
| job_type_preferences[] | jb_accounts | job_type_preferences |
| remote_only | jb_accounts | remote_only |
| city_id | jb_accounts | city_id |
| state_id | jb_accounts | state_id |
| country_id | jb_accounts | country_id |
| address | jb_accounts | address |
| pin_code | jb_accounts | pin_code |
| native_same_as_current | jb_accounts | native_same_as_current |
| native_city_id | jb_accounts | native_city_id |
| native_state_id | jb_accounts | native_state_id |
| native_country_id | jb_accounts | native_country_id |
| native_locality | jb_accounts | native_locality |
| native_address | jb_accounts | native_address |
| native_pin_code | jb_accounts | native_pin_code |
| work_location_preference_type | jb_accounts | work_location_preference_type |
| work_location_preferences[i][...] | jb_accounts | work_location_preferences |
| qualifications[i][level] | jb_accounts | qualifications |
| qualifications[i][specialization] | jb_accounts | qualifications |
| qualifications[i][institution] | jb_accounts | qualifications |
| teaching_certifications[] | jb_accounts | teaching_certifications |
| total_experience | jb_accounts | total_experience |
| languages[i][language] | jb_accounts | languages |
| languages[i][proficiency] | jb_accounts | languages |
| favorite_skills | jb_account_favorite_skills | account_id, skill_id |
| favorite_tags | jb_account_favorite_tags | account_id, tag_id |
| resume | jb_accounts | resume |
| resume_parsing_allowed | jb_accounts | resume_parsing_allowed |
| cover_letter | jb_accounts | cover_letter |
| introductory_audio | jb_accounts | introductory_audio, introductory_audio_duration |
| introductory_video_url | jb_accounts | introductory_video_url |
| social_links[linkedin] | jb_accounts | social_links |
| social_links[facebook] | jb_accounts | social_links |

**Alag tables (settings form se save nahi, alag pages se):**
- jb_account_educations → Education add/edit/delete
- jb_account_experiences → Experience add/edit/delete
