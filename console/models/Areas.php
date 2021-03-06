<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "{{%areas}}".
 *
 * @property string $id 地区码
 * @property string $name 地区名字
 * @property string $pid 父地区码
 * @property int $level 等级
 * @property int $status 1.正常，-1禁止 
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%areas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'level', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '地区码',
            'name' => '地区名字',
            'pid' => '父地区码',
            'level' => '等级',
            'status' => '1.正常，-1禁止 ',
        ];
    }

    /**
     * @inheritdoc
     * @return AreasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreasQuery(get_called_class());
    }
}
