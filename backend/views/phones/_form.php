<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Phones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'areas', [
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
    <?= $form->field($model, 'tags_group_id')->hiddenInput(['value' => 0]) ?>


    <?= $this->render('../tags/view-input', [
        'model' => $model,
        'form' => $form,
        'tags' => $tags
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Areas::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
