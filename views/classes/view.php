<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\classes\Classes */

$this->title = '详情';
$this->params['breadcrumbs'][] = ['label' => 'Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="classes-view">
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
            'title',
            [
                'attribute' => 'provinceid',
                'value' => function($e)
                {
                    return \app\models\Area::$all[$e->provinceid];
                }
            ],
            [
                'attribute' => 'cityid',
                'value' => function($e)
                {
                    return \app\models\Area::$all[$e->cityid];
                }
            ],
            [
                'attribute' => 'countyid',
                'value' => function($e)
                {
                    return \app\models\Area::$all[$e->countyid];
                }
            ],
            [
                'attribute' => 'starttime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'endtime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
        ],
    ]) ?>

</div>
