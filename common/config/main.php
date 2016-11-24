<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
    ],
    'modules' => [
        'files' => [
            'class' => 'common\modules\file_manager\Module',
            'domain' => '/files',
            'mainDir' => 'files',
            'rootPath' => '@app/../',
        ]
    ],
];
