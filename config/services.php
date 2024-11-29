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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'facebook' => [
        'client_id' => '1326084581654264',
        'client_secret' => '4911bfc221dcffea362eaa7f48d99439', //4911bfc221dcffea362eaa7f48d99439
        'redirect' => 'https://www.celermart.com/auth/facebook/callback/',
    ],
    'google' => [
        'client_id' => '1067412142423-nobkbggtgvhomeici3rlbr0qcris9dqv.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://www.celermart.com/auth/google/callback',
    ],
    
    // 'github' => [
    //     'client_id'=>'63967012f10fb3961ee7',
    //     'client_secret' =>'3e06dc42a6164657544559089e263acc441a0bcf',
    //     'redirect' =>'http://127.0.0.1:8000/auth/github/callback'
    // ],

    'recaptcha' => [
        'key' => env('RECAPTCHA_SITE_KEY'),
        'secret' => env('RECAPTCHA_SECRET_KEY'),
    ]
];
