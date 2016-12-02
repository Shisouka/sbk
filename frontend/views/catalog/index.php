<?php
$this->title = $model->meta_title ? : 'Системы безопасности кровли';
?>

<?php if (!empty($model->title)) : ?>
<div class="title">
	<?= $model->title; ?>
</div>
<?php endif; ?>
<div class="cont">
	<?php
	if (count($content) > 1) {
		$num = 0;
		$class = 'active';
		?>
		<div class="tabs">
			<div class="list">
			<?php
			foreach ($content as $cont) {
				$num++;
				?>
					<div id="tab<?= $num; ?>" class="<?= $class; ?>"><?= $cont->title; ?></div>
			<?php
				$class = '';
			}
			?>
			</div>
			<?php
			$class = 'active';
			$num = 0;
			foreach ($content as $cont) {
				$num++;
				?>
				<section id="content_tab<?= $num; ?>" class="<?= $class; ?>">
					<p>
						<?= $cont->content; ?>
					</p>
				</section>
				<?php
				$class = '';
			}
			?>

		</div>
		<?php

		$script = "
		$(document).ready(function(){
			$('.tabs .list div').on('click', function() {
				if($(this).hasClass('active')) return;
				$('.tabs .list .active').removeClass('active');
				$('.tabs section.active').removeClass('active');
				$(this).addClass('active');
				var id = $(this).attr('id');
				$('section#content_'+id).addClass('active');
			});
		});
	";
		$this->registerJs($script, \yii\web\View::POS_END);

	} else {
		if (empty($content[0]))
			return;

		echo $content[0]->content;

	}
	?>
</div>
