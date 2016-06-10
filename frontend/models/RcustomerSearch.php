<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rcustomer;

/**
 * RcustomerSearch represents the model behind the search form about `app\models\Rcustomer`.
 */
class RcustomerSearch extends Rcustomer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId'], 'integer'],
            [['CustomerName', 'CustomerPhone', 'CustomerAddress'], 'safe'],
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
        $query = Rcustomer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'CustomerId' => $this->CustomerId,
        ]);

        $query->andFilterWhere(['like', 'CustomerName', $this->CustomerName])
            ->andFilterWhere(['like', 'CustomerPhone', $this->CustomerPhone])
            ->andFilterWhere(['like', 'CustomerAddress', $this->CustomerAddress]);

        return $dataProvider;
    }
}
