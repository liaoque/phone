<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Phones */

$this->title = '创建成功';
$this->params['breadcrumbs'][] = ['label' => 'Phones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phones-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <?php foreach($dataProvider as $value){ ?>
        <div class="col-sm-6 col-md-4">  <?= $value['phone'] ?></div>
        <?php } ?>
    </div>


</div>
