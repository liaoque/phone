<?php

namespace console\models;

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

    public static function findPhonesCount($areasIdList, $tagsGroupIdsList){
        $where = self::search($areasIdList, $tagsGroupIdsList);
        if(!$where){
            return 0;
        }
       return (new \yii\db\Query())
            ->select(['id'])
            ->from(Phones::tableName())
            ->where($where)
           ->count();;
    }

    public static function search($areasIdList, $tagsGroupIdsList){
        $where = [];
        if(empty($areasIdList) && empty($tagsGroupIdsList)){
            return $where;
        }

        if($areasIdList){
            $where[ 'area'] = array_unique($areasIdList);
        }
        if($tagsGroupIdsList){
            $where['tags_group_id'] = array_unique($tagsGroupIdsList);
        }
        return $where;
    }


    public static function findPhones($areasIdList, $tagsGroupIdsList, $page){

        $where = self::search($areasIdList, $tagsGroupIdsList);
        if(!$where){
            return [];
        }
        return $rows = (new \yii\db\Query())
            ->select(['id'])
            ->from(Phones::tableName())
            ->where($where)
            ->orderBy(['id' => SORT_DESC])
            ->limit($page)
            ->offset(2000)
            ->column();
    }


}
