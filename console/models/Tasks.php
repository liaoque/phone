<?php

namespace console\models;

use common\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property string $id
 * @property string $title 标题
 * @property string $info 推送内容
 * @property int $age 年龄段
 * @property int $sex 性别
 * @property string $send_num 发送数目
 * @property string $send_end_num 已发送条数
 * @property int $phone_num 关联手机号码数量
 * @property int $subtag_num 关联下一级子标签数量
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property string $desc 备注
 * @property int $status 状态
 */
class Tasks extends \yii\db\ActiveRecord
{
    const STATUS_NO = -1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info'], 'string'],
            [['age', 'sex', 'send_num', 'send_end_num', 'phone_num', 'subtag_num', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'info' => '推送内容',
            'age' => '年龄段',
            'sex' => '性别',
            'send_num' => '发送数目',
            'send_end_num' => '已发送条数',
            'phone_num' => '关联手机号码数量',
            'subtag_num' => '关联下一级子标签数量',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'desc' => '备注',
            'status' => '状态',
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }


    public function getTasksTagsJoin()
    {
        return $this->hasMany(TasksTagsJoin::className(), ['tasks_id' => 'id']);
    }

    public function getTasksAreasJoin()
    {
        return $this->hasMany(TasksAreasJoin::className(), ['tasks_id' => 'id']);
    }


    public static function run()
    {
        while ($task = Tasks::find()->where([
            'status' => Tasks::STATUS_NO,
        ])->one()) {
            $task->status = 0;
            if ($task->save()) {
                $taskId = $task->id;
                $areasIdList = TasksAreasJoinQuery::findAreas($taskId);
                $tagsIdList = TasksTagsJoinQuery::findTags($taskId);
                $tagsGroupIdsList = TagsGroupJoinQuery::findTagsGroupIds($tagsIdList);
                $count = PhonesQuery::findPhonesCount($areasIdList, $tagsGroupIdsList);
                if ($count) {
                    $count = ceil($count % 2000);
                    $_count = 0;
                    for ($i = 0; $i < $count; $i++) {
                        $phoneIdList = PhonesQuery::findPhones($areasIdList, $tagsGroupIdsList, $i);
                        $age = $task->getAttribute('age');
                        $sex = $task->getAttribute('sex');
                        $phoneIdList = PhoneUsersQuery::findPhoneIdList([
                            'age' => $age,
                            'sex' => $sex,
                            'phone_id' => $phoneIdList,
                        ]);

                        if ($phoneIdList) {
                            $phoneIdList = array_unique($phoneIdList);
                            $phoneIdListCount = count($phoneIdList);
                            $phoneIdList = array_diff($phoneIdList, (new \yii\db\Query())
                                ->select(['phone_id'])
                                ->from(Logs::tableName())
                                ->where([
                                    'phone_id' => $phoneIdList,
                                    'task_id' => $taskId,
                                ])
                                ->column());
                            $list = [];
                            foreach ($phoneIdList as $phoneId) {
                                $list[] = [
                                    $phoneId,
                                    $taskId,
                                    Logs::SEND_NO
                                ];
                            }

                            if ($list && Yii::$app->db->createCommand()->batchInsert(Logs::tableName(), [
                                'phone_id',
                                'task_id',
                                'status'
                            ], $list)->execute()) {
                                $_count += $phoneIdListCount;
                            }
                        }

                        $task->phone_num += $_count;
                        $task->status = 1;
                        $task->subtag_num = count($tagsIdList);
                        $task->save();
                    }
                }
            }
        }
    }


}
