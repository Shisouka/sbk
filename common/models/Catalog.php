<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $sort
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['id', 'sort'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['id'], 'unique'],
            ['sort', 'default', 'value' => 1],
            [['slug'], 'unique'],
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
            'slug' => 'Slug',
            'sort' => 'Sort',
        ];
    }
}
