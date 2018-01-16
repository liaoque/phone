<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneTypes */

$this->title = 'Update Phone Types: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Phone Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phone-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
