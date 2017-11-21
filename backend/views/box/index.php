<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kotak Infaq';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Kotak Infaq', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-cloud-upload"></i> Upload Data Kotak Infaq', ['upload'], ['class' => 'btn btn-danger']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_box',
            [
                'attribute'=>'no_box',
                'label'=>'Nomor Kotak'
            ],
            'idPerson.name_person',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
