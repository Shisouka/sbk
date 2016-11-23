<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Subcatalog;

/**
 * SubcatalogSearch represents the model behind the search form about `common\models\Subcatalog`.
 */
class SubcatalogSearch extends Subcatalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_catalog', 'sort'], 'integer'],
            [['name', 'slug'], 'safe'],
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
    public function search($params, $id_catalog = '')
    {
        $query = Subcatalog::find();
        if($id_catalog)
            $query->andWhere([self::tableName() . '.id_catalog' => $id_catalog]);
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
            self::tableName() . '.sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', self::tableName() . '.name', $this->name])
            ->andFilterWhere(['like', self::tableName() . '.slug', $this->slug]);

        return $dataProvider;
    }
}
