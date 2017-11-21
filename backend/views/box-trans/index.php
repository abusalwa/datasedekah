<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoxTransSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Infaq Terkumpul';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-trans-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <p style="margin-left: -15px">
                    
                    <?= Html::a('<i class="fa fa-cloud-upload"></i> Upload Data Pendapatan Infaq', ['upload'], ['class' => 'btn btn-danger']) ?>
                </p>            
            </div>
            <div class="col-md-6">
                <p style="float: right;">
                    Total Infaq Bulan Ini, <?php echo date('F Y');?> : <span style="font-size: 30px;" class="text-success"><b>Rp <?php echo number_format($totalInfaqBulanan,0,'.','.'); ?></b></span>
                </p>
            </div>
        </div>
    </div>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_trans',
            [
                'attribute'=>'idBox.no_box',
                'label'=>'No Kotak'
            ],
            [
                'attribute'=>'idPerson.name_person',
                'label'=>'Nama Kepala Keluarga'
            ],
            [
                'attribute'=>'idPerson.rt',
                'label'=>'RT'
            ],
            
            [
               'attribute'=>'value_trans',
               'label'=>'Jumlah Infaq',
               'value'=>function($data){

                    return 'Rp '.number_format($data->value_trans,0,'.','.');
               }
            ],
            [
               'attribute'=>'month_trans',
               'label'=>'Bulan',
               'value'=>function($data){

                    $monthNum  = $data->month_trans;
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);                  
                    
                    // return date('F',$ubahBulanTahun);
                    return $dateObj->format('F');
               }

            ],
            [
               'attribute'=>'year_trans',
               'label'=>'Tahun'
            ],
            
            // 'year_trans',
            // 'created_at',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
