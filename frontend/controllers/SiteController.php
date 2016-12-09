<?php
namespace frontend\controllers;

use common\models\Pages;
use common\models\ProductPrice;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $page_content = Pages::findOne(['slug'=>'main']);
        return $this->render('index', [
            'page_content' => $page_content
        ]);
    }

    /**
     * @return mixed
     */
    public function actionPrice()
    {
        $model = ProductPrice::find()->orderBy('sort');

        $pagination = new Pagination([
            'defaultPageSize' => 21,
            'totalCount' => $model->count(),
        ]);
        $model = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('price', [
            'model' => $model,
            'pagination' => $pagination
        ]);
    }

    public function actionAdvantages()
    {
        $page_content = Pages::findOne(['slug'=>'advantages']);
        return $this->render('index', [
            'page_content' => $page_content
        ]);
    }

    public function actionAbout()
    {
        $page_content = Pages::findOne(['slug'=>'about']);
        return $this->render('index', [
            'page_content' => $page_content
        ]);
    }

    public function actionServices()
    {
        $page_content = Pages::findOne(['slug'=>'services']);
        return $this->render('index', [
            'page_content' => $page_content
        ]);
    }

    public function actionContacts()
    {
        $page_content = Pages::findOne(['slug'=>'contacts']);
        return $this->render('index', [
            'page_content' => $page_content
        ]);
    }

    public function actionGosts()
    {
        $page_content = Pages::findOne(['slug'=>'gosts']);
        
        return $this->render('index', [
            'page_content' => $page_content
        ]);
    }
}
