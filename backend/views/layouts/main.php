<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

//$this->registerLinkTag(['rel'=>'icon', 'href' => '/favicon.png', 'type'=>'image/x-icon']);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>

    </style>
</head>
<body class="fixed-sidebar fixed-topbar fixed-topbar theme-sdtl color-default">
<?php $this->beginBody() ?>
<div id="loader-wrapper" class="account">
    <div class="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<div class="wrap">
    <div class="sidebar">
        <div class="logopanel">
            <h1>
                <a href="http://sbk.spb.ru">sbk.spb.ru</a>
            </h1>
        </div>
        <?= $this->render('@app/views/sidebar/sidebar'); ?>
    </div>
    <div class="main-content">
        <div class="topbar">
            <div class="header-left">
                <div class="topnav">
                    <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
                    <ul class="nav nav-icons">
                        <!--li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                        <li><a href="#"><span class="octicon octicon-mail-read"></span></a></li>
                        <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
                        <li><a href="#"><span class="octicon octicon-rocket"></span></a></li-->
                    </ul>
                    <?=!Yii::$app->user->isGuest
                        ? Breadcrumbs::widget([
                            'activeItemTemplate' => "<li><span>{link}</span></li>\n",
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                        : '';
                    ?>
                </div>

            </div>

            <div class="header-right">
                <ul class="header-menu nav navbar-nav">
                    <li class="dropdown" id="user-header">
                        <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username"><?=!Yii::$app->user->isGuest ? \Yii::$app->user->identity->username : ''?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!--li>
                                <a href="#"><i class="icon-user"></i><span>My Profile</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-calendar"></i><span>My Calendar</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-settings"></i><span>Account Settings</span></a>
                            </li-->
                            <li>
                                <a href="/site/logout" data-method="post"><i class="icon-logout"></i><span>Выйти</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-content page-thin" style="padding-top: 20px">
            <?= $content ?>
        </div>
    </div>





    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
