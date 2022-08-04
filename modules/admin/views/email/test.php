<?php

/**
 * Email test send.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 * @var $model \app\modules\admin\models\EmailTest
 * @var $message string
 */

use kartik\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Проверка отправки почты';
$this->params['breadcrumbs'][] = [
    'url' => '/admin/email/test',
    'label' => $this->title,
];
?>
<?= $this->render('_toolbar'); ?>
<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'email')->textInput(['type' => 'email']); ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
                </div>
                <?php ActiveForm::end(); ?>

                <?php if ($message): ?>
                <?= Alert::widget([
                    'type' => Alert::TYPE_DANGER,
                    'body' => $message,
                ]); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>