<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionEnquiry extends BaseModel
{
    protected $table = 'jb_admission_enquiries';

    protected $fillable = [
        'company_id',
        'student_name',
        'contact_number',
        'email',
        'admission_for_standard',
        'address',
        'message',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
