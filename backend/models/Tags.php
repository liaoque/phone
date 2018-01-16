<?php

namespace backend\models;

use Codeception\Step\Condition;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property int $id
 * @property string $name
 * @property int $pid
 * @property string $path
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid'], 'integer'],
            [['name', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pid' => 'Pid',
            'path' => 'Path',
        ];
    }


    public static function getTreeTags($model)
    {
        $id = $model->getAttribute('id');
        if ($id === null) {
            $result = self::find()->all();
        } else {
            $result = self::find()->where(['!=', 'id', $id])->all();
        }
        return $result;
    }

    /**
     * @inheritdoc
     * @return TagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsQuery(get_called_class());
    }
}
