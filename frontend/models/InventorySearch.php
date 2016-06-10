<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventory;

/**
 * InventorySearch represents the model behind the search form about `app\models\Inventory`.
 */
class InventorySearch extends Inventory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InventoryId', 'ProductQty'], 'integer'],
            ['ProductId','safe'],
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
        $query = Inventory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy("ProductQty ASC"),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('productName');

        $query->andFilterWhere([
            'InventoryId' => $this->InventoryId,
            'ProductQty' => $this->ProductQty,
           
        ]);
        $query->andFilterWhere(['like','product.ProductName',$this->ProductId]);

        return $dataProvider;
    }
     public function searchQty($params)
    {
        $query = Inventory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->where("ProductQty < 5")->orderBy("ProductQty ASC"),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('productName');

        $query->andFilterWhere([
            'InventoryId' => $this->InventoryId,
            'ProductQty' => $this->ProductQty,
           
        ]);
        $query->andFilterWhere(['like','product.ProductName',$this->ProductId]);

        return $dataProvider;
    }
}
