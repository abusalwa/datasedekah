<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Box */

$this->title = 'Update Box: ' . $model->id_box;
$this->params['breadcrumbs'][] = ['label' => 'Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_box, 'url' => ['view', 'id' => $model->id_box]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
