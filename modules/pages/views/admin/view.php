<?php

/**
 * View page.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var $model \app\modules\pages\models\Page
 */

use app\widgets\HtmlCollapse;
use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

$this->title = 'Просмотр страницы';
$this->params['breadcrumbs'][] = $this->title;
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

<?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => 'table table-striped table-bordered detail-view table-hover table-sm'],
    'attributes' => [
        ['attribute' => 'id', 'captionOptions' => ['width' => '33%']],
        [
            'attribute' => 'parent_id',
            'format' => 'raw',
            'value' => fn ($model) => $model->parent_id ? Html::a(Html::encode($model->parent->name), Url::to(['view', 'id' => $model->parent_id])) : null,
        ],
        'name',
        [
            'attribute' => 'path',
            'format' => 'raw',
            'value' => fn ($model) => $model->path ? Html::a(Html::encode($model->getFullPath()), Html::encode($model->getFullPath())) : null,
        ],
        [
            'attribute' => 'redirect',
            'format' => 'raw',
            'value' => fn ($model) => $model->redirect ? Html::a(Html::encode($model->redirect), Html::encode($model->redirect)) : null,
        ],
        [
            'attribute' => 'content',
            'value' => fn ($model) => HtmlCollapse::widget(['model' => $model, 'name' => 'content']),
            'format' => 'raw',
        ],
        'priority',
        'hidden:boolean',
        'disabled:boolean',
        'meta_title',
        'meta_description',
        'created:datetime',
        'updated:datetime',
    ],
]); ?>