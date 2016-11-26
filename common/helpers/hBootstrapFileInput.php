<?php
/**
 * Created by PhpStorm.
 * User: СергейБеляев
 * Date: 15.16.16
 * Time: 13:48
 */

namespace common\helpers;


use common\modules\file_manager\models\Files;
use Imagine\Image\ManipulatorInterface;
use yii\base\Exception;
use yii\helpers\Html;
use \common\helpers\uuid;
use  \Yii;

class hBootstrapFileInput
{
	/**
	 *  Типы загружаемых файлов
	 *  'ending' => окончание для геттера
	 *  'method' => метод, работающий с этим файлом
	 */
	private static $types = [
		'image' => [
			'ending' => 'Image',
			'method' => 'BFileInputImage',
		],
		'pdf' => [
			'ending' => 'PDF',
			'method' => 'BFileInputPDF',
		],
		'mp4' => [
			'ending' => 'MP4',
			'method' => 'BFileInputMP4',
		],
	];
	public static function getBootstrapFileInputOptions($model, $cell, $del=false)
	{
		// если нету такого свойства в модели и нету в вспомогательном свойстве, храняшим ячейки для работы с трейтом файлов, то выводим ошибку
		if(!isset($model->$cell) && (!property_exists($model, 'LFT_FIELDS') || (property_exists($model, 'LFT_FIELDS') && is_array($model->LFT_FIELDS) && !isset($model->LFT_FIELDS[$cell]) && !in_array($cell, $model->LFT_FIELDS)))) {
			throw new Exception("Не найдено свойство '{$cell}' в модели '{$model::className()}'");
		}

		/**
		 * Для картинок геттер должен называться getИмя_столбцаImage
		 * Для PDF файлов геттер должен называться getИмя_столбцаPDF
		*/
		foreach (self::$types as $type) {
			$getter = 'get'.ucfirst($cell).$type['ending'];
			if (method_exists($model,$getter)) {
				$file = $model->$getter()->one();
				return self::$type['method']($model, $file , $del);
			}
		}

		throw new Exception("Не найден геттер для свойства '{$cell}'  в модели '{$model::className()}'");
	}

	public static function getBootstrapFilesInputOptions($model, $cell)
	{

		$cell .= 'Images';
		$filesList = $model->$cell;
		$files = [];
		$initialPreview = [];
		$initialPreviewConfig = [];

		if ($filesList)
			$files = $filesList->getFiles()->all();

		if ($files AND count($files) > 0)
			foreach ($files as $file) {
				$initialPreview[] = Html::img($file->getFileUrl(), ['class' => 'file-preview-image', 'alt' => $file->alt,'id' => uuid::bin2uuid($file->id)]);
				$initialPreviewConfig[] = [
					'key' => uuid::bin2uuid($file->id),
					'extra' => ['id' => uuid::bin2uuid($file->id)],
					'url' => Yii::$app->request->baseUrl.'/files/delete',
					'data-key'=>uuid::bin2uuid($model->id)
				];
			}

		return [
			'deleteUrl' => Files::getDeleteUrl(),
			'uploadExtraData' => ['objectUid' => uuid::bin2uuid($model->id)],
			/*'showCaption' => false,
			'showRemove' => false,*/
			'showUpload' => false,
			'layoutTemplates' => [
				'preview'=> '<div class="file-preview {class}">
                                <div class="{dropClass}">
                                    <div class="file-preview-thumbnails" id="filesort" data-file-sort="true"></div>
                                    <div class="clearfix"></div>
                                    <div class="file-preview-status text-center text-success"></div>
                                    <div class="kv-fileinput-error"></div>
                                </div>
                            </div>',
			],
			'overwriteInitial'=> false,
			'browseLabel' =>  'Загрузить картинки',
			'initialPreview' => $initialPreview,
			'initialPreviewConfig' => $initialPreviewConfig,
		];
	}

	private static function BFileInputImage($model, $Image, $del)
	{
		$initialPreview = [];
		$initialPreviewConfig = [];

		if (isset($Image->id) AND !empty($Image->id)) {
			if (strpos($Image->mime, 'image/') !== false) {
				$initialPreview[] = Html::img($Image->getThumbnailUrl(100, 100, ManipulatorInterface::THUMBNAIL_INSET), ['class' => 'file-preview-image', 'alt' => $Image->alt]);
			}
			if($del) {
				$initialPreviewConfig[] = [
					'key' => uuid::bin2uuid($Image->id),
					'extra' => ['id' => uuid::bin2uuid($Image->id)],
					'url' => Yii::$app->request->baseUrl.'/files/delete',
					'data-key'=>uuid::bin2uuid($model->id)
				];
			}
//            $initialPreviewConfig[] = [
//                'key' => uuid::bin2uuid($promoImage->id),
//                'url' => Files::getDeleteUrl(),
//                'extra' => ['id' => uuid::bin2uuid($promoImage->id)],
//            ];
		}

		return [
			'deleteUrl' => Files::getDeleteUrl(),
			'showRemove' => false,
			'showUpload' => false,
			'layoutTemplates' => [
				'preview'=> '<div class="file-preview {class}">
                                <div class="{dropClass}">
                                    <div class="file-preview-thumbnails"></div>
                                    <div class="clearfix"></div>
                                    <div class="file-preview-status text-center text-success"></div>
                                    <div class="kv-fileinput-error"></div>
                                </div>
                            </div>',
			],
			'browseLabel' =>  "Загрузить картинку",
			'initialPreview' => $initialPreview,
			'initialPreviewConfig' => $initialPreviewConfig,];
	}

	private static function BFileInputPDF($model, $pdf, $del)
	{
		$initialPreview = [];
		$initialPreviewConfig = [];

		if (isset($pdf->id) AND !empty($pdf->id)) {
			if ($pdf->mime == 'application/pdf') {
				$initialPreview[] = "<embed class=\"kv-preview-data\" src=\"{$pdf->getFileUrl()}\" width=\"100%\" height=\"200px\" type=\"application/pdf\">";
			}
			if($del) {
				$initialPreviewConfig[] = [
					'key' => uuid::bin2uuid($pdf->id),
					'extra' => ['id' => uuid::bin2uuid($pdf->id)],
					'url' => Yii::$app->request->baseUrl.'/files/delete',
					'data-key'=>uuid::bin2uuid($model->id)
				];
			}
//            $initialPreviewConfig[] = [
//                'key' => uuid::bin2uuid($promoImage->id),
//                'url' => Files::getDeleteUrl(),
//                'extra' => ['id' => uuid::bin2uuid($promoImage->id)],
//            ];
		}

		return [
			'deleteUrl' => Files::getDeleteUrl(),
			'showRemove' => false,
			'showUpload' => false,
			'layoutTemplates' => [
				'preview'=> '<div class="file-preview {class}">
                                <div class="{dropClass}">
                                    <div class="file-preview-thumbnails"></div>
                                    <div class="clearfix"></div>
                                    <div class="file-preview-status text-center text-success"></div>
                                    <div class="kv-fileinput-error"></div>
                                </div>
                            </div>',
			],
			'browseLabel' =>  "Загрузить PDF-файл",
			'initialPreview' => $initialPreview,
			'initialPreviewConfig' => $initialPreviewConfig,];
	}

	private static function BFileInputMP4($model, $video, $del)
	{
		$initialPreview = [];
		$initialPreviewConfig = [];

		if (isset($video->id) AND !empty($video->id)) {
			if ($video->mime == 'video/mp4') {
				$initialPreview[] = "<video style='width: 300px;' preload=\"auto\" data-setup=\"{&quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;loop&quot;: &quot;true&quot;, &quot;preload&quot;: &quot;auto&quot;}\" loop=\"true\" autoplay=\"\">
                                <source src='{$video->getFileUrl()}' type=\"video/mp4\">
                            </video>";
			}
			if($del) {
				$initialPreviewConfig[] = [
					'key' => uuid::bin2uuid($video->id),
					'extra' => ['id' => uuid::bin2uuid($video->id)],
					'url' => Yii::$app->request->baseUrl.'/files/delete',
					'data-key'=>uuid::bin2uuid($model->id)
				];
			}
//            $initialPreviewConfig[] = [
//                'key' => uuid::bin2uuid($promoImage->id),
//                'url' => Files::getDeleteUrl(),
//                'extra' => ['id' => uuid::bin2uuid($promoImage->id)],
//            ];
		}

		return [
			'deleteUrl' => Files::getDeleteUrl(),
			'showRemove' => false,
			'showUpload' => false,
			'layoutTemplates' => [
				'preview'=> '<div class="file-preview {class}">
                                <div class="{dropClass}">
                                    <div class="file-preview-thumbnails"></div>
                                    <div class="clearfix"></div>
                                    <div class="file-preview-status text-center text-success"></div>
                                    <div class="kv-fileinput-error"></div>
                                </div>
                            </div>',
			],
			'browseLabel' =>  "Загрузить mp4-файл",
			'initialPreview' => $initialPreview,
			'initialPreviewConfig' => $initialPreviewConfig,];
	}
}
