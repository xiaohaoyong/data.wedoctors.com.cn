<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Helping */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Helpings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helping-view">
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
            'userid',
            'toid',
            'totype',
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d']
            ],
            'helptime',
        ],
    ]) ?>

</div>
