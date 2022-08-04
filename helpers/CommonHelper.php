<?php

namespace app\helpers;

use Yii;
use yii\helpers\{Inflector, StringHelper};

class CommonHelper
{
    public static function slugify($str, $truncate = 80)
    {
        $slug = Inflector::slug($str, '-', false);
        if ($truncate > 0) {
            $slug = StringHelper::truncate($slug, $truncate, '~');
        }
        $slug = trim($slug, '/.-?');
        if (strlen($slug) >= PHP_MAXPATHLEN) {
            $slug = substr($slug, 0, PHP_MAXPATHLEN);
        }

        return $slug;
    }

    public static function urlmtime($url)
    {
        return AssetsHelper::urlmtime($url);
    }
}
