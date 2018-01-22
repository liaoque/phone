<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tags_group}}".
 *
 * @property string $id
 * @property string $sign 签名
 * @property string $tags
 */
class TagsGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags'], 'string'],
            [['sign'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sign' => '签名',
            'tags' => 'Tags',
        ];
    }

    /**
     * @inheritdoc
     * @return TagsGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsGroupQuery(get_called_class());
    }
}
