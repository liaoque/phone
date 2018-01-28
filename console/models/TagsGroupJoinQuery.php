<?php

namespace console\models;

/**
 * This is the ActiveQuery class for [[TagsGroupJoin]].
 *
 * @see TagsGroupJoin
 */
class TagsGroupJoinQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagsGroupJoin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagsGroupJoin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function findTagsGroupIds($tagsIdList){
        if(empty($tagsIdList)){
            return [];
        }
        return $rows = (new \yii\db\Query())
            ->select(['tags_group_id'])
            ->from(TagsGroupJoin::tableName())
            ->where(['tags_id' => $tagsIdList])
            ->column();
    }

}
