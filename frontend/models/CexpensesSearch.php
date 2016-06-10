<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cexpenses;

/**
 * CexpensesSearch represents the model behind the search form about `app\models\Cexpenses`.
 */
class CexpensesSearch extends Cexpenses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expense_id'], 'integer'],
            [['cost'], 'number'],
            [['description', 'date', 'expense_type_id'], 'safe'],
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
        $query = Cexpenses::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy("id DESC"),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('expenseType');

        $query->andFilterWhere([
            'expense_id' => $this->expense_id,
            'cost' => $this->cost,
            'date' => $this->date,
           // 'expense_type_id' => $this->expense_type_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', 'cexpensetype.name', $this->expense_type_id]);

        return $dataProvider;
    }
}
