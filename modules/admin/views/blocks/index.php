<?php

/**
 * Text blocks list.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 */

use yii\grid\GridView;
use yii\helpers\{Html, Url};

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Текстовые блоки';
$this->params['breadcrumbs'][] = $this->title;

$widgets = Yii::$app->getModule('admin')->params['blocks']['widgets'];
?>
<?= $this->render('_toolbar'); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['attribute' => 'id', 'contentOptions' => ['class' => 'text-center', 'width' => '1%']],

        'name',
        [
            'attribute' => 'widget',
            'value' => function ($model) use ($widgets) {
                return array_key_exists($model->widget, $widgets) ? $widgets[$model->widget] : $model->widget;
            },
        ],
        ['attribute' => 'created', 'format' => ['datetime', 'short'], 'headerOptions' => ['width' => '10%'], 'contentOptions' => ['class' => 'text-center text-nowrap']],
        ['attribute' => 'updated', 'format' => ['datetime', 'short'], 'headerOptions' => ['width' => '10%'], 'contentOptions' => ['class' => 'text-center text-nowrap']],

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

            return Html::tag('div', implode(' ', $buttons), ['class' => 'btn-group btn-group-sm']); // '{create} {view} {update} {delete}';
        }],
    ],
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
    ],
]); ?>
