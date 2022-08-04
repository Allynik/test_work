<?php

namespace app\widgets\upload;

use Mimey\MimeTypes;
use Yii;
use yii\helpers\Html;
use yii\imagine\Image;

/**
 * Image upload widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class ImageWidget extends UploadWidget
{
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
        $this->options['accept'] = 'image/*';

        echo Html::beginTag('div', ['class' => 'upload-widget']);
        if ($filePath) {
            $baseName = pathinfo($filePath, PATHINFO_BASENAME);

            echo Html::beginTag('div', ['class' => 'upload-widget-image']);
            echo Html::img($this->renderDataUri($filePathFull), ['class' => 'img-thumbnail']);
            echo Html::endTag('div');

            echo Html::beginTag('a', ['href' => $filePath, 'download' => $baseName, 'class' => 'upload-widget-text']);
            echo Html::encode($baseName);
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

    protected function renderDataUri($filepath)
    {
        $mimeTypes = new MimeTypes();

        $dataMimeType = $mimeTypes->getMimeType(pathinfo($filepath, PATHINFO_EXTENSION));
        $dataBody = base64_encode(Image::resize($filepath, 96, 96));

        return "data:{$dataMimeType};base64,{$dataBody}";
    }
}
