<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Price', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image',
                'filter' => '',
                'content' => function($data) {
                    return "<img src='" . $data->imageImage->getThumbnailUrl(null, 100) . "'>";
                }
            ],
            'name',
            'cost',
            'sort',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
