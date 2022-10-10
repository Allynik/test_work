<?php

$this->title = 'Редактирование категории: ' . $model->title;
?>
<?= $this->render('_toolbar'); ?>

<?= $this->render('_form', [
    'model' => $model,
]); ?>
