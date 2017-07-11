<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyApp */
/* @var $form yii\widgets\ActiveForm */
$this->title="Ios";
?>

<div class="dy-app-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'versionInfo')->textarea(['rows'=>5]) ?>

    <?= $form->field($model,'isForceUpdate')->radioList([1=>'是',0=>'否'])?>

    <?= $form->field($model,'isStopUpdate')->radioList([1=>'是',0=>'否']) ?>

    <div class="form-group">
        <?= Html::submitButton('提交' , ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
