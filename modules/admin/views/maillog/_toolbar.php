<?php

/**
 * Userlogs toolbar.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 */

use yii\helpers\Url;

$action = $this->context->action->id;
?>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link<?= ('index' == $action) ? ' active' : ''; ?>" href="<?= Url::to(['index']); ?>">
            <i class="fa fa-list"></i> Список логов
        </a>
    </li>
</ul>
<br>