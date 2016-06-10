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

use Zelenin\yii\SemanticUI\Elements;

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


    
    <div class="container">
       
    <div class="row">
        <div class="col-md-9 col-sm-8">
            
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>  
        </div>

         <div class="col-md-3 col-sm-4" id="sideNav-margin">
            <div class="list-group">
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=crtransaction/create"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> &nbsp; إضافة طلبات</a>
               <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=crtransaction"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> &nbsp; عرض الطلبات اليومية للتعديل</a>
             
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=rexpenses/ask"><i class="fa fa-list" aria-hidden="true"></i>&nbsp; تقارير المصروفات المطعــــــــــــم</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=crtransaction/ask"><i class="fa fa-list" aria-hidden="true"></i>&nbsp; تقارير مبيعات المطعــــــــــــم</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=crtransaction/ask-shift"><i class="fa fa-list" aria-hidden="true"></i>&nbsp; تقارير مبيعات  المطعــم للشفتات</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=rexpenses/create"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; إضافة مصروفات المطعــــــــــــم</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ritem/create"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>&nbsp; إضافة صنف جديد للمطعــــــــــــم</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=rexpensetype/create"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; إضافة وصف جديد للمصروفات</a>
                <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=product/create"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; تسجيل منتجات المخزن</a>
                <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=inventory"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; مخزن المطعـــــم والكميات المتاحة</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=inventory/create"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; إضافة أو خروج كميات من المخزن</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=inventory/qty-report"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; تقرير الكميات التي بلغت حد الطلب</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ritem"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; قائمة أسعار المطعــــــــــــم</a>
              
            </div>
           
        
        </div>

    </div>
</div>

</div>

<footer class="footer">
    
    <div class="container">
        <p class="pull-left">&trade;<span id="footgreen"> Easy Cashier Resturant</span>  <?= date('Y') ?></p>
        <p class="pull-right">&copy; Developed By <a href="https://www.facebook.com/sammeh.mourad" target="_blank"> <b>Sameh Mourad</b></a></p>
    </div>
        
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
