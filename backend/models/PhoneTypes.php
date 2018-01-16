<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%phone_types}}".
 *
 * @property string $id
 * @property int $type 1. 安卓, 2.ios
 * @property string $info
 * @property string $sign
 */
class PhoneTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%phone_types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['info'], 'string', 'max' => 255],
            [['sign'], 'string', 'max' => 32],
            [['sign'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '1. 安卓, 2.ios',
            'info' => 'Info',
            'sign' => 'Sign',
        ];
    }

    /**
     * @inheritdoc
     * @return PhoneTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhoneTypesQuery(get_called_class());
    }
}
