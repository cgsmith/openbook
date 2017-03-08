<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Instructions;

/**
 * InstructionsSearch represents the model behind the search form about `app\models\Instructions`.
 */
class InstructionsSearch extends Instructions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cust_id'], 'integer'],
            [['instruction', 'color'], 'safe'],
            [['hours', 'material', 'order'], 'number'],
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
        $query = Instructions::find();

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
            'hours' => $this->hours,
            'material' => $this->material,
            'cust_id' => $this->cust_id,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'instruction', $this->instruction])
            ->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
