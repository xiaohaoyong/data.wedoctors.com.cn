<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\article\InfoArticle */

$this->title = 'Update Info Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Info Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="info-article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
