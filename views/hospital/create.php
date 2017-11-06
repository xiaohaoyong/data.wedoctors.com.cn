<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\doctor\Hospital */

$this->title = 'Create Hospital';
$this->params['breadcrumbs'][] = ['label' => 'Hospitals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\app\components\helper\HeaderActionHelper::$action=[
    0=>['name'=>'列表','url'=>['index']],
];
?>
<div class="hospital-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
