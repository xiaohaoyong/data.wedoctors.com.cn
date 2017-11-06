<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyCommentrSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dy-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'touserid') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'dynamicid') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'pid') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'parentid') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
