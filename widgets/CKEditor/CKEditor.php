<?php

namespace app\widgets\CKEditor;

use Yii;
use yii\helpers\{ArrayHelper, Html, Json};
use yii\web\{JsExpression, View};
use yii\widgets\InputWidget;

abstract class CKEditor extends InputWidget
{
    /**
     * Container options.
     *
     * @var array
     */
    public $containerOptions = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var array Toolbar options array
     */
    public $toolbar = [];

    /**
     * @var array
     */
    public $options = [];
    /**
     * Editor options.
     *
     * @var array
     */
    protected $editorOptions = [];

    /**
     * Inline widget flag.
     *
     * @var bool
     */
    protected $_inline = false;

    /**
     * Инициализация виджета.
     */
    public function init()
    {
        parent::init();

        $this->editorOptions['language'] = Yii::$app->language;
        if (array_key_exists('preset', $this->editorOptions)) {
            if ('basic' == $this->editorOptions['preset']) {
                $this->presetBasic();
            } elseif ('medium' == $this->editorOptions['preset']) {
                $this->presetMedium();
            } elseif ('full' == $this->editorOptions['preset']) {
                $this->presetFull();
            }
            unset($this->editorOptions['preset']);
        } else {
            $this->presetFull();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->registerAssets($this->getView());
        $this->registerEditorJS();
        $this->printEditorTag();
    }

    /**
     * Registration JS.
     */
    protected function registerEditorJS()
    {
        if (!empty($this->toolbar)) {
            $this->clientOptions['toolbar'] = $this->toolbar;
        }
        $this->clientOptions['language'] = 'ru';
        $clientOptions = Json::encode($this->clientOptions);

        $js = new JsExpression(
            "$('#{$this->options['id']}').ckeditor({$clientOptions});"
        );
        $this->view->registerJs($js);
    }

    /**
     * @param \yii\web\View $view
     */
    protected function registerAssets($view)
    {
    }

    /**
     * View tag for editor.
     */
    protected function printEditorTag()
    {
        echo Html::beginTag('div', $this->containerOptions);
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }

        echo Html::endTag('div');
        $js = [
            'ckeditorWidgets.ckEditor.registerOnChange(' . Json::encode($this->options['id']) . ');',
        ];

        if (isset($this->editorOptions['filebrowserUploadUrl'])) {
            $js[] = 'ckeditorWidgets.ckEditor.registerCsrf();';
        }

        if (!isset($this->editorOptions['on']['instanceReady'])) {
            $this->editorOptions['on']['instanceReady'] = new JsExpression('function( ev ){' . implode(' ', $js) . '}');
        }

        if ($this->_inline) {
            $js = 'CKEDITOR.inline(';
            $js .= Json::encode($this->options['id']);
            $js .= empty($this->editorOptions) ? '' : ', ' . Json::encode($this->editorOptions);
            $js .= ');';

            $this->getView()->registerJs($js, View::POS_END);
            $this->getView()->registerCss('#' . $this->containerOptions['id'] . ', #' . $this->containerOptions['id'] . ' .cke_textarea_inline{height: ' . $this->editorOptions['height'] . 'px;}');
        } else {
            $js = 'CKEDITOR.replace(';
            $js .= Json::encode($this->options['id']);
            $js .= empty($this->editorOptions) ? '' : ', ' . Json::encode($this->editorOptions);
            $js .= ');';

            $this->getView()->registerJs($js, View::POS_END);
        }
    }

    /**
     * Basic preset.
     */
    private function presetBasic()
    {
        $options = Yii::$app->params['ckeditor']['schemes']['basic'];
        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }

    /**
     * Standard preset.
     */
    private function presetMedium()
    {
        $options = Yii::$app->params['ckeditor']['schemes']['medium'];
        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }

    /**
     * Full preset.
     */
    private function presetFull()
    {
        $options = Yii::$app->params['ckeditor']['schemes']['full'];
        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }
}
