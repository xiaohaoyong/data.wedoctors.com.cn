<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DySeminar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dy-seminar-form">

    <?php $form =ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($subscription,'id')->dropDownList(\app\models\Subscription::find()->select('name')->indexBy('id')->column(), ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ftitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>

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

    <?= $form->field($model, 'intro')->textarea(['rows'=>5]) ?>

    <?= $form->field($model, 'content')->widget('pjkui\kindeditor\KindEditor',[])->label('文章内容') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
