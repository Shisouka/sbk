<?php
namespace frontend\controllers;

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
        return $this->render('index');
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
        return $this->render('advantages');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionServices()
    {
        return $this->render('services');
    }

    public function actionContacts()
    {
        return $this->render('contacts');
    }
}
