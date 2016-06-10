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
        'brandLabel' => '<span class="span">Easy Cashier C</span>afe',
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
            
            ['label' => ' <i class="fa fa-money" aria-hidden="true"></i>&nbsp; إضافة مصروف', 'url' => Url::to(['cexpenses/create'])],
            ['label' => '<i class="fa fa-search" aria-hidden="true"></i>&nbsp; قائمة الأسعار', 'url' => ['citem/index']],

            ['label' => '<i class="fa fa-list" aria-hidden="true"></i>&nbsp;التقارير', 'url' => Url::to(['ctransaction/ask'])],
             ['label' => '<i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;المبيعات اليومية',  'url' => (['ctransaction/index'])],
            
            ['label' => '<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; الطلبات', 'url' => ['ctransaction/create']],

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
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ctransaction/create"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> &nbsp; إضافة طلبات</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ctransaction"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> &nbsp; عرض الطلبات اليومية للتعديل</a>
              
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ctransaction/ask-shift"><i class="fa fa-list" aria-hidden="true"></i>&nbsp; تقارير مبيعات  المطعــم للشفتات</a>
             
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=cexpenses/ask"><i class="fa fa-list" aria-hidden="true"></i>&nbsp; تقارير المصروفات الكــــــــافي</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ctransaction/ask"><i class="fa fa-list" aria-hidden="true"></i>&nbsp; تقارير مبيعات الكـــــــــــــافي</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=cexpenses/create"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; إضافة مصروفات الكــــــــــافي</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=citem/create"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>&nbsp; إضافة صنف جديد للكــــــــافي</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=cexpensetype/create"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; إضافة وصف جديد للمصروفات</a>
              <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=ctable-session/create"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; إضافة مقعد جديد</a>
               <a class="list-group-item" href="/Cashier/frontend/web/index.php?r=citem"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; قائمة الأسعار الكـــــــــــــــــافي</a>
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
