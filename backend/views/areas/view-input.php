<?= $form->field($model, 'areas')->hiddenInput([
    'class' => 'areas_list_view clearfix',
    'data-first-list' =>  'list-areas-one'
]) ?>

<p class="clearfix" style=""></p>
<div class="form-group clearfix" id="areasList" data-url="<?= \yii\helpers\Url::toRoute(['areas/list']) ?>">
    <div class="col-sm-4">
        <?= \yii\bootstrap\Html::listBox('', '', [0 => '全部'], [
                'class' => "form-control list-areas-one",
                'data-next-tag-list' => 'list-areas-two'
        ]); ?>
    </div>
    <div class="col-sm-4">
        <?= \yii\bootstrap\Html::listBox('', '', [ 0 => '全部'], [
                'class' => "form-control list-areas-two",
            'data-next-tag-list' => 'list-areas-three'
            ]); ?>
    </div>
    <div class="col-sm-4 ">
        <?= \yii\bootstrap\Html::listBox('', '', [ '0' => '全部' ], [
                'class' => "form-control list-areas-three"]); ?>
    </div>
</div>
