<?php

namespace app\components;

use JSMin;
use WebSharks\CssMinifier\Core as CssMinifier;
use Yii;
use yii\base\{Component, Event};
use yii\web\{Response, View};

class MinifyManager extends Component
{
    /**
     * Minify html. Process before response send.
     *
     * @var bool
     */
    public $html = true;

    /**
     * Minify css on page, added by registerCss. Process before render page in view component.
     *
     * @var bool
     */
    public $css = true;

    /**
     * Minify css on page. Process before render page in view component.
     *
     * @var bool
     */
    public $js = true;

    /**
     * Response formats list, where enable minify html.
     *
     * @var array
     */
    public $formats = [
        Response::FORMAT_HTML,
    ];

    public function init()
    {
        /* @var $this View */
        Yii::$app->view->on(View::EVENT_END_PAGE, [$this, 'onEventEndPage']);
        Yii::$app->response->on(Response::EVENT_BEFORE_SEND, [$this, 'onEventBeforeSend']);
    }

    public function onEventEndPage(Event $event)
    {
        $view = $event->sender;

        if ($this->css && !empty($view->css)) {
            foreach ($view->css as &$css) {
                $css = $this->minifyCSS($css);
            }
        }

        if ($this->js && !empty($view->js)) {
            foreach ($view->js as &$list) {
                foreach ($list as &$js) {
                    $js = $this->minifyJS($js);
                }
            }
        }
    }

    public function onEventBeforeSend(Event $event)
    {
        $response = $event->sender;

        if ($this->html & in_array($response->format, $this->formats)) {
            if (!empty($response->data)) {
                $response->data = $this->minifyHTML($response->data);
            }
            if (!empty($response->content)) {
                $response->content = $this->minifyHTML($response->content);
            }
        }
    }

    public function minifyJS($string)
    {
        $string = JSMin::minify($string);

        return $string;
    }

    public function minifyCSS($string)
    {
        $string = CssMinifier::compress($string);

        return $string;
    }

    public function minifyHTML($string)
    {
        $original = $string;
        $ignored = '~(?<open><(?<tag>pre|textarea|script|style)[^>]*>)(?<inner>.*?)(?<close></\\2>)~is';
        // Save ignored tags
        $string = preg_replace_callback($ignored, function ($matches) {
            return $matches['open'] . ('' === $matches['inner'] ? '' : rawurlencode($matches['inner'])) . $matches['close'];
        }, $string);
        if (null === $string) {
            return $original;
        }
        // Replace newlines, returns and tabs with spaces
        $string = preg_replace('/([\t ]*)\n([\t ]*)/', "\n", $string);
        $string = str_replace(["\r", "\n", "\t"], ' ', $string);
        // Replace multiple spaces with a single space
        $string = preg_replace('/(>)\s+/m', '$1 ', $string);
        $string = preg_replace('/\s+(<)/m', ' $1', $string);
        // Remove spaces that are followed by either > or <
        $string = preg_replace('/ (>)/', '$1', $string);
        // Remove spaces that are preceded by either > or <
        $string = preg_replace('/(<) /', '$1', $string);
        // Remove spaces that are between > and <
        $string = preg_replace('/(>)\s+(<)/', '> $2', $string);
        // Restore ignored tags
        $stylePattern = '~^(application|text)/(x\\-)?css$~';
        $scriptPattern = '~^(application|text)/(x\\-)?(ecmascript|javascript|jscript|livescript)(\\d+\\.\\d+)?$~i';
        $typePattern = "~type\s*=\s*([\"'])(?<type>.+)(\\1)~ism";
        $string = preg_replace_callback($ignored, function ($matches) use ($typePattern, $stylePattern, $scriptPattern) {
            $matches['tag'] = strtolower($matches['tag']);
            if ('' !== $matches['inner'] && 'script' == $matches['tag']) {
                preg_match($typePattern, $matches['open'], $attrs);
                if (!isset($attrs['type']) || preg_match($scriptPattern, $attrs['type'])) {
                    $matches['inner'] = $this->minifyJS(rawurldecode($matches['inner']));
                    $matches['inner'] = strtr($matches['inner'], ["\n" => ' ']);

                    return $matches['open'] . trim($matches['inner']) . $matches['close'];
                }
            }
            if ('' !== $matches['inner'] && 'style' == $matches['tag']) {
                preg_match($typePattern, $matches['open'], $attrs);
                if (!isset($attrs['type']) || preg_match($stylePattern, $attrs['type'])) {
                    $matches['inner'] = $this->minifyCSS(rawurldecode($matches['inner']));
                    $matches['inner'] = strtr($matches['inner'], ["\n" => ' ']);

                    return $matches['open'] . trim($matches['inner']) . $matches['close'];
                }
            }

            return $matches['open'] . ('' === $matches['inner'] ? '' : rawurldecode($matches['inner'])) . $matches['close'];
        }, $string);
        if (null === $string) {
            return $original;
        }

        return $string;
    }
}
