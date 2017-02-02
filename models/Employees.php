<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $user
 * @property string $password
 * @property string $startDate
 * @property integer $vacation
 * @property string $remaining
 * @property integer $active
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'name', 'user', 'password', 'startDate', 'active'], 'required'],
            [['group_id', 'vacation', 'active'], 'integer'],
            [['startDate'], 'safe'],
            [['remaining'], 'number'],
            [['name', 'user'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'name' => Yii::t('app', 'Name'),
            'user' => Yii::t('app', 'User'),
            'password' => Yii::t('app', 'Password'),
            'startDate' => Yii::t('app', 'Start Date'),
            'vacation' => Yii::t('app', 'Vacation'),
            'remaining' => Yii::t('app', 'Remaining'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
