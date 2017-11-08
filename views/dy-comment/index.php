<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\dynamic\DyCommentrSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理列表';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="dy-comment-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
            'id',
            [
                'attribute' => 'userid',
                'value' => function($e)
                {
                    $user=\app\models\UserInfo::findOne($e->userid);

                    return $user->name;
                }
            ],
            [
                'attribute' => 'touserid',
                'value' => function($e)
                {
                    $user=\app\models\UserInfo::findOne($e->touserid);

                    return $user->name;
                }
            ],
            'content',
            [
                'attribute' => 'dynamicid',
                'value' => function($e)
                {
                    $dynamic=\app\models\dynamic\Dynamic::findOne($e->dynamicid);
                    if($dynamic && $dynamic->source==5)
                    {
                        $dynamicRow=\app\models\dynamic\DyOpen::findOne(['dynamicid'=>$e->dynamicid]);
                    }elseif($dynamic && $dynamic->source==4){
                        $dynamicRow=\app\models\dynamic\DySeminar::findOne(['dynamicid'=>$e->dynamicid]);
                    }

                    return $dynamicRow?$dynamicRow->title:"";
                }
            ],
            // 'dynamicid',
            // 'level',
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            // 'pid',
            // 'source',
            // 'parentid',
        ],
    ]); ?>
</div>
