<?php
$this->title="تقرير المبيعات";
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\WorkSession */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="page-header">
	<p class="well" style="font-weight: bold; font-size:20px;">
	- حدد تاريخ اليوم الذي تريد استخراج تقرير المبيعات له.
	</p>
</div> 


<div class="expense-report-form well col-md-12 col-ms-11">      



    <?php $form = ActiveForm::begin(); ?>


    
     <?= $form->field($dateModel,"TestDay")->textInput(['maxlength' => true,'autocomplete'=>"off"])->label("تاريخ اليوم")->widget(
                DatePicker::className(), [

                'language' => 'es',
                'size' => 'lg',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ]
            ] );
            ?>
           
    <div class="form-group">
    <?= Html::a('<span class="glyphicon glyphicon-list-alt pad"></span>إستخراج تقرير',['report'],['class' => 'btn1 btn btn-lg btn-primary', 'id' => 'report-button',
            'data' => [
                
                'method' => 'post',
            ],
        ]) ?>
    
    

    
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="long-report col-md-12 col-ms-11">
<div class="page-header">
    <p class="well" style="font-weight: bold; font-size:20px;">
    - حدد الفترة التي تريد استخراج تقرير المبيعات لها.
    </p>
</div> 

<div class="expense-long-report-form well">



    <?php $form = ActiveForm::begin(); ?>


    
<div class="col-md-6">
     <?= $form->field($dateModel,"start")->textInput(['maxlength' => true,'autocomplete'=>"off"])->label("من تاريخ يوم")->widget(
                DatePicker::className(), [

                'language' => 'es',
                'size' => 'lg',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ]
            ] );
            ?>
            </div>
            <div class="col-md-6">
             <?= $form->field($dateModel,"end")->textInput(['maxlength' => true,'autocomplete'=>"off"])->label("إلي تاريخ يوم")->widget(
                DatePicker::className(), [

                'language' => 'es',
                'size' => 'lg',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ]
            ] );
            ?>
            </div>
    <div class="form-group">
  <?= Html::a('<span class="glyphicon glyphicon-list-alt pad"></span>إستخراج تقرير لفترة معينة',['long-report'], ['class' => 'report btn1 btn btn-danger', 'id' => 'long-report-button',
            'data' => [
                
                'method' => 'post',
            ],
        ]) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
