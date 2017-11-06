<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Update Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
\app\components\helper\HeaderActionHelper::$action=[
    0=>['name'=>'列表','url'=>['index']]
];
?>
<div class="users-update">

    <?= $this->render('_form', [
        'model' => $model,
        'userInfo' => $userInfo,
        'userLogin' => $userLogin,
    ]) ?>

</div>
