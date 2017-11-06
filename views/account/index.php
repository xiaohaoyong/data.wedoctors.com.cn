<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\doctor\AccountSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '帮扶费用明细';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <hr>
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
                'attribute' => 'createtime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            'remarks',
            'money',

    [
        'attribute' => 'source',
        'value' => function($e)
        {
            return \app\models\doctor\Account::$sourceText[$e->source];
        }
    ],
    [
        'attribute' => 'type',
        'value' => function($e)
        {
            return \app\models\doctor\Account::$typeText[$e->type];
        }
    ],
        ],
    ]); ?>
</div>
