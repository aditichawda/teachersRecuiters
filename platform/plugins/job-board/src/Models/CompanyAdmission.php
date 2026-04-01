<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyAdmission extends BaseModel
{
    protected $table = 'jb_company_admissions';

    protected $fillable = [
        'company_id',
        'content',
        'admission_deadline',
        'status',
    ];

    protected $casts = [
        'content' => SafeContent::class,
        'admission_deadline' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(AdmissionEnquiry::class, 'company_id');
    }
}
