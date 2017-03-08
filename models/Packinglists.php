<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packinglists".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string $dateShipped
 * @property string $shipVia
 * @property integer $complete
 * @property string $shipTo
 * @property string $contact
 */
class Packinglists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packinglists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'dateShipped', 'complete'], 'required'],
            [['job_id', 'complete'], 'integer'],
            [['dateShipped'], 'safe'],
            [['shipVia'], 'string', 'max' => 16],
            [['shipTo', 'contact'], 'string', 'max' => 64],
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
            'dateShipped' => Yii::t('app', 'Date Shipped'),
            'shipVia' => Yii::t('app', 'Ship Via'),
            'complete' => Yii::t('app', 'Complete'),
            'shipTo' => Yii::t('app', 'Ship To'),
            'contact' => Yii::t('app', 'Contact'),
        ];
    }
}
