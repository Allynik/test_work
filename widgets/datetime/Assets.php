<?php

namespace app\widgets\datetime;

use yii\web\AssetBundle;

/**
 * Assets for datetime widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Assets extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';

    public $css = [
        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    ];

    public $js = [
        'plugins/moment/moment-with-locales.min.js',
        'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    ];

    public $depends = [
        'app\assets\AdminAsset',
    ];
}
