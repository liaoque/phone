<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Phones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Phones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phones-view">

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
            'phone',
            [
                'attribute' => 'province',
                'format' => function ($value) {
                    $result = \backend\models\Areas::getLevelList(0);
                    return $result[$value];
                },
            ],
            [
                'attribute' => 'city',
                'format' => function ($value) {
                    $result = \backend\models\Areas::getLevelList(1);
                    return $result[$value];
                },
            ],
            [
                'attribute' => 'area',
                'format' => function ($value) {
                    $result = \backend\models\Areas::getLevelList(2);
                    return $result[$value];
                },
            ],
            'send_num',
            'see_num',
            [
                'attribute' => 'tags_group_id',
                'format' => function ($value) use ($model) {
                    $tags = $model->tagsGroup->tags;
                    $tags = \yii\helpers\ArrayHelper::map(\backend\models\Tags::find()->where(['id' => explode(',', $tags)])->all(), 'id', 'name');
                    return implode(',', $tags);
                },
                'label' => '标签'
            ],
            [
                'attribute' => 'id',
                'format' => function ($value) use ($model) {
                    return \backend\models\PhoneUsers::getSexList()[$model->phoneUser->sex];
                },
                'label' => '性别'
            ],
            [
                'attribute' => 'id',
                'format' => function ($value) use ($model) {
                    return \backend\models\PhoneUsers::getAgeList()[$model->phoneUser->age];
                },
                'label' => '年龄段'
            ],
            [
                'attribute' => 'id',
                'format' => function ($value) use ($model) {
                    return \backend\models\PhoneTypes::getTypeList()[$model->phoneUser->phoneTypes->type];
                },
                'label' => '手机类型'
            ],
            [
                'attribute' => 'id',
                'format' => function ($value) use ($model) {
                    return $model->phoneUser->phoneTypes->info;
                },
                'label' => '手机类型'
            ],
            [
                'attribute' => 'status',
                'format' => function ($value) {
                    return \backend\models\Phones::getStatusList()[$value];
                },
                'label' => '状态'
            ],
        ],
    ]) ?>

</div>
