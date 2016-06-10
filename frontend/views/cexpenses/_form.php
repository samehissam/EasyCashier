<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\Elements;
/* @var $this yii\web\View */
/* @var $model app\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-3"></div>
<div class="expenses-form col-md-8 well">

    <?php $form = ActiveForm::begin(); ?>


    
   
    <?= $form->field($model, 'expense_type_id')->label('الوصف')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Cexpensetype::find()->all(),
    'id','name'),['prompt'=>'إختر الوصف ...','autofocus'=>true
    ])?>


    <?= $form->field($model, 'cost')->textInput(['onkeypress'=>"return isNumberKey(event)",'maxlength' => true,'autocomplete'=>"off"])->label('المبلغ') ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'autocomplete'=>"off"])->label('إضافة تعليق') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-shopping-cart pad"></span>إضافة' , ['class' =>  'radius-button btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    
