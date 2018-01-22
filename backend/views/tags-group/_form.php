<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagsGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tags-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
