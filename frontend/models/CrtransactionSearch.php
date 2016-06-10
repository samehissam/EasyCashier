<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Crtransaction;

/**
 * CrtransactionSearch represents the model behind the search form about `app\models\Crtransaction`.
 */
class CrtransactionSearch extends Crtransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qty', 'item_item_id', 'table_table_id', 'user_id'], 'integer'],
            [['table_session', 'order_status', 'item_item_id'], 'safe'],
            //[['total'], 'number'],
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
        $query = Crtransaction::find();

        // add conditions that should always apply here

    
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
           // 'total' => $this->total,
            'table_table_id' => $this->table_table_id,
            'user_id' => $this->user_id,
        ]);
         $query->andFilterWhere(['like', 'ritem.item_name', $this->item_item_id]);

        return $dataProvider;
    }
}


      /*  // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'qty' => $this->qty,
            'table_session' => $this->table_session,
            'item_item_id' => $this->item_item_id,
            //'total' => $this->total,
            'table_table_id' => $this->table_table_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'order_status', $this->order_status]);

        return $dataProvider;
    }
}*/
