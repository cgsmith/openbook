<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Customers]].
 *
 * @see Customers
 */
class CustomersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Customers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Customers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
