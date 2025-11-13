<?php

include '../../include/connections.php';

//$clientID=$_POST['clientID'];
$orderID=$_POST['orderID'];
//creating a query
$select = "SELECT b.order_id,i.item_id,i.product_id,i.product_name,i.quantity,i.item_price,i.total_price,i.file_name 
    FROM order_items i 
    INNER JOIN
     bookings b ON b.order_id = i.order_id WHERE i.order_id = '$orderID' AND b.order_id = '$orderID'";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){

      $item= array();
      $item['status'] = "1";
      $item['items'] = array();
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['itemID'] = $row['item_id'];
          $temp['orderID'] = $row['order_id'];
          $temp['productID'] = $row['product_id'];
          $temp['quantity'] = $row['quantity'];
          $temp['productName'] = $row['product_name'];
          $temp['itemPrice'] = $row['item_price'];
          $temp['subTotal'] = $row['total_price'];
          $temp['image'] = $row['file_name'];

          array_push($item['items'], $temp);

      }
   
      // calculate cart total

      $select = "SELECT SUM(i.total_price) cartTotal FROM order_items i INNER JOIN bookings b ON i.order_id = b.order_id
          WHERE i.order_id='$orderID'";
      $response = mysqli_query($con, $select);

      while ($row = mysqli_fetch_array($response)) {
          $item['cartTotal'] = $row['cartTotal'];


      }
  }else{
    $item['status'] = "0";
}

echo json_encode($item);







?>