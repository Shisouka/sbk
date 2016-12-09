<?php
/**
 * @var $page_content \common\models\Pages;
 */
$this->title = !empty($page_content->meta_title) ? $page_content->meta_title : 'Системы безопасности кровли. Borge';
?>
<?= !empty($page_content->text) ?  $page_content->text : ''; ?>
