<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyApp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dy-app-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ftitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($dynamic,'userid')->dropDownList(\app\models\Subscription::find()->select('name')->where(['type'=>2])->indexBy('id')->column(), ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
