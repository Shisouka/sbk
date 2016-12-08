<?php
/**
 * @var $model \common\models\ProductPrice;
 * @var $pagination \yii\data\Pagination;
 */
$this->title = 'Цены на продукцию. Системы безопасности кровли';

?>
<?php \yii\widgets\Pjax::begin(['enablePushState' => false]); ?>

<div class="page-price">
	<div class="title">
		Цены на продукцию
	</div>
	<div class="price-list">
		<?php foreach ($model as $product) {?>
			<div class="product">
				<div>
					<img src='<?= $product->imageImage->getThumbnailUrl(150, 100) ?>'>
				</div>
				<div class="name">
					<?= $product->name ?>
				</div>
				<div class="cost">
					<?= number_format($product->cost,0,'',' ') ?> руб./шт.
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?= \yii\widgets\LinkPager::widget(['maxButtonCount'=>'5','options'=>['class'=>'b-pagination'],'pagination' => $pagination]) ?>
<?php \yii\widgets\Pjax::end(); ?>
