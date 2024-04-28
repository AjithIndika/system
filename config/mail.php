<?php

return [



    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [

        'smtp2' => [
            'transport' => 'smtp',
            'host' => env('SMTP2_MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('SMTP2_MAIL_PORT', 587),
            'encryption' => env('SMTP2_MAIL_ENCRYPTION', 'tls'),
            'username' => env('SMTP2_MAIL_USERNAME'),
            'password' => env('SMTP2_MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
             'verify_peer' => false,
        ],

        'hr' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
             'verify_peer' => false,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],


        'it' => [
            'transport' => 'smtp',
            'host' => env('IT_HOST', 'smtp.mailgun.org'),
            'port' => env('IT_PORT', 587),
            'encryption' => env('IT_ENCRYPTION', 'tls'),
            'username' => env('IT_USERNAME'),
            'password' => env('IT_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
             'verify_peer' => false,
        ],


        'book' => [
            'transport' => 'smtp',
            'host' => env('IT_HOST', 'smtp.mailgun.org'),
            'port' => env('IT_PORT', 587),
            'encryption' => env('IT_ENCRYPTION', 'tls'),
            'username' => env('IT_USERNAME'),
            'password' => env('IT_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
             'verify_peer' => false,
        ],


        'stock' => [
            'transport' => 'smtp',
            'host' => env('IT_HOST', 'smtp.mailgun.org'),
            'port' => env('IT_PORT', 587),
            'encryption' => env('IT_ENCRYPTION', 'tls'),
            'username' => env('IT_USERNAME'),
            'password' => env('IT_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
             'verify_peer' => false,
        ],




        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
