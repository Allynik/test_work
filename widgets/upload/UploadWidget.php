<?php

namespace app\widgets\upload;

use Yii;
use yii\helpers\{ArrayHelper, Html};
use yii\widgets\InputWidget;

/**
 * Upload widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class UploadWidget extends InputWidget
{
    /**
     * Default settings.
     *
     * @var array
     */
    protected $defaultOptions = [
        'editable' => true,
        'class' => '',
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if ('form-control' == $this->options['class']) {
            $this->options['class'] = '';
        }
        $this->options = ArrayHelper::merge($this->defaultOptions, $this->options);
        parent::init();
    }

    /**
     * Run widget.
     */
    public function run()
    {
        $filePath = $this->model->{$this->attribute};
        $filePathFull = Yii::getAlias('@webroot') . $filePath;
        if (!file_exists($filePathFull) || !is_file($filePathFull)) {
            $filePath = null;
        }

        echo Html::beginTag('div', ['class' => 'upload-widget']);
        if ($filePath) {
            $fileName = pathinfo($filePath, PATHINFO_BASENAME);

            echo Html::beginTag('a', ['href' => $filePath, 'download' => $fileName, 'class' => 'upload-widget-text']);
            echo Html::encode($fileName);
            $fileSize = Yii::$app->formatter->asShortSize(filesize($filePathFull), 1);
            $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
            echo Html::tag('span', " ({$fileSize}; {$fileExt})", ['class' => 'upload-widget-size']);
            echo Html::endTag('a');

            if ($this->options['editable']) {
                echo Html::beginTag('div', ['class' => 'upload-widget-label']);
                echo Html::checkbox($this->model->formName() . '[' . $this->attribute . '-delete]', false, ['id' => $this->options['id'] . '-delete']);
                echo Html::label('&nbsp;Удалить', $this->options['id'] . '-delete');
                echo Html::endTag('div');
            }

            echo Html::activeFileInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::activeFileInput($this->model, $this->attribute, $this->options);
        }

        echo Html::endTag('div');
    }
}
