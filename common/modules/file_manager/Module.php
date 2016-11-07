<?php

namespace common\modules\file_manager;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\file_manager\controllers';

	public $domain = '';
	public $rootPath = '';
	public $mainDir = '';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config.php'));
        // custom initialization code goes here
    }
}
