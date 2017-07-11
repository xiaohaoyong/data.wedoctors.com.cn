<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HelpingSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Helpings';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="helping-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' =>function($url,$e,$key){
                        $user=\app\models\UserInfo::findOne($e->userid);
                        $hosp=\app\models\doctor\Hospital::findOne($user->hospitalid);
                        $name=Html::a($user->name,['users/update','id'=>$e->userid])."---".Html::a($hosp->name,['hospital/update','id'=>$hosp->id]);
                        return $name;
                    }
                ]
            ],

            [
                'class' => 'app\components\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' =>function($url,$e,$key){
                        if($e->totype==2)
                        {
                            $hosp=\app\models\doctor\Hospital::findOne($e->toid);
                            $name=Html::a($hosp->name,['hospital/update','id'=>$hosp->id]);

                        }else{
                            $user=\app\models\UserInfo::findOne($e->toid);
                            $name=Html::a($user->name,['users/update','id'=>$e->userid]);

                        }
                        return $name;
                    }
                ]
            ],
            [
                'attribute' => 'totype',
                'value' => function($e)
                {
                    return \app\models\Helping::$toTypeText[$e->totype];
                }
            ],
            [
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d']
            ],

        ],
    ]); ?>
</div>
