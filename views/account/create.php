<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\doctor\Account */

$this->title ='请谨慎添加，不可修改';
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']]
];
?>
<div class="account-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
