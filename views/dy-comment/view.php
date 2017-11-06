<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyComment */

$this->title = '详情';
$this->params['breadcrumbs'][] = ['label' => 'Dy Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="dy-comment-view">
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
            'touserid',
            'content',
            'type',
            'dynamicid',
            'level',
            'createtime:datetime',
            'pid',
            'source',
            'parentid',
        ],
    ]) ?>

</div>
