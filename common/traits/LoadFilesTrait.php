<?php

/**
 * Created by PhpStorm.
 * User: programmer
 * Date: 23.10.2015
 * Time: 11:27
 */

namespace common\traits;

use common\helpers\uuid;
use common\modules\file_manager\models\Files;
use common\modules\file_manager\models\FilesLists;
use yii\web\UploadedFile;
use yii\base\Model;

trait LoadFilesTrait
{
    private $saveResult;
    private static $fileList;
    /**
     * @return bool|int
     * @throws \yii\db\Exception
     */
    public function beforeSave($insert) 
    {
        if (parent::beforeSave($insert)) {
            
            $fields_new = []; // массив ячеек новых загружаемых файлов
            static::$fileList = []; // статический массив записей таблицы `files_list`.
            $fileUploadedList = [];

            foreach ($this->LFT_FIELDS as $field => $options) {
                if (is_int($field) && !is_array($options)) {
                    $field = $options;
                    $options = [];
                }
                
                // По умолчанию обрабатываем загрузку файлов на сценарии "default".
                // Можно переключить при необходимости.
                $scenario = !isset($options['scenario'])
                    ? [Model::SCENARIO_DEFAULT]
                    : (is_array($options['scenario']) ? $options['scenario'] : [$options['scenario']]);
                if (!in_array($this->scenario, $scenario)) {
                    return true;
                }
                
                // Является ли поле обязательным.
                // Либо "true", либо "false", либо колбэк.
                // По умолчанию "true".
                // Колбэк имеет вид:
                // function (Model $model) { $isRequired = ...; return $isRequired; }
                $required = !isset($options['required']) ? true : $options['required'];
                if (is_callable($required)) {
                    $required = $required($this);
                }
                
                $multi = !empty($options['multiple']);
                $fileUploaded = $multi ? UploadedFile::getInstances($this, $field) : UploadedFile::getInstance($this, $field);

                if (!$fileUploaded) { // если не загружаем новый файл в это поле
                    if (empty($this->oldAttributes[$field])) { // проверяем, был ли файл загружен ранее в это поле
                        if ($required) // раньше тоже файла не было, но поле обязательное
                            $this->addError($field, 'Требуется загрузить файл');
                    } else { // если загружен ранее, то присваиваем старое значение, но сначала проверим, есть ли этот файл на самом деле в БД
                        if ($multi) { // если это список файлов, то смотрим файлы по списку
                            $exist = Files::find()->where(['files_list_id' => $this->oldAttributes[$field]])->limit(1)->one(); // проверяем, есть хоть 1 файл привязанный к данному списку

                            if (!$exist) { // если нет файлов, то чистим список

                                // из-за привязки внешних ключей - не даёт чистить список пока есть запись в поле модели.
                                static::$fileList[]= FilesLists::findOne($this->$field); // записываем в статический массив список, который надо будет подчистить после сохранения модели
                                //if ($file)
                                 //   $file->delete();
                                $this->$field = null; // поле становится null, т.к. старых файлов в бд не обнаружено
                                if ($required)
                                    $this->addError($field, 'Требуется загрузить файл');
                            } else {
                                // файлы привязанные к списку - есть. Можно возвращать старое значение этому полю.
                                $this->$field = $this->oldAttributes[$field];
                            }
                        } else {
                            $exist = Files::findOne($this->oldAttributes[$field]);
                            if (!$exist) { // файла в БД нет, но он обязателен
                                $this->$field = null;
                                if ($required)
                                    $this->addError($field, 'Требуется загрузить файл');
                            } else
                                $this->$field = $this->oldAttributes[$field];
                        }
                    }
                } else { // если загружаем новый файл
                    $fields_new[$field] = $options;
                    $fileUploadedList[$field] = $fileUploaded;
                }
            }
            if ($this->errors) {
                // если есть ошибки (какой-либо файл не загружен), то прерываем сохранение
                return false;
            }

            foreach ($fileUploadedList as $field => $fileUploaded) { // перебираем список новых загружаемых файлов для их сохранения в бд в таблице файлов и на сервере
                $save = !empty($fields_new[$field]['multiple']) ? $this->saveFilesList($fileUploaded, $field) : $this->saveFile($fileUploaded, $field);
                if (!$save) { // если не удаётся по каким-либо причинам сохранить новые файлы,
                    $this->saveFileNewDeleteAll($fields_new); // то удаляем все записи, которые успели сохраниться в бд в таблице файлов и на сервере.
                    break; // выходим из цикла
                }
            }

            if ($this->errors) {
                // если были ошибки при сохранении, то прерываем сохранение
                return false;
            }

            foreach ($fields_new as $field => $options) {
                if (!empty($options['multiple']))
                    continue; // у файлов мультизагрузки не требуется ставить флаги у старых файлов т.к. их(старых файлов) - нет.
                $this->saveFileOldDelete($field); // у старых файлов, если они были загружены до новых - ставим флаг deleted = 1
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!empty(static::$fileList)) {
            foreach (static::$fileList as $list) {
                $list->delete();
            }
        }
    }
    /**
     * @param $fileUploaded
     * @param $field
     * @return bool
     * @throws \Exception
     */
    public function saveFile($fileUploaded, $field)
    {
        $file = new Files();
        $file->file = $fileUploaded;
        if (!$file->saveUploadedFile()) {
            $this->addError($field, 'Ошибка при сохранении файла. Обратитесь в тех.поддержку');
            return false;
        }

        $this->$field = $file->id;
        return true;
    }

    /**
     * @param $filesUploaded
     * @param $field
     * @return bool
     */
    public function saveFilesList($filesUploaded, $field)
    {
        if (!$this->$field) {
            $gal = new FilesLists();

            if ($gal->save()) {
                $this->$field = $gal->id;
            } else {
                $this->addError('files', 'Ошибка при сохранении файлов. Обратитесь в тех.поддержку');
                return false;
            }
        }

        foreach ($filesUploaded as $file) {
            $fileModel = new Files();
            $fileModel->file = $file;
            if (!$result = $fileModel->saveUploadedFile($this->$field)) {
                $this->addError($field, 'Ошибка при сохранении файлов(#' . $field . '). Обратитесь в тех.поддержку');
                return false;
            }
            $this->saveResult[$field][] = $result->id; // записываем в массив айдишники файлов, которые записались в бд
        }

        return true;
    }

    /**
     * @param $field
     */
    public function saveFileOldDelete($field)
    {
        if (isset($this->oldAttributes[$field])) {
            $oldFile = Files::findOne(['id' => $this->oldAttributes[$field]]);
            if ($oldFile) {
                $oldFile->safeDelete();
            }
        }
    }

    /**
     * @param $fields
     */
    public function saveFileNewDeleteAll($fields)
    {
        foreach ($fields as $field => $options) {
            if (!empty($options['multiple'])) {
                if (!empty($this->saveResult[$field])) {
                    foreach ($this->saveResult[$field] as $id_field) {
                        $file = Files::findOne(['id' => $id_field]); // удаляем только что загруженный файл
                        if ($file) {
                            $file->delete();
                        }
                        $files = Files::find()->where(['files_list_id' => $this->$field])->limit(1)->one(); // если больше нет файлов привязанных к этому мультизагруженному полю, то удаляем list
                        if (!$files) {
                            $file = FilesLists::findOne($this->$field);
                            if ($file) {
                                $file->delete();
                            }
                        }
                    }
                }
            } else {
                $file = Files::findOne($this->$field);
                if ($file) {
                    $file->delete();
                }
            }
        }
    }
}
