<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $address
 * @property string $citystzip
 * @property string $phone
 * @property string $fax
 * @property string $shoprate
 * @property integer $margin
 * @property string $nextpayroll
 * @property integer $payrollsetting
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address', 'citystzip', 'phone', 'fax', 'shoprate', 'margin'], 'required'],
            [['id', 'margin', 'payrollsetting'], 'integer'],
            [['shoprate'], 'number'],
            [['nextpayroll'], 'safe'],
            [['address', 'citystzip'], 'string', 'max' => 128],
            [['phone', 'fax'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'citystzip' => Yii::t('app', 'Citystzip'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'shoprate' => Yii::t('app', 'Shoprate'),
            'margin' => Yii::t('app', 'Margin'),
            'nextpayroll' => Yii::t('app', 'Nextpayroll'),
            'payrollsetting' => Yii::t('app', 'Payrollsetting'),
        ];
    }
}
