<?php

/*
 * TODO:
 * Можно подумать как интегрировать сортировку файлов сразу с этим модулем.
 * */

namespace common\modules\file_manager\controllers;

use common\helpers\uuid;
use common\modules\file_manager\models\Files;
use common\modules\file_manager\models\FilesLists;
use common\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class DefaultController extends Controller
{
    public function actionDelete(){
        \Yii::$app->response->format = 'json';
        if(!$id = \Yii::$app->request->getBodyParam('key')){
            return ['error' => 'undefined "key"'];
        }
        $model = Files::findOne(['id' => $id]);
        if(!$model->delete()){
            return ['error' => $model->getErrors()];
        }

        return true;
    }

    public function actionSort(){
        \Yii::$app->response->format = 'json';
         $post=\Yii::$app->request->post();
        if(empty($post['files'])) return ['error' => 'empty input"'];
        $files=$post['files'];
        if(!is_array($files) || count($files)<2)
            return ['error' => 'wrong format"'];

        foreach($files as $key=>$id){
            if($model = Files::findOne(['id' => $id])){
                $model['sort']=$key+1;
                $model->save();
            };
        }
        return true;
    }


    // Пока не используется
    /*public function actionUpload_files_list(){
        if(!isset($_POST['objectUid']) OR empty($_POST['objectUid']))
            return false;

        $objectUid = $_POST['objectUid'];

        $model = FilesLists::findOne(['obj_id' => uuid::uuid2bin($objectUid)]);

        if(!$model) {
            $model = new FilesLists();
            $model->id = uuid::binUuid();
            $model->obj_id = (STRING)uuid::uuid2bin($objectUid);
            $model->save();
        }

        return $this->actionUpload(uuid::bin2uuid((STRING)$model->id));
    }*/

    /*public function actionUpload($files_list_id = null){
        //
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new Files();
        $model->file = UploadedFile::getInstance($model, 'file');

        if (!$model->saveUploadedFile($files_list_id)) {
            return ['error' => $model->getErrors()];
        }

        if (!$model->isImage()) {
            return ['error' => $model->getErrors()];
        }

        // создаем модель Files
        // вызываем метод созранения файла
        // отвечаем jsonom

        $response['files'][] = [
            'url'           => 'http://files.top100edu.local/' . $model->url . "/{$model->name}.{$model->ext}",
            'thumbnailUrl'  => 'http://files.top100edu.local/' . $model->url . "/{$model->name}.{$model->ext}",//$model->getDefaultThumbUrl($bundle->baseUrl),
            'name'          => "{$model->name}.{$model->ext}",
            'type'          => $model->mime,
            'size'          => $model->size,
            'deleteUrl'     => Url::to(['/file/delete', 'id' => $model->id]),
            'deleteType'    => 'POST',
        ];

        return $response;
    }*/
}
