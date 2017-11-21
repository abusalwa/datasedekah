<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BoxTrans */

$this->title = $model->id_trans;
$this->params['breadcrumbs'][] = ['label' => 'Box Trans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-trans-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_trans], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_trans], [
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
            'id_trans',
            'id_box',
            'id_person',
            'value_trans',
            'month_trans',
            'year_trans',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
