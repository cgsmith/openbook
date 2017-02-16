<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quotes;

/**
 * QuotesSearch represents the model behind the search form about `app\models\Quotes`.
 */
class QuotesSearch extends Quotes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'contact_id', 'revision', 'job_id'], 'integer'],
            [['notes', 'category'], 'safe'],
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
        $query = Quotes::find();

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
            'customer_id' => $this->customer_id,
            'contact_id' => $this->contact_id,
            'revision' => $this->revision,
            'job_id' => $this->job_id,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
