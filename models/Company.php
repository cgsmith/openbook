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
 * @property string $payroll_emails
 * @property string $vacation_reminder_emails
 * @property string $smtp_user
 * @property string $smtp_password
 * @property string $smtp_from
 * @property string $smtp_bcc
 * @property string $smtp_port
 * @property string $smtp_server
 * @property integer $smtp_testing
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
            [['id', 'margin', 'payrollsetting', 'smtp_testing'], 'integer'],
            [['shoprate'], 'number'],
            [['nextpayroll'], 'safe'],
            [['address', 'citystzip'], 'string', 'max' => 128],
            [['phone', 'fax'], 'string', 'max' => 16],
            [['payroll_emails', 'vacation_reminder_emails', 'smtp_user', 'smtp_password', 'smtp_from', 'smtp_bcc', 'smtp_port', 'smtp_server'], 'string', 'max' => 255],
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
            'payroll_emails' => Yii::t('app', 'Payroll Emails'),
            'vacation_reminder_emails' => Yii::t('app', 'Vacation Reminder Emails'),
            'smtp_user' => Yii::t('app', 'Smtp User'),
            'smtp_password' => Yii::t('app', 'Smtp Password'),
            'smtp_from' => Yii::t('app', 'Smtp From'),
            'smtp_bcc' => Yii::t('app', 'Smtp Bcc'),
            'smtp_port' => Yii::t('app', 'Smtp Port'),
            'smtp_server' => Yii::t('app', 'Smtp Server'),
            'smtp_testing' => Yii::t('app', 'Smtp Testing'),
        ];
    }
}
