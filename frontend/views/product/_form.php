<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
$this->title="منتجات المخزن"
?>
<div class="page-header">
    <p class="well" style="font-weight: bold; font-size: 20px;">
    - حدد بيانات المنتجات التي تقوم بتخزينها في المخزن.
    </p>
</div>
<div class="product-form well">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'ProductName')->textInput(['maxlength' => true, 'placeholder' => 'إسم المنتج ...', 'autocomplete' => "off"])->label("")?>



    <?=
    $form->field($model, 'ProductCategoryId')->widget(Select2::classname(), [
        'data'          => ArrayHelper::map(\app\models\Productcategory::find()->all(),
        'ProductCategoryId', 'ProductCategoryName'),
        'size'          => Select2::LARGE,
        'options'       => ['placeholder' => '... حدد القسم الذي ينتمي إليه المنتج'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);

    ?>
 

    <div class="form-group">
        <?=Html::submitButton('تسجيل منتجات المخزن', ['class' => 'report btn1 btn btn-primary'])?>
    </div>


    <?php ActiveForm::end();?>

</div>
