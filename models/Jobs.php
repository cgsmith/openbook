<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property integer $id
 * @property integer $quote_id
 * @property integer $quote_rev
 * @property string $customer_shopnumber
 * @property string $shopNumber
 * @property string $dateReceived
 * @property string $dateDue
 * @property integer $timeMaterial
 * @property string $status
 * @property string $PONumber
 * @property string $patternShrink
 * @property string $finishStock
 * @property string $description
 * @property string $notes
 * @property string $devonsnotes
 * @property string $color
 *
 * @property Timecards[] $timecards
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quote_id', 'quote_rev', 'shopNumber', 'dateReceived', 'status', 'devonsnotes'], 'required'],
            [['quote_id', 'quote_rev', 'timeMaterial'], 'integer'],
            [['dateReceived', 'dateDue'], 'safe'],
            [['description', 'notes', 'devonsnotes'], 'string'],
            [['customer_shopnumber', 'status'], 'string', 'max' => 16],
            [['shopNumber'], 'string', 'max' => 4],
            [['PONumber'], 'string', 'max' => 64],
            [['patternShrink', 'finishStock'], 'string', 'max' => 32],
            [['color'], 'string', 'max' => 24],
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
            'quote_rev' => Yii::t('app', 'Quote Rev'),
            'customer_shopnumber' => Yii::t('app', 'Customer Shopnumber'),
            'shopNumber' => Yii::t('app', 'Shop Number'),
            'dateReceived' => Yii::t('app', 'Date Received'),
            'dateDue' => Yii::t('app', 'Date Due'),
            'timeMaterial' => Yii::t('app', 'Time Material'),
            'status' => Yii::t('app', 'Status'),
            'PONumber' => Yii::t('app', 'Ponumber'),
            'patternShrink' => Yii::t('app', 'Pattern Shrink'),
            'finishStock' => Yii::t('app', 'Finish Stock'),
            'description' => Yii::t('app', 'Description'),
            'notes' => Yii::t('app', 'Notes'),
            'devonsnotes' => Yii::t('app', 'Devonsnotes'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimecards()
    {
        return $this->hasMany(Timecards::className(), ['job_id' => 'id']);
    }
}
