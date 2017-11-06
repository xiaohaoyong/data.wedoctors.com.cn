<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\doctor\UserTop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-top-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'topnum')->textInput() ?>

    <?= $form->field($model, 'helpnum')->textInput() ?>

    <?= $form->field($model, 'intro')->textarea(['rows'=>5]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
