<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rtransaction;

/**
 * RtransactionSearch represents the model behind the search form about `app\models\Rtransaction`.
 */
class RtransactionSearch extends Rtransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

              [['id', 'qty', 'item_item_id', 'user_id'], 'integer'],
            [['order_status'], 'safe'],
            [['id', 'invoice_id', 'qty'], 'integer'],
            [['date', 'item_item_id'], 'safe'],
           // [['total'], 'number'],
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
        $query = Rtransaction::find();

        $now="'".Date('Y-m-d ')."'";
        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy("id DESC")->where("Date(date) =".$now),
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
            'invoice_id' => $this->invoice_id,
            'qty' => $this->qty,
            'date' => $this->date,
           // 'item_item_id' => $this->item_item_id,
           // 'total' => $this->total,
        ]);
         $query->andFilterWhere(['like', 'ritem.item_name', $this->item_item_id]);

        return $dataProvider;
    }
}
