<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kepala Keluarga';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?> 
        <?= Html::a('<i class="fa fa-cloud-upload"></i> Upload Data KK', ['upload'], ['class' => 'btn btn-danger']) ?>
        
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_person',
            [
                'attribute'=>'name_person',
                'label'=>'Nama Kepala Keluarga'
            ],
            'zona',
            'rt',
            'blok',
            'no_rumah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
