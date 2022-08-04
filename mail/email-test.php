<?php

use yii\helpers\Html;

$url = Yii::$app->urlManager->createAbsoluteUrl('/');
?>

<p>Проверка отправки email на сайте <a href="<?= Html::encode($url); ?>"><?= Html::encode($url); ?></a>.</p>