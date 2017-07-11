<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
\app\components\helper\HeaderActionHelper::$action=[
    0=>['name'=>'添加','url'=>['create']]
];
?>
<div class="users-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => '手机号',
                'value' => function($data)
                {
                    return $data->user->phone;
                }
            ],
            [
                'attribute' => '姓名',
                'value' => function($data)
                {
                    return $data->user->name;
                }
            ],
            [
                'attribute' => '一级科室',
                'value' => function($data)
                {
                    return \app\models\doctor\Subject::$subject[$data->user->subject_b];
                }
            ],
            [
                'attribute' => '二级科室',
                'value' => function($data)
                {
                    return \app\models\doctor\Subject::$subject[$data->user->subject_s];
                }
            ],
            [
                'attribute' => '所属医院',
                'value' => function($data)
                {
                    $hospital=\app\models\doctor\Hospital::findOne($data->user->hospitalid);
                    return $hospital->name;
                }
            ],
            [
                'attribute' => 'level',
                'value' => function($data)
                {
                    return \app\models\Users::$levelText[$data->level];
                }
            ],
            [
                'attribute' => 'type',
                'value' => function($data)
                {
                    return \app\models\Users::$typeText[0][$data->type];
                }
            ],
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d']
            ],

            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'
                <div class="btn-group dropup">
                    <a class="btn btn-circle btn-default btn-sm" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-settings"></i> 操作 <i class="fa fa-angle-up"></i></a>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>{update} </li><li>{delete}</li>
                    </ul>
                </div>
                ',
            ],
        ],
    ]); ?>
</div>
