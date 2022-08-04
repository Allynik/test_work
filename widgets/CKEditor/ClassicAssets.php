<?php

namespace app\widgets\CKEditor;

use yii\web\AssetBundle;

class ClassicAssets extends AssetBundle
{
    public $css = [
    ];

    public $js = [
        '/assets/ckeditor/ckeditor.js',
        '/assets/ckeditor/adapters/jquery.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
