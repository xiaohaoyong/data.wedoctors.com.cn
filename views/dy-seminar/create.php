<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DySeminar */

$this->title = '添加病例';
$this->params['breadcrumbs'][] = ['label' => 'Dy Seminars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dy-seminar-create">
    <?= $this->render('_form', [
        'subscription'=>$subscription,
        'dynamicImage'=>$dynamicImage,

        'model' => $model,
    ]) ?>
</div>
