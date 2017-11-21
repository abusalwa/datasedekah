<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-group mb-0">
                        <div class="card p-4">
                            <div class="card-block" style="max-width: 390px; max-height: 319px">
                                <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'fieldConfig' => [
                                    'options' => [
                                        'tag' => false,
                                    ],
                                ],
                                ]); ?>
                                <?php echo Html::img('@web/isthem/img/logo.png',['style'=>'margin-top:0px; margin-left:-12px; width:290px'])?>
                                <p class="text-muted">Sign In to your account</p>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>    
                            
                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class'=>'form-control', 'placeholder'=>'Username'])->label(false) ?>
                                    
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'placeholder'=>'Password'])->label(false) ?>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-istimewa', 'name' => 'login-button']) ?>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>


                        </div>
                        <div class="card card-inverse card-istimewa py-5 d-md-down-none" style="width:44%">
                            <div class="card-block text-center">
                                <div>
                                    <h2>SISMENAS</h2>
                                    <p style="margin-top: -15px; font-size:20px">ISTIQOMAH</p>
                                    <p> Aplikasi Sistem Manajemen Masjid Al Istiqomah Vila Bekasi Indah 1, Desa Mangun Jaya, Tambun Selatan, Bekasi-Jawa Barat</p>
                                    <button type="button" class="btn btn-istimewa active mt-3">Register Now!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>