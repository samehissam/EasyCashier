<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rexpensetype */

$this->title = 'Update Rexpensetype: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rexpensetypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rexpensetype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
