<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                '/' => 'site/index',

                '/catalog/<catalogSlug:[0-9a-zA-Z\-_]+>' => 'catalog/view',
                '/catalog/<catalogSlug:[0-9a-zA-Z\-_]+>/<subcatalogSlug:[0-9a-zA-Z\-_]+>' => 'catalog/view',

                '/price' => 'site/price',

                '/advantages' => 'site/advantages',

                '/about' => 'site/about',

                '/services' => 'site/services',

                '/contacts' => 'site/contacts',

                '/gosts' => 'site/gosts',

            ],
        ],
    ],
    'params' => $params,
];
