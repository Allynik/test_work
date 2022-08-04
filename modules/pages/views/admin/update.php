<?php

/**
 * Update page.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var $model \app\modules\pages\models\Page
 */
$this->title = 'Редактирование страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_toolbar'); ?>

<?= $this->render('_form', [
    'model' => $model,
]); ?>