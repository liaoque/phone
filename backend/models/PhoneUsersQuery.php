<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PhoneUsers]].
 *
 * @see PhoneUsers
 */
class PhoneUsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PhoneUsers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PhoneUsers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
