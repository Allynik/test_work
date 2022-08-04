<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class ImageThumb extends Widget
{
    public $model;

    public $name = 'image';

    public $attributes = ['class' => 'img-thumbnail'];

    public $profile = 'thumb';

    public function run()
    {
        $name = $this->name;
        $model = $this->model;
        $image = $model->{$name};
        $profile = $this->profile;
        $attributes = $this->attributes;

        return $image ? Html::a(Html::img($model->getThumbUploadUrl($name, $profile), $attributes), $image) : null;
    }
}
