<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\doctor\Point */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'point')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'type')->radioList(\app\models\doctor\Point::$typeText) ?>

    <?= $form->field($model, 'source')->radioList(\app\models\doctor\Point::$sourceText) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
