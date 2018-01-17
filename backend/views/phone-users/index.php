<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhoneUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phone Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Phone Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'phone_id',
                'label' => '手机号',
                'format' => function ($value) {
                    $result = \backend\models\Phones::find()->where($value)->one();
                    return $result ?  $result->getAttribute('phone') :'';
                },
            ],

            [
                'attribute' => 'sex',
                'label' => '性别',
                'format' => function ($value) {
                    return \backend\models\PhoneUsers::getSexList()[$value];
                },
                'filter' => backend\models\PhoneUsers::getSexList(2),
            ],

            [
                'attribute' => 'age',
                'label' => '年龄段',
                'format' => function ($value) {
                    return \backend\models\PhoneUsers::getAgeList()[$value];
                },
                'filter' => backend\models\PhoneUsers::getAgeList(2),
            ],

//            [
//                'attribute' => 'phone_type_id',
//                'label' => '手机号',
//                'format' => function ($value) {
//                    $result = \backend\models\PhoneUsers::find()->where($value)->one();
//                    return $result->getAttribute('phone');
//                },
//            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
