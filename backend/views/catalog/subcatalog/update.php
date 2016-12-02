<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subcatalog */

$this->title = "Редактирование подкаталога";

$this->params['breadcrumbs'][] = ['label' => 'Каталог продукции', 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => $model->catalog->name, 'url' => ['/catalog/view','id'=>$model->id_catalog]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['subcatalog/view','id'=>$model->id]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="subcatalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
