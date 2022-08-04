<?php

use app\modules\admin\models\Setting;
use yii\helpers\Html;

$commonTitle = Setting::getCommonSetting('title');
$commonDescription = Setting::getCommonSetting('meta_description');
$homePage = ($this->context->id . '/' . $this->context->action->id) == 'site/index';

if ($homePage) {
    $metaTitle = $commonTitle;
} else {
    $metaTitle = $this->title . ' | ' . $commonTitle;
}

if (isset($this->params['meta_description']) && $this->params['meta_description']) {
    $metaDescription = $this->params['meta_description'];
} else {
    $metaDescription = $commonDescription;
}

if (isset($this->params['og:image']) && $this->params['og:image']) {
    $ogImage = $this->params['og:image'];
} else {
    $ogImage = '/assets/front/build/img/og-image.png';
}

?>
<!-- open-graph -->
<meta property="og:locale" content="<?= Html::encode(Yii::$app->language); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= Html::encode($metaTitle); ?>">
<meta property="og:description" content="<?= Html::encode($metaDescription); ?>">
<meta property="og:image" content="<?= Html::encode($ogImage); ?>">
<meta property="og:site_name" content="<?= Html::encode($commonTitle); ?>">

<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="<?= Html::encode($ogImage); ?>">
<meta name="twitter:title" content="<?= Html::encode($metaTitle); ?>">
<meta name="twitter:description" content="<?= Html::encode($metaDescription); ?>">
<!-- /open-graph -->