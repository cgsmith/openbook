<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Instructions]].
 *
 * @see Instructions
 */
class InstructionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Instructions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Instructions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
