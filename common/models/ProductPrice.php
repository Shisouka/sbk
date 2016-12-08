<?php

namespace common\models;

use common\modules\file_manager\models\Files;
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

    // трейт по работе с загрузкой файлов
    public $LFT_FIELDS = ['image'=>['required'=>true]];  // массив со всеми ячейками, где обязательно требуется наличие файла
    use \common\traits\LoadFilesTrait {
    }

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
            [['cost', 'sort'], 'integer'],
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
            'image' => 'Картинка',
            'name' => 'Название',
            'cost' => 'Стоимость',
            'sort' => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageImage()
    {
        return $this->hasOne(Files::className(), ['id' => 'image']);
    }
}
