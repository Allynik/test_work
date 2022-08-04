<?php

namespace app\commands;

use app\helpers\EnvHelper;
use Yii;
use yii\console\{Controller, ExitCode};

class AppKeyController extends Controller
{
    public function actionIndex()
    {
        if (env('APP_KEY')) {
            echo "APP_KEY already generated.\n";

            return ExitCode::CONFIG;
        }

        $appKey = $this->generateRandomString(32);
        EnvHelper::writeEnvVars(['APP_KEY' => $appKey]);
        echo "APP_KEY generate complete.\n";

        return ExitCode::OK;
    }

    protected function generateRandomString($length = 32)
    {
        if (!extension_loaded('openssl')) {
            throw new \Exception('The OpenSSL PHP extension is required by Yii2.');
        }
        $bytes = openssl_random_pseudo_bytes($length);

        return strtr(substr(base64_encode($bytes), 0, $length), '+/=', '_-.');
    }
}
