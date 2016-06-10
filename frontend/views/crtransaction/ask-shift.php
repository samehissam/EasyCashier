<?php
$this->title="تقرير المبيعات";
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use dosamigos\datepicker\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\mpdf\Pdf;
?>


<div class="long-report col-md-12 col-ms-11">
<div class="page-header">
    <p class="well" style="font-weight: bold; font-size:20px;">
    - حدد الفترة التي تريد استخراج تقرير المبيعات لها.
    </p>
</div> 

<div class="expense-long-report-form well">



    <?php $form = ActiveForm::begin(); ?>
  <div class="col-md-6">
              <?= DateTimePicker::widget([
                'model' => $dateModel,
                'attribute' => 'end',
                'options' => ['placeholder' => 'نهاية الشفت'],
                'pluginOptions' => [
                 'autoclose' => true
                 ]
        ]);
 
        ?>
            
            </div>

    
<div class="col-md-6">

<?= DateTimePicker::widget([
    'model' => $dateModel,
    'attribute' => 'start',
    'options' => ['placeholder' => 'بداية الشفت'],
    'pluginOptions' => [
        'autoclose' => true
    ]
]);
 
?>


    
            </div>
          
    <div class="form-group">
  <?= Html::a('<span class="glyphicon glyphicon-list-alt pad"></span>إستخراج تقرير لفترة معينة',['shift-report'], ['class' => 'report btn1 btn btn-danger', 'id' => 'long-report-button',
            'data' => [
                
                'method' => 'post',
            ],
        ]) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
