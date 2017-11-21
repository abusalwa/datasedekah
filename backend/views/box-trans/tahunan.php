<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoxTransSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Infaq Tahunan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-trans-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <p style="margin-left: -15px">
                        Total Infaq Keseluruhan : <span style="font-size: 30px;" class="text-success"><b>Rp <?php echo number_format($totalInfaqAll,0,'.','.'); ?></b></span>
                </p>            
            </div>
            <div class="col-md-6">
                <p style="float: right;">
                
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
               'attribute'=>'year_trans',
               'label'=>'Tahun'
            ],
            [
               'attribute'=>'value_trans',
               'label'=>'Jumlah Infaq',
               'value'=>function($data){

                    return 'Rp '.number_format($data->value_trans,0,'.','.');
               }
            ],
            
            
            // 'year_trans',
            // 'created_at',
            // 'created_by',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
