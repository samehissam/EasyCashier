<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productcategories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productcategory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Productcategory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ProductCategoryId',
            'ProductCategoryName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
