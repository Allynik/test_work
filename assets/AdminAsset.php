<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Admin asset.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';

    public $css = [
        'dist/css/adminlte.min.css',
        'plugins/fontawesome-free/css/all.min.css',
        'plugins/toastr/toastr.min.css',
        'plugins/ekko-lightbox/ekko-lightbox.css',
        '/assets/admin/custom.css',
    ];

    public $js = [
        'dist/js/adminlte.min.js',
        'plugins/toastr/toastr.min.js',
        'plugins/ekko-lightbox/ekko-lightbox.min.js',
        '/assets/admin/custom.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}
