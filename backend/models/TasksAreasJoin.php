<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tasks_areas_join}}".
 *
 * @property string $id
 * @property int $tasks_id
 * @property int $areas_id
 */
class TasksAreasJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks_areas_join}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tasks_id', 'areas_id'], 'integer'],
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
            'areas_id' => 'Areas ID',
        ];
    }

    /**
     * @inheritdoc
     * @return TasksAreasJoinQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksAreasJoinQuery(get_called_class());
    }
}
