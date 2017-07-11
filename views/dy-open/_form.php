<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyOpen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dy-open-form">

    <?php $form =ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($dynamic,'userid')->dropDownList(\app\models\Subscription::find()->select('name')->indexBy('id')->column(), ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ftitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows'=>5]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'whenlong')->textInput(['maxlength' => true]) ?>
    <?php
    if($dynamicImage->src){

    ?>
    <div class="field-order-licenseimg required">
        <label class="col-lg-3 control-label" for="order-licenseimg">封面</label>
        <?=Html::img($dynamicImage->src,['width' => 300])?>
        <div class="help-block"></div>
    </div>
    <?php }?>
    <?= $form->field($dynamicImage, 'src')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
