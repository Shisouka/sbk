<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

$this->registerLinkTag(['rel'=>'icon', 'href' => '/favicon.ico', 'type'=>'image/x-icon']);

$bg = "background-image: url('/images/sneg".mt_rand(1,3).".jpg');"
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
<div class="wrap">
    <div class="sidebar">
        <div class="logopanel">
            <a href="/"><img src="/images/logo.png"></a>
        </div>
		<?= $this->render('@app/views/sidebar/sidebar'); ?>
	</div>
    <div class="main-content">
        <div class="topbar">
            <div class="header-left">
                <div class="topnav">
                    <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
                </div>

            </div>
            <div class="header-center">
                <div class="company">
                   Наша компания является авторизованным сервисным центром компании <b>BORGE</b>.
                </div>
                <div class="email">
                    <a href="mailto:balttim@bk.ru">balttim@bk.ru</a>
                </div>
                <div class="phone">
                    <a href="tel:+7(812)9292725">(812) 929-27-25</a>
                </div>
            </div>
            <div class="header-right">
                <ul class="header-menu nav navbar-nav">
                </ul>
            </div>
        </div>
        <div class="page-content page-thin" style="<?= $bg; ?>">
            <div class="content">
                <div class="padding">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
