<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SubcatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$title = 'Подкаталоги';
?>
<div class="subcatalog-index">

    <h1><?= Html::encode($title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subcatalog', ['subcatalog/create/','id_catalog'=>$id_catalog], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(['enablePushState'=>false]); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'slug',
            'sort',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', ['subcatalog/view','id'=>$model['id']],
                            ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                    },
                    'update'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', ['subcatalog/update','id'=>$model['id']],
                            ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
                    },
                    'delete'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', ['subcatalog/delete','id'=>$model['id']],
                            ['title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                    'method' => 'post',
                                ]
                            ]);
                    }
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
