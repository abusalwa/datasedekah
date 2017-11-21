<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BoxTrans */

$this->title = 'Create Box Trans';
$this->params['breadcrumbs'][] = ['label' => 'Box Trans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-trans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelKotak' => $modelKotak,
    ]) ?>

</div>
