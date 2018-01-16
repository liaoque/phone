<?php

namespace backend\models;

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
 * @property int $status 1.查阅， 2，未查阅
 */
class Logs extends \yii\db\ActiveRecord
{
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
            [['id'], 'required'],
            [['id', 'phone_id', 'task_id', 'status'], 'integer'],
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
            'status' => '1.查阅， 2，未查阅',
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
}
