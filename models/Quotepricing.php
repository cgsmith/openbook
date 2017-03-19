<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotepricing".
 *
 * @property integer $id
 * @property integer $quote_id
 * @property string $viewed
 * @property string $emailed
 * @property string $estimatedDelivery
 * @property string $totalPrice
 * @property string $totalHours
 * @property string $totalMaterial
 * @property integer $margin
 * @property string $shopRate
 * @property string $patternOwner
 * @property string $patternNumber
 * @property string $dateIssued
 * @property integer $revision
 * @property integer $job_id
 * @property string $category
 * @property string $quotedby
 */
class Quotepricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotepricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quote_id', 'totalPrice', 'totalHours', 'totalMaterial', 'margin', 'shopRate', 'patternOwner', 'patternNumber', 'dateIssued', 'quotedby'], 'required'],
            [['quote_id', 'margin', 'revision', 'job_id'], 'integer'],
            [['viewed', 'emailed', 'dateIssued'], 'safe'],
            [['totalPrice', 'totalHours', 'totalMaterial', 'shopRate'], 'number'],
            [['estimatedDelivery', 'patternOwner', 'patternNumber', 'category', 'quotedby'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'quote_id' => Yii::t('app', 'Quote ID'),
            'viewed' => Yii::t('app', 'Viewed'),
            'emailed' => Yii::t('app', 'Emailed'),
            'estimatedDelivery' => Yii::t('app', 'Estimated Delivery'),
            'totalPrice' => Yii::t('app', 'Total Price'),
            'totalHours' => Yii::t('app', 'Total Hours'),
            'totalMaterial' => Yii::t('app', 'Total Material'),
            'margin' => Yii::t('app', 'Margin'),
            'shopRate' => Yii::t('app', 'Shop Rate'),
            'patternOwner' => Yii::t('app', 'Pattern Owner'),
            'patternNumber' => Yii::t('app', 'Pattern Number'),
            'dateIssued' => Yii::t('app', 'Date Issued'),
            'revision' => Yii::t('app', 'Revision'),
            'job_id' => Yii::t('app', 'Job ID'),
            'category' => Yii::t('app', 'Category'),
            'quotedby' => Yii::t('app', 'Quotedby'),
        ];
    }
}
