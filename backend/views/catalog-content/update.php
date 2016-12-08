<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogContent */

if($model->catalog) {
    $this->title = "{$model->title} продукции \"{$model->catalog->name}\"";
    $this->params['breadcrumbs'][] = ['label' => 'Каталог продукции', 'url' => ['/catalog']];
    $this->params['breadcrumbs'][] = ['label' => $model->catalog->name, 'url' => ['/catalog/view','id'=>$model->id_catalog]];
} elseif($model->subcatalog) {
    $this->title = "{$model->title} продукции \"{$model->subcatalog->name}\"";
    $this->params['breadcrumbs'][] = ['label' => 'Каталог продукции', 'url' => ['/catalog']];
    $this->params['breadcrumbs'][] = ['label' => $model->subcatalog->catalog->name, 'url' => ['/catalog/view','id'=>$model->subcatalog->id_catalog]];
    $this->params['breadcrumbs'][] = ['label' => $model->subcatalog->name, 'url' => ['/subcatalog/view','id'=>$model->id_subcatalog]];
}

$this->params['breadcrumbs'][] = ['label' => 'Содержание продукции'];

?>
<div class="catalog-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
