<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\classes\ClassesSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理列表';
$this->params['breadcrumbs'][] = $this->title;

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

        ],
    ]); ?>
</div>
