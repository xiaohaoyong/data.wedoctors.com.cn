<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\classes\ClassesSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理列表';
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'添加','url'=>['create']]
];
?>
<div class="classes-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
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


            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'
                <div class="btn-group dropup">
                    <a class="btn btn-circle btn-default btn-sm" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-settings"></i> 操作 <i class="fa fa-angle-up"></i></a>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>{update} </li>
                    </ul>
                </div>
                ',
            ],
        ],
    ]); ?>
</div>
