<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "instructions".
 *
 * @property integer $id
 * @property string $instruction
 * @property string $hours
 * @property string $material
 * @property integer $cust_id
 * @property string $order
 * @property string $color
 */
class Instructions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instructions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['instruction', 'cust_id', 'order'], 'required'],
            [['hours', 'material', 'order'], 'number'],
            [['cust_id'], 'integer'],
            [['instruction'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'instruction' => Yii::t('app', 'Instruction'),
            'hours' => Yii::t('app', 'Hours'),
            'material' => Yii::t('app', 'Material'),
            'cust_id' => Yii::t('app', 'Cust ID'),
            'order' => Yii::t('app', 'Order'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * @inheritdoc
     * @return InstructionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstructionsQuery(get_called_class());
    }
}
