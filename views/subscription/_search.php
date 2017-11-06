<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubscriptionSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscription-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>


    <?= $form->field($model, 'level')->dropDownList(\app\models\Subscription::$levelText, ['prompt'=>'请选择']) ?>
    <?= $form->field($model, 'type')->dropDownList(\app\models\Subscription::$typeText, ['prompt'=>'请选择']) ?>


    <?php // echo $form->field($model, 'addtime') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'attr') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
