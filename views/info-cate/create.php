<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\article\InfoCate */

$this->title ='添加';
$this->params['breadcrumbs'][] = ['label' => 'Info Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']]
];
?>
<div class="info-cate-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
