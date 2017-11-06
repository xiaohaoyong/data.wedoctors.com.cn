<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfoImage */

$this->title ='添加';
$this->params['breadcrumbs'][] = ['label' => 'Info Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']]
];
?>
<div class="info-image-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
