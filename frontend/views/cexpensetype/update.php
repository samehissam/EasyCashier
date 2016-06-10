<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cexpensetype */

$this->title = 'Update Cexpensetype: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cexpensetypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cexpensetype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
