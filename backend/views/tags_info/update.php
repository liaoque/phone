<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TagsInfo */

$this->title = 'Update Tags Info: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tags Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tags-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
