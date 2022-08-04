<?php

dotenv()->required([
    'MAIL_TRANSPORT',
    'MAIL_FROMADDRESS',
    'MAIL_FROMNAME',
    'MAIL_HOST',
    'MAIL_PORT',
    'MAIL_ENCRYPTION',
    'MAIL_USERNAME',
    'MAIL_PASSWORD',
]);

$mailer = [
    'class' => 'yii\swiftmailer\Mailer',
    'messageClass' => 'app\components\MaillogMessage',
    'enableSwiftMailerLogging' => false,
    'messageConfig' => [
        'charset' => 'UTF-8',
        'from' => [env('MAIL_FROMADDRESS') => env('MAIL_FROMNAME')],
    ],
];
if ('smtp' === env('MAIL_TRANSPORT', false)) {
    $mailer['useFileTransport'] = false;
    $mailer['transport'] = [
        'class' => 'Swift_SmtpTransport',
        'host' => env('MAIL_HOST'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'port' => env('MAIL_PORT'),
        'encryption' => env('MAIL_ENCRYPTION'),
        'streamOptions' => [
            'ssl' => [
                'verify_peer' => !YII_ENV_DEV,
                'verify_peer_name' => !YII_ENV_DEV,
            ],
        ],
    ];
} else {
    $mailer['transport'] = [
        'class' => 'Swift_MailTransport',
    ];
}

$mailer['transport']['plugins'] = [
    [
        'class' => 'Openbuildings\Swiftmailer\CssInlinerPlugin',
    ],
];

return $mailer;
