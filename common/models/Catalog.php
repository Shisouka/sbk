<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;

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
            [['name', 'slug', 'title', 'meta_title'], 'string', 'max' => 255],
            [['id'], 'unique'],
            ['sort', 'default', 'value' => 1],
            [['slug'], 'unique'],
            [['name', 'slug', 'title', 'meta_title'], 'trim'],
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
            'title' => 'Title',
            'meta_title' => 'Meta title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcatalog()
    {
        return $this->hasMany(Subcatalog::className(), ['id_catalog' => 'id'])
            ->orderBy('sort');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasMany(CatalogContent::className(), ['id_catalog' => 'id'])
            ->orderBy('sort');
    }

    /**
     * @param $slug
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function findBySlugOrDie($slug)
    {
        $model = self::find()
            ->where([static::tableName() . '.slug' => $slug])
            ->one();
        if (empty($model)) {
            throw new NotFoundHttpException("Страница не найдена");
        }
        return $model;
    }
}
