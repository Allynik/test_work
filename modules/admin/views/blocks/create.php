<?php

/**
 * Create text block.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\TextBlock */

$this->title = 'Добавление блока';
$this->params['breadcrumbs'][] = ['label' => 'Текстовые блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?= $this->render('_form', [
    'model' => $model,
]); ?>