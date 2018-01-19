<?= $form->field($model, 'tags')->hiddenInput(['class' => 'tags_list_view']) ?>

<div class="form-group clearfix">
    <!--    <label class="control-label" for="phones-tags">Tags</label>-->
    <!--    <input type="hidden" id="phones-tags" class="tags_list_view" name="Phones[tags]">-->
    <!---->
    <!--    <div class="help-block"></div>-->
    <div class="col-sm-4">
        <?= \yii\bootstrap\Html::listBox('', '', [], ['class' => "form-control"]); ?>
    </div>
    <div class="col-sm-4">
        <?= \yii\bootstrap\Html::listBox('', '', [], ['class' => "form-control"]); ?>
    </div>
    <div class="col-sm-4 ">
        <?= \yii\bootstrap\Html::listBox('', '', [], ['class' => "form-control"]); ?>
    </div>
</div>

<script>




</script>
