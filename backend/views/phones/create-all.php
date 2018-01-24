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

    <?= $this->render('_form-view', [
        'model' => $model,
        'form' => $form,
        'phoneUsersModel' => $phoneUsersModel,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($model, 'phone')->hiddenInput(['value' => 0])->label(''); ?>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
