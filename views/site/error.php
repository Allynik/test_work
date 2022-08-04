<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->context->layout = '@views/layouts/error';

$exceptionCode = $exception->statusCode ?? 500;
$exceptionMessage = $exception->getMessage();

if (YII_DEBUG) {
    $this->title = "$exceptionCode: $exceptionMessage";
} elseif (403 === $exceptionCode) {
    $this->title = '403: Доступ запрещен';
} elseif (404 === $exceptionCode) {
    $this->title = '404: Страница не найдена';
} elseif (405 === $exceptionCode) {
    $this->title = '405: метод не разрешен';
} else {
    $this->title = "$exceptionCode: Внутренняя ошибка сервера";
}
?>
<div class="wysiwyg">
    <h1><?= Html::encode($this->title); ?></h1>

    <?php if (403 === $exceptionCode): ?>
    <p>У Вас нет прав доступа на эту страницу.</p>
    <?php elseif (404 === $exceptionCode): ?>
    <p>Эта страница сейчас недоступна. Возможно, указан неверный адрес, либо эта страница больше не находится на
        сервере. </p>
    <p><strong>Но не стоит сдаваться, попробуйте следующее:</strong></p>
    <ul>
        <li>Проверьте правильность адреса страницы в строке адреса; </li>
        <li>Начните поиск со <a href="/">стартовой страницы</a>; </li>
        <li>Нажмите кнопку браузера &laquo;Обновить&raquo; или повторите попытку позднее; </li>
        <li>Нажмите кнопку браузера &laquo;Назад&raquo;, чтобы использовать другую ссылку; </li>
    </ul>
    <?php elseif (405 === $exceptionCode): ?>
    <p>У Вас нет прав доступа на эту страницу.</p>
    <?php else: ?>
    <p>На сервере обнаружена внутренняя ошибка или сервер не смог выполнить ваш запрос.</p>
    <p>Пожалуйста свяжитесь с администратором сайта, сообщите время ошибки, и все ваши действия, возможно повлекшие
        ошибку.</p>
    <p>Более подробная информация об этой ошибке могут быть доступны лог файле ошибок.</p>
    <?php endif; ?>
</div>