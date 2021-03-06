<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '医生列表';

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


        ],
    ]); ?>
</div>
