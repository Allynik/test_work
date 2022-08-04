<?php

use yii\helpers\Html;

/** @var $this \yii\web\View view component instance */
/** @var $message \yii\mail\MessageInterface the message being composed */
/** @var $content string main view render result */
$request = Yii::$app->request;
$url = Yii::$app->urlManager->createAbsoluteUrl('/');
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset; ?>" />
    <title><?= Html::encode($this->title); ?></title>

    <?= Html::tag('style', $this->render('./html.css'), ['type' => 'text/css']); ?>

    <?php $this->head(); ?>
</head>

<body>
    <?php $this->beginBody(); ?>
    <?= $content; ?>
    <br />
    <hr />
    <p>
        <small>
            Сообщение сгенерировано автоматически и рассылается почтовым роботом сайта:
            <a href="<?= Html::encode($url); ?>"><?= Html::encode($url); ?></a>,
            пожалуйста не отвечайте на него.
        </small>
    </p>
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>