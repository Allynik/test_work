<?php

/**
 * View user.
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

$this->title = 'Пользователь: ' . $model->first_name . ' ' . $model->last_name . ' (' . $model->email . ')';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$statuses = Yii::$app->getModule('admin')->params['user']['statuses'];
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
    'username',
    'email',
    'phone',
    'first_name',
    'last_name',
    'middle_name',
    [
        'attribute' => 'status',
        'value' => function ($model) use ($statuses) {
            return array_key_exists($model->status, $statuses) ? $statuses[$model->status] : $model->status;
        },
    ],
    [
        'attribute' => 'photo',
        'label' => 'Фотография',
        'value' => function ($model) {
            if (!$model->photo) {
                return '';
            }
            $thumb = $model->getThumbUploadUrl('photo', 'thumb-admin-view');

            return Html::a(Html::img($thumb, ['class' => 'img-thumbnail']), $model->photo);
        },
        'format' => 'raw',
    ],
    'birth_date:date',
    'created:datetime',
    'updated:datetime',
];
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>