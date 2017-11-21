<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Person */

$this->title = 'Tambah Data Kepala Keluarga';
$this->params['breadcrumbs'][] = ['label' => 'Kepala Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
