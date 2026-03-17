<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountActivityLog;
use Botble\JobBoard\Models\Company;
use Botble\Media\Facades\RvMedia;
use Botble\Slug\Facades\SlugHelper;
use Botble\Optimize\Facades\OptimizerHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EmployerSettingController extends BaseController
{
    public function __construct()
    {
        OptimizerHelper::disable();
    }

    public function edit()
    {
        $this->pageTitle(__('Settings'));

        /** @var Account $account */
        $account = auth('account')->user();
        $isConsultancy = $account && method_exists($account, 'isConsultancy')
            ? (bool) $account->isConsultancy()
            : (($account->registration_type ?? null) === 'consultancy');

        // Get or create the company for this employer
        $company = $account->companies()->first();

        if (! $company) {
            // Use institution_name from registration if available, otherwise use account name
            $companyName = $account->institution_name ?: ($account->first_name . ' ' . $account->last_name);

            $company = Company::create([
                'name' => $companyName,
                'email' => $account->email,
                'phone' => $account->phone,
                'institution_type' => $account->institution_type,
                'country_id' => $account->country_id,
                'state_id' => $account->state_id,
                'city_id' => $account->city_id,
                'status' => 'published',
            ]);
            $account->companies()->attach($company->id);
            if (SlugHelper::isSupportedModel(Company::class)) {
                try {
                    $existing = SlugHelper::getSlug(null, SlugHelper::getPrefix(Company::class), Company::class, $company->id);
                    if (! $existing) {
                        SlugHelper::createSlug($company);
                    }
                } catch (\Throwable $e) {
                    // ignore
                }
            }
        } else {
            // If company name is empty or same as account name, populate from registration data
            if (
                (! $company->name || $company->name === ($account->first_name . ' ' . $account->last_name))
                && $account->institution_name
            ) {
                $company->name = $account->institution_name;
            }

            // If institution_type is empty on company, pull from account
            if (! $company->institution_type && $account->institution_type) {
                $company->institution_type = $account->institution_type;
            }

            // If phone is empty on company, pull from account
            if (! $company->phone && $account->phone) {
                $company->phone = $account->phone;
            }

            // If location is empty on company, pull from account
            if (! $company->country_id && $account->country_id) {
                $company->country_id = $account->country_id;
                $company->state_id = $account->state_id;
                $company->city_id = $account->city_id;
            }

            // Save any changes we pulled from account
            if ($company->isDirty()) {
                $company->save();
            }

            // Ensure company has slug when name is set (fixes existing/dummy data without slug)
            if (SlugHelper::isSupportedModel(Company::class) && ! empty($company->name)) {
                try {
                    $existingSlug = SlugHelper::getSlug(null, SlugHelper::getPrefix(Company::class), Company::class, $company->id);
                    if (! $existingSlug) {
                        SlugHelper::createSlug($company);
                    }
                } catch (\Throwable $e) {
                    // ignore
                }
            }
        }

        // Load saved location names for display (Country, State, City)
        $locationCityName = '';
        $locationStateName = '';
        $locationCountryName = '';
        if ($company && is_plugin_active('location')) {
            if (!empty($company->city_id)) {
                try {
                    $city = \Botble\Location\Models\City::with(['state', 'country'])->find($company->city_id);
                    if ($city) {
                        $locationCityName = $city->name ?? '';
                        $locationStateName = $city->state->name ?? (\Botble\Location\Models\State::find($company->state_id)->name ?? '');
                        $locationCountryName = $city->country->name ?? ($city->state->country->name ?? (\Botble\Location\Models\Country::find($company->country_id)->name ?? ''));
                    }
                } catch (\Throwable $e) {
                    // fallback by ID only
                    try {
                        if (empty($locationCityName) && $company->city_id) {
                            $locationCityName = \Botble\Location\Models\City::find($company->city_id)->name ?? '';
                        }
                        if (empty($locationStateName) && $company->state_id) {
                            $locationStateName = \Botble\Location\Models\State::find($company->state_id)->name ?? '';
                        }
                        if (empty($locationCountryName) && $company->country_id) {
                            $locationCountryName = \Botble\Location\Models\Country::find($company->country_id)->name ?? '';
                        }
                    } catch (\Throwable $e2) {
                    }
                }
            }
            if (empty($locationStateName) && !empty($company->state_id)) {
                try {
                    $locationStateName = \Botble\Location\Models\State::find($company->state_id)->name ?? '';
                } catch (\Throwable $e) {
                }
            }
            if (empty($locationCountryName) && !empty($company->country_id)) {
                try {
                    $locationCountryName = \Botble\Location\Models\Country::find($company->country_id)->name ?? '';
                } catch (\Throwable $e) {
                }
            }
        }

        $view = $isConsultancy ? 'dashboard.consultant-settings' : 'dashboard.employer-settings';

        return JobBoardHelper::view($view, compact('account', 'company', 'locationCityName', 'locationStateName', 'locationCountryName'));
    }

    public function update(Request $request)
    {
        /** @var Account $account */
        $account = auth('account')->user();
        $isConsultancy = $account && method_exists($account, 'isConsultancy')
            ? (bool) $account->isConsultancy()
            : (($account->registration_type ?? null) === 'consultancy');

        // Normalize empty location IDs to null so validation (nullable|integer) passes when city is changed/cleared
        $request->merge([
            'city_id' => $request->input('city_id') !== '' && $request->input('city_id') !== null ? (int) $request->input('city_id') : null,
            'state_id' => $request->input('state_id') !== '' && $request->input('state_id') !== null ? (int) $request->input('state_id') : null,
            'country_id' => $request->input('country_id') !== '' && $request->input('country_id') !== null ? (int) $request->input('country_id') : null,
        ]);

        $rules = [
            // Account fields
            'full_name' => 'required|string|max:120',
            'account_phone' => 'required|string|max:30',
            'designation' => 'nullable|string|max:120',
            // Company fields
            'name' => 'required|string|max:120',
            'description' => 'required|string|max:400',
            'email' => 'required|email|max:60',
            'phone' => 'required|string|max:30',
            'website' => 'nullable|url|max:120',
            'total_staff' => 'nullable|integer|min:0|max:999',
            'country_id' => 'nullable|integer',
            'state_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'address' => 'required|string|max:250',
            'postal_code' => 'required|string|max:30',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube_video' => 'nullable|url|max:500',
            'instagram' => 'nullable|url|max:255',
            'awards' => 'nullable|array|max:5',
            'awards.*.title' => 'nullable|string|max:255',
            'awards.*.year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'affiliations' => 'nullable|array',
            'affiliations.*.title' => 'nullable|string|max:255',
            'team_members' => 'nullable|array',
            'team_members.*.name' => 'nullable|string|max:120',
            'team_members.*.designation' => 'nullable|string|max:120',
            'team_members.*.linkedin' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'working_days' => 'nullable|array',
            'working_days.*' => 'string|in:mon,tue,wed,thu,fri,sat,sun',
            'working_hours_start' => 'nullable|string|max:10',
            'working_hours_end' => 'nullable|string|max:10',
            'campus_photos' => 'nullable|array|max:10',
            'campus_photos.*.caption' => 'nullable|string|max:255',
            'campus_photos_photos' => 'nullable|array',
            'campus_photos_photos.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
        ];

        if (! $isConsultancy) {
            $rules = array_merge($rules, [
                'institution_type' => 'required|array|min:1|max:4',
                'institution_type.*' => 'required|string|max:80',
                'year_founded' => 'required|integer|min:1800|max:' . date('Y'),
                // These sections are currently disabled in the view, so keep them optional to avoid blocking saves.
                'campus_type' => 'nullable|string|in:boarding,day,both',
                'standard_level' => 'nullable|array|min:1',
                'standard_level.*' => 'string',
                'staff_facilities' => 'nullable|array|min:1',
                'staff_facilities.*' => 'string',
            ]);
        } else {
            // Consultancy: institution_type not required (and typically hidden)
            $rules = array_merge($rules, [
                'institution_type' => 'nullable|array|max:4',
                'institution_type.*' => 'nullable|string|max:80',
                'year_founded' => 'nullable|integer|min:1800|max:' . date('Y'),
            ]);
        }

        $request->validate($rules);

        // Update account full name and phone
        $fullName = $request->input('full_name');
        $nameParts = explode(' ', $fullName, 2);
        $institutionTypeStr = null;
        if ($request->has('institution_type')) {
            $institutionTypeInput = $request->input('institution_type', []);
            $institutionTypeStr = is_array($institutionTypeInput)
                ? implode(',', array_slice(array_filter($institutionTypeInput), 0, 4))
                : (string) $institutionTypeInput;
        }

        $accountData = [
            'first_name' => $nameParts[0],
            'last_name' => $nameParts[1] ?? '',
            'full_name' => $fullName,
            'designation' => $request->input('designation'),
            'phone' => $request->input('account_phone'),
            'institution_name' => $request->input('name'),
        ];

        if ($institutionTypeStr !== null) {
            $accountData['institution_type'] = $institutionTypeStr;
        }

        $account->update($accountData);

        $company = $account->companies()->first();

        if (! $company) {
            $company = Company::create([
                'email' => $request->input('email'),
                'status' => 'published',
            ]);
            $account->companies()->attach($company->id);
        }

        $data = $request->only([
            'name', 'description', 'email', 'phone',
            'website', 'year_founded', 'total_staff',
            'campus_type', 'standard_level', 'staff_facilities',
            'working_days', 'working_hours_start', 'working_hours_end',
            'country_id', 'state_id', 'city_id', 'address', 'postal_code',
            'facebook', 'linkedin', 'youtube_video', 'instagram',
        ]);
        if ($institutionTypeStr !== null) {
            $data['institution_type'] = $institutionTypeStr;
        }

        // Institution logo (right side): store in jb_companies.logo only. Left profile logo = account avatar, unchanged.
        if ($request->hasFile('logo')) {
            $result = RvMedia::handleUpload($request->file('logo'), 0, $account->upload_folder);

            if (! $result['error']) {
                $data['logo'] = $result['data']->url;
            }
        }

        // Handle awards (filter empty entries and process photos)
        $awards = $request->input('awards', []);
        if (is_array($awards)) {
            $processedAwards = [];
            foreach ($awards as $index => $award) {
                if (! empty($award['title'])) {
                    $awardData = [
                        'title' => $award['title'],
                        'year' => $award['year'] ?? null,
                        'photo' => $award['photo'] ?? null,
                    ];

                    // Handle award photo upload
                    if ($request->hasFile("awards_photos.{$index}")) {
                        $result = RvMedia::handleUpload($request->file("awards_photos.{$index}"), 0, $account->upload_folder);
                        if (! $result['error']) {
                            $awardData['photo'] = $result['data']->url;
                        }
                    }

                    $processedAwards[] = $awardData;
                }
            }
            $data['awards'] = $processedAwards;
        }

        // Handle affiliations (filter empty entries and process photos)
        $affiliations = $request->input('affiliations', []);
        if (is_array($affiliations)) {
            $processedAffiliations = [];
            foreach ($affiliations as $index => $aff) {
                if (! empty($aff['title'])) {
                    $affData = [
                        'title' => $aff['title'],
                        'photo' => $aff['photo'] ?? null,
                    ];

                    // Handle affiliation photo upload
                    if ($request->hasFile("affiliations_photos.{$index}")) {
                        $result = RvMedia::handleUpload($request->file("affiliations_photos.{$index}"), 0, $account->upload_folder);
                        if (! $result['error']) {
                            $affData['photo'] = $result['data']->url;
                        }
                    }

                    $processedAffiliations[] = $affData;
                }
            }
            $data['affiliations'] = $processedAffiliations;
        }

        // Handle team members (filter empty entries)
        $teamMembers = $request->input('team_members', []);
        if (is_array($teamMembers)) {
            $processedTeam = [];
            foreach ($teamMembers as $member) {
                if (! empty($member['name'])) {
                    $processedTeam[] = [
                        'name' => $member['name'],
                        'designation' => $member['designation'] ?? null,
                        'linkedin' => $member['linkedin'] ?? null,
                    ];
                }
            }
            $data['team_members'] = $processedTeam;
        }

        // Handle campus photos (upload new + keep existing via hidden photo url)
        $campusPhotosInput = $request->input('campus_photos', []);
        $campusPhotosFiles = $request->file('campus_photos_photos', []) ?? [];
        $processedCampusPhotos = [];
        if (is_array($campusPhotosInput) || is_array($campusPhotosFiles)) {
            $allIndices = array_unique(array_merge(
                array_keys(is_array($campusPhotosInput) ? $campusPhotosInput : []),
                array_keys(is_array($campusPhotosFiles) ? $campusPhotosFiles : [])
            ));
            sort($allIndices, SORT_NUMERIC);
            $uploadFolder = $account->upload_folder ?? 0;
            foreach ($allIndices as $index) {
                $item = is_array($campusPhotosInput) && isset($campusPhotosInput[$index]) ? $campusPhotosInput[$index] : [];
                $caption = is_array($item) ? ($item['caption'] ?? '') : '';
                $photoUrl = null;
                $file = isset($campusPhotosFiles[$index]) ? $campusPhotosFiles[$index] : $request->file("campus_photos_photos.{$index}");
                if ($file && $file->isValid()) {
                    $result = RvMedia::handleUpload($file, 0, $uploadFolder);
                    if (! $result['error']) {
                        $photoUrl = $result['data']->url;
                    }
                }
                if (! $photoUrl && is_array($item) && ! empty($item['photo'])) {
                    $photoUrl = $item['photo'];
                }
                if ($photoUrl) {
                    $processedCampusPhotos[] = ['photo' => $photoUrl, 'caption' => $caption];
                }
            }
        }
        $data['campus_photos'] = $processedCampusPhotos;

        $company->fill($data);
        $company->save();

        // Ensure company has a slug (create if missing, or when name is now set) so profile URL works
        if (SlugHelper::isSupportedModel(Company::class) && ! empty($company->name)) {
            try {
                $existingSlug = SlugHelper::getSlug(null, SlugHelper::getPrefix(Company::class), Company::class, $company->id);
                if (! $existingSlug) {
                    SlugHelper::createSlug($company);
                }
            } catch (\Throwable $e) {
                // ignore slug failure so profile save still succeeds
            }
        }

        AccountActivityLog::query()->create(['action' => 'update_setting']);

        return $this
            ->httpResponse()
            ->setNextUrl(route('public.account.employer.settings.edit'))
            ->setMessage($isConsultancy ? __('Consultancy profile updated successfully!') : __('School/Institution profile updated successfully!'));
    }
}
