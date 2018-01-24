<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tasks_tags_join}}".
 *
 * @property string $id
 * @property int $tasks_id
 * @property int $tags_id
 */
class TasksTagsJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks_tags_join}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tasks_id', 'tags_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tasks_id' => 'Tasks ID',
            'tags_id' => 'Tags ID',
        ];
    }

    /**
     * @inheritdoc
     * @return TasksTagsJoinQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksTagsJoinQuery(get_called_class());
    }
}
