<?php

/**
 * View log item.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 */

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;
use app\widgets\HtmlCollapse;

/*
 * @var $model \app\modules\admin\models\Userlog
 */

$this->title = 'Запись лога: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Лог почты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?php
$widgetConfig = [
    ['attribute' => 'id', 'captionOptions' => ['width' => '33%']],
    'mailto',
    'subject',
    'response',
    ['attribute' => 'result', 'format' => 'boolean',
        'filter' => [1 => 'Да', 0 => 'Нет'],
    ],
    ['attribute' => 'message', 'format' => 'raw', 'value' => function ($model) {
        return Html::a(Html::tag('span', '', ['class' => 'fa fa-download']) . ' скачать', Url::to(['download', 'id' => $model->id]), ['class' => 'btn btn-default']);
    }],
    'created:datetime',
    'updated:datetime',
    [
        'attribute' => 'htmlBody',
        'value' => fn ($model) => HtmlCollapse::widget(['model' => $model, 'name' => 'htmlBody']),
        'format' => 'raw',
    ],
];
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>
