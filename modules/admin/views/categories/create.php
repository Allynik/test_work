<?php


$this->title = 'Добавление категории';
?>
<?= $this->render('_toolbar'); ?>

<?= $this->render('_form', [
    'model' => $model,
]); ?>
