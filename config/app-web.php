<?php

$id = env('APP_ID', 'app');

dotenv()->required([
    'APP_TITLE',
])->notEmpty();

if (!env('APP_KEY')) {
    throw new Exception('APP_KEY is empty. Please run `php yii app-key`.');
}

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$mailer = require __DIR__ . '/mailer.php';
$imageHelper = require __DIR__ . '/image-helper.php';
$assetsHelper = require __DIR__ . '/assets-helper.php';
$log = require __DIR__ . '/log.php';
$cache = require __DIR__ . '/cache.php';
$queue = require __DIR__ . '/queue.php';
$reCaptcha = require __DIR__ . '/re-captcha.php';

$config = [
    'id' => $id,
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'minifyManager'],
    'language' => env('LANGUAGE', 'ru'),
    'name' => env('APP_TITLE'),
    'timeZone' => env('TIMEZONE', 'UTC'),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@views' => '@app/views',
        '@partials' => '@app/views/partials',
    ],
    'components' => [
        'imageHelper' => $imageHelper,
        'assetsHelper' => $assetsHelper,
        'view' => [
            'class' => 'app\components\View',
            'renderers' => [
                'phtml' => ['class' => 'app\components\ViewMacrosRenderer'],
            ],
        ],
        'formatter' => [
            'class' => 'app\components\Formatter',
            'locale' => env('LANGUAGE', 'ru'),
            'timeZone' => env('TIMEZONE', 'UTC'),
            'defaultTimeZone' => env('TIMEZONE', 'UTC'),
            'htmlPurifier' => require __DIR__ . '/html-purifier.php',
        ],
        'reCaptcha' => $reCaptcha,
        'minifyManager' => [
            'class' => 'app\components\MinifyManager',
            'html' => !YII_DEBUG,
            'css' => !YII_DEBUG,
            'js' => !YII_DEBUG,
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets/cache',
            'baseUrl' => '@web/assets/cache',
        ],
        'request' => [
            'class' => 'app\components\Request',
            'cookieValidationKey' => env('APP_KEY'),
            'baseUrl' => '',
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                ],
            ],
        ],
        'queue' => $queue,
        'cache' => $cache,
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => $mailer,
        'log' => $log,
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//         'enableStrictParsing' => true,
            'enableStrictParsing' => false,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'action' => 301,
            ],
            'rules' => [
                'default' => [
                    'pattern' => '/',
                    'route' => 'site/index',
                ],
                'maintenance' => [
                    'pattern' => '/maintenance',
                    'route' => 'site/maintenance',
                ],
                'blog' => [
                  'pattern' => '/blog',
                  'route' => 'site/blog'
                ],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'pages' => [
            'class' => 'app\modules\pages\Module',
        ],
    ],
    'container' => [
        'definitions' => [
            'yii\widgets\LinkPager' => 'yii\bootstrap4\LinkPager',
        ],
    ],
];

$config['bootstrap'][] = 'admin';

// important! add pages bootstrap after all other modules!
$config['bootstrap'] = array_merge($config['bootstrap'], ['pages']);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment

//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        // uncomment the following to add your IP if you are not connecting from localhost.
//        'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    // $config['components']['cache'] = [
    //     'class' => 'yii\caching\DummyCache',
    // ];
}

return $config;
