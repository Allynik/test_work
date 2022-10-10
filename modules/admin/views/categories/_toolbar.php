<?php




use yii\helpers\Url;

$action = $this->context->action->id;
?>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link<?= ('index' == $action) ? ' active' : ''; ?>" href="<?= Url::to(['index']); ?>">
            <i class="fa fa-list"></i> Список категорий
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?= ('create' == $action) ? ' active' : ''; ?>" href="<?= Url::to(['create']); ?>">
            <i class="fa fa-plus"></i> Добавить категорию
        </a>
    </li>
</ul>
<br>
