<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_content}}".
 *
 * @property integer $id
 * @property integer $id_catalog
 * @property integer $id_subcatalog
 * @property string $title
 * @property string $content
 */
class CatalogContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['id', 'id_catalog', 'id_subcatalog'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['id'], 'unique'],
            ['sort', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_catalog' => 'Id Catalog',
            'id_subcatalog' => 'Id Subcatalog',
            'title' => 'Title',
            'content' => 'Content',
            'sort' => 'sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'id_catalog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcatalog()
    {
        return $this->hasOne(Subcatalog::className(), ['id' => 'id_subcatalog']);
    }


}
