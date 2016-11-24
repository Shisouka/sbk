<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CatalogContent;

/**
 * CatalogContentSearch represents the model behind the search form about `common\models\CatalogContent`.
 */
class CatalogContentSearch extends CatalogContent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_catalog', 'id_subcatalog'], 'integer'],
            [['title', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $id_catalog=false, $id_subcatalog=false)
    {
        $query = CatalogContent::find();
        if($id_catalog)
            $query->andWhere([self::tableName() . '.id_catalog' => $id_catalog]);
        elseif($id_subcatalog)
            $query->andWhere([self::tableName() . '.id_subcatalog' => $id_subcatalog]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName() . '.id' => $this->id,
            self::tableName() . '.id_catalog' => $this->id_catalog,
            self::tableName() . '.id_subcatalog' => $this->id_subcatalog,
        ]);

        $query->andFilterWhere(['like', self::tableName() . '.title', $this->title])
            ->andFilterWhere(['like', self::tableName() . '.content', $this->content]);

        return $dataProvider;
    }
}
