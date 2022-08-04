<?php

dotenv()->required([
    'DB_HOST',
    'DB_NAME',
    'DB_USER',
    // 'DB_PASS',
])->notEmpty();

$dsn = env('DB_DSN', 'mysql:host={host};dbname={dbname}');

return [
    'class' => 'yii\db\Connection',
    'dsn' => strtr($dsn, [
        '{host}' => env('DB_HOST'),
        '{dbname}' => env('DB_NAME'),
    ]),
    'username' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'charset' => 'utf8mb4',
    'attributes' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
    ],
    // Schema cache options (default 'off' for dev env)
    'schemaCache' => env('DB_SCHEMA_CACHE', false), // use 'cache' for production
    'enableSchemaCache' => false !== env('DB_SCHEMA_CACHE', false),
    'schemaCacheDuration' => env('DB_SCHEMA_CACHE_DURATION', 60),
    'on afterOpen' => function ($event) {
        $timeZone = date('P');
        $timeZone = $event->sender->pdo->quote($timeZone);
        $event->sender->createCommand("SET time_zone=$timeZone")->execute();
        $event->sender->createCommand("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))")->execute();
    },
];
