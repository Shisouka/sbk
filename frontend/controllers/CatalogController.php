<?php
namespace frontend\controllers;

use common\models\Catalog;
use common\models\Subcatalog;
use Yii;
use yii\web\Controller;


class CatalogController extends Controller
{
    public function actionView($catalogSlug, $subcatalogSlug=null)
    {
        $model = Catalog::findBySlugOrDie($catalogSlug);
        
        if (!empty($subcatalogSlug)) {
            $model = Subcatalog::findBySlugOrDie($subcatalogSlug, $model->id);
        }
        $content = $model->content;


        return $this->render('index', [
            'model' => $model,
            'content' => $content
        ]);
    }
}
