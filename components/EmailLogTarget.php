<?php

namespace app\components;

use yii\log\Target;

class EmailLogTarget extends Target
{
    public $email = null;

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

    /**
     * {@inheritdoc}
     */
    public function export()
    {
        if (!$this->email) {
            return;
        }

        $body = [];

        if ('cli' == substr(PHP_SAPI, 0, 3)) {
            $subject = 'Application log: ' . $_SERVER['SCRIPT_NAME'];
            $requestArgv = isset($_SERVER['argv']) && is_array($_SERVER['argv']) ? addcslashes(implode(' ', $_SERVER['argv']), "\0..\37") : '';
            $body[] = '<h1>Application log: `' . htmlspecialchars($_SERVER['SCRIPT_NAME'] . ' ' . $requestArgv) . "`</h1>\n";
        } else {
            $subject = 'Application log: ' . $_SERVER['HTTP_HOST'];
            $requestProto = !empty($_SERVER['https']) || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && 'https' == $_SERVER['HTTP_X_FORWARDED_PROTO']) ? 'https' : 'http';
            $requestUrl = $requestProto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $body[] = '<h1>Application log: `' . htmlspecialchars($requestUrl) . "`</h1>\n";
        }

        $messages = array_map([$this, 'formatMessage'], $this->messages);
        $body[] = '<pre>' . htmlspecialchars(implode("\n\n", $messages)) . '</pre>';
        $body = implode("\n\n", $body);

        $headers = ['MIME-Version: 1.0', 'Content-type: text/html; charset=utf-8'];
        if (!empty($_SERVER['SERVER_ADMIN']) && filter_var($_SERVER['SERVER_ADMIN'], FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'From: ' . htmlspecialchars($_SERVER['SERVER_ADMIN']);
        }
        $headers = implode("\r\n", $headers);

        $to = is_array($this->email) ? implode(', ', $this->email) : (string) $this->email;
        @mail($to, $subject, $body, $headers);
    }
}
