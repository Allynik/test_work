<?php

namespace app\components;

class View extends \yii\web\View
{
    public $renderers = [
        'phtml' => ['class' => 'app\components\ViewMacrosRenderer'],
    ];
}
