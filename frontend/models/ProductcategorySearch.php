<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productcategory;

/**
 * ProductcategorySearch represents the model behind the search form about `app\models\Productcategory`.
 */
class ProductcategorySearch extends Productcategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductCategoryId'], 'integer'],
            [['ProductCategoryName'], 'safe'],
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
        $query = Productcategory::find();

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
            'ProductCategoryId' => $this->ProductCategoryId,
        ]);

        $query->andFilterWhere(['like', 'ProductCategoryName', $this->ProductCategoryName]);

        return $dataProvider;
    }
}
