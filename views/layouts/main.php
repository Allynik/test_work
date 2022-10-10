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
<html class="no-js is-scroll-unknown" lang="<?= Yii::$app->language; ?>" data-public-path="assets/front/"
      data-node-env="production">
<!-- set webpack public path on the fly https://webpack.js.org/guides/public-path/#set-value-on-the-fly -->

<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $this->registerCsrfMetaTags(); ?>

    <title><?= Html::encode($metaTitle); ?></title>
    <meta name="description" content="<?= Html::encode($metaDescription); ?>">
    <script>
        (document.documentElement && document.documentElement.className && (function($html) {
            // js test
            $html.className = $html.className.replace('no-js', 'js');
            // webp support test
            var webp = new Image();
            webp.onload = webp.onerror = function() {
                $html.className += (webp.width == 1 && webp.height == 1 ? ' webp' : ' no-webp');
            };
            webp.src = 'data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=';
            // avif support test
            var avif = new Image();
            avif.onload = avif.onerror = function() {
                $html.className += (avif.width == 1 && avif.height == 1 ? ' avif' : ' no-avif');
            };
            avif.src = [
                'data:image/avif;base64,AAAAIGZ0eXBhdmlmAAAAAGF2aWZtaWYxbWlhZk1BMUIAAAEcbWV0YQAAAAAAAABIaGRscgAAAAAAAAAAcGljdAAAAAAAAAAA',
                'AAAAAGNhdmlmIC0gaHR0cHM6Ly9naXRodWIuY29tL2xpbmstdS9jYXZpZgAAAAAeaWxvYwAAAAAEQAABAAEAAAAAAUQAAQAAABcAAAAqaWluZgEAAAAAAAA',
                'BAAAAGmluZmUCAAAAAAEAAGF2MDFJbWFnZQAAAAAOcGl0bQAAAAAAAQAAAHJpcHJwAAAAUmlwY28AAAAQcGFzcAAAAAEAAAABAAAAFGlzcGUAAAAAAAAAAQ',
                'AAAAEAAAAQcGl4aQAAAAADCAgIAAAAFmF2MUOBAAwACggYAAYICGgIIAAAABhpcG1hAAAAAAAAAAEAAQUBAoMDhAAAAB9tZGF0CggYAAYICGgIIBoFHiAAA',
                'EQiBACwDoA='
            ].join('');
            // viewport sizes
            var viewportHeight = window.visualViewport ? window.visualViewport.height : window.innerHeight;
            $html.style.setProperty('--vh', (viewportHeight * 0.01) + 'px');
            // mobile detect
            var mobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
            $html.className += (mobile ? ' mobile' : ' no-mobile');
        })(document.documentElement));
    </script>
    <?= $this->render('@partials/open-graph'); ?>
    <?= $this->render('@partials/favicons'); ?>

    <?= $this->render('@partials/counters-head'); ?>
    <?php $styleApp = CommonHelper::urlmtime('assets/front/css/app.min.css?27497a4050920177228b'); ?>
    <link href="<?= Html::encode($styleApp); ?>" rel="stylesheet">
    <?php if (!$isBarbaRequest) {
        Yii::$app->response->headers->add('Link', "<$styleApp>; rel=preload; as=style");
    } ?>

    <?php $this->head(); ?>
</head>

<body>
    <?php $this->beginBody(); ?>

    <?= $this->render('@partials/counters-body-open'); ?>

            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]); ?>
            <?= Alert::widget(); ?>
            <?= $content; ?>
    <?= $this->render('@partials/counters-body-close'); ?>

    <?php $scriptVendor = CommonHelper::urlmtime('assets/front/js/vendor.min.js?27497a4050920177228b'); ?>
    <script src="<?= Html::encode($scriptVendor); ?>"></script>
    <?php if (!$isBarbaRequest) {
        Yii::$app->response->headers->add('Link', "<$scriptVendor>; rel=preload; as=script");
    } ?>

    <?php $scriptApp = CommonHelper::urlmtime('assets/front/js/app.min.js?27497a4050920177228b'); ?>
    <script src="<?= Html::encode($scriptApp); ?>"></script>
    <?php if (!$isBarbaRequest) {
        Yii::$app->response->headers->add('Link', "<$scriptApp>; rel=preload; as=script");
    } ?>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
