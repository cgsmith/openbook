<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotes".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $contact_id
 * @property string $notes
 * @property integer $revision
 * @property integer $job_id
 * @property string $category
 */
class Quotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'contact_id', 'revision', 'category'], 'required'],
            [['customer_id', 'contact_id', 'revision', 'job_id'], 'integer'],
            [['notes'], 'string'],
            [['category'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'contact_id' => Yii::t('app', 'Contact ID'),
            'notes' => Yii::t('app', 'Notes'),
            'revision' => Yii::t('app', 'Revision'),
            'job_id' => Yii::t('app', 'Job ID'),
            'category' => Yii::t('app', 'Category'),
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDetails()
	{
		return $this->hasOne(Quotedetails::className(), ['quote_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPricing()
	{
		return $this->hasOne(Quotepricing::className(), ['quote_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCustomers()
	{
		return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
	}
}
