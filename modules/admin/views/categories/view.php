<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\TextBlock */
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Категория ' . $model->title;
?>
<?= $this->render('_toolbar'); ?>
<p>
    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Удалить пользователя?',
            'method' => 'post',
        ],
    ]); ?>
</p>
<?php

$widgetConfig = [
    ['attribute' => 'id', 'captionOptions' => ['width' => '33%']],
    'title',
];
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>
