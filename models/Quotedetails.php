<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotedetails".
 *
 * @property integer $id
 * @property integer $quote_id
 * @property string $instruction
 * @property integer $hours
 * @property string $material
 * @property string $comments
 * @property string $lineItemOrder
 * @property integer $revision
 */
class Quotedetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotedetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quote_id', 'revision'], 'required'],
            [['quote_id', 'hours', 'revision'], 'integer'],
            [['material', 'lineItemOrder'], 'number'],
            [['comments'], 'string'],
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
            'quote_id' => Yii::t('app', 'Quote ID'),
            'instruction' => Yii::t('app', 'Instruction'),
            'hours' => Yii::t('app', 'Hours'),
            'material' => Yii::t('app', 'Material'),
            'comments' => Yii::t('app', 'Comments'),
            'lineItemOrder' => Yii::t('app', 'Line Item Order'),
            'revision' => Yii::t('app', 'Revision'),
        ];
    }
}
