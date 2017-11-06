<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\classes\Classes */

$this->title ='添加';
$this->params['breadcrumbs'][] = ['label' => 'Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']]
];
?>
<div class="classes-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
