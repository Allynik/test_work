<?php
/**
 * @see http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'assets/front/css/app.min.css',
//        'assets/front/css/app.min.css.br',
//        'assets/front/css/app.min.css.gz',
//       'assets/front/css/def_yii.css'
    ];
    public $js = [
//        'assets/front/js/app.min.js',
//        'assets/front/js/app.min.br',
//        'assets/front/js/app.min.gz',
//        'assets/front/js/vendor.min.js',
//        'assets/front/js/vendor.min.js.br',
//        'assets/front/js/vendor.min.js.gz',
    ];
    public $depends = [];
}
