<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\doctor\HospitalSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hospitals';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="hospital-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
    [
        'attribute' => 'province',
        'value' => function($e)
        {
            return \app\models\Area::$all[$e->province];
        }
    ],
    [
        'attribute' => 'city',
        'value' => function($e)
        {
            return \app\models\Area::$all[$e->city];
        }
    ],
    [
        'attribute' => 'county',
        'value' => function($e)
        {
            return \app\models\Area::$all[$e->county];
        }
    ],
            'area',
            // 'type',
            // 'rank',
            // 'nature',
            // 'createtime:datetime',


        ],
    ]); ?>
</div>
