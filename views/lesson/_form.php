<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\classes\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'classesid')->dropDownList(\app\models\classes\Classes::find()->select('title')->indexBy('id')->column(), ['prompt'=>'请选择'])?>

    <?= $form->field($model, 'datetime')->widget(\app\components\widgets\DatePicker::className()) ?>

    <?= $form->field($model, 'dynamicid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
