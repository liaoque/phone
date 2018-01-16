<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tags_info}}".
 *
 * @property string $id
 * @property string $subtag_num 关联下一级子标签数量
 * @property string $phon_num 关联手机号码数量
 */
class TagsInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subtag_num', 'phon_num'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subtag_num' => '关联下一级子标签数量',
            'phon_num' => '关联手机号码数量',
        ];
    }

    /**
     * @inheritdoc
     * @return TagsInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsInfoQuery(get_called_class());
    }
}
