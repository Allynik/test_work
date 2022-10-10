<?php
$this->title = 'Создание блога';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', ['model' => $model,]); ?>
