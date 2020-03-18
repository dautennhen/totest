<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, SparkPost and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '2272091199768669',
        'client_secret' => 'a698d6675b45bbbef34a9b564d08d567',
        'redirect' => 'https://totest.local/callback/facebook',
    ],
    'google' => [
        'client_id' => '407339006510-1p54rmr2th8dajkdrbmbr08hb1cj4ovv.apps.googleusercontent.com',
        'client_secret' => 'NBN4odRf1T9fUnPl1u3g9wEq',
        'redirect' => 'https://totest.local/callback/google',
    ]
];
