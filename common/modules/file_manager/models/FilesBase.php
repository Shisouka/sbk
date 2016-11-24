<?php

namespace common\modules\file_manager\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property string $id
 * @property string $name
 * @property string $origin_name
 * @property string $mime
 * @property string $ext
 * @property string $alt
 * @property integer $size
 * @property string $created_at
 * @property string $updated_at
 * @property string $files_list_id
 * @property integer $user_id
 *
 * @property BlogAdvArticles[] $blogAdvArticles
 * @property FilesLists $filesList
 */
class FilesBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'origin_name', 'mime', 'ext', 'size', 'user_id'], 'required'],
            [['size', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['id', 'mime', 'files_list_id'], 'string', 'max' => 16],
            [['name', 'origin_name', 'alt'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 8],
            [['files_list_id'], 'exist', 'skipOnError' => true, 'targetClass' => FilesLists::className(), 'targetAttribute' => ['files_list_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'origin_name' => 'Origin Name',
            'mime' => 'Mime',
            'ext' => 'Ext',
            'alt' => 'Alt',
            'size' => 'Size',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'files_list_id' => 'Files List ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogAdvArticles()
    {
        return $this->hasMany(BlogAdvArticles::className(), ['main_image' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilesList()
    {
        return $this->hasOne(FilesLists::className(), ['id' => 'files_list_id']);
    }
}
