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

    public static function createPath($id = 0)
    {
        $str = $id;
        if (!$str) {
            return $str;
        }
        $result = self::find()->where(['id' => $id])->one();
        $str =self::createPath($result->getAttribute('pid')). '_' . $str;
        return $str;
    }

    public static function parsePath($path, Tags $model = null)
    {
        static $list = [];
        if(empty($list)){
            $list = ArrayHelper::map(ArrayHelper::toArray(self::getTreeTags(new self())), 'id', 'name');
        }

        $pathList =explode('_', $path);
//        var_dump($list, $pathList);exit();
        $path = [];
        foreach ($pathList as $value){
            if(!$value){
                continue;
            }
            $path[] =  $list[$value] ;
        }
        if($model){
            $path[] = $model->getAttribute('name');
        }
        return implode('_', $path);
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        $pid = $this->getAttribute('pid');
        $path = self::createPath($pid);
        $this->setAttribute('path', $path);
        $result =  parent::save();
        if($result){
            $pidList = explode('_', $path);
            foreach ($pidList as $pid){
                if($pid){
                    $c = self::find()->where([ 'pid' => $pid ])->count();
                    if($c){
                        $tag = TagsInfo::find()->where(['id' => $pid])->one();
                        if(empty($tag)){
                            $tag = new TagsInfo();
                            $tag->id = $this->pid;
                        }
                        $tag->subtag_num = $c;
                        $tag->save();
                    }
                }
            }

        }
        return $result;
    }


}
