<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subscription */

$this->title = '修改公众号';
?>
<div class="subscription-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
