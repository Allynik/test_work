<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\helpers\CommonHelper;
use app\modules\admin\models\Setting;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$commonTitle = Setting::getCommonSetting('title');
$commonDescription = Setting::getCommonSetting('meta_description');

$homePage = ($this->context->id . '/' . $this->context->action->id) == 'site/index';

if (isset($this->params['meta_title']) && $this->params['meta_title']) {
    $metaTitle = $this->params['meta_title'];
} elseif ($homePage) {
    $metaTitle = $commonTitle;
} else {
    $metaTitle = $this->title . ' | ' . $commonTitle;
}

if (isset($this->params['meta_description']) && $this->params['meta_description']) {
    $metaDescription = $this->params['meta_description'];
} else {
    $metaDescription = $commonDescription;
}

$isBarbaRequest = 'yes' == Yii::$app->request->headers->get('X-Barba');

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html class="no-js is-scroll-unknown" lang="<?= Yii::$app->language; ?>" data-public-path="/assets/front/build/"
      data-node-env="production">
<!-- set webpack public path on the fly https://webpack.js.org/guides/public-path/#set-value-on-the-fly -->

<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $this->registerCsrfMetaTags(); ?>

    <title><?= Html::encode($metaTitle); ?></title>
    <meta name="description" content="<?= Html::encode($metaDescription); ?>">

    <?= $this->render('@partials/open-graph'); ?>
    <?= $this->render('@partials/favicons'); ?>

    <?= $this->render('@partials/counters-head'); ?>

    <?php $styleApp = CommonHelper::urlmtime('/assets/front/build/css/app.min.css'); ?>
    <link href="<?= Html::encode($styleApp); ?>" rel="stylesheet">
    <?php if (!$isBarbaRequest) {
        Yii::$app->response->headers->add('Link', "<$styleApp>; rel=preload; as=style");
    } ?>

    <?php $this->head(); ?>
</head>

<body>
    <?php $this->beginBody(); ?>

    <?= $this->render('@partials/counters-body-open'); ?>

    <div class="wrap">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]); ?>
            <?= Alert::widget(); ?>
            <?= $content; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name); ?> <?= date('Y'); ?></p>
        </div>
    </footer>

    <?= $this->render('@partials/counters-body-close'); ?>

    <?php $scriptVendor = CommonHelper::urlmtime('/assets/front/build/js/vendor.min.js'); ?>
    <script src="<?= Html::encode($scriptVendor); ?>"></script>
    <?php if (!$isBarbaRequest) {
        Yii::$app->response->headers->add('Link', "<$scriptVendor>; rel=preload; as=script");
    } ?>

    <?php $scriptApp = CommonHelper::urlmtime('/assets/front/build/js/app.min.js'); ?>
    <script src="<?= Html::encode($scriptApp); ?>"></script>
    <?php if (!$isBarbaRequest) {
        Yii::$app->response->headers->add('Link', "<$scriptApp>; rel=preload; as=script");
    } ?>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>