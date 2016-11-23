<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subcatalog */

$this->title = 'Create Subcatalog';
$this->params['breadcrumbs'][] = ['label' => 'Subcatalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcatalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id_catalog' => $id_catalog,
    ]) ?>

</div>
