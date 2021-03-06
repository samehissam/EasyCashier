<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ritem;

/**
 * RitemSearch represents the model behind the search form about `app\models\Ritem`.
 */
class RitemSearch extends Ritem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['item_name', 'category_id'], 'safe'],
            [['item_cost'], 'number'],
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
    public function search($params)
    {
        $query = Ritem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //Rcategory
         $query->joinWith('rcategory');

        $query->andFilterWhere([
            'item_id' => $this->item_id,
            'item_cost' => $this->item_cost,
            //'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name]);
        $query->andFilterWhere(['like', 'rcategory.category_name', $this->category_id]);


        return $dataProvider;
    }
}
