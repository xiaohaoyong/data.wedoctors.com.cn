<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subscription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?php
        if(!$model->isNewRecord){
            $form->field($model, 'level')->dropDownList(\app\models\Subscription::$levelText, ['prompt'=>'请选择']);
        }
    ?>

    <?= $form->field($model, 'type')->dropDownList(\app\models\Subscription::$typeText, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'subject')->dropDownList(\app\models\sub\SubCategory::find()->select('name')->indexBy('id')->column(), ['prompt'=>'请选择']) ?>

    <?php
    if($model->img){

        ?>
        <div class="field-order-licenseimg required">
            <label class="col-lg-3 control-label" for="order-licenseimg">头像</label>
            <?=Html::img($model->img,['width' => 300])?>
            <div class="help-block"></div>
        </div>
    <?php }?>
    <?= $form->field($model, 'img')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
