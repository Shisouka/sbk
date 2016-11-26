<?php
/**
 * Created by PhpStorm.
 * User: programmer
 * Date: 09.10.2015
 * Time: 10:48
 */

namespace common\modules\file_manager\models;

use common\helpers\image;
use common\helpers\uuid;
use common\models\Catalog;
use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;

class Files extends FilesBase
{

    public $file, $url, $fileUrl;

    public $mainDir;
    public $domain;
    public $rootPath;

    public static $imageMime = ['image/gif', 'image/jpeg', 'image/png'];


    public function __construct($config = []) {
        parent::__construct($config);
        $Module = \Yii::$app->getModule('files');
		$this->domain = $Module->domain;
		$this->mainDir = $Module->mainDir;
		$this->rootPath = $Module->rootPath;

        // Костыль для OpenServer. 
        // Imagine валит апач при попытке работы с изображениями.
        if (YII_ENV == 'dev') {
            \yii\imagine\Image::$driver = \yii\imagine\Image::DRIVER_GD2;
        }
    }


    public static function getDeleteUrl(){
        return (isset(\Yii::$app->components['request']['baseUrl']) ? \Yii::$app->components['request']['baseUrl'] : '') . '/files/default/delete';
    }

    public static function getSortUrl(){
        return (isset(\Yii::$app->components['request']['baseUrl']) ? \Yii::$app->components['request']['baseUrl'] : '') . '/files/default/sort';
    }

    /*
     * возвращает полную ссылку на файл
     */
    public function getFileUrl(){
        return $this->domain . '/' . $this->getDir() . '/' . $this->getFullName();
    }


    /*
     * $name имя файла
     * возвращает полную ссылку на файл $name
     */
    public function getFileUrlByName($name){
        return  $this->domain . '/' . $this->getDir() . '/' . $name;
    }

    /*
     * возвращает директория файла на основе даты создания (<year>/<month>)
     */
    public function getDir(){
        $dir = explode('-', $this->created_at);
        return "{$dir[0]}/$dir[1]";
    }

    /*
     * возвращает полное имя файла(<name>.<ext>)
     */
    public function getFullName(){
        return "{$this->name}.{$this->ext}";
    }

    /*
     * меняет размер изображения
     */
    public function getResizeImage($width = 0, $height = 0){

        $dir = $this->getDirRealPath();
        $origin = "{$dir}/{$this->getFullName()}";


        $imagine = new \yii\imagine\Image();
        $tools = $imagine->getImagine();
        $open = $tools->open($origin);
        $size = $open->getSize();
        $oWidth = $size->getWidth();
        $oHeight = $size->getHeight();

        $fileName = ($oWidth + $width) . "x" . ($oHeight + $height) . ".{$this->ext}";

        if(!file_exists("{$dir}/{$this->name}_resize"))
            mkdir("{$dir}/{$this->name}_resize");

        if(!file_exists("{$dir}/{$this->name}_resize/$fileName")){
            $open->resize(new Box($oWidth + $width, $oHeight + $height));
            $open->save("{$dir}/{$this->name}_resize/{$fileName}");
        }

        return $this->getFileUrlByName("/{$this->name}_resize/{$fileName}");
    }

    /*
     * создает thumbnail для изображения
     */
    public function getThumbnailUrl($width, $height, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
    {
        $dir = $this->getDirRealPath();
        $thumbName = "{$width}x{$height}.{$this->ext}";

        if (!file_exists("{$dir}/{$this->name}_thumbs")) {
            mkdir("{$dir}/{$this->name}_thumbs");
        }

        //проверяем наличие файла на сервере
        if(!file_exists("{$dir}/{$this->name}.{$this->ext}"))
            return null;

        $thumbnailFilePath = "{$dir}/{$this->name}_thumbs/{$thumbName}";
        if (!file_exists($thumbnailFilePath)) {
            //$quality = ($this->ext == 'png') ? 0 : 90;
            $quality = ($this->ext == 'png') ? 0 : 100;

            $originalFilePath = "{$dir}/{$this->getFullName()}";
            
            // 15.06.16 старый  thumbname от \yii\imagine\BaseImage почему-то перестал центрировать картинку, а прижимал её к краю бокса. Пришлось написать хэлпер-наследник
            image::thumbnail($originalFilePath, $width, $height, $mode)
                ->save($thumbnailFilePath, ['quality' => $quality]);

            // Оптимизируем изображение с помощью расширения "ps/image-optimizer".
            // Утилита сама определяет формат и выбирает подходящие настройки оптимизации.
            // При успешной оптимизации, файл перезаписывается.
            // Если оптимизирование не удалось, файл остаётся нетронутым.
            $factory = new \ImageOptimizer\OptimizerFactory();
            $optimizer = $factory->get();
            $optimizer->optimize($thumbnailFilePath);
        }

        return $this->getFileUrlByName("{$this->name}_thumbs/{$thumbName}");
    }

    /*
     * возвращает физический путь до файла
     */
    public function getFileRealPath(){
        return "{$this->getDirRealPath()}/{$this->getFullName()}";
    }

    /*
     * возвращает физический путь папки файла
     */
    public function getDirRealPath(){
        $structure = "{$this->mainDir}/{$this->getDir()}";
        $basePath = realpath(\Yii::getAlias($this->rootPath));
        return "$basePath/$structure";
    }

    /*
     * return false if not save file or not save model
     */
    public function saveUploadedFile($files_list_id = null)
    {
        // если не передали файл то выходим
        if(!$this->file){
            return false;
        }

        $year = date('Y', time());
        $month = date('m', time());
        $this->url = "{$year}/{$month}";
        $structure = "{$this->mainDir}/{$this->url}";
        $basePath = realpath(\Yii::getAlias($this->rootPath));

        $absolutePath = "$basePath/$structure";

        if (!file_exists($absolutePath)) {
            mkdir($absolutePath, 0777, true);
        }

        $database = \Yii::$app->db->createCommand("SELECT DATABASE()")->queryScalar();
        $model = \Yii::$app->db->createCommand(
            "SELECT auto_increment FROM information_schema.tables WHERE table_name='".self::tableName()."' AND table_schema='".$database."'"
        )->queryOne();
        $name = md5($model['auto_increment'].'_'.mt_rand(0,100));
        $this->name = $name;
        $this->ext = $this->file->extension;
        $this->origin_name = $this->file->baseName ? : $this->file->name ? : 'UNDEFINED NAME';
        $this->mime = $this->file->type;
        $this->size = $this->file->size;
        $this->files_list_id = null;
        $this->user_id = \Yii::$app->user->id;

        if($files_list_id)
            $this->files_list_id = $files_list_id;
        if(!$this->file->saveAs("{$absolutePath}/{$this->getFullName()}"))
        {
			return false;
        }
       
		if(!$this->save())
			return false;
        return $this;
    }

    public function afterDelete()
    {
        if (parent::beforeDelete()) {
            $fileDir = $this->getDirRealPath();
            $file = "{$fileDir}/{$this->getFullName()}";
            // удаляем файл
            if(file_exists($file))
                unlink($file);
            // удаляем миниатюры
            if (file_exists("{$fileDir}/{$this->name}_thumbs/")) {
                foreach (glob("{$fileDir}/{$this->name}_thumbs/*") as $file)
                    unlink($file);
                rmdir("{$fileDir}/{$this->name}_thumbs/");
            }

            // удаляем ресайзы
            if (file_exists("{$fileDir}/{$this->name}_resize/")) {
                foreach (glob("{$fileDir}/{$this->name}_resize/*") as $file)
                    unlink($file);
                rmdir("{$fileDir}/{$this->name}_resize/");
            }

            return true;
        } else {
            return false;
        }
    }


    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

			$date = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
            $now = $date->format('Y-m-d H:i:s');

            if($this->isNewRecord) {
                $this->created_at = $now;
            }

            $this->updated_at = $now;
            return true;
        } else {
            return false;
        }
    }

    public function isImage()
    {
        $isImage =in_array($this->mime, self::$imageMime);
        if(!$isImage)
            $this->addError('file', 'This file is not image.');
        return $isImage;
    }
}