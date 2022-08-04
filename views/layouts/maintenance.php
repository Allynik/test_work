<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

app\assets\AdminAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html class="no-js h-100" lang="<?= Yii::$app->language; ?>">

<head>

    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags(); ?>

    <title><?= Html::encode($this->title); ?></title>

    <?php $this->head(); ?>
</head>

<body class="d-flex h-100 align-items-center">
    <?php $this->beginBody(); ?>

    <div class="jumbotron mt-auto mr-auto mb-auto ml-auto">
        <?= $content; ?>
    </div>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>