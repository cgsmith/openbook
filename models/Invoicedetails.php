<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoicedetails".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string $instruction
 * @property string $price
 * @property integer $invoice_id
 */
class Invoicedetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoicedetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'invoice_id'], 'integer'],
            [['price'], 'number'],
            [['invoice_id'], 'required'],
            [['instruction'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'instruction' => Yii::t('app', 'Instruction'),
            'price' => Yii::t('app', 'Price'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
        ];
    }
}
