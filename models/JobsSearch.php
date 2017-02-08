<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jobs;

/**
 * JobsSearch represents the model behind the search form about `app\models\Jobs`.
 */
class JobsSearch extends Jobs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quote_id', 'quote_rev', 'timeMaterial'], 'integer'],
            [['customer_shopnumber', 'shopNumber', 'dateReceived', 'dateDue', 'status', 'PONumber', 'patternShrink', 'finishStock', 'description', 'notes', 'devonsnotes', 'color'], 'safe'],
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
        $query = Jobs::find();

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
            'quote_rev' => $this->quote_rev,
            'dateReceived' => $this->dateReceived,
            'dateDue' => $this->dateDue,
            'timeMaterial' => $this->timeMaterial,
        ]);

        $query->andFilterWhere(['like', 'customer_shopnumber', $this->customer_shopnumber])
            ->andFilterWhere(['like', 'shopNumber', $this->shopNumber])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'PONumber', $this->PONumber])
            ->andFilterWhere(['like', 'patternShrink', $this->patternShrink])
            ->andFilterWhere(['like', 'finishStock', $this->finishStock])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'devonsnotes', $this->devonsnotes])
            ->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
