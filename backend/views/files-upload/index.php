<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FilesUploadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files Uploads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-upload-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Загрузить файл', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_file',
                'format' => 'raw',
                'content' => function($data){
                    return ($data->id_file AND $image = $data->id_fileImage) ? "<a href='".$image->getFileUrl()."' target='_blank'><img src='".$image->getThumbnailUrl(null, 200)."'></a>" : '-';
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>
</div>
