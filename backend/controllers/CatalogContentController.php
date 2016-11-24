<?php

namespace backend\controllers;

use Yii;
use common\models\CatalogContent;
use common\models\search\CatalogContentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatalogContentController implements the CRUD actions for CatalogContent model.
 */
class CatalogContentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all CatalogContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new CatalogContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_catalog=0, $id_subcatalog=0)
    {
        $model = new CatalogContent();
        $model->id_catalog = $id_catalog;
        $model->id_subcatalog = $id_subcatalog;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $params = ['index'];
            if ($model->id_catalog) {
                $params = ['catalog/view', 'id' => $model->id_catalog];
            } elseif ($model->id_subcatalog) {
                $params = ['subcatalog/view', 'id' => $model->id_subcatalog];
            }
            return $this->redirect($params);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CatalogContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $params = ['index'];
            if ($model->id_catalog) {
                $params = ['catalog/view', 'id' => $model->id_catalog];
            } elseif ($model->id_subcatalog) {
                $params = ['subcatalog/view', 'id' => $model->id_subcatalog];
            }
            return $this->redirect($params);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CatalogContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $params = ['index'];
        $model = $this->findModel($id);
        $model->delete();
        if ($model->id_catalog) {
            $params = ['catalog/view', 'id' => $model->id_catalog];
        } elseif ($model->id_subcatalog) {
            $params = ['subcatalog/view', 'id' => $model->id_subcatalog];
        }
        return $this->redirect($params);
    }

    /**
     * Finds the CatalogContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
