<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'msgclub' => [
        'url' => env('MSGCLUB_WHATSAPP_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'),
        'key' => env('MSGCLUB_AUTH_KEY', env('WHATSAPP_API_KEY')),
        'sender_id' => env('MSGCLUB_SENDER_ID', env('WHATSAPP_SENDER_ID')),
        'template_custom_message' => env('MSGCLUB_TEMPLATE_CUSTOM_MESSAGE', 'school_custom_message_to_applicant'),
        'template_custom_message_button_param' => env('MSGCLUB_TEMPLATE_CUSTOM_MESSAGE_BUTTON_PARAM', 'login/'),
    ],

];