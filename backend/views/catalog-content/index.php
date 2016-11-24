<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CatalogContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if (!empty($id_catalog)) {
    $title = 'Содержание каталога';
    $params = ['/catalog-content/create', 'id_catalog'=>$id_catalog];
} elseif (!empty($id_subcatalog)) {
    $title = 'Содержание подкаталога';
    $params = ['/catalog-content/create', 'id_subcatalog'=>$id_subcatalog];

}
?>
<div class="catalog-content-index">

    <h1><?= Html::encode($title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Catalog Content', $params, ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(['enablePushState'=>false]); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', ['catalog-content/update','id'=>$model['id']],
                            ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
                    },
                    'delete'=>function ($url, $model) {
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', ['catalog-content/delete','id'=>$model['id']],
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
