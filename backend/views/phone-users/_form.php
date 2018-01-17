<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phone-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phone_num')->textInput(['maxlength' => true])->label('手机号') ?>

    <?= $form->field($model, 'sex')->dropDownList(\backend\models\PhoneUsers::getSexList())->label('性别') ?>

    <?= $form->field($model, 'age')->dropDownList(\backend\models\PhoneUsers::getAgeList())->label('年龄段')  ?>

    <?= $form->field($model, 'phone_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\yii\helpers\ArrayHelper::toArray(\backend\models\PhoneTypes::find()->all()), 'id', 'info'))->label('手机型号') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
