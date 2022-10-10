<?php

/**
 * Profile form.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 * @var $model \app\modules\admin\models\Profile
 */

use app\widgets\inputmask\Phone;
use app\widgets\upload\ImageWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-12 col-md-8 col-xl-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'new-password']); ?>
        <?= $form->field($model, 'passwordConfirm')->passwordInput(['autocomplete' => 'new-password']); ?>
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'phone')->widget(Phone::class); ?>
        <?= $form->field($model, 'photo')->widget(ImageWidget::class); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
