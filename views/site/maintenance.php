<?php
use yii\helpers\Html;

$this->context->layout = '@views/layouts/maintenance';

Yii::$app->response->headers->add('Retry-After', 3600);

$this->title = 'Сайт на техобслуживании';
?>
<div class="wysiwyg text-center">
    <h1 class="h1"><?= Html::encode($this->title); ?></h1>
    <p>В настоящее время ведутся работы на сайте.</p>
    <p>Вы можете вернуться через некоторое время.</p>
    <p>Спасибо за Ваше терпение.</p>
    <div class="text-center">
        <button class="btn btn-primary" onclick="document.location.reload()">Обновить</button>
    </div>
</div>