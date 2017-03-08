<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Packinglists;

/**
 * PackingslistsSearch represents the model behind the search form about `app\models\Packinglists`.
 */
class PackingslistsSearch extends Packinglists
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'job_id', 'complete'], 'integer'],
            [['dateShipped', 'shipVia', 'shipTo', 'contact'], 'safe'],
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
        $query = Packinglists::find();

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
            'job_id' => $this->job_id,
            'dateShipped' => $this->dateShipped,
            'complete' => $this->complete,
        ]);

        $query->andFilterWhere(['like', 'shipVia', $this->shipVia])
            ->andFilterWhere(['like', 'shipTo', $this->shipTo])
            ->andFilterWhere(['like', 'contact', $this->contact]);

        return $dataProvider;
    }
}
