
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RtableSession */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-header">
    <p class="well" style="font-weight: bold; font-size: 20px;">
    - قم بالضغط علي هذا الزر للإضافة مقعد جديد.
    </p>
</div> 
<div class="rtable-session-form">

    <?php $form = ActiveForm::begin(); ?>

   <div class="col-md-3"></div> 
<div class="col-md-5">
<div class="hidden">
 <?php $now=date("Y-m-d h:i:s");?>
	<?= $form->field($model, 'table_state')->textInput(['value'=>0]) ?>

    <?= $form->field($model, 'session_start')->textInput(['value'=>$now]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; إضافة مقعد جديد'  ,['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>