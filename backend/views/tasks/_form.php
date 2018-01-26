<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'age')->checkboxList(\yii\helpers\ArrayHelper::merge([0 => '全部'],\backend\models\PhoneUsers::getAgeList()), [
        'itemOptions' => [
            'class' => 'tasks-age'
        ]
    ]) ?>

    <?= $form->field($model, 'sex')->checkboxList(\yii\helpers\ArrayHelper::merge([0 => '全部'], \backend\models\PhoneUsers::getSexList()), [
        'itemOptions' => [
            'class' => 'tasks-sex'
        ]
    ]) ?>


    <?= $this->render('../tags/view-input', [
        'model' => $model,
        'form' => $form
    ]) ?>

    <?= $this->render('../areas/view-input', [
        'model' => $model,
        'form' => $form
    ]) ?>


    <?= $form->field($model, 'send_num')->textInput(['maxlength' => true, 'value' => 0]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
