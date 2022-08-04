<?php

/**
 * Pages list.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \app\modules\pages\models\PageSearch
 * @var $model \app\modules\pages\models\Page
 */

use yii\grid\GridView;
use yii\helpers\{Html, Url};

$this->title = 'Статические страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => ($model->nestedName ? ('row-level-' . $model->levelNumber) : '')];
        },
        'columns' => [
            ['attribute' => 'id', 'contentOptions' => ['class' => 'text-center'], 'headerOptions' => ['width' => '1%']],
            ['attribute' => 'name', 'format' => 'raw', 'value' => function ($model) {
                return Html::a(Html::encode($model->nestedName ?: $model->name), Url::to(['view', 'id' => $model->id]));
            }, 'contentOptions' => ['class' => 'cell-name']],
            ['attribute' => 'path', 'format' => 'raw', 'value' => function ($model) {
                return Html::a(Html::tag('tt', Html::encode($model->getFullPath())), Html::encode($model->getFullPath()));
            }, 'headerOptions' => ['width' => '30%']],
            ['attribute' => 'priority', 'contentOptions' => ['class' => 'text-center'], 'headerOptions' => ['width' => '1%']],
            ['attribute' => 'hidden', 'format' => 'boolean',
                'filter' => [1 => 'Да', 0 => 'Нет'],
                'contentOptions' => ['class' => 'text-center'], 'headerOptions' => ['width' => '5%'],
            ],
            ['attribute' => 'disabled', 'format' => 'boolean',
                'filter' => [1 => 'Да', 0 => 'Нет'],
                'contentOptions' => ['class' => 'text-center'], 'headerOptions' => ['width' => '5%'],
            ],
            ['class' => 'yii\grid\Column', 'header' => 'Действия', 'headerOptions' => ['width' => '5%'], 'content' => function ($model) {
                $buttons = [
                    Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), Url::to(['create', 'parent_id' => $model->id]), ['class' => 'btn btn-default']),
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
    ]); ?>
</div>