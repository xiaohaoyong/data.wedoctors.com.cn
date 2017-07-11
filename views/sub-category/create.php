<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\sub\SubCategory */

$this->title ='添加';
$this->params['breadcrumbs'][] = ['label' => 'Sub Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']]
];
?>
<div class="sub-category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
