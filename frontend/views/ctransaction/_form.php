<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title="الطلبات";
/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
$connection=\Yii::$app->db;
$item_names = $connection->createCommand('SELECT item_id ,item_name from citem')->queryAll();


          /*$e=0;
            while($e<count($item_names)) {
                $name=$item_names[$e]["item_name"];
                echo '<butoon>';echo $name;


                echo'
                    </butoon>';
                $e++;
            }?>*/
?>

<div class="transaction-form col-lg-5">

 
    <div class=" order-form">
 
     <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <?php $now = date('Y/m/d');?>
     <div class="hidden">   <?= $form->Field( $model , "date" )->textInput(['value' =>$now ,'maxlength' => true]) ?>
     </div>
<div class="chef">

 <img  src='/Cashier/frontend/web/images/waiter.jpg'>

        <div class="form-group ">

            <?= Html::submitButton('<span class=" glyphicon glyphicon-shopping-cart"></span> إضافة طلب', ['class'=>'btn btn-danger','id' => 'order-button']) ?>


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

<?= $form->Field( $order_table , "order_tabe" )->label("")->textInput(['maxlength' => true]) ?>
        <!-- <input  type="text" class="table-num form-control" placeholder="رقم المقعد" maxlength="true" onkeypress="return isNumberKey(event)" name="c_table_num" id="c_table_num" required >-->


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
                                    <?= $form->field($modelTransaction , "[{$i}]qty")->Input('number',["placeholder"=>"الكمية",'onkeypress'=>"return isNumberKey(event)",'maxlength' => true,'autocomplete'=>"off",'style'=>'width:100px;margin-right:40px'])->label('الكمية',['style'=>'width:100px;margin-right:40px']) ?>

                                </div>

                            <div class=" col-sm-6">
                                <?= $form->field( $modelTransaction , "[{$i}]item_item_id")->label('الصنف')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Citem::find()->all(),
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
    

</div>
</div> <!-- End forms ===============================-->

   
<!--Tabs =======================-->

<div class=tabees>

<div class="fixed container col-md-7">
    <ul class=" nav nav-pills">
        <li class="tab-parts pull-right active"><a href="#Home" data-toggle="tab">ركن المشروبات</a></li>
        <li class="tab-parts pull-right"><a href="#about" data-toggle="tab">ركن الشاورما</a></li>
        <li class="tab-parts pull-right"><a href="#me" data-toggle="tab">ركن الشويات</a></li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="Home">
        
        <div class="items-name">
           <div class="col-lg-8">
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
               
                
                <div class="numbers col-lg-4">


                <?php $form = ActiveForm::begin([
                       'method' => 'POST',
                       // 'action' => ['transaction/updatetable']
                    ]); ?>
                   
                    <div class="form-group col-md-3" style="margin-right: -20px;" >
                       
                        
                        <?= Html::submitButton('<i class="fa fa-money" aria-hidden="true"></i>',['class' => ' btn1  btn-danger', 'id' => 'invoic-table-button']) ?>
                      
                    </div>
                     <div class="col-md-9" style="margin-top: -20px;">

                     <?= $form->Field( $invoic_table , "table_id" )->label("")->textInput(['maxlength' => true]) ?>
                    <!-- <input style="max-width: 180px;" type="text" class="table-number form-control" placeholder="رقم المقعد" maxlength="true" onkeypress="return isNumberKey(event)" name="r_table_number" id="r_table_number" required >-->
                    </div>

<div class="clearfix"></div>
               
                <?php ActiveForm::end(); ?>

                <?php    /*  Array
            (
            [0] =&gt; Array
            (
            [table_id] =&gt; 1
            [table_state] =&gt; 1
            [session_start] =&gt; 2016-01-26 17:35:33
            )*/

           if ($invoic_table->load(Yii::$app->request->post()))
                {
               
                    $connection2=\Yii::$app->db;
                    $update_session = $connection2->createCommand('UPDATE ctable_session set table_state=0  where table_id = '.$invoic_table->table_id );
                    $update_session->execute();

                }
                $tables = $connection->createCommand('SELECT * from ctable_session')->queryAll();
                $e=0;
                while($e<count($tables)) {
                    $table_id=$tables[$e]["table_id"];
                    $table_state=$tables[$e]["table_state"];

                    if($table_state==0){
                        echo '<button class="btn-success qty"'.'value = '.$table_id.'> T '.$table_id.'</button>';
                    }
                    else{
                        echo '<button class="btn-danger qty"'.'value = '.$table_id.'> T '.$table_id.'</button>';
                    }
                    $e++;
                }
          ?>


            </div>
            

  </div>
            </div> <!--end tab Home -->
            <div class="tab-pane" id="about">

           <div class="numbers col-lg-4">

<?php
                $tables = $connection->createCommand('SELECT * from ctable_session')->queryAll();
                $e=0;
                while($e<count($tables)) {
                    $table_id=$tables[$e]["table_id"];
                    $table_state=$tables[$e]["table_state"];

                    if($table_state==0){
                        echo '<button class="btn-success qty"'.'value = '.$table_id.'> T '.$table_id.'</button>';
                    }
                    else{
                        echo '<button class="btn-danger qty"'.'value = '.$table_id.'> T '.$table_id.'</button>';
                    }
                    $e++;
                }
          ?>

          


            </div>
          
        </div>

        <div class="tab-pane" id="me">
           <div class="numbers col-lg-4">


<?php
                $tables = $connection->createCommand('SELECT * from ctable_session')->queryAll();
                $e=0;
                while($e<count($tables)) {
                    $table_id=$tables[$e]["table_id"];
                    $table_state=$tables[$e]["table_state"];

                    if($table_state==0){
                        echo '<button class="btn-success qty"'.'value = '.$table_id.'> T '.$table_id.'</button>';
                    }
                    else{
                        echo '<button class="btn-danger qty"'.'value = '.$table_id.'> T '.$table_id.'</button>';
                    }
                    $e++;
                }
          ?>

          


            </div>


            
        </div>  <!--end tabs content -->

</div>
</div>
<?php

/*
$script= <<<JS

$(function (){

         $('#order-button').click(function(){
                
                    $.ajax({
                           type: "POST",
                           url: "index.php?r=transaction/clientdetails",
                           data: {table_num:$('#table_num').val()},
                                   error     : function (error){
                                    alert("Error. not working"+ error);
                                    console.log("Error. not working" , error);
                                  }
                              });








})



});

JS;
$this->registerJs($script);
*/

    ?>

 <div class="clearfix"></div>

    <!-- Cafe table invoic -->



<?php
    date_default_timezone_set('Africa/Cairo');
        $connection=\Yii::$app->db;
        if ($invoic_table->load(Yii::$app->request->post()))
        {
        $table_session_start = $connection->createCommand("SELECT session_start FROM ctable_session where table_id=".$invoic_table->table_id )->queryOne();



        //$order = $connection->createCommand("SELECT order_date FROM invoic ORDER by id DESC")->queryScalar();



        $user_name= Yii::$app->user->identity->username;
        $date_time=date('Y-m-d H:i:s');
        $table_num=$invoic_table->table_id ;
        $now =date("Y-m-d");
        $time=date("h:i:sa");
          echo'
                    <div id="invoic">
                    <div class="img col-lg-3" style="border:solid black 2px;">
                     <!--<img src="/CafeEasyCashier/frontend/web/images/chef2.PNG">-->
                  ';

        echo "<div class='time-date'> التاريخ /&nbsp;&nbsp;&nbsp;$now&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time

        </div>";
        echo "<div class='time-date'> رقم المقعد /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>$table_num</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; الكاشير /&nbsp;&nbsp;&nbsp;<b>$user_name</b></div>";

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
        //Array ( [session_start] => 2016-01-27 18:51:30 )
       /* $sumQuary=$connection->createCommand('SELECT SUM(total) FROM transaction WHERE ( table_session between "'.$table_session_start["session_start"].'" and "'.$date_time.'" ) and table_table_id =' .$invoic_table->table_id )->queryone();

        $sumAll=floatval($sumQuary['SUM(total)']);*/
        /*
         * SELECT SUM(total) FROM transaction WHERE ( table_session between " 2016-01-28 06:56:12" and "2016-01-28 07:11:44" ) and table_table_id =4
        */
        $getInvoic=$connection->createCommand('SELECT qty,item_cost,citem.item_name
                        FROM ctransaction INNER join citem on item_item_id=item_id
                        WHERE ( table_session between "'.$table_session_start["session_start"].'" and "'.$date_time.'" ) and table_table_id =' .$invoic_table->table_id )->queryAll();

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


                echo"<div class='invoicfooter'>
               <!-- <img src='/CafeEasyCashier/frontend/web/images/invoic.PNG'>-->

        </div>
        </div>
        </div>
              ";
        }