<?php

return [
    'encoding' => 'UTF-8',

    'user' => [
        'passwordMinLength' => 8,
        'passwordResetTokenExpire' => 3600, // time to token expire, seconds
    ],

    'bsVersion' => 4,

    'ckeditor' => require __DIR__ . '/ckeditor.php',
];
