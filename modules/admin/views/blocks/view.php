<?php

/**
 * View text block.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\TextBlock */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Текстовые блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$widgets = Yii::$app->getModule('admin')->params['blocks']['widgets'];
?>
<?= $this->render('_toolbar'); ?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Удалить текстовый блок?',
            'method' => 'post',
        ],
    ]); ?>
</p>

<?php
$widgetConfig = [
    ['attribute' => 'id', 'captionOptions' => ['width' => '33%']],
    'name',
    [
        'attribute' => 'widget',
        'value' => function ($model) use ($widgets) {
            return array_key_exists($model->widget, $widgets) ? $widgets[$model->widget] : $model->widget;
        },
    ],
    'config:ntext',
];
switch ($model->widget) {
    case 'file':
        $widgetConfig[] = [
            'attribute' => 'content',
            'label' => 'Файл',
            'value' => function ($model) {
                return $model->content ? Html::a($model->content, $model->content) : null;
            },
            'format' => 'raw',
        ];

        break;

    case 'image':
        $widgetConfig[] = [
            'attribute' => 'content',
            'label' => 'Изображение',
            'value' => function ($model) {
                $thumb = $model->getThumbUploadUrl('content', 'thumb-admin-view');

                return Html::a(Html::img($thumb, ['class' => 'img-thumbnail']), $model->content);
            },
            'format' => 'raw',
        ];

        break;

    case 'checkbox':
        $widgetConfig[] = 'content:boolean';

        break;

    case 'url':
        $widgetConfig[] = 'content:url';

        break;

    case 'email':
        $widgetConfig[] = 'content:email';

        break;

    case 'editor':
        $widgetConfig[] = 'content:html';

        break;

    case 'input':
    case 'textarea':
    default:
        $widgetConfig[] = 'content:ntext';

        break;
}

$widgetConfig[] = 'created';
$widgetConfig[] = 'updated';
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>