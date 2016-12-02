<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;

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
            [['name', 'slug', 'title', 'meta_title'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['sort', 'default', 'value' => 1],
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
            'id_catalog' => 'Id Catalog',
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
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'id_catalog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasMany(CatalogContent::className(), ['id_subcatalog' => 'id'])
            ->orderBy('sort');
    }

    /**
     * @param $slug
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function findBySlugOrDie($slug, $id_catalog)
    {
        $model = self::find()
            ->where([static::tableName() . '.slug' => $slug, static::tableName() . '.id_catalog' => $id_catalog])
            ->one();
        if (empty($model)) {
            throw new NotFoundHttpException("Страница не найдена");
        }
        return $model;
    }
}
