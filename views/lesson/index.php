<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\classes\LessonSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理列表';
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'添加','url'=>['create']]
];
?>
<div class="lesson-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
            'id',
            [
                'attribute' => 'classesid',
                'value' => function($e)
                {
                    $classes=\app\models\classes\Classes::findOne($e->classesid);
                    return $classes->title;
                }
            ],
            [
                'attribute' => 'datetime',
                'format' => ['date', 'php:Y-m-d H:i']
            ],
    [
        'attribute' => 'is_push',
        'value' => function($e)
        {
            return \app\models\classes\Lesson::$is_pushText[$e->is_push];
        }
    ],
    [
        'attribute' => 'is_send',
        'value' => function($e)
        {
            return \app\models\classes\Lesson::$is_sendText[$e->is_send];
        }
    ],
            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' =>function($url,$e,$key){
                        $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
                        $name=[];
                        if($dynamic && $dynamic->source==5)
                        {
                            $name=\app\models\dynamic\DyOpen::find()->select('title')->where(['dynamicid'=>$e->dynamicid])->column();

                            $dy="dy-open";
                        }elseif($dynamic && $dynamic->source==4){
                            $name=\app\models\dynamic\DySeminar::find()->select('title')->where(['dynamicid'=>$e->dynamicid])->column();
                            $dy="dy-seminar";
                        }
                        $url=$name[0]?Html::a($name[0],[$dy.'/update',"id"=>$e->dynamicid]):"";

                        return $url;
                    }
                ]
            ],
            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' =>function($url,$e,$key){
                        $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
                        if($dynamic && $dynamic->source==5)
                        {
                            $dynamicRow=\app\models\dynamic\DyOpen::findOne(['dynamicid'=>$e->dynamicid]);
                        }elseif($dynamic && $dynamic->source==4){
                            $dynamicRow=\app\models\dynamic\DySeminar::findOne(['dynamicid'=>$e->dynamicid]);
                        }
                        if($dynamicRow) {
                            $user = \app\models\UserInfo::findOne($dynamicRow->userid);
                        }
                        $url=$user->name?Html::a($user->name,['users/update',"id"=>$dynamicRow->userid]):"";

                        return $url;
                    }
                ]
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