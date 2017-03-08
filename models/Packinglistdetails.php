<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packinglistdetails".
 *
 * @property integer $id
 * @property integer $packing_id
 * @property integer $job_id
 * @property string $shippingItem
 */
class Packinglistdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packinglistdetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['packing_id', 'job_id', 'shippingItem'], 'required'],
            [['packing_id', 'job_id'], 'integer'],
            [['shippingItem'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'packing_id' => Yii::t('app', 'Packing ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'shippingItem' => Yii::t('app', 'Shipping Item'),
        ];
    }
}
