<?php

/**
 * Setting edit page.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\{ArrayHelper, Html};

/* @var $config array */
/* @var $models array */

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;

$groups = [];
foreach ($config as $fieldName => $field) {
    $field['group'] ??= '—';
    if (!array_key_exists($field['group'], $groups)) {
        $groups[$field['group']] = [];
    }
    $groups[$field['group']][$fieldName] = $field;
}
?>

<div class="card card-primary card-outline card-outline-tabs">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <?php $i = 0; ?>
            <?php foreach ($groups as $groupName => $groupFields): ?>
            <li class="nav-item">
                <a class="nav-link<?= !$i ? ' active' : ''; ?>"
                   id="tab-<?= $i; ?>"
                   data-toggle="pill" href="#tabs-container-<?= $i; ?>"
                   role="tab" aria-selected="true"><?= Html::encode($groupName); ?></a>
            </li>
            <?php ++$i; ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            <?php $i = 0; ?>
            <?php foreach ($groups as $groupName => $groupFields): ?>
            <div class="tab-pane fade<?= !$i ? ' active show' : ''; ?>" id="tabs-container-<?= $i; ?>">
                <div class="row">
                    <div class="col-12 col-md-8 col-xl-6">
                        <?php foreach ($groupFields as $fieldName => $field): ?>
                        <div>
                            <?php
                            $attribute = ArrayHelper::merge($field['attribute'] ?? [], [
                                'maxlength' => true,
                                'name' => 'setting[' . $fieldName . ']',
                                'id' => 'setting-' . $fieldName,
                            ]);
                            $fieldRender = $form->field($models[$fieldName], 'value');
                            $fieldRender->label($field['label'] ?? $fieldName, [
                                'for' => 'setting-' . $fieldName,
                                'class' => 'checkbox' == $field['widget'] ? 'custom-control-label' : '',
                            ]);
                            $fieldRender->hint($field['hint'] ?? '');

                            if ('checkbox' == $field['widget']) {
                                $attribute['label'] = $field['label'];
                                $fieldRender->checkbox($attribute, false);
                            } elseif ('dropDownList' == $field['widget']) {
                                $fieldRender->dropDownList($field['options'] ?? [], $attribute);
                            } elseif ('textarea' == $field['widget']) {
                                $fieldRender->textarea($attribute);
                            } else {
                                $fieldRender->textInput($attribute);
                            }
                            ?>
                            <?= $fieldRender; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php ++$i; ?>
            <?php endforeach; ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>