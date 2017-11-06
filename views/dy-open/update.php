<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyOpen */

$this->title = '编辑：' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Dy Opens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->dynamicid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dy-open-update">

    <?= $this->render('_form', [
        'dynamic'=>$dynamic,
        'dynamicImage'=>$dynamicImage,
        'model' => $model,
    ]) ?>

</div>
