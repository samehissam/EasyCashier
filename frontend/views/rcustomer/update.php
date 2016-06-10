<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rcustomer */

$this->title = 'Update Rcustomer: ' . ' ' . $model->CustomerId;
$this->params['breadcrumbs'][] = ['label' => 'Rcustomers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CustomerId, 'url' => ['view', 'id' => $model->CustomerId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rcustomer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
