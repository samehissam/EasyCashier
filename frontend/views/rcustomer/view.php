<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rcustomer */

$this->title = $model->CustomerId;
$this->params['breadcrumbs'][] = ['label' => 'Rcustomers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rcustomer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CustomerId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CustomerId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CustomerId',
            'CustomerName',
            'CustomerPhone',
            'CustomerAddress',
        ],
    ]) ?>

</div>
