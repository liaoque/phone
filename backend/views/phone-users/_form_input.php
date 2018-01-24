<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneUsers */
/* @var $form yii\widgets\ActiveForm */
?>


    <?= $form->field($model, 'sex')->dropDownList(\backend\models\PhoneUsers::getSexList())->label('性别') ?>

    <?= $form->field($model, 'age')->dropDownList(\backend\models\PhoneUsers::getAgeList())->label('年龄段')  ?>

    <?= $form->field($model, 'phone_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\yii\helpers\ArrayHelper::toArray(\backend\models\PhoneTypes::find()->all()), 'id', 'info'))->label('手机型号') ?>
