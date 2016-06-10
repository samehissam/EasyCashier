<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ctransaction;

/**
 * CtransactionSearch represents the model behind the search form about `app\models\Ctransaction`.
 */
class CtransactionSearch extends Ctransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['id', 'qty', 'item_item_id', 'table_table_id', 'user_id'], 'integer'],
            [['table_session', 'order_status', 'item_item_id'], 'safe'],

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
        $query = Ctransaction::find();
        $date_time = date('Y-m-d H:i:s');
        $now="'".Date('Y-m-d ')."'";
        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy("id DESC")->where("Date(table_session) =".$now),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('itemItem');
        $query->andFilterWhere([
            'id' => $this->id,
            'qty' => $this->qty,
            'table_session' => $this->table_session,
            //'item_item_id' => $this->item_item_id,
            //'total' => $this->total,
            'table_table_id' => $this->table_table_id,
        ]);
         $query->andFilterWhere(['like', 'citem.item_name', $this->item_item_id]);

        return $dataProvider;
    }
}
