<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BoxTransSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-trans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_trans') ?>

    <?= $form->field($model, 'id_box') ?>

    <?= $form->field($model, 'id_person') ?>

    <?= $form->field($model, 'value_trans') ?>

    <?= $form->field($model, 'month_trans') ?>

    <?php // echo $form->field($model, 'year_trans') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
