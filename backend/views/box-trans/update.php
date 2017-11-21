<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BoxTrans */

$this->title = 'Update Box Trans: ' . $model->id_trans;
$this->params['breadcrumbs'][] = ['label' => 'Box Trans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trans, 'url' => ['view', 'id' => $model->id_trans]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-trans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
