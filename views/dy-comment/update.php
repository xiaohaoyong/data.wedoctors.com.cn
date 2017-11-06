<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\dynamic\DyComment */

$this->title ='编辑';
$this->params['breadcrumbs'][] = ['label' => 'Dy Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="dy-comment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
