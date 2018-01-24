<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tags_group_join}}".
 *
 * @property int $id
 * @property int $tags_group_id
 * @property int $tags_id
 */
class TagsGroupJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags_group_join}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags_group_id', 'tags_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tags_group_id' => 'Tags Group ID',
            'tags_id' => 'Tags ID',
        ];
    }

    /**
     * @inheritdoc
     * @return TagsGroupJoinQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsGroupJoinQuery(get_called_class());
    }

    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tags_id']);
    }


}