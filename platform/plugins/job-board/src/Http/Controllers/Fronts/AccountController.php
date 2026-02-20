<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\AccountLanguageForm;
use Botble\JobBoard\Forms\Fronts\AccountSettingForm;
use Botble\JobBoard\Http\Requests\AvatarRequest;
use Botble\JobBoard\Http\Requests\SettingRequest;
use Botble\JobBoard\Http\Requests\UpdatePasswordRequest;
use Botble\JobBoard\Http\Requests\UploadResumeRequest;
use Botble\JobBoard\Http\Resources\ActivityLogResource;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountActivityLog;
use Botble\JobBoard\Models\AccountEducation;
use Botble\JobBoard\Models\AccountExperience;
use Botble\JobBoard\Models\JobSkill;
use Botble\JobBoard\Models\Language;
use Botble\JobBoard\Models\Specialization;
use Botble\JobBoard\Models\Tag;
use Illuminate\Support\Facades\Schema;
use Botble\Media\Facades\RvMedia;
use Botble\Media\Models\MediaFile;
use Botble\Media\Services\ThumbnailService;
use Botble\Optimize\Facades\OptimizerHelper;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends BaseController
{
    public function __construct()
    {
        OptimizerHelper::disable();
    }

    public function getDashboard()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        SeoHelper::setTitle(__('Dashboard'));
        Theme::breadcrumb()
            ->add(__('Dashboard'), route('public.account.jobseeker.dashboard'));

        $educations = AccountEducation::query()
            ->where('account_id', $account->id)
            ->get();

        $experiences = AccountExperience::query()
            ->where('account_id', $account->id)
            ->get();

        $data = compact('account', 'educations', 'experiences');

        return JobBoardHelper::scope('account.dashboard', $data);
    }

    public function getOverview()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        SeoHelper::setTitle($account->name);
        Theme::breadcrumb()
            ->add(trans('plugins/job-board::messages.my_profile'), route('public.account.overview'))
            ->add($account->name);

        $educations = AccountEducation::query()
            ->where('account_id', $account->id)
            ->get();

        $experiences = AccountExperience::query()
            ->where('account_id', $account->id)
            ->get();

        $data = compact('account', 'educations', 'experiences');

        return JobBoardHelper::scope('account.overview', $data);
    }

    public function getSettings()
    {
        SeoHelper::setTitle(trans('plugins/job-board::messages.account_settings'));
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $form = AccountSettingForm::createFromModel($account);

        $selectedJobSkills = $account->favoriteSkills()->pluck('jb_job_skills.id')->all();

        $jobSkills = JobSkill::query()
            ->wherePublished()
            ->select(['id', 'name'])
            ->get();

        $selectedJobTags = $account->favoriteTags()->pluck('jb_tags.id')->all();

        $jobTags = Tag::query()
            ->wherePublished()
            ->select(['id', 'name'])
            ->get();

        $languages = $account->languages()->with('languageLevel')->get();

        $languageForm = AccountLanguageForm::create();

        $experiences = AccountExperience::query()
            ->where('account_id', $account->id)
            ->orderByDesc('started_at')
            ->get();

        // Languages from core `languages` table; specializations from jb_specializations
        $languagesList = collect();
        $specializationsList = collect();
        if (Schema::hasTable('languages')) {
            $rows = \Illuminate\Support\Facades\DB::table('languages')
                ->orderBy('lang_order')->orderBy('lang_name')
                ->get(['lang_id', 'lang_name']);
            $languagesList = $rows->map(fn ($r) => (object) ['id' => $r->lang_id, 'name' => $r->lang_name]);
        }
        if (Schema::hasTable('jb_specializations')) {
            // Include both 'published' and 1 so dropdown gets data (DB may store status as 1)
            $specializationsList = Specialization::query()
                ->whereIn('status', ['published', 1])
                ->orderBy('order')
                ->orderBy('name')
                ->get(['id', 'name']);
        }

        return JobBoardHelper::scope(
            'account.settings.index',
            compact('account', 'jobSkills', 'jobTags', 'selectedJobSkills', 'selectedJobTags', 'languages', 'form', 'languageForm', 'experiences', 'languagesList', 'specializationsList')
        );
    }

    public function postSettings(SettingRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        $data = $request->validated();
        
        // Remove file fields from data array (handled separately)
        Arr::forget($data, ['resume', 'cover_letter', 'introductory_audio']);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $result = RvMedia::handleUpload($request->file('resume'), 0, $account->upload_folder);

            if (! $result['error']) {
                if ($path = $account->resume) {
                    Storage::disk('public')->delete($path);
                }

                $data['resume'] = $result['data']->url;
            }
        }

        // Handle cover letter upload
        if ($request->hasFile('cover_letter')) {
            $result = RvMedia::handleUpload($request->file('cover_letter'), 0, $account->upload_folder);

            if (! $result['error']) {
                if ($path = $account->cover_letter) {
                    Storage::disk('public')->delete($path);
                }

                $data['cover_letter'] = $result['data']->url;
            }
        }

        // Handle introductory audio upload
        if ($request->hasFile('introductory_audio')) {
            $result = RvMedia::handleUpload($request->file('introductory_audio'), 0, $account->upload_folder);

            if (! $result['error']) {
                if ($path = $account->introductory_audio) {
                    Storage::disk('public')->delete($path);
                }

                $data['introductory_audio'] = $result['data']->url;
                
                // Try to get audio duration (optional)
                try {
                    $filePath = Storage::disk('public')->path($result['data']->url);
                    if (function_exists('getID3') || class_exists('\getID3')) {
                        $getID3 = new \getID3();
                        $fileInfo = $getID3->analyze($filePath);
                        $data['introductory_audio_duration'] = isset($fileInfo['playtime_seconds']) 
                            ? (int) $fileInfo['playtime_seconds'] 
                            : null;
                    }
                } catch (\Exception $e) {
                    // Duration detection failed, continue without it
                }
            }
        }

        // Process qualifications - filter out empty entries
        if (isset($data['qualifications'])) {
            $data['qualifications'] = array_values(array_filter($data['qualifications'], function($qual) {
                return !empty($qual['level']) || !empty($qual['specialization']) || !empty($qual['institution']);
            }));
        }

        // Process languages - filter out empty entries
        if (isset($data['languages'])) {
            $data['languages'] = array_values(array_filter($data['languages'], function($lang) {
                return !empty($lang['language']);
            }));
        }

        // Handle position_type as string if array with single value
        if (isset($data['position_type']) && is_array($data['position_type'])) {
            $data['position_type'] = implode(',', $data['position_type']);
        }

        // Extract favorite_skills and favorite_tags before saving (pivot table sync)
        $favoriteSkills = null;
        if (isset($data['favorite_skills'])) {
            $favoriteSkills = $data['favorite_skills'];
            Arr::forget($data, 'favorite_skills');
        }

        $favoriteTags = null;
        if (isset($data['favorite_tags'])) {
            $favoriteTags = $data['favorite_tags'];
            Arr::forget($data, 'favorite_tags');
        }

        // When native same as current, clear native location fields
        if (!empty($data['native_same_as_current'])) {
            $data['native_country_id'] = null;
            $data['native_state_id'] = null;
            $data['native_city_id'] = null;
            $data['native_country_name'] = null;
            $data['native_state_name'] = null;
            $data['native_city_name'] = null;
            $data['native_address'] = null;
            $data['native_locality'] = null;
            $data['native_pin_code'] = null;
        }

        // When using text location (country_name etc.), clear ID fields so name fields are used
        if (!empty($data['country_name']) || !empty($data['state_name']) || !empty($data['city_name'])) {
            $data['country_id'] = null;
            $data['state_id'] = null;
            $data['city_id'] = null;
        }
        if (!empty($data['native_country_name']) || !empty($data['native_state_name']) || !empty($data['native_city_name'])) {
            $data['native_country_id'] = null;
            $data['native_state_id'] = null;
            $data['native_city_id'] = null;
        }

        // Normalize work_location_preferences: keep only non-empty entries with priority
        if (isset($data['work_location_preferences']) && is_array($data['work_location_preferences'])) {
            $data['work_location_preferences'] = array_values(array_filter(array_map(function ($item, $index) {
                $hasId = !empty($item['country_id']) || !empty($item['state_id']) || !empty($item['city_id']);
                $hasName = !empty($item['country_name'] ?? '') || !empty($item['state_name'] ?? '') || !empty($item['city_name'] ?? '');
                $hasLocality = !empty($item['locality'] ?? '');
                if (!$hasId && !$hasName && !$hasLocality) {
                    return null;
                }
                $entry = [
                    'country_id' => $item['country_id'] ?? null,
                    'state_id' => $item['state_id'] ?? null,
                    'city_id' => $item['city_id'] ?? null,
                    'country_name' => $item['country_name'] ?? null,
                    'state_name' => $item['state_name'] ?? null,
                    'city_name' => $item['city_name'] ?? null,
                    'locality' => $item['locality'] ?? null,
                    'priority' => $index + 1,
                ];
                return $entry;
            }, $data['work_location_preferences'], array_keys($data['work_location_preferences']))));
        }

        // Keep full_name in sync with first_name (registration saves full_name; settings form uses first_name)
        if (!empty($data['first_name'])) {
            $data['full_name'] = $data['first_name'];
        }

        AccountSettingForm::createFromModel($account)
            ->saving(function (AccountSettingForm $form) use ($data): void {
                $model = $form->getModel();

                $model->fill($data);
                $model->save();
            });

        // Sync favorite skills (pivot table)
        if ($favoriteSkills !== null) {
            $skillIds = array_filter(explode(',', $favoriteSkills));
            $account->favoriteSkills()->sync($skillIds);
        }

        // Sync favorite tags (pivot table)
        if ($favoriteTags !== null) {
            $tagIds = array_filter(explode(',', $favoriteTags));
            $account->favoriteTags()->sync($tagIds);
        }

        AccountActivityLog::query()->create(['action' => 'update_setting']);

        return $this
            ->httpResponse()
            ->setNextUrl(route('public.account.settings'))
            ->setMessage(trans('plugins/job-board::messages.update_profile_successfully'));
    }

    public function getSecurity()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        if ($account->isEmployer()) {
            $this->pageTitle(__('Change Password'));

            return JobBoardHelper::view('dashboard.change-password', compact('account'));
        }

        SeoHelper::setTitle(trans('plugins/job-board::messages.security'));

        return JobBoardHelper::scope('account.settings.security', compact('account'));
    }

    public function postSecurity(UpdatePasswordRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        if (! Hash::check($request->input('old_password'), $account->getAuthPassword())) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(trans('plugins/job-board::dashboard.current_password_incorrect'));
        }

        $account->update([
            'password' => Hash::make($request->input('password')),
        ]);

        AccountActivityLog::query()->create(['action' => 'update_security']);

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/job-board::dashboard.password_update_success'));
    }

    public function postAvatar(AvatarRequest $request, ThumbnailService $thumbnailService)
    {
        try {
            $account = auth('account')->user();

            $result = RvMedia::handleUpload($request->file('avatar_file'), 0, $account->upload_folder);

            if ($result['error']) {
                return $this
                    ->httpResponse()->setError()->setMessage($result['message']);
            }

            $avatarData = json_decode($request->input('avatar_data'));

            $file = $result['data'];

            $fileUpload = RvMedia::getRealPath($file->url);

            if (RvMedia::isUsingCloud()) {
                $fileUpload = @file_get_contents($fileUpload);
            }

            $thumbnailService
                ->setImage($fileUpload)
                ->setSize((int) $avatarData->width, (int) $avatarData->height)
                ->setCoordinates((int) $avatarData->x, (int) $avatarData->y)
                ->setDestinationPath(File::dirname($file->url))
                ->setFileName(File::name($file->url) . '.' . File::extension($file->url))
                ->save('crop');

            $avatar = MediaFile::query()->find($account->avatar_id);

            if ($avatar) {
                $avatar->forceDelete();
            }

            $account->avatar_id = $file->id;
            $account->save();

            AccountActivityLog::query()->create([
                'action' => 'changed_avatar',
            ]);

            return $this
                ->httpResponse()
                ->setMessage(trans('plugins/job-board::dashboard.update_avatar_success'))
                ->setData(['url' => RvMedia::url($file->url)]);
        } catch (Exception $ex) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    public function deleteAvatar()
    {
        try {
            $account = auth('account')->user();

            if (! $account->avatar_id) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage(trans('plugins/job-board::dashboard.avatar_not_found'));
            }

            $avatar = MediaFile::query()->find($account->avatar_id);

            if ($avatar) {
                $avatar->forceDelete();
            }

            $account->update([
                'avatar_id' => null,
            ]);

            return $this
                    ->httpResponse()
                    ->withDeletedSuccessMessage();

        } catch (Exception $ex) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    public function getInterestsAchievements()
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        SeoHelper::setTitle(__('Interests & Achievements'));
        Theme::breadcrumb()
            ->add(__('Dashboard'), route('public.account.jobseeker.dashboard'))
            ->add(__('Interests & Achievements'), route('public.account.interests-achievements'));

        return JobBoardHelper::scope('account.interests-achievements.index', compact('account'));
    }

    public function postInterestsAchievements(Request $request)
    {
        $validated = $request->validate([
            'interests' => ['nullable', 'string', 'max:2000'],
            'activities' => ['nullable', 'string', 'max:2000'],
            'achievements' => ['nullable', 'string', 'max:2000'],
        ]);

        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        $account->fill($validated)->save();

        return redirect()
            ->route('public.account.interests-achievements')
            ->with('success', __('Interests & Achievements saved successfully.'));
    }

    public function getActivityLogs()
    {
        $activities = AccountActivityLog::query()
            ->where('account_id', auth('account')->id())
            ->latest('created_at')
            ->paginate(10);

        return $this
            ->httpResponse()
            ->setData(ActivityLogResource::collection($activities))
            ->toApiResponse();
    }

    public function postUpload(UploadResumeRequest $request)
    {
        $account = auth('account')->user();

        $result = RvMedia::handleUpload($request->file('file'), 0, $account->upload_folder);

        if ($result['error']) {
            return $this
                ->httpResponse()
                ->setError();
        }

        return $this
            ->httpResponse()
            ->setData($result['data']);
    }

    public function postUploadFromEditor(Request $request)
    {
        $account = auth('account')->user();

        return RvMedia::uploadFromEditor($request, 0, $account->upload_folder);
    }

    public function getResumeBuilder()
    {
        SeoHelper::setTitle(__('Resume Builder'));

        /** @var Account $account */
        $account = auth('account')->user();

        $educations = AccountEducation::query()
            ->where('account_id', $account->id)
            ->orderBy('started_at', 'desc')
            ->get();

        $experiences = AccountExperience::query()
            ->where('account_id', $account->id)
            ->orderBy('started_at', 'desc')
            ->get();

        $skills = $account->favoriteSkills()->pluck('name')->all();

        return JobBoardHelper::scope(
            'account.resume-builder',
            compact('account', 'educations', 'experiences', 'skills')
        );
    }

    public function downloadResume(Request $request)
    {
        /** @var Account $account */
        $account = auth('account')->user();

        $template = $request->input('template', 'classic');
        if (! in_array($template, ['classic', 'modern'], true)) {
            $template = 'classic';
        }

        $educations = AccountEducation::query()
            ->where('account_id', $account->id)
            ->orderBy('started_at', 'desc')
            ->get();

        $experiences = AccountExperience::query()
            ->where('account_id', $account->id)
            ->orderBy('started_at', 'desc')
            ->get();

        $skills = $account->favoriteSkills()->pluck('name')->all();

        $html = view(Theme::getThemeNamespace('views.job-board.account.resume-templates.' . $template), compact('account', 'educations', 'experiences', 'skills'))->render();

        return response($html)
            ->header('Content-Type', 'text/html');
    }

    public function postUploadResume(UploadResumeRequest $request)
    {
        /**
         * @var Account $account
         */
        $account = auth('account')->user();

        $result = RvMedia::handleUpload($request->file('file'), 0, $account->upload_folder);

        if ($result['error']) {
            return $this
                ->httpResponse()->setError();
        }

        $account->update(['resume' => $result['data']->url]);

        $url = null;
        if (! $account->phone) {
            $url = route('public.account.settings');
        }

        return $this
            ->httpResponse()
            ->setData(compact('url'));
    }
}
