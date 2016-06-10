<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenseType */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-3"></div>
<div class="expense-type-form  col-md-8 well">

    <?php $form = ActiveForm::begin(); ?>

  
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'autocomplete'=>"off",'autofocus'=>true])->label('الوصف') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-shopping-cart pad"></span> إضافه الوصف ' , ['class' =>  'radius-button btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
  
