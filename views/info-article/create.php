<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\article\InfoArticle */

$this->title = 'Create Info Article';
$this->params['breadcrumbs'][] = ['label' => 'Info Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-article-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
