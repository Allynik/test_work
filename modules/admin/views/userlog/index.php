<?php

/**
 * Logs list.
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

$this->title = 'Лог изменений';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['attribute' => 'id', 'contentOptions' => ['class' => 'text-center', 'width' => '1%']],

        'username',
        'action',
        'model',
        'entity_id',
        ['attribute' => 'updated', 'format' => ['datetime', 'short'], 'headerOptions' => ['width' => '10%'], 'contentOptions' => ['class' => 'text-center text-nowrap']],

        ['class' => 'yii\grid\Column', 'header' => 'Действия', 'headerOptions' => ['width' => '5%'], 'content' => function ($model) {
            $buttons = [
                Html::a(Html::tag('span', '', ['class' => 'fa fa-eye']), Url::to(['view', 'id' => $model->id]), ['class' => 'btn btn-default btn-sm']),
            ];

            return Html::tag('div', implode(' ', $buttons), ['class' => 'btn-group btn-group-sm']);
        }],
    ],
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
    ],
]); ?>