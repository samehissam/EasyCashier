<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rexpenses */

$this->title = 'Update Rexpenses: ' . ' ' . $model->expense_id;
$this->params['breadcrumbs'][] = ['label' => 'Rexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->expense_id, 'url' => ['view', 'id' => $model->expense_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rexpenses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
