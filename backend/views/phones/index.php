<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhonesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建手机号', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量创建手机号', ['create-all'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => [
                    'class' => 'list-sm'
                ]
            ],
            'phone',
            [
                'attribute' =>  'province',
                'format' => function($value){
                    $result = \backend\models\Areas::getLevelList(0);
                    return $result[$value];
                },
                'filter' => backend\models\Areas::getLevelList(0)
            ],
            [
                'attribute' =>  'city',
                'format' => function($value){
                    $result = \backend\models\Areas::getLevelList(1);
                    return $result[$value];
                },
                'options' => [
                    'class' => 'list-sm2'
                ],
                'filter' => backend\models\Areas::getLevelList(1)
            ],
            [
                'attribute' =>  'area',
                'format' => function($value){
                    $result = \backend\models\Areas::getLevelList(2);
                    return $result[$value];
                },
                'options' => [
                    'class' => 'list-sm2'
                ],
                'filter' => backend\models\Areas::getLevelList(2),
            ],
            [
                'attribute' => 'send_num',
                'options' => [
                    'class' => 'list-sm'
                ]
            ],
            [
                'attribute' => 'see_num',
                'options' => [
                    'class' => 'list-sm'
                ]
            ],
            [
                'attribute' => 'created_at',
                'label' => '创建时间',
                'format' => [
                    'datetime',
                    'datetimeFormat' => 'Y-m-d H:i:s',
                ]
            ],
            [
                'attribute' => 'updated_at',
                'label' => '保存时间',
                'format' => [
                    'datetime',
                    'datetimeFormat' => 'Y-m-d H:i:s',
                ]
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<style>
    .list-sm {
        width: 80px;
    }
    .list-sm2 {
        width: 160px;
    }
</style>
