<?php


include '../../include/connections.php';

$select="SELECT * FROM stock";
$query=mysqli_query($con,$select);


  if(mysqli_num_rows($query)>0){
      $response['status']=1;
      $response['message']="Stock";
      $response['details']=array();

      while ($row=mysqli_fetch_array($query)){
          $index['stockID']=$row['stock_id'];
          $index['category']=$row['product_category'];
          $index['color']=$row['color'];
          $index['quantity']=$row['stock'];
          $index['description']=$row['description'];

          array_push($response['details'],$index);
      }
      echo json_encode($response);
  }
  ?>