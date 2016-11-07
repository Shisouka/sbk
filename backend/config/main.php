<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'users-permissions' => [
            'class' => 'mdm\admin\Module',
            // Отключаем шаблон модуля,
            // используем шаблон нашей админки.
            'layout' => null,
        ],
        'files' => [
            'class' => 'common\modules\file_manager\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'csrfCookie' => [
                'path' => '/admin'
            ],
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityCookie' => [
                'name' => '_identity',
                'httpOnly' => true,
            ],
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['sign-in'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [ // Вход на сайт.
                'sign-in' => 'site/login',

                'files/delete' => 'files/default/delete',
                'files/sort' => 'files/default/sort',
            ],
        ],

    ],
    'params' => $params,
];
