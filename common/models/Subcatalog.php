<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcatalog}}".
 *
 * @property integer $id
 * @property integer $id_catalog
 * @property string $name
 * @property string $slug
 * @property integer $sort
 */
class Subcatalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcatalog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_catalog', 'name', 'slug'], 'required'],
            [['id_catalog', 'sort'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'name' => 'Name',
            'slug' => 'Slug',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'id_catalog']);
    }
}
