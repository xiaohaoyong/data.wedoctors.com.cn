<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyOpen */

$this->title = '添加公开课';
$this->params['breadcrumbs'][] = ['label' => 'Dy Opens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dy-open-create">
    <?= $this->render('_form', [
            'dynamic'=>$dynamic,
        'dynamicImage'=>$dynamicImage,
        'model' => $model,
    ]) ?>
</div>
