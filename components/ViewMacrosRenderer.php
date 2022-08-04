<?php

namespace app\components;

use yii\base\InvalidCallException;

class ViewMacrosRenderer extends \yii\base\ViewRenderer
{
    public static $macrosCache = [];

    /**
     * Renders a view file.
     *
     * This method is invoked by [[View]] whenever it tries to render a view.
     * Child classes must implement this method to render the given view file.
     *
     * @param View   $view   the view object used for rendering the file
     * @param string $file   the view file
     * @param array  $params the parameters to be passed to the view file
     *
     * @return string the rendering result
     */
    public function render($view, $file, $params)
    {
        if ($params) {
            throw new InvalidCallException("Macros: `$file` not allow params.");
        }
        if (array_key_exists($file, static::$macrosCache)) {
            return static::$macrosCache[$file];
        }
        $templateClosure = function ($_path_) {
            /* @noinspection PhpIncludeInspection */
            return include $_path_;
        };
        $result = $templateClosure($file);
        $macros = new ViewMacros($result);
        static::$macrosCache[$file] = $macros;

        return $macros;
    }
}
