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
	// add the public attributes that will be used to store the data to be search
	public $patternNumber;
	public $patternOwner;
	public $dateIssued;
	public $customer;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'contact_id', 'revision', 'job_id'], 'integer'],
	        [['patternNumber', 'customer', 'dateIssued', 'patternOwner'], 'safe'],
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
        $query = Quotes::find()->joinWith([
        	'pricing' => function ($query) {
		        //$query->onCondition(['details.status' => Order::STATUS_ACTIVE]);
        	    $query->andWhere(['quotepricing.revision' => 'quotes.revision']);
	        },
	        'customers',
        ]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
	        'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'quotes.id' => $this->id,
            'quotes.customer_id' => $this->customer_id,
            'quotes.contact_id' => $this->contact_id,
            'quotes.revision' => $this->revision,
            'quotes.job_id' => $this->job_id,
        ]);

	    // Filter query and join
        $query->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'category', $this->category])
	        ->andFilterWhere(['like','quotepricing.dateIssued', $this->dateIssued])
	        ->andFilterWhere(['like','quotepricing.patternOwner', $this->patternOwner])
	        ->andFilterWhere(['like','quotepricing.patternNumber', $this->patternNumber]);

        return $dataProvider;
    }
}
