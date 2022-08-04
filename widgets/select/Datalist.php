<?php

namespace app\widgets\select;

use yii\bootstrap4\InputWidget;
use yii\helpers\{ArrayHelper, Html};

/**
 * Datalist widget.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Datalist extends InputWidget
{
    protected $items;

    protected $containerOptions = [];

    protected $useKeysAsValues;

    /**
     * Init widget.
     */
    public function init()
    {
        parent::init();

        $this->items = [];
        if (isset($this->options['items'])) {
            $this->items = $this->options['items'];
            unset($this->options['items']);
        }

        $this->useKeysAsValues = false;
        if (isset($this->options['useKeysAsValues'])) {
            $this->useKeysAsValues = (bool) $this->options['useKeysAsValues'];
        }
    }

    /**
     * Run widget.
     */
    public function run()
    {
        $attributes = ArrayHelper::remove($this->options, 'attributes', []);
        if (!isset($attributes['class'])) {
            $attributes['class'] = 'form-control';
        }
        echo Html::beginTag('div', $this->containerOptions);

        $datalistId = Html::getInputId($this->model, $this->attribute) . '-values';
        $attributes['list'] = $datalistId;
        if ($this->hasModel()) {
            echo Html::activeInput('text', $this->model, $this->attribute, $attributes);
        } else {
            echo Html::input('text', $this->name, $this->value, $attributes);
        }

        echo Html::beginTag('datalist', ['id' => $datalistId]);
        foreach ($this->items as $itemKey => $itemValue) {
            echo Html::tag('option', $this->useKeysAsValues ? $itemValue : '', ['value' => $this->useKeysAsValues ? $itemKey : $itemValue]);
        }
        echo Html::endTag('datalist');
    }
}
