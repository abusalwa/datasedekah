<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\IstiqomahAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

IstiqomahAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'                  - Fixed Header

// Sidebar options
1. '.sidebar-fixed'                 - Fixed Sidebar
2. '.sidebar-hidden'                - Hidden Sidebar
3. '.sidebar-off-canvas'        - Off Canvas Sidebar
4. '.sidebar-minimized'         - Minimized Sidebar (Only icons)
5. '.sidebar-compact'             - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'          - Fixed Aside Menu
2. '.aside-menu-hidden'         - Hidden Aside Menu
3. '.aside-menu-off-canvas' - Off Canvas Aside Menu

// Footer options
1. '.footer-fixed'                      - Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<?php $this->beginBody() ?>
    <?php require(__DIR__ . '/header.php'); ?>

    <div class="app-body">
        <div class="sidebar">
            
            <?php require(__DIR__ . '/sidebar.php'); ?>

        </div>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <?= Breadcrumbs::widget([
                'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                'activeItemTemplate'=>'<li class="breadcrumb-item active">{link}</li>',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>

                <!-- Breadcrumb Menu-->
                
            </ol>


            <div class="container-fluid">
                <?= $content ?>
            </div>
            <!-- /.conainer-fluid -->
        </main>

        


    </div>

    <footer class="app-footer">
        <a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.
        <span class="float-right">Developed by <a href="http://coreui.io">Abusalwa At-Tambuni</a>
        </span>
    </footer>

    <!-- GenesisUI main scripts -->


<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>