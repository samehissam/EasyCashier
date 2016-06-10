<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Inventory */
/* @var $form yii\widgets\ActiveForm */

$connection=\Yii::$app->db;
$item_names = $connection->createCommand('SELECT ProductId ,ProductName from product')->queryAll();
?>
<div class="transaction-form col-lg-5">
<div class="page-header ">
    <p class="well" style="font-weight: bold; font-size: 20px;">
    - حدد المنتج والكمية التي تريد إضافتها إلي المخزن.
    </p>
</div> 
<div class="inventory-form well">

    <?php $form = ActiveForm::begin(); ?>

    
   
  
	<?= $form->field($model, 'ProductId')->label("")->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(),
    'ProductId','ProductName'),['prompt'=>'إختر المنتج...'
    ])?>
     <?= $form->field($model, 'ProductQty')->label("الكمية")->textInput() ?>
     
    <div class="form-group">

     <?= Html::a('إضافة للمخزن', ['create'], [
            'class' => 'btn btn-primary',
            'data' => [
                
                'method' => 'post',
            ],
        ]) ?>
        

        <?= Html::a('خروج من الخزن', ['out'], [
            'class' => 'btn btn-danger',
            'data' => [
                
                'method' => 'post',
            ],
        ]) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
</div>

<div class="fixed container col-lg-7">
    <ul class=" nav nav-pills">
        <li class="tab-parts pull-right active"><a href="#Home" data-toggle="tab">ركن المشروبات</a></li>
        <li class="tab-parts pull-right"><a href="#about" data-toggle="tab">ركن الشاورما</a></li>
        <li class="tab-parts pull-right"><a href="#me" data-toggle="tab">ركن الشويات</a></li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="Home">

            <div class="items">
                <?php  

                    $e=0;
                while($e<count($item_names)) {
                    $id=$item_names[$e]["ProductId"];
                    $name=$item_names[$e]["ProductName"];
                    $qty = $connection->createCommand('SELECT ProductQty from inventory where ProductId='.$id)->queryAll();
                    //print_r($qty[0]['ProductQty']);

                    if(count($qty)!=0){
                    if (strlen($name)<18){
                        if($qty[0]['ProductQty']>5){
               
                  
                  echo '<button style="width:95px" class="inv-item btn btn-primary" value="'.$id.'">'
                    .$name." <br>" .$qty[0]["ProductQty"].'</button>';

                    }else{
                        echo '<button style="width:95px" class="inv-item btn btn-danger" value="'.$id.'">'
                    .$name." <br>" .$qty[0]["ProductQty"].'</button>';

                }
              

            }
            
                   elseif(strlen($name)<28){
                    if($qty[0]['ProductQty']>5){
                    echo '<button style="width:130px" class="inv-item btn btn-primary" value="'.$id.'">'
                    .$name." <br>" .$qty[0]["ProductQty"].'</button>';
                    }else{
                        echo '<button style="width:130px" class="inv-item btn btn-danger" value="'.$id.'">'
                    .$name." <br>" .$qty[0]["ProductQty"].'</button>';
                    }

                    }else{
                        if($qty[0]['ProductQty']>5){
                   echo '<button style="width:195px" class="inv-item btn btn-primary" value="'.$id.'">'
                    .$name." <br>" .$qty[0]["ProductQty"].'</button>';
                    }else{
                         echo '<button style="width:195px" class="inv-item btn btn-danger" value="'.$id.'">'
                    .$name." <br>" .$qty[0]["ProductQty"].'</button>';

                    }

                }

            }elseif (strlen($name)<18){
                    
               
                  echo '<button style="width:95px" class="inv-item btn btn-danger" value="'.$id.'">'
                    .$name." <br>" ."0".'</button>';


                    }
                   else if(strlen($name)<28){
                    echo '<button style="width:130px" class="inv-item btn btn-danger" value="'.$id.'">'
                    .$name." <br>" ."0".'</button>';
                    }else{
                   echo '<button style="width:195px" class="inv-item btn btn-danger" value="'.$id.'">'
                    .$name." <br>" ."0".'</button>';
                    }



                    $e++;
                }?>

            </div>
            </div> <!--end tab Home -->

          



            <div class="tab-pane" id="about">

           <div class="numbers col-lg-4">
                 <?php
            for($i=1;$i<=9;$i++){
                echo '<button class="btn btn-danger qty">'.$i.'</button>';
            }?>
            </div>
        </div>
        <div class="tab-pane" id="me">
           <div class="numbers col-lg-4">
                 <?php
            for($i=1;$i<=9;$i++){
                echo '<button class="btn btn btn-danger qty">'.$i.'</button>';
            }?>
            </div>
        </div>


        </div>  <!--end tabs content -->

</div>
