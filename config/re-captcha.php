<?php

return [
    'class' => 'app\components\ReCaptcha',
    'siteKey' => env('RECAPTCHA_SITEKEY', ''),
    'secretKey' => env('RECAPTCHA_SECRETKEY', ''),
    'enabled' => env('RECAPTCHA_ENABLED', false),
];
