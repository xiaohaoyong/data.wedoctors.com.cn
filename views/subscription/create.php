<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subscription */

$this->title = '添加公众号';
$this->params['breadcrumbs'][] = ['label' => 'Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
