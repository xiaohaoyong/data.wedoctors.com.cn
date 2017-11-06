<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Helping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="helping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>


    <?= $form->field($model, 'totype')->dropDownList(\app\models\Helping::$toTypeText, ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'toid')->textInput() ?>

    <?= $form->field($model, 'helptime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
