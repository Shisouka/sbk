<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/ui.css',
        'css/style.css',
        'js/lib/plugins/mcustom_scrollbar.min.css',
        'less/style.css',
//        'less/style.css',
        'less/style.less', // TODO
    ];
    public $js = [
        'js/app.js',
        'js/lib/plugins/jquery-ui-1.11.2.min.js',
        'js/lib/plugins/jquery.cookies.min.js',
        'js/lib/plugins/jquery.mCustomScrollbar.concat.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
