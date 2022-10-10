<?php

/**
 * Admin main layout.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @var \yii\web\View $this
 */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\{Html, Json, StringHelper};

app\assets\AdminAsset::register($this);

$user = Yii::$app->user;
$userProfile = $user->identity;

$modulesMenu = Yii::$app->getModule('admin')->params['admin']['menu'];

$menuCurrent = null;
$moduleCurrent = null;
$requestUrl = rtrim(Yii::$app->request->url, '/') . '/';

if ('/admin/' !== $requestUrl) {
    foreach ($modulesMenu as $menuId => $moduleGroup) {
        foreach ($moduleGroup['links'] as $moduleUrl => $moduleTitle) {
            $moduleUrl = rtrim($moduleUrl, '/') . '/';
            if (false !== StringHelper::startsWith($requestUrl, $moduleUrl)) {
                $menuCurrent = $menuId;
                $moduleCurrent = rtrim($moduleUrl, '/');

                break;
            }
        }
        if ($moduleCurrent) {
            break;
        }
    }
}

?><?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">

<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?> | <?= Html::encode(Yii::$app->name); ?></title>
    <?php $this->head(); ?>
</head>

<body class="sidebar-mini layout-fixed">
    <?php $this->beginBody(); ?>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" data-enable-remember="true">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Главная сайта</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="/admin/profile" class="dropdown-item">
                        <i class="fa fa-fw fa-user"></i> Редактирование профиля
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/admin/auth/logout" class="dropdown-item">
                        <i class="fa fa-fw fa-power-off"></i> Закончить сеанс
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>

        <div class="dropdown-menu" aria-labelledby="user-dropdown-trigger" id="user-dropdown-menu">
            <a class="dropdown-item" href="/admin/profile">
                <i class="fa fa-fw fa-user"></i> Редактирование профиля
            </a>
            <a class="dropdown-item" href="/admin/auth/logout">
                <i class="fa fa-fw fa-power-off"></i> Закончить сеанс
            </a>
        </div>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/admin" class="brand-link">
            <span class="brand-text font-weight-light"><span
                      class="text-truncate d-block"><?= Html::encode(Yii::$app->name); ?></span></span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img class="img-circle elevation-2"
                         src="<?= $userProfile->photo ?: '/assets/admin/avatar-160x160.png'; ?>">
                </div>
                <div class="info">
                    <a href="/admin/profile" class="text-truncate d-block">
                        <?= Html::encode($userProfile->getDisplayName()); ?>
                    </a>
                </div>
            </div>

            <?php if ($modulesMenu): ?>
            <div class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <?php foreach ($modulesMenu as $menuId => $menuGroup): ?>
                    <?php if ($userProfile->getIsAdmin() || !$menuGroup['accessAdmin']): ?>
                    <li class="nav-item<?= ($menuCurrent === $menuId) ? ' menu-is-opening menu-open' : ''; ?>">
                        <?php if (1 === count($menuGroup['links'])): ?>
                        <a class="nav-link" href="<?= Html::encode($menuGroup['url']); ?>">
                            <?php if (isset($menuGroup['icon'])): ?>
                            <i class="<?= Html::encode($menuGroup['icon']); ?>"></i>
                            <?php endif; ?>
                            <p>
                                <?= Html::encode($menuGroup['group'] ?? ''); ?>
                                <?php if (count($menuGroup['links']) > 1): ?>
                                <i class="right fas fa-angle-left"></i>
                                <?php endif; ?>
                            </p>
                        </a>
                        <?php else: ?>
                        <a class="nav-link" href="<?= Html::encode($menuGroup['url']); ?>">
                            <?php if (isset($menuGroup['icon'])): ?>
                            <i class="<?= Html::encode($menuGroup['icon']); ?>"></i>
                            <?php endif; ?>
                            <p>
                                <?= Html::encode($menuGroup['group'] ?? ''); ?>
                                <?php if (count($menuGroup['links']) > 1): ?>
                                <i class="right fas fa-angle-left"></i>
                                <?php endif; ?>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($menuGroup['links'] as $menuLinkUrl => $menuLinkTitle): ?>
                            <li class="nav-item">
                                <a href="<?= Html::encode($menuLinkUrl); ?>"
                                   class="nav-link<?= $menuLinkUrl === $moduleCurrent ? ' active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        <?= Html::encode($menuLinkTitle); ?>
                                    </p>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1 class="m-0"><?= Html::encode($this->title); ?></h1>
                    </div>
                    <div class="col-md-6">
                        <?= Breadcrumbs::widget([
                            'homeLink' => ['label' => 'Главная', 'url' => '/admin'],
                            'links' => isset($this->params['breadcrumbs']) && $this->params['breadcrumbs'] ? $this->params['breadcrumbs'] : [],
                            'options' => [
                                'class' => 'breadcrumb float-md-right',
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <?= $content; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->endBody(); ?>
    <?php if ($this->context->messages): ?>
    <script defer>
        <?php foreach ($this->context->messages as $typeMessage => $listMessages): ?>
        <?php foreach ($listMessages as $message): ?>
        <?php $attributeMessage = [
            'closeButton' => true,
            'timeOut' => 'error' == $typeMessage ? 0 : 5000,
        ]; ?>
        toastr.<?= Html::encode($typeMessage); ?>(<?= Json::encode($message); ?>, <?= Json::encode($this->title); ?>,
            <?= Json::encode($attributeMessage); ?>);
        <?php endforeach; ?>
        <?php endforeach; ?>
    </script>
    <?php endif; ?>
</body>

</html>
<?php $this->endPage(); ?>
