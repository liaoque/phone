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

    <?= $this->render('_form_input', [
        'form' => $form,
        'model' => $model
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
