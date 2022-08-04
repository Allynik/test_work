<?php

/**
 * Pages toolbar.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \app\modules\pages\models\PageSearch
 * @var $model \app\modules\pages\models\Page
 */

use yii\helpers\Url;

$action = $this->context->action->id;
?>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link<?php if ('index' == $action): ?> active<?php endif; ?>" href="<?= Url::to(['index']); ?>">
            <i class="fa fa-list"></i> Список
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if ('create' == $action): ?> active<?php endif; ?>" href="<?= Url::to(['create']); ?>">
            <i class="fa fa-plus"></i> Добавить
        </a>
    </li>
</ul>
<br>