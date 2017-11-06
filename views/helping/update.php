<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Helping */

$this->title = 'Update Helping: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Helpings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="helping-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
