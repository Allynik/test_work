<?php

/**
 * Authorization layout.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var string        $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

app\assets\AdminAsset::register($this);
$this->registerMetaTag(['name' => 'noindex', 'content' => 'robots']);
?><?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">

<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>

<body class="login-page">
    <?php $this->beginBody(); ?>

    <div class="login-box">
        <div class="login-logo">
            <?= Html::encode(Yii::$app->name); ?>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Авторизация</p>
                <?= $content; ?>
            </div>
        </div>
    </div>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>