<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = $model->InventoryId;
$this->params['breadcrumbs'][] = ['label' => 'Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'InventoryId' => $model->InventoryId, 'ProductId' => $model->ProductId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'InventoryId' => $model->InventoryId, 'ProductId' => $model->ProductId], [
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
            'InventoryId',
            'ProductQty',
            'ProductId',
        ],
    ]) ?>

</div>
