<?php

namespace app\components;

use yii\log\FileTarget;

class FileLogTarget extends FileTarget
{
    public $maskVars = [
        '_SERVER.HTTP_AUTHORIZATION',
        '_SERVER.PHP_AUTH_USER',
        '_SERVER.PHP_AUTH_PW',

        '_SERVER.APP_KEY',
        '_SERVER.RECAPTCHA_SITEKEY',
        '_SERVER.RECAPTCHA_SECRETKEY',

        '_SERVER.DB_HOST',
        '_SERVER.DB_NAME',
        '_SERVER.DB_USER',

        '_SERVER.MAIL_HOST',
        '_SERVER.MAIL_USERNAME',
        '_SERVER.MAIL_PASSWORD',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->maskVars = array_merge($this->maskVars, array_map(
            fn ($i) => '_SERVER.' . $i,
            array_keys($_ENV)
        ));
    }
}
