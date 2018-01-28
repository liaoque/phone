<?php

namespace console\models;
use common\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[TasksAreasJoin]].
 *
 * @see TasksAreasJoin
 */
class TasksAreasJoinQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TasksAreasJoin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TasksAreasJoin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function findAreas($taskId){
        $rows = (new \yii\db\Query())
            ->select(['areas_id'])
            ->from(TasksAreasJoin::tableName())
            ->where(['tasks_id' => $taskId])
            ->column();
        if($rows){
            $maxLevel = (new \yii\db\Query())
                ->select(['max(level)'])
                ->from(Areas::tableName())
                ->scalar();
            for($i = 1; $i <$maxLevel+1;$i++){
                $rows = ArrayHelper::merge((new \yii\db\Query())
                    ->select(['id'])
                    ->from(Areas::tableName())
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
