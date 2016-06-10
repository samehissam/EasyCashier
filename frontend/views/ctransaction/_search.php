<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CtransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctransaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'table_session') ?>

    <?= $form->field($model, 'item_item_id') ?>

    <?= $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'table_table_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
