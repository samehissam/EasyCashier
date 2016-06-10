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
           
            ['label' => ' <i class="fa fa-money" aria-hidden="true"></i>&nbsp; إضافة مصروف', 'url' => Url::to(['rexpenses/create'])],
            ['label' => '<i class="fa fa-search" aria-hidden="true"></i>&nbsp; قائمة الأسعار', 'url' => ['ritem/index']],

            ['label' => '<i class="fa fa-list" aria-hidden="true"></i>&nbsp;التقارير', 'url' => Url::to(['rexpenses/ask'])],
            ['label' => '<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; الطلبات', 'url' => ['rtransaction/create']],

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
      	<div class="col-md-12 col-sm-11">
      		
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>  
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
