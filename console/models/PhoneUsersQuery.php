<?php

namespace console\models;

/**
 * This is the ActiveQuery class for [[PhoneUsers]].
 *
 * @see PhoneUsers
 */
class PhoneUsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PhoneUsers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PhoneUsers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function search($con = []){
        $query = (new \yii\db\Query());
        $query->filterWhere([
            'phone_id' => $con['phone_id']
        ]);
        if($con['age']){
            $query->andWhere(['&' , 'age', $con['age']]);
        }
        if($con['sex']){
            $query->andWhere(['&' , 'sex', $con['sex']]);
        }
        return $query;
    }

    public static function findPhoneIdList($con = []){
        $f = true;
        foreach ($con as $value){
            if(!empty($value)){
                $f = false;
                break;
            }
        }
        if($f){
            return [];
        }


        return self::search($con)->select(['phone_id'])
            ->from(PhoneUsers::tableName())
            ->orderBy(['phone_id' => SORT_DESC])
            ->column();
    }


}
