<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhoneTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phone Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Phone Types', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => [
            'class' => 'asdasdas'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],

            [
                'attribute' => 'id'
            ],

            [
                'attribute' => 'type',
                'format' => function ($value) {
                    $result = \backend\models\PhoneTypes::getTypeList();
                    return $result[$value];
                },
                'filter' => \backend\models\PhoneTypes::getTypeList()
            ],

            'info',

            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<style>
    .asdasdas th:nth-child(2){
        width: 100px;
    }
</style>