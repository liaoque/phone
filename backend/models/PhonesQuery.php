<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Phones]].
 *
 * @see Phones
 */
class PhonesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Phones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Phones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
