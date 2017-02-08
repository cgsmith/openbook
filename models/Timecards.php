<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timecards".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $job_id
 * @property string $dateWorked
 * @property string $hours
 * @property string $description
 * @property string $comments
 *
 * @property Employees $employee
 * @property Jobs $job
 */
class Timecards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timecards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'job_id', 'dateWorked', 'hours'], 'required'],
            [['employee_id', 'job_id'], 'integer'],
            [['dateWorked'], 'date', 'format' => 'yyyy-MM-dd'],
            [['hours'], 'number'],
            [['description', 'comments'], 'string'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'dateWorked' => Yii::t('app', 'Date Worked'),
            'hours' => Yii::t('app', 'Hours'),
            'description' => Yii::t('app', 'Description'),
            'comments' => Yii::t('app', 'Comments'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::className(), ['id' => 'job_id']);
    }
}
