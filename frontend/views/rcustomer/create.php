<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rcustomer */

$this->title = 'Create Rcustomer';
$this->params['breadcrumbs'][] = ['label' => 'Rcustomers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rcustomer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
