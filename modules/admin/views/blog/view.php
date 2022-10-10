<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\TextBlock */
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\behaviors\UploadImageBehavior;
$this->title = 'Блог ' . $model->title .'';
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
    'attribute' => 'category_id',
    'content',
    [
        'attribute' => 'image',
        'label' => 'Фотография',
        'value' => function ($model) {
            if (!$model->image) {
                return '';
            }
//            $thumb = $model->getThumbUploadUrl('image', 'thumb-admin-view');
            $source = '@web/assets/front/image/' . $model->image;
                return Html::img($source,['alt' => $model->image]);
//            return Html::a(Html::img($thumb, ['class' => 'img-thumbnail']), $model->image);
        },
        'format' => 'raw',
    ],
    'created:datetime',
];
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>
