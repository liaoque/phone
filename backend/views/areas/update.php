<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Areas */

$this->title = 'Update Areas: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="areas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
