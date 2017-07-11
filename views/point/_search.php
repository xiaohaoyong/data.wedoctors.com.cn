<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\doctor\PointSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="point-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'userid') ?>


    <?= $form->field($model, 'type')->dropDownList(\app\models\doctor\Point::$typeText, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'source')->dropDownList(\app\models\doctor\Point::$sourceText, ['prompt'=>'请选择']) ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
