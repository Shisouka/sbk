<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_price}}".
 *
 * @property integer $id
 * @property integer $image
 * @property string $name
 * @property integer $cost
 * @property integer $sort
 */
class ProductPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'cost', 'sort'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
            'image' => 'Image',
            'name' => 'Name',
            'cost' => 'Cost',
            'sort' => 'Sort',
        ];
    }
}
