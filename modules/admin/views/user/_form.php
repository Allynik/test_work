<?php

/**
 * Form user.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */

use app\widgets\datetime\Date;
use app\widgets\inputmask\Phone;
use app\widgets\upload\ImageWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $model \app\models\User */
$statuses = Yii::$app->getModule('admin')->params['user']['statuses'];
?>

<div class="card card-primary card-outline card-outline-tabs">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]); ?>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]); ?>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]); ?>
                <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]); ?>
                <?= $form->field($model, 'phone')->widget(Phone::class); ?>
                <?= $form->field($model, 'email')->textInput(['type' => 'email', 'maxlength' => true]); ?>
                <?php if (!$model->getIsAdmin()): ?>
                <?= $form->field($model, 'status')->dropDownList($statuses); ?>
                <?php else: ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
                <?php endif; ?>
                <?= $form->field($model, 'passwordNew')->passwordInput(['autocomplete' => 'new-password']); ?>
                <?= $form->field($model, 'passwordNewConfirm')->passwordInput(['autocomplete' => 'new-password']); ?>
                <?= $form->field($model, 'photo')->widget(ImageWidget::class); ?>
                <?= $form->field($model, 'birth_date')->widget(Date::class); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>