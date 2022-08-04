<?php
use yii\helpers\Html;

// $this->context->layout = '@views/layouts/error';

$this->title = '403: Доступ запрещен';
?>
<div class="card-body">
    <p class="lead text-center"><strong><?= Html::encode($this->title); ?></strong></p>
    <p class="text-center">У Вас нет прав доступа на эту страницу.</p>
</div>
<div class="text-center">
    <a href="/admin/auth"><small>Авторизация</small></a>
    &bull;
    <a href="/admin/"><small>Стартовая</small></a>
</div>