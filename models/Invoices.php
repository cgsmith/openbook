<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string $dateIssued
 * @property integer $terms
 * @property string $billedAmount
 * @property string $status
 * @property string $emailed
 * @property string $viewed
 * @property string $dateUpdated
 * @property string $invoiceNote
 */
class Invoices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'dateIssued', 'terms', 'billedAmount', 'status', 'dateUpdated', 'invoiceNote'], 'required'],
            [['job_id', 'terms'], 'integer'],
            [['dateIssued', 'emailed', 'viewed', 'dateUpdated'], 'safe'],
            [['billedAmount'], 'number'],
            [['status'], 'string', 'max' => 16],
            [['invoiceNote'], 'string', 'max' => 64],
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
            'dateIssued' => Yii::t('app', 'Date Issued'),
            'terms' => Yii::t('app', 'Terms'),
            'billedAmount' => Yii::t('app', 'Billed Amount'),
            'status' => Yii::t('app', 'Status'),
            'emailed' => Yii::t('app', 'Emailed'),
            'viewed' => Yii::t('app', 'Viewed'),
            'dateUpdated' => Yii::t('app', 'Date Updated'),
            'invoiceNote' => Yii::t('app', 'Invoice Note'),
        ];
    }
}
