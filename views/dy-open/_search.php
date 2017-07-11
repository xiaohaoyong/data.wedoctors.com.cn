<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DyOpenModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dy-open-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'dynamicid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'starttime') ?>

    <?php // echo $form->field($model, 'video') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
