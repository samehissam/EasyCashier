<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

//use kartik\form\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'تسجيل الدخول ';

?>
<div class="row overlay">
<h1 class="text-center" style="color: #fff; margin-top: 100px; font-size: 70px; font-weight: bold; ">Easy Cashier</h1>
<div class="col-lg-3"></div>
<div class="col-lg-5" style="margin-left: 50px;">

            <?php $form = ActiveForm::begin(['id' => 'login-form']);?>

<?php
echo $form->field($model, 'username', [
    'feedbackIcon' => [
        'prefix'         => 'fa fa-',
        'default'        => 'user',
        'success'        => 'user-plus',
        'error'          => 'user-times',
        'defaultOptions' => ['class' => 'text-warning'],
    ],
])->textInput(['placeholder' => 'إسم المستخدم ...'])->label(""); 
?>


<?php 
echo $form->field($model, 'password', [
    'feedbackIcon' => [
        'prefix'         => 'fa fa-',
        'default'        => 'key',
        'success'        => 'unlock',
        'error'          => 'unlock-alt',
        'defaultOptions' => ['class' => 'text-warning'],
    ],
])->passwordInput(['placeholder' => 'كلمة السر ...'])->label("");

?>



                <div class="form-group">
                    <?=Html::submitButton('<span class=" glyphicon glyphicon-user pad"></span> دخول', ['class' => 'radius-button btn btn-primary btn-lg', 'name' => 'login-button'])?>
                </div>

            <?php ActiveForm::end();?>
    </div>
</div>
