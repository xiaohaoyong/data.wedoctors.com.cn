<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DySeminar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Dy Seminars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->dynamicid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dy-seminar-update">

    <?= $this->render('_form', [
        'subscription'=>$subscription,
        'dynamicImage'=>$dynamicImage,

        'model' => $model,
    ]) ?>

</div>
