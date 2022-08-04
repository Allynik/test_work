<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\{Html, Url};
use yii\web\View;

class HtmlCollapse extends Widget
{
    public $model;

    public $name = 'content';

    public $formatter = true;

    public $formatterConfig = null;

    public $attributes = [
        'class' => 'btn btn-secondary btn-sm btn-block',
        'data-toggle' => 'collapse',
        'role' => 'button',
        'aria-expanded' => 'false',
    ];

    public $cardAttributes = [
        'class' => 'card card-body',
    ];

    public $collapseAttributes = [
        'class' => 'collapse',
    ];

    public $iframeAttributes = [
        'frameborder' => '0',
        'scrolling' => 'yes',
        'height' => 480,
    ];

    public $iframeStylesheet = '/assets/ckeditor/contents.css';

    public function run()
    {
        $name = $this->name;
        $model = $this->model;

        $attributes = $this->attributes;
        $id = $this->getId();
        $attributes['href'] = '#' . $id;

        $labels = $model->attributeLabels();

        echo Html::tag('a', Html::encode($labels[$name]) . '...', $attributes);

        $cardAttributes = $this->cardAttributes;

        $collapseAttributes = $this->collapseAttributes;
        $collapseAttributes['id'] = $id;

        $baseHref = Url::to('/', true);

        $iframeBody = $model->{$name};
        if ($this->formatter) {
            $iframeBody = Yii::$app->formatter->asHtml($iframeBody, $this->formatterConfig);
        }

        $iframeContent = implode("\n", [
            Html::tag('meta', '', ['charset' => 'utf-8']),
            Html::tag('base', '', ['href' => $baseHref, 'target' => '_blank']),
            $this->iframeStylesheet ? Html::tag('link', '', ['href' => Url::to($this->iframeStylesheet, true), 'rel' => 'stylesheet']) : '',
            Html::tag('body', $iframeBody, [
                'onload' => 'parent.postMessage(document.body.scrollHeight, \'' . $baseHref . '\')',
                'onresize' => 'parent.postMessage(document.body.scrollHeight, \'' . $baseHref . '\')',
            ]),
        ]);

        $iframeAttributes = $this->iframeAttributes;
        $iframeAttributes['src'] = 'data:text/html;base64,' . base64_encode($iframeContent);
        $iframeAttributes['id'] = $id . '-iframe';
        $iframeAttributes['onload'] = 'resizeCrossDomainIframe_' . $id . '(\'' . $id . '-iframe' . '\', \'' . $baseHref . '\')';
        $content = Html::tag('iframe', '', $iframeAttributes);

        $js = 'function resizeCrossDomainIframe_' . $id . '(id, other_domain) {';
        $js .= '  var iframe = document.getElementById(id);';
        $js .= '  window.addEventListener("message", function(event) {';
        $js .= '    if (event.origin !== other_domain && event.origin != \'null\') return;';
        $js .= '    if (isNaN(event.data)) return;';
        $js .= '    var height = parseInt(event.data);';
        $js .= '    iframe.height = height + "px";';
        $js .= '  }, false);';
        $js .= '}';

        echo Html::tag('div', Html::tag('div', $content, $cardAttributes), $collapseAttributes);
        $this->getView()->registerJs($js, View::POS_HEAD);
    }
}
