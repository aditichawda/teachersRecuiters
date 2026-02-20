# Employer Account – Settings Form: Field Names & Database Mapping

Ye list employer settings form ke **form field names** aur **database table/column** ka mapping hai.

---

## 1. Your Details (Account – login user)

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Full Name           | `full_name`     | **jb_accounts** | `full_name` (display); save pe `first_name`, `last_name` bhi set hote hain |
| Login Email         | (read-only, no name) | **jb_accounts** | `email` |
| Mobile Number       | `account_phone` | **jb_accounts** | `phone` |
| Designation         | `designation`   | **jb_accounts** | `designation` |

---

## 2. Institution Logo

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Institution Logo    | `logo`          | **jb_companies** | `logo` (file URL store) |

---

## 3. Institution Information

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| School/Institution Name | `name`      | **jb_companies** | `name` |
| Type of Institution | `institution_type[]` (array, max 4) | **jb_companies** | `institution_type` (comma-separated string); copy **jb_accounts** → `institution_type` + `institution_name` bhi update |
| About Us            | `description`   | **jb_companies** | `description` |
| Institution Email   | `email`         | **jb_companies** | `email` |
| Institution Phone   | `phone`         | **jb_companies** | `phone` |
| Website             | `website`       | **jb_companies** | `website` |
| Established Year    | `year_founded`  | **jb_companies** | `year_founded` |
| Total Number of Staff | `total_staff` | **jb_companies** | `total_staff` |

---

## 4. Campus & Facilities

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Campus Type         | `campus_type`   | **jb_companies** | `campus_type` |
| School/Institution Standard Level | `standard_level[]` | **jb_companies** | `standard_level` (JSON/array) |
| Facilities Available for Staff/Teacher | `staff_facilities[]` | **jb_companies** | `staff_facilities` (JSON/array) |

---

## 5. Location

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| City                | `city_id`       | **jb_companies** | `city_id` |
| State               | `state_id`      | **jb_companies** | `state_id` |
| Country             | `country_id`    | **jb_companies** | `country_id` |
| Address             | `address`       | **jb_companies** | `address` |
| Postal Code         | `postal_code`   | **jb_companies** | `postal_code` |

---

## 6. Social Links & Video

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Facebook            | `facebook`      | **jb_companies** | `facebook` |
| LinkedIn            | `linkedin`      | **jb_companies** | `linkedin` |
| YouTube             | `youtube_video` | **jb_companies** | `youtube_video` |
| Instagram           | `instagram`     | **jb_companies** | `instagram` (validation me hai, form me optional) |

---

## 7. Awards (dynamic list, max 5)

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Award Title         | `awards[i][title]` | **jb_companies** | `awards` (JSON array: title, year, photo) |
| Year                | `awards[i][year]`  | **jb_companies** | `awards` |
| Photo               | `awards_photos[i]` / `awards[i][photo]` | **jb_companies** | `awards` (photo URL in JSON) |

---

## 8. Affiliations (dynamic list)

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Affiliation Title   | `affiliations[i][title]` | **jb_companies** | `affiliations` (JSON array: title, photo) |
| Certificate/Photo   | `affiliations_photos[i]` / `affiliations[i][photo]` | **jb_companies** | `affiliations` |

---

## 9. Team Members (dynamic list)

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Name                | `team_members[i][name]`       | **jb_companies** | `team_members` (JSON array: name, designation, linkedin) |
| Designation         | `team_members[i][designation]`| **jb_companies** | `team_members` |
| LinkedIn            | `team_members[i][linkedin]`   | **jb_companies** | `team_members` |

---

## 10. Optional (validation me hai, theme form me ho sakta hai)

| Form label / purpose | Form field name | Database table | Database column |
|---------------------|-----------------|----------------|-----------------|
| Working Days        | `working_days[]` | **jb_companies** | `working_days` (JSON array) |
| Working Hours Start | `working_hours_start` | **jb_companies** | `working_hours_start` |
| Working Hours End   | `working_hours_end`   | **jb_companies** | `working_hours_end` |
| Campus Photos       | `campus_photos`, `campus_photos_photos[i]` | **jb_companies** | `campus_photos` (JSON array: photo, caption) |

---

## Summary: Tables used

| Table | Kya store hota hai |
|-------|--------------------|
| **jb_accounts** | Full name (first_name, last_name, full_name), phone (account_phone), designation, institution_name, institution_type (company ke saath sync) |
| **jb_companies** | Logo, name, institution_type, description, **email** (Institution Email), **phone** (Institution Phone), website, year_founded, total_staff, campus_type, standard_level, staff_facilities, country_id, state_id, city_id, address, postal_code, facebook, linkedin, youtube_video, instagram, awards, affiliations, team_members, working_days, working_hours_start, working_hours_end, campus_photos |
| **jb_companies_accounts** | Employer account ↔ company link (company_id, account_id) |

Form submit route: `public.account.employer.settings.update`  
Controller: `EmployerSettingController@update`
