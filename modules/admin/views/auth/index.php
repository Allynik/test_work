<?php

/**
 * Authorization page.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var $model \app\models\LoginForm
 * @var \yii\web\View $this
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Авторизация';
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "\n{input}\n{error}",
        'errorOptions' => [
            'tag' => 'span',
            'class' => 'invalid-feedback',
        ],
    ],
]); ?>
<div class="card-body">
    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'tabindex' => 1, 'class' => 'form-control', 'placeholder' => 'Логин']); ?>
    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'tabindex' => 2, 'class' => 'form-control', 'placeholder' => 'Пароль']); ?>
    <?= $form->field($model, 'rememberMe')->checkbox(); ?>
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
</div>
<div class="text-center">
    <a href="/"><small>Стартовая</small></a>
</div>
<?php ActiveForm::end(); ?>