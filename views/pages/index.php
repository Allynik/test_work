<?php

/**
 * Page template.
 *
 * @var $staticPage \app\modules\pages\models\Page
 */
$this->title = $staticPage->name;

$this->params['meta_title'] = $staticPage->meta_title;
$this->params['meta_description'] = $staticPage->meta_description;
?>
<?= $staticPage->content; ?>