<?php

/**
 * Page form.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var $model \app\modules\pages\models\Page
 */

use app\modules\pages\models\Page;
use app\widgets\CKEditor\ClassicEditor;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

$parentsList = Page::find()->orderBy(['priority' => SORT_DESC, 'id' => SORT_ASC])->all();
$parentsList = Page::sortTreeModels($parentsList, null);

if ($model->isNewRecord) {
    $model->parent_id = (int) Yii::$app->request->get('parent_id');
}
?>

<div class="card card-primary card-outline card-outline-tabs">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="page-tabs" role="tablist">
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link active" href="#main" role="tab" aria-selected="true">Основное</a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link" href="#secondary" role="tab" aria-selected="false">Дополнительно
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link" href="#seo" role="tab" aria-selected="false">SEO оптимизация</a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="main">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 col-md-8 col-xl-6">
                            <?= $form->field($model, 'parent_id')->dropDownList(['' => '...'] + ArrayHelper::map($parentsList, 'id', 'nestedName')); ?>
                            <?= $form->field($model, 'name')->textInput(); ?>
                            <?= $form->field($model, 'path')->textInput(); ?>
                            <?= $form->field($model, 'redirect')->textInput(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 col-xl-12">
                            <?= $form->field($model, 'content')->widget(ClassicEditor::class, [
                                'options' => ['rows' => 10],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="secondary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 col-md-8 col-xl-6">
                            <?= $form->field($model, 'priority')->textInput(['type' => 'number']); ?>
                            <?= $form->field($model, 'disabled')->checkbox(); ?>
                            <?= $form->field($model, 'hidden')->checkbox(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="seo">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 col-md-8 col-xl-6">
                            <?= $form->field($model, 'meta_title')->textInput(); ?>
                            <?= $form->field($model, 'meta_description')->textarea(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 col-xl-12">
                            <?= $form->field($model, 'seo')->widget(ClassicEditor::class, [
                                'options' => ['rows' => 10],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-lg btn-success">
                <i class="fa fa-save"></i> <?= $model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
            </button>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>