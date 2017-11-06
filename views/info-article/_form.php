<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\article\InfoArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ftitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'mediaid')->dropDownList(\app\models\Subscription::find()->where(['type'=>[1,3]])->select('name')->indexBy('id')->column(), ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'catpid')->dropDownList(\app\models\article\InfoCate::find()->select('name')->indexBy('id')->where(['pid'=>0])->column(), [
            'prompt'=>'请选择',
            'onchange'=>'
            $("#'.Html::getInputId($model,'catid').'").html(\''.Html::tag('option',Html::encode("请选择"),array('value'=>0)).'\');
            $.post("'.\yii\helpers\Url::to(['info-cate/get']).'?InfoCateSearchModel[pid]="+$(this).val(),function(data){
                $("#'.Html::getInputId($model,'catid').'").html(data);
            });',

    ]) ?>
    <?= $form->field($model,'catid')->dropDownList(\app\models\article\InfoCate::find()->select('name')->indexBy('id')->where(['pid'=>$model->catpid])->column(), ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'praiseNum')->textInput() ?>

    <?= $form->field($model, 'top')->radioList(\app\models\article\InfoArticle::$topText) ?>

    <?= $form->field($model, 'style')->radioList(\app\models\article\InfoArticle::$styleText) ?>

    <?= $form->field($model, 'model')->radioList(\app\models\article\InfoArticle::$modelText) ?>

    <?php
    if($model->image){

        ?>
        <div class="field-userInfo-avatar required">
            <label class="col-lg-3 control-label" for="userInfo-avatar">封面</label>
            <?=Html::img($model->image,['width' => 300])?>
            <div class="help-block"></div>
        </div>
    <?php }?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'vector')->textarea(['rows'=>5]) ?>

    <?php
    if($model->model==3 || $model->model==4)
    {
        $contentoptions=['options'=>['style'=>'display: none;']];
        $urlsoptions=[];
    }elseif($model->model==1){
        $contentoptions=['options'=>['style'=>'display: none;']];
        $urlsoptions=['options'=>['style'=>'display: none;']];;
    }else{
        $urlsoptions=['options'=>['style'=>'display: none;']];
        $contentoptions=[];

    }
    ?>

    <?= $form->field($model, 'content',$contentoptions)->widget('pjkui\kindeditor\KindEditor',[])->label('文章内容') ?>
    <?= $form->field($model, 'urls',$urlsoptions)->textInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$jsform="
$(\"input[name='".Html::getInputName($model,'model')."']\").on('change', function() {
    if($(this).val()==3 || $(this).val()==4)
    {
        $('.field-infoarticle-content').hide();
        $('.field-infoarticle-urls').show();
        $('#".Html::getInputId($model,'urls')."').val('');
    }else if($(this).val()==1){
        
        $('.field-infoarticle-content').hide();
        $('.field-infoarticle-urls').hide();
        $('#".Html::getInputId($model,'urls')."').val('');
        $('#".Html::getInputId($model,'content')."').val('');
    }else{
        $('.field-infoarticle-content').show();
        $('.field-infoarticle-urls').hide();
        $('#".Html::getInputId($model,'urls')."').val('');
    }
});
";


$js[]=$jsform;
$this->registerJs(implode("\n",$js));
?>