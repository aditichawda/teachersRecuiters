<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Botble\Media\Facades\RvMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalkinDriveAdRequest extends BaseModel
{
    protected $table = 'jb_walkin_drive_ad_requests';

    protected $fillable = [
        'account_id',
        'company_id',
        'banner_image',
        'placement',
        'message',
        'status',
        'requested_at',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public const PLACEMENT_HOME = 'home';
    public const PLACEMENT_JOB_LISTING = 'job_listing';
    public const PLACEMENT_BOTH = 'both';

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Always expose a usable URL for banner image.
     * DB value may be a relative path (e.g. "walkin-drive-ad/xxx.png") which breaks in admin routes.
     */
    public function getBannerImageUrlAttribute(): ?string
    {
        $value = (string) ($this->getAttribute('banner_image') ?? '');
        $value = trim($value);

        if ($value === '') {
            return null;
        }

        // Already absolute URL or root-relative path.
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '/')) {
            return $value;
        }

        return RvMedia::getImageUrl($value);
    }
}
