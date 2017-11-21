<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Box */

$this->title = 'No Kotak : '.$model->no_box;
$this->params['breadcrumbs'][] = ['label' => 'Data Kotak Infaq', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_box], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_box], [
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
            // 'id_box',
            [
                'attribute'=>'no_box',
                'label'=>'Nomor Kotak'
            ],
            [
                'attribute'=>'idPerson.name_person',
                'label'=>'Nama Kepala Keluarga'
                ],
        ],
    ]) ?>

</div>
