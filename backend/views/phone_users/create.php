<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhoneUsers */

$this->title = 'Create Phone Users';
$this->params['breadcrumbs'][] = ['label' => 'Phone Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
