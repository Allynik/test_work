<?php

return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'app\components\FileLogTarget',
            'levels' => ['error', 'warning'],
            'except' => ['yii\web\HttpException:404'],
        ],
        [
            'class' => 'app\components\EmailLogTarget',
            'levels' => ['error', 'warning'],
            'email' => 'errors@intecmedia.ru',
            'except' => ['yii\web\HttpException:404', 'yii\web\HttpException:400'],
        ],
    ],
];
