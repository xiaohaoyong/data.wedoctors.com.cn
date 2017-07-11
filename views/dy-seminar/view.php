<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DySeminar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Dy Seminars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dy-seminar-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dynamicid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dynamicid], [
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
            'dynamicid',
            'title',
            'phase',
            'state',
            'userid',
            [
                'attribute' => 'imageUrl',
                'format' => 'raw',

                'value' => function($data)
                {
                    $dynamicImg=\app\models\dynamic\Dyimgs::findOne(['dynamicid'=>$data->dynamicid]);
                    return Html::img($dynamicImg->src,['width' => 300]);
                }
            ],
        ],
    ]) ?>

</div>
