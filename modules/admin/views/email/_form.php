<?php

/**
 * Email settings form.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 * @var $model \app\modules\admin\models\EmailSettings
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$transport = Yii::$app->getModule('admin')->params['email']['transport'];
$encryption = Yii::$app->getModule('admin')->params['email']['encryption'];
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-12 col-md-8 col-xl-6">

        <?= $form->field($model, 'transport')->dropdownList($transport); ?>
        <?= $form->field($model, 'fromAddress')->textInput(); ?>
        <?= $form->field($model, 'fromName')->textInput(); ?>
        <?= $form->field($model, 'host')->textInput(); ?>
        <?= $form->field($model, 'port')->textInput(); ?>
        <?= $form->field($model, 'encryption')->radioList($encryption); ?>
        <?= $form->field($model, 'username')->textInput(); ?>
        <?= $form->field($model, 'password')->textInput(['autocomplete' => 'new-password']); ?>

    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>