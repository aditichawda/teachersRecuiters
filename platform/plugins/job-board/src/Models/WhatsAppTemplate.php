<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;

class WhatsAppTemplate extends BaseModel
{
    protected $table = 'whatsapp_templates';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'language_code',
        'parameters',
        'is_active',
    ];

    protected $casts = [
        'parameters' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get active template by name
     */
    public static function getActiveByName(string $name): ?self
    {
        return static::where('name', $name)
            ->where('is_active', true)
            ->first();
    }
}
