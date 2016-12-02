<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Catalog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-view">

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
            'name',
            'slug',
            'title',
            'meta_title',
            'sort',
        ],
    ]) ?>

    <?php
    $pSearch =  new \common\models\search\SubcatalogSearch();

    $pDP = $pSearch->search(Yii::$app->request->queryParams, $model->id);

    echo $this->render('subcatalog/index',[
        'searchModel' => $pSearch,
        'dataProvider' => $pDP,
        'id_catalog' => $model->id,
    ]);
    ?>


    <?php
    $pSearch =  new \common\models\search\CatalogContentSearch();

    $pDP = $pSearch->search(Yii::$app->request->queryParams, $model->id);

    echo $this->render('/catalog-content/index',[
        'searchModel' => $pSearch,
        'dataProvider' => $pDP,
        'id_catalog' => $model->id,
    ]);
    ?>
</div>
