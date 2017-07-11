<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\article\InfoArticle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Info Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-article-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'author',
            'source',
            'praiseNum',
            'createtime:datetime',
            'catid',
            'dept',
            'image',
            'catpid',
            'level',
            'mediaid',
            'vector',
            'timing',
            'top',
            'style',
            'model',
        ],
    ]) ?>

</div>
