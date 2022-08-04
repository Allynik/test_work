<?php
// resolve symlink www dir
chdir(realpath(getcwd()));

require __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../bootstrap.php');

// support .env file.
dotenv(dirname(__DIR__))->load();
dotenv()->required('APP_DEBUG')->isBoolean();
dotenv()->required('APP_ENV')->allowedValues(['prod', 'dev']);

define('YII_DEBUG', env('APP_DEBUG'));
define('YII_ENV', env('APP_ENV'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/app-web.php';

(new yii\web\Application($config))->run();
