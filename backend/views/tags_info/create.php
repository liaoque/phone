<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagsInfo */

$this->title = 'Create Tags Info';
$this->params['breadcrumbs'][] = ['label' => 'Tags Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
