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

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <ul class="list-group">
                    <li class="list-group-item active">  <h3><?= Html::encode("新增手机号") ?></h3></li>
                    <?php foreach($dataProvider['insert'] as $value){ ?>
                        <li class="list-group-item list-group-item-success"><?= $value ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-sm-6 col-md-6">
                <ul class="list-group">
                    <li class="list-group-item active">  <h3><?= Html::encode("更新手机号") ?></h3></li>

                    <?php foreach($dataProvider['update'] as $value){ ?>
                        <li class="list-group-item list-group-item-success"><?= $value ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

</div>
