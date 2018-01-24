<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $info 推送内容
 * @property int $agrs 年龄段
 * @property int $sex 性别
 * @property string $send_num 发送数目
 * @property string $send_end_num 已发送条数
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property string $desc 备注
 * @property int $status 状态
 */
class Tasks extends \yii\db\ActiveRecord
{
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
            [['id', 'created_at', 'updated_at'], 'required'],
            [['id', 'agrs', 'sex', 'send_num', 'send_end_num', 'created_at', 'updated_at', 'status'], 'integer'],
            [['info'], 'string'],
            [['title', 'desc'], 'string', 'max' => 255],
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
            'title' => '标题',
            'info' => '推送内容',
            'agrs' => '年龄段',
            'sex' => '性别',
            'send_num' => '发送数目',
            'send_end_num' => '已发送条数',
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
}
