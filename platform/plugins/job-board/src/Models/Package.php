<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends BaseModel
{
    protected $table = 'jb_packages';

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency_id',
        'percent_save',
        'number_of_listings',
        'account_limit',
        'order',
        'is_default',
        'features',
        'status',
        'package_type',
        'validity_days',
        'credits_included',
        'profile_views_allowed',
        'job_apply_limit',
        'worth',
    ];

    protected $casts = [
        'status' => \Botble\JobBoard\Casts\PackageStatusCast::class,
        'name' => SafeContent::class,
        'features' => 'json',
    ];

    protected $appends = [
        'feature_featured_profile',
        'feature_admission_form_on_profile',
        'feature_resume_builder',
        'feature_basic_cv',
        'feature_advance_cv',
        'feature_view_school_contact_info',
        'feature_job_alerts_whatsapp',
        'feature_featured_profile_js',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'jb_account_packages', 'package_id', 'account_id');
    }

    public function getTotalPriceAttribute(): float
    {
        $price = (float) ($this->price ?? 0);
        $percent = (float) ($this->percent_save ?? 0);

        return $price - ($price * $percent / 100);
    }

    public function getPriceTextAttribute(): string
    {
        return format_price($this->price, $this->currency);
    }

    public function getPricePerPostTextAttribute(): string
    {
        return trans('plugins/job-board::messages.price_per_post', ['price' => format_price($this->price / ($this->number_of_listings ?: 1), $this->currency)]);
    }

    public function getNumberPostsFreeAttribute(): string
    {
        return trans('plugins/job-board::messages.free_posts', ['number' => $this->number_of_listings]);
    }

    public function getPriceTextWithSaleOffAttribute(): string
    {
        return trans('plugins/job-board::messages.price_total_with_save', ['price' => $this->price_text, 'percentage_sale' => $this->percent_save_text ? '(' . $this->percent_save_text . ')' : '']);
    }

    public function getPercentSaveTextAttribute(): string
    {
        $text = '';

        if ($this->percent_save) {
            $text .= ' ' . trans('plugins/job-board::messages.save_percentage', ['percentage' => $this->percent_save]);
        }

        return $text;
    }

    public function isPurchased(): bool
    {
        return $this->account_limit && $this->accounts_count >= $this->account_limit;
    }

    protected function formattedFeatures(): Attribute
    {
        return Attribute::get(
            function () {
                $features = is_array($this->features) ? $this->features : (array) json_decode($this->features ?: '[]', true);
                return collect($features)
                    ->map(function ($feature) {
                        if (! is_array($feature)) {
                            return is_string($feature) ? $feature : null;
                        }
                        $keyValue = collect($feature)->pluck('value', 'key');
                        $text = $keyValue->get('text') ?? $keyValue->get('title') ?? $keyValue->first();
                        if ($text !== null && $text !== '') {
                            return $text;
                        }
                        return $feature['text'] ?? $feature['title'] ?? $feature['value'] ?? $feature['key'] ?? null;
                    })
                    ->filter()
                    ->values()
                    ->toArray();
            }
        );
    }

    /**
     * Check if this package includes a feature by display text (e.g. "Featured Profile", "Admission Form on Profile").
     * Excludes negative features like "Advance CV: No" so they do not count as having the feature.
     */
    public function hasFeatureText(string $text): bool
    {
        $features = $this->formatted_features ?? [];
        $needle = trim($text);
        if ($needle === '') {
            return false;
        }
        foreach ($features as $feature) {
            if (is_string($feature) && stripos($feature, $needle) !== false && ! $this->isFeatureDenied($feature)) {
                return true;
            }
        }
        $raw = is_array($this->features) ? $this->features : (array) json_decode($this->features ?: '[]', true);
        foreach ($raw as $item) {
            if (! is_array($item)) {
                if (is_string($item) && stripos($item, $needle) !== false && ! $this->isFeatureDenied($item)) {
                    return true;
                }
                continue;
            }
            $val = $item['text'] ?? $item['title'] ?? $item['value'] ?? ($item['key'] ?? null);
            if (is_string($val) && stripos($val, $needle) !== false && ! $this->isFeatureDenied($val)) {
                return true;
            }
            foreach (array_values($item) as $anyVal) {
                if (is_string($anyVal) && stripos($anyVal, $needle) !== false && ! $this->isFeatureDenied($anyVal)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Feature text like "Advance CV: No" or "Featured Profile: No" means the feature is denied, not included.
     */
    protected function isFeatureDenied(string $featureText): bool
    {
        return (bool) preg_match('/\s*:\s*No\s*$/i', trim($featureText));
    }

    /**
     * Check if package includes "Admission Form on Profile" (or similar) – used for admission form unlock.
     */
    public function hasAdmissionFormOnProfileFeature(): bool
    {
        return $this->hasFeatureText('Admission Form on Profile')
            || $this->hasFeatureText('Admission Form on profile')
            || $this->hasFeatureText('Admission Form');
    }

    /**
     * Check if package includes "Job Posting Assistance" (job assistant) – used for wallet coin feature unlock.
     */
    public function hasJobPostingAssistanceFeature(): bool
    {
        return $this->hasFeatureText('Job Posting Assistance')
            || $this->hasFeatureText('Job Assistant')
            || $this->hasFeatureText('Job posting assistance');
    }

    /**
     * Whether this package is "Admission Form Unlock" only (paid unlock, no credits).
     * When purchased, we grant admission entitlement via transaction, not credits.
     */
    public function isAdmissionUnlockOnly(): bool
    {
        $credits = (int) ($this->credits_included ?? $this->number_of_listings ?? 0);

        return $this->hasAdmissionFormOnProfileFeature() && $credits <= 0;
    }

    /**
     * Apply employer package features (e.g. Featured Profile) to the account's companies.
     * Call after a successful package purchase for an employer.
     */
    public function applyEmployerPackageFeatures(Account $account): void
    {
        if (! $account->isEmployer()) {
            return;
        }
        if ($this->hasFeatureText('Featured Profile')) {
            $account->companies()->update(['is_featured' => 1]);
        }
    }

    /** Form bindings for package feature checkboxes (employer). */
    public function getFeatureFeaturedProfileAttribute(): bool
    {
        return $this->hasFeatureText('Featured Profile');
    }

    public function getFeatureAdmissionFormOnProfileAttribute(): bool
    {
        return $this->hasAdmissionFormOnProfileFeature();
    }

    /** Form bindings for package feature checkboxes (job seeker). */
    public function getFeatureFeaturedProfileJsAttribute(): bool
    {
        return $this->hasFeatureText('Featured Profile');
    }

    public function getFeatureResumeBuilderAttribute(): bool
    {
        return $this->hasFeatureText('Resume Builder');
    }

    public function getFeatureBasicCvAttribute(): bool
    {
        return $this->hasFeatureText('Basic CV');
    }

    public function getFeatureAdvanceCvAttribute(): bool
    {
        return $this->hasFeatureText('Advance CV') || $this->hasFeatureText('Advanced CV');
    }

    public function getFeatureViewSchoolContactInfoAttribute(): bool
    {
        return $this->hasFeatureText('View School Contact Info');
    }

    public function getFeatureJobAlertsWhatsappAttribute(): bool
    {
        return $this->hasFeatureText('Job Alerts on WhatsApp');
    }
}
