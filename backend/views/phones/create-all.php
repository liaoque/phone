<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Phones */

$this->title = 'CreateAll Phones';
$this->params['breadcrumbs'][] = ['label' => 'Phones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'phoneFile')->fileInput()->label('手机号文件, 一行一个手机号'); ?>



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

    <?= $form->field($model, 'tags')->hiddenInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Areas::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
