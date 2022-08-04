<?php

namespace app\widgets\inputmask;

use yii\bootstrap4\InputWidget;
use yii\helpers\{ArrayHelper, Html, Json};
use yii\web\View;

/**
 * Mask widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class InputMask extends InputWidget
{
    /**
     * Container options.
     *
     * @var array
     */
    public $containerOptions = [];
    /**
     * Icon class.
     *
     * @var string
     */
    protected $iconClass = '';

    /**
     * Init widget.
     */
    public function init()
    {
        parent::init();

        $this->containerOptions['class'] = 'input-group';
    }

    /**
     * Run widget.
     */
    public function run()
    {
        Assets::register($this->getView());
        $attributes = ArrayHelper::remove($this->options, 'attributes', []);
        if (!isset($attributes['class'])) {
            $attributes['class'] = 'form-control';
        }

        echo Html::beginTag('div', $this->containerOptions);

        if ($this->hasModel()) {
            echo Html::activeInput('text', $this->model, $this->attribute, $attributes);
        } else {
            echo Html::input('text', $this->name, $this->value, $attributes);
        }

        echo Html::beginTag('div', ['class' => 'input-group-append']);
        echo Html::beginTag('div', ['class' => 'input-group-text']);
        echo Html::tag('i', '', ['class' => $this->iconClass]);
        echo Html::endTag('div');
        echo Html::endTag('div');

        $js = 'jQuery(function ($) {';
        $js .= '$("#' . $this->options['id'] . '").inputmask(' . Json::encode($this->options) . ');';
        $js .= '});';

        echo Html::endTag('div');
        $this->getView()->registerJs($js, View::POS_END);
    }
}
