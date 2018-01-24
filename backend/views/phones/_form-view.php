<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Phones */
/* @var $form yii\widgets\ActiveForm */
?>


    <?= $form->field($model, 'area', [
        'options' => [
            'class' => 'form-inline',
        ],
    ])->widget(\chenkby\region\Region::className(), [
        'model' => $model,
        'url' => \yii\helpers\Url::toRoute(['get-region']),
        'province' => [
            'attribute' => 'province',
            'items' => \backend\models\Areas::getRegion(),
            'options' => ['class' => 'form-control form-control-inline', 'prompt' => '选择省份']
        ],
        'city' => [
            'attribute' => 'city',
            'items' => \backend\models\Areas::getRegion($model['province']),
            'options' => ['class' => 'form-control form-control-inline', 'prompt' => '选择城市']
        ],
        'district' => [
            'attribute' => 'area',
            'items' => \backend\models\Areas::getRegion($model['city']),
            'options' => ['class' => 'form-control form-control-inline', 'prompt' => '选择县/区']
        ]
    ])->label('地区');
    ?>


    <?= $form->field($model, 'send_num')->textInput(['maxlength' => true, 'value' => 0]) ?>

    <?= $form->field($model, 'see_num')->textInput(['maxlength' => true, 'value' => 0]) ?>


    <?= $this->render('../tags/view-input', [
        'model' => $model,
        'form' => $form
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Phones::getStatusList()) ?>

    <?= $this->render('../phone-users/_form_input', [
        'form' => $form,
        'model' => $phoneUsersModel
    ]) ?>

