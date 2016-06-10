<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RcustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rcustomer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CustomerId') ?>

    <?= $form->field($model, 'CustomerName') ?>

    <?= $form->field($model, 'CustomerPhone') ?>

    <?= $form->field($model, 'CustomerAddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
