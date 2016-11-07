<?php

namespace common\modules\file_manager\models;

use Yii;

/**
 * This is the model class for table "files_lists".
 *
 * @property string $id
 * @property string $obj_id
 *
 * @property Files[] $files
 */
class FilesListsBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files_lists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['files_list_id' => 'id'])->orderBy('sort','asc');
    }
}
