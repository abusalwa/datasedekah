<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Dropdown;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use app\comp\Datalist;

$datalist = new Datalist;
/* @var $this yii\web\View */
/* @var $model backend\models\BoxTrans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-trans-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
                
                <div class="form-group">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                
                                <?= $form->field($model, 'id_box')->textInput()->label('No Kotak') ?>

                                <?php 
                                                echo $form->field($model, "id_box")->widget(Select2::classname(), [
                                                    'data' => $datalist->getBoxListaja(),
                                                        'language' => 'en',
                                                        'options' => [
                                                          'placeholder' => 'Pilih No Kotak ...',
                                                         ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ])->label(false);
                                                    //['prompt'=>'-- Select COA --', 'onchange'=>'$.post("index.php?r=jurnal/lists&id='.'"+$(this).val(), function( data ) {$( "select#jurnalchild-'.$i.'-dc'.'" ).html( data ); });']
                                                
                                            ?>
                            </div>

                            <div class="col-md-3">
                                <?= $form->field($model, 'value_trans')->textInput() ?>
                            </div>

                            <div class="col-md-3">
                                <?= $form->field($model, 'month_trans')->textInput() ?>
                            </div>

                            <div class="col-md-3">
                                <?= $form->field($model, 'year_trans')->textInput() ?>
                            </div>
                        </div>

                    </div>

                </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
