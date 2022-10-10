<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use app\widgets\datetime\Date;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\BlogCategory;

$catList = BlogCategory::find()->all();

?>

<div class="card card-primary card-outline card-outline-tabs">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
