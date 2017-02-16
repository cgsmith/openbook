<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property integer $active
 * @property string $shopNumber
 * @property string $name
 * @property string $billingContact
 * @property string $billingEmail
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 *
 * @property Contacts[] $contacts
 */
class Customers extends \yii\db\ActiveRecord
{
	const CUSTOMER_ACTIVE = 1;
	const CUSTOMER_INACTIVE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['shopNumber', 'name', 'billingContact', 'billingEmail', 'address1', 'city', 'state', 'zip'], 'required'],
            [['shopNumber'], 'string', 'max' => 4],
            [['name', 'billingContact', 'billingEmail', 'address1', 'address2', 'city', 'state'], 'string', 'max' => 64],
            [['zip'], 'string', 'max' => 12],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'active' => Yii::t('app', 'Active'),
            'shopNumber' => Yii::t('app', 'Shop Number'),
            'name' => Yii::t('app', 'Name'),
            'billingContact' => Yii::t('app', 'Billing Contact'),
            'billingEmail' => Yii::t('app', 'Billing Email'),
            'address1' => Yii::t('app', 'Address1'),
            'address2' => Yii::t('app', 'Address2'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip' => Yii::t('app', 'Zip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['customer_id' => 'id']);
    }
}
