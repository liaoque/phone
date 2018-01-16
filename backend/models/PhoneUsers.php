<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%phone_users}}".
 *
 * @property string $id
 * @property string $phone_id 手机号id
 * @property int $sex 0未知， 1男， 2女
 * @property int $age 0.全部,1.18以下,2.19-23,3.24-27,4.28-35,5.36-45,6.45-55,7.56-66,8.66以上
 * @property int $phone_type_id 关联手机phone_type表
 */
class PhoneUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%phone_users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone_id', 'sex', 'age', 'phone_type_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone_id' => '手机号id',
            'sex' => '0未知， 1男， 2女',
            'age' => '0.全部,1.18以下,2.19-23,3.24-27,4.28-35,5.36-45,6.45-55,7.56-66,8.66以上',
            'phone_type_id' => '关联手机phone_type表',
        ];
    }

    /**
     * @inheritdoc
     * @return PhoneUsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhoneUsersQuery(get_called_class());
    }
}
