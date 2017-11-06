<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\classes\LessonSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程详情';
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'返回','url'=>['classes/index']]
];
?>
<div class="lesson-index">
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
        'attribute' => '课程名称',
        'value' => function($e)
        {
            return \app\models\dynamic\DyOpen::findOne(['dynamicid'=>$e->dynamicid])->title;
        }
    ],
    [
        'attribute' => '关联专家',
        'value' => function($e)
        {
            $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
            if($dynamic && $dynamic->source==5)
            {
                $dynamicRow=\app\models\dynamic\DyOpen::findOne(['dynamicid'=>$e->dynamicid]);
            }elseif($dynamic && $dynamic->source==4){
                $dynamicRow=\app\models\dynamic\DySeminar::findOne(['dynamicid'=>$e->dynamicid]);
            }

            return $dynamicRow?\app\models\UserInfo::findOne($dynamicRow->userid)->name:"";
        }
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