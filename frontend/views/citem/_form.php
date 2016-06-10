<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-3"></div>
<div class="item-form well col-md-8">
    <?php $form = ActiveForm::begin(); ?>

        
        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true,'autocomplete'=>"off",'autofocus'=>true])->label('الصنف') ?>

        <?= $form->field($model, 'item_cost')->textInput(['onkeypress'=>"return isNumberKey(event)",'maxlength' => true,'autocomplete'=>"off"])->label('السعر') ?>
        <?=

        $form->field($model, 'category_id')->widget(Select2::classname(), [
    'data'          => ArrayHelper::map(\app\models\Ccategory::find()->all(),
            'category_id','category_name'),
    'size'          => Select2::LARGE,
    'options'       => ['placeholder' => '... اختر القسم'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]);
?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'إضافة منتج جديد' : 'تعديل', ['class' => $model->isNewRecord ? 'radius-button btn btn-primary' :'btn btn-primary'  ]) ?>
        </div>


        <?php ActiveForm::end(); ?>
</div>

