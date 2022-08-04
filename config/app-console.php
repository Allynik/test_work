<?php

$id = env('APP_ID', 'app');

dotenv()->required([
    'APP_TITLE',
])->notEmpty();

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$mailer = require __DIR__ . '/mailer.php';
$log = require __DIR__ . '/log.php';
$queue = require __DIR__ . '/queue.php';
$cache = require __DIR__ . '/cache.php';

$config = [
    'id' => $id . '-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => env('LANGUAGE', 'ru'),
    'name' => env('APP_TITLE'),
    'timeZone' => env('TIMEZONE', 'UTC'),
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => $cache,
        'queue' => $queue,
        'mailer' => $mailer,
        'log' => $log,
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
