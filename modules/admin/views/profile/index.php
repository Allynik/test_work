<?php

/**
 * Profile page.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 * @var $model \app\modules\admin\models\Profile
 */
$this->title = 'Редактирование профиля';
$this->params['breadcrumbs'][] = [
    'url' => '/admin/profile',
    'label' => $this->title,
];
?>
<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <?= $this->render('_form', [
                    'model' => $model,
                ]); ?>
            </div>
        </div>
    </div>
</div>