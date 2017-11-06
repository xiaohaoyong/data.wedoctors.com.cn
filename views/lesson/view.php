<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\classes\Lesson */

$this->title = '详情';
$this->params['breadcrumbs'][] = ['label' => 'Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="lesson-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'attribute' => 'dynamicid',
                'value' => function($e)
                {
                    $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
                    $name=[];
                    if($dynamic && $dynamic->source==5)
                    {
                        $name=\app\models\dynamic\DyOpen::find()->select('title')->where(['dynamicid'=>$e->dynamicid])->column();
                    }elseif($dynamic && $dynamic->source==4){
                        $name=\app\models\dynamic\DySeminar::find()->select('title')->where(['dynamicid'=>$e->dynamicid])->column();
                    }
                    return $name[0];
                }
            ],
            [
                'attribute' => '关联专家',
                'value' => function($e)
                {
                    $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
                    $user=\app\models\UserInfo::findOne($dynamic->userid);
                    return $user->name;
                }
            ],
        ],
    ]) ?>

</div>
