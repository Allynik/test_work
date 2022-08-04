<?php

\Yii::setAlias('@app', dirname(__DIR__) . '/app');

$id = env('APP_ID', 'app');
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

return [
    'id' => $id . '-tests',
    'basePath' => dirname(__DIR__),
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'aliases' => [
        '@config' => '@app/config',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@views' => '@app/views',
        '@partials' => '@app/views/partials',
    ],
    'language' => env('LANGUAGE', 'ru'),
    'components' => [
        'formatter' => [
            'locale' => env('LANGUAGE', 'ru'),
        ],
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets/cache',
            'baseUrl' => '@web/assets/cache',
            'forceCopy' => YII_DEBUG,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
];
