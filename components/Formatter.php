<?php

namespace app\components;

use yii\i18n\Formatter as BaseFormatter;

class Formatter extends BaseFormatter
{
    public $htmlPurifier = null;

    public function asHtml($value, $config = null)
    {
        if (null === $value) {
            return $this->nullDisplay;
        }
        if (null === $config) {
            $config = $this->htmlPurifier;
        }

        return parent::asHtml($value, $config);
    }
}