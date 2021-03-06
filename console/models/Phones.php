<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "{{%phones}}".
 *
 * @property string $id
 * @property string $phone 手机号
 * @property string $province 省
 * @property string $city 市
 * @property string $area 区
 * @property string $send_num 推送数
 * @property string $see_num 查阅数
 * @property int $tags_group_id
 * @property int $status 1，成功 -1 删除
 * @property int $created_at
 * @property int $updated_at
 */
class Phones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%phones}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_num', 'see_num', 'tags_group_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['phone'], 'string', 'max' => 11],
            [['province', 'city', 'area'], 'string', 'max' => 10],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => '手机号',
            'province' => '省',
            'city' => '市',
            'area' => '区',
            'send_num' => '推送数',
            'see_num' => '查阅数',
            'tags_group_id' => 'Tags Group ID',
            'status' => '1，成功 -1 删除',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return PhonesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhonesQuery(get_called_class());
    }
}
