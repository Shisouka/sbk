<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductPrice */

$this->title = 'Create Product Price';
$this->params['breadcrumbs'][] = ['label' => 'Product Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
