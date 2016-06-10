<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CtableSession;

/**
 * CtableSessionSearch represents the model behind the search form about `app\models\CtableSession`.
 */
class CtableSessionSearch extends CtableSession
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_id', 'table_state'], 'integer'],
            [['session_start'], 'safe'],
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
        $query = CtableSession::find();

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
            'table_id' => $this->table_id,
            'table_state' => $this->table_state,
            'session_start' => $this->session_start,
        ]);

        return $dataProvider;
    }
}
