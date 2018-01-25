<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property string $id
 * @property string $title 标题
 * @property string $info 推送内容
 * @property int $agrs 年龄段
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
    private $areas;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks}}';
    }

    public function getAreas()
    {
        return $this->areas;
    }

    public function setAreas($areas)
    {
        return $this->areas = $areas;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info'], 'string'],
            [['title', 'info', 'age', 'sex', 'send_num'], 'required'],
            [['age', 'sex', 'send_num', 'send_end_num', 'phone_num', 'subtag_num', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'desc'], 'string', 'max' => 255],
        ];
    }

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
}
