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

use yii\widgets\DetailView;

/*
 * @var $model \app\modules\admin\models\Userlog
 */

$this->title = 'Запись лога: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Лог изменений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?php
$widgetConfig = [
    ['attribute' => 'id', 'captionOptions' => ['width' => '33%']],
    'user_id',
    'username',
    'model',
    'table',
    'entity_id',
    'action',
    'comment',
    'created:datetime',
];
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $widgetConfig,
]); ?>