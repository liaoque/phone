<?php

namespace console\models;
use common\helpers\ArrayHelper;
/**
 * This is the ActiveQuery class for [[TasksTagsJoin]].
 *
 * @see TasksTagsJoin
 */
class TasksTagsJoinQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TasksTagsJoin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TasksTagsJoin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function findTags($taskId){
        $rows = (new \yii\db\Query())
            ->select(['tags_id'])
            ->from(TasksTagsJoin::tableName())
            ->where(['tasks_id' => $taskId])
            ->column();
        if($rows){
            $maxLevel = (new \yii\db\Query())
                ->select(['max(level)'])
                ->from(Tags::tableName())
                ->scalar();
            for($i = 1; $i <$maxLevel+1;$i++){
                $rows = ArrayHelper::merge((new \yii\db\Query())
                    ->select(['id'])
                    ->from(Tags::tableName())
                    ->where([
                        'pid' => $taskId,
                        'level' => $i
                    ])
                    ->column(), $rows);
                $rows=  array_unique($rows);
            }
        }
        return $rows;
    }


}
