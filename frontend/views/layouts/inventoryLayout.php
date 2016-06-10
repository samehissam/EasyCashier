<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

//use Zelenin\yii\SemanticUI\Elements;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <!--How to change website icon-->
        <link rel="shortcut icon" href="/Cashier/frontend/web/images/chef1.jpg">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">

                 <?php
    NavBar::begin([
        'brandLabel' => '<span class="span">Easy Cashier R</span>esturant',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top b',
        ],
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        //'items' => $menuItems,
        'encodeLabels' => false,
        'items' => [
            
            ['label' => ' <i class="fa fa-money" aria-hidden="true"></i>&nbsp; المصروفات', 'url' => Url::to(['rexpenses/create'])],
           
            ['label' => '<i class="fa fa-search" aria-hidden="true"></i>&nbsp; قائمة الأسعار', 'url' => ['ritem/index']],
           
            ['label' => '<i class="fa fa-search" aria-hidden="true"></i>&nbsp; المخزن', 'url' => ['inventory/index']],

            ['label' => '<i class="fa fa-list" aria-hidden="true"></i>&nbsp;التقارير', 'url' => Url::to(['rexpenses/ask'])],
           
            ['label' => '<i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;المبيعات اليومية',  'url' => (['crtransaction/index'])],
            
            ['label' => '<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; الطلبات', 'url' => ['crtransaction/create']],

   Yii::$app->user->isGuest ?
    // ['label' => '<span class="glyphicon glyphicon-user"></span> التسجيل', 'url' => ['/site/signup']]:
             ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp; تسجيل الدخول', 'url' => ['/site/login']]:

        ['label' => '<span class="glyphicon glyphicon-off"></span> خروج(' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ],


        ]]);

    NavBar::end();


    ?>



    <div class="col-lg-12 downn">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>
        

    </div>


        


</div>



        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
