<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 11:08
 */

namespace common\helpers;


class ArrayHelper extends \yii\helpers\ArrayHelper
{

    public static function andEachKey(Array $list)
    {
        $first = false;
        if (!empty($list)) {
            $first = intval(array_pop($list));
            foreach ($list as $value) {
                $first = $first & intval($value);
            }
        }
        return $first;
    }

    public static function orEachKey(Array $list)
    {
        $first = false;
        if (!empty($list)) {
            $first = intval(array_pop($list));
            foreach ($list as $value) {
                $first = $first | intval($value);
            }
        }
        return $first;
    }

    /**
     * 检查数据包含数据中的哪些值
     * @param $first
     * @param array $list
     * @return array
     */
    public static function orEachKeyArray($first, Array $list)
    {
        $_list = [];
        $first = intval($first);
        foreach ($list as $key => $value) {
            if ($first & intval($key)) {
                $_list[$key] = $value;
            }
        }
        return $_list;
    }

}