<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\classes\Lesson */

$this->title ='编辑';

\app\components\helper\HeaderActionHelper::$action=[
0=>['name'=>'列表','url'=>['index']],
1=>['name'=>'添加','url'=>['create']]
];
?>
<div class="lesson-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
