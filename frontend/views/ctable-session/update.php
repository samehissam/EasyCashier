<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CtableSession */

$this->title = 'Update Ctable Session: ' . ' ' . $model->table_id;
$this->params['breadcrumbs'][] = ['label' => 'Ctable Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->table_id, 'url' => ['view', 'id' => $model->table_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ctable-session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
