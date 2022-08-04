<?php

namespace app\widgets\inputmask;

use yii\web\AssetBundle;

/**
 * Assets for inputmask.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Assets extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';

    public $js = [
        'plugins/inputmask/jquery.inputmask.min.js',
    ];

    public $depends = [
        'app\assets\AdminAsset',
    ];
}
