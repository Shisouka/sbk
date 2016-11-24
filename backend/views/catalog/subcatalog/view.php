<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subcatalog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог продукции', 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => $model->catalog->name, 'url' => ['/catalog/view','id'=>$model->id_catalog]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="subcatalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_catalog',
            'name',
            'slug',
            'sort',
        ],
    ]) ?>

    <?php
    $pSearch =  new \common\models\search\CatalogContentSearch();

    $pDP = $pSearch->search(Yii::$app->request->queryParams, false, $model->id);

    echo $this->render('/catalog-content/index',[
        'searchModel' => $pSearch,
        'dataProvider' => $pDP,
        'id_subcatalog' => $model->id,
    ]);
    ?>

</div>
