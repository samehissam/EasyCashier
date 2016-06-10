<?php
$connection=\Yii::$app->db;
$this->title = 'المطبخ';

if(isset($_GET['order_process'])){

 $update_qty = $connection->createCommand('UPDATE rtransaction set order_status= "p" where id = ' . $_GET['order_process']);
  $update_qty->execute();

}
if(isset($_GET['order_go'])){

 $update_qty = $connection->createCommand('UPDATE rtransaction set order_status= "g" where id = ' . $_GET['order_go']);
  $update_qty->execute();

}


    echo '
    <div class="col-md-1"></div>
<div class="col-md-3 kitchen-img">
<img  src="/Cashier/frontend/web/images/chef1.jpg">
</div>
   <div class="col-md-5">
<h1 class="text-center space">طلبات المطبخ</h1>
</div>
';

echo'
       <div class="row">
       <div class="container">
    

          </p>
           <table class="table table-striped">
               <thead class="color">
               <tr>
                   <th>الصنف</th>
                   <th>الكميه</th>
                    <th >رقم الطلب</th>
                    <th ></th>

               </tr>
               </thead>


   ';
     
  $getOrders=$connection->createCommand('SELECT qty,ritem.item_name,order_status,invoice_id,id
                        FROM rtransaction INNER join ritem on item_item_id=item_id
                        WHERE order_status="o" OR order_status="p" ORDER BY id DESC' )->queryAll();

        $e=0;
        $sum=0;
        while($e<count($getOrders)) {

            $order_status = $getOrders[$e]['order_status'];
            $item_name = $getOrders[$e]['item_name'];
           // $table_num = floatval($getOrders[$e]['table_table_id']);
            $invoic= floatval($getOrders[$e]['invoice_id']);
            $qty = floatval($getOrders[$e]['qty']);
            $orderId = floatval($getOrders[$e]['id']);
            $getOrderNum=$connection->createCommand('SELECT order_num
                        FROM invoic 
                        WHERE id= '.$invoic)->queryAll();
           $order_num = floatval($getOrderNum[0]['order_num']);
//print_r($getOrderNum);
            if($order_status=='o'){
            echo "
                         <tbody>
                         <tr >
                             <td class='back'><h2>$item_name</h2></td>
                             <td class='back'><h2>$qty</h2></td>
                             <td class='back'><h2>$order_num</h2></td>
                             <td style=width:300px;>
<a href='/Cashier/frontend/web/index.php?r=rtransaction/order&order_process=$orderId'><button class='btn1 btn-primary'> طلب</button> </a>
<a href='/Cashier/frontend/web/index.php?r=rtransaction/order&order_go=$orderId'><button class='btn1 btn-danger'> خروج الطلب</button> </a>
</td>

                             

                         </tr>";
}else{
  echo "
                         <tbody>
                         <tr >
                             <td ><h2>$item_name</h2></td>
                             <td ><h2>$qty</h2></td>
                             <td ><h2>$order_num</h2></td>
                             <td style=width:300px;>
<a href='/Cashier/frontend/web/index.php?r=rtransaction/order&order_process=$orderId'><button class='btn1 btn-primary'> طلب</button> </a>
<a href='/Cashier/frontend/web/index.php?r=rtransaction/order&order_go=$orderId'><button class='btn1 btn-danger'> خروج الطلب</button> </a>
</td>

                             

                         </tr>";
}
            $e++;
        }

     //   echo Json::encode($comand2);
        //   print_r($comand2);


    echo "
                </tbody>

            </table>

    </div> 
    </div>";

