<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PhoneTypes]].
 *
 * @see PhoneTypes
 */
class PhoneTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PhoneTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PhoneTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
