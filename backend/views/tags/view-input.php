<?= $form->field($model, 'tags')->hiddenInput(['class' => 'tags_list_view clearfix']) ?>

<p class="clearfix" style=""></p>
<div class="form-group clearfix" id="tagsList" data-url="<?= \yii\helpers\Url::toRoute(['tags/list']) ?>">
    <!--    <label class="control-label" for="phones-tags">Tags</label>-->
    <!--    <input type="hidden" id="phones-tags" class="tags_list_view" name="Phones[tags]">-->
    <!---->
    <!--    <div class="help-block"></div>-->
    <div class="col-sm-4">
        <?= \yii\bootstrap\Html::listBox('', '', [0 => '全部'], [
                'class' => "form-control list-tags-one",
                'data-next-tag-list' => 'list-tags-two'
        ]); ?>
    </div>
    <div class="col-sm-4">
        <?= \yii\bootstrap\Html::listBox('', '', [ 0 => '全部'], [
                'class' => "form-control list-tags-two",
            'data-next-tag-list' => 'list-tags-three'
            ]); ?>
    </div>
    <div class="col-sm-4 ">
        <?= \yii\bootstrap\Html::listBox('', '', [ '0' => '全部' ], [
                'class' => "form-control list-tags-three"]); ?>
    </div>


</div>
