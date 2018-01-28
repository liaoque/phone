<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'info:ntext',
            [
                'attribute' => 'age',
                'format' => function ($age) {
                    return \backend\models\PhoneUsers::getAgeView($age);
                },
            ],
            [
                'attribute' => 'sex',
                'format' => function ($sex) {
                    return \backend\models\PhoneUsers::getSexView($sex);
                },
            ],
            'send_num',
            'send_end_num',
            'phone_num',
            'subtag_num',
            [
                'attribute' => 'created_at',
                'format' => [
                    'datetime',
                    'datetimeFormat' => 'php:Y-m-d H:i:s',
                ]
            ],
            [
                'attribute' => 'updated_at',
                'format' => [
                    'datetime',
                    'datetimeFormat' => 'php:Y-m-d H:i:s',
                ]
            ],
            'desc',
            [
                'attribute' => 'status',
                'format' => function($value){

                }
            ]
        ],
    ]) ?>

</div>
