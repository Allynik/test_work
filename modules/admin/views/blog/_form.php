<?php
use app\widgets\upload\ImageWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use app\widgets\datetime\Date;
use yii\helpers\ArrayHelper;
use app\widgets\CKEditor\ClassicEditor;
use app\modules\admin\models\BlogCategory;

$catList = BlogCategory::find()->all();

?>

<div class="card card-primary card-outline card-outline-tabs">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($catList, 'id', 'title')); ?>
                <?= $form->field($model, 'image')->fileInput(); ?>
                <?= $form->field($model, 'created')->widget(Date::class); ?>
                <?= $form->field($model, 'flag')->checkbox(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <?= $form->field($model, 'content')->widget(ClassicEditor::class, [
                    'options' => ['rows' => 10],
                ]); ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
