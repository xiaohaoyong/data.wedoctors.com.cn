<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DyOpenModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公开课关联';
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'添加','url'=>['create']]
];
?>
<div class="dy-open-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dynamicid',
            'title',
            [
                'attribute' => 'userid',
                'value' => function($e)
                {
                    $user=\app\models\UserInfo::findOne($e->userid);

                    return $user->name;
                }
            ],
            // 'video',
            [
                'attribute' => 'pushstate',
                'value' => function($e)
                {
                    $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
                    return \app\models\dynamic\Dynamic::$pushstateText[$dynamic->pushstate];
                }
            ],
            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'
                <div class="btn-group dropup">
                    <a class="btn btn-circle btn-default btn-sm" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-settings"></i> 操作 <i class="fa fa-angle-up"></i></a>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>{update} </li><li>{delete}</li><li>{push}</li>
                    </ul>
                </div>
                ',
                'buttons'=>[
                    'push' =>function($url,$model,$key){
                        return \yii\helpers\Html::a('<span class="fa fa-share"> PUSH</span>', \Yii::$app->urlManager->createUrl(['push/index', 'id'=>$model->dynamicid]),
                            [
                                'data-target' => "#push",//关联模拟框(模拟框的ID)
                                'data-toggle' => "modal", //定义为模拟框 触发按钮
                                'xywy_id' => $model->dynamicid, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                                'xywy_type'=>1, //学院推送
                                'title' => 'PUSH',
                            ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>

<?php
\app\components\widgets\ModalWidget::begin([
    'id' => 'push',//弹出层ID
    'xywy_attr' => ['id','type'], //需要进行传输的字段改name值
    'header'=>'选择附属推送用户（默认推送关注用户）',
]);

\app\components\widgets\ModalWidget::end(); //结束
$this->registerJs("
$('#push').data('bs.modal','');
");
?>