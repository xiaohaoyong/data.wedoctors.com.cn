<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HelpingSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="helping-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'toid') ?>

    <?= $form->field($model, 'totype') ?>

    <?= $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'helptime') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
