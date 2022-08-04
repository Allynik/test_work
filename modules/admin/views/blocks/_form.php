<?php

/**
 * Form text block.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */

use app\widgets\CKEditor\ClassicEditor;
use app\widgets\upload\{ImageWidget, UploadWidget};
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $model \app\modules\admin\models\TextBlock */
$widgets = Yii::$app->getModule('admin')->params['blocks']['widgets'];
?>

<div class="card card-primary card-outline card-outline-tabs">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6">

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

                <?php if ($model->isNewRecord): ?>
                <?= $form->field($model, 'widget')->dropDownList($widgets); ?>
                <?php endif; ?>

                <?php if (!$model->isNewRecord): ?>
                <?php if ('input' == $model->widget || 'url' == $model->widget): ?>
                <?= $form->field($model, 'content')->textInput(); ?>
                <?php endif; ?>
                <?php if ('textarea' == $model->widget): ?>
                <?= $form->field($model, 'content')->textarea(['rows' => 6]); ?>
                <?php endif; ?>
                <?php if ('email' == $model->widget): ?>
                <?= $form->field($model, 'content')->textInput(['type' => 'email']); ?>
                <?php endif; ?>
                <?php if ('editor' == $model->widget): ?>
                <?= $form->field($model, 'content')->widget(ClassicEditor::class); ?>
                <?php endif; ?>
                <?php if ('file' == $model->widget): ?>
                <?= $form->field($model, 'content')->widget(UploadWidget::class); ?>
                <?php endif; ?>
                <?php if ('image' == $model->widget): ?>
                <?= $form->field($model, 'content')->widget(ImageWidget::class); ?>
                <?php endif; ?>
                <?php if ('checkbox' == $model->widget): ?>
                <?= $form->field($model, 'content')->checkbox(); ?>
                <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']); ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>