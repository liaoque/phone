<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TagsInfo]].
 *
 * @see TagsInfo
 */
class TagsInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagsInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagsInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
