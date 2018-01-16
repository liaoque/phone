<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property int $id
 * @property string $title
 * @property string $info
 * @property string $tags
 * @property string $areas
 * @property string $agrs
 * @property int $num
 * @property string $keywords
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'num'], 'integer'],
            [['info'], 'string'],
            [['title', 'tags', 'areas', 'agrs', 'keywords'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'info' => 'Info',
            'tags' => 'Tags',
            'areas' => 'Areas',
            'agrs' => 'Agrs',
            'num' => 'Num',
            'keywords' => 'Keywords',
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }
}
