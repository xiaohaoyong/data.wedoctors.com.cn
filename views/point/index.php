<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\doctor\PointSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理列表';
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'添加','url'=>['create']]
];
?>
<div class="point-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [

            'id',
            'point',
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'userid',
                'value' => function($e)
                {
                    $user=\app\models\UserInfo::findOne($e->userid);

                    return $user->name;
                }
            ],
            'remarks',
            [
                'attribute' => 'source',
                'value' => function($e)
                {
                    return \app\models\doctor\Point::$sourceText[$e->source];
                }
            ],
            [
                'attribute' => 'type',
                'value' => function($e)
                {
                    return \app\models\doctor\Point::$typeText[$e->type];
                }
            ],
        ],
    ]); ?>
</div>
