<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Заявка №' . $model->id .'';
?>
<?= $this->render('_toolbar'); ?>
<p>
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
    'first_name',
    'company',
    'phone',
    'email',
    'created:datetime',
];
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>
