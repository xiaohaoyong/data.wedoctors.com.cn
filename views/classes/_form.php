<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\classes\Classes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'provinceid')->dropDownList(\app\models\Area::$province,
        [
            'prompt'=>'请选择',
            'onchange'=>'
            $("#'.Html::getInputId($model,'cityid').'").html(\''.Html::tag('option',Html::encode("请选择"),array('value'=>0)).'\');
            $("#'.Html::getInputId($model,'countyid').'").html(\''.Html::tag('option',Html::encode("请选择"),array('value'=>0)).'\');
            $.post("'.\yii\helpers\Url::to(['area/get']).'?id="+$(this).val(),function(data){
                $("#'.Html::getInputId($model,'cityid').'").html(data);
            });',
        ]) ?>
    <?php $city=\app\models\Area::$city[$model->provinceid]?\app\models\Area::$city[$model->provinceid]:[];?>
    <?= $form->field($model,'cityid')->dropDownList($city,
        [
            'prompt'=>'请选择',
            'onchange'=>'
            $("#'.Html::getInputId($model,'countyid').'").html(\''.Html::tag('option',Html::encode("请选择"),array('value'=>0)).'\');
            $.post("'.\yii\helpers\Url::to(['area/get']).'?type=county&id="+$(this).val(),function(data){
                $("#'.Html::getInputId($model,'countyid').'").html(data);
            });',
        ]) ?>
    <?php $county=\app\models\Area::$county[$model->cityid]?\app\models\Area::$county[$model->cityid]:[];?>

    <?= $form->field($model,'countyid')->dropDownList($county,['prompt'=>'请选择']) ?>


    <?= $form->field($model, 'starttime')->widget(\app\components\widgets\DatePicker::className()) ?>

    <?= $form->field($model, 'endtime')->widget(\app\components\widgets\DatePicker::className()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
