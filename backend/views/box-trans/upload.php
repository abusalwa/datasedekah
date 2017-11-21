<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Person */

$this->title = 'Upload Data Pendapatan Kotak Infaq';
$this->params['breadcrumbs'][] = ['label' => 'Kotak Infaq', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <h3 class="box-title">Upload Excel File (*.xls)</h3>

    
    <div class="person-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="box-body">      
        <?= $form->field($model, 'imageFile')->fileInput(['name'=>'fileupload'])->label('Select File') ?>
        <div class="box-footer">
          <?= Html::submitButton('<i class="fa fa-cloud-upload"></i> Upload', ['class' => 'btn btn-success btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    </div>
</div>

