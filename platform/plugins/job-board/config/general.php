<?php

return [
    'verification_expire_minutes' => 60,

    'ai_job_description' => [
        'enabled' => env('JOB_BOARD_AI_JOB_DESCRIPTION_ENABLED', true),
        'provider' => env('JOB_BOARD_AI_PROVIDER', 'gemini'),
        'openai' => [
            'api_key' => env('OPENAI_API_KEY', env('JOB_BOARD_OPENAI_API_KEY', '')),
            'model' => env('JOB_BOARD_OPENAI_MODEL', 'gpt-4o-mini'),
            'max_tokens' => (int) env('JOB_BOARD_OPENAI_MAX_TOKENS', 1500),
        ],
        'gemini' => [
            'api_key' => env('GEMINI_API_KEY', env('GOOGLE_AI_API_KEY', '')),
            'model' => env('JOB_BOARD_GEMINI_MODEL', 'gemini-1.5-flash'),
            'max_tokens' => (int) env('JOB_BOARD_GEMINI_MAX_TOKENS', 1500),
        ],
    ],
    'bulk-import' => [
        'mime_types' => [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/csv',
            'application/csv',
            'text/plain',
        ],
        'mimes' => [
            'xls',
            'xlsx',
            'csv',
        ],
    ],
];
