<?php

/**
 *
 * @var \yii\web\View $this
 */
use yii\grid\GridView;
use yii\helpers\{Html, Url};
use yii\bootstrap4\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['attribute' => 'id', 'contentOptions' => ['class' => 'text-center', 'width' => '1%']],

        'title',
        ['class' => 'yii\grid\Column', 'header' => 'Действия', 'headerOptions' => ['width' => '5%'], 'content' => function ($model) {
            $buttons = [
                Html::a(Html::tag('span', '', ['class' => 'fa fa-eye']), Url::to(['view', 'id' => $model->id]), ['class' => 'btn btn-default']),
                Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), Url::to(['update', 'id' => $model->id]), ['class' => 'btn btn-default']),
                Html::a(Html::tag('span', '', ['class' => 'fa fa-trash']), Url::to(['delete', 'id' => $model->id]), [
                    'class' => 'btn btn-default',
                    'data-confirm' => Yii::t('yii', 'Удалить?'),
                    'data-method' => 'post',
                ]),
            ];

            return Html::tag('div', implode(' ', $buttons), ['class' => 'btn-group btn-group-sm']);
        }],
    ],
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
    ],
]); ?>
