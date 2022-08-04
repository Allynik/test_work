<?php

namespace app\widgets\CKEditor;

use yii\helpers\Html;

class ClassicEditor extends CKEditor
{
    /**
     * {@inheritdoc}
     */
    protected function registerAssets($view)
    {
        ClassicAssets::register($view);
    }

    /**
     * {@inheritdoc}
     */
    protected function printEditorTag()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
    }
}
