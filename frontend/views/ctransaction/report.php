<?php
$this->title = 'التقرير اليومي';

    echo '

<h1 class="text-center space">الايراد اليومي <span class="span"> للمطعـــــــــــــم  </span></h1>
';

echo'
       <div class="row">
            <p class="total text-center">إجمالي المبيعات لكل صنف
           &nbsp;&nbsp;&nbsp; ';
echo $dayDate;
          echo'  </p>
           <table class="table table-striped">
               <thead class="color">
               <tr>
                   <th>الصنف</th>
                   <th>الكميه</th>
                   <th >السعر</th>

               </tr>
               </thead>


   ';
    $connection=\Yii::$app->db;
    $comand3 = $connection->createCommand('SELECT item_id from citem')->queryAll();
    $n=0;
    while($n<count($comand3)){
        $data[$n]=$comand3[$n];
        $n++;
    }



    $i=0;
 
    $sumAll=0;
    while($i<count($comand3)) {
        $comand2 = $connection->createCommand('SELECT SUM(qty),item_cost,citem.item_name
                FROM ctransaction INNER join citem on item_item_id=item_id
                WHERE item_item_id =' . floatval($data[$i]["item_id"]) . ' and Date (table_session) = '."'".$dayDate."'")->queryAll();
        $sumQty = floatval($comand2[0]['SUM(qty)']);
        $cost = floatval($comand2[0]['item_cost']);
        $total=$sumQty*$cost;
        $sumAll=$sumAll+$total;
        $name = $comand2[0]['item_name'];
     //   echo Json::encode($comand2);
        //   print_r($comand2);


                     echo"
                      <tbody>
                      <tr>
                          <td>$name</td>
                          <td>$sumQty</td>
                          <td>$total</td>




                      </tr>";

        $i++;
    }
    echo "
                </tbody>

            </table>

    </div>";
echo "<p class='total'>اجمالي المبيعات&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   $sumAll  &nbsp;جنيه</p>";
