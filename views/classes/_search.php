<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\classes\ClassesSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

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

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
