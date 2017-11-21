<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Box */

$this->title = 'Tambah Kotak Infaq';
$this->params['breadcrumbs'][] = ['label' => 'Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
