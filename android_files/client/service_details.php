<?php

include '../../include/connections.php';


$clientID=$_POST['clientID'];
//creating a query
$select = "SELECT i.item_id,i.stock_id,i.order_id,s.product_name
          FROM order_items i 
          INNER JOIN services s ON i.stock_id = s.stock_id
          WHERE client_id='$clientID' AND item_status='0'";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['stock_id'] = $row['stock_id'];
          $temp['order_id'] = $row['order_id'];
          $temp['product_name'] = $row['product_name'];
          array_push($results['details'], $temp);

      }


  }else{
    $results['status'] = "0";
      $results['message'] = "";

}
//displaying the result in json format
echo json_encode($results);


?>