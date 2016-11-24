<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subcatalog */

$this->title = "Создание подкаталога";

$this->params['breadcrumbs'][] = ['label' => 'Каталог продукции', 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => $catalogModel->name, 'url' => ['/catalog/view','id'=>$catalogModel->id]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="subcatalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'catalogModel' => $catalogModel,
    ]) ?>

</div>
