<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Productcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-header">
    <p class="well" style="font-weight: bold; font-size: 20px;">
    - حدد أقسام المنتجات التي تضيفها في المخزن.
    </p>
</div> 
<div class="product-form well">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ProductCategoryName')->textInput(['maxlength' => true,'placeholder'=>'إسم القسم ...'])->label("")?>


     <div class="form-group">
        <?= Html::submitButton('إضافة القسم الجديد' , ['class' =>'report btn1 btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
