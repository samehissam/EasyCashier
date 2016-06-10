<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productcategory */

$this->title = 'Update Productcategory: ' . ' ' . $model->ProductCategoryId;
$this->params['breadcrumbs'][] = ['label' => 'Productcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ProductCategoryId, 'url' => ['view', 'id' => $model->ProductCategoryId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productcategory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
