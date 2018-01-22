<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagsGroup */

$this->title = 'Create Tags Group';
$this->params['breadcrumbs'][] = ['label' => 'Tags Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
