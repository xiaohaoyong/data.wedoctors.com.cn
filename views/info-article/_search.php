<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\article\InfoArticleSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'praiseNum') ?>

    <?php // echo $form->field($model, 'createtime') ?>


    <?= $form->field($model, 'catpid')->dropDownList(\app\models\article\InfoCate::find()->select('name')->indexBy('id')->where(['pid'=>0])->column(), [
        'prompt'=>'请选择',
        'onchange'=>'
            $("#'.Html::getInputId($model,'catid').'").html(\''.Html::tag('option',Html::encode("请选择"),array('value'=>0)).'\');
            $.post("'.\yii\helpers\Url::to(['info-cate/get']).'?InfoCateSearchModel[pid]="+$(this).val(),function(data){
                $("#'.Html::getInputId($model,'catid').'").html(data);
            });',

    ]) ?>
    <?= $form->field($model,'catid')->dropDownList(\app\models\article\InfoCate::find()->select('name')->indexBy('id')->where(['pid'=>$model->catpid])->column(), ['prompt'=>'请选择'])?>


    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'mediaid') ?>

    <?php // echo $form->field($model, 'vector') ?>

    <?php // echo $form->field($model, 'timing') ?>

    <?php // echo $form->field($model, 'top') ?>

    <?php // echo $form->field($model, 'style') ?>

    <?php // echo $form->field($model, 'model') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
