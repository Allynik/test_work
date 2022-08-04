<?php

namespace app\widgets\datetime;

use Yii;
use yii\bootstrap4\InputWidget;
use yii\helpers\{ArrayHelper, Html, Json};
use yii\web\View;

/**
 * Datetime widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class DateTime extends InputWidget
{
    /**
     * Container options.
     *
     * @var array
     */
    public $containerOptions = [];
    /**
     * Date format.
     *
     * @var string
     */
    protected $format = 'YYYY-MM-DD HH:mm:ss';

    /**
     * Icon class.
     *
     * @var string
     */
    protected $iconClass = 'far fa-calendar-alt';

    /**
     * Init widget.
     */
    public function init()
    {
        parent::init();

        if (isset($this->options['format'])) {
            $this->format = $this->options['format'];
        }
        $this->options['locale'] = Yii::$app->language;
        $this->containerOptions['class'] = 'input-group';
        $this->containerOptions['data-toggle'] = 'datetimepicker';
        $this->containerOptions['data-target'] = '#' . $this->options['id'];
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
        $js .= '$("#' . $this->options['id'] . '").datetimepicker({format:' . Json::encode($this->format);
        $js .= ', locale: moment.locale(' . Json::encode($this->options['locale']) . ')';
        $js .= '});';
        $js .= '});';

        echo Html::endTag('div');
        $this->getView()->registerJs($js, View::POS_END);
    }
}
