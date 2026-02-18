<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\Avatar;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Concerns\HasActiveJobsRelation;
use Botble\JobBoard\Models\Concerns\UniqueId;
use Botble\JobBoard\Notifications\ConfirmEmailNotification;
use Botble\JobBoard\Notifications\ResetPasswordNotification;
use Botble\Media\Facades\RvMedia;
use Botble\Media\Models\MediaFile;
use Botble\Slug\Facades\SlugHelper;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Account extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasActiveJobsRelation;
    use HasApiTokens;
    use MustVerifyEmail;
    use Notifiable;
    use UniqueId;

    protected $table = 'jb_accounts';

    protected $fillable = [
        // Basic Info
        'first_name',
        'last_name',
        'full_name',
        'designation',
        'email',
        'password',
        'avatar_id',
        'dob',
        'phone',
        'phone_country_code',
        'is_whatsapp_available',
        'alternate_phone',
        'alternate_phone_country_code',
        'is_alternate_whatsapp_available',
        'gender',
        'marital_status',
        'description',
        'bio',
        'career_aspiration',
        
        // Account type & package
        'package_id',
        'type',
        'registration_type',
        'credits',
        'profile_views',
        'unique_id',
        
        // Resume & Documents
        'resume',
        'resume_parsing_allowed',
        'cover_letter',
        'introductory_audio',
        'introductory_audio_duration',
        'introductory_video_url',
        
        // Salary
        'salary_type',
        'salary_amount',
        'current_salary',
        'current_salary_period',
        'expected_salary',
        'expected_salary_period',
        
        // Profile Visibility
        'is_public_profile',
        'profile_visibility',
        'hide_cv',
        'hide_resume',
        'hide_name_for_employer',
        'hidden_for_schools',
        
        // Work Status
        'available_for_hiring',
        'available_for_immediate_joining',
        'current_work_status',
        'notice_period',
        
        // Location
        'address',
        'pin_code',
        'locality',
        'country_id',
        'state_id',
        'city_id',
        'country_name',
        'state_name',
        'city_name',
        'location_type',
        'ready_for_relocation',
        'work_location_preferences',
        'native_same_as_current',
        'native_country_id',
        'native_state_id',
        'native_city_id',
        'native_country_name',
        'native_state_name',
        'native_city_name',
        'native_address',
        'native_locality',
        'native_pin_code',
        'work_location_preference_type',
        
        // Institution preferences
        'institution_type',
        'institution_types',
        'institution_name',
        
        // Position & Job preferences
        'position_type',
        'teaching_subjects',
        'non_teaching_positions',
        'job_type_preferences',
        'remote_only',
        
        // Qualifications & Experience
        'qualifications',
        'teaching_certifications',
        'total_experience',
        
        // Skills & Languages
        'languages',
        'skills',
        
        // Social
        'social_links',
        
        // Email verification fields
        'email_verified_at',
        'email_verification_token',
        'email_verification_token_expires_at',
        'verification_code',
        'verification_code_expires_at',
        'is_email_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'type' => AccountTypeEnum::class,
        'dob' => 'datetime',
        'email_verified_at' => 'datetime',
        'email_verification_token_expires_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'is_email_verified' => 'boolean',
        'is_whatsapp_available' => 'boolean',
        'is_alternate_whatsapp_available' => 'boolean',
        'is_public_profile' => 'boolean',
        'profile_visibility' => 'boolean',
        'hide_cv' => 'boolean',
        'hide_resume' => 'boolean',
        'hide_name_for_employer' => 'boolean',
        'available_for_hiring' => 'boolean',
        'available_for_immediate_joining' => 'boolean',
        'ready_for_relocation' => 'boolean',
        'native_same_as_current' => 'boolean',
        'remote_only' => 'boolean',
        'resume_parsing_allowed' => 'boolean',
        'current_salary' => 'decimal:2',
        'expected_salary' => 'decimal:2',
        // JSON fields
        'hidden_for_schools' => 'array',
        'qualifications' => 'array',
        'teaching_certifications' => 'array',
        'work_location_preferences' => 'array',
        'languages' => 'array',
        'skills' => 'array',
        'teaching_subjects' => 'array',
        'non_teaching_positions' => 'array',
        'job_type_preferences' => 'array',
        'social_links' => 'array',
        'institution_types' => 'array',
    ];

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new ConfirmEmailNotification());
    }

    public function avatar(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class)->withDefault();
    }

    public function resumeDownloadUrl(): Attribute
    {
        return Attribute::get(
            fn () => route('public.candidate.download-cv', ['account' => $this->slug, 'path' => $this->resume])
        );
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst((string) $value),
            set: fn ($value) => ucfirst((string) $value),
        );
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst((string) $value),
            set: fn ($value) => ucfirst((string) $value),
        );
    }

    protected function name(): Attribute
    {
        return Attribute::get(fn () => $this->first_name . ' ' . $this->last_name);
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->avatar->url) {
                    return RvMedia::url($this->avatar->url);
                }

                try {
                    if (setting('job_board_default_account_avatar')) {
                        return RvMedia::getImageUrl(setting('job_board_default_account_avatar'));
                    }

                    return (new Avatar())->create($this->name)->toBase64();
                } catch (Exception) {
                    return RvMedia::getDefaultImage();
                }
            },
        );
    }

    protected function avatarThumbUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->avatar->url) {
                    return RvMedia::getImageUrl($this->avatar->url, 'thumb');
                }

                try {
                    if (setting('job_board_default_account_avatar')) {
                        return RvMedia::getImageUrl(setting('job_board_default_account_avatar'), 'thumb');
                    }

                    return (new Avatar())->create($this->name)->toBase64();
                } catch (Exception) {
                    return RvMedia::getDefaultImage();
                }
            },
        );
    }

    protected function credits(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (! JobBoardHelper::isEnabledCreditsSystem()) {
                    return 0;
                }

                return $value ?: 0;
            }
        );
    }

    protected function resumeUrl(): Attribute
    {
        return Attribute::get(fn () => $this->resume ? RvMedia::url($this->resume) : '');
    }

    protected function resumeName(): Attribute
    {
        return Attribute::get(fn () => $this->resume ? basename($this->resume_url) : '');
    }

    protected function url(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->isJobSeeker() || JobBoardHelper::isDisabledPublicProfile()) {
                return '';
            }

            // Load slugable if not already loaded
            if (! $this->relationLoaded('slugable')) {
                $this->load('slugable');
            }

            $slug = $this->slugable?->key;

            if (! $slug) {
                // If no slug exists, return empty or generate a fallback
                return '';
            }

            try {
                return route('public.candidate', ['slug' => $slug]);
            } catch (\Exception $e) {
                return '';
            }
        });
    }

    protected function slug(): Attribute
    {
        return Attribute::get(fn () => $this->slugable?->key ?? '');
    }

    public function canPost(): bool
    {
        return $this->credits > 0 || ! JobBoardHelper::isEnabledCreditsSystem();
    }

    public function isEmployer(): bool
    {
        return $this->type == AccountTypeEnum::EMPLOYER;
    }

    public function isJobSeeker(): bool
    {
        return $this->type == AccountTypeEnum::JOB_SEEKER;
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'jb_companies_accounts', 'account_id', 'company_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(AccountEducation::class, 'account_id');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(AccountExperience::class, 'account_id');
    }

    public function jobs(): MorphMany
    {
        return $this->morphMany(Job::class, 'author');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'account_id');
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'account_id')
            ->whereIn('job_id', $this->jobs()->pluck('id')->all());
    }

    public function savedJobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'jb_saved_jobs', 'account_id', 'job_id');
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'jb_account_packages', 'account_id', 'package_id');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function myReviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'created_by');
    }

    public function completedCompanyProfile(): bool
    {
        foreach ($this->companies()->get() as $company) {
            if ($company->completedProfile()) {
                return true;
            }
        }

        return false;
    }

    public function canReview(BaseModel $reviewable): bool
    {
        if ($reviewable instanceof Company) {
            return $this->isJobSeeker() && $this->myReviews()
                ->where('reviewable_id', $reviewable->getKey())
                ->where('reviewable_type', get_class($reviewable))
                ->doesntExist();
        }

        return $this->isEmployer() && $this->companies()->exists();
    }

    public function favoriteSkills(): BelongsToMany
    {
        return $this->belongsToMany(JobSkill::class, 'jb_account_favorite_skills', 'account_id', 'skill_id');
    }

    public function favoriteTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'jb_account_favorite_tags', 'account_id', 'tag_id');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(AccountActivityLog::class, 'account_id');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(AccountLanguage::class);
    }

    protected function uploadFolder(): Attribute
    {
        return Attribute::make(
            get: function () {
                $folder = $this->id ? 'accounts/' . $this->id : 'accounts';

                return apply_filters('job_board_account_upload_folder', $folder, $this);
            }
        );
    }

    public function languageText(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->languages->isEmpty()) {
                    return '';
                }

                return $this->languages->map(fn ($language) => $language->language_name)->implode(', ');
            }
        );
    }

    protected static function booted(): void
    {
        // Auto-create slug for job seekers when saved
        static::saved(function (Account $account): void {
            if ($account->isJobSeeker() 
                && $account->is_public_profile 
                && !JobBoardHelper::isDisabledPublicProfile()
                && SlugHelper::isSupportedModel(Account::class)) {
                // Check if slug doesn't exist
                if (!SlugHelper::getSlug($account->id, Account::class)) {
                    SlugHelper::createSlug($account);
                }
            }
        });

        static::deleting(function (Account $account): void {
            $account->companies()->detach();
            $account->activityLogs()->delete();
            $account->transactions()->delete();
            $account->applications()->delete();
            $account->reviews()->delete();
            $account->myReviews()->delete();
            $account->savedJobs()->detach();
            $account->packages()->detach();
        });

        static::deleted(function (Account $account): void {
            $folder = Storage::path($account->upload_folder);
            if (File::isDirectory($folder) && Str::endsWith($account->upload_folder, '/' . $account->id)) {
                File::deleteDirectory($folder);
            }
        });
    }
}
