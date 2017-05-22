<?php

return [
    'driver' => env('MAIL_DRIVER'),
    'host' => env('MAIL_HOST'),
    'port' => env('MAIL_PORT'),
    'from' => ['address' => env('MAIL_USERNAME'), 'name' => '长沙房安'],
    'encryption' => env('MAIL_ENCRYPTION'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
];