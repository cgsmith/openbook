<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property integer $id
 * @property string $dateReceived
 * @property string $description
 * @property string $amountPaid
 * @property integer $invoice_id
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateReceived', 'amountPaid', 'invoice_id'], 'required'],
            [['dateReceived'], 'safe'],
            [['amountPaid'], 'number'],
            [['invoice_id'], 'integer'],
            [['description'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dateReceived' => Yii::t('app', 'Date Received'),
            'description' => Yii::t('app', 'Description'),
            'amountPaid' => Yii::t('app', 'Amount Paid'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
        ];
    }
}
