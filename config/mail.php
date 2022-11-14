<?php

return [

    'driver' => env('MAIL_DRIVER', 'mail'),
    'host' => env('MAIL_HOST', 'mail.sensorbd.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'info@sensorbd.com'),
        'name' => env('MAIL_FROM_NAME', 'Sensor Courier'),
    ],

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'stream' => [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ],

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',
    

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],


    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
