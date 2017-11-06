<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\article\InfoCate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-cate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pid')->dropDownList(\app\models\article\InfoCate::find()->select('name')->indexBy('id')->where(['pid'=>0])->column(), ['prompt'=>'请选择']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
