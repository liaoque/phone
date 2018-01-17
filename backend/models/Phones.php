<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%phones}}".
 *
 * @property string $id
 * @property string $phone 手机号
 * @property string $province 省
 * @property string $city 市
 * @property string $area 区
 * @property string $send_num 推送数
 * @property string $see_num 查阅数
 * @property string $tags
 * @property int $status 1，成功 -1 删除
 */
class Phones extends \yii\db\ActiveRecord
{

    private $phoneFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%phones}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_num', 'see_num', 'status'], 'integer'],
            [['tags'], 'string'],
            [['phone'], 'string', 'max' => 11],
            [['province', 'city', 'area'], 'string', 'max' => 10],
            [['phone'], 'unique'],
            [['phoneFile'], 'file', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => '手机号',
            'province' => '省',
            'city' => '市',
            'area' => '区',
            'send_num' => '推送数',
            'see_num' => '查阅数',
            'tags' => 'Tags',
            'status' => '1，成功 -1 删除',
        ];
    }

    /**
     * @inheritdoc
     * @return PhonesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhonesQuery(get_called_class());
    }

    public function getPhoneFile()
    {
        return $this->phoneFile;
    }

    public function setPhoneFile($value)
    {
        $this->phoneFile = $value;
        return $this;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->phoneFile->saveAs('uploads/' . $this->phoneFile->baseName . '.' . $this->phoneFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public static function createMorePhone(Phones $model)
    {
        $list = [];
        $file = Yii::$app->getBasePath() . '/web/uploads/' . $model->phoneFile->name;
        if (file_exists($file)) {
            $result = file_get_contents($file);
            $result = explode("\n", $result);

            foreach ($result as $value) {
                if (preg_match('/1\d{10}/', $value)) {
                    $list[] = [
                        'phone' => $value,
                        'province' => $model->getAttribute('province'),
                        'city' => $model->getAttribute('city'),
                        'area' => $model->getAttribute('area'),
                        'send_num' => $model->getAttribute('send_num'),
                        'see_num' => $model->getAttribute('see_num'),
                        'tags' => $model->getAttribute('tags'),
                    ];
                }
            }
            @unlink($file);
            if (!empty($list)) {
                !Yii::$app->db->createCommand()->batchInsert(self::tableName(), [
                    'phone',
                    'province',
                    'city',
                    'area',
                    'send_num',
                    'see_num',
                    'tags',
                ], $list)->execute();
            }

        }

        return $list;


    }


}
