<?php

namespace console\models;

use common\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "{{%logs}}".
 *
 * @property int $id
 * @property int $phone_id
 * @property int $task_id
 * @property string $send_time
 * @property string $see_time
 * @property string $url
 * @property int $status 1.查阅， -1.未查阅
 * @property int $created_at
 * @property int $updated_at
 */
class Logs extends \yii\db\ActiveRecord
{
    const SEND_NO = -1;
    const SEND_END = 1;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    # 创建之前
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    # 修改之前
                    self::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                #设置默认值
                'value' => time()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'required'],
            [['id', 'phone_id', 'task_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['send_time', 'see_time'], 'safe'],
            [['url'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone_id' => 'Phone ID',
            'task_id' => 'Task ID',
            'send_time' => 'Send Time',
            'see_time' => 'See Time',
            'url' => 'Url',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return LogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogsQuery(get_called_class());
    }

    public static function run()
    {
        $query = (new \yii\db\Query());
        $result = $query->where(['status' => Logs::SEND_NO])
            ->select('id, phone_id, task_id')
            ->from(Logs::tableName())
            ->orderBy(['id' => SORT_DESC])
            ->all();
        if ($result) {
            $ids = ArrayHelper::getColumn($result, 'id');
            if (self::updateAll([
                'status' => WORKING
            ], [
                'id' => $ids
            ])) {

                $phoneList = ArrayHelper::map($query
                    ->where(['id' => ArrayHelper::getColumn($result, 'phone_id')])
                    ->from(Phones::tableName())
                    ->select('id, phone')
                    ->column(), 'id', 'phone');
                $taskList = ArrayHelper::index($query
                    ->where(['id' => ArrayHelper::getColumn($result, 'task_id')])
                    ->from(Tasks::tableName())
                    ->select('id, title, info')
                    ->column(), 'id');

                $taskSendEndList = $errorList = $successList = [];
                foreach ($result as $value) {
                    $phoneId = $value['phone_id'];
                    $id = $value['id'];
                    $taskId = $value['task_id'];

                    //发送短信
                    $phone = $phoneList[$phoneId];
                    $taskInfo = $taskList[$taskId];

                    if (1) {
                        $successList[] = $ids;
                        if (empty($taskSendEndList[$taskId])) {
                            $taskSendEndList[$taskId] = 0;
                        }
                        $taskSendEndList[$taskId]++;
                    } else {
                        $errorList[] = $id;
                    }
                }

                foreach ($taskSendEndList as $taskId => $sendNum) {
                    Tasks::updateAllCounters([
                        'send_end_num' => $sendNum
                    ], [
                        'task_id' => $taskId
                    ]);
                }

                self::updateAll([
                    'status' => Logs::SEND_NO,

                ], [
                    'id' => $errorList
                ]);

                self::updateAll([
                    'status' => Logs::SEND_END,
                    'send_time' => date('Y-m-d H:i:s'),
                    'url' => 111,
                ], [
                    'id' => $successList
                ]);
            }
        }

    }

}
