<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'info:ntext',
            [
                'attribute' => 'age',
                'format' => function($value){
                    return \backend\models\PhoneUsers::getAgeView($value);
                },
                'filter' => backend\models\PhoneUsers::getAgeList()
            ],
            [
                'attribute' => 'sex',
                'format' => function($sex){
                    return \backend\models\PhoneUsers::getSexView($sex);
                },
                'filter' => backend\models\PhoneUsers::getSexList()
            ],

            //'send_num',
            //'send_end_num',
            //'phone_num',
            //'subtag_num',
            //'created_at',
            //'updated_at',
            //'desc',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
