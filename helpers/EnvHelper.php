<?php

namespace app\helpers;

use Yii;

class EnvHelper
{
    public static function getEnvFullPath()
    {
        return Yii::getAlias('@app') . DIRECTORY_SEPARATOR . '.env';
    }

    public static function isEnvWritable()
    {
        $envPath = self::getEnvFullPath();

        return is_writable($envPath);
    }

    public static function writeEnvVars(array $params)
    {
        if (!self::isEnvWritable()) {
            return false;
        }
        $envPath = self::getEnvFullPath();

        $envLines = file($envPath);
        foreach ($envLines as $index => $line) {
            $line = trim($line);
            foreach ($params as $var => $value) {
                if (0 === strpos($line, $var)) {
                    $line = ($var . '=' . self::encodeEnvVar($value));

                    break;
                }
            }
            $envLines[$index] = $line;
        }

        return file_put_contents($envPath, implode("\n", $envLines));
    }

    public static function encodeEnvVar($value)
    {
        if (null === $value) {
            return 'null';
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_int($value)) {
            return (int) $value;
        } elseif (is_float($value)) {
            return (float) $value;
        } else {
            return '"' . addcslashes($value, "\"\n\r\t") . '"';
        }
    }
}
