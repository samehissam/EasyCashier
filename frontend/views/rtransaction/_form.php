<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
//use kartik\select2\Select2;
$this->title="المطعم";
/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
$connection=\Yii::$app->db;
$item_names = $connection->createCommand('SELECT item_id ,item_name from ritem')->queryAll();

          /*$e=0;
            while($e<count($item_names)) {
                $name=$item_names[$e]["item_name"];
                echo '<butoon>';echo $name;


                echo'
                    </butoon>';
                $e++;
            }?>*/
?>

<div class="row transaction-form col-md-5">

              
<!--=========================================-->
    <div class=" order-form">
 <?php //echo $_SESSION["address"]; ?>

     <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <?php $now = date('Y/m/d');?>
     <div class="hidden">   <?= $form->Field( $model , "date" )->textInput(['value' =>$now ,'maxlength' => true]) ?>
     </div>
<div class="chef" >

 <img  src='/Cashier/frontend/web/images/chef1.jpg'>
 
        <div class="prin">
          
        </div> 

        <div class="form-group ">
        <div class="col-lg-6 print">
          <?= Html::Button('<span class=" glyphicon glyphicon-print"></span> الفاتورة', ['class'=>'btn btn-danger','id' => 'invoice-button']) ?>
</div>
<div class="col-lg-6">
            <?= Html::submitButton('<span class=" glyphicon glyphicon-shopping-cart"></span> إضافة طلب', ['class'=>'btn btn-danger','id' => 'order-button']) ?>
</div>


        </div>
</div>
  


    <div class="marg panel panel-default">
        <div class="panel-heading"><h2><i class="glyphicon glyphicon-shopping-cart"></i> الطلبات</h2></div>
        <div class="panel-body">

            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 100, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsTransaction[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'item_item_id',
                    'qty',
                    'method' => 'POST',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsTransaction as $i => $modelTransaction): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->


                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                          /*  if (! $modelTransaction->isNewRecord) {
                                echo Html::activeHiddenInput($modelTransaction, "[{$i}]id");
                            }*/
                            ?>

                                <div class="col-sm-6">
                                    <?= $form->field($modelTransaction , "[{$i}]qty")->Input('number',['onkeypress'=>"return isNumberKey(event)",'maxlength' => true,'autocomplete'=>"off",'style'=>'width:100px;margin-right:40px'])->label('الكمية',['style'=>'width:100px;margin-right:40px']) ?>

                                </div>

                            <div class=" col-sm-6">
                                <?= $form->field( $modelTransaction , "[{$i}]item_item_id")->label('الصنف')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Ritem::find()->all(),
                                    'item_id','item_name'),['prompt'=>'اختر الصنف.....','style'=>'width:220px'
                                ])?>
                            </div><!-- .row -->

                        </div>
                        <div class="pull-right up">
                            <button type="button" class=" add-item btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>

                        </div>
                        <div class="clearfix"></div>

                    </div>
                <?php endforeach; ?>

        </div>

        <?php DynamicFormWidget::end(); ?>
    
    </div>

</div><!--dynamic form end-->

    <?php ActiveForm::end(); ?>
    

   
<!--Tabs =======================-->
    <div id="delivary-form">
    <div class="search  col-sm-4">
    <input type="submit" class="btn btn-danger" value="بحث" id="search">
    </div>
    <?php $form = ActiveForm::begin([

        'method' => 'POST',
        'action' => ['transaction/create']]);
    ?>
    <div class=" col-sm-8">
  <input  type="text" class=" form-control" placeholder="رقم التليفون" maxlength="true" style="margin-bottom: 10px;" onkeypress="return isNumberKey(event)" name="phone" id="phone" >
  </div>
<div class="col-sm-12">
  <input  type="text" class="customer-details form-control" maxlength="true"  name="name" id="name" placeholder="إسم العميل">



        <input maxlength="true" type="text" class="customer-details form-control" placeholder="العنوان" name="address" id="address" >

</div>  

 <?php ActiveForm::end(); ?>
    </div>

    </div>
</div>
</div> <!-- End forms ===============================-->

   
<!--Tabs =======================-->

<div class="fixed container col-md-7 col-ms-6">
    <ul class=" nav nav-pills">
        <li class="tab-parts pull-right active"><a href="#Home" data-toggle="tab">ركن فاست فود</a></li>
        <li class="tab-parts pull-right"><a href="#about" data-toggle="tab">ركن الشاورما</a></li>
        <li class="tab-parts pull-right"><a href="#me" data-toggle="tab">ركن الشويات</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="Home">

            <div class="items col-md-8 col-ms-7">
                <?php  
                
                    $e=0;
                while($e<count($item_names)) {
                    $id=$item_names[$e]["item_id"];
                    $name=$item_names[$e]["item_name"];
                    if (strlen($name)<18){
                    
               
                  echo '<button style="width:95px" class="item-btn btn btn-primary" value="'.$id.'">'
                    .$name.'</button>';

                    }
                   else if(strlen($name)<28){
                    echo '<button style="width:130px" class="item-btn btn btn-primary" value="'.$id.'">'
                    .$name.'</button>';
          
                    }else{
                   echo '<button style="width:195px" class="item-btn btn btn-primary" value="'.$id.'">'
                    .$name.'</button>';
                    }
                    $e++;
                }?>

            </div>
            <div class="numbers col-md-4 col-ms-3">
            <?php
            for($i=1;$i<=9;$i++){
                echo '<button class="btn btn-danger qty"'.'value = '.$i.'>'.$i.'</button>';
            }?>


            </div>
        </div>
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
    </div>
</div>


<?php


$script= <<<JS

$(function (){

           $('#order-button').click(function(){
                 if(($('#address').val()).length>2){
                    $.ajax({
                           type: "POST",
                           url: "index.php?r=rtransaction/clientdetails",
                           data: {name:$('#name').val() , phone:$('#phone').val(),address:$('#address').val()},
                                   error     : function (error){
                                    alert("Error. not working"+ error);
                                    console.log("Error. not working" , error);
                                  }
                              });

                     }

                 else{
                     $.ajax({
                           type: "POST",
                           url: "index.php?r=rtransaction/clientdetails",
                           data: {name:"" , phone:"",address:""},
                           error: function (error){
                           alert("Error. not working"+ error);
                           console.log("Error. not working" , error);
                          }
                         });
                }





})


});

JS;

$this->registerJs($script);


    ?>
 <div class="clearfix" style=""></div>

    <!-- Resturant Invoic -->


    <?php
/**
 * Created by PhpStorm.
 * User: Sameh
 * Date: 9/27/2015
 * Time: 6:06 PM
 */



$connection=\Yii::$app->db;
$comand2 = $connection->createCommand("SELECT id FROM invoic ORDER by id DESC")->queryScalar();
$comand3 = $connection->createCommand("SELECT order_num FROM invoic ORDER by id DESC")->queryScalar();
if(isset($_SESSION["invoice_id"])){
$invoic_id = $_SESSION["invoice_id"];


$order_num = floatval($comand3);
//$order = $connection->createCommand("SELECT order_date FROM invoic ORDER by id DESC")->queryScalar();
/*<img src="/ResturantEasyCashier/frontend/web/images/chef2.PNG">
*/

$user_name= Yii::$app->user->identity->username;

$now =date("Y-m-d");
$time=date("h:i:sa");
  echo'
            <div id="invoic">
            <div class="img col-lg-3" style="border:solid black 2px; border-radius: 20px;">
             <h2 style="text-align:center">My Resturant</h2>
          ';

echo "<div class='time-date'> التاريخ /&nbsp;&nbsp;&nbsp;$now&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time

</div>";
echo "<div class='time-date'> رقم الطلب /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>$order_num</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; الكاشير &nbsp;&nbsp;<b>$user_name</b></div>";
echo'
           <table class="table table-striped table-bordered">
               <thead class="color">

               <tr>
                     <th>الكمية</th>
                     <th>الصنف</th>
                     <th >السعر</th>

               </tr>
               </thead>


';

/*$sumQuary=$connection->createCommand('SELECT SUM(total) FROM transaction WHERE invoice_id =' .$invoic_id)->queryAll();
$sumAll=floatval($sumQuary[0]['SUM(total)']);*/
$getInvoic=$connection->createCommand('SELECT qty,item_cost,ritem.item_name
                FROM rtransaction INNER join ritem on item_item_id=item_id
                WHERE invoice_id =' . $invoic_id)->queryAll();
$e=0;
        $sum=0;
        while($e<count($getInvoic)) {

            $item_name = $getInvoic[$e]['item_name'];
            $cost = floatval($getInvoic[$e]['item_cost']);
            $qty = floatval($getInvoic[$e]['qty']);

            $total_cost=$qty*$cost;
            $sum=$sum+$total_cost;
    echo "
                 <tbody>
                 <tr>
                     <td><h4>$qty</h4></td>
                     <td><h4>$item_name</h4></td>
                     <td><h4>$total_cost</h4></td>


                 </tr>";

    $e++;
}
/*
$sumQuary=$connection->createCommand('SELECT SUM(total) FROM transaction WHERE invoice_id =' .$invoic_id)->queryAll();
$sumAll=floatval($sumQuary[0]['SUM(total)']);
*/
    echo "

                 <tr class='color totalcell'>
                 <td  colspan='2' >&nbsp; اجمالي الفاتورة</td>
                     <td>$sum</td>



                 </tr>
    </tbody>

        </table>";


if(isset($_SESSION["address"])&&strlen($_SESSION["address"])>2){
    echo "<p> <h3  class='details'>"."إسم العميل : ".$_SESSION["name"]."</h3>";
    echo "<h3  class='details'>"."رقم المحمول : ".$_SESSION["phone"]."</h3>";
    echo "<h3>"."العنوان : ". $_SESSION["address"]."</h3><br> </p>";

}


        echo"<div class='invoicfooter'>
        

</div>
</div>
      ";
}

 
