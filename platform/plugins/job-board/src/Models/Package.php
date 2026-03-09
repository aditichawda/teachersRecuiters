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
        'worth',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'features' => 'json',
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
                        return $keyValue->get('text') ?? $keyValue->first();
                    })
                    ->filter()
                    ->values()
                    ->toArray();
            }
        );
    }
}
