<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TagsGroup */

$this->title = 'Update Tags Group: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tags Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tags-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
