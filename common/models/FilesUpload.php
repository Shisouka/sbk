<?php

namespace common\models;

use common\modules\file_manager\models\Files;
use Yii;

/**
 * This is the model class for table "{{%files_upload}}".
 *
 * @property integer $id
 * @property integer $id_file
 */
class FilesUpload extends \yii\db\ActiveRecord
{


    // трейт по работе с загрузкой файлов
    public $LFT_FIELDS = ['id_file'=>['required'=>true]];  // массив со всеми ячейками, где обязательно требуется наличие файла
    use \common\traits\LoadFilesTrait {
    }

    //
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files_upload}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_file'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_file' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId_fileImage()
    {
        return $this->hasOne(Files::className(), ['id' => 'id_file']);
    }
}
