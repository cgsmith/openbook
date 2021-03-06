<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'margin', 'payrollsetting', 'smtp_testing'], 'integer'],
            [['address', 'citystzip', 'phone', 'fax', 'nextpayroll', 'payroll_emails', 'vacation_reminder_emails', 'smtp_user', 'smtp_password', 'smtp_from', 'smtp_bcc', 'smtp_port', 'smtp_server'], 'safe'],
            [['shoprate'], 'number'],
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
        $query = Company::find();

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
            'shoprate' => $this->shoprate,
            'margin' => $this->margin,
            'nextpayroll' => $this->nextpayroll,
            'payrollsetting' => $this->payrollsetting,
            'smtp_testing' => $this->smtp_testing,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'citystzip', $this->citystzip])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'payroll_emails', $this->payroll_emails])
            ->andFilterWhere(['like', 'vacation_reminder_emails', $this->vacation_reminder_emails])
            ->andFilterWhere(['like', 'smtp_user', $this->smtp_user])
            ->andFilterWhere(['like', 'smtp_password', $this->smtp_password])
            ->andFilterWhere(['like', 'smtp_from', $this->smtp_from])
            ->andFilterWhere(['like', 'smtp_bcc', $this->smtp_bcc])
            ->andFilterWhere(['like', 'smtp_port', $this->smtp_port])
            ->andFilterWhere(['like', 'smtp_server', $this->smtp_server]);

        return $dataProvider;
    }
}
