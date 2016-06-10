<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = 'Update Inventory: ' . ' ' . $model->InventoryId;
$this->params['breadcrumbs'][] = ['label' => 'Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->InventoryId, 'url' => ['view', 'InventoryId' => $model->InventoryId, 'ProductId' => $model->ProductId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
