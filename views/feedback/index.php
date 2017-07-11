<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\doctor\FeedbackSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'content',
                'value' => function($e)
                {
                    return \yii\helpers\StringHelper::byteSubstr($e->content,0,10);
                }
            ],
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

            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'
                <div class="btn-group dropup">
                    <a class="btn btn-circle btn-default btn-sm" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-settings"></i> 操作 <i class="fa fa-angle-up"></i></a>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li> {view}</li><li>{delete}</li>
                    </ul>
                </div>
                ',
            ],
        ],
    ]); ?>
</div>
