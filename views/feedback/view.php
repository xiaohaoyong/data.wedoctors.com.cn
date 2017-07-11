<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\doctor\Feedback */

$this->title = '详情';
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="feedback-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content',
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'userid',
                'value' => function($e)
                {
                    $user=\app\models\UserInfo::findOne($e->userid);

                    return $user->name;
                }
            ],
        ],
    ]) ?>

</div>
