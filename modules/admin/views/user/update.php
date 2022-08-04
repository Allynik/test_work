<?php

/**
 * Update user.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */

/* @var $this yii\web\View */
/* @var $model \app\models\User */

$this->title = 'Редактирование пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?= $this->render('_form', [
    'model' => $model,
]); ?>