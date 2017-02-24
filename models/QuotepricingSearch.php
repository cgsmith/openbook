<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quotepricing;

/**
 * QuotepricingSearch represents the model behind the search form about `app\models\Quotepricing`.
 */
class QuotepricingSearch extends Quotepricing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quote_id', 'margin', 'revision', 'job_id'], 'integer'],
            [['viewed', 'emailed', 'estimatedDelivery', 'patternOwner', 'patternNumber', 'dateIssued', 'category', 'quotedby'], 'safe'],
            [['totalPrice', 'totalHours', 'totalMaterial', 'shopRate'], 'number'],
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
        $query = Quotepricing::find();

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
            'id' => $this->id,
            'quote_id' => $this->quote_id,
            'viewed' => $this->viewed,
            'emailed' => $this->emailed,
            'totalPrice' => $this->totalPrice,
            'totalHours' => $this->totalHours,
            'totalMaterial' => $this->totalMaterial,
            'margin' => $this->margin,
            'shopRate' => $this->shopRate,
            'dateIssued' => $this->dateIssued,
            'revision' => $this->revision,
            'job_id' => $this->job_id,
        ]);

        $query->andFilterWhere(['like', 'estimatedDelivery', $this->estimatedDelivery])
            ->andFilterWhere(['like', 'patternOwner', $this->patternOwner])
            ->andFilterWhere(['like', 'patternNumber', $this->patternNumber])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'quotedby', $this->quotedby]);

        return $dataProvider;
    }
}
