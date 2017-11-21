<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class IstiqomahAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'isthem/js/app.js',               

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $css = [
        
        'isthem/css/style.css',
        'isthem/css/bootstrap.css',
        'isthem/css/font-awesome.min.css',
        'isthem/css/simple-line-icons.css',

    ];
}
