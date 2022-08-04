<?php

/**
 * Dashboard page.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 */
$this->title = 'Панель управления';
$this->params['breadcrumbs'][] = [
    'url' => '/admin',
    'label' => $this->title,
];
?>
<div class="jumbotron">
    <p class="lead text-center">
        <i class="fa fa-fw fa-arrow-left"></i> Привет! Воспользуйтесь панелью инструментов.
    </p>
</div>