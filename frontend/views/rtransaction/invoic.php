
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

$invoic_id = $_SESSION["invoice_id"];


$order_num = floatval($comand3);
//$order = $connection->createCommand("SELECT order_date FROM invoic ORDER by id DESC")->queryScalar();
/*<img src="/ResturantEasyCashier/frontend/web/images/chef2.PNG">
*/

$user_name= Yii::$app->user->identity->username;

$now =date("Y-m-d");
$time=date("h:i:sa");
  echo'

            <div class="img col-lg-3" style="border:solid black 2px;">
             <h2 style="text-align:center">My Resturant</h2>
          ';

echo "<div class='time-date'> التاريخ /&nbsp;&nbsp;&nbsp;$now&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time

</div>";
echo "<div class='time-date'> رقم الطلب /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>$order_num</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; الكاشير /&nbsp;&nbsp;&nbsp;<b>$user_name</b></div>";
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
    echo "<h3  class='details'>"."إسم العميل : ".$_SESSION["name"]."</h3>";
    echo "<h3  class='details'>"."رقم المحمول : ".$_SESSION["phone"]."</h3>";
    echo "<h3>"."العنوان : ". $_SESSION["address"]."</h3>";

}


        echo"<div class='invoicfooter'>
        
</div>

</div>
      ";

 
