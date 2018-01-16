<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhoneTypes */

$this->title = 'Create Phone Types';
$this->params['breadcrumbs'][] = ['label' => 'Phone Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
