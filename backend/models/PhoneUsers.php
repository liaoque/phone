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

    public static function getSexList()
    {
        return [
            '未知', '男', '女'
        ];
    }

    public static function getAgeList()
    {
        return [
            '全部', '18以下', '19-23', '24-27', '28-35', '36-45', '45-55', '56-66', '66以上'
        ];
    }

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
            [['phone_num'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone_id' => '手机号',
            'sex' => '性别',
            'age' => '年龄段',
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

    public function getPhone()
    {
        return $this->hasOne(Phones::className(), ['id' => 'phone_id']);
    }

    public function getPhone_num()
    {
        return $this->phone ? $this->phone->phone : '';
    }


    public function setPhone_num($value)
    {
        $phone = Phones::find()->where(['phone' => $value])->one();
        if (!empty($phone)) {
            $this->phone_id = $phone->getAttribute('id');
        }
    }


//    public function load($data, $formName = null)
//    {
//        return parent::load($data, $formName);
//    }


}
