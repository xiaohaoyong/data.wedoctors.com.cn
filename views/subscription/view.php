<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subscription */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'type',
            'level',
            'addtime:datetime',
            'img',
            'attr',
            'subject',
        ],
    ]) ?>

</div>
