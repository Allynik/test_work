<?php
$this->title = 'Редактирование блога';
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('_form', ['model' => $model,]); ?>
