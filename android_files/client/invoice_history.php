<?php

include '../../include/connections.php';


$clientID=$_POST['clientID'];

//creating a query
$select = "SELECT b.order_id,b.client_id,b.serv_name,b.order_date,b.order_status,p.payment_id,p.service_fee,c.first_name,c.last_name
          FROM bookings b 
          INNER JOIN service_payment p on b.order_id = p.order_id
          INNER JOIN clients c ON b.client_id = c.client_id
          WHERE b.client_id = '$clientID' 
          AND p.status IN (0,1,2) 
          AND b.order_status IN (2,3,4,5,6,7,8,9,10)  
          ORDER BY b.order_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['orders'] = array();
      $results['message']="Invoice history";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['orderID'] = $row['order_id'];
          $temp['service_name'] = $row['serv_name'];
          $temp['order_date'] = $row['order_date'];
          $temp['payment_id'] = $row['payment_id'];
          $temp['service_fee'] = $row['service_fee'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];

               if($row['order_status']==1){
              $temp['orderStatus'] = "Pending";
          }elseif ($row['order_status']==2){
              $temp['orderStatus'] = "Pay Invoiced Amount";
          }elseif ( $row['order_status']==3){
              $temp['orderStatus'] = "Paid";
          }elseif ($row['order_status']==4){
              $temp['orderStatus'] = "Paid";
          }elseif ($row['order_status']==5){
              $temp['orderStatus'] = "Invoice Paid";
          }
          elseif ($row['order_status']==6){
              $temp['orderStatus'] = "Invoice Paid";

          }elseif ($row['order_status']==7){
              $temp['orderStatus'] = "Invoice Paid";

          }elseif ($row['order_status']==8){
              $temp['orderStatus'] = "Invoice Paid";
          }
          elseif ($row['order_status']==9){
            $temp['orderStatus'] = "Invoice Paid";
        }elseif ($row['order_status']==10){
            $temp['orderStatus'] = "Invoice Paid";
        }
          array_push($results['orders'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No Invoice Found";

}
//displaying the result in json format
echo json_encode($results);



//$today = date('Ymd');
//$startDate = date('Ymd', strtotime('-100 days'));
//$range = $today - $startDate;
//$rand = rand(100, 999);
//echo $rand;
//echo "</br>";
//$random = substr(md5(mt_rand()), 0, 2);
//echo $random;

?>