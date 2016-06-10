<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\Elements;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
$this->title="مصروقات المطعم"
?>
<div class="col-lg-3"></div>
<div class="expenses-form col-md-8 well">

    <?php $form = ActiveForm::begin(); ?>

<?=
 $form->field($model, 'expense_type_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Rexpensetype::find()->all(),
    'id','name'),
    'size' => Select2::LARGE,
    'options' => ['placeholder' => 'إختر وصف للمصروف'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
/*
$form->field($model, 'expense_type_id')->widget(
    Select2Widget::className(),
    [
        'items'=>ArrayHelper::map(\app\models\Rexpensetype::find()->all(),
    'id','name'),
    'options' => ['placeholder' => 'Select a state ...'],
    
    ]
);
?>
    
   
    <?= $form->field($model, 'expense_type_id')->label('الوصف')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Rexpensetype::find()->all(),
    'id','name'),['prompt'=>'إختر الوصف ...','autofocus'=>true
    ])
*/

    ?>


    <?= $form->field($model, 'cost')->textInput(['onkeypress'=>"return isNumberKey(event)",'maxlength' => true,'autocomplete'=>"off"])->label('المبلغ') ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'autocomplete'=>"off"])->label('إضافة تعليق') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-shopping-cart pad"></span>إضافة' , ['class' =>  'radius-button btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    
